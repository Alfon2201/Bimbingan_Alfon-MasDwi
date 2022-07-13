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
                            <a href="<?php echo base_url('peramalan/tambah') ?>" class="btn btn-sm btn-primary">Tambah Baru</a><br>
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