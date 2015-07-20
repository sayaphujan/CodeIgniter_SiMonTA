<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
                        <div class="box box-primary">
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM DATA KONSENTRASI</h3>
                                </div>
								
                                <div class="the-box full">
                                    <form role="form" class="form-horizontal" action="<?=site_url('admin/konsentrasi/submit');?>" method="POST" >                                    
									<?php
									if($this->uri->segment(3)=="submit"){
										$id 	= $idkon;
										$kons	= $konsen;
									}else{
										foreach ($konsentrasi->result() as $kon){
											$id = $kon->kon_id;
											$kons = $kon->kon_nama;
										}
									}
									?>
									<input type="hidden" id="kon_id" name="kon_id" value="<?php echo $id; ?>" />
											<div class="form-group">
												<label class="col-sm-2 control-label">Jurusan</label>
												<div class="col-sm-8">
													<select class="form-control" name="jurusan">
																	<option value="" selected>--Pilih Disini--</option>
																	<?php 
																			foreach($jurusan->result() as $jur){
																				$j_id = $jur->jur_id;
																				$j_nama = $jur->jur_nama;
																				foreach($konsentrasi->result() as $kon){
																					if($this->uri->segment(3)=="submit"){
																						$pilih = ($juru==$j_id)?"selected" : "";
																					}else{
																						$pilih = ($kon->jur_id == $jur->jur_id)?"selected" : "";
																					}
																				echo "<option value='$j_id' $pilih>$j_nama</option>";
																				}
																			}
																	?>
													</select>
													<span><?php echo form_error('jurusan'); ?></span>
												</div>
												
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Konsentrasi</label>
												<div class="col-sm-8">
													<input name="konsentrasi" class="form-control" id="konsentrasi" type="text" value="<?php echo $kons; ?>" />
													<span><?php echo form_error('konsentrasi'); ?></span>
												</div>
											</div>
                                
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-8">
													<button class="btn btn-primary btn-square">Simpan</button>
													<a href="<?=site_url('admin/konsentrasi');?>" class="btn btn-warning btn-square">Kembali</a>
												</div>
											</div>
										</form>
                            </div>
							</div>