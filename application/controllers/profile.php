<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->library('myauth');
		$this->myauth->logged_in();
		$this->output->nocache();
		$this->template->title('Dashboard');
		$this->load->model(array('m_mhs','m_jurusan','m_konsentrasi'));
		$data ['mhs']= $this->m_mhs->get_mhs($this->session->userdata('userid'));
		$this->template->set('navbar',$this->load->view('theme/navbar-mhs',$data,TRUE));
		$this->template->set('sidebar',$this->load->view('theme/sidebar-mhs',$data,TRUE));
		$this->template->set('header','');
	}
	
	function index(){
		
		//$id=$this->session->userdata('userid');
		$data['mhsw']= $this->m_mhs->get_mhs($this->session->userdata('userid'));
		$data['jurusan'] = $this->m_jurusan->get_all_jur();
		$data['konsentrasi'] = $this->m_konsentrasi->get_all_kon();
		$this->template->load('template','page/profile',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('6');
	}
}
?>