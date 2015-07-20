<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->library(array('myauth','Datatables'));
		$this->myauth->logged_in();
		$this->output->nocache();
		$this->template->title('Dashboard');
		$this->load->helper('download');
		$this->load->model(array('m_mhs','m_paper','m_bim','m_pengajuan', 'm_tapel', 'm_mhs'));
		$data['mhs']= $this->m_mhs->get_mhs($this->session->userdata('userid'));
		$this->template->set('navbar',$this->load->view('theme/navbar-mhs',$data,TRUE));
		$this->template->set('sidebar',$this->load->view('theme/sidebar-mhs',$data,TRUE));
		$this->template->set('header','');
	}
	
	function index(){
			$this->kat();
	}
	
	function kat(){
		$id = $this->session->userdata('userid');
		$no = $this->uri->segment(3);
			$data['bab']=$this->m_paper->get_bab($no);
			$data['laporan'] = $this->m_paper->get_all_proposal($id, $no);
			$data['cek'] = $this->m_paper->get_last_bimbingankategori($id, $no);
			$data['cektapel'] = $this->m_tapel->cekaktifasi();
			$data['cekta'] = $this->m_tapel->cekaktifasita();
			$data['cekkrs'] = $this->m_mhs->cekkrs($id);
			$this->template->load('template','page/laporan',$data);
	}
	
	function cekdash($id, $no){
		
		$stat		= 'AKTIF';
		$cek_dash = $this->m_mhs->act_dashboard($id);
		
		foreach($cek_dash->result() as $dash){
			$judul 		= $dash->judul;
			$proposal 	= $dash->proposal;
			$bab1		= $dash->bab1;
			$bab2		= $dash->bab2;
			$bab3		= $dash->bab3;
			$bab4		= $dash->bab4;
			$bab5		= $dash->bab5;
			$bab6		= $dash->bab6;
		}
		
		if($no==11){
			if($bab1 != $stat){
				redirect('mahasiswa');
			}
		}
		
		if($no==12){
			if($bab1 != $stat){
				redirect('mahasiswa');
			}
			if($bab2 != $stat){
				redirect('mahasiswa');
			}
		}
		
		if($no==13){
			if($bab2 != $stat){
				redirect('mahasiswa');
			}
			if($bab3 != $stat){
			redirect('mahasiswa');
			}
		}
		
		if($no==14){
			if($bab3 != $stat){
			redirect('mahasiswa');
			}
			if($bab4 != $stat){
			redirect('mahasiswa');
			}
		}
		
		if($no==15){
			if($bab4 != $stat){
			redirect('mahasiswa');
			}
			if($bab5 != $stat){
			redirect('mahasiswa');
			}
		}
		
		if($no==16){
			if($bab5 != $stat){
			redirect('mahasiswa');
			}
			if($bab6 != $stat){
			redirect('mahasiswa');
			}
		}
		
	}
	
	function add(){
		$no = $this->uri->segment(3);
		if(empty($no) || $no==11 || $no==12 || $no==13 || $no==14 || $no==15 || $no==16){
			$data['bab']=$this->m_paper->get_bab($no);
			$data['file']='';
			$this->template->load('template','page/laporan_add',$data);
			
		}else{
			redirect('mahasiswa');
		}
	}

	function edit(){
		$no = $this->uri->segment(3);
		if(empty($no) || $no==11 || $no==12 || $no==13 || $no==14 || $no==15 || $no==16){
			$data['bab']=$this->m_paper->get_bab($no);
			$data['file']='';
			$id = $this->uri->segment(4);
			$data['proposal']=$this->m_paper->get_prop($id);
			$this->template->load('template','page/laporan_add', $data);

		}else{
			redirect('mahasiswa');
		}
	}
	
	function submit(){
		$no = $this->uri->segment(3);
		$data['bab']=$this->m_paper->get_bab($no);
		
		$kat 		= $this->uri->segment(1);
		$act 		= $this->input->post('act');
		
		$link = array('11','12','13','14','15','16');
		$kat = array('bab1','bab2','bab3','bab4','bab5','bab6');
		for($i=0; $i<6; $i++){
			if($no==$link[$i]){
				$kat= $kat[$i];
				$kat_id= $link[$i];
			}
		}

		if (empty($_FILES['userfile']['name'])){
			$data['file']='';
			$data['pfile'] = 'Tidak ada File yang dipilih';
			$data['link']=$this->input->post('act');
			$data['id']=$this->input->post('lap_id');
			$this->template->load('template','page/laporan_add',$data);
			
		}else if(!empty($_FILES['userfile']['name'])){
		$upload='userfile';
		//$paperfile = $this->session->userdata('nim').'_-_'.$kat.'_-_'.str_replace(" ", "_", trim($_FILES['userfile']['name']));
		$isi =  md5($this->session->userdata('username').date('Y-m-d').date('H:i:s')).preg_replace("/\s+/", "_", $_FILES['userfile']['name']);
		
			$config['upload_path'] = "./assets/upload/laporan/";
			$config['allowed_types'] = 'doc|docx|pdf|rtf|odt';
			$config['max_size'] = '10000';
			$config['file_name'] = $isi;
			$config['overwrite'] = false;						
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload($upload)){
				//$data['file']=$_FILES['userfile']['name'];
				$data['file']='';
				$data['pfile'] = $this->upload->display_errors();
				$data['link']=$this->input->post('act');
				$data['id']=$this->input->post('lap_id');
				$this->template->load('template','page/laporan_add',$data);
			}else{
				$id = $this->input->post('lap_id');
				if ($id!=0){
					$this->m_paper->edit_proposal($id,$isi);
				}else{
					$this->m_paper->add_proposal($kat_id,  $isi);
					$this->add_bimb();
				}
				$kat_lap_id = $kat_id;
				$mhsid = $this->session->userdata('userid');
				$this->m_pengajuan->pesantodospem($mhsid, $kat_lap_id);
				redirect('laporan/kat/'.$no);
			}
		} 
	}
	
	function get_file_prop(){
	$no = $this->uri->segment(3);
		if(empty($no) || $no==11 || $no==12 || $no==13 || $no==14 || $no==15 || $no==16){
			$this->m_paper->download_prop();
		}else{
			redirect('mahasiswa');
		}
	}
	
	function get_file_rev(){
	$no = $this->uri->segment(3);
		if(empty($no) || $no==11 || $no==12 || $no==13 || $no==14 || $no==15 || $no==16){
			$this->m_paper->download_rev();
		}else{
			redirect('mahasiswa');
		}
	}
	
	function add_bimb(){
		//get last lap id
		$nim = $this->m_paper->get_last();
		foreach($nim->result() as $key){
			$data['id'] = $key->lap_id;
			$mhsid		= $key->mhs_id;
		}
		
		//cek last status
		$cek = $this->m_paper->get_last_bimbingan($mhsid);
		if($cek->num_rows <>0){
			foreach($cek->result() as $row){
				$data['status'] = $row->bimb_status;
			}
			
			if($data['status'] == 'REVISI - P1'){
				$default_b = 'Menunggu Diperiksa Dosen P1';
			}else{
				$default_b = 'Menunggu Diperiksa';
			}
		}else{
			$default_b = 'Menunggu Diperiksa';
		}
				$default_f = 'Tak ada File Revisi';
				$default_k = 'Tak ada Komentar';
				
				//get tapel id
				$this->db->select('*');
				$this->db->from('tapel');
				$this->db->where('tapel_status','1');
				$que = $this->db->get();
				
				foreach($que->result() as $tid){ $id = $tid->tapel_id;}

				//save to bimbingan
						$tdata = array(
									'bim_id'=>null,
									'lap_id'=>$data['id'],
									'bimb_file'=>$default_f,
									'bimb_komentar'=>$default_k,
									'bimb_tgl'=>date('Y-m-d'),
									'bimb_waktu'=>date('H:i:s'),
									'bimb_status'=>$default_b,
									'tapel_id'=>$id
								);

						$this->db->insert('bimbingan',$tdata);
	}
}
?>