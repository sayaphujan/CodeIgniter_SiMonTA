<?php 
header('Cache-Control: max-age=900');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengajuan extends CI_Controller
{
protected $tbl = 'pengajuan';
	function __construct(){
	
		parent::__construct();
		$this->load->library(array('Datatables'));
		$this->load->model(array('m_pengajuan','m_mhs'));
		$this->load->helper(array('url','form'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		
	}
	
	function index(){
		$level = $this->session->userdata('levelid');
		if($level=="10" or $level=="11" or $level=="12" or $level=="13"){
			$data['pengajuan'] = $this->m_pengajuan->get_all_pengajuan_prodi($level);
		}else{
			$data['pengajuan']=$this->m_pengajuan->get_all_pengajuan();
		}
		$this->template->load2('template-admin','page/admin/Pengajuan',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('3');
	}
	
	function custom(){
		$level = $this->session->userdata('levelid');
		$mhsid = $this->uri->segment(4);
		if($level=="10" or $level=="11" or $level=="12" or $level=="13"){
			$cek = $this->m_pengajuan->get_custom_pengajuan_prodi($level, $mhsid);
			if($cek->num_rows() <> 0){
				$data['pengajuan'] = $cek;
				$this->template->load2('template-admin','page/admin/Pengajuan',$data);
			}else{
				$this->template->load2('template-admin','page/admin/null');
			}
		}
	}
	
	function detail(){
	
		$pengid 			= $this->uri->segment(4);
		$data['pengajuan']	= $this->m_pengajuan->get_detail( $pengid);
		$this->template->load2('template-admin','page/admin/pengajuan_detail',$data);
	}
	
	/*function get_peng(){

		$this->datatables->select('peng_id, mhs_nim, tema_nama, peng_judul, peng_file, peng_tanggal, peng_waktu, peng_status')
		->unset_column('peng_id')
		->from('pengajuan')
		->join('mahasiswa','mahasiswa.mhs_id=pengajuan.mhs_id')
		->join('tema','tema.tema_id=pengajuan.tema_id')
		->edit_column('peng_file','<a href="'.site_url('admin/pengajuan/get_file/$1').'">$1</a>','peng_file,peng_id')
		->edit_column('peng_status','<select class="form-control combo-status" name="status" id="combo-$2">
			 <option value="$1" selected>$1</option>
			 <option value="DISETUJUI">DISETUJUI</option>
			 <option value="DITOLAK">DITOLAK</option>
			</select>','peng_status,peng_id')
		->add_column('aksi','<input type="text" placeholder="komentar"><input type="button" value="submit">',
			'pengajuan_id');

		echo $this->datatables->generate();
	}*/
	
	function change_status(){
		$id = $_GET['id'];
		$status = $_GET['status'];
		
		$kat_lap_id=0;
		if(!empty($id)){
			$result = $this->m_pengajuan->change_status($id,$status);
			if(!empty($result)){
				if($result=="tolak" || $result=="ada"){
					$notif = "Sukses Mengubah Status";
					echo json_encode(array('msg'=>$notif)); 
				}else if($result=="lebih") {
					$notif = "Hanya Satu Pengajuan yang Diperbolehkan untuk DISETUJUI";
					echo json_encode(array('msg'=>$notif)); 
				}else{
					$this->m_pengajuan->add_dospem($result);
					$this->m_mhs->add_pesan($result, $kat_lap_id);
					$result2 = $this->m_pengajuan->add_sidang($result);
					if(!empty($result2)){
						$notif = "Pengajuan Disetujui";
						echo json_encode(array('msg'=>$notif)); 
					}
				}
			}
		}
	}
	
	function change_komentar(){
		$tdata = array(
			'id' =>  $this->input->post('id'),
			'komentar' =>  $this->input->post('komentar'),
		);

		if(!empty($tdata['id'])){
			$result = $this->m_pengajuan->change_komentar($tdata);
			if(!empty($result)){
				//$notif = "Sukses mengubah status";
				//echo json_encode(array('msg'=>$notif)); 
				redirect('admin/pengajuan');
			}
		}
	}
	
	function pa(){
		
		$this->template->load2('template-admin','page/admin/pengajuan_pa');
	}
	
	function get_pa(){

		$this->datatables->select('peng_id, mhs_nim, tema_nama, peng_judul, peng_file, peng_tanggal, peng_waktu, peng_status')
		->unset_column('peng_id')
		->from('Pengajuan')
		->join('mahasiswa','mahasiswa.mhs_id=pengajuan.mhs_id')
		->join('tema','tema.tema_id=pengajuan.tema_id')
		->add_column('aksi',
        	'<a href="'.site_url('admin/pengajuan/pa_edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/pengajuan/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'pengajuan_id');

		echo $this->datatables->generate();
	}
	
	function prodi(){
		
		$this->template->load2('template-admin','page/admin/pengajuan_prodi');
	}
	
	function get_prodi(){

		$this->datatables->select('peng_id, mhs_nim, tema_nama, peng_judul, peng_file, peng_tanggal, peng_waktu, peng_status')
		->unset_column('peng_id')
		->from('Pengajuan')
		->join('mahasiswa','mahasiswa.mhs_id=pengajuan.mhs_id')
		->join('tema','tema.tema_id=pengajuan.tema_id')
		->where('peng_status','DISETUJUI DOSEN PA')
		->add_column('aksi',
        	'<a href="'.site_url('admin/pengajuan/pa_edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/pengajuan/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'pengajuan_id');

		echo $this->datatables->generate();
	}
	
	function pa_edit(){
	
		$data['pengajuan'] = $this->m_pengajuan->get_status();
		$this->template->load2('template-admin','page/admin/pengajuan_pa_edit');
	}
	
	function get_file(){
		$this->m_pengajuan->download();
	}
	
	function rekap(){
	$id		= $this->uri->segment(8);

		$level = $this->session->userdata('levelid');
		if($level=="10" or $level=="11" or $level=="12" or $level=="13"){
			$data['pengajuan'] = $this->m_pengajuan->get_all_pengajuan_prodi_rekap($level, $id);
		}else{
			$data['pengajuan']=$this->m_pengajuan->get_all_pengajuan_rekap($id);
		}
		$data['jur'] 	= $this->uri->segment(4);
		$data['kon'] 	= $this->uri->segment(5);
		$data['akad'] 	= $this->uri->segment(6);
		$data['smest'] 	= $this->uri->segment(7);
		$data['id']		= $this->uri->segment(8);
		$this->template->load2('template-admin','page/admin/Pengajuan_rekap',$data);
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
}
?>