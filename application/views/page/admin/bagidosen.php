<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST PEMBAGIAN DOSEN</strong></p>
							                            <p><a href="<?php echo site_url('admin/dosen/bagiadd');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!--<th><input type="checkbox" name="cek_all" value="all"></th>-->
												<th>NO</th>
												<th>NAMA</th>
												<th>DOSEN P1</th>
												<th>DOSEN P2</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$no=1;
											foreach($bagi->result_array() as $key=>$_res)
											{
										?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $_res['pgw_nama']; ?></td>
												<td><?php echo $_res['p1']; ?></td>
												<td><?php echo $_res['p2']; ?></td>
												<td>
													<a href='<?php echo site_url('admin/dosen/bagiedit/'.$_res['bagi_id']); ?>'>
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														<i class="fa fa-edit"></i>
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