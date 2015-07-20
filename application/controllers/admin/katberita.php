<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Katberita extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model('m_katberita');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		
		$this->template->load2('template-admin','page/admin/katberita');
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function get_jur(){
	
		$this->datatables->select('katberita_id, katberita_nama, katberita_status')
		->unset_column('katberita_id')
		->from('katberita')
		->add_column('aksi',
        	'<a href="'.site_url('admin/katberita/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/katberita/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'jur_id');

		echo $this->datatables->generate();
	}
	
	function add(){
	
		$this->template->load2('template-admin','page/admin/katberita_add');
	}
	
	function submit(){
	
		$this->form_validation->set_rules('katberita', 'Katberita', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        
		if($this->form_validation->run() == FALSE){
			echo "<script language=\"javascript\">alert('Data tidak boleh kosong');</script>";
            echo "<script language=\"javascript\">history.go(-1);</script>";
		}else{
			//$id = $this->input->post('jur_id');
				$this->m_katberita->add();
				redirect('admin/katberita');
		}
	}
	
	function edit(){
	
		$id=$this->uri->segment(4);
		$data['katberita'] = $this->m_katberita->get_data($id);
		$this->template->load2('template-admin','page/admin/katberita_edit',$data);
	}
	
	function submit_edit(){
	
		$this->form_validation->set_rules('katberita', 'Katberita', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        
		if($this->form_validation->run() == FALSE){
			echo "<script language=\"javascript\">alert('Data tidak boleh kosong');</script>";
            echo "<script language=\"javascript\">history.go(-1);</script>";
		}else{
			//$id = $this->input->post('jur_id');
				$this->m_katberita->update();
				redirect('admin/katberita');
		}
	}
	
	function del(){
		$id=$this->uri->segment(4);
		$this->m_katberita->delete($id);
		redirect('admin/katberita');
	}

}
?>