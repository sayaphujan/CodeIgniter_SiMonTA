<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_level extends CI_Model{

	protected $tbl = 'leveluser';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_level(){
		$this->db->select('*');
		$this->db->from('leveluser');
		$this->db->order_by('level_name','asc');
		$sql = $this->db->get();
 		
		return $sql;
	}
	
	function level_jab(){
		$this->db->select('*');
		$this->db->from('leveluser');
		$this->db->where('level_id !=',1);
		$this->db->where('level_id !=',3);
		$this->db->where('level_id !=',4);
		$this->db->where('level_id !=',6);
		$this->db->order_by('level_id','asc');
		$sql = $this->db->get();
 		
		return $sql->result();
	}

	function getdos($id){
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('pegawai.pgw_id',$id);
		$sql = $this->db->get();
 		
		return $sql;
	}

	function getlevel($id){
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('leveldosen','leveldosen.pgw_id=pegawai.pgw_id');
		$this->db->join('leveluser','leveluser.level_id=leveldosen.level_id');
		$this->db->where('pegawai.pgw_id',$id);
		$this->db->order_by('leveluser.level_id','asc');
		$sql = $this->db->get();
 		
		return $sql;
	}
	
	function get_level_dosen(){
		$this->db->select('a.pgw_id, b.*, GROUP_CONCAT(c.level_name ORDER BY a.leveldos_id) as level');
		$this->db->from('leveldosen a');
		$this->db->join('pegawai b', 'b.pgw_id = a.pgw_id');
		$this->db->join('leveluser c', 'c.level_id = a.level_id');
		$this->db->group_by('a.pgw_id');
		$this->db->order_by('c.level_id','asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function count_dos()
	{
		$this->db->select('COUNT(*) countrow');
		$this->db->group_by('pgw_id');
		$this->db->order_by('count(*)', 'desc');
		$query = $this->db->get('leveldosen');
		return $query->row_array();
	}
	
	function get_level_concat($id){
		$this->db->select('a.pgw_id, b.*, c.*, GROUP_CONCAT(b.level_id ORDER BY b.level_id) as namalevel');
		$this->db->from('leveldosen a');
		$this->db->join('leveluser b', 'a.level_id = b.level_id');
		$this->db->join('pegawai c', 'a.pgw_id = c.pgw_id');
		$this->db->where('c.pgw_id', $id);
		$this->db->group_by('a.pgw_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_levelname_concat($id){
		$this->db->select('a.*, b.*, c.*, GROUP_CONCAT(b.level_name ORDER BY a.leveldos_id) as level');
		$this->db->from('leveldosen a');
		$this->db->join('leveluser b', 'a.level_id = b.level_id');
		$this->db->join('pegawai c', 'a.pgw_id = c.pgw_id');
		$this->db->where('a.pgw_id', $id);
		$this->db->group_by('a.pgw_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_level()
	{
		$this->db->select('COUNT(*) countrow');
		$this->db->group_by('pgw_id');
		$this->db->order_by('count(*)', 'desc');
		$query = $this->db->get('leveldosen');
		return $query->row_array();
	}
	
	function akses_dosen($id){
		$id=$this->uri->segment(4);
		$this->db->select('*');
		$this->db->from('leveldosen');
		$this->db->join('pegawai','pegawai.pgw_id=leveldosen.pgw_id');
		$this->db->join('leveluser','leveluser.level_id=leveldosen.level_id');
		$this->db->join('akses','akses.level_id=leveluser.level_id');
		$this->db->join('menu','menu.menu_id=akses.menu');
		$this->db->where('leveldosen.pgw_id',$id);
		//$this->db->where('akses.level_id',$id);
		$query = $this->db->get();
		
		return $query;
	}
	
	function add(){

		$jurusan		= $this->input->post('level');
		//$status			= $this->input->post('status');
		$status='aktif';

		$data = array(
				'level_id' 		=> null,
				'level_name'	=> $jurusan,
				'level_status'	=> $status
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('level_id',$id);
		$q=$this->db->get('leveluser');
		return $q;
	}

	function update(){

		$id				= $this->input->post('level_id');
		$level			= $this->input->post('level');
		$status			= "aktif";

		$data = array(
				'level_id' 		=> $id,
				'level_name'	=> $level,
				'level_status'	=> $status
			);

		$this->db->where('level_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('level_id'=>$id));
		return;
	}
}