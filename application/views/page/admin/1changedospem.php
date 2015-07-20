<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>RIWAYAT BIMBINGAN</h3>
						</div>
						
					<div class='the-box full'>
						<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
							<table border=0>
							     <?php
											foreach($result as $key=>$_res)
											{
										  ?>
										  <tr>
											   <td>NIM</td><td>&nbsp;&nbsp;:</td><td>&nbsp;&nbsp;<?php echo $_res['mhs_nim'];?></td>
											</tr>
										   <tr>
											   <td>Nama</td><td>&nbsp;&nbsp;:</td><td>&nbsp;&nbsp;<?php echo $_res['mhs_nama'];?></td>
											</tr>
											<tr>
											   <td>Judul</td><td>&nbsp;&nbsp;:</td><td>&nbsp;&nbsp;<?php echo $_res['peng_judul'];?></td>
											</tr>
											<tr>
												<td>Dosen Pembimbing</td><td>&nbsp;&nbsp;:</td><td>
											   <?php
													foreach($dosen[$_res['pgw_id']] as $_dos) {
													echo"&nbsp;&nbsp;$_dos,";
													}
													}
												?>
											   </td>
											 </tr>
							</table>
							<br />
							<a href="<?=site_url('admin/bimbingan');?>" class="btn btn-warning btn-square">Kembali</a>
							<hr />
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
											<tr>
                                                <th rowspan=2>NO</th>
												<th rowspan=2>KATEGORI LAPORAN</th>
												<th rowspan=2>FILE</th>
                                                <th colspan=2>PENGAJUAN</th>
												<th rowspan=2>STATUS</th>
												<th rowspan=2>REVISI</th>
												<th rowspan=2>BIMBINGAN</th>
												<th colspan=2>BIMBINGAN</th>
												<th rowspan=2>AKSI</th>
                                            </tr>
											<tr>
												<th>TANGGAL</th>
												<th>WAKTU</th>
												<th>TANGGAL</th>
												<th>WAKTU</th>
											</tr>
                                        </thead>
                                        <tbody>
										<?php
											$no=1;
											foreach($proposal->result() as $key){
											$status = $key->bimb_status;
											
											$tahun_aju = substr($key->lap_tgl,0,4);
											$bulan_aju = substr($key->lap_tgl,5,2);
											$tanggal_aju = substr($key->lap_tgl,8,2);
											
											$tahun_bim = substr($key->bimb_tgl,0,4);
											$bulan_bim = substr($key->bimb_tgl,5,2);
											$tanggal_bim = substr($key->bimb_tgl,8,2);
										?>
											<tr>
												<td><?php echo $no++;?></td>
												<td><?= $key->kat_lap; ?></td>
												<td><a href="<?php echo site_url('admin/proposal/get_file_prop/'.$key->lap_file); ?>"><?= substr($key->lap_file,14,5); ?></a></td>
												<td><?= $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju; ?></td>
												<td><?= $key->lap_waktu; ?></td>
												<td><?= $status; ?></td>
												<?php 
													if($key->bimb_file=="Tak ada File Revisi"){ ?>
														<td><?= $key->bimb_file; ?></td>
												<?php } else { ?>
													<td><a href="<?php echo site_url('admin/proposal/get_file_rev/'.$key->bimb_file); ?>"><?= $key->bimb_file; ?></a></td>
												<?php } ?>
												<td><?= $key->bimb_komentar; ?></td>
												<td><?= $tanggal_bim.'-'.$bulan_bim.'-'.$tahun_bim; ?></td>
												<td><?= $key->bimb_waktu; ?></td>
												<td>
													<?php
													
													foreach($terakhir->result() as $s){
														$lapid  = $s->lap_id;
													}
													$dos_id = $key->dospem_id;
													if ($key->lap_id==$lapid){
														if($dos_id % 2 == 0){
														//genap == P2
															if($key->bimb_status=='Menunggu Diperiksa' or $key->bimb_status=='REVISI - P2'){
													?>
																<a href='<?php echo site_url('admin/bimbingan/edit/'.$key->lap_id);?>'><button class="btn btn-xs btn-flat btn-success btnbrg-edit"><i class="fa fa-edit"></i></button></a>
													<?php
															}else{
													?>
																<button class="btn btn-xs btn-flat btn-default btnbrg-edit"><i class="fa fa-edit"></i></button>
													<?php
															}
														}
														if($dos_id % 2 == 1){
														//ganjil == P1
															if($key->bimb_status!='ACC'){
													?>
																<a href='<?php echo site_url('admin/bimbingan/edit/'.$key->lap_id);?>'><button class="btn btn-xs btn-flat btn-success btnbrg-edit"><i class="fa fa-edit"></i></button></a>
													<?php
															}else{
													?>
																<button class="btn btn-xs btn-flat btn-default btnbrg-edit"><i class="fa fa-edit"></i></button>
													<?php
															}
														}
													}else { 
													?>
															<button class="btn btn-xs btn-flat btn-default btnbrg-edit"><i class="fa fa-edit"></i></button>
													<?php	
													}
													?>
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
	$(document).ready(function() { 
		$('#tbl-personal').dataTable(); 
	} );
</script>