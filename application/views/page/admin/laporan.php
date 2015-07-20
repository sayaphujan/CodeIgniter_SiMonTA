<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST PENGAJUAN PROPOSAL</strong></p>
                            <!--<p><a href="<?php echo site_url('admin/proposal/add');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>-->
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
											<tr>
                                                <th rowspan=2>BAB</th>
												<th rowspan=2>NIM</th>
												<th rowspan=2>FILE</th>
                                                <th rowspan=2>TANGGAL</th>
												<th rowspan=2>WAKTU</th>
												<th colspan=3>DOSEN PEMBIMBING</th>
												<th rowspan=2>AKSI</th>
                                            </tr>
                                            <tr>
                                                
												<th>REVISI</th>
												<th>BIMBINGAN</th>
												<th>STATUS</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
						</div><!-- /.the-box full -->
		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->

<script>
$(document).ready(function() {

    var oTable = $('#tbl-personal').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": '<?php echo site_url('admin/proposal/get_prop');?>',
                "bJQueryUI": false,
                "iDisplayStart ":20,
                "oLanguage": {
            "sProcessing": ""
        },
        "oLanguage": {
            "sInfo": 'Showing _END_ Sources.',
            "sInfoEmpty": 'No entries to show',
            "sEmptyTable": "No Sources found currently, <a href='<?php echo site_url('admin/pengajuan/add');?>'>please add at least one.</a>",
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