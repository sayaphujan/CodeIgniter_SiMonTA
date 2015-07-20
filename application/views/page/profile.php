<?php

foreach($mhsw->result() as $m){
		$mid	= $m->mhs_id;
		$mnim	= $m->mhs_nim;
		$mnama	= $m->mhs_nama;
		$mfoto	= $m->mhs_foto;
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
                                    <h3 class="box-title">DATA PERSONAL</h3>
                                </div>
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" method="POST" >
								<input type="hidden" id="mhs_id" name="mhs_id" value="<?php $mid; ?>" />
								
								<div class="form-group">
									<label class="col-sm-2 control-label">NIM</label>
									<div class="col-sm-8">
										<input name="nim" class="form-control" id="nim" type="hidden" value="<?php echo $mnim; ?>" /><?php echo $mnim; ?>
										<span><?php echo form_error('nim'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Nama</label>
									<div class="col-sm-8">
										<input name="nama" class="form-control" id="nama" type="hidden"  /><?php echo $mnama; ?>
										<span><?php echo form_error('nama'); ?></span>
									</div>
								</div>
								 <div class="form-group">
									<label class="col-sm-2 control-label">Jurusan</label>
									<div class="col-sm-8">
									<input name="jurusan" class="form-control" id="jurusan" type="hidden" value="" /><?php echo $m->jur_nama; ?>
									<!--
										<select class="form-control" name="jurusan">
														<option value="" selected>--Pilih Disini--</option>
														<?php 
																foreach($jurusan as $jur):
																	foreach($mhsw->result() as $row){
																		$pilih = ($row->jur_id == $jur->jur_id)?"selected" : "";
																		//echo '<option value="'.$jur->jur_id.'" '.$pilih.' >'.$jur->jur_nama.'</option>';
																} endforeach;
														?>
										</select>-->
									</div>
									<span><?php echo form_error('jurusan'); ?></span>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Konsentrasi</label>
									<div class="col-sm-8">
									<input name="konsentrasi" class="form-control" id="konsentrasi" type="hidden" value="" /><?php echo $m->kon_nama; ?>
									<!--
										<select class="form-control" name="konsentrasi">
														<option value="" selected>--Pilih Disini--</option>
														<?php 
															foreach($konsentrasi as $kon):
																	foreach($mhsw->result() as $row){
																		$pilih = ($row->kon_id == $kon->kon_id)?"selected" : "";
																		//echo '<option value="'.$kon->kon_id.'" '.$pilih.' >'.$kon->kon_nama.'</option>';
															} endforeach;
														?>
										</select>-->
									</div>
									<span><?php echo form_error('konsentrasi'); ?></span>
								</div>
								 		<a href="<?=site_url('mahasiswa');?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->

                