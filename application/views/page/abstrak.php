<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST BIMBINGAN</strong></p>
                            <p><a href="<?php echo site_url('pengajuan/addabs');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
											<tr>
                                                <th>NO</th>
												<th>ABSTRAK</th>
                                                <th>TANGGAL PENGAJUAN</th>
												<th>WAKTU PENGAJUAN</th>
												<th>AKSI</th>
												<th>STATUS</th>
												<th>REVISI</th>
												<th>BIMBINGAN</th>
												<th>TANGGAL BIMBINGAN</th>
												<th>WAKTU BIMBINGAN</th>
                                            </tr>
                                        </thead>
										<tbody>
										<?php
											$no=1;
											foreach($proposal->result() as $key){
											$tahun_aju = substr($key->lap_tgl,0,4);
											$bulan_aju = substr($key->lap_tgl,5,2);
											$tanggal_aju = substr($key->lap_tgl,8,2);
											
											$tahun_bim = substr($key->bimb_tgl,0,4);
											$bulan_bim = substr($key->bimb_tgl,5,2);
											$tanggal_bim = substr($key->bimb_tgl,8,2);
										?>
											<tr>
												<td><?php echo $no++;?></td>
												<td><a href="<?php echo ('proposal/get_file_prop/'.$key->lap_file); ?>"><?= substr($key->lap_file,14,5); ?>...</a></td>
												<td><?= $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju; ?></td>
												<td><?= $key->lap_waktu; ?></td>
												<?php if($key->bimb_status =="Menunggu Diperiksa"){ ?>
												<td>
													<a href='<?php echo site_url('pengajuan/editabs/'.$key->lap_id); ?>'>
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														<i class="fa fa-edit"></i>
													</button>
													</a>
												</td>
												<?php }else{ echo "
														<td>
															<button class='btn btn-xs btn-flat btn-default'>
																<i class='fa fa-edit'></i>
															</button>
														</td>"
															;} 
												?>
												<td><?= $key->bimb_status; ?></td>
												<?php 
													if($key->bimb_file=="Tak ada File Revisi"){ ?>
														<td><?= $key->bimb_file; ?></td>
												<?php } else { ?>
													<td><a href="<?php echo ('proposal/get_file_rev/'.$key->bimb_file); ?>"><?= substr($key->bimb_file,6,5); ?>...</a></td>
												<?php } ?>
												<td><?= $key->bimb_komentar; ?></td>
												<td><?= $tanggal_bim.'-'.$bulan_bim.'-'.$tahun_bim; ?></td>
												<td><?= $key->bimb_waktu; ?></td>
											</tr>
											<?php
											}
											?>
										</tbody>
                                    </table>
                                </div>
		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
<script>
$(document).ready(function() { $('#tbl-personal').dataTable(); } );
</script> 
<!--
<script>
$(document).ready(function() {

    var oTable = $('#tbl-personal').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": '<?php //echo site_url('proposal/get_prop');?>',
                "bJQueryUI": false,
                "iDisplayStart ":20,
                "oLanguage": {
            "sProcessing": ""
        },
        "oLanguage": {
            "sInfo": 'Showing _END_ Sources.',
            "sInfoEmpty": 'No entries to show',
            "sEmptyTable": "No Sources found currently, <a href='<?php //echo site_url('proposal/add');?>'>please add at least one.</a>",
        },  
        "fnInitComplete": function() {
                //oTable.fnAdjustColumnSizing();
         },
        'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            }
    } );

     $( document ).on( "change", ".combo-status", function() {
        var conf = confirm("Are you sure want to change this?");
        var status = $(this).val();
        var id = this.id.replace("combo-",'');
        if(conf){
           $.ajax({
           type: "GET",
           url: "<?php //echo site_url('proposal/change_status');?>",
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
</script> -->