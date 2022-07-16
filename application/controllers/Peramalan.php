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
            

            $data['peramalan'] = $this->Peramalan_model->ambil_data();

            $this->load->view('template/template_header');  
            $this->load->view('peramalan/table', $data);
            $this->load->view('template/template_footer');
        }



        public function tambah() {

            $data['peramalan'] = $this->Peramalan_model->ambil_data();
            // $data['barang'] = $this->Barang_m->get()->result_array();
            $data['barang'] = $this->Peramalan_model->pencarianBarang();
            // print_r( $data['barang'] );

            $this->load->view('template/template_header');            
            $this->load->view('peramalan/View', $data);
            $this->load->view('template/template_footer');
        }




        public function proses() {

            $interval = $this->input->post('interval');
            $timeframe = $this->input->post('timeframe');
            $kode_barang = $this->input->post('kode_barang');
            // $kode_barang = "BR001";
            $alpha = $this->input->post('alpha');
            $tipe = $this->input->post('tipe');

            // split interval waktu
            $date_start = $this->input->post('start');
            $date_end = $this->input->post('end');
            
            // waktu tanggal
            $start_string = strtotime( $date_start );
            $end_string = strtotime( $date_end );

            

            $set_timeframe = [];
            $temporary = "";
            $urutan = 0;
        
            $dataset = [];
            while( $start_string <= $end_string ) {


                // filter berlaku untuk 7 hari dan 14 hari 
                if ( $timeframe == "week" || $timeframe == "2 week"  ) {


                    // get start of week
                    if ( $timeframe == "week" ) {

                        $polaHari = "+6 day";
                    // filter 2 mingguan
                    } else if ( $timeframe == "2 week" ) { 

                        $polaHari = "+13 day";
                    // filter bulanan
                    }

                    if ( $urutan == 0 ) {
    
                        $start_time = $start_string;
                        $end_time = strtotime($polaHari, $start_string);
    
                        // add tomporary 
                        $temporary = strtotime("+1 day", $end_time);
                        
                    } else {
    
                        $start_time = $temporary;
                        $end_time = strtotime($polaHari, $start_time);
    
                        // add tomporary 
                        $temporary =  strtotime("+1 day", $end_time);
                    }

                    $start_string = $temporary;

                } else if ( $timeframe == "month" ) {

                    $start_time = $start_string;
                    $end_time = strtotime("next month", $start_string);

                    $start_string = $end_time;
                }

                echo date('Y-m-d', $start_time).' - '.date('d F Y', $end_time).'<br>';

                // query penjualan
                $start = date('Y-m-d', $start_time);
                $end = date('Y-m-d', $end_time);
                $query = $this->Penjualan_model->timeframe_penjualan( $start, $end, $kode_barang );
                
                echo $query->num_rows().'<br>';

                if ( $query->num_rows() > 1 ) {

                    $total_penjualan = 0;

                    foreach ( $query->result_array() AS $kolom ) {

                        $total_penjualan += $kolom['penjualan'];
                    }

                    array_push( $dataset, array(

                        'bulan' => $kolom['tgl'],
                        'actual'=> $total_penjualan
                    ) );

                } else if ( $query->num_rows() == 1 ) {

                    $data = $query->row_array();

                    array_push( $dataset, array(

                        'bulan' => $data['tgl'],
                        'actual'=> $data['penjualan']
                    ) );
                }

                $urutan++;
            }



            // urutkan tanggal  
            usort($dataset, array($this, 'date_compare'));


            if ( count($dataset) > 0 ) {
                
                $hs_peramalan = [];
                if ( $tipe == "menyeluruh" ) {

                    for ( $i = 10; $i <= 90; $i += 10 ) {

                        $alpha = $i / 100;
                        $peramalan = $this->exponential_smoothing( $dataset, $alpha );

                        array_push( $hs_peramalan, $peramalan );
                    }
                } else {

                    $hs_peramalan = $this->exponential_smoothing( $dataset, $alpha );                    
                }
                
                

                
                
                $JSON_ENCODE = json_encode( $hs_peramalan, JSON_PRETTY_PRINT );

                $data = array(

                    'kode_barang'   => $kode_barang,
                    'timeframe'     => $timeframe,
                    'alpha'         => $alpha,
                    'tanggalawal'   => strtotime($date_start),
                    'tanggalakhir'  => strtotime($date_end),
                    'perhitungan'   => $JSON_ENCODE,
                    'tipe_peramalan'=> $tipe
                );

                $id_peramalan = $this->Peramalan_model->insert( $data );

                redirect( 'peramalan/hasil/'. $id_peramalan );
            } else {

                echo "Tidak dapat mengeksekusi peramalan, Data penjualan berdasarkan tanggal yang ditentukan, kosong";
            }
            








            // $dataset = [];
            // foreach ( $set_timeframe AS $isi ) {

            //     $start = date('Y-m-d', $isi[0]);
            //     $end = date('Y-m-d', $isi[1]);

                
            //     // echo $start.' '.$end;
            //     $query = $this->Penjualan_model->timeframe_penjualan( $start, $end, $kode_barang );

            //     if ( $query->num_rows() > 0 ) {

            //         foreach ( $query->result_array() AS $kolom ) {

            //             array_push( $dataset, array(

            //                 'bulan' => $kolom['tgl'],
            //                 'actual'=> $kolom['penjualan']
            //             ) );

            //             // echo $kolom['tgl'].'<br>';
            //         }
            //     }
            // }


            // // urutkan tanggal  
            // usort($dataset, array($this, 'date_compare'));

            
            // if ( count($dataset) > 0 ) {

            //     $peramalan = $this->exponential_smoothing( $dataset, $alpha );

            //      // header('Content-Type: json');
            //     $JSON_ENCODE = json_encode( $peramalan, JSON_PRETTY_PRINT );

            //     $data = array(

            //         'kode_barang'   => $kode_barang,
            //         'timeframe'     => $timeframe,
            //         'alpha'         => $alpha,
            //         'tanggalawal'   => strtotime($date_start),
            //         'tanggalakhir'  => strtotime($date_end),
            //         'perhitungan'   => $JSON_ENCODE
            //     );

            //     $id_peramalan = $this->Peramalan_model->insert( $data );

            //     redirect( 'peramalan/hasil/'. $id_peramalan );
            // } else {

            //     echo "Tidak dapat mengeksekusi peramalan, Data penjualan berdasarkan tanggal yang ditentukan, kosong";
            // }

            

        }




        public function hasil( $id_peramalan ) {

            $peramalan = $this->Peramalan_model->ambil_data_berdasarkan_id( $id_peramalan )->row_array();


            // ambil informasi kode barang berdasarkan "kode"
            $kode_barang = $peramalan['kode_barang'];
            $barang_detail = $this->Barang_m->get( $kode_barang )->row_array();

            // bedah data json
            $perhitungan = json_decode( $peramalan['perhitungan'] );


            $data = array(

                'peramalan'    => $peramalan,
                'barang'       => $barang_detail,
                'perhitungan'  => $perhitungan,
            );

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

                'bulan'     => "Hasil",
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
                'alpha'     => $alpha
            );

            return $data;
        }




        public function hapus( $id_peramalan ) {

            $this->Peramalan_model->hapus( $id_peramalan );
            redirect('peramalan/index');
        }



        // sorting date
        function date_compare($element1, $element2) {
            $datetime1 = strtotime($element1['bulan']);
            $datetime2 = strtotime($element2['bulan']);
            return $datetime1 - $datetime2;
        } 

        
    }