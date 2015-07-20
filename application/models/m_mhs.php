<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_mhs extends CI_Model{

	protected $tbl = 'mahasiswa';
	protected $tbl2 = 'dashboard_oto';
	protected $tbl3 = 'pesan_dos';
	protected $tbl4 = 'mhs_akhir';
	protected $tbl5 = 'tapel';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}
	
	function get_mhs_akhir($level){
	
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
		$this->db->from('mhs_akhir');
		$this->db->join('tapel','mhs_akhir.tapel_id=tapel.tapel_id');
		$this->db->join('mahasiswa','mhs_akhir.mhs_id=mahasiswa.mhs_id');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id');
		$this->db->where('tapel.tapel_status',1);
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('mahasiswa.mhs_id IN (select mhs_id from mhs_akhir)',NULL, FALSE );
		$this->db->group_by('mhs_akhir.mhs_id');
		$query= $this->db->get();
		
		return $query;
	}
	
	function get_mhs_prodi($level){
	
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
		$this->db->from('mhs_akhir');
		$this->db->join('tapel','mhs_akhir.tapel_id=tapel.tapel_id');
		$this->db->join('mahasiswa','mhs_akhir.mhs_id=mahasiswa.mhs_id');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id');
		$this->db->join('pengajuan','pengajuan.mhs_id=mahasiswa.mhs_id');
		$this->db->where('tapel.tapel_status',1);
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('mahasiswa.mhs_id IN (select mhs_id from pengajuan)',NULL, FALSE );
		$this->db->group_by('pengajuan.mhs_id');
		$query= $this->db->get();
		
		return $query;
	}
	
	function rekap_pengajuan($level, $id){
	
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
		$this->db->from('mhs_akhir');
		$this->db->join('tapel','mhs_akhir.tapel_id=tapel.tapel_id');
		$this->db->join('mahasiswa','mhs_akhir.mhs_id=mahasiswa.mhs_id');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id');
		$this->db->join('pengajuan','pengajuan.mhs_id=mahasiswa.mhs_id');
		//$this->db->where('',$id);
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('mahasiswa.mhs_id IN (select mhs_id from pengajuan where tapel.tapel_id='.$id.')',NULL, FALSE );
		$this->db->group_by('pengajuan.mhs_id');
		$query= $this->db->get();
		
		return $query;
	}
	
	function act_dashboard($id){
	
		$id = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->from('dashboard_oto');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=dashboard_oto.mhs_id');
		$this->db->where('mahasiswa.mhs_id',$id);
		$query= $this->db->get();
		
		return $query;
	}
	
	function all_mhs()
	{
		//$sql = $this->db->query("SELECT * FROM mahasiswa order by mhs_nim asc");
		//return $sql->result();
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->order_by('mhs_nim','asc');
		$query= $this->db->get();
		
		return $query;
	}
	
	function get_mhs($id){
		$id = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('jurusan', 'jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('konsentrasi', 'konsentrasi.kon_id=mahasiswa.kon_id');
		$this->db->join('leveluser', 'leveluser.level_id=mahasiswa.level_id');
		$this->db->where('mahasiswa.mhs_id',$id);
		$query= $this->db->get();
		
		return $query;
	}
	
	function get_last_nim($jur, $angk){
	
		$this->db->select("RIGHT(mhs_nim, 4) as nim",FALSE);
		$this->db->where('jur_id', $jur);
		$this->db->where('angkatan', $angk);
		$this->db->order_by('mhs_nim','desc');
		$this->db->limit('1');
		$query= $this->db->get('mahasiswa');
		
		if($query->num_rows() <> 0){
			$data = $query->row();
			$kode = intval($data->nim) + 1; // biar bentuknya integer
		}else{
			$kode = 1;
		}
		
		$kodemax  = str_pad($kode, 4, 0, STR_PAD_LEFT);
		//$kodejadi = substr($angk,2,2).'.'.$jur->jur_kode.'.'.$kodemax;

		return $kodemax;
	}

	function detail($jur, $kon, $angk){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		/*$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id');*/
		$this->db->where('jur_id',$jur);
		$this->db->where('kon_id',$kon);
		$this->db->where('angkatan',$angk);
		$query = $this->db->get();
		
		return $query;
	}
	
	function add($jur, $kon, $angk){

			$nim			=$this->input->post('nim',TRUE);
			$nama			=$this->input->post('nama',TRUE);
			$password		=md5($this->input->post('pass',TRUE));
			$jurusan		=$jur;
			$konsentrasi	=$kon;
			$angkatan		=$angk;
			$upload 		='userfile';
				
			$config['upload_path'] = "./assets/mahasiswa/";
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['file_name'] = $_FILES['userfile']['name'];
			$config['overwrite'] = false;						
			$this->load->library('upload');
			$this->upload->initialize($config);

			if (!empty($_FILES['userfile']['name'])) {
				$gambar	=	$_FILES['userfile']['name'];
			} else {
			    // No file selected - set default image
			    $gambar='anonim.png';
			}
				$data = array(
					'mhs_id' 		=> null,
					'mhs_nim'		=> $nim,
					'mhs_nama'		=> $nama,
					'mhs_pass'		=> $password,
					'jur_id'		=> $jurusan,
					'kon_id'		=> $konsentrasi,
					'mhs_foto'		=> $gambar,
					'angkatan'		=> $angkatan
				);

				$this->db->insert($this->tbl,$data);
				$this->input_dashboard();
		}
		
		function input_dashboard(){
			$this->db->select('*');
			$this->db->from('mahasiswa');
			$this->db->order_by('mhs_id','desc');
			$this->db->limit('1');
			$query= $this->db->get();
			
				foreach ($query->result() as $row){ $mhsid = $row->mhs_id; }				
				$data = array(
								'dash_id' 		=> null,
								'mhs_id'		=> $mhsid,
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
						$this->db->insert($this->tbl2,$data);
		}

	function get_data($jur, $kon, $angk, $id){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('jurusan','jurusan.jur_id=mahasiswa.jur_id');
		$this->db->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id');
		$this->db->where('jurusan.jur_id',$jur);
		$this->db->where('konsentrasi.kon_id',$kon);
		$this->db->where('mahasiswa.angkatan',$angk);
		$this->db->where('mahasiswa.mhs_id',$id);
		$query = $this->db->get();
		
		return $query;
	}

	function update($jur, $kon, $angk){
			$id				=$this->input->post('mhs_id');
			$nim			=$this->input->post('nim',TRUE);
			$nama			=$this->input->post('nama',TRUE);
			$password		=md5($this->input->post('pass',TRUE));
			$jurusan		=$jur;
			$konsentrasi	=$kon;
			$angkatan		=$angk;
			$upload 		='userfile';
			//$gambar			=$_FILES['userfile']['name'];
				
			$config['upload_path'] = "./assets/mahasiswa/";
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['file_name'] = $_FILES['userfile']['name'];
			$config['overwrite'] = false;						
			$this->load->library('upload',$config);
			//$this->upload->initialize($config);

				if (!empty($_FILES['userfile']['name'])) {
				$data = array(
					'mhs_id' 		=> $id,
					'mhs_nim'		=> $nim,
					'mhs_nama'		=> $nama,
					'mhs_pass'		=> $password,
					'jur_id'		=> $jurusan,
					'kon_id'		=> $konsentrasi,
					'mhs_foto'		=> $_FILES['userfile']['name']
				);
			  }
			  else
				{
					$data = array(
						'mhs_id' 		=> $id,
						'mhs_nim'		=> $nim,
						'mhs_nama'		=> $nama,
						'mhs_pass'		=> $password,
						'jur_id'		=> $jurusan,
						'kon_id'		=> $konsentrasi
					);	
				}

				$this->db->where('mhs_id',$id);
				$this->db->update($this->tbl,$data);
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('mhs_id'=>$id));
		return;
	}
	
	function detail_pa($jur, $kon, $angk){
	
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->where('jur_id',$jur);
		$this->db->where('kon_id',$kon);
		$this->db->where('angkatan',$angk);
		$this->db->where('mhs_id NOT IN (select mhs_id from akademik)',NULL, FALSE );
		$query = $this->db->get();
		
		return $query;
	}
	
	function update_pass(){

		$id				= $this->session->userdata('userid');
		$password		= md5($this->input->post('pass2'));

		$data = array(
				'mhs_id' 		=> $id,
				'mhs_pass'		=> $password
			);

		$this->db->where('mhs_id',$id);
		$this->db->update($this->tbl,$data);
	}

	function get_dospem($mhsid, $pengid){
	$this->db->select('tapel_id');
	$this->db->where('peng_id',$pengid);
	$tapid = $this->db->get('pengajuan');
	foreach($tapid->result() as $tap){ $id = $tap->tapel_id;
	
		$this->db->select('a.*, b.*, c.*, d.*, GROUP_CONCAT(c.pgw_nama ORDER BY a.dospem_id) as pegawai');
		$this->db->from('dospem a');
		$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
		$this->db->join('pegawai c', 'a.pgw_id = c.pgw_id');
		$this->db->join('pengajuan d', 'b.mhs_id = d.mhs_id');
		$this->db->where('b.mhs_id', $mhsid);
		$this->db->where('d.peng_id', $pengid);
		$this->db->where('a.tapel_id', $id);
		$this->db->group_by('a.mhs_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	}
	
	function get_dospem_rekap($id, $tpl){
	/*SELECT a.*, b.*, c.*, d.*, e.*, GROUP_CONCAT(c.pgw_id ORDER BY a.dospem_id)as pegawai from dospem a, pengajuan b, pegawai c, mahasiswa d, tema e
	where a.peng_id=b.peng_id AND a.pgw_id=c.pgw_id AND b.mhs_id=d.mhs_id AND b.tema_id=e.tema_id AND a.peng_id=1 group by a.peng_id order by d.mhs_nim asc*/
		$this->db->select('a.*, b.*, c.*, d.*, e.*, GROUP_CONCAT(c.pgw_nama ORDER BY a.dospem_id) as pegawai');
		$this->db->from('dospem a');
		$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
		$this->db->join('pegawai c', 'a.pgw_id = c.pgw_id');
		$this->db->join('tapel d', 'a.tapel_id = d.tapel_id');
		$this->db->join('pengajuan e', 'e.mhs_id = b.mhs_id');
		$this->db->where('b.mhs_id', $id);
		$this->db->where('e.peng_status', 'DISETUJUI');
		$this->db->where('d.tapel_id', $tpl);
		$this->db->group_by('e.peng_judul');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/*PESAN MHS*/
	function cek($id){
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from(' pesan_dos');
		$this->db->where('mhs_id',$id);
		$this->db->where('pesan_status',0);
		$this->db->where('pesan_dos.kat_lap_id !=',3);
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
		$this->db->from('pesan_dos');
		$this->db->join('pegawai','pesan_dos.pgw_id=pegawai.pgw_id');
		$this->db->join('kategori_laporan','pesan_dos.kat_lap_id=kategori_laporan.kat_lap_id');
		$this->db->where('mhs_id',$id);
		$this->db->where('pesan_status',0);
		$this->db->where('pesan_dos.kat_lap_id !=',3);
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function allpesan($id){
		$this->db->select('*');
		$this->db->from('pesan_dos');
		$this->db->join('pegawai','pesan_dos.pgw_id=pegawai.pgw_id');
		$this->db->join('kategori_laporan','pesan_dos.kat_lap_id=kategori_laporan.kat_lap_id');
		$this->db->where('mhs_id',$id);
		$this->db->where('pesan_dos.kat_lap_id !=',3);
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
	
	function add_pesan($mhs, $kat_lap_id){
			$data = array(
			'pgw_id'=>$this->session->userdata('userid'),
			'mhs_id'=>$mhs,
			'kat_lap_id'=>$kat_lap_id,
			'pesan_isi'=>null,
			'pesan_status'=>0,
			'pesan_tgl'=>date('Y-m-d'),
			'pesan_waktu'=>date('H:i:s')
		);

		$this->db->insert($this->tbl3,$data);
	}
	/*END PESAN MHS*/
	function daftarta($mhsid){
		$tid = $this->input->post('id_akad');
		$smest = $this->input->post('smester');
		$stat = $this->input->post('status');
		$data = array (
					'tapel_id' 		=> $tid,
					'mhs_id'   		=> $mhsid,
					'numsmester'	=> $smest,
					'statusmatkul'	=> $stat
						);
						
		$this->db->insert($this->tbl4, $data);
		
		$this->db->set('judul','AKTIF');
		$this->db->set('daftar','NON AKTIF');
		$this->db->where('mhs_id',$mhsid);
		$this->db->update($this->tbl2);
	}
	
	function cekkrs($id){
	//get tapel_id
	$this->db->select('tapel_id');
	$this->db->where('tapel_status', 1);
	$gettapel = $this->db->get($this->tbl5);
	
	if($gettapel->num_rows() <> 0){
		foreach($gettapel->result() as $tap){
			$tapid = $tap->tapel_id;
		}
			$this->db->select('*');
			$this->db->where('mhs_id', $id);
			$this->db->where('tapel_id', $tapid);
			$getkrs = $this->db->get($this->tbl4);
			
			if($getkrs->num_rows() <> 0){
				return '1';
			}else{
				return '';
			}
	}else{
		return '';
	}
	}

	function dospemdash(){
	/*SELECT a.*, b.*, c.*, d.*, e.*, GROUP_CONCAT(c.pgw_id ORDER BY a.dospem_id)as pegawai from dospem a, pengajuan b, pegawai c, mahasiswa d, tema e
	where a.peng_id=b.peng_id AND a.pgw_id=c.pgw_id AND b.mhs_id=d.mhs_id AND b.tema_id=e.tema_id AND a.peng_id=1 group by a.peng_id order by d.mhs_nim asc*/
	
	$this->db->select('*');
	$this->db->where('tapel_status',1);
	$res = $this->db->get($this->tbl5);
	
	if($res->num_rows() <> 0){
		foreach($res->result() as $tap){}
			
			$id=$this->session->userdata('userid');
			$this->db->select('a.*, b.*, c.*, d.*, e.*, GROUP_CONCAT(c.pgw_nama ORDER BY a.dospem_id) as pegawai');
			$this->db->from('dospem a');
			$this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
			$this->db->join('pegawai c', 'a.pgw_id = c.pgw_id');
			$this->db->join('tapel d', 'a.tapel_id = d.tapel_id');
			$this->db->join('pengajuan e', 'e.mhs_id = b.mhs_id');
			$this->db->where('b.mhs_id', $id);
			$this->db->where('e.peng_status', 'DISETUJUI');
			$this->db->where('d.tapel_id', $tap->tapel_id);
			$this->db->group_by('e.peng_judul');
			$this->db->order_by('e.peng_id','desc');
			$this->db->limit('1');
			$query = $this->db->get();
			return $query->result_array();
	}else{
		return '';
	}
	}
	
	function alumni($jur, $kon, $akad, $smest){
		$this->db->select('*');
		$this->db->from('mhs_akhir');
		$this->db->join('mahasiswa','mahasiswa.mhs_id=mhs_akhir.mhs_id');
		$this->db->join('laporan','laporan.mhs_id=mhs_akhir.mhs_id');
		$this->db->join('bimbingan','bimbingan.lap_id=laporan.lap_id');
		$this->db->join('kategori_laporan','kategori_laporan.kat_lap_id=laporan.kat_lap_id');
		$this->db->join('tapel','tapel.tapel_id=mhs_akhir.tapel_id');
		$this->db->where('mahasiswa.jur_id',$jur);
		$this->db->where('mahasiswa.kon_id',$kon);
		$this->db->where('tapel.tapel_id',$akad);
		$this->db->group_by('mhs_akhir.mhs_id');
		$this->db->order_by('mhs_akhir.mhs_id','asc');
		
		$lap = $this->db->get();
		
		return $lap;
	}
}