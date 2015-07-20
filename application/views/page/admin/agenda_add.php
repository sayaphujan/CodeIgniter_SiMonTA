			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="#fakelink">Admin</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>Input Data Agenda</h3>
						</div>
						
					
						
<div class="the-box full" style="padding:15px 10px 5px 10px">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/berita/submit');?>" method="POST" >
								<input type="hidden" id="berita_id" name="berita_id"/>
								<div class="form-group">
									<label class="col-sm-2 control-label">Judul</label>
									<div class="col-sm-8">
										<input name="judul" id="judul" class="form-control" type="text" placeholder=" judul" />
										<span><?php echo form_error('judul'); ?></span>
									</div>
								</div>
								<div class="form-group">
								    <label class="col-sm-2 control-label">Isi</label>
								    <div class="col-sm-8">
									    <textarea name="isi" id="isi" rows="7" class="form-control"></textarea>
									    <span><?php echo form_error('konten'); ?></span>
									</div>
								 </div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Tanggal</label>
									<div class="col-sm-8">
										<input name="userfile" id="fileInput" type="text" size="15" />&nbsp;&nbsp;<img src="<?php echo site_url('assets/img/icon_cal.png');?>">
										<span></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Status</label>
									<div class="col-sm-8">
									
										  <label class="radio-inline">
										    <input name="status" id="status" type="radio" value="AKTIF" checked />
										    AKTIF
										  </label>
										
										  <label class="radio-inline">
										    <input name="status" id="status" type="radio" value="NON-AKTIF" />
										    NON AKTIF
										  </label>
									
									</div>
								 </div>
								 <div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('admin/berita');?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->

                

