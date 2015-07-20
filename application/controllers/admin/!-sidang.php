<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidang extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library(array('Datatables'));
		$this->load->model(array('m_paper','m_pengajuan','m_pgw'));
		$this->load->helper(array('url','form'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
/*	function index(){
		
		$id = $this->session->userdata('userid');
		$result = $this->m_pgw->get_mhs_sidang($id);
		$maxdos = $this->m_pgw->count_dos();
		if($result){
			foreach($result as $key=>$res)
			{
				$dosen[$res['mhs_id']] = explode(',', $res['pegawai']);
			}
			$data['result'] = $result;
			$data['maxdos'] = $maxdos;
			$data['dosen'] = $dosen;
			$this->template->load2('template-admin','page/admin/sidang',$data);
		}else{
			$this->template->load2('template-admin','page/admin/null');
		}
	}*/
	
	function index(){
		$id = $this->session->userdata('userid');
		$dos = $this->m_pgw->get_mhs_sidang($id);
		if($dos){
			$data['result']=$dos;
		}
		$this->template->load2('template-admin','page/admin/sidang',$data);
	}

	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function detail(){
		$pengid 			= $this->uri->segment(4);
		$data['pengajuan']	= $this->m_pengajuan->get_detail( $pengid);
		$this->template->load2('template-admin','page/admin/pengajuan_detail',$data);
	}
	
	function change_sidang(){
		$id = $_GET['id'];
		$status = $_GET['status'];
		if(!empty($id)){
			$result = $this->m_paper->change_sidang($id,$status);
			if(!empty($result)){
				$notif = "Sukses mengubah status sidang";
				echo json_encode(array('msg'=>$notif)); 
			}
		}
	}
	
	function change_proposal(){
		$id = $_GET['id'];
		$status = $_GET['status'];
		if(!empty($id)){
			$result = $this->m_paper->change_proposal($id,$status);
			if(!empty($result)){
				$notif = "Sukses mengubah status proposal sidang";
				//$notif = $result;
				echo json_encode(array('msg'=>$notif)); 
			}
		}
	}
}