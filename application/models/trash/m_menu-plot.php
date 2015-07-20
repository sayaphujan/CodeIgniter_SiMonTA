<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_menu extends CI_Model{

	function __construct(){
		parent::__construct();
	}


	function general_menu(){

		$this->db->select('level_id,menu_id,menu_description,menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('level_id',1);
		$query = $this->db->get();

		return $query;
	}

	/*function custom_menu($level){

		$this->db->select('level_id,menu_id,menu_description,menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('level_id',$level);
		$this->db->order_by("menu_description","asc");
		$query = $this->db->get();

		return $query;
	}*/
	
	function sub_menu_user($level){

		$this->db->select('level_id, menu_id, menu_description, menu_group, menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('menu_group','user');
		$this->db->where('akses_status','AKTIF');
		$this->db->where('level_id',$level);
		$this->db->order_by("menu_description","asc");
		$query = $this->db->get();

		return $query;
	}
	
	function sub_menu_dosen($level){
		$this->db->select('level_id, menu_id, menu_description, menu_group, menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('menu_group','dosen');
		$this->db->where('akses_status','AKTIF');
		$this->db->where('level_id',$level);
		$this->db->order_by("menu_description","asc");
		$query = $this->db->get();

		return $query;
	}

	function sub_menu_akademik($level){

		$this->db->select('level_id, menu_id, menu_description, menu_group, menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('menu_group','akademik');
		$this->db->where('akses_status','AKTIF');
		$this->db->where('level_id',$level);
		$this->db->order_by("menu_description","asc");
		$query = $this->db->get();

		return $query;
	}
	
	function sub_menu_ta($level){

		$this->db->select('level_id, menu_id, menu_description, menu_group, menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('menu_group','ta');
		$this->db->where('akses_status','AKTIF');
		$this->db->where('level_id',$level);
		$this->db->order_by("menu_description","asc");
		$query = $this->db->get();

		return $query;
	}
	
	function sub_menu_admin($level){

		$this->db->select('level_id, menu_id, menu_description, menu_group, menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('menu_group','admin');
		$this->db->where('akses_status','AKTIF');
		$this->db->where('level_id',$level);
		$this->db->order_by("menu_description","asc");
		$query = $this->db->get();

		return $query;
	}
}