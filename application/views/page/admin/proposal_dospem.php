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
							<a href="<?php echo site_url('admin/bimbingan');?>" class="btn btn-warning btn-square">Kembali</a>
							<br />
							<hr />
							<div class='inline-popups' style='float:right;'>
							<a href='#text-popup-html'class="btn btn-info btn-square">
								Topik Revisi Proposal Sidang
							</a>
								<div id="text-popup-html" class="white-popup mfp-with-anim mfp-hide">
									<form role='form' action='<?php echo site_url('admin/bimbingan/rev'); ?>' method="POST" >
									<input type='hidden' name='mhsid' id='mhsid' value='<?php echo $_res['mhs_id']; ?>' />
									
									<input type='hidden' name='pengid' id='pengid' value='<?php echo $_res['peng_id']; ?>' />
									<?php foreach ($topik->result() as $tpk){ ?>
									<input type='checkbox' name='topikid[]' id='topikid[]' value='<?php echo $tpk->topik_id; ?>' <?php if($tpk->topik_status =='1'){ echo "checked"; } ?> />
									&nbsp;&nbsp;
									<?php echo $tpk->topik_isi; ?>
									<br />
									<br />
									<?php }	?>
									<button class="btn btn-primary btn-square">Simpan</button>
									</form>
								</div>
							</div>
							<br /><br />
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
											$pengid = $this->uri->segment(5);
											foreach($proposal->result() as $key){
											$status = $key->bimb_status;
											$mhsid = $key->mhs_id;
											$dos_id = $key->dospem_id;
											
											$tahun_aju = substr($key->lap_tgl,0,4);
											$bulan_aju = substr($key->lap_tgl,5,2);
											$tanggal_aju = substr($key->lap_tgl,8,2);
											
											$tahun_bim = substr($key->bimb_tgl,0,4);
											$bulan_bim = substr($key->bimb_tgl,5,2);
											$tanggal_bim = substr($key->bimb_tgl,8,2);
										?>
											<tr>
												<td><?php echo $no++;?></td>
												
												<td><?php echo $key->kat_lap; ?></td>
												
												<td>
													<a href="<?php echo site_url('admin/proposal/get_file_prop/'.$key->kat_lap_id.'/'.$key->lap_file); ?>"><?= substr($key->lap_file,14,5); ?></a>
												</td>
												
												<td><?php echo $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju; ?></td>
												
												<td><?php echo $key->lap_waktu; ?></td>
												
												<td><?php echo $status; ?></td>
												
												<td>
												<?php 
													if($key->bimb_file=="Tak ada File Revisi"){
														echo $key->bimb_file;
													} else {
														echo "
															<a href='".site_url('admin/proposal/get_file_rev/'.$key->kat_lap_id.'/'.$key->bimb_file)."'>
															".substr($key->bimb_file,14,5)."
															</a>
															";
													} ?>
												</td>
												
												<td><?php echo $key->bimb_komentar; ?></td>
												
												<td><?php echo $tanggal_bim.'-'.$bulan_bim.'-'.$tahun_bim; ?></td>
												
												<td><?php echo $key->bimb_waktu; ?></td>
												
												<td>
													<?php
													
													foreach($terakhir->result() as $s){
														$lapid  = $s->lap_id;
													}
													
													if ($key->lap_id==$lapid){
														if($dos_id % 2 == 0){
														//genap == P2
															if($status=='Menunggu Diperiksa' or $status=='REVISI - P2'){
															echo"
																<a href='".site_url('admin/bimbingan/edit/'.$key->lap_id.'/'.$pengid)."'>
																	<button class='btn btn-xs btn-flat btn-success'>
																		<i class='fa fa-edit'></i>
																	</button>
																</a>
																";
															}else{
																echo"
																	<button class='btn btn-xs btn-flat btn-default'>
																		<i class='fa fa-edit'></i>
																	</button>
																	";
																}
														}
														
														if($dos_id % 2 == 1){
														//ganjil == P1
															if($status != 'ACC'){
																echo"
																	<a href='".site_url('admin/bimbingan/edit/'.$key->lap_id.'/'.$pengid)."'>
																		<button class='btn btn-xs btn-flat btn-success'>
																			<i class='fa fa-edit'></i>
																		</button>
																	</a>
																	";
															}else{
																echo"
																	<button class='btn btn-xs btn-flat btn-default'>
																		<i class='fa fa-edit'></i>
																	</button>
																	";
																}
														}
													}else { 
														echo"
															<button class='btn btn-xs btn-flat btn-default'>
																<i class='fa fa-edit'></i>
															</button>
															";
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
<script>$(document).ready(function(){
	$('.inline-popups').magnificPopup({
	  delegate: 'a',
	  removalDelay: 500,
	  callbacks: {
		beforeOpen: function() {
		   this.st.mainClass = this.st.el.attr('data-effect');
		}
	  },
	  midClick: true
	});
}); 
</script>