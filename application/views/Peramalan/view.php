<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
    
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card card-body">
                    <h4>Form Atribut Peramalan</h4>
                    <small>Isi form atribut peramalan dibawah ini</small>

                    <hr>

                    <form action="<?php echo base_url('peramalan/proses') ?>" method="POST">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label for="">Interval Waktu Peramalan</label>
                                	<div class="input-daterange input-group" id="kt_datepicker_5">
                                		<input type="text" class="form-control" name="start" />
                                		<div class="input-group-append">
                                			<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                		</div>
                                		<input type="text" class="form-control" name="end" />
                                	</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Timeframe</label>
                                    <select name="timeframe" class="form-control" id="">
                                        <option value="week">Mingguan</option>
                                        <option value="2 week">2 Minggu</option>
                                        <option value="month">1 Bulan</option>
                                    </select>
                                    <small>Timeframe waktu peramalan</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Barang</label>
                                    <select name="kode_barang" class="form-control" id="">
                                        <?php foreach ( $barang AS $brg ) : ?>
                                        <option value="<?php echo $brg['kode_barang'] ?>"><?php echo $brg['kode_barang'].' '.$brg['nama_barang'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small>Pilih barang</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Alpha</label>
                                    <input type="text" name="alpha" class="form-control">
                                    <small>Pilih barang</small>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="<?php echo base_url() ?>" class="btn btn-default btn-sm">Batal</a>
                                    <button class="btn btn-primary btn-sm">Proses perhitungan</button>
                                </div>
                            </div>
                        </div>

                    </form>
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