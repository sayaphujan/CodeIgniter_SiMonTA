<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">kriteria nilai <?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST KATEGORI NILAI KELULUSAN SIDANG</strong></p>
							<p><a href="<?php echo site_url('admin/sidang/addkriteria');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>
							<?php 
								echo $error;
							?>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th>NO</th>
												<th>KRITERIA</th>
												<th>STATUS</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$key =1;
											foreach($nilai->result() as $res){
											$id 	= $res->id_kat_nilai;
											$status = $res->status;
										?>
											<tr>
												<td><?php echo $key++; ?></td>
												<td><?php echo '<='.'&nbsp;&nbsp;'.$res->nilai; ?></td>
												<td>
												<?php if ($status==0){ ?>
													<a href='<?php echo site_url('admin/sidang/aktif/'.$id); ?>' onClick="return confirm('Anda yakin akan mengaktifkan data ini ?')"s>
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														Aktifkan
													</button>
													</a>
												<?php }else{ ?>
													<a href='<?php echo site_url('admin/sidang/aktif/'.$id); ?>' onClick="return confirm('Anda yakin akan menonaktifkan data ini ?')">
													<button class="btn btn-xs btn-flat btn-danger btnbrg-edit">
														Matikan
													</button>
													</a>
												<?php } ?>
												</td>
												<td>
													<a href='<?php echo site_url('admin/sidang/editkriteria/'.$id); ?>'>
														<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
															<i class="fa fa-edit"></i>
														</button>
													</a>
												</td>
											</tr>
										<?php
											}
										?>
                                        </tbody>
                                    </table>
                                </div>
						</div><!-- /.the-box full -->
		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
<script>
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script> 