<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library(array('Datatables'));
		$this->load->model('m_pengajuan');
		$this->load->helper(array('url','form'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		
		$this->template->load2('template-admin','page/admin/Pengajuan');
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	function get_peng(){

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
	}
	
	function change_status(){
	
		$id = $_GET['id'];
		$status = $_GET['status'];
		if(!empty($id)){
			
			$result = $this->m_pengajuan->change_status($id,$status);
			if(!empty($result)){
				$notif = "Sukses mengubah status";
				echo json_encode(array('msg'=>$notif)); 
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
}
?>