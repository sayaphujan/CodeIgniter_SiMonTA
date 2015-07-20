<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST KOMPETENSI</strong></p>
                            <p><a href="<?php echo site_url('admin/kompetensi/data');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>KOMPETENSI</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
										    $no=1;
											foreach($kompetensi->result() as $komp){
										  ?>
										   <tr>
											   <td><?php echo $no++?></td>
											   <td><?php echo $komp->komp_nama;?></td>
											   <td>
													<a href='<?php echo site_url('admin/kompetensi/data/'.$komp->komp_id); ?>'>
														<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
															<i class="fa fa-edit"></i>
														</button>
													</a>
													<a href='<?php echo site_url('admin/kompetensi/del/'.$komp->komp_id); ?>' onClick="return confirm('Anda yakin akan menghapus data ini ?')" >
														<button class="btn btn-xs btn-flat btn-danger btnbrg-del">
															<i class="fa fa-times"></i>
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