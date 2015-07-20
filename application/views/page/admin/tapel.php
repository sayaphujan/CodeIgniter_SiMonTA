			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active">tahun akademik</li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM AKADEMIK</h3>
						</div>
						<?php
						$link = $this->uri->segment(3);
						if($link=='submit'){
							$id		= $idakad;
							$t1 	= $ta1;
							$t2 	= $ta2;
							$sm 	= $sm;
							$mul	= $mulai;
							$ak	= $akhir;
							$stat	= $status;
							$staterror=$error;
						}else if($link=='add'){
							$id		= $idakad;
							$t1 	= $ta1;
							$t2 	= $ta2;
							$sm 	= $sm;
							$mul	= $mulai;
							$ak	= $akhir;
							$stat	= $status;
							$staterror=$error;
						}else if($link=='edit'){
							foreach ($tapel->result() as $t){
								$id		= $t->tapel_id;
								$akad	= $t->tapel_akad;
								$tapel1	= $t->tapel_mulai;
								$tapel2	= $t->tapel_akhir;
								$sm		= $t->tapel_semester;
								$stat	= $t->tapel_status;
								$staterror=$error;
												
								$t1	= substr($akad,0,4);
								$t2	= substr($akad,5,4);
								
								$tahun_mulai 	= substr($tapel1,0,4);
								$bulan_mulai 	= substr($tapel1,5,2);
								$tanggal_mulai 	= substr($tapel1,8,2);
								$mul			= $tanggal_mulai.'-'.$bulan_mulai.'-'.$tahun_mulai;
											
								$tahun_akhir = substr($tapel2,0,4);
								$bulan_akhir = substr($tapel2,5,2);
								$tanggal_akhir = substr($tapel2,8,2);
								$ak			= $tanggal_akhir.'-'.$bulan_akhir.'-'.$tahun_akhir;
							}
						}
						?>
<div class="the-box full">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/tapel/submit');?>" method="POST" >
								<input type="hidden" id="id_akad" name="id_akad" value="<?php echo $id; ?>" />
								<div class="form-group">
									<label class="col-sm-2 control-label">Tahun Akademik</label>
									<div class="col-sm-8">
										<input name="ta1" id="ta1" class="" type="text" placeholder=" x x x x" maxlength=4 size=4 value="<?php echo $t1; ?>" /> / <input name="ta2" id="ta2" class="" type="text" placeholder=" x x x x" maxlength=4 size=4 value="<?php echo $t2; ?>" />
										<span><?php echo form_error('ta1'); ?></span><span><?php echo form_error('ta2'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Semester</label>
									<div class="col-sm-8">
										<select class="form-control" name="semester">
											<option value="" <?php if($sm==''){echo 'selected';}?>>--Pilih Disini--</option>
											<option value='GASAL' <?php if($sm=='GASAL'){echo 'selected';}?>>GASAL</option>
											<option value='GENAP' <?php if($sm=='GENAP'){echo 'selected';}?>>GENAP</option>
										</select>
										<span><?php echo form_error('semester'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Mulai</label>
									<div class="col-sm-6">
										<a href="javascript:NewCssCal('mulai','ddmmyyyy')">
											<input type="text" name="mulai" class="mulai" id="mulai" size="20" value="<?php echo $mul; ?>" /> 
											<img src="<?php echo base_url(); ?>assets/datepicker/images/cal.gif" width="16" height="16" alt="Pilih tanggal" />
										</a>
										<span><?php echo form_error('mulai'); ?></span>
									</div>
									
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Akhir</label>
									<div class="col-sm-6">
										<a href="javascript:NewCssCal('akhir','ddmmyyyy')">
											<input type="text" name="akhir" class="akhir" id="akhir" size="20" value="<?php echo $ak;?>" /> 
											<img src="<?php echo base_url(); ?>assets/datepicker/images/cal.gif" width="16" height="16" alt="Pilih tanggal" />
										</a>
										<span><?php echo form_error('akhir'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Status</label>
									<div class="col-sm-8">
										<input name="status" type="radio" id="status" value=1 <?php if($stat==1){echo 'checked';}?> >AKTIF
										&nbsp;&nbsp;&nbsp;
										<input name="status" type="radio" id="status" value=0 <?php if($stat==0){echo 'checked';}?> >NON AKTIF
										<span><?php echo form_error('status'); ?></span>
										<span><?php echo $staterror; ?></span>
									</div>
								</div>
								 
								<div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('admin/tapel');?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->