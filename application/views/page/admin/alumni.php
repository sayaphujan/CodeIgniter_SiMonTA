<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb"><li><a href="<?php echo site_url('admin/ta/detail/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest);?>">
							Rekap Data</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>


						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>DATA PENUTUP</strong></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>NIM</th>
												<th>NAMA</th>
												<th>ANGKATAN</th>
												<th>SEMESTER</th>
												<th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
											$no=1;
											foreach ($alumni->result() as $t){
											$mhsid = $t->mhs_id;
											$mhsnim = $t->mhs_nim;
												/*get_last_bimb*/
												$this->db->select('*');
												$this->db->from('bimbingan');
												$this->db->join('laporan','laporan.lap_id=bimbingan.lap_id');
												$this->db->where('laporan.mhs_id',$mhsid);
												$this->db->order_by('bimbingan.bim_id','desc');
												$this->db->limit('1');
												$lastbim = $this->db->get();
												foreach($lastbim->result() as $g){
													$kat 	= $g->kat_lap_id;
													$status = $g->bimb_status;
												}
										   ?>
										   <tr>
												<td><?php echo $no++;?></td>
												<td><?php echo $mhsnim; ?></td>
												<td><?php echo $t->mhs_nama;?></td>
												<td><?php echo $t->angkatan;?></td>
												<td><?php echo $t->numsmester;?></td>
												<td>
												<?php 
												if($status=='ACC' && $kat=='16'){
													echo 'Telah menyelesaikan bimbingan tepat waktu';
												}else{
														echo 'Belum menyelesaikan bimbingan tepat waktu';
												}
												?>
												</td>
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
