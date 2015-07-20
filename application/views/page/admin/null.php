<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<!--<div class="the-box full">-->
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
							<div class="alert alert-warning fade in alert-dismissable">
							<?php 
								if($this->uri->segment(3)=="custom"){
									$this->db->select('*');
									$this->db->where('mhs_id',$this->uri->segment(4));
									$sql = $this->db->get('mahasiswa');
									foreach ($sql->result() as $m){
										echo"<p><strong>Maaf. Halaman yang Anda minta tidak dapat kami tampilkan karena <i><u>$m->mhs_nama</u></i> Telah Membatalkan Pengajuan Judul.</strong></p>";
									}									
								}else if($this->uri->segment(2)=='sidang'){
									echo "<p><strong>Maaf. Tidak ada data yang dapat ditampilkan saat ini.</strong></p>";
								}else{
									echo "<p><strong>Maaf. Tidak ada data yang dapat ditampilkan saat ini.</strong></p>";
								}
							?>
							</div>
                            </div>
						<!--</div> /.the-box full -->
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
