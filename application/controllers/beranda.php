<?php 

header('Access-Control-Allow-Origin: *');
header('Cache-Control: max-age=900');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->template->title('Home');
		$this->load->library('myauth');
		$this->myauth->logged_mahasiswa();
		$this->load->model('m_berita');
		$data['berita']=$this->m_berita->get_all_berita();
		$this->template->set('navbar',$this->load->view('theme/navbar',$data,TRUE));
		$this->template->set('header',$this->load->view('theme/header',$data,TRUE));
		$this->template->set('sidebar',$this->load->view('theme/sidebar',$data,TRUE));
		
	}

	public function index(){
		$data['berita']=$this->m_berita->get_all_berita();
		$this->template->load('template','page/news',$data);
	}

	function selengkapnya(){
		$id = $this->uri->segment(3);
		$data['detail']=$this->m_berita->get_data($id);
		$this->template->load('template','page/news_detail',$data);
	}
	
	public function login(){

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_user_check');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s tidak boleh kosong');

		if($this->form_validation->run() == FALSE){

			$data = array(
				'status' => 'error',
				'err_user' => form_error('username'),
				'err_pass' => form_error('password')
			);

			echo json_encode($data);
		}else{

			$path = site_url('mahasiswa');
			$data = array(
				'status' => 'success',
				'path' => $path
			);

			echo json_encode($data);
		}
	}

	public function user_check($pass){

		$username  = $this->input->post('username');
		$table = 'mahasiswa';

		$cond = array();
		$cond['mhs_nim']  = $username;
		$cond['mhs_pass'] = md5($pass);

		$this->myauth->set_database('default');
		$result = $this->myauth->login($cond,$table);

		if($result == FALSE ){

			$this->form_validation->set_message('user_check','Username atau password Anda salah');
			return FALSE;
		}else{

			$session = array(
				'userid' 	=> $result->mhs_id,
				'levelid'   => $result->level_id,
				'name'		=> $result->mhs_nama,
				'nim'		=> $result->mhs_nim,
				
			);

			$this->session->set_userdata($session);

			return TRUE;
		}

	}

}