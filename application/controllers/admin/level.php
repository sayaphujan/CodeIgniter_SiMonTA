<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Level extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model(array('m_level','m_pgw'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		
	}
	
	function index(){
		$data['level']=$this->m_level->get_all_level();
		$this->template->load2('template-admin','page/admin/level',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	/*function get_level(){

		$this->datatables->select('level_id, level_name, level_status')
		->unset_column('level_id')
		->from('leveluser')
		->add_column('aksi',
        	'<a href="'.site_url('admin/level/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			','level_id')/*
			<a href="'.site_url('admin/level/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'level_id');

		echo $this->datatables->generate();
	}*/
	
	function data(){
	
		$id=$this->uri->segment(4);
		$data['level'] = $this->m_level->get_data($id);
		$this->template->load2('template-admin','page/admin/level_edit',$data);
	}
	
	function submit(){

		$this->form_validation->set_rules('level', 'Level', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			$this->data();
		}else{
			if ($this->input->post('level_id')==""){
				$this->m_level->add();
			}
			else if ($this->input->post('level_id')!=""){
				$this->m_level->update();
			}
				redirect('admin/level');
		}
	}
	
	function del(){
		$id=$this->uri->segment(4);
		$this->m_level->delete($id);
		redirect('admin/level');
	}
	
	function listing(){
		$this->template->load2('template-admin','page/admin/leveldosen');
	}
	
	function addleveldos(){

		$data['level'] = $this->m_level->get_all_level();
		$data['pegawai']=$this->m_pgw->get_all_data();
		$this->template->load2('template-admin','page/admin/leveldos_add',$data);
	}
	
	function submit_dos(){

		$this->form_validation->set_rules('level', 'Level', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dosen', 'Dosen', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			$this->addleveldos();
		}else{
				$this->m_pgw->addlevel();
				redirect('admin/level/listing');
		}
	}
}
?>