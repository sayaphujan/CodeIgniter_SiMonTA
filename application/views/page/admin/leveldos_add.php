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
                                    <h3 class="box-title">INPUT DATA LEVEL DOSEN</h3>
                                </div>
								<br />
                                <div class="box-body">
                                    <form role="form" action="<?=site_url('admin/level/submit_dos');?>" method="POST" >
                                    <input type="hidden" id="aks_id" name="aks_id"/>
                                    <div class="row">
										<table width="50%">
											<tr>
												<th width="10%">Dosen</th>
												<td width="40%">
													<select class="form-control" name="dosen">
														<option value="" selected>--Pilih Disini--</option>
														<?php 
															foreach($pegawai as $pgw){
																echo '<option value="'.$pgw->pgw_id.'">'.$pgw->pgw_nama.'</option>';
															} 
														?>
													</select>
													<span><?php echo form_error('dosen'); ?></span>
												</td>
											</tr>
											<tr>
												<td colspan="2">&nbsp;</td>
											</tr>
											<tr>
												<th >Level</th>
												<td >
													<select class="form-control" name="level">
														<option value="" selected>--Pilih Disini--</option>
														<?php 
															foreach($level as $row){
																echo '<option value="'.$row->level_id.'">'.$row->level_name.'</option>';
															} 
														?>
													</select>
													<span><?php echo form_error('level'); ?></span>
												</td>
											</tr>
										</table>
										<span id="err-kd" class="error-form"></span>                                           
                                    </div>
                                </div><!-- /.box-body -->
								<br />
                                <div class="box-footer">
                                   <button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('admin/level/listing');?>" class="btn btn-warning btn-square">Kembali</a>
                                </div><!-- /.box-footer-->
                            </form>
                            </div><!-- /.box -->