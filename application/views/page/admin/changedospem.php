<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST MAHASISWA ALIH BIMBINGAN</strong></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!--<th><input type="checkbox" name="cek_all" value="all"></th>-->
												<th>NO</th>
												<th>NIM</th>
												<th>NAMA</th>
												<th>TEMA</th>
												<th>JUDUL</th>
												<th>DOSEN</th>
												<th>STATUS</th>
												<th>DETAIL</th>
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
												<td><?php echo $_res['mhs_nim']; ?></td>
												<td><?php echo $_res['mhs_nama']; ?></td>
												<td><?php echo $_res['tema_nama']; ?></td>
												<td><?php echo $_res['peng_judul']; ?></td>
												<td><?php echo $_res['pgw_nama']; ?></td>
												<td><?php echo $_res['dos_status']; ?></td>
												<td>
													<a href='<?php echo site_url('admin/dospem/detail_change/'.$_res['mhs_id'].'/'.$_res['pgw_id'].'/'.$_res['tapel_id']); ?>'>
													<button class="btn btn-xs btn-flat btn-info btnbrg-edit">
														Detail
													</button>
													</a>
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
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script>