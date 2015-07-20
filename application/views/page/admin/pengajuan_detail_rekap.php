<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

                            <?php 
								$no=1;
									foreach ($pengajuan->result() as $peng){
										$id 		= $peng->peng_id;
										$tema 		= $peng->tema_nama;
										$judul 		= $peng->peng_judul;
										$label 		= $peng->peng_label;
										$metpen 	= $peng->peng_metpen;
										$ginput 	= $peng->peng_ginput;
										$goutput 	= $peng->peng_goutput;
										$tanggal 	= $peng->peng_tanggal;
										$waktu 		= $peng->peng_waktu;
										$status 	= $peng->peng_status;
										$komentar 	= $peng->peng_komentar;
										
										$tahun_aju = substr($tanggal,0,4);
										$bulan_aju = substr($tanggal,5,2);
										$tanggal_aju = substr($tanggal,8,2);
									}
								?>
							<div class="alert alert-success alert-bold-border fade in alert-dismissable">
								<h3><?php echo strtoupper($judul); ?></h3>
							</div>

					<div class='the-box full'>
						<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
							<table id="tbl-personal" class="table table-bordered table-hover">
                                <tr>
                                    <td>Tema</td><td>:</td><td colspan=4><?php echo $tema;?></td>
								<tr>
								<tr>
									<td>Latar Belakang</td><td>:</td><td colspan=4><?php echo $label;?></td>
								<tr>
								<tr>
									<td>Metode Pengembangan</td><td>:</td><td colspan=4><?php echo $metpen;?></td>
								<tr>
								<tr>
									<td>Gambaran Input</td><td>:</td><td colspan=4><?php echo $ginput;?></td>
								<tr>
								<tr>
									<td>Gambaran Output</td><td>:</td><td colspan=4><?php echo $goutput;?></td>
								<tr>
								<tr>
									<td>Tanggal</td><td>:</td><td><?php echo $tanggal_aju.'-'.$bulan_aju.'-'.$tahun_aju;?></td><td>Waktu</td><td>:</td><td><?php echo $waktu;?></td>
								<tr>
								<tr>
									<td>Status Persetujuan</td><td>:</td><td colspan=4><?php echo $status;?></td>
								<tr>
								<tr>
									<td>Komentar</td><td>:</td><td colspan=4><?php echo $komentar;?></td>
								<tr>
							</table>
							<?php
								$link = $this->uri->segment(2);
								
								if ($link == 'sidang'){
									$red = 'sidang';
								} else if ($link == 'pengajuan'){
									$red = 'pengajuan';
								}
							?>
							<a href="<?=site_url('admin/'.$red.'/rekap/'.$jur.'/'.$kon.'/'.$akad.'/'.$smest.'/'.$tplid);?>" class="btn btn-warning btn-square">Kembali</a>
							</div>
						</div>
					</div>