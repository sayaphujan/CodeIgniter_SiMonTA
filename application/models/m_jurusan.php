<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_jurusan extends CI_Model{

	protected $tbl = 'jurusan';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_jur(){
		$this->db->select('*');
		$this->db->from('jurusan');
		$this->db->order_by('jur_id','asc');
		$query= $this->db->get();
		return $query;
	}
	
	function angkatan(){
		$this->db->select('angkatan');
		$this->db->from('mahasiswa');
		$this->db->group_by('angkatan');
		$this->db->order_by('angkatan','asc');
		$query= $this->db->get();
		return $query;
	}
	
	function get_all_jur_prodi($level){
	
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
		$this->db->from('jurusan');
		$this->db->where('jur_id', $Jur);
		$this->db->order_by('jur_id','asc');
		$query= $this->db->get();
		return $query;
	}

	
	function add(){

		$jurusan		= $this->input->post('jurusan');
		//$status			= $this->input->post('status');
		$status			= 'aktif';

		$data = array(
				'jur_id' 	=> null,
				'jur_nama'	=> $jurusan,
				'jur_status'	=> $status
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('jur_id',$id);
		$q=$this->db->get('jurusan');
		return $q;
	}

	function update(){

		$id				= $this->input->post('jur_id');
		$jurusan		= $this->input->post('jurusan');
		$status			= $this->input->post('status');

		$data = array(
				'jur_id' 	=> $id,
				'jur_nama'	=> $jurusan,
				'jur_status'	=> $status
			);

		$this->db->where('jur_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('jur_id'=>$id));
		return;
	}
}