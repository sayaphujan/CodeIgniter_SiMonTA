<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">registrasi</li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST AKTIFASI REGISTRASI TA/ SKRIPSI</strong></p>
							<p>
							<?php
							if($cek==''){
								echo"<button class='btn btn-default btn-square'>Add Data</button>";
							}else{
							?>
                            <a href="<?php echo site_url('admin/tapel/ta_add');?>"><button class="btn btn-primary btn-square">Add Data</button></a>
							<?php } ?>
							</p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>TAHUN AKADEMIK</th>
												<th>SEMESTER</th>
												<th>ANGKATAN</th>
												<th>PROGRAM STUDI</th>
												<th>TANGGAL MULAI</th>
												<th>TANGGAL AKHIR</th>
												<th>STATUS</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
											$no=1;
											foreach ($reg->result() as $t){
												$id		= $t->ta_id;
												$ta		= $t->tapel_akad;
												$smt	= $t->tapel_semester;
												$angk	= $t->angk;
												$jur	= $t->jur_nama;
												$jurid	= $t->jur_id;
												$mulai	= $t->ta_mulai;
												$akhir	= $t->ta_akhir;
												$status	= $t->ta_status;
												
												$tahun_mulai = substr($mulai,0,4);
												$bulan_mulai = substr($mulai,5,2);
												$tanggal_mulai = substr($mulai,8,2);
												
												$tahun_akhir = substr($akhir,0,4);
												$bulan_akhir = substr($akhir,5,2);
												$tanggal_akhir = substr($akhir,8,2);
										   ?>
										   <tr>
												<td><?php echo $no++;?></td>
												<td><?php echo $ta;?></td>
												<td><?php echo $smt;?></td>
												<td><?php echo $angk;?></td>
												<td><?php echo $jur;?></td>
												<td><?php echo $tanggal_mulai.'-'.$bulan_mulai.'-'.$tahun_mulai;?></td>
												<td><?php echo $tanggal_akhir.'-'.$bulan_akhir.'-'.$tahun_akhir;?></td>
												<?php 
												if($t->tapel_status=='0'){
													echo"<td>
															<a href=''>
															<button class='btn btn-xs btn-flat btn-default'>
																Aktifkan
															</button>
															</a>
															<a href=''>
															<button class='btn btn-xs btn-flat btn-default'>
																Matikan
															</button>
															</a>
														</td>
														";
												}else{
												?>
												<td>
												<?php 
													if($status=='AKTIF'){
														echo"
															<a href=''>
															<button class='btn btn-xs btn-flat btn-default'>
																Aktifkan
															</button>
															</a>
														";
														echo"
															<a href='".site_url('admin/tapel/tainaktif/'.$id.'/'.$jurid)."' onClick='return confirm(\"Anda yakin akan menonaktifkan data ini ?\")'>
															<button class='btn btn-xs btn-flat btn-danger'>
																Matikan
															</button>
															</a>
														";
													}else{
														echo"
															<a href='".site_url('admin/tapel/taaktif/'.$id.'/'.$jurid)."' onClick='return confirm(\"Anda yakin akan mengaktifkan data ini ?\")'>
															<button class='btn btn-xs btn-flat btn-success'>
																Aktifkan
															</button>
															</a>
														";
														echo"
															<a href=''>
															<button class='btn btn-xs btn-flat btn-default'>
																Matikan
															</button>
															</a>
														";
													}
													?>
												</td>
												<?php } 
												if($t->tapel_status=='0'){
													echo"<td>
														 <button class='btn btn-xs btn-flat btn-default btnbrg-edit'>
															<i class='fa fa-edit'></i>
														</button>
														<button class='btn btn-xs btn-flat btn-default btnbrg-del'>
															<i class='fa fa-times'></i>
														</button>
														 </td>
														 ";
												}else{
												?>
												<td>
													<a href='<?php echo site_url('admin/tapel/ta_edit/'.$id); ?>'>
														<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
															<i class="fa fa-edit"></i>
														</button>
													</a>
													<a href='<?php echo site_url('admin/tapel/ta_del/'.$id); ?>' onClick="return confirm('Anda yakin akan menghapus data ini ?')" >
														<button class="btn btn-xs btn-flat btn-danger btnbrg-del">
															<i class="fa fa-times"></i>
														</button>
													</a>
												</td>
												<?php } ?>
										   </tr>
										   <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
						</div><!-- /.the-box full -->
		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
				<script>
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script>
