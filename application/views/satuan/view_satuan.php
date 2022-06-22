<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
				<div class="container">
					<!--begin::Notice-->
						
								<!--end::Notice-->
								<!--begin::Card-->
								<div class="card card-custom gutter-b">
									<div class="card-header  flex-wrap py-3">
										<div class="card-title " >
											<h3 class="card-label">Data Satuan
											<span class="d-block text-muted pt-2 font-size-sm"></span></h3>
										</div>
										<div class="card-toolbar">
											
											<!--begin::Button-->
											<a href="<?=site_url('satuan/tambah')?>" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo13/dist/assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>Tambah Data</a>
											<!--end::Button-->
											<!-- Button trigger modal -->
										
										</div>
									</div>
									
									<div class="card-body">
										<!--begin: Datatable-->
										<table class="table table-bordered table-checkable  " >
											<thead>
												<tr>
													<th>no</th>
													<th>Nama Satuan</th>
													<th>Tanggal Pembuatan</th>
													<th colspan="2">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php $no =1 ; 
                                                foreach($row->result() as $key => $data){?>
												<tr>
													<td><?=$no++?></td>
													<td><?=$data->nama_satuan?></td>
													<td><?=$data->tanggal_pembuatan?></td>
													<td class=" text-center" width="240px">
                                                        <a href="<?=site_url('satuan/edit/'.$data->id_satuan)?>" class= "btn btn-primary btn-xs">
                                                            <i class="fa fa-pencil-alt"> </i> Update
                                                          </a>
														  
                                                    </td>
                                                    <td class=" text-center" width="160px">
                                                    <form action="<?=site_url('satuan/del')?>" method="post">
                                                        <input type="hidden" name="id_satuan" value="<?=$data->id_satuan?>">
                                                         <button onclick="return confirm('apakah ada akan menghapus data?')" class= "btn btn-danger btn-xs">
                                                            <i class="fa fa-trash"> </i> Delete
                                                            </button>
													</td>
                                                    
                                               
                                                    
                                                    </form>
												</tr>
												
												<?php } ?>
											</tbody>
										</table>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
								
				</div>
							<!--end::Container-->
</div>
						<!--end::Entry-->