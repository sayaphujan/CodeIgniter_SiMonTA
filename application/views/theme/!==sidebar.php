<!-- if login -->
<?php 
$side = $this->session->userdata('levelid');
	if($side == 6):
	foreach($mhs->result() as $m){
		$nim	=$m->mhs_nim;
		$nama	=$m->mhs_nama;
		$foto	=$m->mhs_foto;
		$jur	=$m->jur_nama;
		$kons	=$m->kon_nama;
	}
?>
<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading text-center"><?php echo $nim; ?></div>
	<div class="panel-body">
	<p class="text-center"><img src="<?php echo site_url('assets/mahasiswa/'.$foto); ?>" class="media-object big-img img-responsive" alt="<?php echo $nim; ?>"></p>
	</div>
	<!-- List group -->
	<div class="panel-heading text-center"><?php echo $nama; ?></div>
	<div class="panel-heading text-center"><?php echo $jur; ?></div>
	<div class="panel-heading text-center"><?php echo $kons; ?></div>
</div>

<!-- not login -->
<?php else: ?>
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
							  <h4 class="media-heading"><a href="#fakelink"><?php echo $b->berita_judul; ?></a></h4>
							</div>
						</ul>
						<br />
						<?php
						}
						?>
<?php endif; ?>