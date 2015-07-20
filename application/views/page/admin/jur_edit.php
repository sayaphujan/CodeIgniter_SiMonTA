<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM DATA JURUSAN</h3>
                                </div>
								
                                <div class="the-box full">
                                    <form role="form" class="form-horizontal" action="<?=site_url('admin/jurusan/submit');?>" method="POST" >
                                    <?php
									if ($this->uri->segment(4)==""){
											$id				="";
											$jurusan		="";
									}
									else if ($this->uri->segment(4)!=""){
										foreach($jurusan->result() as $jur){
											$id				=$jur->jur_id;
											$jurusan		=$jur->jur_nama;
										}
									}
									?>
									<input type="hidden" id="jur_id" name="jur_id" value="<?php echo $id; ?>" />
                                    <div class="form-group">
											<label class="col-sm-2 control-label">JURUSAN</label>
												<div class="col-sm-8">
													<input name="jurusan" class="form-control" id="jurusan" type="text" value="<?php echo $jurusan; ?>" />
													<span><?php echo form_error('jurusan'); ?></span>
												</div>
										</div>

										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-8">
												<button class="btn btn-primary btn-square">Simpan</button>
												<a href="<?=site_url('admin/jurusan');?>" class="btn btn-warning btn-square">Kembali</a>
											</div>
										</div>
									</form>
								</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->