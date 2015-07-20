<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->library(array('myauth','Datatables'));
		$this->myauth->logged_in();
		$this->output->nocache();
		$this->template->title('Dashboard');
		$this->load->helper('download');
		$this->load->model(array('m_mhs','m_pengajuan','m_tema','m_paper'));
		$data['mhs']= $this->m_mhs->get_mhs($this->session->userdata('userid'));
		$this->template->set('navbar',$this->load->view('theme/navbar-mhs',$data,TRUE));
		$this->template->set('sidebar',$this->load->view('theme/sidebar-mhs',$data,TRUE));
		$this->template->set('header','');
	}
	
	function index(){
	$id = $this->session->userdata('userid');
	$cek_dash = $this->m_mhs->act_dashboard($id);
		foreach($cek_dash->result() as $dash){
			if ($dash->judul =='NON AKTIF'){
				redirect('mahasiswa');
			}
		}
		$data['error']		='';
		$id 				= $this->session->userdata('userid');
		$data['pengajuan']	= $this->m_pengajuan->get_all_data($id);
		$this->template->load('template','page/pengajuan',$data);
	}
	
	function detail(){
		//$id 				= $this->session->userdata('userid');
		$pengid 			= $this->uri->segment(3);
		$data['pengajuan']	= $this->m_pengajuan->get_detail( $pengid);
		$this->template->load('template','page/pengajuan_detail',$data);
	}
	
	function add(){
		
		$data['tema']= $this->m_tema->get_all_tema();
		$this->template->load('template','page/pengajuan_add',$data);
	}
	
	function edit(){
		$id = $this->uri->segment(3);
		$data['pengajuan'] = $this->m_pengajuan->get_data($id);
		$data['tema'] = $this->m_tema->get_all_tema();
		$this->template->load('template','page/pengajuan_edit',$data);
	}
	
	function submit(){

		$this->form_validation->set_rules('tema', 'Tema', 'trim|required|xss_clean');
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|xss_clean|is_unique[pengajuan.peng_judul]');
		$this->form_validation->set_rules('label', 'Latar Belakang', 'trim|required|xss_clean');
		$this->form_validation->set_rules('metopen', 'Metode Pengembangan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ginput', 'Gambaran Input', 'trim|required|xss_clean');
		$this->form_validation->set_rules('goutput', 'Gambaran Output', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
				$id 					= $this->session->userdata('userid');
				$data['pid'] 			= $this->input->post('peng_id');
				$data['t'] 				= $this->input->post('tema');
				$data ['j'] 			= $this->input->post('judul');
				$data ['l'] 			= $this->input->post('label');
				$data ['m'] 			= $this->input->post('metopen');
				$data ['gi'] 			= $this->input->post('ginput');
				$data ['go'] 			= $this->input->post('goutput');
				$data ['act'] 			= $this->input->post('act');
				$data['tema']			= $this->m_tema->get_all_tema();
				$act 					= $this->input->post('act');
				
		if ($this->form_validation->run() == FALSE){
			$this->template->load('template','page/pengajuan_edit',$data);
		}else{
			if($act=='add'){
				/*$result = $this->m_pengajuan->count_mhs();
				if($result==''){
					$result2 = $this->m_pengajuan->count_stat($id);
					if($result2!=''){*/
						$this->m_pengajuan->add($id);
						$kat_lap_id = 0;
						$level = $this->m_pengajuan->preinputpesan($id);
						$result = $this->m_pengajuan->pesantoprodi($id, $level, $kat_lap_id);
						redirect ('pengajuan');
					/*}else{
						$data['error']		= '<p class="text-danger"><b>Pengajuan Anda telah DISETUJUI. Hubungi Admnistrator untuk Pergantian Judul<b></p>';
						$data['pengajuan']	= $this->m_pengajuan->get_all_data($id);
						$this->template->load('template','page/pengajuan',$data);
					}
				}else{
					$data['error']		= '<p class="text-danger"><b>Pengajuan Tidak Boleh Lebih Dari 3 Pengajuan<b></p>';
					$data['pengajuan']	= $this->m_pengajuan->get_all_data($id);
					$this->template->load('template','page/pengajuan',$data);
				}*/
			}else if($act=='edit'){
				$this->m_pengajuan->update();
				redirect ('pengajuan');
			}
		}
	}
	
	function del(){
		
		$id=$this->uri->segment(3);
		$this->m_pengajuan->delete($id);
		redirect('pengajuan');
	}
	
	function get_file(){
		$this->m_pengajuan->download();
	}
	
	function abstrak(){
		$id = $this->session->userdata('userid');
		$no = 2;
		$data['proposal'] = $this->m_paper->get_all_proposal($id, $no);
		$this->template->load('template','page/abstrak',$data);
	}
	
	function addabs(){
		$data['file']='';
		$this->template->load('template','page/abstrak_add',$data);
	}
	
	function editabs(){
		$id = $this->uri->segment('3');
		$data['proposal']=$this->m_paper->get_prop($id);
		$this->template->load('template','page/abstrak_add', $data);
	}
}
?>