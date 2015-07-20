<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan_admin extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->library(array('Datatables'));
		$this->load->model('m_pengajuan');
		$this->load->helper(array('url','form'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		
	}
	
	function index(){
		$data['error']		='';
		$data['pengajuan']	= $this->m_pengajuan->get_all_pengajuan();
		$this->template->load2('template-admin','page/admin/pengajuan_admin',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function del(){
		
		$id=$this->uri->segment(4);
		$this->m_pengajuan->delete($id);
		redirect('admin/pengajuan_admin');
	}
	
}
?>