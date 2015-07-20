<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kompetensi extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model('m_kompetensi');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		$data['kompetensi']=$this->m_kompetensi->get_all_komp();
		$this->template->load2('template-admin','page/admin/kompetensi',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	/*function get_komp(){

		$this->datatables->select('komp_id, komp_nama, komp_status')
		->unset_column('komp_id')
		->from('kompetensi')
		->add_column('aksi',
        	'<a href="'.site_url('admin/kompetensi/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/kompetensi/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'komp_id');

		echo $this->datatables->generate();
	}*/
	
	function data(){
		$id=$this->uri->segment(4);
		$data['kompetensi'] = $this->m_kompetensi->get_data($id);
		$this->template->load2('template-admin','page/admin/komp_edit',$data);
	}
	
	function submit(){
		$this->form_validation->set_rules('kompetensi', 'Kompetensi', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			$this->data();
		}else{
			if ($this->input->post('komp_id')==""){
				$this->m_kompetensi->add();
			}
			else if ($this->input->post('komp_id')!=""){
				$this->m_kompetensi->update();
			}
				redirect('admin/kompetensi');
		}
	}
	
	function del(){
		$id=$this->uri->segment(4);
		$this->m_kompetensi->delete($id);
		redirect('admin/kompetensi');
	}
}
?>