<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST PESERTA SIDANG</strong></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!--<th><input type="checkbox" name="cek_all" value="all"></th>-->
												<th rowspan=2>NO</th>
												<th rowspan=2>NIM</th>
												<th rowspan=2>NAMA</th>
												<th rowspan=2>TEMA</th>
												<th rowspan=2>JUDUL</th>
												<th rowspan=2>DETAIL</th>
												<th colspan=2>STATUS</th>
                                            </tr>
											<tr>
												<th>SIDANG</th>
												<th>PROPOSAL</th>
											</tr>
                                        </thead>
                                        <tbody>
										<?php
											foreach($result as $key=>$_res)
											{
											$status_sidang = $_res['sidang_status'];
											$status_revisi = $_res['sidang_revisi'];
										?>
											<tr>
												<!--<td><input type="checkbox" name="get_cek[]" value=""></td>-->
												<td><?php echo $key+1; ?></td>
												<td><?= $_res['mhs_nim']; ?></td>
												<td><?= $_res['mhs_nama']; ?></td>
												<td><?= $_res['tema_nama']; ?></td>
												<td><?= $_res['peng_judul']; ?></td>
												<td>
													<a href='<?php echo site_url('admin/sidang/detail/'.$_res['peng_id']); ?>'>
													<button class="btn btn-xs btn-flat btn-info btnbrg-edit">
														Detail
													</button>
													</a>
												</td>
												<td>
													<select class="form-control combo-sidang" name="sidang" id="combo-<?php echo $_res['mhs_id']; ?>">
														<option value='PENDING' <?php if($status_sidang=="PENDING") { echo "selected"; } ?>>PENDING</option>
														<option value='LULUS' <?php if($status_sidang=="LULUS") { echo "selected"; } ?>>LULUS</option>
														<option value='TIDAK LULUS' <?php if($status_sidang=="TIDAK LULUS") { echo "selected"; } ?>>TIDAK LULUS</option>
												   </select>
											   </td>
											   <td>
													<select class="form-control combo-proposal" name="proposal" id="combo-<?php echo $_res['mhs_id']; ?>">
													<option value='PENDING' <?php if($status_revisi=="PENDING") { echo "selected"; } ?>>PENDING</option>
														<option value='ACC' <?php if($status_revisi=="ACC") { echo "selected"; } ?>>ACC</option>
														<option value='REVISI' <?php if($status_revisi=="REVISI") { echo "selected"; } ?>>REVISI</option>
												   </select>
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
	$(document).ready(function() { 
		$('#tbl-personal').dataTable(); 
	} );

	$( document ).on( "change", ".combo-sidang", function() {
        var conf = confirm("Anda yakin akan mengubah Status ini?");
        var status = $(this).val();
        var id = this.id.replace("combo-",'');
        if(conf){
           $.ajax({
           type: "GET",
           url: "<?php echo site_url('admin/sidang/change_sidang');?>",
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
	
	$( document ).on( "change", ".combo-proposal", function() {
        var conf = confirm("Anda yakin akan mengubah Status ini?");
        var status = $(this).val();
        var id = this.id.replace("combo-",'');
        if(conf){
           $.ajax({
           type: "GET",
           url: "<?php echo site_url('admin/sidang/change_proposal');?>",
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