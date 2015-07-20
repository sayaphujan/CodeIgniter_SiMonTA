<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library(array('Datatables','Upload'));
		$this->load->model(array('m_katberita','m_berita'));
		$this->load->helper(array('url','form'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');

	}
	
	function index(){
		if($this->session->userdata('levelid')!='2'){
			redirect('admin/login');
		}else{
			$data['berita']=$this->m_berita->get_all_berita();
			$this->template->load2('template-admin','page/admin/berita', $data);
		}
	}
	
	function custom_page(){
	
			$this->myauth->logged_in_custom('2');
	}
	
	/*function get_brt(){

		$this->datatables->select('berita_id, berita_judul, berita_img, berita_tanggal, berita_waktu, katberita_nama, berita_status')
		->unset_column('berita_id')
		->from('berita')
		->join('katberita','katberita.katberita_id=berita.katberita_id')
		->add_column('aksi',
        	'<a href="'.site_url('admin/berita/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/berita/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'berita_id');

		echo $this->datatables->generate();
	}*/
	
	function add(){

		$data['katberita'] = $this->m_katberita->get_all_katberita();
		$this->template->load2('template-admin','page/admin/berita_add',$data);
	}
	
	function edit(){
	
		$id=$this->uri->segment(4);
		$data['berita'] = $this->m_berita->get_data($id);
		$data['katberita'] = $this->m_katberita->get_all_katberita();
		$this->template->load2('template-admin','page/admin/berita_edit',$data);
	}
	
	function submit(){

		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|xss_clean');
		$this->form_validation->set_rules('isi', 'Konten Berita', 'trim|required|xss_clean');
		$this->form_validation->set_rules('katberita', 'Kategori Berita', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
			$data['katberita']  = $this->m_katberita->get_all_katberita();
			$data['bid']		= $this->input->post('berita_id',TRUE);
			$data['bjudul']		= $this->input->post('judul',TRUE);
			$data['bisi']		= $this->input->post('isi',TRUE);
			$data['bkat']		= $this->input->post('katberita',TRUE);
			$upload 			='userfile';
				
				if ($this->form_validation->run() == FALSE){
					$data['error']="";
					$this->template->load2('template-admin','page/admin/berita_edit',$data);
				}else{
						//changed value from key
						if( !empty($_FILES['userfile']['name'])){
							
							$config['upload_path'] = "./assets/berita/";
							$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
							$config['file_name'] = $_FILES['userfile']['name'];
							$config['max_size']  = '1000';
							$config['overwrite'] = false;
							$this->load->library('upload');
							$this->upload->initialize($config);
							if (!$this->upload->do_upload($upload)){
								$data['error'] = $this->upload->display_errors();
								//$data['error'] = 'error';
								$this->template->load2('template-admin','page/admin/berita_edit',$data);
							}else{
								if($this->input->post('berita_id',TRUE)!=0){
									$this->m_berita->update();
								}else{
									$this->m_berita->add();
								}
								redirect('admin/berita');
							}
						}else{
							$data['error'] = '';
							$this->template->load2('template-admin','page/admin/berita_edit',$data);
						}
				}
	}
	
	function change_status(){
		$id = $_GET['id'];
		$status = $_GET['status'];
		if(!empty($id)){
			$result = $this->m_berita->change_status($id,$status);
			if(!empty($result)){
				$notif = "Sukses mengubah status";
				echo json_encode(array('msg'=>$notif)); 
			}
		}
	}
	
	function del(){
		
		$id=$this->uri->segment(4);
		$this->m_berita->delete($id);
		redirect('admin/berita');
	}
}
?>