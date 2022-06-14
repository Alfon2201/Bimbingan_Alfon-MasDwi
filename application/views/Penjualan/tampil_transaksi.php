<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Notice-->
								
								<!--end::Notice-->
								<!--begin::Card-->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <a href="<?= base_url();?>penjualan" class="btn btn-theme04" >Kembali</a>
                                        <a href="<?= base_url('Transaksi/pdf_detail/' ) ?>" class="btn btn-theme"><i class="fa fa-file-pdf"></i><b>Download </b></a>
                                    
                                    </div>
                                    </div>
								<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
                                    <div class="breadcrumb mb-4">
                                        <div class="row">
                                   
                                            <div class="col-md-4">
                                                <h3>Toko Agung</h3>
                                                Jl. Tumpang <br>
                                                Telp. 0812-8631-3688
                                            </div>
                                            <table style="width: 300px;">                        
                                                    <tr>
                                                        <td>
                                                            <h4>No Transaksi</h4>
                                                        </td>
                                                        <td>
                                                            <h4>:</h4>
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h4>Tanggal</h4>
                                                        </td>
                                                        <td>
                                                            <h4>:</h4>
                                                        </td>
                                                        
                                                    </tr>
                                            </table>
                                        </div>
                    
									</div>
                                    </div>
									<div class="card-body">
										<!--begin: Datatable-->
                                        
                                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                                       <thead>
												<tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Sub Total</th>
												</tr>
                                                
											</thead>
											<tbody>
                                            <?php $no =1 ; 
                                                foreach($row_barang->result() as $key => $data){?>
												<tr>
													<td><?=$no++?></td>
													<td><?=$data->nama_barang?></td>
													<td><?=$data->nama_satuan?></td>
													<td><?=$data->harga_jual?></td>
                                                    <td><?=$row->permintaan?></td>
                                                    

												</td>
													
                                                   
                                                    
													
												</tr>
												<?php }?>
											</tbody>
										</table>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
								<!--begin::Card-->
								
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->