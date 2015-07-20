<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposal extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->library(array('myauth','Datatables'));
		$this->myauth->logged_in();
		$this->output->nocache();
		$this->template->title('Dashboard');
		$this->load->helper('download');
		$this->load->model(array('m_mhs','m_paper','m_bim','m_pengajuan','m_tapel'));
		$data['mhs']= $this->m_mhs->get_mhs($this->session->userdata('userid'));
		$this->template->set('navbar',$this->load->view('theme/navbar-mhs',$data,TRUE));
		$this->template->set('sidebar',$this->load->view('theme/sidebar-mhs',$data,TRUE));
		$this->template->set('header','');
	}
	
	function index(){
		$id = $this->session->userdata('userid');
		$cek_dash = $this->m_mhs->act_dashboard($id);
		foreach($cek_dash->result() as $dash){
			if ($dash->proposal =='NON AKTIF'){
				redirect('mahasiswa');
			}
		}
		$no = 2;
		$data['proposal'] = $this->m_paper->get_all_proposal($id, $no);
		//cek last status
		$data['cek'] = $this->m_paper->get_last_bimbingankategori($id, $no);
		$data['cektapel'] = $this->m_tapel->cekaktifasi();
		$data['cekta'] = $this->m_tapel->cekaktifasita();
		$data['cekkrs'] = $this->m_mhs->cekkrs($id);
		$data['topik']  = $this->m_pengajuan->get_topik_sidang($id);
		$this->template->load('template','page/proposal',$data);
	}
	
	function add(){
		$data['file']='';
		$this->template->load('template','page/proposal_add',$data);
	}
	
	function edit(){
		$id = $this->uri->segment('3');
		$data['proposal']=$this->m_paper->get_prop($id);
		$this->template->load('template','page/proposal_add', $data);
	}
	
	function submit(){
		
		$kat 		= $this->uri->segment(1);
		$act 		= $this->input->post('act');
		if($kat=="proposal"){
			$kat_id ='2';
		}else if($kat=="laporan"){
			$kat_id ='1';
		}
		
		$upload 	='userfile';
		//$isi		= preg_replace("/\s+/", "_", $this->session->userdata('nim').'_-_'.$upload);
		$isi =  md5($this->session->userdata('username').date('Y-m-d').date('H:i:s')).preg_replace("/\s+/", "_", $_FILES['userfile']['name']);
		if (empty($_FILES['userfile']['name'])){
			$data['file']='';
			$data['pfile'] = 'Tidak ada File yang dipilih';
			$data['link']=$this->input->post('act');
			$data['id']=$this->input->post('lap_id');
			$this->template->load('template','page/proposal_add',$data);
			
		}else if(!empty($_FILES['userfile']['name'])){
		//$paperfile = $this->session->userdata('nim').'_-_'.$kat.'_-_'.str_replace(" ", "_", trim($_FILES['userfile']['name']));
		//$isi = str_replace(" ","_",$paperfile);
		//$isi = preg_replace("/\s+/", "_", $paperfile);
		
			$config['upload_path'] 		= "./assets/upload/proposal/";
			$config['allowed_types'] 	= 'doc|docx|pdf|rtf|odt';
			$config['max_size'] 		= '10000';
			$config['file_name'] 		= $isi;
			
			$config['overwrite'] 		= false;						
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload($upload)){
				//$data['file']=$_FILES['userfile']['name'];
				$data['file']='';
				$data['pfile'] = $this->upload->display_errors();
				$data['link']=$this->input->post('act');
				$data['id']=$this->input->post('lap_id');
				$this->template->load('template','page/proposal_add',$data);
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
				redirect('proposal');
			}
		}
	}
	
	function get_file_prop(){
		$this->m_paper->download_prop();
	}
	
	function get_file_rev(){
		$this->m_paper->download_rev();
	}
	
	function add_bimb(){
		//get last lap id
		$nim = $this->m_paper->get_last();
		foreach($nim->result() as $key){
			//$data['id']	= $key->lap_id;
			$lapid		= $key->lap_id;
			$mhsid		= $key->mhs_id;
		}
		
		//cek last status
		$cek = $this->m_paper->get_last_bimbingan($mhsid);
		if($cek->num_rows <>0){
			foreach($cek->result() as $row){
				//$data['status'] = $row->bimb_status;
				$bimbstat = $row->bimb_status;
			}
			
			if($bimbstat == 'REVISI - P1'){
				$default_b = 'Diajukan untuk Diperiksa Dosen P1';
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
									//'lap_id'=>$data['id'],
									'lap_id'=>$lapid,
									'pgw_id'=>0,
									'bimb_file'=>$default_f,
									'bimb_komentar'=>$default_k,
									'bimb_tgl'=>date('Y-m-d'),
									'bimb_waktu'=>date('H:i:s'),
									'bimb_status'=>$default_b,
									'tapel_id'=>$id,
									'p1'=>0,
									'p2'=>0
								);

						$this->db->insert('bimbingan',$tdata);
	}
}
?>