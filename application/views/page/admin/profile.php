<!-- if login -->
<?php 
	foreach($pegawai->result() as $m){
		$nip		=$m->pgw_nip;
		$nama		=$m->pgw_nama;
		$username	=$m->pgw_username;
		//$jab		=$m->jab_nama;
		//$komp		=$m->komp_nama;
		$level		=$m->level_name;
	}
?>
			<div class="content-page-inner">
				<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						<div class="box box-primary">
                                <div class="alert alert-success alert-bold-border fade in alert-dismissable">
                                    <h3 class="box-title">PROFILE</h3>
                                </div>
					<div class="the-box full">
					<form role="form" class="form-horizontal" >                                    
						<div class="form-group">
							<label class="col-sm-2 control-label">NPPY</label>
								<div class="col-sm-8">
									<input class="form-control" type="hidden" /><?php echo $nip;?>
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">NAMA</label>
								<div class="col-sm-8">
									<input class="form-control" type="hidden" /><?php echo $nama;?>
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">JABATAN</label>
								<div class="col-sm-8">
									<input class="form-control" type="hidden" /><?php echo $level;?>
								</div>
						</div>
						<!--
						<div class="form-group">
							<label class="col-sm-2 control-label">KOMPETENSI</label>
								<div class="col-sm-8">
									<input class="form-control" type="hidden" /><?php //echo $komp;?>
								</div>
						</div>-->
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-8">
							 	<a href="<?=site_url('admin/dashboard');?>" class="btn btn-warning btn-square">Kembali</a>
							</div>
						</div>
					</form>
					</div>
					</div>
				</div>
			</div>