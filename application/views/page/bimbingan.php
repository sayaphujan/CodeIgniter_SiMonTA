						<ol class="breadcrumb">
							<li><a href="#fakelink">Admin</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST JABATAN</strong></p>
                            <p><a href="<?php echo site_url('admin/jabatan/add');?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>JABATAN</th>
                                                <th>STATUS</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>

<script>
$(document).ready(function() {

    var oTable = $('#tbl-personal').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": '<?php echo site_url('bimbingan/get_jab');?>',
                "bJQueryUI": false,
                "iDisplayStart ":20,
                "oLanguage": {
            "sProcessing": ""
        },
        "oLanguage": {
            "sInfo": 'Showing _END_ Sources.',
            "sInfoEmpty": 'No entries to show',
            "sEmptyTable": "No Sources found currently, <a href='<?php echo site_url('admin/jabatan/add');?>'>please add at least one.</a>",
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
	} );
</script> 