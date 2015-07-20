<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST LEVEL DOSEN</strong></p>
                            <!--<p><a href="<?php echo site_url('admin/akses/add');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>-->
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>DOSEN</th>
												<th>LEVEL</th>
												<th>AKSI</th>
												<th>DETAIL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
										    $no=1;
											foreach($result as $key=>$_res)
											{
										  ?>
										   <tr>
											   <td><?php echo $no++?></td>
											   <td><?php echo $_res['pgw_nama'];?></td>
											   <td>
											   <?php
													foreach($dosen[$_res['pgw_id']] as $_dos) {
														echo "$_dos, "; 
													} 
												?>
											   </td>
											   <td>
											   <a href='<?php echo site_url('admin/akses/edit/'.$_res['pgw_id']); ?>'>
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														<i class="fa fa-edit"></i>
													</button>
												</a>
												</td>
												<td>
											   <a href='<?php echo site_url('admin/akses/detail/'.$_res['pgw_id']); ?>'>
													<button class="btn btn-xs btn-flat btn-info">
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