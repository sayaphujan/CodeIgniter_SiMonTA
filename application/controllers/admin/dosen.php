<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model(array('m_level','m_pgw','m_mhs'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		$data['pegawai']=$this->m_pgw->get_all_pgw();
		$this->template->load2('template-admin','page/admin/pegawai', $data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function add(){
		$data['level'] = $this->m_level->level_jab();
		$this->template->load2('template-admin','page/admin/pgw_add',$data);
	}

	function edit(){
	
		$id=$this->uri->segment(4);
		$data['pegawai'] = $this->m_pgw->get_data($id);
		$data['level'] = $this->m_level->level_jab();
		$this->template->load2('template-admin','page/admin/pgw_edit',$data);
	}
	
	function submit(){
		$this->form_validation->set_rules('n1', '6 Digit Pertama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n2', '6 Digit Kedua', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n3', '3 Digit Ketiga', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('username', 'Username', 'is_unique[pegawai.pgw_nip]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[pegawai.pgw_username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');

		/*property checking db*/
		$num		= ".";
		$n1			= $this->input->post('n1');
		$n2			= $this->input->post('n2');
		$n3			= $this->input->post('n3');
		$nip 		= $n1.$num.$n2.$num.$n3;
		$user		= $this->input->post('username');
		$level		= $this->input->post('jabatan');
		/*property reload edit*/
		$data['level'] 		= $this->m_level->level_jab();
		$data['pn1']		= $n1;
		$data['pn2']		= $n2;
		$data['pn3']		= $n3;
		$data['pnip']		= $nip;
		$data['pid']		= $this->input->post('pgw_id');
		$data['pnama']		= $this->input->post('nama');
		$data['pusername']	= $this->input->post('username');
		$data['ppass']		= $this->input->post('pass');
		$data['plevel']		= $this->input->post('jabatan');
		$upload 			='userfile';
		//$ext 				= preg_replace("/^(.+?);.*$/", "\\1", $_FILES['userfile']['type']);
		$foto 				= preg_replace("/^(.+?);.*$/", "\\1", $_FILES['userfile']['name']);
		
		
				$config['upload_path'] = "./assets/pegawai/";
				$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
				$config['file_name'] = $foto;
				//$config['file_name'] = $upload;
				$config['max_size']  = '1000';
				$config['overwrite'] = false;						
				$this->load->library('upload',$config);
				$error = $this->upload->display_errors();
				

		/*validation before action*/
		if($this->form_validation->run() == FALSE || (!$this->upload->do_upload($upload)&&!empty($_FILES['userfile']['name']))){
			$this->cekform($nip, $level, $error, $data);
		}else{
			if($this->input->post('pgw_id',TRUE)!=0){
				$this->cekform($nip, $level, $error, $data);
				$this->m_pgw->update($foto);
			}else{
				$this->cekform($nip, $level, $error, $data);
				$this->m_pgw->add($foto);
			}
				redirect('admin/dosen');				
		}
			
		
	}
	
	function cekform($nip, $level, $error, $data){
	$cek1 = $this->m_pgw->cek_nip($nip);
	$cek3 = $this->m_pgw->cek_level($level);
				/*		if($cek1 ==0 || $cek3 ==0 || empty($n1) || empty($n2) || empty($n3) || empty($level)){
							$data['niperr'] = '';
							$data['levelerr'] = '';
						}
						if($cek1 >0){
							$data['niperr'] = '<p class="text-danger">Data Duplikat</p>';
							$data['levelerr'] = '';
						}
						if($cek3 >0){
							$data['niperr'] = '';
							$data['levelerr'] = '<p class="text-danger">Jabatan ini hanya dapat dijabat oleh 1 Orang</p>';
						}
						if($cek1 >0 && $cek3 >0){
							$data['niperr'] = '<p class="text-danger">Data Duplikat</p>';
							$data['levelerr'] = '<p class="text-danger">Jabatan ini hanya dapat dijabat oleh 1 Orang</p>';
						}*/
						$data['pfoto'] = $error;
						$this->template->load2('template-admin','page/admin/pgw_edit',$data);
	}
	
	/*
	function submit_edit(){
		
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('level', 'Level User', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		if($this->form_validation->run() == FALSE){
			
			$id = $this->input->post('pgw_id');
			$data['pegawai'] = $this->m_pgw->get_data($id);
			$data['jabatan'] = $this->m_jabatan->get_all_jab();
			$data['level'] 	 = $this->m_level->get_all_level();
			$this->template->load2('template-admin','page/admin/pgw_edit',$data);
			
		}else{
				$this->m_pgw->update();
				redirect('admin/dosen');
		}
	}*/
	
	function del(){
		
		$id=$this->uri->segment(4);
		$this->m_pgw->delete($id);
		redirect('admin/dosen');
	}

	function dospem(){
		
		$this->template->load2('template-admin','page/admin/dospem');
	}
	
	function bagi(){
		$data['bagi'] = $this->m_pgw->bagi();
		$this->template->load2('template-admin','page/admin/bagidosen',$data);
	}
	
	function bagiadd(){
		$data['bid'] 	= '';
		$data['bdosen'] = '';
		$data['bp1'] 	= '';
		$data['bp2'] 	= '';
		$data['pegawai']= $this->m_pgw->get_all_pgw();
		$this->template->load2('template-admin','page/admin/bagidosen_add',$data);
	}
	
	function bagiedit(){
		$id = $this->uri->segment(4);
		$data['pegawai']	= $this->m_pgw->get_all_pgw();
		$data['bagidosen']	= $this->m_pgw->get_bagi($id);
		$this->template->load2('template-admin','page/admin/bagidosen_add',$data);
	}
	
	function bagisubmit(){
		$this->form_validation->set_rules('dosen', 'Dosen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('satu', 'Pilihan Dosen Pembimbing 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dua', 'Pilihan Dosen Pembimbing 2', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
		
		$data['bid'] 	= $this->input->post('id');
		$data['bdosen'] = $this->input->post('dosen');
		$data['bp1'] 	= $this->input->post('satu');
		$data['bp2'] 	= $this->input->post('dua');
        
		if($this->form_validation->run() == FALSE){
			$data['pegawai']= $this->m_pgw->get_all_pgw();
			$this->template->load2('template-admin','page/admin/bagidosen_add',$data);
		}else{
			
		$id 	= $this->input->post('id');
		$dosen 	= $this->input->post('dosen');
		$satu 	= $this->input->post('satu');
		$dua 	= $this->input->post('dua');
		
			if(empty($id) || $id ==''){
				$this->m_pgw->add_bagi($dosen, $satu, $dua);
			}else{
				$this->m_pgw->update_bagi($id, $dosen, $satu, $dua);
			}
		redirect('admin/dosen/bagi');
		}
	}
}
?>