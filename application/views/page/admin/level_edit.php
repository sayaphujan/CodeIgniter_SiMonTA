<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
<div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM DATA LEVEL</h3>
                                </div>
								
                                <div class="the-box full">
                                    <form role="form" class="form-horizontal" action="<?=site_url('admin/level/submit');?>" method="POST" >
                                    <?php
									if ($this->uri->segment(4)==""){
											$id				="";
											$level		="";
									}
									else if ($this->uri->segment(4)!=""){
										foreach($level->result() as $lvl){
											$id			=$lvl->level_id;
											$level		=$lvl->level_name;
										}
									}
									?>
									<input type="hidden" id="level_id" name="level_id" value="<?php echo $id; ?>" />
                                    <div class="form-group">
											<label class="col-sm-2 control-label">LEVEL</label>
												<div class="col-sm-8">
													<input name="level" class="form-control" id="level" type="text" value="<?php echo $level; ?>" />
													<span><?php echo form_error('level'); ?></span>
												</div>
										</div>
									
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-8">
												<button class="btn btn-primary btn-square">Simpan</button>
												<a href="<?=site_url('admin/level');?>" class="btn btn-warning btn-square">Kembali</a>
											</div>
										</div>
									</form>
								</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->