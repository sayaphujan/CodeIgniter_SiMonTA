<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<?php
								foreach($jurusan->result() as $jur){
									foreach($konsentrasi->result() as $kon){									
							?>
							<!--<li class="active"><?php //echo $this->router->fetch_class();?></li>-->
							<li class="active"><?php echo $jur->jur_nama;?>/ <?php echo $kon->kon_nama;?></li>
							<?php
					}}
				?>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <!--<p><strong>LIST MAHASISWA</strong></p>-->
                            <p><a href="<?php echo site_url('admin/mahasiswa/add/'.$jur->jur_id.'/'.$kon->kon_id.'/'.$this->uri->segment(6));?>"><button class="btn btn-primary btn-square">Add Data</button></a></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                            	<th width='5%'>NO</th>
												<th width='20%'>NIM</th>
												<th width='40%'>NAMA</th>
                                                <th width='15%'>FOTO</th>
												<th width='10%'>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$no=1;
											foreach($mahasiswa->result() as $mhs){
												$id = $mhs->mhs_id;
												$nim = $mhs->mhs_nim;
												$nama = $mhs->mhs_nama;
												$foto = $mhs->mhs_foto;
										?>
                                           <tr>
                                           		<td><?php echo $no++; ?></td>
												<td><?php echo $nim; ?></td>
												<td><?php echo $nama; ?></td>
                                                <td><img src='<?php echo site_url('assets/mahasiswa/'.$foto); ?>' width='50%'></td>
												<td><a href='<?php echo site_url('admin/mahasiswa/edit/'.$jur->jur_id.'/'.$kon->kon_id.'/'.$this->uri->segment(6).'/'.$id); ?>'>
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														<i class="fa fa-edit"></i>
													</button>
													</a>
													<a href='<?php echo site_url('admin/mahasiswa/del/'.$jur->jur_id.'/'.$kon->kon_id.'/'.$this->uri->segment(6).'/'.$id); ?>' onClick="return confirm('Anda yakin akan menghapus data ini ?')" >
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
<!--<script>
$(document).ready(function() {

    var oTable = $('#tbl-personal').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": '<?php //echo site_url('admin/mahasiswa/detail');?>',
                "bJQueryUI": false,
                "iDisplayStart ":20,
                "oLanguage": {
            "sProcessing": ""
        },
        "oLanguage": {
            "sInfo": 'Showing _END_ Sources.',
            "sInfoEmpty": 'No entries to show',
            "sEmptyTable": "No Sources found currently, <a href='<?php //echo site_url('admin/jabatan/add');?>'>please add at least one.</a>",
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
</script> -->