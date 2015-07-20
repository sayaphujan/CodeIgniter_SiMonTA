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
											$no=1;
											foreach($mahasiswa->result() as $key)
											{
										?>
											<tr>
												<!--<td><input type="checkbox" name="get_cek[]" value=""></td>-->
												<td><?php echo $no++; ?></td>
												<td><?= $key->mhs_nim; ?></td>
												<td><?= $key->mhs_nama; ?></td>
												<td>
													<a href="<?php //echo site_url('admin/sidang/detail/'.$key->peng_id);?>" />
													<button class="btn btn-xs btn-flat btn-info btnbrg-edit" type="submit" name="detail" value="Detail">
														Detail
													</button>
													</a>
												</td>
												<td>
													<select class="form-control combo-status" name="status" id="combo-<?php echo $row->peng_id; ?>">
														<option value=''>- Pilih Disini -</option>
														<option value='LULUS'>LULUS</option>
														<option value='TIDAK LULUS'>TIDAK LULUS</option>
												   </select>
											   </td>
											   <td>
													<select class="form-control combo-status" name="status" id="combo-<?php echo $row->peng_id; ?>">
														<option value=''>- Pilih Disini -</option>
														<option value='ACC' >ACC</option>
														<option value='REVISI' >REVISI</option>
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