<?php
$add	="pa_add";
$edit	="submit";
if($this->uri->segment(3)==$add){
	$idos="";
	$iangk="";
	$ikon="";
}else if($this->uri->segment(3)==$edit){
	$idos=$dosen;
	$iangk=$angk;
	$ikon=$kon;
}
?>
			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">Pembimbing Akademik</li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM DATA PEMBIMBING AKADEMIK</h3>
						</div>
						<div class="the-box full">
							<form role="form" id="addpa" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('admin/pa/get_mhs'); ?>" method="POST" >
								<input type="hidden" id="akad_id" name="akad_id"/>
                                    <div class="form-group">
										<label class="col-sm-2 control-label">Dosen</label>
											<div class="col-sm-8">
												<select class="form-control" name="dosen">
													<option value="" selected>--Pilih Disini--</option>
													<?php 
														foreach($pegawai->result() as $pgw){
															$pilih = ($idos == $pgw->pgw_id)?"selected" : "";
															echo '<option value="'.$pgw->pgw_id.'" '.$pilih.'>'.$pgw->pgw_nama.'</option>';
														}
													?>
												</select>
												<span><?php echo form_error('dosen'); ?></span>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><u>Pilih Mahasiswa :</u></label>
									</div>
									 <div class="form-group">
										<label id="angkatan" class="col-sm-2 control-label">Angkatan</label>
											<div class="col-sm-8">
												<select class="form-control" name="tahun" id="tahun">
													<option value="" selected>--Pilih Disini--</option>
														<?php 
															for($i=2000;$i<=3000;$i++){
																$pilih = ($iangk == $i)?"selected" : "";
																echo '<option value="'.$i.'" '.$pilih.'>'.$i.'</option>';
															} 
														?>
												</select>
												<span><?php echo form_error('tahun'); ?></span>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Konsentrasi</label>
											<div class="col-sm-8">
												<select class="form-control" name="konsentrasi" id="konsentrasi">
													<option value="" selected>--Pilih Disini--</option>
													<?php 
														foreach($konsentrasi->result() as $row){
															$pilih = ($ikon == $row->kon_id)?"selected" : "";
															echo '<option value="'.$row->kon_id.'" '.$pilih.'>'.$row->kon_nama.'</option>';
														}
													?>
												</select>
												<span><?php echo form_error('konsentrasi'); ?></span>
											</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-8">
											<button class="btn btn-primary btn-square">Tampil</button>
											<a href="<?=site_url('admin/pa');?>" class="btn btn-warning btn-square">Kembali</a>
										</div>
									</div>
								</form>
                                </div><!-- /.box-body -->
                            
                            </div><!-- /.box -->