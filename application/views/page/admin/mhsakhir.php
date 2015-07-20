<?php
$jur 	= $this->uri->segment(4);
$kon 	= $this->uri->segment(5);
$akad 	= $this->uri->segment(6);
$smest 	= $this->uri->segment(7);
if($tapel->num_rows() <> 0){
foreach($tapel->result() as $t){
	$id = $t->tapel_id;
}
?>
<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">Rekap Data</li>
						</ol>
						<div class='alert alert-success alert-bold-border fade in alert-dismissable'>
							<h3>DATA SEMESTER AKHIR</h3>
						</div>
						<div class="row">
						<!-- SATU -->
						<a href="<?php echo site_url('admin/pengajuan/rekap/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest.'/'.$id); ?>">
							<div class="col-sm-4 text-center">
								<div class="the-box" >
									<p><strong>DATA PENGAJUAN JUDUL</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-primary"></i>
									<br />
									<br />
								</div>
							</div>
						</a>

						<!-- DUA -->
						<a href="<?php echo site_url('admin/progress/rekap/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest.'/'.$id); ?>">
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA PROGRESS MAHASISWA</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-primary"></i>
									<br />
									<br />
								</div>						
							</div>
						</a>
						
						<!-- TIGA -->
						<a href="<?php echo site_url('admin/sidang/rekap/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest.'/'.$id); ?>">
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA NILAI SIDANG PROPOSAL</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-primary"></i>
									<br />
									<br />
								</div>			
							</div>
						</a>
						</div>

						<!-- EMPAT -->
						<div class="row">
						<a href="<?php echo site_url('admin/dospem/rekap/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest.'/'.$id); ?>">
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA DOSEN PEMBIMBING </strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-primary"></i>
									<br />
									<br />
								</div>						
							</div>
						</a>

						<!-- LIMA -->
						<a href="<?php echo site_url('admin/dospem/changerekap/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest.'/'.$id); ?>">
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA ALIH DOSEN PEMBIMBING</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-primary"></i>
									<br />
									<br />
								</div>
							</div>
						</a>
						
						<!-- ENAM -->
						<a href="<?php echo site_url('admin/mahasiswa/alumni/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest.'/'.$id); ?>">
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA PENUTUP</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-primary"></i>
									<br />
									<br />
								</div>
							</div>
						</a>
						</div>
<?php }else{ ?>
	<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">Rekap Data</li>
						</ol>
						<div class='alert alert-success alert-bold-border fade in alert-dismissable'>
							<h3>DATA SEMESTER AKHIR</h3>
						</div>
						
						<div class="alert alert-warning fade in alert-dismissable">
							<p><strong>Maaf. Tidak ada data yang dapat ditampilkan saat ini.</strong></p>
						</div>
						<div class="row">
						<!-- SATU -->
							<div class="col-sm-4 text-center">
								<div class="the-box" >
									<p><strong>DATA PENGAJUAN JUDUL</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-default"></i>
									<br />
									<br />
								</div>
							</div>

						<!-- DUA -->
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA PROGRESS MAHASISWA</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-default"></i>
									<br />
									<br />
								</div>						
							</div>
						
						<!-- TIGA -->
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA NILAI SIDANG PROPOSAL</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-default"></i>
									<br />
									<br />
								</div>			
							</div>
						</div>

						<!-- EMPAT -->
						<div class="row">
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA DOSEN PEMBIMBING </strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-default"></i>
									<br />
									<br />
								</div>						
							</div>

						<!-- LIMA -->
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA ALIH DOSEN PEMBIMBING</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-default"></i>
									<br />
									<br />
								</div>
							</div>
						
						<!-- ENAM -->
							<div class="col-sm-4 text-center">
								<div class="the-box">
									<p><strong>DATA PENUTUP</strong></p>
									<i class="fa fa-book icon-circle icon-xl icon-default"></i>
									<br />
									<br />
								</div>
							</div>
						</div>
<?php } ?>