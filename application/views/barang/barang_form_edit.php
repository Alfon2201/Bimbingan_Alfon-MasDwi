<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Notice-->
								
								<!--end::Notice-->
								<!--begin::Card-->
								<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">Edit Data User
											<span class="d-block text-muted pt-2 font-size-sm">Edit Data User </span></h3>
										</div>
										<div class="card-toolbar">
											
											<!--begin::Button-->
											<a href="<?=site_url('barang')?>" class="btn btn-warning btn-flat">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:<?php echo base_url() ?>assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>Back</a>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Datatable-->
                                       


                                    <div class="card card-custom">
                                        <div class="card-header">
                                             <h3 class="card-title">
                                                 Edit Data User
                                             </h3>
                                                <div class="card-toolbar">
                                                    <div class="example-tools justify-content-center">
                                                     <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                                     <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                                                    </div>
                                                </div>
                                        </div>
                                        <!--begin::Form-->

                                         <?php //echo validation_errors(); ?>
                                        <?php echo validation_errors()?>
                                        <form action="" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="hidden" name="kode_barang" value="<?=$row->kode_barang?>">
                                                <label>Kode Barang <span class="text-danger">*</span> </label>
                                                <input type="text" name="kode" value="<?=$this->input->post('kode')?? $row->kode_barang ?>" class="form-control">  
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Barang <span class="text-danger">*</span> </label>
                                                <input type="text" name="barang" value="<?=$this->input->post('nama_barang')?? $row->nama_barang?>" class="form-control">  
                                            </div>
                                            <div class="form-group">
                                                <label>Satuan </label>
                                                <select name="satuan" class="form-control">
                                                <?php foreach($row_satuan->result() as $key => $data){?>
                                                        <option value="<?= $data->id_satuan ?>"  <?php if ( $row->id_satuan == $data->id_satuan ) { echo 'selected="selected"'; }  ?>  ><?=$data->nama_satuan?></option>
                                                        <?php }?>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Stok Barang <span class="text-danger">*</span> </label>
                                                <input type="text" name="stok" value="<?=$this->input->post('stok')?? $row->stok?>" class="form-control">  
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Beli <span class="text-danger">*</span> </label>
                                                <input type="text" name="beli" value="<?=$this->input->post('beli')?? $row->harga_beli?>" class="form-control">  
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Jual <span class="text-danger">*</span> </label>
                                                <input type="text" name="jual" value="<?=$this->input->post('jual')?? $row->harga_jual?>" class="form-control">  
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="card-footer">
                                                    <button type="submit" class="btn btn-success mr-2" ><i class="fa fa-paper-plane"></i>Save</button>
                                                    <button type="Reset" class="btn btn-secondary">Reset</button>
                                                </div>
                                        </form>
                                    <!--end::Form-->
                                </div>
										
								</div>
								</div>
								<!--end::Card-->
								<!--begin::Card-->
								
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->