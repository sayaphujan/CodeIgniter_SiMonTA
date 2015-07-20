<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  
			  <button class="btn btn-primary btn-sidebar-collapse">
				<span class="fa fa-arrows-h"></span>
			  </button>
			  <a data-scroll class="navbar-brand" href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i></a>
			 <?php
				$id = $this->session->userdata('levelid');
				$this->db->select('*');
				$this->db->from('leveluser');
				$this->db->where('level_id',$id);
				$query= $this->db->get();
				
				foreach($query->result() as $row){
			 ?>
			  <a data-scroll class="navbar-brand" href="#top">Selamat Datang <?php echo $row->level_name; ?> </a>
			 <?php } ?>
			</div>
			
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<!--<ul class="nav navbar-nav">
				<li class="active"><a href="#fakelink"><i class="fa fa-share"></i> Visit site</a></li>
			  </ul>
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
				  <input type="text" class="form-control" placeholder="Search">
				</div>
			  </form>-->
			<ul class="nav navbar-nav navbar-right">
				<?php
				$pgwid = $this->session->userdata('userid');
				$this->db->select('COUNT(*) as jumlah');
				$this->db->from(' pesan_mhs');
				$this->db->where('pgw_id',$pgwid);
				$this->db->where('pesan_status',0);
				$this->db->where('pesan_mhs.kat_lap_id !=',3);
				$query= $this->db->get();
				
				if($query->num_rows() <> 0){
					$data = $query->row();
					$kode = intval($data->jumlah); // biar bentuknya integer
				}else{
					$kode = 0;
				}
				?>
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span id="notifikasi"></span>&nbsp;<i class="fa fa-envelope"></i> <?php echo $kode;?><b class="caret"></b></a>
					<ul class="dropdown-menu message-dropdown">	
						<?php
							$pgwid = $this->session->userdata('userid');
							$this->db->select('*');
							$this->db->from('pesan_mhs');							
							$this->db->join('mahasiswa','pesan_mhs.mhs_id=mahasiswa.mhs_id');
							$this->db->join('kategori_laporan','pesan_mhs.kat_lap_id=kategori_laporan.kat_lap_id');
							$this->db->where('pgw_id',$pgwid);
							$this->db->where('pesan_status',0);
							$this->db->where('pesan_mhs.kat_lap_id !=',3);
							$this->db->order_by('pesan_id','desc');
							$rain= $this->db->get();
							foreach($rain->result() as $key=>$p){
						?>
                       <li class="message-preview">
                            <a href="
								<?php echo site_url('admin/dashboard/detail/'.$p->pesan_id.'/'.$p->mhs_id.'/'.$p->kat_lap_id);?>
							">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object"  src="<?php //echo site_url('assets/pegawai/'.$p->pgw_foto);?>" alt="<?php //echo $p->pgw_nama; ?>">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo "<font size=\"2pt\" color=\"#000\"><u>".$p->mhs_nama."</u></font>"; ?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $p->pesan_tgl.'_-_'.$p->pesan_waktu; ?></p>
                                        <p><?php /*echo "<font size=\"2pt\" color=\"#000\"><u>".$p->mhs_nama."</u></font>";*/ ?>
							<br>
							Mengajukan <?php echo "<font><b><i>".$p->kat_lap."</i></b></font>"; ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
						<?php } ?>
						<li> <a href="<?php echo site_url('admin/dashboard/pesan');?>">Lihat Semua Pesan</a></li>
					</ul>
				</li>
				<li class="dropdown">
				  <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->userdata('name');?> <b class="caret"></b></a>
				  <ul class="dropdown-menu square primary no-border margin-list-rounded with-triangle">
					<li><a href="<?php echo site_url('admin/profile');?>">Profile</a></li>
					<li><a href="<?php echo site_url('admin/setting');?>">Setting</a></li>
					<li><a href="<?=site_url('admin/login/logout');?>">Logout</a></li>
				  </ul>
				</li>
			  </ul>
			</div><!-- /.navbar-collapse -->
<script>
function cek(){
    $.ajax({
        url: "<?php echo site_url('admin/dashboard/cek');?>",
        cache: false,
        success: function(msg){
            $("#notifikasi").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}
</script>