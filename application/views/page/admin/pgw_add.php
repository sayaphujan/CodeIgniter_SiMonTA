			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM DATA DOSEN</h3>
						</div>
						
					
						
<div class="the-box full">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/dosen/submit');?>" method="POST" >
								<div class="form-group">
									<label class="col-sm-2 control-label">NPPY</label>
										<div class="col-sm-8">
										<input name="n1" id="n1" type="text" maxlength=6 size =6 /> - <input name="n2" id="n2" type="text" maxlength=6 size =6 /> - <input name="n3"  id="n3" type="text" maxlength=3 size =3  />
										<span><?php echo form_error('n1'); ?></span> <span><?php echo form_error('n2'); ?></span> <span><?php echo form_error('n3'); ?></span> 
										</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Nama</label>
									<div class="col-sm-8">
										<input name="nama" class="form-control" id="nama" type="text"  />
										<span><?php echo form_error('nama'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Username</label>
									<div class="col-sm-8">
										<input name="username" class="form-control" id="username" type="text"  />
										<span><?php echo form_error('username'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Password</label>
									<div class="col-sm-8">
										<input name="password" id="pass" class="form-control" type="password"  />
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
												echo "<option value='$lvlid' $pilih>$lvlname</option>";
											?>
											<?php endforeach;?>
										</select>
									</div>
									<span><?php echo form_error('jabatan'); ?></span>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Foto</label>
									<div class="col-sm-8">
										<input name="userfile" id="userfile" type="file" class="form-control" />
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