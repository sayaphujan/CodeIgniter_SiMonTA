<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_jabatan extends CI_Model{

	protected $tbl = 'jabatan';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_jab(){

		$this->db->select('*');
		$this->db->from('jabatan');
		$query= $this->db->get();
		
		return $query;


	}

	function add(){

		$jabatan		= $this->input->post('jabatan');
		//$status			= $this->input->post('status');
		$status			= 'aktif';

		$data = array(
				'jab_id' 	=> null,
				'jab_nama'	=> $jabatan,
				'jab_status'=> $status
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('jab_id',$id);
		$q=$this->db->get('jabatan');
		return $q;
	}

	function update(){

		$id				= $this->input->post('jab_id');
		$jabatan		= $this->input->post('jabatan');
		$status			= 'aktif';

		$data = array(
				'jab_id' 		=> $id,
				'jab_nama'		=> $jabatan,
				'jab_status'	=> $status
			);

		$this->db->where('jab_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('jab_id'=>$id));
		return;
	}
}