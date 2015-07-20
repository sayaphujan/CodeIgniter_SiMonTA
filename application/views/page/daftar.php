<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
                        <div class="box box-primary">
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM PENDAFTARAN</h3>
                                </div>
								<?php
								if($this->uri->segment(2)!= 'submit'){
									foreach($tapel->result() as $akad){
										$id 	= $akad->tapel_id;
										$ak 	= $akad->tapel_akad;
										$sm 	= $akad->tapel_semester;
										$numsm 	= '';
										$stat 	= '';
										$err	= '';
									}
								}else{
									$id 	= $id_ak;
									$ak 	= $aka;
									$sm 	= $smes;
									$numsm 	= $numsmest;
									$stat 	= $status;
									$err	= $error;
								}
								?>
								<?php echo $err; ?>
                                    <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('krs/submit');?>" method="POST" >    
									<input type="hidden" id="id_akad" name="id_akad" value="<?php echo $id; ?>">
											<div class="form-group">
												<label class="col-sm-2 control-label">Tahun Akademik</label>
												<div class="col-sm-8">
													<input name="akad" class="form-control" id="akad" type="text" readonly value="<?php echo $ak; ?>" />
												</div>
											</div>				
											<div class="form-group">
												<label class="col-sm-2 control-label">Semester</label>
												<div class="col-sm-8">
													<input name="stat_smester" class="form-control" id="stat_smester" type="text" readonly value="<?php echo $sm; ?>" />
												</div>
											</div>											
											<div class="form-group">
												<label class="col-sm-2 control-label">Semester</label>
												<div class="col-sm-8">
													<input name="smester" class="form-control" id="smester" type="text" value="<?php echo $numsm; ?>" />
												<span><?php echo form_error('smester'); ?></span>
												</div>
											</div>															
											<!--<div class="form-group">
												<label class="col-sm-2 control-label">Status</label>
												<div class="col-sm-8">
													<select class="form-control" name="tema">
														<option value="" selected>--Pilih Disini--</option>
														<option value='baru' >Baru</option>
														<option value='ulang' >Ulang</option>
													</select>
												</div>
											</div>-->
											<?php
												$ceknim = $this->session->userdata('nim');
												$this->db->select('jur_id');
												$this->db->where('mhs_nim',$ceknim);
												$mk = $this->db->get('mahasiswa');
												
												foreach($mk->result() as $matk){ $jid = $matk->jur_id;		}
											?>
											<div class="form-group">
											<label class="col-sm-2 control-label"></label>
												<div class="col-sm-8">
												<table class="table table-bordered table-hover">
													<thead>
														<th>NO</th>
														<th>MATA KULIAH</th>
														<th>SKS</th>
														<th>B/U</th>
													</thead>
													<tbody>
													<tr>
														<td>1</td>
														<td><?php if($jid=='1' || $jid=='2'){echo 'SKRIPSI';}else{ echo 'TUGAS AKHIR'; } ?></td>
														<td>6</td>
														<td>
															<select name="status">
																<option value="" <?php if($stat==''){echo 'selected';}?>>--Pilih Disini--</option>
																<option value='B' <?php if($stat=='B'){echo 'selected';}?>>Baru</option>
																<option value='U' <?php if($stat=='U'){echo 'selected';}?>>Ulang</option>
															</select>
														</td>
													</tr>
													</tbody>
												</table>
												<span><?php echo form_error('status'); ?></span>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-8">
													<button class="btn btn-primary btn-square">Daftar</button>
													<a href="<?=site_url('mahasiswa');?>" class="btn btn-warning btn-square">Kembali</a>
												</div>
											</div>
										</form>
                            </div>
							</div>