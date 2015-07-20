<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <?php
				$check = $this->session->userdata('levelid');
			  		if($check == 6 ):
					echo"
					<a data-scroll class='navbar-brand' href='".site_url('mahasiswa')."'>
						<i class='fa fa-home'></i>
					</a>
					";
				foreach($mhs->result() as $m){
					$level	=$m->level_name;
					echo"
					<a data-scroll class='navbar-brand' href='".site_url('mahasiswa')."'>
						<b>Selamat Datang $level</b>
					</a>
					";
				}
				/*
			<!--<a data-scroll class="navbar-brand" href="#top">
					<span id="pesan">
					<img src="<?php //echo base_url();?>assets/img/mail_close.png" width="10%">
					<span id="notifikasi"></span>
					
					</span>
					
					<div id="info">
						<div id="loading"><br>Loading...<img src="<?php //echo base_url();?>assets/img/loading.gif"></div>
						<div id="konten-info">
						</div>
					</div>
			</a>-->
			*/
				elseif($check != 6 || empty($check)):
				echo"
					<a data-scroll class='navbar-brand' href='".site_url()."'>
						<b>SiMonTA</b>
					</a>
				";
			endif;
			?>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<?php $result = $this->m_menu->general_menu();

			  		$data['list'] = $result->result();

			  		echo menu($data,'nav navbar-nav');
			?>

			  <ul class="nav navbar-nav navbar-right">

			  	<!-- if login -->

			  	<?php 
				$check = $this->session->userdata('levelid');
			  		if($check == 6):
			  	?>
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">			
                       <li class="message-preview">
                            <a href="">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Pengirim</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Mengirim File BAB 4</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                         <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Pengirim</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Mengirim File BAB 4</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                       <h5 class="media-heading"><strong>Pengirim</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Mengirim File BAB 4</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">a</a>
                        </li>
                    </ul>
                </li>
			  	<li class="dropdown">
				  <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->userdata('name');?> <b class="caret"></b></a>
				  <ul class="dropdown-menu square primary no-border margin-list-rounded with-triangle">
					<li><a href="<?php echo site_url('profile');?>">Profile</a></li>
					<li><a href="<?php echo site_url('setting');?>">Setting</a></li>
					<li><a href="<?=site_url('mahasiswa/logout');?>">Logout</a></li>
				  </ul>
				</li>

				<!-- not login -->
			<?php elseif($check != 6 || empty($check)): ?>
			  	<li class="dropdown">
				  <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown" id="login-a">Login <b class="caret"></b></a>
				  <ul class="dropdown-menu square primary no-border margin-list-rounded with-triangle" style="width:300px">
					<form role="form" method="POST" action="<?=site_url('beranda/login');?>" id="form-login">
						<div class="form-group sign-in">
							<label>Username</label>
							<input type="text" class="form-control" placeholder="username" name="username" style="border:1px solid #ddd">	
							<span id="err-user"></span>
						</div>
						<div class="form-group sign-in">
							<label>Password</label>
							<input type="password" class="form-control" placeholder="password" name="password" style="border:1px solid #ddd">
							<span id="err-pass"></span>
						</div>
						<div class="form-group sign-in" style="padding-right:0px">
						<button class="btn btn-primary btn-square" type="submit">login</button>
						</div>
			  		</form>
					
				  </ul>
			<?php endif;?>
			  </ul>
			  
			</div><!-- /.navbar-collapse -->
<!--<script>

var x = 1;

function cek(){
    $.ajax({
        url: "<?php //echo site_url('mahasiswa/cek');?>",
        cache: false,
        success: function(msg){
            $("#notifikasi").html(msg);
			$.playSound('<?php //echo base_url();?>assets/sound/notifikasi.mp3');
        }
    });
    var waktu = setTimeout("cek()",3000);
}

$(document).ready(function(){
    cek();
	
    $("#pesan").click(function(){
        $("#loading").show();
        if(x==1){
            $("#pesan").css("background-color","");
            x = 0;
        }else{
            $("#pesan").css("background-color","");
            x = 1;
        }
        $("#info").toggle();
        //ajax untuk menampilkan pesan yang belum terbaca
        $.ajax({
            url: "<?php //echo site_url('mahasiswa/lihatpesan');?>",
            cache: false,
            success: function(msg){
                $("#loading").hide();
                $("#konten-info").html(msg);
            }
        });

    });
    $("#content").click(function(){
        $("#info").hide();
        $("#pesan").css("background-color","");
        x = 1;
    });
});
</script>-->