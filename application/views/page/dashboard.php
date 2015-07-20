						<ol class='breadcrumb'>
							<li><a href='<?php echo site_url();?>'>Home</a></li>
							<li class='active'>Progress</li>
						</ol>
					<?php
					if(!empty($result) || $result !=''){
					?>
					<!-- Alert info -->
					<div class="alert alert-info fade in alert-dismissable">
					  <table border=0>
						<?php
							foreach($result as $key=>$_res) { ?>
						<tr>
						   <td><strong>Judul</strong></td><td>&nbsp;&nbsp;<strong>:</strong></td><td>&nbsp;&nbsp;<strong><?php echo strtoupper($_res['peng_judul']);?></strong></td>
						</tr>
						<tr colspan=3><td>&nbsp;</td></tr>
						<tr>
							<td><strong>Dosen Pembimbing</strong></td><td>&nbsp;&nbsp;<strong>:</strong></td><td><strong>
						   <?php
								foreach($dosen[$_res['pgw_id']] as $_dos) {
								echo"&nbsp;&nbsp;$_dos,";
								}
							}
							?>
							</strong></td>
						</tr>
					</table>
				</div>
				<?php 
					}else{ }
				?>
<?php
$stat		= 'AKTIF';
$nama		= array('daftar','judul','proposal','bab 1', 'bab 2', 'bab 3', 'bab 4', 'bab 5', 'bab 6');
$link		= array('krs','pengajuan','proposal','laporan','laporan','laporan','laporan','laporan','laporan');
$doc		= array('0','1','2','11','12','13','14','15','16');
for($i=0; $i<9; $i++){
	foreach($dashb->result() as $dash){
		$daftar		= $dash->daftar;
		$judul 		= $dash->judul;
		$proposal 	= $dash->proposal;
		$bab1		= $dash->bab1;
		$bab2		= $dash->bab2;
		$bab3		= $dash->bab3;
		$bab4		= $dash->bab4;
		$bab5		= $dash->bab5;
		$bab6		= $dash->bab6;
	
		$data		= array($daftar,$judul, $proposal, $bab1, $bab2, $bab3, $bab4, $bab5, $bab6);
		echo "<div class='col-sm-4'>";
		//echo"<div class='the-box'>";
		if($data[$i] != $stat){
?>
			
			<div class='the-box' style='background-color:#E0E0ED'>
				<div class=' text-center'>
					<h4> <img src='<?=base_url();?>assets/img/lock.png' width='5%'>&nbsp;&nbsp;<?php echo strtoupper($nama[$i]); ?></h4>
				</div>
			</div>
<?php
		}else{
		if($nama[$i]!='judul' && $nama[$i]!='proposal' && $nama[$i]!='daftar'):
?><div class='the-box'>
					<a href='<?php echo site_url($link[$i].'/kat/'.$doc[$i]);?>'>
						<div class=' text-center'>
							<h4><img src='<?=base_url();?>assets/img/journal.png' width='5%'>&nbsp;&nbsp;<?php echo strtoupper($nama[$i]); ?></h4>
						</div>
					</a>
				</div>
<?php	else : ?><div class='the-box'>
					<a href='<?php echo site_url($link[$i]);?>'>
						<div class=' text-center'>
							<h4><img src='<?=base_url();?>assets/img/journal.png' width='5%'>&nbsp;&nbsp;<?php echo strtoupper($nama[$i]); ?></h4>
						</div>
					</a></div>
<?php
		endif;
		}
		//echo "</div>";
		echo "</div><!-- /.col-sm-5 -->";
	}
}
?>
