<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller
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
		
		$this->template->load2('template-admin','page/admin/agenda');
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function get_brt(){

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
	}
	
	function add(){

		$this->template->load2('template-admin','page/admin/agenda_add');
	}
	
	function submit(){

		$this->form_validation->set_rules('judul', 'judul', 'trim|required|xss_clean');
		$this->form_validation->set_rules('isi', 'isi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('katberita', 'katberita', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        
		if ($this->form_validation->run() == FALSE)
        {

            echo "<script language=\"javascript\">alert('Data tidak boleh kosong');</script>";
            echo "<script language=\"javascript\">history.go(-1);</script>";
        
        }else{
			
			$judul		=$this->input->post('judul',TRUE);
			$isi		=$this->input->post('isi',TRUE);
			$upload 	='userfile';
			$gambar		=$_FILES['userfile']['name'];
			$kategori	=$this->input->post('katberita',TRUE);
			$status		=$this->input->post('status',TRUE);
			
			$config['upload_path'] = "./assets/img/berita/";
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['file_name'] = $gambar;
			$config['overwrite'] = false;						
			$this->load->library('upload');
			$this->upload->initialize($config);

			if(!$this->upload->do_upload($upload))
			{
				
				$alert =$this->upload->display_errors();
				//echo "<script language=\"javascript\">alert('$alert');</script>";
				//echo "<script language=\"javascript\">history.go(-1);</script>";
				echo $alert;

			} else {

				$this->m_berita->add($judul, $isi, $gambar, $kategori, $status);			
				redirect ('admin/berita');

			}
			
		}
	}

	function edit(){
	
		$id=$this->uri->segment(4);
		$data['berita'] = $this->m_berita->get_data($id);
		$this->template->load2('template-admin','page/admin/berita_edit',$data);
	}
	
	function submit_edit(){
	
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Pass', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('level', 'Level', 'trim|required|xss_clean');
		$this->form_validation->set_rules('userfile', 'Foto', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        
		if($this->form_validation->run() == FALSE){
			echo "<script language=\"javascript\">alert('Data tidak boleh kosong');</script>";
            echo "<script language=\"javascript\">history.go(-1);</script>";
		}else{
			//$id = $this->input->post('jur_id');
				$this->m_berita->update();
				redirect('admin/berita');
		}
	}
	
	function del(){
		
		$id=$this->uri->segment(4);
		$this->m_berita->delete($id);
		redirect('admin/berita');
	}
}
?>