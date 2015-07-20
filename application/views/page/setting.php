<?php
	foreach($mahasiswa->result() as $row){
		$noid			=$row->mhs_id;
		$pass			=$row->mhs_pass;
	}
?>
			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
									
						
<div class="box box-primary">
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">SETTING</h3>
                                </div>
<?php echo $error ?>
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('setting/submit');?>" method="POST" >
								<input type="hidden" id="mhs_id" name="mhs_id" value="<?php echo $noid; ?>" />
								<input name="pass" id="pass" type="hidden" value="<?php echo $pass; ?>" />
								<div class="form-group">
									<label class="col-sm-3 control-label">Password Lama</label>
									<div class="col-sm-8">
										<input name="pass1" class="form-control" id="pass1" type="password" value="<?php echo $p1; ?>" />
										<span><?php echo form_error('pass1'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Password Baru</label>
									<div class="col-sm-8">
										<input name="pass2" class="form-control" id="pass2" type="password" value="<?php echo $p2; ?>" />
										<span><?php echo form_error('pass2'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Password Baru (Ulangi)</label>
									<div class="col-sm-8">
										<input name="pass3" id="pass3" class="form-control" type="password" value ="<?php echo $p3; ?>" />
										<span><?php echo form_error('pass3'); ?></span>
									</div>
								</div>
								<div class="form-group">
												<div class="col-sm-offset-2 col-sm-8">
													<button class="btn btn-primary btn-square">Simpan</button>
													<a href="<?=site_url();?>" class="btn btn-warning btn-square">Kembali</a>
												</div>
											</div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->