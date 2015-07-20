<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST HAK AKSES</strong></p>
							<?php
							foreach($result as $key=>$_res){
								echo "Dosen : ".$_res['pgw_nama'];
								echo "<br />";
								echo "Level : ";
								foreach($dosen[$_res['pgw_id']] as $_dos) {
									echo "$_dos, "; 
								}							
							}
							?>
							<br />
							<br />
                            <p><a href="<?php echo site_url('admin/akses');?>"><button class="btn btn-warning btn-square">Kembali</button></a></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
												<th>LEVEL</th>
                                                <th>MENU</th>
												<th>STATUS</th>
												<!--<th>AKSI</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
										    $no=1;
											
											foreach($akses->result() as $aks){
												$status = $aks->akses_status;
												$combo_id = $aks->akses_id;
										  ?>
										   <tr>
											   <td><?php echo $no++?></td>
											   <td><?php echo $aks->level_name;?></td>
											   <td><?php echo $aks->menu_description;?></td>
											   <td><select class="form-control combo-status" name="status" id="combo-<?php echo $combo_id; ?>">
													<option value='AKTIF' <?php if($status=="AKTIF") { echo "selected"; } ?>>AKTIF</option>
													<option value='NON-AKTIF' <?php if($status=="NON-AKTIF") { echo "selected"; } ?>>NON AKTIF</option>
												   </select>
											   </td>
											   <!--
											   <td>
													<a href='<?php //echo site_url('admin/akses/del/'.$aks->leveldos_id.'/'.$aks->akses_id); ?>' onClick="return confirm('Anda yakin akan menghapus data ini ?')" >
														<button class="btn btn-xs btn-flat btn-danger btnbrg-del">
															<i class="fa fa-times"></i>
														</button>
													</a>
											   </td>-->
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
	$(document).ready(function() { 
		$('#tbl-personal').dataTable(); 
	} );

	$( document ).on( "change", ".combo-status", function() {
        var conf = confirm("Anda yakin akan mengubah Status ini?");
        var status = $(this).val();
        var id = this.id.replace("combo-",'');
        if(conf){
           $.ajax({
           type: "GET",
           url: "<?php echo site_url('admin/akses/change_status');?>",
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
			
    function notifSuccess(msg){
                
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