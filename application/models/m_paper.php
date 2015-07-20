<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_paper extends CI_Model{

	protected $tbl = 'laporan';
	protected $tbl2 = 'bimbingan';
	protected $tbl3 = 'dashboard_oto';
	protected $tbl4 = 'sidang';
	protected $tbl5 = 'ta';
	protected $tbl6 = 'mahasiswa';
	protected $tbl7 = 'mhs_akhir';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}

	/*PROPOSAL USER*/
		function get_all_proposal($id, $no){
		
		$this->db->select('*');
		$this->db->from('bimbingan a');
		$this->db->join('laporan b', 'a.lap_id = b.lap_id');
		$this->db->join('kategori_laporan c', 'b.kat_lap_id = c.kat_lap_id');
		$this->db->where('b.mhs_id', $id);
		$this->db->where('b.kat_lap_id', $no);
		$this->db->order_by('a.bim_id','desc');
		$query = $this->db->get();
		
		return $query;
	}

	function add_proposal($kat_id, $isi){
	
	//get tapel id
	$this->db->select('*');
	$this->db->from('tapel');
	$this->db->where('tapel_status','1');
	$que = $this->db->get();
	
	foreach($que->result() as $tid){ $id = $tid->tapel_id;}
	// add to table laporan
		$data = array(
					'lap_id'=>null,
					'mhs_id'=>$this->session->userdata('userid'),
					'kat_lap_id'=>$kat_id,
					'lap_file'=>$isi,
					'lap_tgl'=>date('Y-m-d'),
					'lap_waktu'=>date('H:i:s'),
					'tapel_id'=>$id
				);

		$this->db->insert($this->tbl,$data);
	
	}
	
	function get_prop($id){

		$this->db->where('lap_id',$id);
		$q=$this->db->get('laporan');
		return $q;
	}
	
	function edit_proposal($id, $isi){
	$nama_file = preg_replace("/^(.+?);.*$/", "\\1", $isi);
		$data = array(
					'lap_file'=>$isi,
					'lap_tgl'=>date('Y-m-d'),
					'lap_waktu'=>date('H:i:s')
				);

		$this->db->where('lap_id',$id);
		$this->db->update($this->tbl,$data);
	
	}
	
	function get_last(){
		
		$id	= $this->session->userdata('userid');
		$this->db->select('lap_id,laporan.mhs_id');
		$this->db->from('laporan');
		$this->db->join('mahasiswa','laporan.mhs_id=mahasiswa.mhs_id');
		$this->db->where('laporan.mhs_id', $id);
		$this->db->order_by('lap_id','desc');
		$this->db->limit('1');
		$query= $this->db->get();
		
		return $query;
	}
	
	function get_last_bimbingan($mhs){
		
		$this->db->select('*');
		$this->db->from('bimbingan');
		$this->db->join('laporan','bimbingan.lap_id=laporan.lap_id');
		$this->db->where('laporan.mhs_id', $mhs);
		$this->db->order_by('bim_id','desc');
		$this->db->limit('1');
		$query= $this->db->get();
		
		return $query;
	}
	
	function get_last_bimbingankategori($mhs, $no){
		
		$this->db->select('*');
		$this->db->from('bimbingan');
		$this->db->join('laporan','bimbingan.lap_id=laporan.lap_id');
		$this->db->where('laporan.mhs_id', $mhs);
		$this->db->where('laporan.kat_lap_id', $no);
		$this->db->order_by('bim_id','desc');
		$this->db->limit('1');
		$query= $this->db->get();
		
		return $query;
	}
	
	function download_prop() {
	$ur = $this->uri->segment(1); 
	if($ur =="admin"){
		$requested_file = $this->uri->segment(5);
	}else if($ur=="laporan"){
		$requested_file = $this->uri->segment(4);
	}else{
		$requested_file = $this->uri->segment(3);
	}
        $this->load->helper('download');
        $this->db->select('*');
        $this->db->where('lap_file',$requested_file);
        $query =  $this->db->get($this->tbl);
        foreach ($query->result() as $row)
       {
		if($ur=='admin'){
			if($this->uri->segment(4)=='2'){
				$file_data = file_get_contents(base_url()."assets/upload/proposal/".$row->lap_file);
			}else{
				$file_data = file_get_contents(base_url()."assets/upload/laporan/".$row->lap_file);
			}
		}else if($ur=="laporan"){
			$file_data = file_get_contents(base_url()."assets/upload/laporan/".$row->lap_file);
		}else{
			$file_data = file_get_contents(base_url()."assets/upload/proposal/".$row->lap_file);
		}
			$file_name = $row->lap_file;
		}
    force_download($file_name, $file_data);
    }
	
	function download_rev() {
	$ur = $this->uri->segment(1); 
	if($ur =="admin"){
		$requested_file = $this->uri->segment(5);
	}else if($ur=="laporan"){
		$requested_file = $this->uri->segment(4);
	}else{
		$requested_file = $this->uri->segment(3);
	}
	
        $this->load->helper('download');
        $this->db->select('*');
        $this->db->where('bimb_file',$requested_file);
        $query =  $this->db->get($this->tbl2);
        foreach ($query->result() as $row)
       {
			$file_data = file_get_contents(base_url()."assets/upload/bimbingan/".$row->bimb_file);
			$file_name = $row->bimb_file;
		}
    force_download($file_name, $file_data);
    }
	
	/*END PROPOSAL USER*/
	/*PROPOSAL ADMIN*/
	function detail_pengajuan($mhsid){
		$this->db->select('*');
		$this->db->from('pengajuan');
		$this->db->join('mahasiswa','pengajuan.mhs_id=mahasiswa.mhs_id');
		$this->db->where('pengajuan.mhs_id',$mhsid);
		$this->db->where('peng_status','DISETUJUI');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*function get_all_proposal_dospem($mhsid){
		
		$id	= $this->session->userdata('userid');
		
		//cek status dospem
		$this->db->select('*');
		$this->db->from('dospem');
		$this->db->where('pgw_id',$id);
		$cek = $this->db->get();
				
			foreach($cek->result() as $key){
				$dos_id = $key->dospem_id;
				
				if($dos_id % 2 == 0){
					$stat1 = "Menunggu Diperiksa";
					$stat2 = "REVISI - P2";
					$stat3 = "Menunggu Persetujuan Dosen P1";
					
					$where = "a`.`bimb_status` =  '$stat1' OR  `a`.`bimb_status` =  '$stat2' OR  `a`.`bimb_status` =  '$stat3'";
					$this->db->select('*');
					$this->db->from('bimbingan a');
					$this->db->join('laporan b', 'a.lap_id = b.lap_id');
					$this->db->join('kategori_laporan c', 'b.kat_lap_id = c.kat_lap_id');
					$this->db->join('dospem d', 'b.mhs_id = d.mhs_id');
					$this->db->join('mahasiswa e', 'b.mhs_id = e.mhs_id');
					$this->db->where('d.pgw_id', $id);
					//$this->db->where('b.kat_lap_id', '2');
					$this->db->where($where);
					$this->db->order_by('a.bim_id','desc');
					$query = $this->db->get();
					
					return $query;
				}/*else{
					$stat1 = "Menunggu Persetujuan Dosen P1";
					$stat2 = "REVISI - P1";
					$stat3 = "ACC";
					
					$this->db->select('*');
					$this->db->from('bimbingan a');
					$this->db->join('laporan b', 'a.lap_id = b.lap_id');
					$this->db->join('kategori_laporan c', 'b.kat_lap_id = c.kat_lap_id');
					$this->db->join('dospem d', 'b.mhs_id = d.mhs_id');
					$this->db->join('mahasiswa e', 'b.mhs_id = e.mhs_id');
					$this->db->where('d.mhs_id', $mhsid);
					//$this->db->where('b.kat_lap_id', '2');
					//$this->db->where($where);
					$this->db->order_by('a.bim_id','desc');
					$query = $this->db->get();
				}
			}
	}*/
	
	function get_all_proposal_dospem($mhsid){
	$id	= $this->session->userdata('userid');
		$this->db->select('mhs_id');
		$this->db->where('mhs_id',$mhsid);
		$que = $this->db->get('mhs_akhir');
			
			if($que->num_rows() <>0 && $que->num_rows() % 2 == 0){
					$this->db->select('*');
					$this->db->from('bimbingan a');
					$this->db->join('laporan b', 'a.lap_id = b.lap_id');
					$this->db->join('kategori_laporan c', 'b.kat_lap_id = c.kat_lap_id');
					$this->db->join('dospem d', 'b.mhs_id = d.mhs_id');
					$this->db->join('mahasiswa e', 'b.mhs_id = e.mhs_id');
					$this->db->where('b.mhs_id', $mhsid);
					$this->db->where('d.pgw_id', $id);
					$this->db->group_by('b.lap_id');
					//$this->db->where('b.kat_lap_id', '2');
					$this->db->order_by('a.bim_id','desc');
					$query = $this->db->get();
					
					return $query;
					
			}else if($que->num_rows() <>0 && $que->num_rows() % 2 == 1){
				$this->db->select('tapel_id');
				$this->db->where('tapel_status',1);
				$tap = $this->db->get('tapel');
				
				foreach($tap->result() as $t){
					$tapid = $t->tapel_id;
					
					$this->db->select('*');
					$this->db->from('bimbingan a');
					$this->db->join('laporan b', 'a.lap_id = b.lap_id');
					$this->db->join('kategori_laporan c', 'b.kat_lap_id = c.kat_lap_id');
					$this->db->join('dospem d', 'b.mhs_id = d.mhs_id');
					$this->db->join('mahasiswa e', 'b.mhs_id = e.mhs_id');
					$this->db->where('b.mhs_id', $mhsid);
					$this->db->where('d.pgw_id', $id);
					$this->db->where('bimbingan.tapel_id', $tapid);
					$this->db->group_by('b.lap_id');
					$this->db->order_by('a.bim_id','desc');
					$query = $this->db->get();
					
					return $query;
				}
			}
	}
	
	function get_progress($id){
					$this->db->select('*');
					$this->db->from('bimbingan a');
					$this->db->join('laporan b', 'a.lap_id = b.lap_id');
					$this->db->join('kategori_laporan c', 'b.kat_lap_id = c.kat_lap_id');
					$this->db->join('tapel d', 'a.tapel_id = d.tapel_id');
					$this->db->where('b.mhs_id', $id);
					$this->db->where('d.tapel_status', 1);
					//$this->db->where($where);
					$this->db->order_by('a.bim_id','desc');
					$query = $this->db->get();
					
					return $query;
	}
	
	function get_progress_rekap($id, $tpl){
					$this->db->select('*');
					$this->db->from('bimbingan a');
					$this->db->join('laporan b', 'a.lap_id = b.lap_id');
					$this->db->join('kategori_laporan c', 'b.kat_lap_id = c.kat_lap_id');
					$this->db->join('tapel d', 'a.tapel_id = d.tapel_id');
					$this->db->where('b.mhs_id', $id);
					$this->db->where('d.tapel_id', $tpl);
					//$this->db->where($where);
					$this->db->order_by('a.bim_id','desc');
					$query = $this->db->get();
					
					return $query;
	}
	
	function get_bimbingan($id){

		$this->db->select('*');
		$this->db->from('bimbingan a');
		$this->db->join('laporan b', 'a.lap_id = b.lap_id');
		$this->db->join('kategori_laporan c', 'b.kat_lap_id = c.kat_lap_id');
		$this->db->where('b.lap_id', $id);
		$query = $this->db->get();
		
		return $query;
	}
	
	
	
	function update_bimbingan($file){
		$pgw		= $this->session->userdata('userid');
		$id			= $this->input->post('bimid', TRUE);
		$lapid		= $this->input->post('lapid', TRUE);
		$mhs		= $this->input->post('mhs', TRUE);
		$katlap		= $this->input->post('katlap', TRUE);
		$koment		= $this->input->post('komentar',TRUE);
		if (empty($koment)){
		 $komentar ='Tak ada Komentar';
		}else{
			$komentar = $koment;
		}
		$stat		= $this->input->post('status',TRUE);
				
				//cek status dospem
				$this->db->select('*');
				$this->db->from('dospem');
				$this->db->where('pgw_id',$pgw);
				$this->db->where('mhs_id',$mhs);
				$cek = $this->db->get();
				
				foreach($cek->result() as $key){
					$dos_id = $key->dospem_id;
					$dosp1 = $key->p1;
					$dosp2 = $key->p2;
					
					if($dos_id % 2 == 0){
						//genap == P2
						if($stat =="ACC"){
							$up_stat = 'Menunggu Diperiksa Dosen P1';
						}else{
							$up_stat = 'REVISI - P2';
						}
					}else{
					//ganjil == P1
						if($stat =="ACC"){
							$up_stat = $stat;
							//$this->($mhs);
						}else{
							$up_stat = 'REVISI - P1';
						}
					}
					
					if($dosp1=='1'){
						$dp1 = '1';
					}else{
						$dp1 = '0';
					}
					
					if($dosp2=='1'){
						$dp2 = '1';
					}else{
						$dp2 = '0';
					}

				}
				
		$data = array(
					//'lap_id'=>$lapid,
					'pgw_id'=>$pgw,
					'bimb_file'=>$file,
					'bimb_komentar'=>$komentar,
					'bimb_tgl'=>date('Y-m-d'),
					'bimb_waktu'=>date('H:i:s'),
					'bimb_status'=>$up_stat,
					'p1'=>$dp1,
					'p2'=>$dp2
				);

			$this->db->where('bim_id',$id);
			$this->db->update($this->tbl2,$data);
		
		if($up_stat=='ACC'){
			$this->open_lock($mhs);
		}
		
	}
	
	function open_krs($id, $jur){
		//get angkatan
		$this->db->select('*');
		$this->db->where('ta_id',$id);
		$que = $this->db->get($this->tbl5);
		
		foreach($que->result() as $k){
			$ang = $k->angk;
			$tapid = $k->tapel_id;
		
			//get_mhs_id where angkatan $angk
			$this->db->select('mhs_id');
			$this->db->where('angkatan',$ang);
			$this->db->where('jur_id',$jur);
			$cek = $this->db->get($this->tbl6);
			
			foreach($cek->result() as $r){
				$mhsid = $r->mhs_id;
				
				//cek mhs_akhir
				$this->db->select('mhs_id');
				$this->db->where('mhs_id',$mhsid);
				$this->db->where('tapel_id',$tapid);
				$getakhir = $this->db->get($this->tbl7);
				
				if($getakhir->num_rows() <> 0){
					$this->db->set('daftar','NON AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3);
					
					$this->open_dashboard($mhsid);
				}else{
					$this->db->set('daftar','AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3);
				}
			}
		}
	}
	
	function lock_krs($id, $jur){
		//get angkatan
		$this->db->select('angk');
		$this->db->where('ta_id',$id);
		$que = $this->db->get($this->tbl5);
		
		foreach($que->result() as $k){
			$ang = $k->angk;
		}
		
			//get_mhs_id where angkatan $angk
			$this->db->select('mhs_id');
			$this->db->where('angkatan',$ang);
			$this->db->where('jur_id',$jur);
			$cek = $this->db->get($this->tbl6);
			
			foreach($cek->result() as $r){
				$mhsid = $r->mhs_id;
				
				$data = array(
						'mhs_id' 		=> $mhsid,
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
				$this->db->update($this->tbl3,$data);
			}
	}
	
	function open_lock($mhs){
	//cek status
	$this->db->select('*');
	$this->db->from($this->tbl3);
	$this->db->where('mhs_id',$mhs);
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
	
	if($proposal=='AKTIF'){
		$data = array('bab1'=>'AKTIF');
	}
	if($bab1=='AKTIF'){
		$data = array('bab2'=>'AKTIF');
	}
	if($bab2=='AKTIF'){
		$data = array('bab3'=>'AKTIF');
	}
	if($bab3=='AKTIF'){
		$data = array('bab4'=>'AKTIF');
	}
	if($bab4=='AKTIF'){
		$data = array('bab5'=>'AKTIF');
	}
	if($bab5=='AKTIF'){
		$data = array('bab6'=>'AKTIF');
	}
		$this->db->where('mhs_id',$mhs);
		$this->db->update($this->tbl3,$data);
	}
	
	function open_dashboard($mhsid){
		$this->db->select('*');
		$this->db->join('laporan','bimbingan.lap_id=laporan.lap_id');
		$this->db->where('laporan.mhs_id', $mhsid);
		$this->db->order_by('bim_id','desc');
		$this->db->limit('1');
		$query= $this->db->get($this->tbl2);
			
		if($query->num_rows() <> 0){
			foreach ($query->result() as $que){ $kat = $que->kat_lap_id; $stat = $que->bimb_status;
			
				#PROPOSAL
				if($kat=='2' && $stat =='ACC'){
					$data = array('mhs_id'=>$mhsid, 'judul'=>'AKTIF','proposal'=>'AKTIF','bab1'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('mhs_id'=>$mhsid,'judul'=>'AKTIF','proposal'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
				
				#BAB1
				if($kat=='11' && $stat =='ACC'){
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF','bab1'=>'AKTIF','bab2'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF','bab1'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
			}
		}else{
				$data = array('judul'=>'AKTIF');
				$this->db->where('mhs_id',$mhsid);
				$this->db->update($this->tbl3,$data);
		}
		/*if($query->num_rows() <> 0)
			foreach ($query->result() as $que){ $kat = $que->kat_lap_id; $stat = $que->bimb_status;
			
			#PROPOSAL
				if($kat=='2' && $stat =='ACC'){
					$data = array('mhs_id'=>$mhsid, 'judul'=>'AKTIF','proposal'=>'AKTIF','bab1'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('mhs_id'=>$mhsid,'judul'=>'AKTIF','proposal'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
				
			#BAB1
				if($kat=='11' && $stat =='ACC'){
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF','bab1'=>'AKTIF','bab2'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF','bab1'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
				
			#BAB2
				if($kat=='12' && $stat =='ACC'){
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF','bab1'=>'AKTIF','bab2'=>'AKTIF','bab3'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF','bab1'=>'AKTIF','bab2'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
				
			#BAB3
				if($kat=='13' && $stat =='ACC'){
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF', 'bab1'=>'AKTIF', 'bab2'=>'AKTIF', 'bab3'=>'AKTIF', 'bab4'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF', 'bab1'=>'AKTIF', 'bab2'=>'AKTIF', 'bab3'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
				
			#BAB4
				if($kat=='14' && $stat =='ACC'){
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF', 'bab1'=>'AKTIF', 'bab2'=>'AKTIF', 'bab3'=>'AKTIF', 'bab4'=>'AKTIF', 'bab5'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF', 'bab1'=>'AKTIF', 'bab2'=>'AKTIF', 'bab3'=>'AKTIF', 'bab4'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
				
			#BAB5
				if($kat=='15' && $stat =='ACC'){
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF', 'bab1'=>'AKTIF', 'bab2'=>'AKTIF', 'bab3'=>'AKTIF', 'bab4'=>'AKTIF', 'bab5'=>'AKTIF', 'bab6'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF', 'bab1'=>'AKTIF', 'bab2'=>'AKTIF', 'bab3'=>'AKTIF', 'bab4'=>'AKTIF', 'bab5'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
				
			#BAB6
				if($kat=='16' && $stat =='ACC'){
					$data = array('judul'=>'AKTIF','proposal'=>'AKTIF', 'bab1'=>'AKTIF', 'bab2'=>'AKTIF', 'bab3'=>'AKTIF', 'bab4'=>'AKTIF', 'bab5'=>'AKTIF', 'bab6'=>'AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}else{
					$data = array('judul'=>'AKTIF','proposal'=>'NON AKTIF', 'bab1'=>'NON AKTIF', 'bab2'=>'NON AKTIF', 'bab3'=>'NON AKTIF', 'bab4'=>'NON AKTIF', 'bab5'=>'NON AKTIF', 'bab6'=>'NON AKTIF');
					$this->db->where('mhs_id',$mhsid);
					$this->db->update($this->tbl3,$data);
				}
			}
		}else{
				$data = array('judul'=>'AKTIF');
				$this->db->where('mhs_id',$mhsid);
				$this->db->update($this->tbl3,$data);
		}*/
	}
	/*END PROPOSAL ADMIN*/
	
	function get_bab($no){
	
		$this->db->select('*');
		$this->db->from('kategori_laporan');
		$this->db->where('kat_lap_id', $no);
		$query = $this->db->get();
		
		return $query;
	}

	function get_data($id){

		$this->db->where('lap_id',$id);
		$q=$this->db->get('laporan');
		return $q;
	}
}