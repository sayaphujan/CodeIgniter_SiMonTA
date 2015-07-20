			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">kriteria nilai <?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM KRITERIA NILAI SIDANG</h3>
						</div>
						<?php
						if ($this->uri->segment(3)=='editkriteria'){
							foreach($kriteria->result() as $sid){
								$id 		= $sid->id_kat_nilai;
								$kriteria   = $sid->kriteria;
								$nilai 		= $sid->nilai;
								$stat 		= $sid->status;
							}
						}
						?>
<div class="the-box full">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/sidang/addsubmit');?>" method="POST" >
								<input type="hidden" id="id_kat_nilai" name="id_kat_nilai" value="<?php echo $id; ?>" />
								<div class="form-group">
									<label class="col-sm-2 control-label">Kriteria</label>
									<!--<div class="col-sm-1">
										<select name="kriteria" class="form-control" id="kriteria">
											<option value='s'> = </option>
											<option value='k'> < </option>
											<option value='l'> > </option>
										</select>
									</div>-->
									<div class="col-sm-3">
										<input name="kriteria" class="" id="kriteria" type="hidden" value="l" maxlength=2 /> <=
										<input name="nilai" class="" id="nilai" type="text" value="<?php echo $nilai; ?>" maxlength=2 />
										<span><?php echo form_error('nilai'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Status</label>
									<div class="col-sm-8">
										<input name="status" type="radio" id="status" value=1 <?php if($stat==1){echo 'checked';}?> >AKTIF
										&nbsp;&nbsp;&nbsp;
										<input name="status" type="radio" id="status" value=0 <?php if($stat==0){echo 'checked';}?> >NON AKTIF
									</div>
								</div>
								<div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('admin/sidang/katnilai');?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->