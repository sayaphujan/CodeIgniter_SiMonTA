<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_kompetensi extends CI_Model{

	protected $tbl = 'kompetensi';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_komp(){
	
		$this->db->select('*');
		$this->db->from('kompetensi');
		$this->db->order_by('komp_id','asc');
		$sql = $this->db->get();
 		return $sql;

	}

	function add(){

		$kompetensi		= $this->input->post('kompetensi');
		//$status			= $this->input->post('status');
		$status			= 'aktif';

		$data = array(
				'komp_id' 	=> null,
				'komp_nama'	=> $kompetensi,
				'komp_status'	=> $status
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('komp_id',$id);
		$q=$this->db->get('kompetensi');
		return $q;
	}

	function update(){

		$id				= $this->input->post('komp_id');
		$kompetensi		= $this->input->post('kompetensi');
		$status			= $this->input->post('status');

		$data = array(
				'komp_id' 		=> $id,
				'komp_nama'		=> $kompetensi,
				'komp_status'	=> $status
			);

		$this->db->where('komp_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('komp_id'=>$id));
		return;
	}
}