<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposal extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library(array('Datatables'));
		$this->load->model(array('m_paper','m_pengajuan'));
		$this->load->helper(array('url','form'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
		
	}
	
	function index(){
		
		$data['proposal']=$this->m_paper->get_all_proposal_dospem();
		$this->template->load2('template-admin','page/admin/proposal_dospem',$data);
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('2');
	}
	
	/*function get_prop(){

		$this->datatables->select('mhs_nim, lap_file, bimb_tgl, bimb_waktu, bimb_file, bimb_komentar,  bimb_status')
		->unset_column('lap_id')
		->from('laporan')
		->where('kat_lap_id','2')
		->join('bimbingan','bimbingan.lap_id=laporan.lap_id')
		->join('mahasiswa','mahasiswa.mhs_id=laporan.mhs_id')
		->edit_column('lap_file','<a href="'.site_url('admin/pengajuan/get_file/$1').'">$1</a>','lap_file,bim_id')
		->edit_column('bimb_file','<a href="'.site_url('admin/proposal/get_file/$1').'">$1</a>','bimb_file,bim_id')
		->add_column('aksi',
        	'<a href="'.site_url('admin/proposal/edit/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>',
			'bim_id');

		echo $this->datatables->generate();
	}*/
	
	function get_file_prop(){
		$this->m_paper->download_prop();
	}
	
	function get_file_rev(){
		$this->m_paper->download_rev();
	}
	
	function edit(){
		$id = $this->uri->segment(4);
		$data['bimbingan']=$this->m_paper->get_bimbingan($id);
		$this->template->load2('template-admin','page/admin/bimbingan',$data);
	}
}
?>