<?php
if(isset($_POST['detail'])){
$jur 	= $_POST['jurusan'];
$kon 	= $_POST['konsentrasi'];
$akad	= $_POST['akademik'];
$smest	= $_POST['semester'];
redirect('admin/ta/detail/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest);
}
?>
<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">Rekap Data</li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th>JURUSAN</th>
												<th>KONSENTRASI</th>
                                                <th>TAHUN AKADEMIK</th>
												<th>SEMESTER</th>
												<th>DETAIL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
											<?php
												foreach($konsentrasi->result() as $row){
													$jur_id = $row->jur_id;
													$jur = $row->jur_nama;
													$kon_id = $row->kon_id;
													$kon = $row->kon_nama;
											?>
											<form method="POST">
												<tr>
												<td><input type="hidden" name="jurusan" value="<?php echo $jur_id; ?>" /><?php echo $jur; ?></td>
												<td><input type="hidden" name="konsentrasi" value="<?php echo $kon_id; ?>"><?php echo $kon; ?></td>
												<td>
												<select class="form-control combo-status" name="akademik" >
													<option value=''>Akademik</option>
											<?php
												foreach ($akademik as $tapel){
												echo"	<option value=$tapel->tapel_id>$tapel->tapel_akad</option>";
												}
											?>
												</select>
												</td>
												<td>
												<select class="form-control combo-status" name="semester" >
													<option value=''>Semester</option>
													<option value='1'>GASAL</option>
													<option value='2'>GENAP</option>
												</select>
												</td>
												<td><button class="btn btn-xs btn-flat btn-info btnbrg-edit" type="submit" name="detail" value="Detail">
														Detail
													</button>
													<!--<input type="submit" name="detail" value="Detail"></td>-->
												</tr>
												</form>
											<?php
											}
											?>
                                                
                                        </tbody>
                                    </table>
                                </div>
						</div><!-- /.the-box full -->
		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
		