<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_akses extends CI_Model{

	protected $tbl = 'akses';
	protected $tbl2 = 'leveldosen';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_menu(){
		$this->db->select('*');
		$this->db->from('menu');
		$query = $this->db->get();
		
 		return $query;

	}
	
	function get_aks_level(){
		$this->db->select('*');
		$this->db->from('akses');
		$this->db->join('leveluser','leveluser.level_id=akses.level_id');
		$this->db->join('menu','menu.menu_id=akses.menu');
		$this->db->order_by('leveluser.level_name','asc');
		$query= $this->db->get();
		
		return $query;
	}
	
	function add(){

		$level		= $this->input->post('level');
		$pgw		= $this->input->post('pegawai');

		foreach($this->input->post('level') as $lvl) {
			$data = array(
				'leveldos_id' 		=> null,
				'level_id'			=> $lvl,
				'pgw_id'			=> $pgw
			);
			$this->db->insert($this->tbl2,$data);
		}
	}
	/*
	function add(){
		 foreach($this->input->post('category_name') as $rm)
		{           
			$data=array();
			$data['pegawai']=$this->input->post('pegawai',true),
			$data['level']=$this->input->post('level',true),
		} 
	}*/


	function get_data($id){
		$this->db->select('*');
		$this->db->from('leveldosen');
		$this->db->join('pegawai','pegawai.pgw_id=leveldosen.pgw_id');
		$this->db->where('pgw_id',$id);
		$q=$this->db->get();
		return $q;
	}

	function update($id){
		$level		= $this->input->post('level');
		//$menu		= $this->input->post('menu');

		foreach($this->input->post('level') as $lvl) {
			
			$this->db->select('level_id');
			$this->db->from('leveluser');
			$this->db->where('level_id',$lvl);
			$this->db->where('level_id NOT IN (select level_id from leveldosen where pgw_id='.$id.')',NULL, FALSE);
			$query = $this->db->get();
			
			if($query->num_rows <> 0){
				foreach ($query->result() as $row){
					$data = array(
						'leveldos_id' 		=> null,
						'level_id'			=> $row->level_id,
						'pgw_id'			=> $id
					);
					$this->db->insert($this->tbl2,$data);
				}
			}else{
				$this->db->select('leveldos_id');
				$this->db->where('pgw_id',$id);
				$this->db->where('level_id !=',$lvl);
				$query = $this->db->get($this->tbl2);
				
				foreach($query->result() as $key){
					$this->db->where('leveldos_id',$key->leveldos_id);
					$this->db->delete($this->tbl2);
				}
			}
		}
	}
	
	function change_status($id,$status){
		$this->db->where('akses_id',$id);
		$this->db->set('akses_status',$status);
		$result = $this->db->update($this->tbl);
		
		if($result){
			return $result;
		}else{
			return '';
		}
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('akses_id'=>$id));
		return;
	}
}