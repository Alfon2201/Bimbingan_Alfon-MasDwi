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
                                
                                foreach ( $perhitungan->hasil_perhitungan AS $isi ) : 


                                    $waktu = "-";
                                    $actual = "-";

                                    if ( $isi->bulan != "Hasil" ) {

                                        $waktu = date('d-m-Y', strtotime($isi->bulan));
                                        $actual = $isi->actual;
                                    }
                                
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
                            <h4>Hasil Akhir</h4>
                            <small>Sehingga pada peramalan disamping menghasilkan nilai akhir (MAPE) sebagaimana berikut ini</small>

                            <br><br>
                                    
                            <small><b>MAPE</b></small>
                            <h1><?php echo number_format($perhitungan->avg_mape, 2) ?>%</h1>
                        </div>
                    </div>
                    

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