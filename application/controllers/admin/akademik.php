<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akademik extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model('m_tapel');
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		$data['tapel']=$this->m_tapel->get_all_tapel();
		$this->template->load2('template-admin','page/admin/listtapel',$data);
	}
	
	function custom_page(){
		$data=(array('2','3','4','5'));
		$this->myauth->logged_in_custom($data);
	}
	
	/*function get_akad(){

		$this->datatables->select('akad_id, pgw_nama, mhs_nim, mhs_nama, jur_nama, kon_nama')
		->unset_column('akad_id')
		->from('akademik')
		->join('pegawai','pegawai.pgw_id=akademik.pgw_id')
		->join('mahasiswa','mahasiswa.mhs_id=akademik.mhs_id')
		->join('jurusan','jurusan.jur_id=mahasiswa.jur_id')
		->join('konsentrasi','konsentrasi.kon_id=mahasiswa.kon_id')
		->add_column('aksi',
			'<a href="'.site_url('admin/akademik/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/akademik/del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'pgw_id');

		echo $this->datatables->generate();
	}*/
}
?>