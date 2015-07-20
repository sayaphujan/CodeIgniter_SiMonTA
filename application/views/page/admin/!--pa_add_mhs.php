
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
							<form role="form" id="addpa" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('admin/pa/submit');?>" method="POST" >
								<input type="hidden" id="akad_id" name="akad_id"/>
                                    <div class="form-group">
										<label class="col-sm-2 control-label">Dosen</label>
											<div class="col-sm-8">
												<select class="form-control" name="dosen">
													<option value="" selected>--Pilih Disini--</option>
													<?php 
														foreach($pegawai->result() as $pgw){
															$pilih = ($dosen == $pgw->pgw_id)?"selected" : "";
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
																$pilih = ($angk == $i)?"selected" : "";
																echo '<option value="'.$i.'" '.$pilih.'>'.$i.'</option>';
															} 
														?>
												</select>
												<span><?php echo form_error('tahun'); ?></span>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Jurusan</label>
											<div class="col-sm-8">
												<select class="form-control" name="jurusan" id="jurusan">
													<option value="" selected>--Pilih Disini--</option>
													<?php 
														foreach($jurusan->result() as $row){
															$pilih = ($jur == $row->jur_id)?"selected" : "";
															echo '<option value="'.$row->jur_id.'" '.$pilih.'>'.$row->jur_nama.'</option>';
														//echo '<option value="'.$row->jur_id.'">&nbsp;&nbsp;'.$row->jur_nama.'</option>';
														}
													?>
												</select>
												<span><?php echo form_error('jurusan'); ?></span>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Konsentrasi</label>
											<div class="col-sm-8">
												<select class="form-control" name="konsentrasi" id="konsentrasi">
													<option value="" selected>--Pilih Disini--</option>
													<?php 
														foreach($konsentrasi->result() as $row){
															$pilih = ($kon == $row->kon_id)?"selected" : "";
															echo '<option value="'.$row->kon_id.'" '.$pilih.'>'.$row->kon_nama.'</option>';
														}
													?>
												</select>
												<span><?php echo form_error('konsentrasi'); ?></span>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Mahasiswa</label>
											<div class="col-sm-8">
											<?php
												foreach($mahasiswa->result() as $row){
													echo '<input type="checkbox" name="mahasiswa[]" id="mahasiswa[]" value="'.$row->mhs_id.'" />&nbsp;&nbsp;'.$row->mhs_nama.'<br/>';
												} 
											?>
											<span><?php echo form_error('mahasiswa[]'); ?></span>
											</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-8">
											<button class="btn btn-primary btn-square" name="cek" value="add" type="submit">Simpan</button>
											<!--<a href="<?php //=site_url('admin/pa/get_mhs');?>" class="btn btn-warning btn-square">Kembali</a>-->
											<button class="btn btn-warning btn-square" name="cek" value="back" type="submit">Kembali</button>
										</div>
									</div>
								</form>
                                </div><!-- /.box-body -->
                            
                            </div><!-- /.box -->
<?php
if(isset($_POST['kembali'])){
echo $this->input->post('dosen');
}
?>