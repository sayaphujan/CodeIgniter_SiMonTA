<?php
	foreach ($berita->result() as $brt){
		$id = $brt->berita_id;
		$judul = $brt->berita_judul;
		$isi = $brt->berita_isi;
		$gambar = $brt->berita_img;
?>
<div class="media">
						  <a class="pull-left" href="#fakelink">
							<img src="<?php echo site_url('assets/berita/'.$gambar);?>" width=110 class="media-object big-img img-responsive" alt="">
						  </a>
						 <div class="media-body">
							<h4 class="media-heading"><a href=<?php echo site_url('beranda/selengkapnya/'.$id);?>><?php echo $judul;?></a></h4>
							
							<p align='justify'>
							<?php echo substr($isi,0,100); ?>
							</p>
							<a href='<?php echo site_url('beranda/selengkapnya/'.$id);?>' class="btn btn-warning btn-square">Selengkapnya</a>
						  </div><!-- .media-body -->
						</div><!-- /.meadia -->
						
						<hr />
						<?php
						}
						?>
<script type="text/javascript">

            $('#form-login').submit(function( event ) {
              
              event.preventDefault();
              $.post(this.action, $(this).serialize(),function(data){
                    if(data.status == 'error'){
                        $("#err-user").html(data.err_user);
                        $("#err-pass").html(data.err_pass);
                    }else if(data.status == 'success'){
                        location.href=data.path;              
                    }
              },"json")
            });

            $("#login-a").click(function(){
            	$("#err-user").html('');
                $("#err-pass").html('');
                $("input[type=text]").val('');
                $("input[type=password]").val('');
            });

</script>