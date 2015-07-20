<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_pengajuan extends CI_Model{

	protected $tbl = 'pengajuan';
	protected $tbl2 = 'dospem';
	protected $tbl3 = 'sidang';
	protected $tbl4 = 'pesan_mhs';
	protected $tbl5 = 'tapel';
	protected $tbl6 = 'dashboard_oto';
	protected $tbl7 = 'kategori_nilai_sidang';
	protected $tbl8 = 'topik_revisi';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	/*ADMIN*/
	function get_all_pengajuan(){
		$this->db->select('*');
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id = pengajuan.mhs_id');
		$this->db->join('tema','tema.tema_id = pengajuan.tema_id');
		$this->db->join('tapel','tapel.tapel_id = pengajuan.tapel_id');
		$this->db->where('tapel_status',1);
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_all_pengajuan_rekap($id){
		$this->db->select('*');
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id = pengajuan.mhs_id');
		$this->db->join('tema','tema.tema_id = pengajuan.tema_id');
		$this->db->join('tapel','tapel.tapel_id = pengajuan.tapel_id');
		$this->db->where('tapel_id',$id);
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_all_pengajuan_prodi($level){
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
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id = pengajuan.mhs_id');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('tema','tema.tema_id = pengajuan.tema_id');
		$this->db->join('tapel','tapel.tapel_id = pengajuan.tapel_id');
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('tapel.tapel_status',1);
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_all_pengajuan_prodi_rekap($level, $id){
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
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id = pengajuan.mhs_id');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('tema','tema.tema_id = pengajuan.tema_id');
		$this->db->join('tapel','tapel.tapel_id = pengajuan.tapel_id');
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('tapel.tapel_id',$id);
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_custom_pengajuan_prodi($level, $mhsid){
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
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id = pengajuan.mhs_id');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('tema','tema.tema_id = pengajuan.tema_id');
		$this->db->join('tapel','tapel.tapel_id = pengajuan.tapel_id');
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('mahasiswa.mhs_id',$mhsid);
		$this->db->where('tapel.tapel_status',1);
		$query = $this->db->get();
		
		return $query;
	}
	
	function download() {
        $requested_file = $this->uri->segment(4);
        $this->load->helper('download');
        $this->db->select('*');
        $this->db->where('peng_file',$requested_file);
        $query =  $this->db->get($this->tbl);
        foreach ($query->result() as $row)
       {
			$file_data = file_get_contents(base_url()."/assets/upload/tema/".$row->peng_file);
			$file_name = $row->peng_file;
		}
    force_download($file_name, $file_data);
    }
	
	function change_status($id,$status){
	//get mhs_id
	$this->db->select('tapel_id');
	$this->db->where('tapel_status',1);
	$tap = $this->db->get($this->tbl5);
	foreach($tap->result() as $t){
	$tapid = $t->tapel_id;
	
		if($status=='DISETUJUI'){
		
			//get mhs_id
			$this->db->select('mhs_id');
			$this->db->where('peng_id',$id);
			$this->db->where('tapel_id',$tapid);
			$sql = $this->db->get($this->tbl);
			
			foreach($sql->result() as $key){
				$mhs = $key->mhs_id;
				
				//cek count approval
				$this->db->select('*');
				$this->db->from('pengajuan');
				$this->db->where('pengajuan.mhs_id',$mhs);
				$this->db->where('pengajuan.peng_status','DISETUJUI');
				$this->db->where('tapel_id',$tapid);
				$cek = $this->db->get();

				//jika ada yang disetujui
				if($cek->num_rows() <> 0 ){
					$result = 'lebih';
				}else {
					//cek pembagian dospem
					$this->db->select('mhs_id');
					$this->db->from('dospem');
					$this->db->where('mhs_id',$mhs);
					$this->db->where('tapel_id',$tapid);
					$query = $this->db->get();
					
					#sudah ada dospem
					if($query->num_rows() <> 0){	
						$this->db->set('peng_status',$status);
						$this->db->where('peng_id',$id);
						$this->db->update($this->tbl);
						$result='ada';						
					//jika belum mendapat dospem update status==DISETJUI
					}else{
						$this->db->set('peng_status',$status);
						$this->db->where('peng_id',$id);
						$this->db->update($this->tbl);
						$result=$mhs;//jangan diganti !
					}
				}
			}
		} else if($status!='DISETUJUI'){
			$this->db->where('peng_id',$id);
			$this->db->set('peng_status',$status);
			$this->db->update($this->tbl);
			$result = 'tolak';
		}
		
		/*if($result){
			return $result;
		}else{
			return '';
		}*/
		//$result = $id.'/'.$status;
		return $result;
		}
	}
	
	function add_dospem($mhs){
		$this->db->select('*');
		$this->db->where('tapel_status',1);
		$res = $this->db->get($this->tbl5);
		foreach($res->result() as $tap){}
		//for($i=0; $i<2; $i++){
			$data = array(
						'dospem_id'=>null,
						'mhs_id'=>$mhs,
						'pgw_id'=>0,
						'p1'=>'1',
						'p2'=>'0',
						'tapel_id'=>$tap->tapel_id
						);
			$this->db->insert($this->tbl2,$data);
			
			$data2 = array(
						'dospem_id'=>null,
						'mhs_id'=>$mhs,
						'pgw_id'=>0,
						'p1'=>'0',
						'p2'=>'1',
						'tapel_id'=>$tap->tapel_id
						);
			$this->db->insert($this->tbl2,$data2);
		//}
	}
	
	function add_sidang($mhs){
	$this->db->select('tapel_id');
	$this->db->where('tapel_status',1);
	$que = $this->db->get($this->tbl5);
	foreach($que->result() as $q){}
		$data = array(
						'sidang_id'=>null,
						'mhs_id'=>$mhs,
						'sidang_status'=>'PENDING',
						'sidang_revisi'=>'PENDING',
						'tapel_id'=>$q->tapel_id
						);

		$result2 = $this->db->insert($this->tbl3,$data);
		
		if($result2){
			return $result2;
		}else{
			return '';
		}
	}
	
	function change_komentar($tdata){
		$tdata = array(
			'id' =>  $this->input->post('id'),
			'komentar' =>  $this->input->post('komentar'),
		);
			$this->db->where('peng_id',$tdata['id']);
		    $this->db->set('peng_komentar',$tdata['komentar']);
			$result = $this->db->update($this->tbl);
			
			if($result){
				return $result;
			}else{
				return '';
			}
	}
	
	/*PESAN MHS*/
	function cek($id){
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from(' pesan_mhs');
		$this->db->where('pgw_id',$id);
		$this->db->where('pesan_status',0);
		$this->db->where('pesan_mhs.kat_lap_id !=',3);
		$query= $this->db->get();
		
		if($query->num_rows() <> 0){
			$data = $query->row();
			$kode = intval($data->jumlah); // biar bentuknya integer
		}else{
			$kode = 0;
		}
	
		return $kode;
	}
	
	function lihatpesan($id){
		$this->db->select('*');
		$this->db->from('pesan_mhs');
		$this->db->join('mahasiswa','pesan_mhs.mhs_id=mahasiswa.mhs_id');
		$this->db->join('kategori_laporan','pesan_mhs.kat_lap_id=kategori_laporan.kat_lap_id');
		$this->db->where('pgw_id',$id);
		$this->db->where('pesan_status',0);
		$this->db->where('pesan_mhs.kat_lap_id !=',3);
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function allpesan($id){
		$this->db->select('*');
		$this->db->from('pesan_mhs');
		$this->db->join('mahasiswa','pesan_mhs.mhs_id=mahasiswa.mhs_id');
		$this->db->join('kategori_laporan','pesan_mhs.kat_lap_id=kategori_laporan.kat_lap_id');
		$this->db->where('pgw_id',$id);
		$this->db->where('pesan_mhs.kat_lap_id !=',3);
		$this->db->order_by('pesan_id','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function preinputpesan($id){
		$this->db->select('*');
		$this->db->where('mhs_id',$id);
		$query = $this->db->get('mahasiswa');
		
		foreach($query->result() as $m){
			$jur = $m->jur_id;
			if($jur==1){
				$level = 10;
			}else if ($jur==2){
				$level = 11;
			}else if($jur==3){
				$level = 12;
			}else{
				$level = 13;
			}
		}
		
		return $level;
	}
	
	function pesantoprodi($id, $level, $kat_lap_id){
		$this->db->select('pgw_id');
		$this->db->where('level_id',$level);
		$query = $this->db->get('pegawai');
		
		foreach($query->result() as $p){
			$data = array(
			'mhs_id'=>$id,
			'pgw_id'=>$p->pgw_id,
			'kat_lap_id'=>$kat_lap_id,
			'pesan_isi'=>null,
			'pesan_status'=>0,
			'pesan_tgl'=>date('Y-m-d'),
			'pesan_waktu'=>date('H:i:s')
		);

		$this->db->insert($this->tbl4,$data);
		}
	}
	
	function pesantodospem($mhsid, $kat_lap_id){
		$this->db->select('pgw_id');
		$this->db->where('mhs_id',$mhsid);
		$query = $this->db->get('dospem');
		
		foreach($query->result() as $p){
			$data = array(
			'mhs_id'=>$mhsid,
			'pgw_id'=>$p->pgw_id,
			'kat_lap_id'=>$kat_lap_id,
			'pesan_isi'=>null,
			'pesan_status'=>0,
			'pesan_tgl'=>date('Y-m-d'),
			'pesan_waktu'=>date('H:i:s')
		);

		$this->db->insert($this->tbl4,$data);
		}
	}
	/*END PESAN MHS*/
	/*END ADMIN*/
	
	/*USER*/
	function get_all_data($id){

		$this->db->select('*');
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=pengajuan.mhs_id');
		$this->db->join('tema','tema.tema_id=pengajuan.tema_id');
		$this->db->join('tapel','tapel.tapel_id=pengajuan.tapel_id');
		$this->db->where('pengajuan.mhs_id',$id);
		$this->db->where('tapel.tapel_status',1);
		$this->db->order_by('peng_id','asc');
		$sql = $this->db->get();
		
 		return $sql;

	}
	
	function get_detail($pengid){

		$this->db->select('*');
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=pengajuan.mhs_id');
		$this->db->join('tema','tema.tema_id=pengajuan.tema_id');
		$this->db->where('pengajuan.peng_id',$pengid);
		$sql = $this->db->get();
		
		return $sql;
	}
	
	function count_mhs(){
		
		$result=1;
		$this->db->where('mhs_id', $this->session->userdata('userid'));
		$query = $this->db->get('pengajuan');

		if ($query->num_rows()==3) {
		  //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
			return $result;
		 } else {
		  // doesn't return any row means database doesn't have this email
			return '';
		 }
	}

	function count_stat($id){
		
		$result2=1;
		$query = $this->db->query("SELECT * FROM (`pengajuan`) WHERE `mhs_id` = ".$id." AND `peng_status`= 'DISETUJUI'");

		if ($query->num_rows()==0) {
		  //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
			return $result2;
		 } else {
		  // doesn't return any row means database doesn't have this email
			return '';
		 }
	}
	
	/*function add($file){
	
		$tema		= $this->input->post('tema',TRUE);
		$judul		= $this->input->post('judul',TRUE);
		$nama_file  = preg_replace("/\s+/", "_", $file);
		

		$data = array(
			'mhs_id'=>$this->session->userdata('userid'),
			'tema_id'=>$tema,
			'peng_judul'=>$judul,
			'peng_file'=>$nama_file,
			'peng_tanggal'=>date('Y-m-d'),
			'peng_waktu'=>date('H:i:s')
		);

		$this->db->insert($this->tbl,$data);
	}*/

	function add($id){
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$res = $this->db->get($this->tbl5);
	foreach($res->result() as $tap){}
	
		$tema		= $this->input->post('tema',TRUE);
		$judul		= $this->input->post('judul',TRUE);
		$label 		= $this->input->post('label',TRUE);
		$metpen		= $this->input->post('metopen',TRUE);
		$ginput		= $this->input->post('ginput',TRUE);
		$goutput	= $this->input->post('goutput',TRUE);

		$data = array(
			'mhs_id'=>$id,
			'tema_id'=>$tema,
			'peng_judul'=>$judul,
			'peng_label'=>$label,
			'peng_metpen'=>$metpen,
			'peng_ginput'=>$ginput,
			'peng_goutput'=>$goutput,
			'peng_tanggal'=>date('Y-m-d'),
			'peng_waktu'=>date('H:i:s'),
			'tapel_id'=>$tap->tapel_id
			
		);

		$this->db->insert($this->tbl,$data);
	}
	
	function get_data($id){

		$this->db->where('peng_id',$id);
		$q=$this->db->get('pengajuan');
		return $q;
	}

	/*function update($file){
	
		$pengid		= $this->input->post('peng_id',TRUE);
		$tema		= $this->input->post('tema',TRUE);
		$judul		= $this->input->post('judul',TRUE);
		$nama_file  = preg_replace("/\s+/", "_", $file);
		
		if (!empty($_FILES['userfile']['name'])) {
		$data = array(
				'peng_id'=>$pengid,
				'mhs_id'=>$this->session->userdata('userid'),
				'tema_id'=>$tema,
				'peng_judul'=>$judul,
				'peng_file'=>$nama_file,
				'peng_tanggal'=>date('Y-m-d'),
				'peng_waktu'=>date('H:i:s')
			);
		} else if (empty($_FILES['userfile']['name'])) {
			$data = array(
				'peng_id'=>$id,
				'mhs_id'=>$this->session->userdata('userid'),
				'tema_id'=>$tema,
				'peng_judul'=>$judul,
				'peng_tanggal'=>date('Y-m-d'),
				'peng_waktu'=>date('H:i:s')
			);
		}
		$this->db->where('peng_id',$id);
		$this->db->update($this->tbl,$data);
	}*/
	
	function update(){
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$res = $this->db->get($this->tbl5);
	foreach($res->result() as $tap){}
	
		$pengid		= $this->input->post('peng_id',TRUE);
		$tema		= $this->input->post('tema',TRUE);
		$judul		= $this->input->post('judul',TRUE);
		$label 		= $this->input->post('label',TRUE);
		$metpen		= $this->input->post('metopen',TRUE);
		$ginput		= $this->input->post('ginput',TRUE);
		$goutput	= $this->input->post('goutput',TRUE);

		$data = array(
			'tema_id'=>$tema,
			'peng_judul'=>$judul,
			'peng_label'=>$label,
			'peng_metpen'=>$metpen,
			'peng_ginput'=>$ginput,
			'peng_goutput'=>$goutput,
			'peng_tanggal'=>date('Y-m-d'),
			'peng_waktu'=>date('H:i:s'),
			'tapel_id'=>$tap->tapel_id
		);
		
		$this->db->where('peng_id',$pengid);
		$this->db->update($this->tbl,$data);

	}
	
	function delete($id){
		$this->db->where('peng_id',$id);
		$this->db->delete($this->tbl);
		return;
	}
	
	function add_ulang($mhsid){
	$this->db->select('tapel_id');
	$this->db->where('tapel_status',1);
	$que = $this->db->get($this->tbl5);
	foreach($que->result() as $q){}
	
		$this->db->select('*');
		$this->db->where('mhs_id',$mhsid);
		$this->db->where('peng_status','DISETUJUI');
		$sql = $this->db->get($this->tbl);
		foreach($sql->result() as $sq){
		
		//$judulbaru = ""
			$data = array(
				'peng_id'=>NULL,
				'mhs_id'=>$mhsid,
				'tema_id'=>$sq->tema_id,
				'peng_judul'=>'ulang-'.$sq->peng_judul,
				'peng_label'=>$sq->peng_label,
				'peng_metpen'=>$sq->peng_metpen,
				'peng_ginput'=>$sq->peng_ginput,
				'peng_goutput'=>$sq->peng_goutput,
				'peng_tanggal'=>date('Y-m-d'),
				'peng_waktu'=>date('H:i:s'),
				'peng_status'=>$sq->peng_status,
				'peng_komentar'=>$sq->peng_komentar,
				'tapel_id'=>$q->tapel_id
			);
		
		}
		
		$this->db->insert($this->tbl,$data);
	}
	
	function add_dospem_ulang($mhsid){
		$this->db->select('*');
		$this->db->where('tapel_status',1);
		$res = $this->db->get($this->tbl5);
		foreach($res->result() as $tap){}
		
		$this->db->select('*');
		$this->db->where('mhs_id',$mhsid);
		$this->db->where('p1',1);
		$p1 = $this->db->get($this->tbl2);
		foreach($p1->result() as $sq1){}
		
		$this->db->select('*');
		$this->db->where('mhs_id',$mhsid);
		$this->db->where('p2',1);
		$p2 = $this->db->get($this->tbl2);
		foreach($p2->result() as $sq2){}
		
			$data = array(
						'dospem_id'=>null,
						'mhs_id'=>$mhsid,
						'pgw_id'=>$sq1->pgw_id,
						'p1'=>'1',
						'p2'=>'0',
						'tapel_id'=>$tap->tapel_id
						);
			$this->db->insert($this->tbl2,$data);
			
			$data2 = array(
						'dospem_id'=>null,
						'mhs_id'=>$mhsid,
						'pgw_id'=>$sq2->pgw_id,
						'p1'=>'0',
						'p2'=>'1',
						'tapel_id'=>$tap->tapel_id
						);
			$this->db->insert($this->tbl2,$data2);
	}
	/*END USER*/
	
	/*SIDANG*/
	function ceksidang($id){
	$this->db->select('tapel_id');
	$this->db->where('tapel_status',1);
	$que = $this->db->get($this->tbl5);
	foreach($que->result() as $q){}
	
		$this->db->select('mhs_id');
		$this->db->where('tapel_id',$q->tapel_id);
		$cek = $this->db->get($this->tbl3);
		
		if($cek->num_rows() <>0){
			$result=1;
		}else{
			$result=0;
		}
		
		return $result;
		
	}
	
	function updatenilaisidang(){
	#get kriteria nilai aktif
	$this->db->select('*');
	$this->db->where('status',1);
	$getkri = $this->db->get($this->tbl7);
	foreach($getkri->result() as $gk){ $krinilai = $gk->nilai; }
	
			$id 	= $this->input->post('mhs_id');
			$p1 	= $this->input->post('p1');
			$p2 	= $this->input->post('p2');
			$nilai	= $this->input->post('nilai');
			//$status	= $this->input->post('status');
			$status='REVISI';
		
		$nilai = ($p1+$p2)/2;
		
		if($nilai >= $krinilai){
			$status_sidang = 'LULUS';
		}else{
			$status_sidang = 'TIDAK LULUS';
		}
		
		$data = array(
			//'mhs_id'=>$id,
			'nilaiP1'=>$p1,
			'nilaiP2'=>$p2,
			'nilaiAkhir'=>$nilai,
			'sidang_status'=>$status_sidang,
			'sidang_revisi'=>$status,
			'aktifasi'=>'nonaktif'
		);
		$this->db->where('mhs_id',$id);
		$result = $this->db->update($this->tbl3,$data);
		
		if($result && $status_sidang=='LULUS'){
			$this->db->select('*');
			$this->db->from($this->tbl6);
			$this->db->where('mhs_id',$id);
			$cek = $this->db->get();
			
			foreach($cek->result() as $dash){
				$judul 		= $dash->judul;
				$proposal 	= $dash->proposal;
				$bab1		= $dash->bab1;
				$bab2		= $dash->bab2;
				$bab3		= $dash->bab3;
				$bab4		= $dash->bab4;
				$bab5		= $dash->bab5;
				$bab6		= $dash->bab6;
			}
		
			if($status=='REVISI'){
				$this->db->where('mhs_id',$id);
				$this->db->set('proposal','AKTIF');
				$this->db->update($this->tbl6);
			}else if($status=='ACC'){
				$this->db->where('mhs_id',$id);
				$this->db->set('bab1','AKTIF');
				$this->db->update($this->tbl6);			
			}
		}
	}
	
	function get_nilai_sidang($mhsid){
		$this->db->select('*');
		$this->db->from('sidang');
		$this->db->where('mhs_id',$mhsid);
		$sql = $this->db->get();
		
		return $sql;
	}
	
	function get_detail_sidang($mhsid){

		$this->db->select('*');
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=pengajuan.mhs_id');
		$this->db->join('tema','tema.tema_id=pengajuan.tema_id');
		//$this->db->where('pengajuan.mhs_id',$id);
		$this->db->where('pengajuan.mhs_id',$pengid);
		$sql = $this->db->get();
		
		return $sql;
	}
	
	function lihatnilaisidang($level){
		if($level=='10'){
			$jur = "1";
		}else if($level=='11'){
			$jur = "2";
		}else if($level=='12'){
			$jur = "3";
		}else if($level=='13'){
			$jur = "4";
		}
			$this->db->select('a.pgw_id, b.*, c.*, e.*, f.*, g.*');
			$this->db->from('dospem a');
			$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
			$this->db->join('sidang c', 'b.mhs_id = c.mhs_id');
			$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
			$this->db->join('tema f', 'e.tema_id = f.tema_id');
			$this->db->join('tapel g', 'c.tapel_id = g.tapel_id');
			$this->db->where('e.peng_status', 'DISETUJUI');
			$this->db->where('b.jur_id',$jur);
			$this->db->where('g.tapel_status',1);
			$this->db->group_by('a.mhs_id');
			$this->db->order_by('b.mhs_nim','asc');
			$query = $this->db->get();
			
			if($query->num_rows() <> 0){
				return $query->result_array();
			}else{
				return'';
			}
	}

	function rekapnilaisidang($level, $tpl){
		if($level=='10'){
			$jur = "1";
		}else if($level=='11'){
			$jur = "2";
		}else if($level=='12'){
			$jur = "3";
		}else if($level=='13'){
			$jur = "4";
		}
			$this->db->select('a.pgw_id, b.*, c.*, e.*, f.*, g.*');
			$this->db->from('dospem a');
			$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
			$this->db->join('sidang c', 'b.mhs_id = c.mhs_id');
			$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
			$this->db->join('tema f', 'e.tema_id = f.tema_id');
			$this->db->join('tapel g', 'c.tapel_id = g.tapel_id');
			$this->db->where('e.peng_status', 'DISETUJUI');
			$this->db->where('b.jur_id',$jur);
			$this->db->where('g.tapel_id',$tpl);
			$this->db->group_by('a.mhs_id');
			$this->db->order_by('b.mhs_nim','asc');
			$query = $this->db->get();
			
			if($query->num_rows() <> 0){
				return $query->result_array();
			}else{
				return'';
			}
	}
	
	function rekapnilaisidangdospem($pgwid){
			$this->db->select('a.pgw_id, b.*, c.*, e.*, f.*, g.*');
			$this->db->from('dospem a');
			$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
			$this->db->join('sidang c', 'b.mhs_id = c.mhs_id');
			$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
			$this->db->join('tema f', 'e.tema_id = f.tema_id');
			$this->db->join('tapel g', 'c.tapel_id = g.tapel_id');
			$this->db->where('e.peng_status', 'DISETUJUI');
			$this->db->where('a.pgw_id', $pgwid);
			$this->db->where('g.tapel_status','0');
			$this->db->group_by('a.mhs_id');
			$this->db->order_by('b.mhs_nim','asc');
			$query = $this->db->get();
			
			if($query->num_rows() <> 0){
				return $query->result_array();
			}else{
				return'';
			}
	}
	
	function katnilai(){
		$this->db->select('*');
		$query = $this->db->get($this->tbl7);
		
		return $query;
	}
	
	function addkatnilai($kri, $nilai, $status){
		$data = array(
						'id_kat_nilai' => null,
						'kriteria'	   => $kri,
						'nilai'		   => $nilai,
						'status'	   => $status
					);
		$this->db->insert($this->tbl7, $data);
	}
	
	function getkatnilai($id){
		$this->db->select('*');
		$this->db->where('id_kat_nilai', $id);
		$query = $this->db->get($this->tbl7);
		
		return $query;
	}
	
	function updatekatnilai($id, $kri, $nilai, $status){
		$data = array(
						'id_kat_nilai' => $id,
						'kriteria'	   => $kri,
						'nilai'		   => $nilai,
						'status'	   => $status
					);
					
		$this->db->where('id_kat_nilai', $id);			
		$this->db->update($this->tbl7, $data);
	}
	
	function cekfungsiaktif($id){
		$this->db->select('status');
		$this->db->where('id_kat_nilai',$id);
		$sql = $this->db->get($this->tbl7);
		
		foreach($sql->result() as $s){
		$stat = $s->status; 
			if( $stat == '1'){
				return '1';
			}else{
				return '';
			}
		}
	}
	
	function updateaktif($id, $status){
		$this->db->set('status',$status);
		$this->db->where('id_kat_nilai',$id);
		$this->db->update($this->tbl7);
		
		/*if($status=='0'){
			$this->db->select('*');
			$this->db->where('id_kat_nilai',$id);
			$getta = $this->db->get($this->tbl7);
			
			foreach($getta->result() as $m){ 
				$id = $m->id_kat_nilai;
				$status = '0';
				
				$this->activekriteria($id, $status);
			}
		}*/
	}
	
	function cekaktifasi(){
		$this->db->select('*');
		$this->db->where('status',1);
		$sql = $this->db->get($this->tbl7);
		
		if($sql->num_rows() <>0){
			return '1';
		}else{
			return '';
		}
	}
	
	function addrevisisidang($mhsid, $topik){
		$this->db->select('*');
		$this->db->where('tapel_status',1);
		$sql = $this->db->get($this->tbl5);
		
		foreach($sql->result() as $s){ 
		$tapid = $s->tapel_id;
		
			if (is_array($topik)) {
				foreach ($topik as $tpk => $k) {
				  $data = array(
								'topik_id' 		=> null,
								'topik_isi'		=> $k,
								'mhs_id'   		=> $mhsid,
								'topik_status'	=> '0',
								'tapel_id'		=> $tapid
								);
				$this->db->insert($this->tbl8, $data);
				}
			} else {
				echo "That is not array";
			}
		}
	}
	
	function clear_topik($mhsid){
	$this->db->select('*');
		$this->db->where('tapel_status',1);
		$sql = $this->db->get($this->tbl5);
		
		foreach($sql->result() as $s){ 
		$tapid = $s->tapel_id;
		
			$this->db->where('mhs_id',$mhsid);
			$this->db->where('tapel_id',$tapid);
			$this->db->delete($this->tbl8);
		}
	}
	
	function get_topik_sidang($mhsid){
	$this->db->select('*');
		$this->db->where('tapel_status',1);
		$sql = $this->db->get($this->tbl5);
		
		foreach($sql->result() as $s){ 
		$tapid = $s->tapel_id;

			$this->db->select('*');
			$this->db->where('mhs_id',$mhsid);
			$this->db->where('tapel_id',$tapid);
			$sql = $this->db->get($this->tbl8);
			
			return $sql;
		}
	}

	/*END SIDANG*/
}