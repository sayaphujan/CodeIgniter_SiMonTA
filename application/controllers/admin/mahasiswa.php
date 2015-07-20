<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library(array('Datatables','upload'));
		$this->load->model(array('m_jurusan','m_konsentrasi','m_level','m_mhs'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		
	}
	
	function index(){
		$level = $this->session->userdata('levelid');
		if($level=="10" or $level=="11" or $level=="12" or $level=="13"){
			$data['konsentrasi'] = $this->m_konsentrasi->get_kon_jur_prodi($level);
		}else{
			$data['konsentrasi'] = $this->m_konsentrasi->get_kon_jur();
		}
		$this->template->load2('template-admin','page/admin/premahasiswa',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}

	
	function detail(){
		$jur = $this->uri->segment(4);
		$kon = $this->uri->segment(5);
		$angk = $this->uri->segment(6);
		if ($angk==''){
			echo "<script>alert('Angkatan belum dipilih');</script>";
			echo "<script>history.go(-1);</script>";
		}else {
			$data['jurusan'] = $this->m_jurusan->get_data($jur);
			$data['konsentrasi'] = $this->m_konsentrasi->get_data($kon);
			$data['mahasiswa'] = $this->m_mhs->detail($jur, $kon, $angk);
			$this->template->load2('template-admin','page/admin/mahasiswa', $data);
		}
	}
	
	function add(){
	
		$jur = $this->uri->segment(4);
		$kon = $this->uri->segment(5);
		$angk = $this->uri->segment(6);
		$data['juru'] = $this->m_jurusan->get_data($jur);
		$data['kons'] = $this->m_konsentrasi->get_data($kon);
		$data['last_nim'] = $this->m_mhs->get_last_nim($jur,$angk);
		$this->template->load2('template-admin','page/admin/mhs_add',$data);
	}
	
	/*function submit(){
		
			$this->form_validation->set_rules('nim', 'NIM', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
			$this->form_validation->set_message('required','%s Tidak boleh kosong');
			
			if($this->form_validation->run() == FALSE){
							
				$this->add();
			}else{
				$jur = $this->uri->segment(4);
				$kon = $this->uri->segment(5);
				$angk = $this->uri->segment(6);
				$this->m_mhs->add($jur, $kon, $angk);
				$this->detail();
			}
	}*/

	function edit(){
		$jur 	= $this->uri->segment(4);
		$kon 	= $this->uri->segment(5);
		$angk 	= $this->uri->segment(6);
		$id 	= $this->uri->segment(7);
		$data['juru'] = $this->m_jurusan->get_data($jur);
		$data['kons'] = $this->m_konsentrasi->get_data($kon);
		
		$data['mahasiswa'] = $this->m_mhs->get_data($jur, $kon, $angk, $id);
		$this->template->load2('template-admin','page/admin/mhs_edit',$data);
	}

	function submit(){
		$jur 	= $this->uri->segment(4);
		$kon 	= $this->uri->segment(5);
		$angk 	= $this->uri->segment(6);
		$id 	= $this->uri->segment(7);
		
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');

			$data['juru'] 		= $this->m_jurusan->get_data($jur);
			$data['kons'] 		= $this->m_konsentrasi->get_data($kon);
			$data['mid']		= $this->input->post('mhs_id',TRUE);
			$data['mnim']		= $this->input->post('nim',TRUE);
			$data['mnama']		= $this->input->post('nama',TRUE);
			$data['mpass']		= $this->input->post('pass',TRUE);
			$upload 			='userfile';
			
				$config['upload_path'] = "./assets/mahasiswa/";
				$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
				$config['file_name'] = $_FILES['userfile']['name'];
				$config['max_size']  = '1000';
				$config['overwrite'] = false;						
				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->do_upload($upload);
				$error = $this->upload->display_errors();

				if($this->form_validation->run() == FALSE || (!$this->upload->do_upload($upload)&&!empty($_FILES['userfile']['name']))){
							$data['mfoto'] = $error;
						$this->template->load2('template-admin','page/admin/mhs_edit',$data);
				}
				else{			
						if($this->input->post('mhs_id',TRUE)!=0){
							$this->m_mhs->update($jur, $kon, $angk, $id);
						}else{
							$this->m_mhs->add($jur, $kon, $angk);
						}
							redirect('admin/mahasiswa/detail/'.$jur.'/'.$kon.'/'.$angk);
				}
	}
	
	function del(){
		
		$id=$this->uri->segment(7);
		
		//redirect('admin/mahasiswa');
		$result = $this->m_mhs->delete($id);
			if(!empty($result)){
				$notif = "Sukses mengubah status";
				echo json_encode(array('msg'=>$notif)); 
			}
		$this->detail();
	}
	
	function alumni(){
	$jur 	= $this->uri->segment(4);
	$kon 	= $this->uri->segment(5);
	$akad 	= $this->uri->segment(6);
	$smest 	= $this->uri->segment(7);
		$data['alumni'] = $this->m_mhs->alumni($jur, $kon, $akad, $smest);
		$data['jur'] 	= $jur;
		$data['kon'] 	= $kon;
		$data['akad'] 	= $akad;
		$data['smest']	= $smest;
		$this->template->load2('template-admin','page/admin/alumni',$data);
	}
}
?>