<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_tema extends CI_Model{

	protected $tbl = 'tema';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_tema(){
		$this->db->select('*');
		$this->db->from('tema');
		$this->db->order_by('tema_id','asc');
		$sql = $this->db->get();

 		return $sql;

	}
	
	function add(){

		$tema			= $this->input->post('tema');
		//$status			= $this->input->post('status');
		$status='aktif';

		$data = array(
				'tema_id' 		=> null,
				'tema_nama'		=> $tema,
				'tema_status'	=> $status
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('tema_id',$id);
		$q=$this->db->get('tema');
		return $q;
	}

	function update(){

		$id				= $this->input->post('tema_id');
		$tema			= $this->input->post('tema');
		$status			= "aktif";

		$data = array(
				'tema_id' 		=> $id,
				'tema_nama'		=> $tema,
				'tema_status'	=> $status
			);

		$this->db->where('tema_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('tema_id'=>$id));
		return;
	}
}