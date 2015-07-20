<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Krs extends CI_Controller {
	
	function __construct(){

		parent::__construct();
		$this->load->library('myauth');
		$this->myauth->logged_in();
		$this->output->nocache();
		$this->template->title('Dashboard');
		$this->load->model(array('m_mhs','m_tapel','m_pengajuan','m_paper'));
		$data['mhs']= $this->m_mhs->get_mhs($this->session->userdata('userid'));
		$this->template->set('navbar',$this->load->view('theme/navbar-mhs',$data,TRUE));
		$this->template->set('sidebar',$this->load->view('theme/sidebar-mhs',$data,TRUE));
		$this->template->set('header','');
	}

	public function index(){
	$id = $this->session->userdata('userid');
	$cek_dash = $this->m_mhs->act_dashboard($id);
		foreach($cek_dash->result() as $dash){
			if ($dash->daftar =='NON AKTIF'){
				redirect('mahasiswa');
			}
		}
		$data['tapel']= $this->m_tapel->get_now_tapel();
		$this->template->load('template','page/daftar',$data);
	}
	
	function submit(){
		$this->form_validation->set_rules('smester', 'Smester', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('status', 'Status Mata Kuliah', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
		
		$data['id_ak']		=$this->input->post('id_akad');
		$data['aka']		=$this->input->post('akad');
		$data['smes']		=$this->input->post('stat_smester');
		$data['numsmest']	=$this->input->post('smester');
		$data['status']		=$this->input->post('status');
		if($this->form_validation->run() == FALSE){
			$this->template->load('template','page/daftar',$data);
		}else{
			$mhsid = $this->session->userdata('userid');
			$stat  = $this->input->post('status');
			
			$this->db->select('mhs_id');
			$this->db->where('mhs_id',$mhsid);
			$que = $this->db->get('mhs_akhir');
			
			if($que->num_rows() <>0 && $que->num_rows() % 2 == 1){
				if($stat=='B'){
					$data['error']	= '<p class="text-danger">Anda Telah Mengambil Mata Kuliah ini Sebelumnya. Pilih <b>ULANG</b> pada Status Mata Kuliah </p>';
					$this->template->load('template','page/daftar',$data);
				}else{
					$this->m_mhs->daftarta($mhsid);
					$this->m_pengajuan->add_ulang($mhsid);
					$this->m_pengajuan->add_dospem_ulang($mhsid);
					$this->m_paper->open_dashboard($mhsid);
					redirect('mahasiswa');
				}
			}else if($que->num_rows() <>0 && $que->num_rows() % 2 == 0){
				if($stat=='B'){
					$data['error']	= '<p class="text-danger">Anda Telah Mengambil Mata Kuliah ini Sebelumnya. Pilih <b>ULANG</b> pada Status Mata Kuliah </p>';
					$this->template->load('template','page/daftar',$data);
				}else{
					$this->m_mhs->daftarta($mhsid);
					redirect('mahasiswa');
				}
			}else{
				$this->m_mhs->daftarta($mhsid);
				redirect('mahasiswa');
			}
		}
	}
	
}