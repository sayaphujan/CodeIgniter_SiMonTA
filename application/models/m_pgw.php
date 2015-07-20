<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_pgw extends CI_Model{

	protected $tbl = 'pegawai';
	protected $tbl2 = 'akademik';
	protected $tbl3 = 'dospem';
	protected $tbl4 = 'leveldosen';
	protected $tbl5 = 'bimbingan';
	protected $tbl6 = 'alihbimbingan';
	protected $tbl7 = 'laporan';
	protected $tbl8 = 'bagidosen';
	protected $tbl9 = 'tapel';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	/* PEGAWAI */
	function get_all_pgw(){
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('pgw_id !=',0);
		$query = $this->db->get();
		
		return $query;
	}

	function get_all_pgwnull(){
		$this->db->select('*');
		$this->db->from('pegawai');
		$query = $this->db->get();
		
		return $query;
	}	
	
	function cek_nip($nip){
		$this->db->select('pgw_nip');
		$this->db->where('pgw_nip',$nip);
		$sql = $this->db->get($this->tbl);
		
		if($sql->num_rows() ==0){
			$cek=0;
		}else{
			$cek=1;
		}
		
		return $cek;
		
	}
	
	
	function cek_user($user){
		$this->db->select('pgw_username');
		$this->db->where('pgw_username',$user);
		$sql = $this->db->get($this->tbl);
		
		if($sql->num_rows() ==0){
			$cek=0;
		}else{
			$cek=1;
		}
		
		return $cek;
		
	}
	
	function cek_level($level){
	if($level ==10 || $level ==11 || $level ==12 || $level ==13){
		$this->db->select('level_id');
		$this->db->where('level_id',$level);
		$sql = $this->db->get($this->tbl);
		
		if($sql->num_rows() ==0){
			$cek=0;
		}else{
			$cek=1;
		}
	}else{
		$cek = 0;
	}
		
		return $cek;
		
	}
	
	function add($foto){
	
		$num		= ".";
		$n1			= $this->input->post('n1');
		$n2			= $this->input->post('n2');
		$n3			= $this->input->post('n3');
		$nip 		= $n1.$num.$n2.$num.$n3;
		$nama		= $this->input->post('nama');
		$username	= $this->input->post('username');
		$password	= md5($this->input->post('pass'));
		$level		= $this->input->post('jabatan');
		$status		='AKTIF';
		
			if (!empty($foto)) {
				$gambar	=	$foto;
			} else {
			    // No file selected - set default image
			    $gambar='anonim.png';
			}

		$data = array(
				'pgw_id' 		=> null,
				'pgw_nip'		=> $nip,
				'pgw_nama'		=> $nama,
				'pgw_username'	=> $username,
				'pgw_pass'		=> $password,
				'pgw_status'	=> $status,
				'pgw_foto'		=> $gambar,
				'level_id'		=> $level
				
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('leveluser', 'leveluser.level_id = pegawai.level_id');
		$this->db->where('pgw_id',$id);
		$q=$this->db->get('');
		return $q;
	}

	function update(){
		$id			= $this->input->post('pgw_id');
		
		$num		= ".";
		$n1			= $this->input->post('n1');
		$n2			= $this->input->post('n2');
		$n3			= $this->input->post('n3');
		$nip 		= $n1.$num.$n2.$num.$n3;
		$nama		= $this->input->post('nama');
		$username	= $this->input->post('username');
		$password	= md5($this->input->post('pass'));
		$level		= $this->input->post('jabatan');
		
		$data = array(
				'pgw_id' 		=> $id,
				'pgw_nip'		=> $nip,
				'pgw_nama'		=> $nama,
				'pgw_username'	=> $username,
				'pgw_pass'		=> $password,
				'pgw_foto'		=> $gambar,
				'level_id'		=> $level
		);

		$this->db->where('pgw_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function update_pass(){

		$id				= $this->session->userdata('userid');
		$password		= md5($this->input->post('pass2'));

		$data = array(
				'pgw_id' 		=> $id,
				'pgw_pass'		=> $password
			);

		$this->db->where('pgw_id',$id);
		$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('pgw_id'=>$id));
		return;
	}
	/* END PEGAWAI*/
	
	/* PEMBIMBING AKADEMIK*/
	function get_all_pa(){
		$this->db->select('*');
		$this->db->from('akademik');
		$this->db->join('pegawai','pegawai.pgw_id=akademik.pgw_id');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=akademik.mhs_id');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id');
		$this->db->order_by('pegawai.pgw_nama','asc');
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_pa_prodi($level){
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
		$this->db->from('akademik');
		$this->db->join('pegawai','pegawai.pgw_id=akademik.pgw_id');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=akademik.mhs_id');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id');
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->order_by('pegawai.pgw_nama','asc');
		$query = $this->db->get();
		
		return $query;
	}
	
	function add_pa(){
		$mahasiswa = $this->input->post('mahasiswa');
		$pgw = $this->input->post('dosen');
		foreach($this->input->post('mahasiswa') as $mhs) {
			$data = array(
				'pgw_id' => $pgw,
				'mhs_id' => $mhs
			);
			$this->db->insert($this->tbl2,$data);
		}
		
	}
	
	function get_data_akad($id){

		$this->db->select('*');
		$this->db->from('akademik');
		$this->db->join('pegawai', 'pegawai.pgw_id = akademik.pgw_id');
		$this->db->join('mahasiswa', 'mahasiswa.mhs_id = akademik.mhs_id');
		$this->db->join('konsentrasi', 'mahasiswa.kon_id = konsentrasi.kon_id');
		$this->db->where('akad_id',$id);
		$q=$this->db->get('');
		return $q;
	}
	
	function update_pa(){

		$id				= $this->input->post('akad_id');
		$dosen			= $this->input->post('dosen');
		$mhs			= $this->input->post('mhs');

		$data = array(
				'akad_id' 		=> $id,
				'pgw_id'		=> $dosen,
				'mhs_id'		=> $mhs
			);

		$this->db->where('akad_id',$id);
		$this->db->update($this->tbl2,$data);
	}
	
	function delete_pa($id){
	
		$this->db->delete($this->tbl2,array('akad_id'=>$id));
		return;
	}
	/* END PEMBIMBING AKADEMIK */
	
	/* PEMBIMBING TA*/
	function get_all_dospem($level){
	
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$tapid = $this->db->get('tapel');
	foreach($tapid->result() as $tap){ $id = $tap->tapel_id;}
	if($level=='10'){
			$jur = "1";
		}else if($level=='11'){
			$jur = "2";
		}else if($level=='12'){
			$jur = "3";
		}else if($level=='13'){
			$jur = "4";
		}
		
		$this->db->select('a.*, b.*, c.*, GROUP_CONCAT(d.pgw_nama ORDER BY a.dospem_id) as pegawai');
		$this->db->from('dospem a');
		$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
		$this->db->join('jurusan c', 'b.jur_id = c.jur_id');
		$this->db->join('pegawai d', 'a.pgw_id = d.pgw_id');
		//$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
		//$this->db->join('tema f', 'e.tema_id = f.tema_id');
		//$this->db->join('tapel g', 'a.tapel_id = g.tapel_id');
		//$this->db->where('e.peng_status', 'DISETUJUI');
		$this->db->where('b.jur_id', $jur);
		$this->db->where('a.tapel_id', $id);
		//$this->db->group_by('e.peng_id');
		$this->db->group_by('a.mhs_id');
		$this->db->order_by('b.mhs_nim','asc');
		//$this->db->order_by('e.peng_id','desc');
		//$this->db->limit('1');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_all_dospem_id($level){
	if($level=='10'){
			$jur = "1";
		}else if($level=='11'){
			$jur = "2";
		}else if($level=='12'){
			$jur = "3";
		}else if($level=='13'){
			$jur = "4";
		}
		
		$this->db->select('a.*, b.*, c.*, e.*, f.*, g.*, GROUP_CONCAT(d.pgw_id ORDER BY a.dospem_id) as pegawai, GROUP_CONCAT(a.dospem_id ORDER BY a.dospem_id) as dosid');
		$this->db->from('dospem a');
		$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
		$this->db->join('jurusan c', 'b.jur_id = c.jur_id');
		$this->db->join('pegawai d', 'a.pgw_id = d.pgw_id');
		$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
		$this->db->join('tema f', 'e.tema_id = f.tema_id');
		$this->db->join('tapel g', 'a.tapel_id = g.tapel_id');
		$this->db->where('e.peng_status', 'DISETUJUI');
		$this->db->where('b.jur_id', $jur);
		$this->db->where('g.tapel_status', 1);
		$this->db->group_by('a.mhs_id');
		$this->db->order_by('b.mhs_nim','asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function rekap_all_dospem($level, $tpl){
	if($level=='10'){
			$jur = "1";
		}else if($level=='11'){
			$jur = "2";
		}else if($level=='12'){
			$jur = "3";
		}else if($level=='13'){
			$jur = "4";
		}
		
		$this->db->select('a.mhs_id, b.*, c.*, g.*,  GROUP_CONCAT(d.pgw_nama ORDER BY a.dospem_id) as pegawai');
		$this->db->from('dospem a');
		$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
		$this->db->join('jurusan c', 'b.jur_id = c.jur_id');
		$this->db->join('pegawai d', 'a.pgw_id = d.pgw_id');
		//$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
		//$this->db->join('tema f', 'e.tema_id = f.tema_id');
		$this->db->join('tapel g', 'a.tapel_id = g.tapel_id');
		//$this->db->where('e.peng_status', 'DISETUJUI');
		$this->db->where('b.jur_id', $jur);
		$this->db->where('a.tapel_id', $tpl);
		//$this->db->group_by('e.peng_id');
		$this->db->group_by('a.mhs_id');
		$this->db->order_by('b.mhs_nim','asc');
		//$this->db->order_by('e.peng_id','desc');
		//$this->db->limit('1');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_mhs_bim($id){
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$tapid = $this->db->get('tapel');
	
	if($tapid->num_rows() <> 0){
		foreach($tapid->result() as $tap){ $tapid = $tap->tapel_id;}
	
			$this->db->select('a.*, b.*, d.*, GROUP_CONCAT(d.pgw_nama ORDER BY a.dospem_id) as pegawai');
			$this->db->from('dospem a');
			$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
			$this->db->join('pegawai d', 'a.pgw_id = d.pgw_id');
			$this->db->where('a.pgw_id',$id);
			$this->db->where('a.tapel_id',$tapid);
			$this->db->group_by('a.mhs_id');
			$this->db->order_by('b.mhs_nim','asc');
			$query = $this->db->get();
			return $query->result_array();
			
	}else{
		return '';
	}
	}
	
	function get_mhs_sidang($id, $tapid){
			$this->db->select('*');
			$this->db->from('dospem a');
			$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
			$this->db->join('sidang c', 'b.mhs_id = c.mhs_id');
			$this->db->where('a.pgw_id',$id);
			$this->db->where('a.p1',1);
			$this->db->where('a.tapel_id',$tapid);
			$this->db->group_by('b.mhs_id');
			$this->db->order_by('b.mhs_nim','asc');
			$query = $this->db->get();
			
			if($query->num_rows() <> 0){
				return $query->result_array();
			}else{
				return '';
			}
	}
	/* HAVING */
	/*function get_mhs_sidang($id){
			$this->db->select('a.*, b.*, e.*, f.*, GROUP_CONCAT(d.pgw_nama ORDER BY a.dospem_id) as pegawai');
			$this->db->from('dospem a');
			$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
			$this->db->join('sidang c', 'b.mhs_id = c.mhs_id');
			$this->db->join('pegawai d', 'a.pgw_id = d.pgw_id');
			$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
			$this->db->join('tema f', 'e.tema_id = f.tema_id');
			$this->db->where('e.peng_status', 'DISETUJUI');
			$this->db->having('a.pgw_id',$id);
			$this->db->group_by('a.mhs_id');
			$this->db->order_by('b.mhs_nim','asc');
			$query = $this->db->get();
			return $query->result_array();
	}*/
	/* WHERE
	function get_mhs_sidang($id){
		$this->db->select('*');
		$this->db->from('sidang a');
		$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
		$this->db->join('dospem c', 'b.mhs_id = c.mhs_id');
		$this->db->join('pegawai d', 'c.pgw_id = d.pgw_id');
		$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
		$this->db->join('tema f', 'e.tema_id = f.tema_id');
		$this->db->where('c.pgw_id',$id);
		$this->db->where('e.peng_status', 'DISETUJUI');
		$this->db->order_by('b.mhs_nim','asc');
		$query = $this->db->get();
		
		return $query->result_array();
	}*/
	
	public function count_dos()
	{
		$this->db->select('COUNT(*) countrow');
		$this->db->group_by('mhs_id');
		$this->db->order_by('count(*)', 'desc');
		$query = $this->db->get('dospem');
		return $query->row_array();
	}

	function get_dospem_id($id){
		$this->db->select('pgw_id');
		$this->db->where('pgw_id',$id);
		$this->db->where('p1',1);
		$query = $this->db->get($this->tbl3);
		
		foreach($query->result() as $que){
			$pgwid = $que->pgw_id; 
		}
		return $pgwid;
	}
	
	function get_dospem($id){
	/*SELECT a.*, b.*, c.*, d.*, e.*, GROUP_CONCAT(c.pgw_id ORDER BY a.dospem_id)as pegawai from dospem a, pengajuan b, pegawai c, mahasiswa d, tema e
	where a.peng_id=b.peng_id AND a.pgw_id=c.pgw_id AND b.mhs_id=d.mhs_id AND b.tema_id=e.tema_id AND a.peng_id=1 group by a.peng_id order by d.mhs_nim asc*/
		$id=$this->uri->segment(4);
		$this->db->select('a.*, b.*, c.*, GROUP_CONCAT(c.pgw_id ORDER BY a.dospem_id) as pegawai');
		$this->db->from('dospem a');
		$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
		$this->db->join('pegawai c', 'a.pgw_id = c.pgw_id');
		$this->db->where('b.mhs_id', $id);
		$this->db->group_by('a.dospem_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_dospem1($id){
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$gettap = $this->db->get($this->tbl9);
	foreach($gettap->result() as $tap){
	$tapid = $tap->tapel_id;
	
		$this->db->select('*');
		$this->db->where('mhs_id',$id);
		$this->db->where('p1',1);
		$this->db->where('tapel_id',$tapid);
		$que = $this->db->get($this->tbl3);
		return $que;
	}
	}
	
	function get_dospem2($id){
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$gettap = $this->db->get($this->tbl9);
	foreach($gettap->result() as $tap){
	$tapid = $tap->tapel_id;
		$this->db->select('*');
		$this->db->where('mhs_id',$id);
		$this->db->where('p2',1);
		$this->db->where('tapel_id',$tapid);
		$que = $this->db->get($this->tbl3);
		return $que;
	}
	}
	
	function cek_doss(){
		$ids 	= $this->input->post('dospem_satu');
		$mhss 	= $this->input->post('mhs_satu');
		$pgws 	= $this->input->post('dosensatu');
	
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$gettap = $this->db->get($this->tbl9);
	foreach($gettap->result() as $tap){
	$tapid = $tap->tapel_id;
	
		/*cek dospem p1*/
		$this->db->select('pgw_id');
		$this->db->where('mhs_id',$mhss);
		$this->db->where('p1',1);
		$this->db->where('tapel_id',$tapid);
		$psatu = $this->db->get($this->tbl3);
		foreach($psatu->result() as $s){
		/* dosen p1 lama >>*/$p1 = $s->pgw_id;
		}
			if($p1==$pgws){
				return '';
			}else{
			/* update tb dospem*/
				$this->db->set('pgw_id',$pgws);
				$this->db->where('mhs_id',$mhss);
				$this->db->where('p1',1);
				$this->db->where('tapel_id',$tapid);
				$this->db->update($this->tbl3);
				
			/* get lap_id */
				$this->db->select('lap_id');
				$this->db->where('mhs_id',$mhss);
				$this->db->where('tapel_id',$tapid);
				$lap = $this->db->get($this->tbl7);
				foreach($lap->result() as $l){
				$lapid = $l->lap_id;
					$this->db->select('*');
					$this->db->from('bimbingan');
					$this->db->join('laporan','laporan.lap_id=bimbingan.lap_id');
					$this->db->where('bimbingan.lap_id',$lapid);
					$this->db->where('pgw_id',$p1);
					$this->db->where('tapel_id',$tapid);
					$bim = $this->db->get();	
					foreach($bim->result() as $b){
						$id		= $b->bim_id;
						$lap 	= $b->lap_id;
						$pgw	= $b->pgw_id;
						$file	= $b->bimb_file;
						$kom	= $b->bimb_komentar;
						$tgl	= $b->bimb_tgl;
						$wak	= $b->bimb_waktu;
						$stat	= $b->bimb_status;
						$tapel	= $b->tapel_id;
						$data = array(
									'mhs_id'=>$mhss,
									'lap_id'=>$lap,
									'pgw_id'=>$p1,
									'bimb_file'=>$file,
									'bimb_komentar'=>$kom,
									'bimb_tgl'=>$tgl,
									'bimb_waktu'=>$wak,
									'bimb_status'=>$stat,
									'tapel_id'=>$tapel,
									'dos_status'=>'DOSEN P1'
									);
						$this->db->insert($this->tbl6,$data);
					}
				}
					return '1';
			}
		}
	}
	
	function cek_dosd(){
		$idd 	= $this->input->post('dospem_dua');
		$mhsd 	= $this->input->post('mhs_dua');
		$pgwd 	= $this->input->post('dosendua');
	
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$gettap = $this->db->get($this->tbl9);
	foreach($gettap->result() as $tap){
	$tapid = $tap->tapel_id;
		/*cek dospem p2*/
		$this->db->select('pgw_id', $pgwd);
		$this->db->where('mhs_id',$mhsd);
		$this->db->where('p2',1);
		$this->db->where('tapel_id',$tapid);
		$pdua = $this->db->get($this->tbl3);
		foreach($pdua->result() as $d){
		$p2 = $d->pgw_id;
			if($p2==$pgwd){
				return '';
			}else{
				$this->db->set('pgw_id', $pgwd);
				$this->db->where('mhs_id',$mhsd);
				$this->db->where('p2',1);
				$this->db->where('tapel_id',$tapid);
				$this->db->update($this->tbl3);
				
				$this->db->select('lap_id');
				$this->db->where('mhs_id',$mhsd);
				$this->db->where('tapel_id',$tapid);
				$lap = $this->db->get($this->tbl7);
				foreach($lap->result() as $l){
				$lapid = $l->lap_id;
					$this->db->select('*');
					$this->db->from('bimbingan');
					$this->db->join('laporan','laporan.lap_id=bimbingan.lap_id');
					$this->db->where('bimbingan.lap_id',$lapid);
					$this->db->where('pgw_id',$p2);
					$this->db->where('tapel_id',$tapid);
					$bim = $this->db->get();	
					foreach($bim->result() as $b){
						$id		= $b->bim_id;
						$lap 	= $b->lap_id;
						$pgw	= $b->pgw_id;
						$file	= $b->bimb_file;
						$kom	= $b->bimb_komentar;
						$tgl	= $b->bimb_tgl;
						$wak	= $b->bimb_waktu;
						$stat	= $b->bimb_status;
						$tapel	= $b->tapel_id;
					
				$data = array(
							'mhs_id'=>$mhsd,
							'lap_id'=>$lap,
							'pgw_id'=>$p2,
							'bimb_file'=>$file,
							'bimb_komentar'=>$kom,
							'bimb_tgl'=>$tgl,
							'bimb_waktu'=>$wak,
							'bimb_status'=>$stat,
							'tapel_id'=>$tapel,
							'dos_status'=>'DOSEN P2'
							);
				$this->db->insert($this->tbl6,$data);
				return '1';
				}
				}
			}
		}
		}
	}
	
	function change($level){
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
		$this->db->from('alihbimbingan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=alihbimbingan.mhs_id');
		$this->db->join('pegawai','pegawai.pgw_id=alihbimbingan.pgw_id');
		$this->db->join('pengajuan', 'pengajuan.mhs_id = mahasiswa.mhs_id');
		$this->db->join('tema', 'tema.tema_id = pengajuan.tema_id');
		$this->db->join('tapel', 'tapel.tapel_id = alihbimbingan.tapel_id');
		$this->db->where('pengajuan.peng_status', 'DISETUJUI');
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('tapel.tapel_status',1);
		$this->db->group_by('mahasiswa.mhs_id');
		$this->db->order_by('mahasiswa.mhs_nim');
		$que = $this->db->get();
		
		return $que->result_array();
	}
	
	function pengchange($mhsid, $tapelid){
		$this->db->select('*');
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=pengajuan.mhs_id');
		$this->db->join('tema', 'tema.tema_id = pengajuan.tema_id');
		$this->db->join('tapel', 'tapel.tapel_id = pengajuan.tapel_id');
		$this->db->where('pengajuan.peng_status','DISETUJUI');
		$this->db->where('pengajuan.mhs_id', $mhsid);
		$this->db->where('pengajuan.tapel_id', $tapelid);
		$qu = $this->db->get();
		return $qu->result_array();
	}
	
	function detail_change($level, $mhsid, $pgwid, $tapelid){
		$this->db->select('*');
		$this->db->from('alihbimbingan');
		$this->db->join('tapel', 'tapel.tapel_id = alihbimbingan.tapel_id');
		$this->db->join('laporan','laporan.lap_id = alihbimbingan.lap_id');
		$this->db->join('kategori_laporan','kategori_laporan.kat_lap_id = laporan.kat_lap_id');
		$this->db->where('alihbimbingan.mhs_id',$mhsid);
		$this->db->where('alihbimbingan.pgw_id',$pgwid);
		$this->db->where('alihbimbingan.tapel_id',$tapelid);
		$query = $this->db->get();
		
		return $query;
	}
	
	function changerekap($level, $tpl){
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
		$this->db->from('alihbimbingan');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=alihbimbingan.mhs_id');
		$this->db->join('pegawai','pegawai.pgw_id=alihbimbingan.pgw_id');
		$this->db->join('pengajuan', 'pengajuan.mhs_id = mahasiswa.mhs_id');
		$this->db->join('tema', 'tema.tema_id = pengajuan.tema_id');
		$this->db->join('tapel', 'tapel.tapel_id = alihbimbingan.tapel_id');
		$this->db->where('pengajuan.peng_status', 'DISETUJUI');
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('tapel.tapel_id',$tpl);
		$this->db->group_by('mahasiswa.mhs_id');
		$this->db->order_by('mahasiswa.mhs_nim');
		$que = $this->db->get();
		
		return $que->result_array();
	}
	
	function edit_dospem(){
		$id  = $this->input->post('dospem_id');
		$dos = $this->input->post('dosen');

		foreach (array_combine($id, $dos) as $dp => $pgw){
		if($pgw % 2 == 0){
			$p1 = '1';
			$p2 = '0';
		}else if($pgw % 2 == 1){
			$p1 = '0';
			$p2 = '1';
		}
			$data = array(
				'pgw_id' 	=> $pgw,
				'p1'		=> $p1,
				'p2'		=> $p2
			);
				$this->db->where('dospem_id',$dp);
				$this->db->update($this->tbl3,$data);
					
				$this->add_level_dospem($pgw);
		}
	}
	
	function add_level_dospem($pgw){
		$this->db->select('pgw_id');
		$this->db->where('pgw_id',$pgw);
		$this->db->where('level_id',4);
		$cek = $this->db->get($this->tbl4);
		
		if($cek->num_rows() ==0){
			$data = array(
				'leveldos_id' 	=> null,
				'pgw_id'		=> $pgw,
				'level_id'		=> 4
			);
				$this->db->insert($this->tbl4,$data);
		}
	}
	
	function del_dospem($id){
	
		$this->db->delete($this->tbl3,array('peng_id'=>$id));
		return;
	}
	/* END PEMBIMBING TA */
	
	function addlevel(){

		$id				= $this->input->post('dosen');
		$level			= $this->input->post('level');

		$data = array(
				'leveldos_id'	=> null,
				'pgw_id' 		=> $id,
				'level_id'		=> $level
			);

		$this->db->insert($this->tbl4,$data);
	}

	function add_level_pgw(){
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('pgw_id !=',0);
		$this->db->where('pgw_id NOT IN (select pgw_id from leveldosen)',NULL, FALSE );
		$query = $this->db->get();
		
		return $query;
	}
	
	/*BAGI DOSEN*/
	function bagi(){
		$this->db->select('*');
		$this->db->from('bagidosen');
		$this->db->join('pegawai','bagidosen.pgw_id=pegawai.pgw_id');
		$s = $this->db->get();
		
		return $s;
	}
	
	function get_bagi($id){
		$this->db->select('*');
		$this->db->from('bagidosen');
		$this->db->where('bagi_id',$id);
		$s = $this->db->get();
		
		return $s;
	}
	
	function add_bagi($dosen, $satu, $dua){
		$data = array(
				'bagi_id'	=> null,
				'pgw_id' 	=> $dosen,
				'p1'		=> $satu,
				'p2'		=> $dua
			);

		$this->db->insert($this->tbl8,$data);
	}
	
	function update_bagi($id, $dosen, $satu, $dua){
		$data = array(
				'bagi_id' 	=> $id,
				'pgw_id' 	=> $dosen,
				'p1'		=> $satu,
				'p2'		=> $dua
			);

		$this->db->where('bagi_id',$id);
		$this->db->update($this->tbl8,$data);
	}
	
	function get_all_dospem1(){
		$this->db->select('*');
		$this->db->from('bagidosen');
		$this->db->join('pegawai','bagidosen.pgw_id=pegawai.pgw_id');
		$this->db->where('p1','Y');
		$this->db->where('bagidosen.pgw_id !=',0);
		$s = $this->db->get();
		
		return $s;
	}
	
	function get_all_dospem2(){
		$this->db->select('*');
		$this->db->from('bagidosen');
		$this->db->join('pegawai','bagidosen.pgw_id=pegawai.pgw_id');
		$this->db->where('p2','Y');
		$this->db->where('bagidosen.pgw_id !=',0);
		$s = $this->db->get();
		
		return $s;
	}

	function get_rekap_mhs_bim($id){
			$this->db->select('a.*, b.*, d.*, e.*, f.*, g.*, GROUP_CONCAT(d.pgw_nama ORDER BY a.dospem_id) as pegawai');
			$this->db->from('dospem a');
			$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
			$this->db->join('pegawai d', 'a.pgw_id = d.pgw_id');
			$this->db->join('pengajuan e', 'b.mhs_id = e.mhs_id');
			$this->db->join('tema f', 'e.tema_id = f.tema_id');
			$this->db->join('tapel g', 'a.tapel_id = g.tapel_id');
			$this->db->where('e.peng_status', 'DISETUJUI');
			$this->db->where('a.pgw_id',$id);
			$this->db->where('g.tapel_status',0);
			$this->db->group_by('a.mhs_id');
			$this->db->order_by('b.mhs_nim','asc');
			$query = $this->db->get();
			//return $query->result_array();
			
			if($query->num_rows() <> 0){
				return $query->result_array();
			}else{
				return'';
			}
	}
}
