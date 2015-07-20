<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST PENGAJUAN JUDUL</strong></p>
                            <!--<p><a href="<?php //echo site_url('admin/pengajuan/add');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>-->

							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>NIM</th>
												<th>NAMA</th>
                                                <th>TEMA</th>
												<th>JUDUL</th>
												<th>DETAIL</th>
												<th>TANGGAL</th>
												<th>WAKTU</th>
												<th>STATUS</th>
												<th>KOMENTAR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										   <?php
											$no=1;
											$combo_id=0;
												foreach($pengajuan->result() as $p){
													$nim 	= $p->mhs_nim;
													$nama 	= $p->mhs_nama;
													$tema 	= $p->tema_nama;
													$judul	= $p->peng_judul;
													//$file	= $p->peng_file;
													$tanggal= $p->peng_tanggal;
													$waktu	= $p->peng_waktu;
													$status	= $p->peng_status;
													$koment	= $p->peng_komentar;
													
													$tahun_aju = substr($tanggal,0,4);
													$bulan_aju = substr($tanggal,5,2);
													$tanggal_aju = substr($tanggal,8,2);
											?>
										<tr>
                                           <td><?php echo $no++; ?></td>
										   <td><?php echo $nim; ?></td>
										   <td><?php echo $nama;?></td>
										   <td><?php echo $tema; ?></td>
										   <td><?php echo $judul; ?></td>
										   <!--<td><a href="<?php //echo site_url('admin/pengajuan/get_file/'.$p->peng_file.'/'.$p->peng_id);?>"><?php //echo $file ?></a></td>-->
										   <td><a href="<?php echo site_url('admin/pengajuan/detail/'.$p->peng_id);?>" />
													<button class="btn btn-xs btn-flat btn-info btnbrg-edit" type="submit" name="detail" value="Detail">
														Detail
													</button>
													</a>
												</td>
										   <td><?php echo $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju;?></td>
										   <td><?php echo $waktu?></td>
										   <td>
												<select class="form-control combo-status" name="status" id="combo-<?php echo $p->peng_id; ?>">
													<option value='DISETUJUI' <?php if($status=="DISETUJUI") { echo "selected"; } ?>>DISETUJUI</option>
													<option value='DITOLAK' <?php if($status=="DITOLAK") { echo "selected"; } ?>>DITOLAK</option>
													<option value='PENDING' <?php if($status=="PENDING") { echo "selected"; } ?>>PENDING</option>
											   </select>
										   </td>
										   <td>
												<form id="myForm" method="POST" action="<?=site_url('admin/pengajuan/change_komentar'); ?>">
												<input type="hidden" name="id" value="<?php echo $p->peng_id;?>">
												<input type="text" name="komentar" value="<?php if($koment !='Belum Ada Komentar'){echo $koment;}?>" <?php if($koment=='Belum Ada Komentar'){echo "placeholder='Belum Ada Komentar'";}?>">
													<button class="btn btn-xs btn-flat btn-primary btnbrg-edit" type="submit">
														Simpan
													</button>
													
												</form>
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
	$(document).ready(function() { 
		$('#tbl-personal').dataTable(); 
	
    $( document ).on( "change", ".combo-status", function() {
        var conf = confirm("Are you sure want to change this?");
        var status = $(this).val();
        var id = this.id.replace("combo-",'');
        if(conf){
           $.ajax({
           type: "GET",
           url: "<?php echo site_url('admin/pengajuan/change_status');?>",
           dataType : "json",
           data: {
                "id":id,
                "status":status
           },
           success: function(data){
              if(data){
                notifSuccess(data.msg);
              }
           }
           });
        }else{
           oTable.fnDraw();
        }
  });

	} );

    function notifSuccess(msg){
                
                PNotify.prototype.options.styling = "fontawesome";
                var notice = new PNotify({
                    title: '',
                    text: msg,
                    buttons:{
                        sticker:false,
                        closer : false
                    },
                    opacity: 8,
                    delay:5000,
                    type: 'success',
                    cornerclass: 'ui-pnotify-sharp'
                });
                notice.get().click(function(){
                    notice.remove();
                });
            }
			
	</script> 