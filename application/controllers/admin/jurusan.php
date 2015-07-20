<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model('m_jurusan');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		$data['jurusan']=$this->m_jurusan->get_all_jur();
		$this->template->load2('template-admin','page/admin/jurusan', $data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	/*function get_jur(){
	
		$this->datatables->select('jur_id, jur_nama, jur_status')
		->unset_column('jur_id')
		->from('jurusan')
		->add_column('aksi',
        	'<a href="'.site_url('admin/jurusan/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/jurusan/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'jur_id');

		echo $this->datatables->generate();
	}*/
	
	function data(){
	
		$id=$this->uri->segment(4);
		$data['jurusan'] = $this->m_jurusan->get_data($id);
		$this->template->load2('template-admin','page/admin/jur_edit',$data);
	}
	
	function submit(){
	
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			$this->data();
		}else{
			if ($this->input->post('jur_id')==""){
				$this->m_jurusan->add();
			}
			else if ($this->input->post('jur_id')!=""){
				$this->m_jurusan->update();
			}
				redirect('admin/jurusan');
		}
	}	
	
	function del(){
		$id=$this->uri->segment(4);
		$this->m_jurusan->delete($id);
		redirect('admin/jurusan');
	}

}
?>