<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_konsentrasi extends CI_Model{

	protected $tbl = 'konsentrasi';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_kon(){
		$this->db->select('*');
		$this->db->from('konsentrasi');
		$query = $this->db->get();
		
 		return $query;
	}
	
	function get_kon_jur(){
		$this->db->select('*');
		$this->db->from('konsentrasi');
		$this->db->join('jurusan','jurusan.jur_id=konsentrasi.jur_id');
		$query= $this->db->get();
		
		return $query;
	}
	
	function get_kon_jur_prodi($level){
	
	if($level=='10'){
			$jur = "1";
		}else if($level=='11'){
			$jur = "2";
		}else if($level=='12'){
			$jur = "3";
		}else if($level=='13'){
			$jur = "4";
		}

		$this->db->select('*');
		$this->db->from('konsentrasi');
		$this->db->join('jurusan','jurusan.jur_id=konsentrasi.jur_id');
		$this->db->where('jurusan.jur_id',$jur);
		$query= $this->db->get();
		
		return $query;
	}
	
	function add(){

		$konsentrasi	= $this->input->post('konsentrasi');
		$jurusan		= $this->input->post('jurusan');
		$status			= 'aktif';

		$data = array(
				'kon_id' 		=> null,
				'kon_nama'		=> $konsentrasi,
				'kon_status'	=> $status,
				'jur_id'		=> $jurusan
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('kon_id',$id);
		$q=$this->db->get('konsentrasi');
		return $q;
	}

	function update(){

		$id				= $this->input->post('kon_id');
		$konsentrasi	= $this->input->post('konsentrasi');
		$status			= $this->input->post('status');

		$data = array(
				'kon_id' 		=> $id,
				'kon_nama'		=> $konsentrasi,
				'kon_status'	=> $status
			);

		$this->db->where('kon_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('kon_id'=>$id));
		return;
	}
}