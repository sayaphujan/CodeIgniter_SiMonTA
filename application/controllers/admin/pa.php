<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pa extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model(array('m_jurusan','m_pgw','m_mhs','m_konsentrasi'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		if(!$this->session->userdata('is_logged_in') && !strstr(current_url(), 'login')) {
    redirect('admin/login');
}
	}
	
	function index(){
		$level = $this->session->userdata('levelid');
		if($level=="10" or $level=="11" or $level=="12" or $level=="13"){
			$data['pgw']=$this->m_pgw->get_pa_prodi($level);
		}else{
			$data['pgw']=$this->m_pgw->get_all_pa();
		}
		$this->template->load2('template-admin','page/admin/dosenpa',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('3');
	}
	
	/*
	function get_pa(){
	
		$this->datatables->select('akad_id, pgw_nip, pgw_nama, mhs_nim, mhs_nama, jur_nama, kon_nama')
		->unset_column('akad_id')
		->from('akademik')
		->join('pegawai','pegawai.pgw_id=akademik.pgw_id')
		->join('mahasiswa','mahasiswa.mhs_id=akademik.mhs_id')
		->join('jurusan','jurusan.jur_id=mahasiswa.jur_id')
		->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id')
		->add_column('aksi',
        	'<a href="'.site_url('admin/pa/pa_edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/pa/pa_del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'akad_id');

		echo $this->datatables->generate();
	}*/
	
	function pa_add(){
		//$data['jurusan']=$this->m_jurusan->get_all_jur();
		$data['konsentrasi']=$this->m_konsentrasi->get_all_kon();
		$data['pegawai']=$this->m_pgw->get_all_pgw();
		$this->template->load2('template-admin','page/admin/dosenpa_add', $data);
	}
	
	function get_mhs(){
		$level = $this->session->userdata('levelid');
		if($level=='10'){
			$jur = "1";
		}else if($level=='11'){
			$jur = "2";
		}else if($level=='12'){
			$jur = "3";
		}else if($level=='13'){
			$jur = "4";
		}
		//$jur = $this->input->post('jurusan');
		$kon = $this->input->post('konsentrasi');
		$angk = $this->input->post('tahun');
		$data['dosen']			=$this->input->post('dosen');
		$data['angk'] 			=$angk;
		$data['jur']  			=$jur;
		$data['kon'] 			=$kon;
		
		//$data['jurusan']		=$this->m_jurusan->get_all_jur();
		$data['konsentrasi']	=$this->m_konsentrasi->get_all_kon();
		$data['pegawai']		=$this->m_pgw->get_all_pgw();
			
		$this->form_validation->set_rules('dosen', 'Dosen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tahun', 'Angkatan', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Belum dipilih');
		
		if($this->form_validation->run()==FALSE){
			$this->template->load2('template-admin','page/admin/dosenpa_add', $data);
		}else{
			$data['mahasiswa']		=$this->m_mhs->detail_pa($jur, $kon, $angk);
			$this->template->load2('template-admin','page/admin/pa_add_mhs', $data);
		}
	}
	
	function submit(){
		$level = $this->session->userdata('levelid');
		if($level=='10'){
			$jur = "1";
		}else if($level=='11'){
			$jur = "2";
		}else if($level=='12'){
			$jur = "3";
		}else if($level=='13'){
			$jur = "4";
		}
		//$jur = $this->input->post('jurusan');
		$kon = $this->input->post('konsentrasi');
		$angk = $this->input->post('tahun');
		$data['dosen']			=$this->input->post('dosen');
		$data['angk'] 			=$angk;
		$data['jur']  			=$jur;
		$data['kon'] 			=$kon;
		
		//$data['jurusan']		=$this->m_jurusan->get_all_jur();
		$data['konsentrasi']	=$this->m_konsentrasi->get_all_kon();
		$data['pegawai']		=$this->m_pgw->get_all_pgw();
		
		if($this->input->post('cek')=='back'){
			$this->template->load2('template-admin','page/admin/dosenpa_add', $data);
		}
		else if($this->input->post('cek')=='add'){
			$this->form_validation->set_rules('dosen', 'Dosen', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tahun', 'Angkatan', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'trim|required|xss_clean');			
			
			if($this->form_validation->run()==FALSE){
				$this->get_mhs();
			}else{
				$this->form_validation->set_rules('mahasiswa[]', 'Mahasiswa', 'trim|required|xss_clean');
				$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
				$this->form_validation->set_message('required','%s Belum dipilih');
				
				if($this->form_validation->run()==FALSE){
					$data['mahasiswa']		=$this->m_mhs->detail_pa($jur, $kon, $angk);
					$this->template->load2('template-admin','page/admin/pa_add_mhs', $data);
				}else{
					$this->m_pgw->add_pa();
					redirect('admin/pa');
				}
			}
		}
	}
	
	function pa_edit(){
		
		$id=$this->uri->segment(4);
		$data['akademik']=$this->m_pgw->get_data_akad($id);
		$data['pegawai']=$this->m_pgw->get_all_pgw();
		$data['mahasiswa']=$this->m_mhs->detail_pa($jur, $kon, $angk);
		$data['konsentrasi']=$this->m_konsentrasi->get_all_kon();
		$this->template->load2('template-admin','page/admin/dosenpa_edit', $data);
	}
	
	function submit_edit_dosenpa(){
		$this->m_pgw->update_pa();
		redirect ('admin/pa');
	}
	
	function del($id){
		
		$id=$this->uri->segment(4);
		$this->m_pgw->delete_pa($id);
		redirect('admin/pa');
	}
}