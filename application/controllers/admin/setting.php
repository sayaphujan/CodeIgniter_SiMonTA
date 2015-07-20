<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model('m_pgw');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		
	}
	
	function index(){
		$data['error']= null;
		$data['p1']= null;
		$data['p2']= null;
		$data['p3']= null;
		$id = $this->session->userdata('userid');
		$data['pegawai']=$this->m_pgw->get_data($id);
		$this->template->load2('template-admin','page/admin/setting',$data);
	}
	
	function custom_page(){
		$data=(array('2','3','4','5','10','11','12','13'));
		$this->myauth->logged_in_custom($data);
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
				$data['pegawai']=$this->m_pgw->get_data($id);
				$this->template->load2('template-admin','page/admin/setting',$data);
			}else if (md5($this->input->post('pass1')) != $this->input->post('pass') ){
				$data['error']= '<p class="text-danger">Password Lama salah</p>';
				$data['p1']= $this->input->post('pass1');
				$data['p2']= $this->input->post('pass2');
				$data['p3']= $this->input->post('pass3');
				$id = $this->session->userdata('userid');
				$data['pegawai']=$this->m_pgw->get_data($id);
				$this->template->load2('template-admin','page/admin/setting',$data);
			}else if ($this->form_validation->run() == FALSE || $this->input->post('pass2') != $this->input->post('pass3') ){
				$data['error']= '<p class="text-danger">Penulisan Password Baru tidak sama</p>';
				$data['p1']= $this->input->post('pass1');
				$data['p2']= $this->input->post('pass2');
				$data['p3']= $this->input->post('pass3');
				$id = $this->session->userdata('userid');
				$data['pegawai']=$this->m_pgw->get_data($id);
				$this->template->load2('template-admin','page/admin/setting',$data);
			}else{
				$this->m_pgw->update_pass();
				$data['error']= '<p>Password Anda telah dirubah. Silakan <a href="'.site_url('admin/login/logout').'"><font color=\'red\'><b><u>LOGIN</u></b></font></a>.</p>';
				$data['p1']= null;
				$data['p2']= null;
				$data['p3']= null;
				$id = $this->session->userdata('userid');
				$data['pegawai']=$this->m_pgw->get_data($id);
				$this->template->load2('template-admin','page/admin/setting',$data);
			}
	}
	
}
?>