<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM DATA TEMA</h3>
                                </div>
								
                                <div class="the-box full">
                                    <form role="form" class="form-horizontal" action="<?=site_url('admin/tema/submit');?>" method="POST" >
                                    <?php
									if ($this->uri->segment(4)==""){
											$id		="";
											$tema	="";
									}
									else if ($this->uri->segment(4)!=""){
										foreach($tema->result() as $t){
											$id		=$t->tema_id;
											$tema	=$t->tema_nama;
										}
									}
									?>
									<input type="hidden" id="tema_id" name="tema_id" value="<?php echo $id; ?>" />
                                    <div class="form-group">
											<label class="col-sm-2 control-label">TEMA</label>
												<div class="col-sm-8">
													<input name="tema" class="form-control" id="tema" type="text" value="<?php echo $tema; ?>" />
													<span><?php echo form_error('tema'); ?></span>
												</div>
										</div>
									
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-8">
												<button class="btn btn-primary btn-square">Simpan</button>
												<a href="<?=site_url('admin/tema');?>" class="btn btn-warning btn-square">Kembali</a>
											</div>
										</div>
									</form>
								</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->