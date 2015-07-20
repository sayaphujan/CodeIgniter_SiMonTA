<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function index(){
		
		$this->output->nocache();
		$cek = $this->session->userdata('levelid');
		if( $cek == '1' or $cek == '2' or $cek == '3' or $cek == '4' or $cek == '5' or $cek == '10' or $cek == '11' or $cek == '12' or $cek == '13')
		//if( $cek != '1' or $cek != '6')
		{
			redirect('admin/dashboard');
		}
			$data['pgw_username'] = '';
			$this->load->view('login',$data);
	}

	public function check(){

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_user_check');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');

		if($this->form_validation->run() == FALSE){

			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');

			$this->load->view('login',$data);
		}else{
			redirect('admin/dashboard');
		}

	}

	public function user_check($pass){

		$username  = $this->input->post('username');
		$table = 'pegawai';
	

		$cond = array();
		$cond['pgw_username']  = $username;
		$cond['pgw_pass'] = md5($pass);

		$this->myauth->set_database('default');
		$result = $this->myauth->login($cond,$table);

		if($result == FALSE ){

			$this->form_validation->set_message('user_check','Username atau password Anda salah');
			return FALSE;
		}else{
			$ses = $result->pgw_id;
			$session = array(
				'userid' 	=> $result->pgw_id,
				'levelid'   => $result->level_id,
				'name'		=> $result->pgw_nama
			);

			$this->session->set_userdata($session);
			//$this->session->set_userdata('logged_in', TRUE); 

			return TRUE;
		}

	}

	public function logout(){

		$data = array('userid','levelid','name');
		$page = 'admin/login';

		$this->myauth->logout($data,$page);
	}
}