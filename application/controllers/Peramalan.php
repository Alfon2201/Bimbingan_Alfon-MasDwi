<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Peramalan  extends CI_Controller {
        

        public function __construct() {

            parent::__construct();

            // load model 
            $this->load->model('Peramalan_model');
            $this->load->model('Barang_m');
            $this->load->model('Penjualan_model');
        }

        public function index(){
            
            $this->load->view('template/template_header');  
            $this->load->view('peramalan/table');
            $this->load->view('template/template_footer');
        }



        public function tambah() {

            $data['peramalan'] = $this->Peramalan_model->ambil_data();
            $data['barang'] = $this->Barang_m->get()->result_array();

            $this->load->view('template/template_header');            
            $this->load->view('peramalan/View', $data);
            $this->load->view('template/template_footer');
        }




        public function proses() {

            $interval = $this->input->post('interval');
            $timeframe = $this->input->post('timeframe');
            // $kode_barang = $this->input->post('kode_barang');
            $kode_barang = "BR001";
            $alpha = $this->input->post('alpha');


            // split interval waktu
            $date_start = $this->input->post('start');
            $date_end = $this->input->post('end');
            
            // waktu tanggal
            $start_string = strtotime( $date_start );
            $end_string = strtotime( $date_end );

            $set_timeframe = [];
        

            while( $start_string <= $end_string ) {

                // get start of week
                if ( $timeframe == "week" ) {

                    $start_time = strtotime("monday this week", $start_string);
                    $end_time = strtotime("sunday this week", $start_string);
                
                } else if ( $timeframe == "2 week" ) { 

                        $start_time = strtotime("monday this week", $start_string);
                        $end_week = strtotime("sunday this week", $start_time);

                        $end_time = strtotime( "+7 day", $end_week );

                        $start_string = $end_time;
                
                
                } else if ( $timeframe == "month" ) {

                    $start_day_of_month = date("Y-m-01", $start_string);
                    $start_time = strtotime( $start_day_of_month );

                    $end_day_of_month = date('Y-m-t', $start_string);
                    $end_time = strtotime($end_day_of_month);
                }
                
                // echo date('d F Y', $start_time).' - '.date('d F Y', $end_time).'<br>';


                

                $dt_time = array( $start_time, $end_time );
                // array_push( $set_timeframe, $dt_time );
                $set_timeframe[$start_time] = $dt_time;


                $start_string = strtotime("+1 day", $start_string);
            }








            $dataset = [];
            foreach ( $set_timeframe AS $isi ) {

                $start = date('Y-m-d', $isi[0]);
                $end = date('Y-m-d', $isi[1]);

                
                // echo $start.' '.$end;
                $query = $this->Penjualan_model->timeframe_penjualan( $start, $end, $kode_barang );

                if ( $query->num_rows() > 0 ) {

                    foreach ( $query->result_array() AS $kolom ) {

                        array_push( $dataset, array(

                            'bulan' => $kolom['tgl'],
                            'actual'=> $kolom['penjualan']
                        ) );

                        // echo $kolom['tgl'].'<br>';
                    }
                }
            }


            // urutkan tanggal  
            usort($dataset, array($this, 'date_compare'));


            $peramalan = $this->exponential_smoothing( $dataset, $alpha );


            // header('Content-Type: json');
            $JSON_ENCODE = json_encode( $peramalan, JSON_PRETTY_PRINT );

            $data = array(

                'kode_barang'   => $kode_barang,
                'timeframe'     => $timeframe,
                'tanggalawal'   => $start_string,
                'tanggalakhir'  => $end_string,
                'perhitungan'   => $JSON_ENCODE
            );

            $id_peramalan = $this->Peramalan_model->insert( $data );

            redirect( 'peramalan/hasil/'. $id_peramalan );
            

        }




        public function hasil( $id_peramalan ) {

            $data['peramalan'] = $this->Peramalan_model->ambil_data_berdasarkan_id( $id_peramalan )->row_array();

            $this->load->view('template/template_header');  
            $this->load->view('peramalan/hasil', $data);
            $this->load->view('template/template_footer');
        }















        public function exponential_smoothing( $dataset, $alpha ) {

            // @TODO 1 : Menghitung exponential smoothing
            $hasilPerhitungan = array();
            
            foreach ( $dataset AS $index => $isi ) {

                $Ft = 0;
                $bulan = $isi['bulan'];
                $actual = $isi['actual'];

                if ( $index == 0 ) {

                    $Ft = $isi['actual'];

                } else { 
                    
                    $Ft_1 = $hasilPerhitungan[ $index - 1 ]['forecast'];
                    $Xt_1 = $hasilPerhitungan[ $index - 1 ]['actual'];
                    $Ft = $alpha * $Xt_1 + ( 1 - $alpha ) * $Ft_1;   
                }
    
                $hasilPeramalan = array(
    
                    'bulan'     => $bulan,
                    'actual'    => $actual,
                    'forecast'  => $Ft
                );
    
                array_push( $hasilPerhitungan, $hasilPeramalan );
            }


            // hasil peramalan akhir
            $urutan = count($dataset);
            $Ft_1 = $hasilPerhitungan[ $urutan - 1 ]['forecast'];
            $Xt_1 = $hasilPerhitungan[ $urutan - 1 ]['actual'];
            $Ft = $alpha * $Xt_1 + ( 1 - $alpha ) * $Ft_1;

            $hasilPeramalan = array(

                'bulan'     => "Desember",
                'actual'    => 0,
                'forecast'  => $Ft
            );

            array_push( $hasilPerhitungan, $hasilPeramalan );




            /** Percentage Error */
            $total_mad = 0;
            $total_mse = 0;
            $total_mape = 0;
            foreach ( $hasilPerhitungan AS $index => $isi ) {

                if ( $index < count( $dataset ) ) {

                    $MAD = abs($isi['actual'] - $isi['forecast']);
                    $MSE = pow($MAD, 2);
                    $MAPE = abs( $MAD / $isi['actual'] * 100 );

                    $total_mad = $total_mad + $MAD;
                    $total_mse = $total_mse + $MSE;
                    $total_mape = $total_mape + $MAPE;

                }
            }

            $total = count($dataset);
            $avg_mad = $total_mad / $total;
            $avg_mse = $total_mse / $total;
            $avg_mape = $total_mape / $total;


            $data = array(

                'hasil_perhitungan' => $hasilPerhitungan,
                'avg_mad'   => $avg_mad,
                'avg_mse'   => $avg_mse,
                'avg_mape'   => $avg_mape,
            );

            return $data;
        }




        // sorting date
        function date_compare($element1, $element2) {
            $datetime1 = strtotime($element1['bulan']);
            $datetime2 = strtotime($element2['bulan']);
            return $datetime1 - $datetime2;
        } 

        
    }