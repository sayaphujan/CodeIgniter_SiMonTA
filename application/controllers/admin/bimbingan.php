<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bimbingan extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->library(array('Datatables'));
		$this->load->model(array('m_paper','m_pengajuan','m_pgw','m_mhs'));
		$this->load->helper(array('url','form'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');

	}
	
	function index(){
	$id = $this->session->userdata('userid');	
	$result	= $this->m_pgw->get_mhs_bim($id);
		if(!empty($result) || $result!=''){
			$data['result'] = $result;
			$this->template->load2('template-admin','page/admin/bimbingan_dospem',$data);
		}else{
			$this->template->load2('template-admin','page/admin/null');
		}
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function detail(){
		$mhsid = $this->uri->segment(4);
		$pengid = $this->uri->segment(5);
		$result = $this->m_mhs->get_dospem($mhsid, $pengid);
		//$maxdos = $this->m_pgw->count_dos();
		foreach($result as $key=>$res)
		{
			$dosen[$res['pgw_id']] = explode(',', $res['pegawai']);
		}
		$data['result'] = $result;
		//$data['maxdos'] = $maxdos;
		$data['dosen'] = $dosen;
		
		$data['proposal']=$this->m_paper->get_all_proposal_dospem($mhsid);
		$data['terakhir']=$this->m_paper->get_last_bimbingan($mhsid);
		$data['topik']  = $this->m_pengajuan->get_topik_sidang($mhsid);
		$this->template->load2('template-admin','page/admin/proposal_dospem',$data);
	}
	
	function rev(){
		$topikid 	= $this->input->post('topikid');
		$mhsid 		= $this->input->post('mhsid');
		$pengid 	= $this->input->post('pengid');

		foreach($topikid as $id=>$tid){
			$data = array(
						'topik_status'	=> '1'
						);
			$this->db->where('topik_id',$tid);
			$this->db->update('topik_revisi', $data);
		}
		redirect('admin/bimbingan/detail/'.$mhsid.'/'.$pengid);
	}
	
	function edit(){
		$id = $this->uri->segment(4);
		$pengid = $this->uri->segment(5);
		$data['bimbingan']=$this->m_paper->get_bimbingan($id);
		$this->template->load2('template-admin','page/admin/bimbingan',$data);
	}
	
	function submit(){
	$upload 	='userfile';

		if( empty($_FILES['userfile']['name'])){
			$file='Tak ada File Revisi';
			$this->m_paper->update_bimbingan($file);
		}else if(!empty($_FILES['userfile']['name'])){
			$upload='userfile';
			$file =  md5($this->session->userdata('username').date('Y-m-d').date('H:i:s')).preg_replace("/\s+/", "_", $_FILES['userfile']['name']);
		
			$config['upload_path'] = "./assets/upload/bimbingan/";
			$config['allowed_types'] = 'doc|docx|pdf|rtf|odt';
			$config['file_name'] = $file;
			$config['max_size']  = '5000';
			$config['overwrite'] = false;
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload($upload)){
				$data['error'] = $this->upload->display_errors();
				$id = $this->input->post('lapid');
				$data['bimbingan']=$this->m_paper->get_bimbingan($id);
				$this->template->load2('template-admin','page/admin/bimbingan',$data);
			}else{
				$this->m_paper->update_bimbingan($file);
			}
		}
			//redirect('admin/bimbingan/detail/'.$this->input->post('mhs').'/'.$pengid);
			redirect( 'admin/bimbingan/detail/'.$this->input->post('mhs').'/'.$this->input->post('pengid'));
	}
	
	function rd(){
		$id = $this->session->userdata('userid');	
		$result	= $this->m_pgw->get_rekap_mhs_bim($id);
			if(!empty($result) || $result !=''){
				$data['result'] = $result;
				$this->template->load2('template-admin','page/admin/bimbingan_dospem',$data);
			}else{
				$this->template->load2('template-admin','page/admin/rekapnulldospem');
			}
			

	}
}
?>