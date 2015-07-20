			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">registrasi</li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM AKTIFASI REGISTRASI TA/SKRIPSI</h3>
						</div>
						<?php
						$link = $this->uri->segment(3);
						if($link=='submitta'){
							$id			= $taid;
							$angkatan 	= $angk;
							$jurusan 	= $jur;
							$mul		= $mulai;
							$ak			= $akhir;
							$stat		= $status;
						}else if($link=='ta_edit'){
							foreach ($tapel->result() as $t){
								$id			= $t->ta_id;
								$angkatan	= $t->angk;
								$jurusan	= $t->jur_id;
								$tapel1		= $t->ta_mulai;
								$tapel2		= $t->ta_akhir;
								$stat		= $t->ta_status;
												
								$tahun_mulai 	= substr($tapel1,0,4);
								$bulan_mulai 	= substr($tapel1,5,2);
								$tanggal_mulai 	= substr($tapel1,8,2);
								$mul			= $tanggal_mulai.'-'.$bulan_mulai.'-'.$tahun_mulai;
											
								$tahun_akhir = substr($tapel2,0,4);
								$bulan_akhir = substr($tapel2,5,2);
								$tanggal_akhir = substr($tapel2,8,2);
								$ak			= $tanggal_akhir.'-'.$bulan_akhir.'-'.$tahun_akhir;
							}
						}
						?>
<div class="the-box full">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/tapel/submitta');?>" method="POST" >
							 <input type="hidden" name="ta_id" id="ta_id" value="<?php echo $id; ?>"> 
								<div class="form-group">
									<label class="col-sm-2 control-label">Angkatan</label>
									<div class="col-sm-8">
										<select class="form-control" name="angkatan" id="angkatan" >
											<option value="" >--Pilih Disini--</option>
											<?php
												foreach($an->result() as $a){
													$pilih =($angkatan == $a->angkatan)? "selected" : "";
													echo"<option value='$a->angkatan' $pilih>$a->angkatan</option>";
												}
											?>
										</select>
										<span><?php echo form_error('angkatan'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Program Studi</label>
									<div class="col-sm-8">
										<select class="form-control" name="jurusan" id="jurusan">
											<option value="" >--Pilih Disini--</option>
											<?php
												foreach($ju->result() as $j){
													$pilih = ($jurusan == $j->jur_id)? "selected" : "";
													echo "<option value='$j->jur_id' $pilih>$j->jur_nama</option>";
												}
											?>
										</select>
										<span><?php echo form_error('jurusan'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Mulai</label>
									<div class="col-sm-6">
										<a href="javascript:NewCssCal('mulai','ddmmyyyy')">
											<input type="text" name="mulai" class="mulai" id="mulai" size="20" value="<?php echo $mul; ?>" /> 
											<img src="<?php echo base_url(); ?>assets/datepicker/images/cal.gif" width="16" height="16" alt="Pilih tanggal" />
										</a>
										<span><?php echo form_error('mulai'); ?></span>
									</div>
									
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Akhir</label>
									<div class="col-sm-6">
										<a href="javascript:NewCssCal('akhir','ddmmyyyy')">
											<input type="text" name="akhir" class="akhir" id="akhir" size="20" value="<?php echo $ak; ?>"  /> 
											<img src="<?php echo base_url(); ?>assets/datepicker/images/cal.gif" width="16" height="16" alt="Pilih tanggal" />
										</a>
										<span><?php echo form_error('akhir'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Status</label>
									<div class="col-sm-8">
										<input name="status" type="radio" id="status" value='AKTIF' <?php if($stat=='AKTIF'){echo 'checked';}?>>AKTIF
										&nbsp;&nbsp;&nbsp;
										<input name="status" type="radio" id="status" value='NON AKTIF' <?php if($stat=='NON AKTIF'){echo 'checked';} ?>>NON AKTIF
										<span><?php echo form_error('status'); ?></span>
									</div>
								</div>
								 
								<div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('admin/tapel/ta');?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->