<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		

        <div class="row justify-content-center">
            <div class="col-md-8">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Penjualan
                                <span class="d-block text-muted pt-2 font-size-sm">Informasi data penjualan</span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">
                                <a href="<?php echo base_url('penjualan/inde') ?>" class="btn btn-light-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                    </span>Kembali</a>
                            
                            </div>
                            <!--end::Dropdown-->
                        </div>
                    </div>
                    <div class="card-body">


                        <form action="<?php echo base_url('penjualan/tambah_detail') ?>" method="GET">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <small>Tanggal Terkini</small>
                                <h2><?php echo date('d F Y H.i A') ?></h2>
                            </div>
                            <div class="col-md-6">
                                <small>Operator</small>
                                <h2><?php echo $user['nama'] ?></h2>
                            </div>
                        </div>

                        <hr>


                        <div class="form-group">
                            <label for="">Kode Penjualan <small>(Otomatis)</small></label>
                            <input type="text" name="kd_order" class="form-control" value="<?php echo strtoupper(uniqid()) ?>" readonly>
                            <small>Kode penjualan otomatis</small>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="">Tanggal Transaksi</label>
                            <input type="date" name="tgl" class="form-control" value="<?php echo date('Y-m-d') ?>">
                            <small>Tanggal transaksi</small>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-warning">Lanjut Detail Penjualan</button>
                        </div>

                        </form>
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
		




	</div>
</div>