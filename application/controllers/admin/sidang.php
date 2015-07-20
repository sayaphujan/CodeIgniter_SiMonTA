<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidang extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library(array('Datatables'));
		$this->load->model(array('m_paper','m_pengajuan','m_pgw','m_konsentrasi','m_tapel'));
		$this->load->helper(array('url','form'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		
	}
	
	function index(){
		
		$id = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->where('tapel_status',1);
		$tapid = $this->db->get('tapel');
		
		if($tapid->num_rows() <> 0){
		foreach($tapid->result() as $tap){ $tapid = $tap->tapel_id;
			$result = $this->m_pgw->get_mhs_sidang($id, $tapid);
			if(!empty($result) || $result!=''){
				/*foreach($result as $key=>$res)
				{
					$dosen[$res['mhs_id']] = explode(',', $res['pegawai']);
				}
				$data['dosen'] = $dosen;
				*/
				$data['result'] = $result;
				$this->template->load2('template-admin','page/admin/sidang_concat',$data);
			}else{
				$this->template->load2('template-admin','page/admin/null');
			}
		}
		}else{
			$this->template->load2('template-admin','page/admin/null');
		}
	}

	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function detail(){
		$pengid 			= $this->uri->segment(4);
		$data['pengajuan']	= $this->m_pengajuan->get_detail( $pengid);
		$this->template->load2('template-admin','page/admin/pengajuan_detail',$data);
	}
	
	function nilai(){
		$mhsid = $this->uri->segment(4);
		$sidang = $this->m_pengajuan->get_nilai_sidang($mhsid);
		foreach($sidang->result() as $s){
		$aktif = $s->aktifasi;
			if($aktif == 'nonaktif'){
				redirect('admin/sidang');
			}else{
				$data['sidang'] = $sidang;
			}
		}
		$data['topik']  = $this->m_pengajuan->get_topik_sidang($mhsid);
		$this->template->load2('template-admin','page/admin/nilaisidang', $data);
	}
	
	function lihatnilai(){
		$level = $this->session->userdata('levelid');
		if($level=="10" or $level=="11" or $level=="12" or $level=="13"){
			$result= $this->m_pengajuan->lihatnilaisidang($level);
			if(!empty($result)){
				$data['result'] = $result;
				$this->template->load2('template-admin','page/admin/nilaiprodi',$data);
			}else{
				$this->template->load2('template-admin','page/admin/null');
			}
		}else{
			$this->template->load2('template-admin','page/admin/null');
		}
		
	}
	
	function update(){
		$id = $this->uri->segment(4);
		$aktif='aktif';
		$this->db->where('mhs_id',$id);
		$this->db->set('aktifasi',$aktif);
		$this->db->update('sidang');
		redirect('admin/sidang/lihatnilai');
	}
	
	function submit(){
		$this->form_validation->set_rules('p1', 'Nilai Penguji 1', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('p2', 'Nilai Penguji 2', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');

		$p1 	= $this->input->post('p1');
		$p2 	= $this->input->post('p2');
		$nilai 	= ($p1+$p2)/2;
		/*if($nilai>=70){
		$this->form_validation->set_rules('status', 'Status Sidang', 'trim|required|xss_clean');
		}*/
		
		
		$data['id'] = $this->input->post('mhs_id');
		$data['p1'] = $this->input->post('p1');
		$data['p2'] = $this->input->post('p2');
		//$data['nilai'] = $this->input->post('nilai');
		//$data['status'] = $this->input->post('status');
		if($this->form_validation->run() == FALSE){
			$this->template->load2('template-admin','page/admin/nilaisidang', $data);
		}else{
			$mhsid = $this->input->post('mhs_id');
			$topik = $this->input->post('topik');
				$this->m_pengajuan->updatenilaisidang();
				$this->m_pengajuan->clear_topik($mhsid);
				$this->m_pengajuan->addrevisisidang($mhsid, $topik);
				redirect('admin/sidang');
		}
	}
	
	function deltopik(){
		$topikid = $this->uri->segment(4);
		$mhsid = $this->uri->segment(5);
		
		$this->db->where('topik_id',$topikid);
		$this->db->delete('topik_revisi');
		redirect('admin/sidang/nilai/'.$mhsid);
	}
	
	function rekap(){
		$level = $this->session->userdata('levelid');
		$data['jur'] 	= $this->uri->segment(4);
		$data['kon'] 	= $this->uri->segment(5);
		$data['akad'] 	= $this->uri->segment(6);
		$data['smest'] 	= $this->uri->segment(7);
		$data['tplid']	= $this->uri->segment(8);
		
		$tpl = $this->uri->segment(8);
		if($level=="10" or $level=="11" or $level=="12" or $level=="13"){
			$result= $this->m_pengajuan->rekapnilaisidang($level, $tpl);
			if(!empty($result)){
				$data['result'] = $result;
				$this->template->load2('template-admin','page/admin/rekapnilai',$data);
			}else{
				$this->template->load2('template-admin','page/admin/rekapnull',$data);
			}
		}else{
			$this->template->load2('template-admin','page/admin/rekapnull',$data);
		}
	}
	
	function detail_rekap(){
	
		
		$data['jur'] 	= $this->uri->segment(4);
		$data['kon'] 	= $this->uri->segment(5);
		$data['akad'] 	= $this->uri->segment(6);
		$data['smest'] 	= $this->uri->segment(7);
		$data['tplid']	= $this->uri->segment(8);
		$pengid 		= $this->uri->segment(9);
		$data['pengajuan']	= $this->m_pengajuan->get_detail( $pengid);
		$this->template->load2('template-admin','page/admin/pengajuan_detail_rekap',$data);
	}
	
	function rd(){
		$pgwid = $this->session->userdata('userid');
		$id = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->where('tapel_status',0);
		$tapid = $this->db->get('tapel');
		
		if($tapid->num_rows() <> 0){
		foreach($tapid->result() as $tap){ $tapid = $tap->tapel_id;}
			$result= $this->m_pengajuan->rekapnilaisidangdospem($pgwid);
				if(!empty($result) || $result!= ''){
					$data['result'] = $result;
					$this->template->load2('template-admin','page/admin/rekapnilaidospem',$data);
				}else{
					$this->template->load2('template-admin','page/admin/rekapnulldospem');
				}
		}else{
			$this->template->load2('template-admin','page/admin/rekapnulldospem');
		}
	}
	
	function katnilai(){
		$data['error'] = '';
		$data['nilai'] = $this->m_pengajuan->katnilai();
		$this->template->load2('template-admin','page/admin/kategorinilaisidang',$data);
	}
	
	function addkriteria(){
		$data['id'] = '';
		$data['kri'] = '=';
		$data['nilai'] = '';
		$data['stat'] = '0';
		$this->template->load2('template-admin','page/admin/formkategorinilaisidang',$data);
	}
	
	function addsubmit(){
		$this->form_validation->set_rules('nilai', 'Nilai', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$this->form_validation->set_message('required','%s Tidak boleh kosong');
		
		$id		= $this->input->post('id_kat_nilai');
		$kri 	= $this->input->post('kriteria');
		$nilai 	= $this->input->post('nilai');
		$status	= $this->input->post('status');
		
		$data['id']		= $this->input->post('id_kat_nilai');
		$data['kri'] 	= $this->input->post('kriteria');
		$data['nilai'] 	= $this->input->post('nilai');
		$data['stat']	= $this->input->post('status');

		if($this->form_validation->run() == FALSE){
			$this->template->load2('template-admin','page/admin/formkategorinilaisidang', $data);
		}else{
			if($id==''){
				if($status=='1'){
					$cek2 = $this->m_pengajuan->cekaktifasi();
					if(empty($cek2) || $cek2==''){
						$this->m_pengajuan->addkatnilai($kri, $nilai, $status);
						redirect('admin/sidang/katnilai');
					}else{
						$data['error']	= '<p class="text-danger">Hanya satu Kriteria yang dapat diaktifkan</p>';
								//echo "<script>alert('Hanya satu Tahun Akademik yang dapat diaktifkan');</script>";
								//echo "<script>history.go(-1);</script>";
						$data['nilai'] = $this->m_pengajuan->katnilai();
						$this->template->load2('template-admin','page/admin/kategorinilaisidang',$data);
					}
				}else{
					$this->m_pengajuan->addkatnilai($kri, $nilai, $status);
					redirect('admin/sidang/katnilai');
				}
			}else{
				if($status=='1'){
					$cek2 = $this->m_pengajuan->cekaktifasi();
					if(empty($cek2) || $cek2==''){
						$this->m_pengajuan->updatekatnilai($id, $kri, $nilai, $status);
						redirect('admin/sidang/katnilai');
					}else{
						$data['error']	= '<p class="text-danger">Hanya satu Kriteria yang dapat diaktifkan</p>';
								//echo "<script>alert('Hanya satu Tahun Akademik yang dapat diaktifkan');</script>";
								//echo "<script>history.go(-1);</script>";
						$data['nilai'] = $this->m_pengajuan->katnilai();
						$this->template->load2('template-admin','page/admin/kategorinilaisidang',$data);
					}
				}else{
					$this->m_pengajuan->updatekatnilai($id, $kri, $nilai, $status);
					redirect('admin/sidang/katnilai');
				}
			}
		}
	}
	
	function editkriteria(){
		$id = $this->uri->segment(4);
		$data['kriteria'] = $this->m_pengajuan->getkatnilai($id);
		$this->template->load2('template-admin','page/admin/formkategorinilaisidang',$data);
	}
	
	function aktif(){
		$id   = $this->uri->segment(4);
		$stat = $this->m_pengajuan->cekfungsiaktif($id);
			if($stat=='1'){ #if status aktif maka set non aktif
				$status='0';
				$this->m_pengajuan->updateaktif($id, $status);
				redirect('admin/sidang/katnilai');
			}else{
				$cek2 = $this->m_pengajuan->cekaktifasi();
				if($cek2==''){
					$status='1';
					$this->m_pengajuan->updateaktif($id, $status);
					redirect('admin/sidang/katnilai');
				}else{
					$data['error']	= '<p class="text-danger">Hanya satu Kriteria yang dapat diaktifkan</p>';
								//echo "<script>alert('Hanya satu Tahun Akademik yang dapat diaktifkan');</script>";
								//echo "<script>history.go(-1);</script>";
					$data['nilai'] = $this->m_pengajuan->katnilai();
					$this->template->load2('template-admin','page/admin/kategorinilaisidang',$data);
				}
			}
	}
}