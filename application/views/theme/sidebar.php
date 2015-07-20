<!-- if not login -->
					<h4 class="sidebar-title">POPULAR POST</h4>
						  <?php
							foreach($berita->result() as $b){
						  ?>
						<ul class="media-list">
						  <li class="media sidebar">
							<a class="pull-left" href="#fakelink">
							<img src="<?php echo site_url('assets/berita/'.$b->berita_img);?>" width=30 class="media-object big-img img-responsive" alt="">
						  </a>
							<div class="media-body">
							  <h4 class="media-heading"><a href=<?php echo site_url('beranda/selengkapnya/'.$b->berita_id);?>><?php echo $b->berita_judul; ?></a></h4>
							</div>
						</ul>
						<br />
						<?php
						}
						?>
