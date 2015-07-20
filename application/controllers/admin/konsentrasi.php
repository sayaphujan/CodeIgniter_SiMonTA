<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konsentrasi extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model(array('m_konsentrasi','m_jurusan'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		$data['konsentrasi']=$this->m_konsentrasi->get_kon_jur();
		$this->template->load2('template-admin','page/admin/konsentrasi',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	/*function get_kon(){

		$this->datatables->select('jur_nama, kon_id, kon_nama, kon_status')
		->unset_column('kon_id')
		->from('konsentrasi')
		->join('jurusan','jurusan.jur_id = konsentrasi.jur_id')
		->add_column('aksi',
        	'<a href="'.site_url('admin/konsentrasi/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/konsentrasi/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'kon_id');

		echo $this->datatables->generate();
	}*/
	
	function add(){
		$data['jurusan'] = $this->m_jurusan->get_all_jur();
		$this->template->load2('template-admin','page/admin/kon_add', $data);
	}
	
	function submit(){
		$this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			if($this->input->post('kon_id')==""){
				$data['juru'] 			= $this->input->post('jurusan');
				$data['jurusan'] = $this->m_jurusan->get_all_jur();
				$data ['konsen'] 		= $this->input->post('konsentrasi');
				$this->template->load2('template-admin','page/admin/kon_add',$data);
				
			}else if($this->input->post('kon_id')!=""){
				$id=$this->input->post('kon_id');
				$data['idkon']			= $this->input->post('kon_id');
				$data['jurusan'] 		= $this->m_jurusan->get_all_jur();
				$data['juru'] 			= $this->input->post('jurusan');
				$data['konsentrasi'] 	= $this->m_konsentrasi->get_data($id);
				$data ['konsen'] 		= $this->input->post('konsentrasi');
				$this->template->load2('template-admin','page/admin/kon_edit',$data);
			}
		}else{
			if($this->input->post('kon_id')==""){
				$this->m_konsentrasi->add();
			}else if($this->input->post('kon_id')!=""){
				$this->m_konsentrasi->update();
			}
				redirect('admin/konsentrasi');
		}
	}

	function edit(){
	
		$id=$this->uri->segment(4);
		$data['jurusan'] = $this->m_jurusan->get_all_jur();
		$data['konsentrasi'] = $this->m_konsentrasi->get_data($id);
		$this->template->load2('template-admin','page/admin/kon_edit',$data);
	}
	
	function submit_edit(){
	
		$this->form_validation->set_rules('konsentrasi', 'konsentrasi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			$this->edit();
		}else{
			//$id = $this->input->post('jur_id');
				$this->m_konsentrasi->update();
				redirect('admin/konsentrasi');
		}
	}
	
	function del(){
		$id=$this->uri->segment(4);
		$this->m_konsentrasi->delete($id);
		redirect('admin/konsentrasi');
	}
}
?>