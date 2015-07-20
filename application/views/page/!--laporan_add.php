						<ol class="breadcrumb">
							<li><a href="#fakelink">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>Input Laporan</h3>
						</div>
						
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('proposal/submit');?>" method="POST" >
								<input type="hidden" id="peng_id" name="peng_id"/>
								 <div class="form-group">
								<div class="form-group">
									<label class="col-sm-2 control-label">File</label>
									<div class="col-sm-8">
										<input name="userfile" id="fileInput" class="form-control" type="file" />
										<span><?php echo form_error('userfile'); ?></span>
									</div>
								</div>
								
								 <div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('laporan');?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
			
                

