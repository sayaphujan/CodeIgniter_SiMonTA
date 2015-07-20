<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin/ta/detail/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest);?>">
							Rekap Data</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST DOSEN PEMBIMBING</strong></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!--<th><input type="checkbox" name="cek_all" value="all"></th>-->
												<th>NO</th>
												<th>NIM</th>
												<th>NAMA</th>
                                                <th>TEMA</th>
												<th>JUDUL</th>
												<th>DOSEN P1</th>
												<th>DOSEN P2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											foreach($result as $key=>$_res)
											{
										?>
											<tr>
												<!--<td><input type="checkbox" name="get_cek[]" value=""></td>-->
												<td><?php echo $key+1; ?></td>
												<td><?= $_res['mhs_nim']; ?></td>
												<td><?= $_res['mhs_nama']; ?></td>
												<?php
													$this->db->select('*');
													$this->db->from('pengajuan');
													$this->db->join('tema','pengajuan.tema_id=tema.tema_id');
													$this->db->where('mhs_id',$_res['mhs_id']);
													$this->db->where('peng_status','DISETUJUI');
													$this->db->where('tapel_id',$_res['tapel_id']);
													$peng = $this->db->get();
													
													foreach($peng->result() as $p){ 
														$judul = $p->peng_judul; 
														$tema = $p->tema_nama;
												?>
												<td><?php echo $tema;  ?></td>
												<td><?php echo $judul; ?></td>
												<?php
													}
													foreach($dosen[$_res['mhs_id']] as $_dos) {
														if ($_dos=="Belum Dipilih"){
															echo "<td><p class='text-danger'>$_dos</p></td>"; 
														}
														else{
															echo "<td>$_dos</td>"; 
														}
													} 

													/*$this->db->select('pgw_nama');
													$this->db->from('dospem a');
													$this->db->join('pegawai b', 'a.pgw_id = b.pgw_id');
													//$this->db->join('mahasiswa c', 'a.mhs_id = c.mhs_id');
													$this->db->join('tapel g', 'a.tapel_id = g.tapel_id');
													$this->db->where('dospem.p1','1');
													$this->db->where('dospem.mhs_id',$_res['mhs_id']);
													$this->db->where('dospem.tapel_id',$_res['tapel_id']);
													$p1 = $this->db->get();*/
												?>
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