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
                            
                            <form action="<?php echo base_url('penjualan/simpan_penjualan') ?>" method="post">
                            

                            <input type="hidden" name="kd_order" value="<?php echo $kd_order ?>">
                            <input type="hidden" name="tanggal" value="<?php echo $tanggal ?>">

                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">
                                <a href="<?php echo base_url('penjualan/index') ?>" class="btn btn-light-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                    </span>Kembali</a>

                                <button class="btn btn-success">Tambahkan dan Simpan</button>
                            
                            </div>
                            <!--end::Dropdown-->

                            </form>
                        </div>
                    </div>
                    <div class="card-body">


                        
                        <div class="row">
                            <div class="col-md-4">
                                <small>Kode Penjualan</small>
                                <h2><?php echo $kd_order ?></h2>
                            </div>
                            <div class="col-md-4">
                                <small>Operator</small>
                                <h2><?php echo $user['nama'] ?></h2>
                            </div>
                            <div class="col-md-4">
                                <small>Tanggal Transaksi</small>
                                <h2><?php echo $tanggal ?></h2>
                            </div>
                        </div>

                        <hr>


                        <form action="<?php echo base_url('penjualan/add_cart') ?>" method="post">


                        <input type="hidden" name="kd_order" value="<?php echo $kd_order ?>">
                        <input type="hidden" name="tgl" value="<?php echo $tanggal ?>">


                        <div class="row">
                            <div class="col-md-4" style="border-right: 1px solid #e0e0e0">
                                <div class="form-group">
                                    <small>Informasi Nama Barang</small>
                                    <select class="form-control select2" id="kt_select2_1" name="kode_barang">
                                        <?php foreach ( $barang->result_array() As $isi ) : ?>
                                        <option value="<?php echo $isi['kode_barang'].'-'.$isi['nama_barang'] ?>"><?php echo $isi['kode_barang'].' '.$isi['nama_barang'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <small>Jumlah Permintaan</small>
                                    <input type="number" name="jumlah" class="form-control" placeholder=". . ." />
                                    <small>Masukkan jumlah</small>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-block btn-light-success">Tambahkan</button>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <table class="table table-hover">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php if ( count($this->cart->contents()) > 0 ) {
                                        
                                        $nomor = 1;
                                        foreach ( $this->cart->contents() AS $index => $isi ) :
                                    ?>
                                    <tr>
                                        <td><?php echo $nomor ?></td>
                                        <td><?php echo $isi['name'] ?></td>
                                        <td><?php echo $isi['qty'] ?></td>
                                        <td><?php echo number_format($isi['price'], 2) ?></td>
                                        <td>
                                            <a href="<?php echo base_url('penjualan/remove/'. $isi['rowid'].'?kd_order='. $kd_order.'&tgl='.$tanggal ) ?>" class="btn btn-sm btn-light-danger">x</a>
                                        </td>
                                    </tr>
                                    <?php 

                                        $nomor++;
                                    endforeach; } else { ?>

                                    <tr>
                                        <td colspan="5">
                                            <b>Kosong</b><br>
                                            <small>Silahkan tambahkan barang transaksi</small>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>


                        </form>


                        <!-- <div class="form-group">
                            <button class="btn btn-warning">Lanjut Detail Penjualan</button>
                        </div> -->

                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
		




	</div>
</div>