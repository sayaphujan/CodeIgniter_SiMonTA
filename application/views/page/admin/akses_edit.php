<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
                        <div class="box box-primary">
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM DATA AKSES DOSEN</h3>
                                </div>
                                <div class="the-box full">
                                    <form role="form" class="form-horizontal" action="<?=site_url('admin/akses/submit/'.$this->session->userdata('userid'));?>" method="POST" >                                    
									<input type="hidden" name="akses_id" id="akses_id">
											<div class="form-group">
												<label class="col-sm-2 control-label">Dosen</label>
												<div class="col-sm-8">
													<select class="form-control" name="pegawai">
													<option value="" selected>--Pilih Disini--</option>
												<?php
													foreach($pgw->result() as $d){
														$dos = $d->pgw_id;
													}
													foreach($pegawai->result() as $pgw){
														$m_id 	= $pgw->pgw_id;
														$m_nama = $pgw->pgw_nama;
															$pilih = ($dos==$m_id)?"selected" : "";
															echo "<option value='$m_id' $pilih>$m_nama</option>";
													}
												?>
													</select>
													<span><?php echo form_error('pegawai'); ?></span>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Level</label>
												<div class="col-sm-8">
													<?php 
													foreach($result as $key=>$_res){
													$checked = explode(',', $_res['namalevel']);
													$level = array("Administrator","Dosen Pembimbing","Ka. Prodi SI","Ka. Prodi TI","Ka. Prodi MI","Ka. Prodi KA");
													$val = array(2,4,10,11,12,13);
														for($i=0; $i<6; $i++) {
															$chk = in_array($val[$i],$checked)? "checked":"";
															echo "<input type='checkbox' name='level[]' value='$val[$i]' $chk>$level[$i]<br>";
														}
													}
													?>
													<span><?php echo form_error('level[]'); ?></span>
												</div>
												
											</div>
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-8">
													<button class="btn btn-primary btn-square">Simpan</button>
													<a href="<?=site_url('admin/akses');?>" class="btn btn-warning btn-square">Kembali</a>
												</div>
											</div>
										</form>
                            </div>
							</div>