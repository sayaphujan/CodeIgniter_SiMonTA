<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	protected $tbl = 'pesan_mhs';
	function __construct(){
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->library('myauth');
		$this->load->library('session');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->load->model(array('m_mhs','m_pgw','m_paper','m_menu','m_pengajuan'));
		$this->template->title('Dashboard Admin');
		
		/*if ($this->session->userdata('logged_in') === FALSE)
		{
			$this->session->unset->userdata('logged_in');
			$this->session->unset->userdata('userid');
			$this->session->unset->userdata('levelid');
			$this->session->unset->userdata('name');
			redirect('admin',refresh);
		}*/ 
	}

	function index(){

		$id = $this->session->userdata('userid');
		$data['tugas']  = $this->m_menu->menu_tugas();
		$this->template->load2('template-admin','page/admin/dashboard', $data);
	}

	function custom_page(){

		$data=(array('2','3','4','5','10','11','12','13'));
		$this->myauth->logged_in_custom($data);
	}
	
	function cek(){
		$id = $this->session->userdata('userid');
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('pesan_mhs');
		$this->db->where('pgw_id',$id);
		$this->db->where('kat_lap_id <>',3);
		$this->db->where('pesan_status',0);
		$query= $this->db->get();
		
		if($query->num_rows() <> 0){
			$data = $query->row();
			$kode = intval($data->jumlah); // biar bentuknya integer
		}else{
			$kode = 0;
		}
	
		echo "&nbsp;".$kode."&nbsp;";
	}
	
	function lihatpesan(){
		$id = $this->session->userdata('userid');
		$notif = $this->m_pengajuan->cek($id);
		$pesan = $this->m_pengajuan->lihatpesan($id);
		//$this->template->load2('template-admin','page/admin/lihatpesan', $data);
		if($notif ==0){
			echo"<font color=red size=2pt>Tidak ada pesan baru yang belum dibaca</font>";
		}else{
			foreach($pesan as $key=>$p){
			?>
			<a href="<?php echo site_url('admin/dashboard/detail/'.$p->pesan_id.'/'.$p->mhs_id.'/'.$p->kat_lap_id);?>">
				<table border=0 width="100%" style="font-size:10pt" cellpadding="2">
					<tr onmouseover="bigImg(this)"
							onmouseout="normalImg(this)">
						<td width="20%"><img src="<?php echo site_url('assets/mahasiswa/'.$p->mhs_foto); ?>" width="100%" alt="<?php echo $p->mhs_nim; ?>"></td>
						<td>&nbsp;</td>
						<td align="left">
							<?php echo "<font size=\"2pt\" color=\"#000\"><u>".$p->mhs_nama."</u>"; ?>
							<br>
							Mengajukan <?php echo "<b><i>".$p->kat_lap."</i></b></font>"; ?>
						</td>
					</tr>
				</table>
			</a>
			&nbsp;&nbsp;
			<?php } }?>
			<br />
			<a href="<?php echo site_url('admin/dashboard/pesan');?>">
			<table border=0 width="100%" style="font-size:10pt" cellpadding="2">
			
				<tr onmouseover="bigImg(this)" onmouseout="normalImg(this)">
					<td><font size="2pt" color="#000">Lihat Semua Pemberitahuan</font></td>
				</tr>
			</a>
			</table>
			
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
	}
	
	function pesan(){
		$id = $this->session->userdata('userid');
		$data['pesan'] = $this->m_pengajuan->allpesan($id);
		$this->template->load2('template-admin','page/admin/pesan', $data);
	}
	
	function open($id){
		$this->db->where('pesan_id',$id);
		$this->db->set('pesan_status',1);
		$this->db->update($this->tbl);
		
		redirect('admin/dashboard/pesan');
	}
	
	function del($id){
		$this->db->where('pesan_id',$id);
		$this->db->delete($this->tbl);
		
		redirect('admin/dashboard/pesan');
	}
	
	function detail(){
		$id = $this->uri->segment(4);
		$mhsid = $this->uri->segment(5);
		$katid = $this->uri->segment(6);
		
		$this->db->where('pesan_id',$id);
		$this->db->set('pesan_status',1);
		$this->db->update($this->tbl);
		
		if($katid!=0){
			redirect('admin/bimbingan/detail/'.$mhsid);
		}else{
			redirect('admin/pengajuan/custom/'.$mhsid);
		}
	}
}