<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
    
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card card-body">
                    <h4>Form Atribut Peramalan</h4>
                    <small>Isi form atribut peramalan dibawah ini</small>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <a href="<?php echo base_url('peramalan/tambah') ?>" class="btn btn-sm btn-primary">Tambah Baru</a><br> -->
                            <a href="javascript:;" class="btn btn-sm btn-primary" data-toggle="modal"
                            	data-target="#date">Tambah Baru</a><br>


                            <!-- Modal-->
                            <div class="modal fade" id="date" tabindex="-1" role="dialog"
                            	aria-labelledby="exampleModalLabel" aria-hidden="true">
                            	<div class="modal-dialog" role="document">
                            		<div class="modal-content">
                            			<div class="modal-header">
                            				<h5 class="modal-title" id="exampleModalLabel">Pilih Interval Waktu</h5>
                            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            					<i aria-hidden="true" class="ki ki-close"></i>
                            				</button>
                            			</div>
                                        <form action="<?php echo base_url('peramalan/tambah') ?>" method="GET">
                            			
                                        <div class="modal-body">

                            					<div class="row">
                            						<div class="col-md-12">
                            							<div class="form-group">
                            								<label for="">Interval Waktu Peramalan</label>
                            								<div class="input-daterange input-group" id="kt_datepicker_5">
                            									<input type="text" class="form-control" name="start" />
                            									<div class="input-group-append">
                            										<span class="input-group-text"><i
                            												class="la la-ellipsis-h"></i></span>
                            									</div>
                            									<input type="text" class="form-control" name="end" />
                            								</div>
                            							</div>
                            						</div>
                            					</div>
                                        </div>

                            			<div class="modal-footer">
                            				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
                            				<button type="submit" class="btn btn-primary font-weight-bold">Lanjut Pengaturan Peramalan</button>
                            			</div>
                                        </form>

                            		</div>
                            	</div>
                            </div>
                            <small>Klik untuk tambah baru</small>
                        </div>
                    </div>
                    <hr>

                   
                    <table class="table table-stripe">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Kode Barang</td>
                                <td>Timeframe</td>
                                <td>Alpha</td>
                                <td>Tanggal</td>
                                <td>Opsi</td>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ( $peramalan->result_array() AS $urutan => $isi ) : ?>
                            <tr>
                                <td><?php echo $urutan + 1 ?></td>
                                <td><?php echo $isi['kode_barang'] ?></td>
                                <td><?php echo $isi['timeframe'] ?></td>
                                <td>
                                    <?php
                                        if ( $isi['tipe_peramalan'] == "sebagian" ) {

                                            echo $isi['alpha'];
                                        } else {

                                            echo 'Menyeluruh 0 - 9';
                                        }
                                    ?>
                                </td>
                                <td><?php echo $isi['created_at'] ?></td>
                                <td>
                                    <a href="<?php echo base_url('peramalan/hapus/'. $isi['id_peramalan']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-sm btn-light-danger">Hapus</a>
                                    <a href="<?php echo base_url('peramalan/hasil/'. $isi['id_peramalan']) ?>" class="btn btn-sm btn-warning">Lihat lebih lanjut</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
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