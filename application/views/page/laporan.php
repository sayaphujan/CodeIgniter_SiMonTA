<?php 

$no = $this->uri->segment(3);
if ($no != 11 && $no != 12 && $no != 13 && $no != 14 && $no != 15 && $no != 16 ){
redirect('mahasiswa');
}
foreach($bab->result() as $row){}
?>
<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?> / <?php echo $row->kat_lap;?></li>
						</ol>
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST BIMBINGAN</strong></p>
                            <p>
							<?php
							if($cektapel=='' || empty($cektapel) || $cekta=='' || empty($cekta) || $cekkrs=='' || empty($cekkrs)){
								echo"<button class='btn btn-default btn-square'>Add Data</button>";
							}else{ 
								if($cek->num_rows() <> 0){
									foreach($cek->result() as $r){ $st = $r->bimb_status; }
										//if($st=='REVISI - P1' || $st=='REVISI - P2'){
										if($st=='Menunggu Diperiksa' || $st=='Menunggu Diperiksa Dosen P1' || $st=='Diajukan Untuk Diperiksa Dosen P1' || $st=='ACC'){
											echo"<button class='btn btn-default btn-square'>Add Data</button>";
										}else{
											echo"
											<a href='".site_url('laporan/add/'.$no)."'>
												<button class='btn btn-primary btn-square'>Add Data</button>
											</a>
											";
										}
								}else{
											echo"
											<a href='".site_url('laporan/add/'.$no)."'>
												<button class='btn btn-primary btn-square'>Add Data</button>
											</a>
											";
								}
							}
								
							?>
							</p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
											<tr>
                                               <th>NO</th>
												<th>LAPORAN</th>
                                                <th>TANGGAL PENGAJUAN</th>
												<th>WAKTU PENGAJUAN</th>
												<th>AKSI</th>
												<th>STATUS</th>
												<th>REVISI</th>
												<th>BIMBINGAN</th>
												<th>TANGGAL BIMBINGAN</th>
												<th>WAKTU BIMBINGAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
											$number=1;
											foreach($laporan->result() as $key){
											$tahun_aju = substr($key->lap_tgl,0,4);
											$bulan_aju = substr($key->lap_tgl,5,2);
											$tanggal_aju = substr($key->lap_tgl,8,2);
											
											$tahun_bim = substr($key->bimb_tgl,0,4);
											$bulan_bim = substr($key->bimb_tgl,5,2);
											$tanggal_bim = substr($key->bimb_tgl,8,2);
											?>
												<tr>
													<td><?php echo $number++;?></td>
													<td><a href="<?php echo site_url('laporan/get_file_prop/'.$no.'/'.$key->lap_file); ?>"><?= substr($key->lap_file,14,5); ?>...</a></td>
													<td><?= $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju;?></td>
													<td><?= $key->lap_waktu; ?></td>
													<?php if($key->bimb_status =="Menunggu Diperiksa"){ ?>
													<td>
														<a href='<?php echo site_url('laporan/edit/'.$no.'/'.$key->lap_id); ?>'>
														<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
															<i class="fa fa-edit"></i>
														</button>
														</a>
													</td>
													<?php }else{ echo "
															<td>
																<button class='btn btn-xs btn-flat btn-default'>
																	<i class='fa fa-edit'></i>
																</button>
															</td>"
																;} 
													?>
													<td><?= $key->bimb_status; ?></td>
													<?php 
														if($key->bimb_file=="Tak ada File Revisi"){ ?>
															<td><?= $key->bimb_file; ?></td>
													<?php } else { ?>
														<td><a href="<?php echo site_url('laporan/get_file_rev/'.$no.'/'.$key->bimb_file); ?>"><?= substr($key->bimb_file,6,5); ?>...</a></td>
													<?php } ?>
													<td><?= $key->bimb_komentar; ?></td>
													<td><?= $tanggal_bim.'-'.$bulan_bim.'-'.$tahun_bim; ?></td>
													<td><?= $key->bimb_waktu; ?></td>
												</tr>
												<?php
												}
												?>
                                        </tbody>
                                    </table>
                                </div>
		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
<script>
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script> 