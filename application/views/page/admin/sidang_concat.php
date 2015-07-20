<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST PESERTA SIDANG</strong></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!--<th><input type="checkbox" name="cek_all" value="all"></th>-->
												<th>NO</th>
												<th>NIM</th>
												<th>NAMA</th>
												<th>TEMA</th>
												<th>JUDUL</th>
												<th>NILAI P1</th>
												<th>NILAI P2</th>
												<th>NILAI AKHIR</th>
												<th>STATUS</th>
												<th>DETAIL</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											foreach($result as $key=>$_res)
											{
											$stat 		= $_res['sidang_revisi'];
											$stat_sidang= $_res['sidang_status'];
											if($stat_sidang=='TIDAK LULUS'){
												$printstat="<p class='text-danger'>TIDAK LULUS</p>";
											}else if($stat=='REVISI'){
												$printstat="Lulus dengan Perbaikan";
											}else if($stat=='ACC'){
												$printstat="Lulus tanpa Perbaikan";
											}else{
												$printstat="PENDING";
											}
											
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
											
										?>
											<tr>
												<!--<td><input type="checkbox" name="get_cek[]" value=""></td>-->
												<td><?php echo $key+1; ?></td>
												<td><?php echo $_res['mhs_nim']; ?></td>
												<td><?php echo $_res['mhs_nama']; ?></td>
												<td><?php echo $tema;  ?></td>
												<td><?php echo $judul; ?></td>
												<td><?php echo $_res['nilaiP1']; ?></td>
												<td><?php echo $_res['nilaiP2']; ?></td>
												<td><?php echo $_res['nilaiAkhir']; ?></td>
												<td><?php echo $printstat; ?></td>
												<td>
													<a href="<?php echo site_url('admin/sidang/detail/'.$pengid); ?>">
													<button class="btn btn-xs btn-flat btn-info btnbrg-edit">
														Detail
													</button>
													</a>
												</td>
												<td>
												<?php if ($_res['aktifasi']=='nonaktif'){
												echo "
													<button class='btn btn-xs btn-flat btn-default btnbrg-edit'>
														<i class='fa fa-edit'></i>
													</button>
												";
												}else{?>
													<a href='<?php echo site_url('admin/sidang/nilai/'.$_res['mhs_id']); ?>'>
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														<i class="fa fa-edit"></i>
													</button>
													</a>
												<?php } ?>
													
												</td>
											</tr>
											
											<?php
											}}
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