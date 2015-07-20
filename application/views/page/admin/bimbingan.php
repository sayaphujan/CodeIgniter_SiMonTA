			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM BIMBINGAN</h3>
						</div>
						<?php
						$pengid = $this->uri->segment(5);
							foreach($bimbingan->result() as $key){
								$lapid 		= $key->lap_id;
								$mhs		= $key->mhs_id;
								$katlap 	= $key->kat_lap_id;
								$bimid		= $key->bim_id;
								$koment 	= $key->bimb_komentar;
								$stat 		= $key->bimb_status;
							}
						?>
						<div class="the-box full">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/bimbingan/submit');?>" method="POST" >
								<input type="hidden" id="pengid" name="pengid" value="<?php echo $pengid; ?>" />
								<input type="hidden" id="bimid" name="bimid" value="<?php echo $bimid; ?>" />
								<input type="hidden" id="lapid" name="lapid" value="<?php echo $lapid; ?>" />
								<input type="hidden" id="katlap" name="katlap" value="<?php echo $katlap; ?>" />
								<input type="hidden" id="mhs" name="mhs" value="<?php echo $mhs; ?>" />
								<div class="form-group">
									<label class="col-sm-2 control-label">Bimbingan</label>
									<div class="col-sm-8">
										<textarea name="komentar" id="komentar" rows="7" class="form-control" <?php if($key->bimb_komentar=="Tak ada Komentar"){echo "placeholder='$key->bimb_komentar'";} ?>><?php if($key->bimb_komentar!="Tak ada Komentar"){echo $key->bimb_komentar;} ?></textarea>
										<span><?php echo form_error('komentar'); ?></span>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Revisi (maks. 5MB)</label>
									<div class="col-sm-8">
										<input name="userfile" id="fileInput" type="file" class="form-control" />
										<?php if ($this->uri->segment(3)=="submit"){ ?>
										<span><?php echo $error; ?></span>
										<?php } ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Status</label>
									<div class="col-sm-8">
										<input name="status" id="status" type="radio" value="ACC" <?php	if($stat=="REVISI"){echo "checked";}?> /> ACC
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input name="status" id="status" type="radio" value="REVISI" <?php	if($stat!="REVISI"){echo "checked";}?>/> Revisi
									</div>
								</div>
								<tr>
								 <div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
										<a href="<?=site_url('admin/bimbingan/detail/'.$mhs.'/'.$pengid);?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->

                