			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
									
						
<div class="box box-primary">
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">NOTIFIKASI</h3>
                                </div>

							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>PESAN</th>
                                                <th>TANGGAL</th>
												<th>WAKTU</th>
												<th>DETAIL</th>
												<th>STATUS</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										   <?php
											$no=1;
											foreach($pesan as $p){
												$tahun_aju = substr($p->pesan_tgl,0,4);
												$bulan_aju = substr($p->pesan_tgl,5,2);
												$tanggal_aju = substr($p->pesan_tgl,8,2);
											?>
										<tr>
                                           <td><?php echo $no++?></td>
										   <td><?php echo "<b>".$p->pgw_nama."</b>"; ?>&nbsp; Menjawab Pengajuan <?php echo "<b>".$p->kat_lap."</b> Anda"; ?></td>
										   <td><?php echo $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju;?></td>
										   <td><?php echo $p->pesan_waktu; ?></td>
										   <td>
										   <a href="<?php echo site_url('mahasiswa/detail/'.$p->kat_lap_id.'/'.$p->pesan_id);?>" />
													<button class="btn btn-xs btn-flat btn-info btnbrg-edit" type="submit" name="detail" value="Detail">
														Detail
													</button>
											</a>
											</td>
											<td width="50px">
											   <?php 
											   if($p->pesan_status==0){
											   ?>
											   <a href='<?php echo site_url('mahasiswa/open/'.$p->pesan_id); ?>' onClick="return confirm('Tandai Pesan Sudah Terbaca?')" >
											   <img src="<?php echo base_url();?>assets/img/mail_close.png" width="50%">
											   </a>
											   <?php }else { ?>
											   <img src="<?php echo base_url();?>assets/img/mail_open.png" width="50%">
											   <?php } ?>
										   </td>
										   <td>
												<a href='<?php echo site_url('mahasiswa/del/'.$p->pesan_id); ?>' onClick="return confirm('Anda yakin akan menghapus data ini ?')" >
													<button class="btn btn-xs btn-flat btn-danger btnbrg-del">
														<i class="fa fa-times"></i>
													</button>
												</a>
										   </td>
										</tr>
										<?php } ?>
                                        </tbody>
                                    </table>
				
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
<script>
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script> 