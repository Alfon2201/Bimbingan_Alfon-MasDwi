<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
    
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-body">
                    <h4>Form Atribut Peramalan</h4>
                    <small>Isi form atribut peramalan dibawah ini</small>

                    <hr>

                    <script>
                        // Shared Colors Definition
                        const primary = '#6993FF';
                        const success = '#1BC5BD';
                        const info = '#8950FC';
                        const warning = '#FFA800';
                        const danger = '#F64E60';
                    </script>



                    <?php if ( $peramalan['tipe_peramalan'] == "sebagian" ) { ?>
                    
                    <div class="row">
                        <div class="col-md-4">

                            <label for="">Interval Waktu</label><br>
                            <b><?php echo date('d M Y', $peramalan['tanggalawal']) ?> &emsp;s/d&emsp; <?php echo date('d M Y', $peramalan['tanggalakhir']) ?></b>
                        </div>
                        <div class="col-md-2">

                            <label for="">Alpha</label>
                            <h2><?php echo $peramalan['alpha'] ?></h2>
                        </div>
                        <div class="col-md-3">

                            <label for="">Timeframe</label>
                            <h2><?php echo $peramalan['timeframe'] ?></h2>
                        </div>
                        <div class="col-md-3">

                            <label for="">Pembuatan</label>
                            <h2><?php echo date('d M Y', strtotime( $peramalan['created_at'] )) ?></h2>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            Peramalan dari Kode Barang "<b><?php echo $barang['kode_barang'].' - '. $barang['nama_barang'] ?></b>"<br>
                            <small>Berikut adalah data riwayat peramalan yang sudah dihitung</small>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-8" style="border-right: 1px solid #e0e0e0">
                            <table class="table table-stripe">
                                <tr>
                                    <td>#</td>
                                    <td>Waktu</td>
                                    <td>Actual</td>
                                    <td>Forecast</td>
                                </tr>
                                <?php $urutan = 1; 
                                
                                $dt_actual = [];
                                $dt_forecasting = [];
                                $dt_tgl = [];
                                foreach ( $perhitungan->hasil_perhitungan AS $index_ft => $isi ) : 


                                    $waktu = "-";
                                    $actual = "-";


                                    

                                    if ( $isi->bulan != "Hasil" ) {

                                        $waktu = date('d-m-Y', strtotime($isi->bulan));
                                        $actual = $isi->actual;

                                        array_push( $dt_actual, $actual );
                                        array_push( $dt_tgl, $isi->bulan );
                                    } else {
                                        
                                        // array_push( $dt_tgl, $dt_tgl[$index_ft - 1] );
                                    }
                                    

                                    array_push( $dt_forecasting, number_format($isi->forecast, 2) );
                                
                                ?>
                                <tr>
                                    <td><?php echo $urutan ?></td>
                                    <td><?php echo $waktu ?></td>
                                    <td><?php echo $actual ?></td>
                                    <td><?php echo number_format($isi->forecast, 2) ?></td>
                                </tr>
                                <?php 
                            
                            
                                    
                                    $urutan++;
                                    endforeach; ?>
                            </table>
                        </div>
                        <div class="col-md-4">
                            
                            <!--begin::Chart-->
							<div id="chart_2"></div>
							<!--end::Chart-->

                            <hr>


                            <h4>Hasil Akhir</h4>
                            <small>Sehingga pada peramalan disamping menghasilkan nilai akhir (MAPE) sebagaimana berikut ini</small>

                            <br><br>
                                    
                            <small><b>MAPE</b></small>
                            <h1><?php echo number_format($perhitungan->avg_mape, 2) ?>%</h1>

                            
                            

                            <script>

                                "use strict";

                               

                                var KTApexChartsDemo = function () {
	                                // Private functions

                                    var chart = function () {
                                        const apexChart = "#chart_2";
                                        var options = {
                                            series: [{
                                                name: 'Actual',
                                                data: [<?php echo implode(",", $dt_actual) ?>]
                                            }, {
                                                name: 'Forecast',
                                                data: [<?php echo implode(",", $dt_forecasting) ?>]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area'
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth'
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: [<?php 
                                                
                                                    foreach ( $dt_tgl AS $tgl ) {

                                                        echo '"'.$tgl.'",';
                                                    }
                                                ?>]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            },
                                            colors: [primary, success]
                                        };

                                        var chart = new ApexCharts(document.querySelector(apexChart), options);
                                        chart.render();
                                    }


                                    return {
                                        // public functions
                                        init: function () {
                                            
                                            chart();
                                        }
                                    };
                                }();
                                
                                $(function() {

                                    KTApexChartsDemo.init();
                                })
                            </script>
                        </div>
                    </div>
                    
                    <?php } else { ?>

                        <?php
                            
                            foreach ( $perhitungan AS $index => $hs_peramalan ) :    
                        ?>
                    <div class="row">
                        <div class="col-md-4">

                            <label for="">Interval Waktu</label><br>
                            <b><?php echo date('d M Y', $peramalan['tanggalawal']) ?> &emsp;s/d&emsp; <?php echo date('d M Y', $peramalan['tanggalakhir']) ?></b>
                        </div>
                        <div class="col-md-2">

                            <label for="">Alpha</label>
                            <h2><?php echo $hs_peramalan->alpha ?></h2>
                        </div>
                        <div class="col-md-3">

                            <label for="">Timeframe</label>
                            <h2><?php echo $peramalan['timeframe'] ?></h2>
                        </div>
                        <div class="col-md-3">

                            <label for="">Pembuatan</label>
                            <h2><?php echo date('d M Y', strtotime( $peramalan['created_at'] )) ?></h2>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            Peramalan dari Kode Barang "<b><?php echo $barang['kode_barang'].' - '. $barang['nama_barang'] ?></b>"<br>
                            <small>Berikut adalah data riwayat peramalan yang sudah dihitung</small>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-8" style="border-right: 1px solid #e0e0e0">
                            <table class="table table-stripe">
                                <tr>
                                    <td>#</td>
                                    <td>Waktu</td>
                                    <td>Actual</td>
                                    <td>Forecast</td>
                                </tr>
                                <?php $urutan = 1; 

                                $dt_actual = [];
                                $dt_forecasting = [];
                                
                                foreach ( $hs_peramalan->hasil_perhitungan AS  $isi ) : 


                                    $waktu = "-";
                                    $actual = "-";

                                    if ( $isi->bulan != "Hasil" ) {

                                        $waktu = date('d-m-Y', strtotime($isi->bulan));
                                        $actual = $isi->actual;

                                        array_push( $dt_actual, $actual );
                                    }


                                    array_push( $dt_forecasting, number_format($isi->forecast, 2) );
                                
                                ?>
                                <tr>
                                    <td><?php echo $urutan ?></td>
                                    <td><?php echo $waktu ?></td>
                                    <td><?php echo $actual ?></td>
                                    <td><?php echo number_format($isi->forecast, 2) ?></td>
                                </tr>
                                <?php 
                            
                            
                                    
                                    $urutan++;
                                    endforeach; ?>
                            </table>
                        </div>
                        <div class="col-md-4">


                            <!--begin::Chart-->
							<div id="chart_2-<?php echo $index ?>"></div>
							<!--end::Chart-->


                            <h4>Hasil Akhir</h4>
                            <small>Sehingga pada peramalan disamping menghasilkan nilai akhir (MAPE) sebagaimana berikut ini</small>

                            <br><br>
                                    
                            <small><b>MAPE</b></small>
                            <h1><?php echo number_format($hs_peramalan->avg_mape, 2) ?>%</h1>



                            <script>

                                // "use strict";
                                var KTApexChartsDemo = function () {
	                                // Private functions

                                    var chart = function () {
                                        const apexChart = "#chart_2-<?php echo $index ?>";
                                        var options = {
                                            series: [{
                                                name: 'Actual',
                                                data: [<?php echo implode(",", $dt_actual) ?>]
                                            }, {
                                                name: 'Forecast',
                                                data: [<?php echo implode(",", $dt_forecasting) ?>]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area'
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth'
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            },
                                            colors: [primary, success]
                                        };

                                        var chart = new ApexCharts(document.querySelector(apexChart), options);
                                        chart.render();
                                    }


                                    return {
                                        // public functions
                                        init: function () {
                                            
                                            chart();
                                        }
                                    };
                                }();
                                
                                // $(function() {

                                //     setTimeout(KTApexChartsDemo.init(), 1500 + (<?php echo $index + 10 ?>));
                                // })
                            </script>
                        </div>
                    </div>

                    <hr>


                        <?php endforeach; ?>

                    <?php } ?>

                </div>
            </div>
        </div>

	</div>

</div>
</div>
<!--begin::Card-->

<!--end::Card-->
</div>
<!--end::Container-->
</div>
<!--end::Entry-->