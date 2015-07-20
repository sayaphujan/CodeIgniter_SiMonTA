			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM DATA DOSEN</h3>
						</div>
						<?php						
						$linkid = $this->uri->segment(4);
						if ($linkid!=0){
							foreach($pegawai->result() as $row){
								$noid			=$row->pgw_id;
								$nip			=$row->pgw_nip;
								$nama			=$row->pgw_nama;
								$username		=$row->pgw_username;
								$pass			=$row->pgw_pass;
								$levelres		=$row->level_id;
								$foto			=$row->pgw_foto;
								$n1				= substr($nip,0,6);
								$n2				= substr($nip,7,6);
								$n3				= substr($nip,14,3);
								$niperror		='';
								$levelerror		='';
							}
						}else{
								$noid			=$pid;
								$nip			=$pnip;
								$nama			=$pnama;
								$username		=$pusername;
								$pass			=$ppass;
								$levelres		=$plevel;
								$foto			=$pfoto;
								$n1				= $pn1;
								$n2				= $pn2;
								$n3				= $pn3;
								$niperror		=$niperr;
								$levelerror		=$levelerr;
						}
						?>
<div class="the-box full">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/dosen/submit');?>" method="POST" >
								<input type="hidden" id="pgw_id" name="pgw_id" value="<?php echo $noid; ?>" />
								<div class="form-group">
									<label class="col-sm-2 control-label">NPPY</label>
										<div class="col-sm-8">
										<input name="n1" id="n1" type="text" maxlength=6 size =6 value="<?php echo $n1; ?>" /> - <input name="n2" id="n2" type="text" maxlength=6 size =6 value="<?php echo $n2; ?>" /> - <input name="n3"  id="n3" type="text" maxlength=3 size =3 value="<?php echo $n3; ?>" />
										<span><?php echo form_error('n1'); ?></span> <span><?php echo form_error('n2'); ?></span> <span><?php echo form_error('n3'); ?></span> 
										<span><?php echo $niperror; ?></span>
										</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Nama</label>
									<div class="col-sm-8">
										<input name="nama" class="form-control" id="nama" type="text" value="<?php echo $nama; ?>" />
										<span><?php echo form_error('nama'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Username</label>
									<div class="col-sm-8">
										<input name="username" class="form-control" id="username" type="text" value="<?php echo $username; ?>" />
										<span><?php echo form_error('username'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Password</label>
									<div class="col-sm-8">
										<input name="password" id="pass" class="form-control" type="password" value="<?php echo $pass; ?>" />
										<span><?php echo form_error('password'); ?></span>
									</div>
								</div>

								 <div class="form-group">
									<label class="col-sm-2 control-label">Jabatan</label>
									<div class="col-sm-8">
										<select class="form-control" name="jabatan">
											<option value="">- Pilih Disini -</option>
											<?php 
												foreach($level  as $lvl):
												$lvlid = $lvl->level_id;
												$lvlname = $lvl->level_name;
												
												if ($this->uri->segment(3)!="submit"){
													foreach($pegawai->result() as $row){
														$pilihlevel	= $row->level_id;
													}
												}else{
													$pilihlevel = $levelres;
												}
												$pilih = ($pilihlevel==$lvlid)?"selected" : "";
												echo "<option value='$lvlid' $pilih>$lvlname</option>";
											?>
											<?php endforeach;?>
										</select>
									</div>
									<span><?php echo form_error('jabatan'); ?></span>
									<span><?php echo $levelerror; ?></span>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Foto</label>
									<div class="col-sm-8">
										<input name="userfile" id="userfile" type="file" class="form-control" /><?php echo $foto; ?>
									</div>
								</div>
								<div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('admin/dosen');?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->