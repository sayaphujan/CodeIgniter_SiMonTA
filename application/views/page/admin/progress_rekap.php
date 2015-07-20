<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin/ta/detail/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest);?>">
							Rekap Data</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST DATA MAHASISWA TUGAS AKHIR/ SKRIPSI</strong></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>NO</th>
										<th>NIM</th>
										<th>NAMA</th>
										<th>KONSENTRASI</th>
										<th>DETAIL</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									foreach($mahasiswa->result() as $row){
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $row->mhs_nim;?></td>
										<td><?php echo $row->mhs_nama;?></td>
										<td><?php echo $row->kon_nama;?></td>
										<td>
											<a href='<?php echo site_url('admin/progress/detail_rekap/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest.'/'.$id.'/'.$row->mhs_id); ?>'>
												<button class="btn btn-xs btn-flat btn-info">
													Detail
												</button>
											</a>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div><!-- /.the-box full -->
				</div><!-- /.container-fluid" -->
			</div><!-- /.content-page-inner -->
						<!--
						<div class="row">
							<div class="col-sm-3 text-center">
								<div class="the-box">
									<p><strong>GENERAL</strong></p>
									<br />
									<i class="fa fa-cog icon-lg icon-primary icon-circle icon-bordered"></i>
									<br />
									<br />
									<p class="text-muted"><a href="#" class="btn btn-primary btn-square btn-small">See Detail <i class="fa fa-arrow-right"></i></a></p>
								</div>
							</div>
							<div class="col-sm-3 text-center">
								<div class="the-box">
									<p><strong>PROFILE</strong></p>
									<br />
									<i class="fa fa-smile-o icon-lg icon-primary icon-circle icon-bordered"></i>
									<br />
									<br />
									<p class="text-muted"><button type="button" onclick="notifSuccess('hello')" class="btn btn-primary btn-square btn-small">See Detail <i class="fa fa-arrow-right"></i></button></p>
								</div>
							</div>
							<div class="col-sm-3 text-center">
								<div class="the-box">
									<p><strong>ACCOUNT</strong></p>
									<br />
									<i class="fa fa-user icon-lg icon-primary icon-circle icon-bordered"></i>
									<br />
									<br />
									<p class="text-muted"><a href="#" class="btn btn-primary btn-square btn-small">See Detail <i class="fa fa-arrow-right"></i></a></p>
								</div>
							</div>
							<div class="col-sm-3 text-center">
								<div class="the-box">
									<p><strong>MESSAGE</strong></p>
									<br />
									<i class="fa fa-envelope icon-lg icon-primary icon-circle icon-bordered"></i>
									<br />
									<br />
									<p class="text-muted"><a href="#" class="btn btn-primary btn-square btn-small">See Detail <i class="fa fa-arrow-right"></i></a></p>
								</div>
							</div>
						</div>-->
<script>
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script> 