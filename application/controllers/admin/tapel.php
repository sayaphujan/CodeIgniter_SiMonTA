<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tapel extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model(array('m_tapel','m_konsentrasi','m_jurusan','m_paper'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		$data['error']='';
		$data['tapel']= $this->m_tapel->get_all_tapel();
		$this->template->load2('template-admin','page/admin/listtapel', $data);
	}
	
	function add(){
		$data['idakad']		= '';
		$data['ta1']	= '';
		$data['ta2']	= '';
		$data['sm']		= '';	
		$data['mulai']	= '';
		$data['akhir']	= '';
		$data['status']	= '';
		$data['error']	= '';
		$this->template->load2('template-admin','page/admin/tapel',$data);
	}
	
	function custom_page(){
		$data=(array('2'));
		$this->myauth->logged_in_custom($data);
	}
	
	function edit(){
		$id = $this->uri->segment(4);
		$data['error']	= '';
		$data['tapel']= $this->m_tapel->get_data($id);
		$this->template->load2('template-admin','page/admin/tapel', $data);
	}
	
	function submit(){
		$this->form_validation->set_rules('ta1', 'Tahun Akademik Pertama', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('ta2', 'Tahun Akademik Kedua', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mulai', 'Tanggal Mulai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('akhir', 'Tanggal Berakhir', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		$data['idakad']		= $this->input->post('id_akad');
		$data['ta1']	= $this->input->post('ta1');
		$data['ta2']	= $this->input->post('ta2');
		$data['sm']		= $this->input->post('semester');	
		$data['mulai']	= $this->input->post('mulai');
		$data['akhir']	= $this->input->post('akhir');
		$data['status']	= $this->input->post('status');
		if($this->form_validation->run() == FALSE){
			$data['error']	= '';
			$this->template->load2('template-admin','page/admin/tapel',$data);
		}else{
			if ($this->input->post('id_akad')==""){
				if($this->input->post('status')==1){
					$cek = $this->m_tapel->cekaktifasi();
					if($cek==''){
						$this->m_tapel->add();
					}else{
						$data['error']	= '<p class="text-danger">Hanya satu Tahun Akademik yang dapat diaktifkan</p>';
						$this->template->load2('template-admin','page/admin/tapel',$data);
					}
				}else{
					$this->m_tapel->add();
				}	
			}else if ($this->input->post('id_akad')!=""){
				if($this->input->post('status')==1){
					$cek = $this->m_tapel->cekaktifasi();
					if($cek==''){
						$this->m_tapel->update();
					}else{
						$data['error']	= '<p class="text-danger">Hanya satu Tahun Akademik yang dapat diaktifkan</p>';
						$this->template->load2('template-admin','page/admin/tapel',$data);
					}
				}else{
					$this->m_tapel->update();
				}		
			}
				redirect('admin/tapel');
		}
	}
	
	function del(){
	$id = $this->uri->segment(4);
		$this->m_tapel->delete($id);
		redirect('admin/tapel');
	}
	
	function aktif(){
		$id  = $this->uri->segment(4);
		$status = $this->m_tapel->cekfungsiaktif($id);
			if(!empty($status)){
				$tap_status='0';
				$this->m_tapel->updateaktif($id, $tap_status);
				redirect('admin/tapel');
			}else{
				$cek2 = $this->m_tapel->cekaktifasi();
				if($cek2==''){
					$tap_status='1';
					$this->m_tapel->updateaktif($id, $tap_status);
					redirect('admin/tapel');
				}else{
					$data['error']	= '<p class="text-danger">Hanya satu Tahun Akademik yang dapat diaktifkan</p>';
								//echo "<script>alert('Hanya satu Tahun Akademik yang dapat diaktifkan');</script>";
								//echo "<script>history.go(-1);</script>";
					$data['tapel']= $this->m_tapel->get_all_tapel();
					$this->template->load2('template-admin','page/admin/listtapel',$data);
				}
			}
	}
	
	function ta(){
		$data['cek'] = $this->m_tapel->cekaktifasi();
		$data['reg'] = $this->m_tapel->activesmester();
		$this->template->load2('template-admin','page/admin/detailta', $data);
	}
	
	function ta_add(){
		$data['ju'] 		= $this->m_jurusan->get_all_jur();
		$data['an'] 		= $this->m_jurusan->angkatan();
		$data['id']			= '';
		$data['angkatan']	= '';
		$data['jurusan']	= '';	
		$data['mul']		= '';
		$data['ak']			= '';
		$data['stat']		= 'NON AKTIF';
		$this->template->load2('template-admin','page/admin/ta', $data);
	}
	
	function ta_edit(){
		$id = $this->uri->segment('4');
		$data['ju'] 		= $this->m_jurusan->get_all_jur();
		$data['an'] 		= $this->m_jurusan->angkatan();
		$data['tapel']		= $this->m_tapel->get_ta($id);
		$this->template->load2('template-admin','page/admin/ta', $data);
	}
	
	function submitta(){
		$this->form_validation->set_rules('angkatan', 'Angkatan', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('jurusan', 'Program Studi', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('mulai', 'Tanggal Mulai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('akhir', 'Tanggal Berakhir', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
        
		$data['ju'] = $this->m_jurusan->get_all_jur();
		$data['an'] = $this->m_jurusan->angkatan();
		$data['taid']	= $this->input->post('ta_id');
		$data['angk']	= $this->input->post('angkatan');
		$data['jur']	= $this->input->post('jurusan');	
		$data['mulai']	= $this->input->post('mulai');
		$data['akhir']	= $this->input->post('akhir');
		$data['status']	= $this->input->post('status');
		if($this->form_validation->run() == FALSE){
			$this->template->load2('template-admin','page/admin/ta',$data);
		}else{
			$id = $this->input->post('ta_id');
			$jur = $this->input->post('jurusan');
			$stat = $this->input->post('status');
			
			if ($this->input->post('ta_id')==""){
				if($stat=='AKTIF'){
					$this->m_tapel->addta();
					//$this->m_paper->open_krs($id, $jur);
				}else{
					$this->m_tapel->addta();
				}
			}else{
				if($stat=='AKTIF'){
					$this->m_tapel->updateta();
					//$this->m_paper->open_krs($id, $jur);
				}else{
					$this->m_tapel->updateta();
				}
			}
			
					
				redirect('admin/tapel/ta');
		}
	}
	
	function ta_del(){
		$id = $this->uri->segment(4);
		$this->m_tapel->delta($id);
		redirect('admin/tapel/ta');
	}
	
	function taaktif(){
		$id 	= $this->uri->segment(4);
		$jur 	= $this->uri->segment(5);
		$status = 'AKTIF';
		
		$this->m_tapel->activeta($id, $status);
		$this->m_paper->open_krs($id, $jur);
		redirect('admin/tapel/ta');
	}
	
	function tainaktif(){
		$id 	= $this->uri->segment(4);
		$jur 	= $this->uri->segment(5);
		
		$status = 'NON AKTIF'; 
		$this->m_tapel->activeta($id, $status);
		//$this->m_paper->lock_krs($id, $jur);
		redirect('admin/tapel/ta');
	}
}
?>