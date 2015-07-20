<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dospem extends CI_Controller
{
	function __construct(){
	
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model(array('m_kompetensi','m_level','m_pgw','m_mhs'));
		$this->output->nocache();
		$this->myauth->logged_in_admin();
		$this->template->title('Dashboard Admin');
	}
	
	function index(){
		$level = $this->session->userdata('levelid');
		$result = $this->m_pgw->get_all_dospem($level);
		$maxdos = $this->m_pgw->count_dos();
		if($result){
			foreach($result as $key=>$res)
			{
				$dosen[$res['mhs_id']] = explode(',', $res['pegawai']);
			}
			$data['result'] = $result;
			$data['maxdos'] = $maxdos;
			$data['dosen'] = $dosen;
			$data['pegawai'] = $this->m_pgw->get_all_pgwnull();
			$this->template->load2('template-admin','page/admin/dospem',$data);
			//$this->template->load2('template-admin','page/admin/dospemcombo',$data);
		}else{
			$this->template->load2('template-admin','page/admin/null');
		}
	}
	
	function custom_page(){
		
		$this->myauth->logged_in_custom('3');
	}
	
	/*function get_dospem(){
	
		$this->datatables->select('dospem_id, mhs_nim, tema_nama, peng_judul, pgw_nama, peng_status')
		->unset_column('dospem_id')
		->from('dospem')
		->join('pegawai','pegawai.pgw_id=dospem.pgw_id')
		->join('pengajuan','pengajuan.peng_id=dospem.peng_id')
		->join('mahasiswa','mahasiswa.mhs_id=pengajuan.mhs_id')
		->join('tema','tema.tema_id=pengajuan.tema_id')
		->add_column('aksi',
        	'<a href="'.site_url('admin/dospem/detail/$1').'">
				<button class="btn btn-xs btn-flat btn-success btnbrg-edit">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			
			<a href="'.site_url('admin/dospem/dospem_del/$1').'">
				<button class="btn btn-xs btn-flat btn-danger btnbrg-del" id=$1>
					<i class="fa fa-times"></i>
				</button>
			</a>',
			'dospem_id');

		echo $this->datatables->generate();
	}*/

	/*function edit(){
		$id = $this->uri->segment(4);
		$result = $this->m_pgw->get_dospem($id);
		$maxdos = $this->m_pgw->count_dos();
		foreach($result as $key=>$res)
		{
			$dosen[$res['pgw_id']] = explode(',', $res['pegawai']);
		}
		$data['result'] = $result;
		$data['maxdos'] = $maxdos;
		$data['dosen'] = $dosen;
		$data['pegawai'] = $this->m_pgw->get_all_pgw();
		$this->template->load2('template-admin','page/admin/dospem_edit', $data);
	}*/
	
	function edit(){
		$id = $this->uri->segment(4);
		$data['pegawai1'] = $this->m_pgw->get_all_dospem1();
		$data['pegawai2'] = $this->m_pgw->get_all_dospem2();
		$data['dosen1'] = $this->m_pgw->get_dospem1($id);
		$data['dosen2'] = $this->m_pgw->get_dospem2($id);
		$this->template->load2('template-admin','page/admin/dospem_edited', $data);
	}
	
	function submit(){
		$this->m_pgw->cek_doss();
		$this->m_pgw->cek_dosd();
		//$this->m_pgw->edit_dospem();
		redirect ('admin/dospem');
	}
	
	function del($id){
		$id=$this->uri->segment(4);
		$this->m_pgw->del_dospem($id);
		redirect('admin/dospem');
	}
	
	function rekap(){
		$level = $this->session->userdata('levelid');
		$data['jur'] 	= $this->uri->segment(4);
		$data['kon'] 	= $this->uri->segment(5);
		$data['akad'] 	= $this->uri->segment(6);
		$data['smest'] 	= $this->uri->segment(7);
		$data['tplid']	= $this->uri->segment(8);
		
		$tpl = $this->uri->segment(8);
		$result = $this->m_pgw->rekap_all_dospem($level, $tpl);
		$maxdos = $this->m_pgw->count_dos();
		if($result){
			foreach($result as $key=>$res)
			{
				$dosen[$res['mhs_id']] = explode(',', $res['pegawai']);
			}
			$data['result'] = $result;
			$data['maxdos'] = $maxdos;
			$data['dosen'] = $dosen;
			$this->template->load2('template-admin','page/admin/rekapdospem',$data);
		}else{
			$this->template->load2('template-admin','page/admin/rekapnull',$data);
		}
	}
	
	function change(){
		$level = $this->session->userdata('levelid');
		$data['result'] = $this->m_pgw->change($level);
		$this->template->load2('template-admin','page/admin/changedospem',$data);
	}
	
	function detail_change(){
		$mhsid = $this->uri->segment(4);
		$pgwid = $this->uri->segment(5);
		$tapelid = $this->uri->segment(6);
		$level = $this->session->userdata('levelid');
		$data['result'] = $this->m_pgw->pengchange($mhsid, $tapelid);
		$data['riwayat'] = $this->m_pgw->detail_change($level, $mhsid, $pgwid, $tapelid);
		$this->template->load2('template-admin','page/admin/detailchange',$data);
	}
	
	function changerekap(){
		$level = $this->session->userdata('levelid');
		$data['jur'] 	= $this->uri->segment(4);
		$data['kon'] 	= $this->uri->segment(5);
		$data['akad'] 	= $this->uri->segment(6);
		$data['smest'] 	= $this->uri->segment(7);
		$data['tplid']	= $this->uri->segment(8);
		
		$tpl = $this->uri->segment(8);
		$level = $this->session->userdata('levelid');
		$data['result'] = $this->m_pgw->changerekap($level, $tpl);
		$this->template->load2('template-admin','page/admin/rekapchangedospem',$data);

	}
	
	function rekapdetail_change(){
		$data['jur'] 	= $this->uri->segment(4);
		$data['kon'] 	= $this->uri->segment(5);
		$data['akad'] 	= $this->uri->segment(6);
		$data['smest'] 	= $this->uri->segment(7);
		$data['tplid']	= $this->uri->segment(8);
		$mhsid 	= $this->uri->segment(9);
		$pgwid = $this->uri->segment(10);
		
		$tapelid = $this->uri->segment(8);
		$level = $this->session->userdata('levelid');
		$data['result'] = $this->m_pgw->pengchange($mhsid, $tapelid);
		$data['riwayat'] = $this->m_pgw->detail_change($level, $mhsid, $pgwid, $tapelid);
		$this->template->load2('template-admin','page/admin/rekapdetailchange',$data);
	}
}
