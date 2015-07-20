<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST BIMBINGAN</strong></p>
							<?php
							if($cektapel=='' || empty($cektapel) || $cekta=='' || empty($cekta) || $cekkrs=='' || empty($cekkrs)){
								echo"<button class='btn btn-default btn-square'>Add Data</button>";
							}else{ 
								if($cek->num_rows() <> 0){
									foreach($cek->result() as $r){ $st = $r->bimb_status; }
										//if($st=='REVISI - P1' || $st=='REVISI - P2'){
										if($st=='Menunggu Diperiksa' || $st=='Menunggu Diperiksa Dosen P1' || $st=='Diajukan Untuk Diperiksa Dosen P1' || $st=='ACC'){
											echo"<button class='btn btn-default btn-square'>Add Data</button>";
										}else{
											echo"
											<a href='".site_url('proposal/add')."'>
												<button class='btn btn-primary btn-square'>Add Data</button>
											</a>
											";
										}
								}else{
											echo"
											<a href='".site_url('proposal/add')."'>
												<button class='btn btn-primary btn-square'>Add Data</button>
											</a>
											";
								}
							}	
							?>
							<br /><br />
							<div class='inline-popups' style='float:right;'>
							&nbsp;&nbsp;&nbsp;
							<a href='#text-popup-html'class="btn btn-info btn-square">
								Topik Revisi Proposal Sidang
							</a>
								<div id="text-popup-html" class="white-popup mfp-with-anim mfp-hide">
									<div class="table-responsive">
										<table class="table table-th-block table-striped">
										<thead>
											<tr>
                                                <th>No</th>
												<th>Topik Revisi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
										<tbody>
											<?php $no=1; ?>
											<?php foreach ($topik->result() as $tpk){ ?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $tpk->topik_isi; ?></td>
												<td>
													<?php if($tpk->topik_status =='1'){ echo "TERPENUHI"; }else{echo "<p class='text-danger'>BELUM TERPENUHI</p>";} ?>
												</td>
											</tr>
											<?php }	?>
										</tbody>
										</table>
									</div>
								</div>
							</div>
							<br />
							<br />
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
											<tr>
                                                <th>NO</th>
												<th>PROPOSAL</th>
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
												<td>
													<a href="<?php echo site_url('proposal/get_file_prop/'.$key->lap_file); ?>">
														<?= substr($key->lap_file,14,5); ?>...
													</a>
												</td>
												<td><?php echo $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju; ?></td>
												<td><?php echo $key->lap_waktu; ?></td>
												<td>
													<?php if($key->bimb_status =="Menunggu Diperiksa" || $key->bimb_status == "Diajukan Untuk Diperiksa Dosen P1"){
														echo"
															<a href='".site_url('proposal/edit/'.$key->lap_id)."'>
															<button class='btn btn-xs btn-flat btn-success btnbrg-edit'>
																<i class='fa fa-edit'></i>
															</button>
															</a>
														";
													}else{
														echo"
															<button class='btn btn-xs btn-flat btn-default'>
																<i class='fa fa-edit'></i>
															</button>
														";
													}
													?>
												</td>
												<td><?php echo $key->bimb_status; ?></td>
												<?php 
													if($key->bimb_file=="Tak ada File Revisi"){ ?>
														<td><?= $key->bimb_file; ?></td>
												<?php } else { ?>
													<td><a href="<?php echo site_url('proposal/get_file_rev/'.$key->bimb_file); ?>"><?= substr($key->bimb_file,6,5); ?>...</a></td>
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
<script>$(document).ready(function(){
	$('.inline-popups').magnificPopup({
	  delegate: 'a',
	  removalDelay: 500,
	  callbacks: {
		beforeOpen: function() {
		   this.st.mainClass = this.st.el.attr('data-effect');
		}
	  },
	  midClick: true
	});
}); 
</script>