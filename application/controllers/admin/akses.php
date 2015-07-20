<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akses extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model(array('m_akses','m_level','m_pgw'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');

	}
	
	function index(){
		if($this->session->userdata('levelid')!='2'){
			redirect('admin/login');
		}else{
		
		$result = $this->m_level->get_level_dosen();
		$maxdos = $this->m_level->count_dos();
			foreach($result as $key=>$res)
			{
				$dosen[$res['pgw_id']] = explode(',', $res['level']);
			}
			$data['result'] = $result;
			$data['maxdos'] = $maxdos;
			$data['dosen'] = $dosen;
		$this->template->load2('template-admin','page/admin/leveldosen',$data);
		}
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function detail	(){
		$id=$this->uri->segment(4);
		$result = $this->m_level->get_levelname_concat($id);
		$maxdos = $this->m_level->count_dos();
			foreach($result as $key=>$res)
			{
				$dosen[$res['pgw_id']] = explode(',', $res['level']);
			}
			$data['result'] = $result;
			$data['maxdos'] = $maxdos;
			$data['dosen'] = $dosen;
		$data['akses']=$this->m_level->akses_dosen($id);
		$this->template->load2('template-admin','page/admin/akses',$data);
	}
	
	function edit(){
		$id=$this->uri->segment(4);		
		$data['pgw'] = $this->m_level->getdos($id);
		$data['pegawai']= $this->m_pgw->get_all_pgw();
		$result = $this->m_level->get_level_concat($id);
		$data['result'] = $result;
		$this->template->load2('template-admin','page/admin/akses_edit',$data);
	}
	
	function submit(){
		$id=$this->uri->segment(4);		
		$this->form_validation->set_rules('pegawai', 'Dosen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('level[]', 'Level', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
		
		if($this->form_validation->run() == FALSE){
			$this->edit();
		}else{
			$this->m_akses->update($id);
			redirect('admin/akses');
		}
	}
	
	function change_status(){
		$id = $_GET['id'];
		$status = $_GET['status'];
		if(!empty($id)){
			$result = $this->m_akses->change_status($id,$status);
			if(!empty($result)){
				$notif = "Sukses mengubah status";
				//$notif=$id;
				echo json_encode(array('msg'=>$notif)); 
			}
		}
	}
	
	function del(){
		$dosid=$this->uri->segment(4);
		$id=$this->uri->segment(5);
		$this->m_akses->delete($id);
		redirect('admin/akses/detail/'.$dosid);
	}
}
?>