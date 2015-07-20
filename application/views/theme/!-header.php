<div class="row">
					<div class="col-sm-12">
						<div id="owl-example-shop" class="owl-carousel owl-theme">
						<?php
							foreach ($berita->result() as $brt){
								$id = $brt->berita_id;
								$judul = $brt->berita_judul;
								$isi = $brt->berita_isi;
								$gambar = $brt->berita_img;
						?>
						  <div class="item full">
							<div class="caption-text">
								<h1><?php echo $judul; ?></h1>
								<h4>
								<?php echo $isi; ?>
								</h4>
								<button class="btn btn-primary btn-square btn-sm">Selengkapnya</button>
							</div>
							<img src="<?php echo site_url('assets/berita/'.$gambar);?>" width="7520px" alt="<?php echo $gambar;?>">
						  </div>
						  <?php } ?>
						</div>
					</div><!-- /.col-sm-8 -->
					
				
				</div><!-- /.row -->
				