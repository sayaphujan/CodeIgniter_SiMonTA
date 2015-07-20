
			<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url('admin');?>">Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>
						
						<div class="alert alert-success alert-bold-border fade in alert-dismissable">
						  <h3>FORM NILAI SIDANG</h3>
						</div>
						<?php
						if ($this->uri->segment(3)!='submit'){
							foreach($sidang->result() as $sid){
								$id = $sid->mhs_id;
								$p1 = $sid->nilaiP1;
								$p2 = $sid->nilaiP2;
								$stat = $sid->sidang_revisi;
							}
						}
						?>
<div class="the-box full">
							 <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/sidang/submit');?>" method="POST" >
								<input type="hidden" id="mhs_id" name="mhs_id" value="<?php echo $id; ?>" />
								<div class="form-group">
									<label class="col-sm-2 control-label">Penguji 1</label>
									<div class="col-sm-8">
										<input name="p1" class="form-control" id="p1" type="text" onchange="proses()" onkeyup="proses()" placeholder=" nilai" value="<?php echo $p1; ?>" maxlength=2 />
										<span><?php echo form_error('p1'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Penguji 2</label>
									<div class="col-sm-8">
										<input name="p2" class="form-control" id="p2" type="text" onchange="proses()" onkeyup="proses()" placeholder=" nilai" value="<?php echo $p2; ?>" maxlength=2 />
										<span><?php echo form_error('p2'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Nilai</label>
									<div class="col-sm-8">
										<input type="text" id="nilai" class="form-control" readonly value="<?php //echo $nilai; ?>" >
									</div>
								</div>
								<?php /*
								 <div class="form-group" id="status">
									<label class="col-sm-2 control-label">Status Sidang</label>
									<div class="col-sm-8">
										<select class="form-control" name="status" >
										<?php if($this->uri->segment(3)=="submit"){?>
											<option value="" <?php if ($status==""){echo "selected";} ?>>--Pilih Disini--</option>
											<option value="ACC" <?php if ($status=="ACC"){echo "selected";} ?>>Lulus tanpa Perbaikan</option>
											<option value="REVISI" <?php if ($status=="REVISI"){echo "selected";} ?>>Lulus dengan Perbaikan</option>
										<?php }else { ?>
											<option value="" <?php if ($stat=="PENDING"){echo "selected";} ?>>--Pilih Disini--</option>
											<option value="ACC" <?php if ($stat=="ACC"){echo "selected";} ?>>Lulus tanpa Perbaikan</option>
											<option value="REVISI" <?php if ($stat=="REVISI"){echo "selected";} ?>>Lulus dengan Perbaikan</option>
										<?php } ?>
										</select>
									</div>
									<span><?php echo form_error('status'); ?></span>
								</div> */ ?>
								<div class="form-group">
									<label class="col-sm-2 control-label">Topik Revisi</label>
									<div class="col-sm-8">
										<div class="input_fields_wrap">
											<div>
												<button class="add_field_button btn btn-info btn-square"> Tambah Topik</button></a>
											<?php
											foreach ($topik->result() as $tpk){
												echo "
												<input type='hidden' name='topikid' id='topikid' value='".$tpk->topik_id."'>
												<input type='text' class='form-control' name='topik[]' id='topik[]' value='".$tpk->topik_isi."' /> <a href='".site_url('admin/sidang/deltopik/'.$tpk->topik_id.'/'.$id)."'>Remove<a>
												";
											?>
												
											<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
								 	<div class="col-sm-offset-2 col-sm-8">
								 		<button class="btn btn-primary btn-square">Simpan</button>
								 		<a href="<?=site_url('admin/sidang');?>" class="btn btn-warning btn-square">Kembali</a>
								 	</div>
								 </div>
							</form>		
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
<script>
function proses(){
	var x=$("#p1").val();
	var y=$("#p2").val();
	if(!(x.length > 0) || x == null) {
		x = 0;
	}
	if(!(y.length > 0) || y == null) {
		y = 0;
	}
	var z=(Number(x)+Number(y))/2;
	$("#nilai").val(z);
	
	/*if(Number(z)<70){
		$("#status").hide();
	}else{
		$("#status").show('slow');
	}*/
}
</script>
<script>
proses();
</script>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" class="form-control" name="topik[]" id="topik[]" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>