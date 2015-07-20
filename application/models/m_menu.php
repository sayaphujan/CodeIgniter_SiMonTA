<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_menu extends CI_Model{

	function __construct(){
		parent::__construct();
	}


	function general_menu(){

		$this->db->select('level_id,menu_id,menu_description,menu_group,menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('level_id',1);
		$query = $this->db->get();

		return $query;
	}

	function custom_menu($level){

		$this->db->select('level_id,menu_id,menu_description,menu_group,menu_path');
		$this->db->from('akses');
		$this->db->join('menu','akses.menu=menu.menu_id');
		$this->db->where('akses_status','AKTIF');
		$this->db->where('level_id',$level);
		$this->db->order_by('menu_group','desc');
		$this->db->order_by('menu_id','asc');
		$query = $this->db->get();

		return $query;
	}
	
	function menu_tugas(){
		$id = $this->session->userdata('userid');
		$this->db->select('a.level_id, b.level_name'); 
		$this->db->from('leveldosen a');
		$this->db->join('leveluser b','a.level_id=b.level_id');
		$this->db->where('a.pgw_id',$id);
		$this->db->where('a.level_id NOT IN (select level_id from pegawai where pgw_id='.$id.')',NULL, FALSE );
		$this->db->order_by('b.level_id','asc');
		$query = $this->db->get();

		return $query->result();
	}
}