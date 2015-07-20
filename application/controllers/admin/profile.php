<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
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
		
		$id = $this->session->userdata('userid');
		$data['pegawai']=$this->m_pgw->get_data($id);
		$this->template->load2('template-admin','page/admin/profile',$data);
	}
	
	function custom_page(){
		$data=(array('2','3','4','5','10','11','12','13'));
		$this->myauth->logged_in_custom($data);
	}
}
?>