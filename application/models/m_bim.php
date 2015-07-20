<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_bim extends CI_Model{

	protected $tbl = 'bimbingan';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	function get_all_data(){

		$sql = $this->db->query('select * from bimbingan, dospem, laporan WHERE bimbingan.dospem_id=dospem.dospem_id AND bimbingan.lap_id=laporan.lap_id order by bim_id asc');
 		return;

	}

	function add($kat, $isi){
	
		$data = array(
							'lap_id'=>null,
							'mhs_id'=>$this->session->userdata('userid'),
							'kat_lap_id'=>$kat,
							'lap_file'=>$isi,
							'lap_tgl'=>date('Y-m-d'),
							'lap_waktu'=>date('H:i:s')
							);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('lap_id',$id);
		$q=$this->db->get('laporan');
		return $q;
	}

}