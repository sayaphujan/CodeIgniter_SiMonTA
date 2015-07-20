<?php
if(isset($_POST['detail'])){
$jur = $_POST['jurusan'];
$kon = $_POST['konsentrasi'];
$ang = $_POST['angkatan'];
redirect('admin/mahasiswa/detail/'.$jur.'/'.$kon.'/'.$ang);
}
?>
<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <!--<p><strong>LIST KONSENTRASI</strong></p>
                            <p><a href="<?php //echo site_url('admin/konsentrasi/add');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>-->
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th>JURUSAN</th>
												<th>KONSENTRASI</th>
                                                <th>ANGKATAN</th>
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
												<select class="form-control combo-status" name="angkatan" >
													<option value=''>Angkatan</option>
											<?php
												for ($i=2011;$i<=3000;$i++){
												echo"	<option value=$i>$i</option>";
												}
											?>
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
		