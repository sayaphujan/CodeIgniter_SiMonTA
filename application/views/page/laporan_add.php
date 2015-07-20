<?php 

$no = $this->uri->segment(3);
if ($no != 11 && $no != 12 && $no != 13 && $no != 14 && $no != 15 && $no != 16 ){
redirect('mahasiswa');
}
foreach($bab->result() as $row){}
?>
<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url();?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?> / <?php echo $row->kat_lap; ?></li>
						</ol>
					
					<div class="box box-primary">
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM BIMBINGAN</h3>
						</div>
						<?php
							if($this->uri->segment(2)=="add"){
								$files=$file;
								$act ="add";
								$lap_id="";
							}elseif($this->uri->segment(2)=="edit"){
								foreach($proposal->result() as $key){
									$files = $key->lap_file;
								}
								$act ="edit";
								$lap_id=$this->uri->segment(3);
							}elseif($this->uri->segment(2)=="submit"){
								$files=$file;
								$act =$link;
								$lap_id=$id;
							}
						?>
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('laporan/submit/'.$this->uri->segment(3));?>" method="POST" >
								<input type="hidden" id="lap_id" name="lap_id" value="<?php echo $lap_id; ?>" />
								<input type="hidden" id="act" name="act" value="<?php echo $act; ?>" />
								<div class="form-group">
									<label class="col-sm-2 control-label">File</label>
									<div class="col-sm-8">
										<input name="userfile" id="fileInput" class="form-control" type="file" />
										<span><p class="text-danger"><?php echo $files; ?></p></span>
										<?php if($this->uri->segment(2)=="submit"){
											echo '<p class="text-danger">'.$pfile.'</p>';
										}?>
										<span><?php echo form_error('userfile'); ?></span>
									</div>
								</div>
								
								 <div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('laporan/kat/'.$this->uri->segment(3));?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
			</div>
							</div>
                

