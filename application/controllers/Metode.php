<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Metode extends CI_Controller {


        public function __construct() {

            parent::__construct();

            // load model 
            $this->load->model('Penjualan_model');
        }
    
        public function index(){
        
            
            /** Dataset */
            $dataPenjualan = array();

            // dummy : percobaan
            array_push($dataPenjualan, ['bulan' => 'Januari', 'actual' => 4448]);
            array_push($dataPenjualan, ['bulan' => 'Februari', 'actual' => 4490]);
            array_push($dataPenjualan, ['bulan' => 'Maret', 'actual' => 4714]);
            array_push($dataPenjualan, ['bulan' => 'April', 'actual' => 4670]);
            array_push($dataPenjualan, ['bulan' => 'Mei', 'actual' => 4752]);
            array_push($dataPenjualan, ['bulan' => 'Juni', 'actual' => 4657]);
            array_push($dataPenjualan, ['bulan' => 'Juli', 'actual' => 4699]);
            array_push($dataPenjualan, ['bulan' => 'Agustus', 'actual' => 4654]);
            array_push($dataPenjualan, ['bulan' => 'September', 'actual' => 4538]);
            array_push($dataPenjualan, ['bulan' => 'Oktober', 'actual' => 4438]);
            array_push($dataPenjualan, ['bulan' => 'November', 'actual' => 4595]);



            // hasil perhitungan
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.1 );
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.2 );
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.3 );
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.4 );
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.5 );
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.6 );
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.7 );
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.8 );
            $hasil = $this->exponential_smoothing( $dataPenjualan, 0.9 );
            
        }



        public function uji() {

            $timeframe = "month"; /** week | 2 week | 1 month */ 
            
            $start = "2019-01-01";
            $end = "2019-03-01";

            /**
             * Undocumented function
             *
             * @param [string] $timeframe = untuk mengidentifikasi timeframe yang digunakan
             * @param [year-month] $start_month | $end_month = untuk melihat interval waktu yang akan dilakukan peramalan
             * 
             * // TODO 
             * 1. ambil data start date of month pada variabel start month
             * 2. ambil data end date of month pada variabel end month
             * 
             *  1.1 ambil data timeframe
             *      A. apabila timeframe yang diambil : week 
             *          
             *          
             */

            

            // convert to string
            $start_string = strtotime( $start );
            $end_string = strtotime( $end );


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
                $query = $this->Penjualan_model->timeframe_penjualan( $start, $end );

                if ( $query->num_rows() > 0 ) {

                    foreach ( $query->result_array() AS $kolom ) {

                        array_push( $dataset, array(

                            'bulan' => $kolom['tgl'],
                            'actual'=> $kolom['penjualan']
                        ) );
                    }
                }

                // print_r( $query->result_array() );
                // echo '<hr>';
            }



            $hitung = $this->exponential_smoothing( $dataset, 0.1 );
            $hitung = $this->exponential_smoothing( $dataset, 0.2 );
            $hitung = $this->exponential_smoothing( $dataset, 0.3 );
            $hitung = $this->exponential_smoothing( $dataset, 0.4 );
            $hitung = $this->exponential_smoothing( $dataset, 0.5 );
            $hitung = $this->exponential_smoothing( $dataset, 0.6 );
            $hitung = $this->exponential_smoothing( $dataset, 0.7 );
            $hitung = $this->exponential_smoothing( $dataset, 0.8 );
            $hitung = $this->exponential_smoothing( $dataset, 0.99 );



            // echo date('Y-m-d', strtotime("monday this week", strtotime("2022-01-10")));

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
                


                echo 'bulan ' . $isi['bulan'].' = '. $isi['actual'].' | Ft = '. $Ft;
                echo '<br>';
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
            echo "Hasil Peramalan FT : ". $Ft;

            echo '<hr>';




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

                    echo 'Bulan '. $index.' mad : '. $MAD.' mse : '. $MSE.' mape : '. $MAPE;
                    echo '<br>';
                }
            }

            echo '<hr>';

            $total = count($dataset);
            $avg_mad = $total_mad / $total;
            $avg_mse = $total_mse / $total;
            $avg_mape = $total_mape / $total;


            echo '<h2>Sehingga Nilai Alpha '.$alpha.' memiliki hasil berikut</h2>';
            echo '<h4>MAD : '.$avg_mad.'</h4>';
            echo '<h4>MSE : '.$avg_mse.'</h4>';
            echo '<h4>MAPE : '.$avg_mape.'</h4>';



            echo '<hr>';

        }





    
    
    }
    
    /* End of file Metode.php */
    