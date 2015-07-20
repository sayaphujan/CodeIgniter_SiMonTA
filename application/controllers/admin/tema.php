<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tema extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model('m_tema');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		
	}
	
	function index(){
		$data['tema'] = $this->m_tema->get_all_tema();
		$this->template->load2('template-admin','page/admin/tema',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('3');
	}
	
	/*function get_tema(){

		$this->datatables->select('tema_id, tema_nama, tema_status')
		->unset_column('tema_id')
		->from('tema')
		->edit_column('tema_status','<select class="form-control combo-status" name="status" id="combo-$2">
			 <option value="$1" selected>$1</option>
			 <option value="AKTIF">AKTIF</option>
			 <option value="NON-AKTIF">NON-AKTIF</option>
			</select>','tema_status,tema_id')
		->add_column('aksi',
        	'<a href="'.site_url('admin/tema/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/level/tema/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'tema_id');

		echo $this->datatables->generate();
	}
*/
	
	function data(){
	
		$id=$this->uri->segment(4);
		$data['tema'] = $this->m_tema->get_data($id);
		$this->template->load2('template-admin','page/admin/tema_edit',$data);
	}
	
	function submit(){

		$this->form_validation->set_rules('tema', 'Tema', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			$this->data();
		}else{
			if ($this->input->post('tema_id')==""){
				$this->m_tema->add();
			}
			else if ($this->input->post('tema_id')!=""){
				$this->m_tema->update();
			}
				redirect('admin/tema');
		}
	}

	function change_status(){
		$id = $_GET['id'];
		$status = $_GET['status'];
		if(!empty($id)){
			
			$result = $this->m_tema->change_status($id,$status);
			if(!empty($result)){
				$notif = "Sukses mengubah status";
				echo json_encode(array('msg'=>$notif)); 
			}
		}
	}
	
	function del(){
		$id=$this->uri->segment(4);
		$this->m_tema->delete($id);
		redirect('admin/tema');
	}
}
?>