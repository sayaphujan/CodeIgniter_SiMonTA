			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM DATA BERITA</h3>
						</div>
						
					
						
<div class="the-box full" style="padding:15px 10px 5px 10px">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/berita/submit');?>" method="POST" >
								<input type="hidden" id="berita_id" name="berita_id"/>
								<div class="form-group">
									<label class="col-sm-2 control-label">Judul</label>
									<div class="col-sm-8">
										<input name="judul" id="judul" class="form-control" type="text" />
										<span><?php echo form_error('judul'); ?></span>
									</div>
								</div>
								<div class="form-group">
								    <label class="col-sm-2 control-label">Isi</label>
								    <div class="col-sm-8">
									    <textarea name="isi" id="isi" rows="7" class="form-control"></textarea>
									    <span><?php echo form_error('isi'); ?></span>
									</div>
								 </div>
								 <div class="form-group">
									<label class="col-sm-2 control-label">Kategori</label>
									<div class="col-sm-8">
										<select class="form-control" name="katberita">
											<option value="" selected>--Pilih Disini--</option>
												<?php 
													foreach($katberita as $row){
														echo '<option value="'.$row->katberita_id.'">'.$row->katberita_nama.'</option>';
													} 
												?>
										</select>
									</div>
									<span><?php echo form_error('katberita'); ?></span>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Gambar</label>
									<div class="col-sm-8">
										<input name="userfile" id="fileInput" class="form-control" type="file" />
										<span><?php echo form_error('userfile'); ?></span>
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

                

