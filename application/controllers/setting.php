<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->library('myauth');
		$this->myauth->logged_in();
		$this->output->nocache();
		$this->template->title('Dashboard');
		$this->load->model('m_mhs');
		$data['mhs']= $this->m_mhs->get_mhs($this->session->userdata('userid'));
		$this->template->set('navbar',$this->load->view('theme/navbar-mhs',$data,TRUE));
		$this->template->set('sidebar',$this->load->view('theme/sidebar-mhs',$data,TRUE));
		$this->template->set('header','');
	}
	
	function index(){
		$data['error']= null;
		$data['p1']= null;
		$data['p2']= null;
		$data['p3']= null;
		$id = $this->session->userdata('userid');
		$data['mahasiswa']=$this->m_mhs->get_mhs($id);
		$this->template->load('template','page/setting',$data);
	}
	
	function custom_page(){
		$this->myauth->logged_in_custom('6');
	}
	
	function submit(){
			$this->form_validation->set_rules('pass1', 'Password Lama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pass2', 'Password Baru', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pass3', 'Password Baru (Ulangi)', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
			$this->form_validation->set_message('required','%s Tidak boleh kosong');
			
			if($this->form_validation->run() == FALSE){
				$data['error']= null;
				$data['p1']= $this->input->post('pass1');
				$data['p2']= $this->input->post('pass2');
				$data['p3']= $this->input->post('pass3');
				$id = $this->session->userdata('userid');
				$data['mahasiswa']=$this->m_mhs->get_mhs($id);
				$this->template->load('template','page/setting',$data);
			}else if (md5($this->input->post('pass1')) != $this->input->post('pass') ){
				$data['error']= '<p class="text-danger">Password Lama salah</p>';
				$data['p1']= $this->input->post('pass1');
				$data['p2']= $this->input->post('pass2');
				$data['p3']= $this->input->post('pass3');
				$id = $this->session->userdata('userid');
				$data['mahasiswa']=$this->m_mhs->get_mhs($id);
				$this->template->load('template','page/setting',$data);
			}else if ($this->form_validation->run() == FALSE || $this->input->post('pass2') != $this->input->post('pass3') ){
				$data['error']= '<p class="text-danger">Penulisan Password Baru tidak sama</p>';
				$data['p1']= $this->input->post('pass1');
				$data['p2']= $this->input->post('pass2');
				$data['p3']= $this->input->post('pass3');
				$id = $this->session->userdata('userid');
				$data['mahasiswa']=$this->m_mhs->get_mhs($id);
				$this->template->load('template','page/setting',$data);
			}else{
				$this->m_mhs->update_pass();
				$data['error']= '<p>Password Anda telah dirubah. Silakan <a href="'.site_url('mahasiswa/logout').'"><font color=\'red\'><b><u>LOGIN</u></b></font></a>.</p>';
				$data['p1']= null;
				$data['p2']= null;
				$data['p3']= null;
				$id = $this->session->userdata('userid');
				$data['mahasiswa']=$this->m_mhs->get_mhs($id);
				$this->template->load('template','page/setting',$data);
			}
	}
	
}
?>