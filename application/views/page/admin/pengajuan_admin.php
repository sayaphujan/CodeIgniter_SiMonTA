<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">pengajuan</li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST PENGAJUAN JUDUL</strong></p>
							<?php echo $error; ?>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>NIM</th>
                                                <th>TEMA</th>
												<th>JUDUL</th>
												<th>STATUS PERSETUJUAN</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$no=1;
										foreach($pengajuan->result() as $row){ 
										?>
											<tr>
												<td><?php echo $no++;?> </td>
												<td><?php echo $row->mhs_nim;?> </td>
												<td><?php echo $row->tema_nama;?> </td>
												<td><?php echo $row->peng_judul;?>	</td>
												<td><?php echo $row->peng_status;?>	</td>
												<td class="center">
												<a href="<?php echo site_url('admin/pengajuan_admin/del/'.$row->peng_id);?>" onClick="return confirm('Anda yakin akan menghapus data ini ?')" />
													<button class="btn btn-xs btn-flat btn-danger btnbrg-del">
														<i class="fa fa-times"></i>
													</button>
												</a>
												</td>
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
$(function () {
                //Box Konfirmasi Hapus
                $('#konfirm-box').dialog({
                    modal: true,
                    autoOpen: false,
                    show: "bounce",
                    hide: "explode",
                    title: "Konfirmasi",
                    buttons: {
                    
                        "Oke": function () {
                        jQuery.ajax({
                        success: function(){
                        notifSuccess();
                        }
                        });
                        $(this).dialog("close");
                        },

                        "Batal": function () {
                        //jika memilih tombol batal
                        $(this).dialog("close");
                        
                        }
                    }
                });
            });
function notifSuccess(){
                PNotify.prototype.options.styling = "fontawesome";
                var notice = new PNotify({
                    title: 'Sukses',
                    text: msg,
                    buttons:{
                        sticker:false,
                        closer : false
                    },
                    opacity: .8,
                    delay:5000,
                    type: 'success',
                    cornerclass: 'ui-pnotify-sharp'
                });
                notice.get().click(function(){
                    notice.remove();
                });
            }
</script>