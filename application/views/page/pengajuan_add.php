<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
                        <div class="box box-primary">
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM DATA PENGAJUAN JUDUL</h3>
                                </div>
								
                                    <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('pengajuan/submit');?>" method="POST" >                                    
									<input type="hidden" name="peng_id" id="peng_id">
									<input type="hidden" name="act" id="act" value='add'>
											<div class="form-group">
												<label class="col-sm-2 control-label">Tema</label>
												<div class="col-sm-8">
													<select class="form-control" name="tema">
																	<option value="" selected>--Pilih Disini--</option>
																	<?php 
																			foreach($tema->result() as $tm){
																			$t_id = $tm->tema_id;
																			$t_nama = $tm->tema_nama;
																				echo "<option value='$t_id' >$t_nama</option>";
																			}
																	?>
													</select>
													<span><?php echo form_error('tema'); ?></span>
												</div>
												
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Judul</label>
												<div class="col-sm-8">
													<input name="judul" class="form-control" id="judul" type="text" />
													<span><?php echo form_error('judul'); ?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Latar Belakang</label>
												<div class="col-sm-8">
													<textarea name="label" id="label" rows="7" class="form-control" placeholder="br"> </textarea>
													<span><?php echo form_error('label'); ?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Metode Pengembangan</label>
												<div class="col-sm-8">
													<input name="metopen" class="form-control" id="metopen" type="text" />
													<span><?php echo form_error('metopen'); ?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Gambaran Input</label>
												<div class="col-sm-8">
													<textarea name="ginput" id="ginput" rows="7" class="form-control"> </textarea>
													<span><?php echo form_error('ginput'); ?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Gambaran Output</label>
												<div class="col-sm-8">
													<textarea name="goutput" id="goutput" rows="7" class="form-control"> </textarea>
													<span><?php echo form_error('goutput'); ?></span>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-8">
													<button class="btn btn-primary btn-square">Simpan</button>
													<a href="<?=site_url('pengajuan');?>" class="btn btn-warning btn-square">Kembali</a>
												</div>
											</div>
										</form>
                            </div>
							</div>