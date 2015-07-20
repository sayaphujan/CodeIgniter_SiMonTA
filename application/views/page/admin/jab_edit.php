<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->

                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM DATA JABATAN</h3>
                                </div>
								
                                <div class="the-box full">
                                    <form role="form" class="form-horizontal" action="<?=site_url('admin/jabatan/submit');?>" method="POST" >
                                    <?php
									if ($this->uri->segment(4)==""){
											$id				="";
											$jabatan		="";
									}
									else if ($this->uri->segment(4)!=""){
										foreach($jabatan->result() as $jab){
											$id				=$jab->jab_id;
											$jabatan		=$jab->jab_nama;
										}
									}
									?>
									
                                    <div class="form-group">
									<input type="hidden" id="jab_id" name="jab_id" value="<?php echo $id; ?>" />
											<label class="col-sm-2 control-label">JABATAN</label>
												<div class="col-sm-8">
													<input name="jabatan" class="form-control" id="jabatan" type="text" value="<?php echo $jabatan; ?>" />
													<span><?php echo form_error('jabatan'); ?></span>
												</div>
										</div>

										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-8">
												<button class="btn btn-primary btn-square">Simpan</button>
												<a href="<?=site_url('admin/jabatan');?>" class="btn btn-warning btn-square">Kembali</a>
											</div>
										</div>
									</form>
								</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->			
	