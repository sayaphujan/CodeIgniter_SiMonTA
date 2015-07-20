<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	protected $tbl = 'pesan_dos';
	function __construct(){

		parent::__construct();
		$this->load->library('myauth');
		$this->myauth->logged_in();
		$this->output->nocache();
		$this->template->title('Dashboard');
		$this->load->model('m_mhs');
		$data['mhs']= $this->m_mhs->get_mhs($this->session->userdata('userid'));
		$this->template->set('navbar',$this->load->view('theme/navbar-mhs',$data,TRUE));
		$this->template->set('sidebar',$this->load->view('theme/sidebar-mhs',$data,TRUE));
		$this->template->set('header','');
	}

	public function index(){
		$id = $this->session->userdata('userid');
		$result = $this->m_mhs->dospemdash();
		if($result){
			foreach($result as $key=>$res){
				$dosen[$res['pgw_id']] = explode(',', $res['pegawai']);
			}
			$data['result'] = $result;
			$data['dosen'] = $dosen;
		}else{
			$data['result'] = '';
			$data['dosen'] = '';
		}
		$data['dashb']= $this->m_mhs->act_dashboard($this->session->userdata('userid'));
		$this->template->load('template','page/dashboard',$data);
	}

	public function logout(){

		$data = array('userid','levelid','name');
		$page = 'beranda';

		$this->myauth->logout($data,$page);
	}
	
/*	function cek(){
		$id = $this->session->userdata('userid');
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('pesan_dos');
		$this->db->where('mhs_id',$id);
		$this->db->where('kat_lap_id <>',3);
		$this->db->where('pesan_status',0);
		$query= $this->db->get();
		
		if($query->num_rows() <> 0){
			$data = $query->row();
			$kode = intval($data->jumlah); // biar bentuknya integer
		}else{
			$kode = 0;
		}
	
		echo "&nbsp;&nbsp;".$kode."&nbsp;&nbsp;";
	}
	
	function lihatpesan(){
		$id = $this->session->userdata('userid');
		$notif = $this->m_mhs->cek($id);
		$pesan = $this->m_mhs->lihatpesan($id);
		//$this->template->load2('template-admin','page/admin/lihatpesan', $data);
		if($notif ==0){
			echo"<font color=red size=2pt>Tidak ada pesan baru yang belum dibaca</font>";
		}else{
			foreach($pesan as $key=>$p){
		?>
			<a href="<?php echo site_url('mahasiswa/detail/'.$p->kat_lap_id.'/'.$p->pesan_id);?>">
				<table border=0 width="100%" style="font-size:10pt" cellpadding="2">
				
					<tr onmouseover="bigImg(this)"
							onmouseout="normalImg(this)">
						<td width="20%"><img src="<?php echo site_url('assets/pegawai/'.$p->pgw_foto); ?>" width="100%" alt="<?php echo $p->pgw_nama; ?>"></td>
						<td>&nbsp;</td>
						<td align="left">
							<?php echo "<font size=\"2pt\" color=\"#000\"><u>".$p->pgw_nama."</u>"; ?>
							<br>
							Menjawab <i>'Pengajuan <?php echo "<b>".$p->kat_lap."</b>'</i>&nbsp;&nbsp;&nbsp;Anda</font> "; ?>
						</td>
					</tr>
				</table>
			</a>
			&nbsp;&nbsp;
			<?php } }?>
			<br />
			<a href="<?php echo site_url('mahasiswa/pesan');?>">
			<table border=0 width="100%" style="font-size:10pt" cellpadding="2">
				<tr onmouseover="bigImg(this)" onmouseout="normalImg(this)">
					<td><font size="2pt" color="#000">Lihat Semua Pemberitahuan</font></td>
				</tr>
			</table>
			</a>
			<script>
			function bigImg(x)
			{
			x.style.backgroundColor="#cfd3d7";
			}

			function normalImg(x)
			{
			x.style.backgroundColor="#efefef";
			}
			</script>
			<?php
	}*/
	
	function pesan(){
		$id = $this->session->userdata('userid');
		$data['pesan'] = $this->m_mhs->allpesan($id);
		$this->template->load('template','page/pesan', $data);
	}
	
	function open($id){
		$this->db->where('pesan_id',$id);
		$this->db->set('pesan_status',1);
		$this->db->update($this->tbl);
		
		redirect('mahasiswa/pesan');
	}
	
	function del($id){
		$this->db->where('pesan_id',$id);
		$this->db->delete($this->tbl);
		
		redirect('mahasiswa/pesan');
	}
	
	function detail(){
		$id = $this->uri->segment(4);
		$katid = $this->uri->segment(3);
		
		$this->db->where('pesan_id',$id);
		$this->db->set('pesan_status',1);
		$this->db->update($this->tbl);
		

		
		if($katid==2){
			redirect('proposal');
		}else if($katid==11 || $katid==12 || $katid==13 || $katid==14 || $katid==15 || $katid==16){
			redirect('laporan/kat/'.$katid);
		}else{
			redirect('pengajuan');
		}
	}

}