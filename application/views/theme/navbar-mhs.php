<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <?php

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
			?>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<?php $result = $this->m_menu->general_menu();

			  		$data['list'] = $result->result();

			  		echo menu($data,'nav navbar-nav');
			?>

			  <ul class="nav navbar-nav navbar-right">
				<?php
				$id = $this->session->userdata('userid');
				$this->db->select('COUNT(*) as jumlah');
				$this->db->from(' pesan_dos');
				$this->db->where('mhs_id',$id);
				$this->db->where('pesan_status',0);
				$this->db->where('pesan_dos.kat_lap_id !=',3);
				$query= $this->db->get();
				
				if($query->num_rows() <> 0){
					$data = $query->row();
					$kode = intval($data->jumlah); // biar bentuknya integer
				}else{
					$kode = 0;
				}
				?>
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i>&nbsp; <?php echo $kode; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">			
					<?php
					$this->db->select('*');
					$this->db->from('pesan_dos');
					$this->db->join('pegawai','pesan_dos.pgw_id=pegawai.pgw_id');
					$this->db->join('kategori_laporan','pesan_dos.kat_lap_id=kategori_laporan.kat_lap_id');
					$this->db->where('mhs_id',$id);
					$this->db->where('pesan_status',0);
					$this->db->where('pesan_dos.kat_lap_id !=',3);
					$this->db->order_by('pesan_id','desc');
					$query= $this->db->get();
					foreach($query->result() as $key=>$p){
					?>
                       <li class="message-preview">
                            <a href="<?php echo site_url('mahasiswa/detail/'.$p->kat_lap_id.'/'.$p->pesan_id);?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object"  src="<?php //echo site_url('assets/pegawai/'.$p->pgw_foto);?>" alt="<?php //echo $p->pgw_nama; ?>">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo $p->pgw_nama; ?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $p->pesan_tgl.'_-_'.$p->pesan_waktu; ?></p>
                                        <p>Menjawab <i>'Pengajuan <?php echo "<b>".$p->kat_lap."</b>'</i>&nbsp;&nbsp;&nbsp;Anda</font> "; ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
					<?php } ?>
					<li> <a href="<?php echo site_url('mahasiswa/pesan');?>">Lihat Semua Pesan</a></li>
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