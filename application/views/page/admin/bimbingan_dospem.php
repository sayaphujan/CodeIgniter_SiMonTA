<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST MAHASISWA DIBIMBING</strong></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!--<th><input type="checkbox" name="cek_all" value="all"></th>-->
												<th rowspan=2>NO</th>
												<th rowspan=2>NIM</th>
												<th rowspan=2>NAMA</th>
												<th rowspan=2>TEMA</th>
												<th rowspan=2>JUDUL</th>
												<th colspan=2>DOSEN P1</th>
												<th colspan=2>DOSEN P2</th>
												<th rowspan=2>DETAIL</th>
                                            </tr>
											<tr>
												<td>BAB</td>
												<td>STATUS</td>
												<td>BAB</td>
												<td>STATUS</td>
											</tr>
                                        </thead>
                                        <tbody>
										<?php
											foreach($result as $key=>$_res)
											{
												$mhsid = $_res['mhs_id'];
												$mhsnim = $_res['mhs_nim'];
												
													/*get tema+judul*/
													$this->db->select('*');
													$this->db->from('pengajuan');
													$this->db->join('tema','pengajuan.tema_id=tema.tema_id');
													$this->db->where('mhs_id',$_res['mhs_id']);
													$this->db->where('peng_status','DISETUJUI');
													$this->db->where('tapel_id',$_res['tapel_id']);
													$peng = $this->db->get();
													
													foreach($peng->result() as $p){ 
														$pengid = $p->peng_id;
														$judul = $p->peng_judul; 
														$tema = $p->tema_nama;
												/*
												if($statdua=='Menunggu Diperiksa Dosen P1'){
													$teksstatsatu= "Menunggu Diperiksa Dosen P1";
													$tekskatsatu = $katdua;
												}else{
													$teksstatsatu = $statsatu;
													$tekskatsatu = $katsatu;
												}

													
												*/
										?>
											<tr>
												<!--<td><input type="checkbox" name="get_cek[]" value=""></td>-->
												<td><?php echo $key+1; ?></td>
												<td><?php echo $mhsnim; ?></td>
												<td><?php echo $_res['mhs_nama']; ?></td>
												<td><?php echo $tema;  ?></td>
												<td><?php echo $judul; ?></td>
												<?php
												/* GET LAST BIMBINGAN P1 */
														$this->db->select('*');
														$this->db->from('bimbingan');
														$this->db->join('laporan','laporan.lap_id=bimbingan.lap_id');
														$this->db->join('kategori_laporan','kategori_laporan.kat_lap_id=laporan.kat_lap_id');
														$this->db->where('laporan.mhs_id',$mhsid);
														$this->db->where('bimbingan.p1',1);
														$lastbimb = $this->db->get();
															if($lastbimb->num_rows() <> 0){
																foreach($lastbimb->result() as $satu){
																	$katsatu = $satu->kat_lap;
																	$statsatu= $satu->bimb_status;
																	
																	echo "<td>$katsatu </td>";
																	echo "<td>$statsatu </td>";
																
																} /* end $lastbimb*/
															}else{
																echo "<td><p class='text-danger'>Data Kosong</p></td>";
																echo "<td><p class='text-danger'>Data Kosong</p></td>";
															} 
												?>
												<?php
												/* GET LAST BIMBINGAN P2 */
														$this->db->select('*');
														$this->db->from('bimbingan');
														$this->db->join('laporan','laporan.lap_id=bimbingan.lap_id');
														$this->db->join('kategori_laporan','kategori_laporan.kat_lap_id=laporan.kat_lap_id');
														$this->db->where('laporan.mhs_id',$mhsid);
														$this->db->where('bimbingan.p2',1);
														$lastbimb2 = $this->db->get();
															if($lastbimb2->num_rows() <> 0){
																foreach($lastbimb2->result() as $dua){
																	$katdua = $dua->kat_lap;
																	$statdua= $dua->bimb_status;
																	
																	echo "<td>$katdua </td>";
																	echo "<td>$statdua </td>";
																
																} /* end $lastbimb2*/
															}else{
																echo "<td><p class='text-danger'>Data Kosong</p></td>";
																echo "<td><p class='text-danger'>Data Kosong</p></td>";
															} 
												?>
												<td>
													<a href='<?php echo site_url('admin/bimbingan/detail/'.$_res['mhs_id'].'/'.$pengid); ?>'>
													<button class="btn btn-xs btn-flat btn-info btnbrg-edit">
														Detail
													</button>
													</a>
												</td>
											</tr>
											
											<?php
												} /* end $peng */
											} /* end $result */
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