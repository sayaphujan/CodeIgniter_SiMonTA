<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<?php
								foreach($juru->result() as $jur){
									foreach($kons->result() as $kon){
									$tahun=$this->uri->segment(6);
							?>
							<!--<li class="active"><?php //echo $this->router->fetch_class();?></li>-->
							<li class="active"><?php echo $jur->jur_nama;?>/ <?php echo $kon->kon_nama;?> / <?php echo $tahun;?></li>
						</ol>
						<div class='alert alert-success alert-bold-border fade in alert-dismissable'>							
						  <h3>FORM DATA MAHASISWA</h3>
						</div>
						<?php
						$linkid = $this->uri->segment(7);
						if ($linkid!=0){
							foreach ($mahasiswa->result() as $mhs) {
								$id = $mhs->mhs_id;
								$nim = $mhs->mhs_nim;
								$nama = $mhs->mhs_nama;
								$pass = $mhs->mhs_pass;
								$foto = $mhs->mhs_foto;
							}
						}else{
								$id =$mid;
								$nim = $mnim;
								$nama = $mnama;
								$pass = $mpass;
								$foto = $mfoto;
						}
						?>
							<div class="the-box full">
							 <form name="ims" role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/mahasiswa/submit/'.$jur->jur_id.'/'.$kon->kon_id.'/'.$tahun) ?>" method="POST" >
							 	<input type="hidden" id="mhs_id" name="mhs_id" value='<?php echo $id; ?>' />
								<div class="form-group">
									<label class="col-sm-2 control-label">Nim</label>
									<div class="col-sm-8">
										<input name="nim" class="form-control" id="nim" type="hidden" value='<?php echo $nim; ?>' /><?php echo $nim; ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Nama</label>
									<div class="col-sm-8">
										<input name="nama" class="form-control" id="nama" type="text" value='<?php echo $nama; ?>' />
										<span><?php echo form_error('nama'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Password</label>
									<div class="col-sm-8">
										<input name="pass" class="form-control" id="pass" type="password" value='<?php echo $pass; ?>' />
										<span><?php echo form_error('pass'); ?></span>
									</div>
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
										<a href="<?=site_url('admin/mahasiswa/detail/'.$jur->jur_id.'/'.$kon->kon_id.'/'.$tahun);?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
								 <?php
							}}
							?>
									</form>
						  
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
				