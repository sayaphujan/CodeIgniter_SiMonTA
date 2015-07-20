<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">tahun akademik</li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST TAHUN AKADEMIK</strong></p>
                            <p><a href="<?php echo site_url('admin/tapel/add');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>
							<?php 
								echo $error;
							?>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>TAHUN AKADEMIK</th>
												<th>TANGGAL MULAI</th>
												<th>TANGGAL AKHIR</th>
												<th>SEMESTER</th>
												<th>STATUS</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
											$no=1;
											foreach ($tapel as $t){
												$id		= $t->tapel_id;
												$akad	= $t->tapel_akad;
												$tapel1	= $t->tapel_mulai;
												$tapel2	= $t->tapel_akhir;
												$smest	= $t->tapel_semester;
												$status	= $t->tapel_status;
												
												$tahun_mulai = substr($tapel1,0,4);
												$bulan_mulai = substr($tapel1,5,2);
												$tanggal_mulai = substr($tapel1,8,2);
												
												$tahun_akhir = substr($tapel2,0,4);
												$bulan_akhir = substr($tapel2,5,2);
												$tanggal_akhir = substr($tapel2,8,2);
										   ?>
										   <tr>
												<td><?php echo $no++;?></td>
												<td><?php echo $akad;?></td>
												<td><?php echo $tanggal_mulai.'-'.$bulan_mulai.'-'.$tahun_mulai;?></td>
												<td><?php echo $tanggal_akhir.'-'.$bulan_akhir.'-'.$tahun_akhir;?></td>
												<td><?php echo $smest;?></td>
												<td>
												<?php if ($status==0){ ?>
													<a href='<?php echo site_url('admin/tapel/aktif/'.$id); ?>' onClick="return confirm('Anda yakin akan mengaktifkan data ini ?')"s>
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														Aktifkan
													</button>
													</a>
												<?php }else{ ?>
													<a href='<?php echo site_url('admin/tapel/aktif/'.$id); ?>' onClick="return confirm('Anda yakin akan menonaktifkan data ini ?')">
													<button class="btn btn-xs btn-flat btn-danger btnbrg-edit">
														Matikan
													</button>
													</a>
												<?php } ?>
												</td>
												<td>
													<a href='<?php echo site_url('admin/tapel/edit/'.$id); ?>'>
														<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
															<i class="fa fa-edit"></i>
														</button>
													</a>
													<a href='<?php echo site_url('admin/tapel/del/'.$id); ?>' onClick="return confirm('Anda yakin akan menghapus data ini ?')" >
														<button class="btn btn-xs btn-flat btn-danger btnbrg-del">
															<i class="fa fa-times"></i>
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
