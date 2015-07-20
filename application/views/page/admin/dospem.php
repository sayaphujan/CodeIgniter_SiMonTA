<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="the-box full">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                            <p><strong>LIST DOSEN PEMBIMBING</strong></p>
							<table id="tbl-personal" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!--<th><input type="checkbox" name="cek_all" value="all"></th>-->
												<th>NO</th>
												<th>NIM</th>
												<th>NAMA</th>
                                                <th>TEMA</th>
												<th>JUDUL</th>
												<th>DOSEN P1</th>
												<th>DOSEN P2</th>
												<th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											foreach($result as $key=>$_res)
											{
												$this->db->select('*');
												$this->db->from('pengajuan');
												$this->db->join('tema','pengajuan.tema_id=tema.tema_id');
												$this->db->where('mhs_id',$_res['mhs_id']);
												$this->db->where('peng_status','DISETUJUI');
												$this->db->where('tapel_id',$_res['tapel_id']);
												$peng = $this->db->get();
													foreach($peng->result() as $p){ 
														$judul = $p->peng_judul; 
														$tema = $p->tema_nama;
										?>
											<tr>
												<!--<td><input type="checkbox" name="get_cek[]" value=""></td>-->
												<td><?php echo $key+1; ?></td>
												<td><?php echo $_res['mhs_nim']; ?></td>
												<td><?php echo $_res['mhs_nama']; ?></td>
												<?php
													$this->db->select('*');
													$this->db->from('pengajuan');
													$this->db->join('tema','pengajuan.tema_id=tema.tema_id');
													$this->db->where('mhs_id',$_res['mhs_id']);
													$this->db->where('peng_status','DISETUJUI');
													$this->db->where('tapel_id',$_res['tapel_id']);
													$peng = $this->db->get();
													
												?>
												<td><?php echo $tema;  ?></td>
												<td><?php echo $judul; ?></td>
												<?php
													foreach($dosen[$_res['mhs_id']] as $_dos) {
														if ($_dos=="Belum Dipilih"){
															echo "<td><p class='text-danger'>$_dos</p></td>"; 
														}
														else{
															echo "<td>$_dos</td>"; 
														}
													} 
												?>
												<td>
													<a href='<?php echo site_url('admin/dospem/edit/'.$_res['mhs_id']); ?>'>
													<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
														<i class="fa fa-edit"></i>
													</button>
													</a>
													<!--<a href='<?php //echo site_url('admin/dospem/del/'.$_res['mhs_id']); ?>' onClick="return confirm('Anda yakin akan menghapus data ini ?')" >
														<button class="btn btn-xs btn-flat btn-danger btnbrg-del">
															<i class="fa fa-times"></i>
														</button>
													</a>-->
												</td>
												</tr>
											
											<?php
											}}
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