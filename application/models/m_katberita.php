<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_katberita extends CI_Model{

	protected $tbl = 'katberita';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_katberita(){
		$sql = $this->db->query('select * from katberita where katberita_status="AKTIF" order by katberita_nama asc');
 		return $sql ->result();

	}
	
	function add(){

		$katberita		= $this->input->post('katberita');
		$status			= $this->input->post('status');

		$data = array(
				'katberita_id' 		=> null,
				'katberita_nama'	=> $katberita,
				'katberita_status'	=> $status
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('katberita_id',$id);
		$q=$this->db->get('katberita');
		return $q;
	}

	function update(){

		$id				= $this->input->post('katberita_id');
		$katberita		= $this->input->post('katberita');
		$status			= $this->input->post('status');

		$data = array(
				'katberita_id' 		=> $id,
				'katberita_nama'	=> $katberita,
				'katberita_status'	=> $status
			);

		$this->db->where('katberita_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('katberita_id'=>$id));
		return;
	}
}