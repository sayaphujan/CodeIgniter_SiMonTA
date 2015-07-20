<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>PROGRESS</strong></p>
							<table border=0>
							     <?php
											foreach($result as $key=>$_res)
											{
										  ?>
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
							<hr />
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th rowspan=2>NO</th>
                                                <th rowspan=2>KATEGORI LAPORAN</th>
												<th colspan=2>PENGAJUAN</th>
												<th rowspan=2>STATUS PERSETUJUAN</th>
												<th colspan=2>BIMBINGAN</th>
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
										foreach($progress->result() as $row){ 
										?>
											<tr>
												<td><?php echo $no++;?> </td>
												<td><?php echo $row->kat_lap;?>	</td>
												<td><?php echo $row->lap_tgl;?>	</td>
												<td><?php echo $row->lap_waktu;?>	</td>
												<td><?php echo $row->bimb_status;?>	</td>
												<td><?php echo $row->bimb_tgl;?>	</td>
												<td><?php echo $row->bimb_waktu;?>	</td>
											</tr>
											<?php }	?>
										</tbody>
							</table>
							</div>
					</div><!-- /.the-box full -->
				</div><!-- /.container-fluid" -->
			</div><!-- /.content-page-inner -->
<script>
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script> 