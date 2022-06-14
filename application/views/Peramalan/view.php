<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
							    <div class="card card-custom">
                                        
                                        <!--begin::Form-->

                                         <?php //echo validation_errors(); ?>
                                        <?php echo validation_errors()?>
                                        <form action="" method="post">
                                        

                                            <div class="card-body col-lg-6 ">
                                            <label>Pilih Barang <span class="text-danger">*</span> </label>
                                                <select name="barang" class="form-control ">
                                                    <option value="beras">...............</option>
                                                </select>
                                                </div>

                                                <div class=" card-body col-lg-6">
                                                <label>Waktu Peramalan<span class="text-danger">*</span> </label>
                                                <select name="peramalan" class="form-control ">
                                                    <option value="">pilih</option>
                                                    <option value="week">Mingguan</option>
                                                    <option value="2 week">2 minggu</option>
                                                    <option value="month">1 Bulan</option>
                                                </select>
                                                </div>

                                                
                                            
                                        </div>
                                        <div class="card-footer">
                                                    <button type="submit" class="btn btn-success mr-2" ><i class="fa fa-paper-plane"></i>Hitung/Peramalan</button>
                                                    
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