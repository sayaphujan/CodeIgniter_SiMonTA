<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myauth{

	
	function __construct(){
		$this->ci =& get_instance();
	}

	public function set_database($db_name)
    {
		$db_data = $this->ci->load->database($db_name, TRUE);
		$this->ci->db = $db_data;
	}

	public function login($cond=array(),$table){
	/* $cond = username & password */
	
		$data = array();
		foreach ($cond as $key => $value) {
			$data[$key] = $value;
		}
		
		$query = $this->ci->db->get_where($table,$data);

		if($query->num_rows() != 1){

			return false;
		}else{

			return $query->row();
		}
	}

	function logged_in(){
	/* kalo input url, dan level != 6 redirect to beranda */
	/* modul ini dipanggil di Controller/mahasiswa*/
	
		$levelid = $this->ci->session->userdata('levelid');
		
		if($levelid != '6' || $levelid==''){
			header('location: '.site_url('beranda'));
		}
	}
	
	function logged_mahasiswa(){
		$levelid = $this->ci->session->userdata('levelid');
		
		if($levelid == '6'){
			header('location: '.site_url('mahasiswa'));
		}
	}

	function logged_in_custom($level){

		$levelid = $this->ci->session->userdata('levelid');

		if($levelid != $level){
			header('location: '.site_url('admin'));			
		}
	}

	function logged_in_admin(){
	/* mahasiswa atau empty level just stop at gerbang admin aja */
	
		$levelid = $this->ci->session->userdata('levelid');

		if($levelid == '' || $levelid == '6'){
		//if($levelid !='2'){
			header('location: '.site_url('admin'));	
		}
		
	}

	function logout($props=array(),$page){
	/* $page nya Mahasiswa ke beranda */
	/* $page nya Dosen ke admin/login */
	
		foreach($props as $key => $value){
			
			$this->ci->session->unset_userdata($value);
			
		}

		header('location: '.site_url($page));
	}
}