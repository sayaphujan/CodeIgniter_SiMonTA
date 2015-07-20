<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_tapel extends CI_Model{

	protected $tbl = 'tapel';
	protected $tbl2 = 'ta';
	protected $tbl3 = 'mhs_akhir';
	protected $tbl4 = 'dashboard_oto';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_tapel(){
		$this->db->select('*');
		$this->db->order_by('tapel_id','desc');
		$sql = $this->db->get($this->tbl);

 		return $sql->result();
	}
	
	function get_group_tapel(){
		$this->db->select('*');
		//$this->db->where('tapel_status',0);
		$this->db->group_by('tapel_akad');
		$this->db->order_by('tapel_id','asc');
		$sql = $this->db->get($this->tbl);

 		return $sql->result();
	}
	
	function get_rekap($akad, $sm){
		$this->db->select('*');
		$this->db->where('tapel_id',$akad);
		$this->db->where('tapel_semester',$sm);
		$sql = $this->db->get($this->tbl);

 		return $sql;
	}
	
	function get_now_tapel(){
		//$datenow = date('Y-m-d', now());
		
		$this->db->select('*');
		$this->db->where('tapel_status',1);
		$sql = $this->db->get($this->tbl);

 		return $sql;
	}
	
	function cekaktifasi(){
		$this->db->select('*');
		$this->db->where('tapel_status',1);
		$sql = $this->db->get($this->tbl);
		
		if($sql->num_rows() <>0){
			return '1';
		}else{
			return '';
		}
	}
	
	function cekaktifasita(){
		$this->db->select('*');
		$this->db->where('ta_status',1);
		$sql = $this->db->get($this->tbl2);
		
		if($sql->num_rows() <>0){
			return '1';
		}else{
			return '';
		}
	}
	
	function cekfungsiaktif($id){
		$this->db->select('tapel_status');
		$this->db->where('tapel_id',$id);
		$sql = $this->db->get($this->tbl);
		
		foreach($sql->result() as $s){
			if($s->tapel_status <>0){
				return '1';
			}else{
				return '';
			}
		}
	}

	function add(){
		$separator = '/';
		$strip = '-';
		$id		= $this->input->post('id_akad');
		$ta1	= $this->input->post('ta1');
		$ta2	= $this->input->post('ta2');
		$sm		= $this->input->post('semester');	
		$mulai	= $this->input->post('mulai');
		$akhir	= $this->input->post('akhir');
		$status	= $this->input->post('status');
		
		$akad	= $ta1.$separator.$ta2;
		
		$tahun_mulai = substr($mulai,6,4);
		$bulan_mulai = substr($mulai,3,2);
		$tanggal_mulai = substr($mulai,0,2);
		$t_mulai = $tahun_mulai.$strip.$bulan_mulai.$strip.$tanggal_mulai;
		
		$tahun_akhir = substr($akhir,6,4);
		$bulan_akhir = substr($akhir,3,2);
		$tanggal_akhir = substr($akhir,0,2);
		$t_akhir = $tahun_akhir.$strip.$bulan_akhir.$strip.$tanggal_akhir;
		
		$data = array(
				'tapel_id' 		=> null,
				'tapel_akad'	=> $akad,
				'tapel_mulai'	=> $t_mulai,
				'tapel_akhir'	=> $t_akhir,
				'tapel_semester'=> $sm,
				'tapel_status'	=> $status
			);

		$insert = $this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('tapel_id',$id);
		$q=$this->db->get($this->tbl);
		return $q;
	}

	function update(){

		$separator = '/';
		$strip = '-';
		$id		= $this->input->post('id_akad');
		$ta1	= $this->input->post('ta1');
		$ta2	= $this->input->post('ta2');
		$sm		= $this->input->post('semester');	
		$mulai	= $this->input->post('mulai');
		$akhir	= $this->input->post('akhir');
		$status	= $this->input->post('status');
		
		$akad	= $ta1.$separator.$ta2;
		
		$tahun_mulai = substr($mulai,6,4);
		$bulan_mulai = substr($mulai,3,2);
		$tanggal_mulai = substr($mulai,0,2);
		$t_mulai = $tahun_mulai.$strip.$bulan_mulai.$strip.$tanggal_mulai;
		
		$tahun_akhir = substr($akhir,6,4);
		$bulan_akhir = substr($akhir,3,2);
		$tanggal_akhir = substr($akhir,0,2);
		$t_akhir = $tahun_akhir.$strip.$bulan_akhir.$strip.$tanggal_akhir;
		
		$data = array(
				'tapel_id' 		=> $id,
				'tapel_akad'	=> $akad,
				'tapel_mulai'	=> $t_mulai,
				'tapel_akhir'	=> $t_akhir,
				'tapel_semester'=> $sm,
				'tapel_status'	=> $status
			);

		$this->db->where('tapel_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('tapel_id'=>$id));
		return;
		
	}
	
	function updateaktif($id, $tap_status){
		$this->db->set('tapel_status',$tap_status);
		$this->db->where('tapel_id',$id);
		$this->db->update($this->tbl);
		
		if($tap_status=='0'){ #jika tapel dinonaktifkan
			$this->lock_dash($id); #lock dashboard
			
			$this->db->select('*');
			$this->db->where('tapel_id',$id);
			$getta = $this->db->get($this->tbl2);
			
			foreach($getta->result() as $m){ 
				$id = $m->ta_id;
				$status = 'NON AKTIF';
				
				$this->activeta($id, $status);
			}
		}
	}
	
	function lock_dash($id){
		$this->db->select('*');
		$this->db->where('tapel_id',$id);
		$getmhs = $this->db->get($this->tbl3);
	
			foreach($getmhs->result() as $m){ $mhsid = $m->mhs_id;

				$data = array(
								'daftar'		=> 'NON AKTIF',
								'judul'			=> 'NON AKTIF',
								'proposal'		=> 'NON AKTIF',
								'bab1'			=> 'NON AKTIF',
								'bab2'			=> 'NON AKTIF',
								'bab3'			=> 'NON AKTIF',
								'bab4'			=> 'NON AKTIF',
								'bab5'			=> 'NON AKTIF',
								'bab6'			=> 'NON AKTIF'
							);
				
				$this->db->where('mhs_id',$mhsid);
				$this->db->update($this->tbl4,$data);
			}
	}
	
	function activesmester(){
		$this->db->select('*');
		$this->db->from('ta');
		$this->db->join('jurusan','ta.jur_id=jurusan.jur_id');
		$this->db->join('tapel','tapel.tapel_id=ta.tapel_id');
		$this->db->group_by('ta.ta_id');
		$this->db->order_by('tapel.tapel_id','desc');
		$d = $this->db->get();
		
		return $d;
	}
	
	function addta(){
		
		$strip = '-';
		//$id		= $this->input->post('ta_id');
		$angkatan	= $this->input->post('angkatan');
		$jurusan	= $this->input->post('jurusan');	
		$mulai		= $this->input->post('mulai');
		$akhir		= $this->input->post('akhir');
		$status		= $this->input->post('status');
		
		$tahun_mulai = substr($mulai,6,4);
		$bulan_mulai = substr($mulai,3,2);
		$tanggal_mulai = substr($mulai,0,2);
		$t_mulai = $tahun_mulai.$strip.$bulan_mulai.$strip.$tanggal_mulai;
		
		$tahun_akhir = substr($akhir,6,4);
		$bulan_akhir = substr($akhir,3,2);
		$tanggal_akhir = substr($akhir,0,2);
		$t_akhir = $tahun_akhir.$strip.$bulan_akhir.$strip.$tanggal_akhir;
		
		
		$this->db->select('tapel_id');
		$this->db->where('tapel_status',1);
		$q = $this->db->get($this->tbl);
		
		foreach($q->result() as $a){$tap = $a->tapel_id;}
		$data = array(
				'ta_id' 		=> null,
				'angk'			=> $angkatan,
				'jur_id'		=> $jurusan,
				'ta_mulai'		=> $t_mulai,
				'ta_akhir'		=> $t_akhir,
				'ta_status'		=> $status,
				'tapel_id'		=> $tap
			);

		$this->db->insert($this->tbl2, $data);
	}
	
	function get_ta($id){
		$this->db->select('*');
		$this->db->where('ta_id',$id);
		$que = $this->db->get($this->tbl2);
		
		return $que;
	}
	
	function updateta(){
		
		$strip = '-';
		$id		= $this->input->post('ta_id');
		$angkatan	= $this->input->post('angkatan');
		$jurusan	= $this->input->post('jurusan');	
		$mulai		= $this->input->post('mulai');
		$akhir		= $this->input->post('akhir');
		$status		= $this->input->post('status');
		
		$tahun_mulai = substr($mulai,6,4);
		$bulan_mulai = substr($mulai,3,2);
		$tanggal_mulai = substr($mulai,0,2);
		$t_mulai = $tahun_mulai.$strip.$bulan_mulai.$strip.$tanggal_mulai;
		
		$tahun_akhir = substr($akhir,6,4);
		$bulan_akhir = substr($akhir,3,2);
		$tanggal_akhir = substr($akhir,0,2);
		$t_akhir = $tahun_akhir.$strip.$bulan_akhir.$strip.$tanggal_akhir;
		
		
		$this->db->select('tapel_id');
		$this->db->where('tapel_status',1);
		$q = $this->db->get($this->tbl);
		
		foreach($q->result() as $a){$tap = $a->tapel_id;}
		$data = array(
				'ta_id' 		=> $id,
				'angk'			=> $angkatan,
				'jur_id'		=> $jurusan,
				'ta_mulai'		=> $t_mulai,
				'ta_akhir'		=> $t_akhir,
				'ta_status'		=> $status,
				'tapel_id'		=> $tap
			);

		$this->db->where('ta_id',$id);
		$this->db->update($this->tbl2, $data);
	}
	
	function delta($id){
		$this->db->delete($this->tbl2,array('ta_id'=>$id));
		return;
	}
	
	function activeta($id, $status){
		$this->db->set('ta_status', $status);
		$this->db->where('ta_id', $id);
		$this->db->update($this->tbl2);
	}
}