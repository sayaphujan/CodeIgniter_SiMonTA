<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<?php
							
							if($tugas){
								echo"
								<div class='alert alert-success alert-bold-border fade in alert-dismissable'>
									<h3>TUGAS TAMBAHAN</h3>
								</div>
								";
							}else{
								echo"
								<p></p>
								";
							}
							foreach($tugas as $key){
						?>
						
						<div class="row">
							<div class="col-sm-3 text-center">
								<div class="the-box">
									<p><strong>Data <br /> <?php echo $key->level_name; ?></strong></p>
									<i class="fa fa-user icon-lg icon-primary icon-circle icon-bordered"></i>
									<br />
									<br />
									<?php
									
										$this->db->select('*'); 
										$this->db->from('akses');
										$this->db->join('menu','akses.menu=menu.menu_id');
										$this->db->join('leveluser','akses.level_id=leveluser.level_id');
										$this->db->where('leveluser.level_name',$key->level_name);
										$this->db->where('akses_status','AKTIF');
										$query = $this->db->get();
										
										foreach($query->result() as $key){
									?>
									<p class="text-muted"><a href="<?php echo site_url($key->menu_path); ?>" class="btn btn-primary btn-square btn-large"><?php echo $key->menu_description; ?></a></p>
									<?php 
										} 
									?>
								</div>
							</div>							
						
								<div class="col-sm-3 text-center">
									<div class="the-box" >
										<p><strong>Rekap Data <br />Dosen Pembimbing</strong></p>
										<i class="fa fa-book icon-lg icon-primary icon-circle icon-bordered"></i>
										<br />
										<br />
										<?php
											foreach($query->result() as $keys){
										?>
											<p class="text-muted">
												<a href="<?php echo site_url($keys->menu_path.'/rd'); ?>" class="btn btn-primary btn-square btn-large">Rekap
												<?php echo $keys->menu_description; ?>
												</a>
											</p>
											<?php 
												} 
											?>
									</div>
								</div>
							<?php }?>
						</div>
