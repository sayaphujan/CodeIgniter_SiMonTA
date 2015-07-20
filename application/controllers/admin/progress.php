<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Progress extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->library('myauth');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->load->model(array('m_mhs','m_pgw','m_paper'));
		$this->template->title('Dashboard Admin');
		
	}

	function index(){
	$level = $this->session->userdata('levelid');
		
		if($level=='10' or $level=='11' or $level=='12' or $level=='13'){
			$data['level'] 		= $level;
			$data['mahasiswa']  = $this->m_mhs->get_mhs_akhir($level);
			$this->template->load2('template-admin','page/admin/dashboard_prodi', $data);
		}
	}

	function custom_page(){

		$data=(array('10','11','12','13'));
		$this->myauth->logged_in_custom($data);
	}
	
	function detail(){
		$id = $this->uri->segment(4);
		$this->db->select('mhs_id');
		$this->db->where('mhs_id',$id);
		$cek = $this->db->get('pengajuan');
		
		if($cek->num_rows() <> 0){
		
			$result = $this->m_mhs->get_dospem();
			$maxdos = $this->m_pgw->count_dos();
			foreach($result as $key=>$res)
			{
				$dosen[$res['pgw_id']] = explode(',', $res['pegawai']);
			}
			$data['result'] = $result;
			$data['maxdos'] = $maxdos;
			$data['dosen'] = $dosen;
			
			$data['progress']=$this->m_paper->get_progress($id);
			$this->template->load2('template-admin','page/admin/progress', $data);
		}else{
			$this->template->load2('template-admin','page/admin/null');
		}
	}
	
	function rekap(){
	$id		= $this->uri->segment(8);

		$level = $this->session->userdata('levelid');
		if($level=='10' or $level=='11' or $level=='12' or $level=='13'){
			$data['level'] 		= $level;
			$data['mahasiswa']  = $this->m_mhs->rekap_pengajuan($level, $id);
			$data['jur'] 	= $this->uri->segment(4);
			$data['kon'] 	= $this->uri->segment(5);
			$data['akad'] 	= $this->uri->segment(6);
			$data['smest'] 	= $this->uri->segment(7);
			$data['id']		= $this->uri->segment(8);
			$this->template->load2('template-admin','page/admin/progress_rekap', $data);
		}
	}
	
	function detail_rekap(){
		$data['jur'] 	= $this->uri->segment(4);
		$data['kon'] 	= $this->uri->segment(5);
		$data['akad'] 	= $this->uri->segment(6);
		$data['smest'] 	= $this->uri->segment(7);
		$data['tplid']	= $this->uri->segment(8);
		
		$tpl = $this->uri->segment(8);
		$id = $this->uri->segment(9);
		
		$result = $this->m_mhs->get_dospem_rekap($id, $tpl);
		$maxdos = $this->m_pgw->count_dos();
		foreach($result as $key=>$res)
		{
			$dosen[$res['pgw_id']] = explode(',', $res['pegawai']);
		}
		$data['result'] = $result;
		$data['maxdos'] = $maxdos;
		$data['dosen'] = $dosen;
		
		$data['progress']=$this->m_paper->get_progress_rekap($id, $tpl);
		$this->template->load2('template-admin','page/admin/riwayat_rekap', $data);
	}

}