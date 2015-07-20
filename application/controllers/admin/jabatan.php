<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model('m_jabatan');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		$data['jabatan']=$this->m_jabatan->get_all_jab();
		$this->template->load2('template-admin','page/admin/jabatan', $data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	/*function get_jab(){
		$this->datatables->select('jab_id, jab_nama, jab_status')
		->unset_column('jab_id')
		->from('jabatan')
		->add_column('aksi',
        	'<a href="'.site_url('admin/jabatan/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/jabatan/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'jab_id');

		echo $this->datatables->generate();
	}*/
	
	function data(){
		$id=$this->uri->segment(4);
		$data['jabatan'] = $this->m_jabatan->get_data($id);
		$this->template->load2('template-admin','page/admin/jab_edit',$data);
	}
	
	function submit(){
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			$this->data();
		}else{
			if ($this->input->post('jab_id')==""){
				$this->m_jabatan->add();
			}
			else if ($this->input->post('jab_id')!=""){
				$this->m_jabatan->update();
			}
				redirect('admin/jabatan');
		}
	}

	function del(){
		$id=$this->uri->segment(4);
		$this->m_jabatan->delete($id);
		redirect('admin/jabatan');
	}
}
?>