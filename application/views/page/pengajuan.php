<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST PENGAJUAN JUDUL</strong></p>
							<p>
							<?php
							if($pengajuan->num_rows() <> 0){
								foreach($pengajuan->result() as $r){ $st = $r->peng_status; }
									if($st=='DISETUJUI'){
										echo"<button class='btn btn-default btn-square'>Add Data</button>";
									}else{
											echo"
										<a href='".site_url('pengajuan/add')."'>
											<button class='btn btn-primary btn-square'>Add Data</button>
										</a>
										";
									}
							}else{
										echo"
										<a href='".site_url('pengajuan/add')."'>
											<button class='btn btn-primary btn-square'>Add Data</button>
										</a>
										";
							}
								
							?>
							</p>
							<?php echo $error; ?>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>TEMA</th>
												<th>JUDUL</th>
												<th>TANGGAL</th>
												<th>STATUS PERSETUJUAN</th>
												<th>DETAIL</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$no=1;
										foreach($pengajuan->result() as $row){ 
											$tahun_aju = substr($row->peng_tanggal,0,4);
											$bulan_aju = substr($row->peng_tanggal,5,2);
											$tanggal_aju = substr($row->peng_tanggal,8,2);

										?>
											<tr>
												<td><?php echo $no++;?> </td>
												<td><?php echo $row->tema_nama;?> </td>
												<td><?php echo $row->peng_judul;?>	</td>
												<!--<td><a href="<?php //echo ('pengajuan/get_file/'.$row->peng_file); ?>"><?php //echo $row->peng_file; ?></a></td>-->
												<td><?= $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju;?></td>
												<td><?php echo $row->peng_status;?>	</td>
												<td><a href="<?php echo site_url('pengajuan/detail/'.$row->peng_id);?>" />
													<button class="btn btn-xs btn-flat btn-info btnbrg-edit" type="submit" name="detail" value="Detail">
														Detail
													</button>
													</a>
												</td>
												<?php if($row->peng_status != 'PENDING'){ ?>
												<td class="center">
													<button class="btn btn-xs btn-flat btn-default btnbrg-edit">
														<i class="fa fa-edit"></i>
													</button>
													<button class="btn btn-xs btn-flat btn-dafault btnbrg-del">
														<i class="fa fa-times"></i>
													</button>
												</td>
												<?php }else{ ?>
												<td class="center">
												<a href="<?php echo site_url('pengajuan/edit/'.$row->peng_id);?>" />
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														<i class="fa fa-edit"></i>
													</button>
												</a>
												<a href="<?php echo site_url('pengajuan/del/'.$row->peng_id);?>" onClick="return confirm('Anda yakin akan menghapus data ini ?')" />
													<button class="btn btn-xs btn-flat btn-danger btnbrg-del">
														<i class="fa fa-times"></i>
													</button>
												</a>
												</td>
												<?php } ?>
											</tr>
											<?php }	?>
										</tbody>
							</table>
							</div>
						</div>
					</div>
<script>
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script> 