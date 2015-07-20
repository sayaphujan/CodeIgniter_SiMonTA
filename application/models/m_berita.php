<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_berita extends CI_Model{

	protected $tbl = 'berita';

	function __construct(){
		//$this->load->database('post',TRUE);
		parent::__construct();
	}
	
	function get_all_berita(){
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->join('katberita','katberita.katberita_id=berita.katberita_id');
		$this->db->order_by('berita_judul','asc');
		$sql = $this->db->get();
		
		return $sql;
	}
	
	function add(){

		$judul		= $this->input->post('judul',TRUE);
		$isi		= $this->input->post('isi',TRUE);
		$kategori	= $this->input->post('katberita',TRUE);
		$status 	='aktif';
		$upload 	='userfile';
				
			$config['upload_path'] = "./assets/berita/";
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
			    $gambar='images.jpg';
			}
		$data = array(
				'berita_id' 		=> null,
				'berita_judul'		=> $judul,
				'berita_isi'		=> $isi,
				'berita_img'		=> $gambar,
				'berita_tanggal'	=> date('Y-m-d'),
				'berita_waktu'		=> date('H:i:s'),
				'katberita_id'		=> $kategori,
				'berita_status'		=> $status
			);

		$this->db->insert($this->tbl,$data);
	}


	function get_data($id){

		$this->db->where('berita_id',$id);
		$q=$this->db->get('berita');
		return $q;
	}

	function update(){

		$id			=$this->input->post('berita_id');
		$judul		= $this->input->post('judul',TRUE);
		$isi		= $this->input->post('isi',TRUE);
		$kategori	= $this->input->post('katberita',TRUE);
		$status 	='aktif';
		$upload 	='userfile';
				
			$config['upload_path'] = "./assets/berita/";
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['file_name'] = $_FILES['userfile']['name'];
			$config['overwrite'] = false;						
			$this->load->library('upload');
			//$this->upload->initialize($config);

				if (!empty($_FILES['userfile']['name'])) {
				$data = array(

					'berita_id' 		=> $id,
					'berita_judul'		=> $judul,
					'berita_isi'		=> $isi,
					'berita_img'		=> $_FILES['userfile']['name'],
					'berita_tanggal'	=> date('Y-m-d'),
					'berita_waktu'		=> date('H:i:s'),
					'katberita_id'		=> $kategori,
					//'berita_status'		=> $status
				);
			  }
			  else
				{
					$data = array(
						'berita_id' 		=> $id,
						'berita_judul'		=> $judul,
						'berita_isi'		=> $isi,
						'berita_tanggal'	=> date('Y-m-d'),
						'berita_waktu'		=> date('H:i:s'),
						'katberita_id'		=> $kategori,
						//'berita_status'		=> $status
					);	
				}

				$this->db->where('berita_id',$id);
				$this->db->update($this->tbl,$data);
	}
	
	function change_status($id,$status){
		$this->db->where('berita_id',$id);
		$this->db->set('berita_status',$status);
		$result = $this->db->update($this->tbl);
		
		/*Jika sudah ada yang disetujui, hapus pengajuan lain dari nim yang sama yg statusnya selain DISETUJUI*/
		if($result){
			return $result;
			
		}else{
			return '';
		}
	}
	
	function delete($id){
	
		$this->db->delete($this->tbl,array('berita_id'=>$id));
		return;
	}
}