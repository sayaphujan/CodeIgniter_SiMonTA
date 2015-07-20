<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

<!-- Main content -->
                <section class="content">

                    <div class="col-md-12">
                         
                        <div class="box box-primary">
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">FORM DATA DOSEN PEMBIMBING</h3>
                                </div>
                                <div class="the-box full">
								<form role="form" id="adddospem" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('admin/dospem/submit');?>" method="POST" >
								<!-- DOSEN PEMBIMBING SATU -->
								<div class="form-group">
								<?php	if($dosen1->num_rows() ==0){ ?>
									<input type="hidden" name="dospem_satu" value="">
									<input type="hidden" name="mhs_satu" value="">
										<label class="col-sm-4 control-label">Dosen Pembimbing 1</label>
											<div class="col-sm-6">
												<select class="form-control" name="dosensatu">
													<option value="selected">- Pilih Disini -</option>
													<?php
															foreach($pegawai1->result() as $row){
																	echo "<option value='$row->pgw_id'>$row->pgw_nama</option>";
															}
													?>
													
												</select>
											</div>
								<?php
								}else{
									foreach($dosen1->result() as $satu) { 
										$dospemid = $satu->dospem_id;
										$mhsid = $satu->mhs_id;
										$dosid = $satu->pgw_id;
									}
								?>
								<input type="hidden" name="dospem_satu" value="<?php echo $dospemid; ?>">
									<input type="hidden" name="mhs_satu" value="<?php echo $mhsid; ?>">
										<label class="col-sm-4 control-label">Dosen Pembimbing 1</label>
											<div class="col-sm-6">
												<select class="form-control" name="dosensatu">
													<option value="">- Pilih Disini -</option>
													<?php
															foreach($pegawai1->result() as $row){
																	$pilih = ($row->pgw_id == $dosid)?"selected" : "";
																	echo "<option value='$row->pgw_id' $pilih>$row->pgw_nama</option>";
															}
													?>
													
												</select>
											</div>
								<?php
								}	
								?>
								</div>
								

								<!-- DOSEN PEMBIMBING DUA -->
								<div class="form-group">
								<?php	if($dosen2->num_rows() ==0){ ?>
									<input type="hidden" name="dospem_dua" value="">
									<input type="hidden" name="mhs_dua" value="">
										<label class="col-sm-4 control-label">Dosen Pembimbing 2</label>
											<div class="col-sm-6">
												<select class="form-control" name="dosendua">
													<option value="selected">- Pilih Disini -</option>
													<?php
															foreach($pegawai2->result() as $row){
																	echo "<option value='$row->pgw_id'>$row->pgw_nama</option>";
															}
													?>
													
												</select>
											</div>
								<?php
								}else{
									foreach($dosen2->result() as $dua) { 
										$dospemid = $dua->dospem_id;
										$mhsid = $dua->mhs_id;
										$dosid = $dua->pgw_id;
									}
								?>
								<input type="hidden" name="dospem_dua" value="<?php echo $dospemid; ?>">
									<input type="hidden" name="mhs_dua" value="<?php echo $mhsid; ?>">
										<label class="col-sm-4 control-label">Dosen Pembimbing 2</label>
											<div class="col-sm-6">
												<select class="form-control" name="dosendua">
													<option value="">- Pilih Disini -</option>
													<?php
															foreach($pegawai2->result() as $row){
																	$pilih = ($row->pgw_id == $dosid)?"selected" : "";
																	echo "<option value='$row->pgw_id' $pilih>$row->pgw_nama</option>";
															}
													?>
													
												</select>
											</div>
								<?php
								}	
								?>
								</div>
								
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-8">
											<button class="btn btn-primary btn-square">Simpan</button>
											<a href="<?=site_url('admin/dospem');?>" class="btn btn-warning btn-square">Kembali</a>
										</div>
									</div>
								</form>
								</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->