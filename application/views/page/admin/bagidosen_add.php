<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
<?php
if($this->uri->segment(3)=='bagiedit'){
	foreach($bagidosen->result() as $key){
		$id 	= $key->bagi_id;
		$dosen	= $key->pgw_id;
		$satu	= $key->p1;
		$dua	= $key->p2;
	}
}else{
	$id 	= $bid;
	$dosen	= $bdosen;
	$satu	= $bp1;
	$dua	= $bp2;
}
?>
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM PEMBAGIAN DOSEN</h3>
                                </div>
								
                                <div class="the-box full">
                                    <form role="form" class="form-horizontal" action="<?php echo site_url('admin/dosen/bagisubmit');?>" method="POST" >
									<input type='hidden' name='id' value='<?php echo $id;?>'>
                                    <div class="form-group">
											<label class="col-sm-3 control-label">Dosen</label>
												<div class="col-sm-6">
													<select class="form-control" name="dosen" id="dosen">
													<option value=''>- Pilih Disini -</option>
													<?php
															foreach($pegawai->result() as $row){
																	$pilih = ($row->pgw_id == $dosen)?"selected" : "";
																	echo "<option value='$row->pgw_id' $pilih>$row->pgw_nama</option>";
															}
													?>
													</select>
													<span><?php echo form_error('dosen'); ?></span>
												</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Dosen Pembimbing 1</label>
												<div class="col-sm-6">
													<input name="satu" type="radio" id="satu" value="Y" <?php if($satu=='Y'){echo 'checked';}?>>&nbsp;Y
													&nbsp;&nbsp;&nbsp;
													<input name="satu" type="radio" id="satu" value="T" <?php if($satu=='' || $satu=='T'){echo 'checked';}?>>&nbsp;T
													<span><?php echo form_error('satu'); ?></span>
												</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Dosen Pembimbing 2</label>
												<div class="col-sm-6">
													<input name="dua" type="radio" id="dua" value="Y" <?php if($dua=='Y'){echo 'checked';}?>>&nbsp;Y
													&nbsp;&nbsp;&nbsp;
													<input name="dua" type="radio" id="dua" value="T" <?php if($dua=='' || $dua=='T'){echo 'checked';}?>>&nbsp;T
													<span><?php echo form_error('dua'); ?></span>
												</div>
										</div>
									
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-8">
												<button class="btn btn-primary btn-square">Simpan</button>
												<a href="<?php echo site_url('admin/dosen/bagi');?>" class="btn btn-warning btn-square">Kembali</a>
											</div>
										</div>
									</form>
								</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->