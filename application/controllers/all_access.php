<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * File ini untuk akses yang dilakukan secara global
 */

class All_access extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_global');
	}
	
	public function daftar($data=array()){
		if(!$this->session->userdata('login'))
			show_404();
		$data['title'] = "Pendaftaran";
		if($this->session->userdata('user') == 'root'){
			$data['header'] = 'root/v_header';
			$data['footer'] = 'root/v_footer';
		} else {
			$data['header'] = 'admin/v_header';
			$data['footer'] = 'admin/v_footer';
		}
		$this->load->view('v_daftar_siswa',$data);
	}
	
	public function daftarKelas(){
		if(!$this->session->userdata('login'))
			show_404();
		
		$this->M_global->saveSiswa();
		$data['jadwal'] = $this->M_global->getData('jadwal');
		$data['kelas'] = $this->M_global->getData('kelas');
		$data['title'] = "Pendaftaran";
		if($this->session->userdata('user') == 'root'){
			$data['header'] = 'root/v_header';
			$data['footer'] = 'root/v_footer';
		} else {
			$data['header'] = 'admin/v_header';
			$data['footer'] = 'admin/v_footer';
		}
		$this->load->view('v_daftar_kelas',$data);
		
	}
	
	public function daftarAdministrasi(){
		if(!$this->session->userdata('login'))
			show_404();
		
		$this->M_global->saveKelas();
		$data['title'] = "Pendaftaran";
		$data['paket'] = $this->M_global->getData('paket');
		$data['biaya'] = $this->M_global->getData('biaya');
		if($this->session->userdata('user') == 'root'){
			$data['header'] = 'root/v_header';
			$data['footer'] = 'root/v_footer';
		} else {
			$data['header'] = 'admin/v_header';
			$data['footer'] = 'admin/v_footer';
		}
		$this->load->view('v_daftar_administrasi',$data);
	}
	
	
	public function validasi(){
		if(!$this->session->userdata('login'))
			show_404();
		
		$this->M_global->saveAdministrasi();
		$data['title'] = "Validasi";
		$data['jkel'] = $this->cek_jkel();
		$data['tgl_lahir'] = $this->format_tgl_idn();
		$data['kelas'] = $this->M_global->getName($this->session->userdata('kelas'),'kelas')->nama_kelas;
		$data['hari'] = $this->M_global->getName($this->session->userdata('jadwal'),'jadwal')->hari;
		$data['jam'] = $this->M_global->getName($this->session->userdata('jadwal'),'jadwal')->jam;
		$data['paket'] = $this->M_global->getName($this->session->userdata('paket'),'paket')->nama_paket;
		$data['biaya'] = $this->M_global->getBiaya($this->session->userdata('biaya'))->total_biaya;
		
		if($this->session->userdata('user') == 'root'){
			$data['header'] = 'root/v_header';
			$data['footer'] = 'root/v_footer';
		} else {
			$data['header'] = 'administrator/v_header';
			$data['footer'] = 'administrator/v_footer';
		}
		$this->load->view('v_validasi',$data);
		
	}
	
	public function rincian_biaya(){
		if(!$this->session->userdata('login'))
			show_404();
		
		$data['title'] = "Rincian Biaya";
		
		
		if($this->session->userdata('user') == 'root'){
			$data['header'] = 'root/v_header';
			$data['footer'] = 'root/v_footer';
		} else {
			$data['header'] = 'administrator/v_header';
			$data['footer'] = 'administrator/v_footer';
		}
		$this->load->view('v_rincian_biaya', $data);
	}
	
	public function getRincian(){
		echo $this->M_global->getRincian();
	}
	
	//masuk siswa database
	public function inputSiswa(){
		//echo $this->session->userdata('tgl_lahir');
		
		if(!$this->session->userdata('login'))
			show_404();
		
		if($this->M_global->inputSiswa()){
			//upload foto siswa
		    redirect(base_url('all_access/fotoSiswa'));
		}
	}
	
	//function lihat data rangkuman cicilan siswa
	public function siswa($id=0){
		//menentukan header dan footer
		if($this->session->userdata('user') == 'root'){
			$data['header'] = 'root/v_header';
			$data['footer'] = 'root/v_footer';
		} else {
			$data['header'] = 'administrator/v_header';
			$data['footer'] = 'administrator/v_footer';
		}
		
		$data['title'] = "Data Siswa";
		$data['id'] = $id;
		
		//kalau record ada
		if($this->M_global->checkId('siswa','id_siswa', $id)){
			/*
			$data['nama'] = $this->M_global->getNamaId('siswa','id_siswa',$id,'nama');
			$data['tgl_lahir'] = $this->M_global->getNamaId('siswa','id_siswa',$id,'tgl_lahir');
			$data['jkel'] = $this->M_global->getNamaId('siswa','id_siswa',$id,'jenis_kelamin');
			
			$tmp_sklh = $this->M_global->getNamaId('siswa','id_siswa',$id,'asal_sekolah');
			$data['sklh'] = $this->M_global->getNamaId('sekolah','id_sekolah',$tmp_sklh,'nama_sekolah');
			$data['telp'] = $this->M_global->getNamaId('siswa','id_siswa',$id,'telp');
			
			$tmp_kelas = $this->M_global->getNamaId('data_siswa','id_siswa',$id,'id_kelas');
			$data['kelas'] = $this->M_global->getNamaId('kelas','id_kelas',$tmp_kelas,'nama_kelas');
			
			$tmp_paket = $this->M_global->getNamaId('data_siswa','id_siswa',$id,'id_paket');
			$data['paket'] = $this->M_global->getNamaId('paket','id_paket',$tmp_paket,'nama_paket');
			
			$data['foto'] = $this->M_global->getNamaId('siswa','id_siswa',$id,'foto');
			*/
			$this->load->view('v_data_siswa',$data);
		} else {
			echo "maaf";
		}	
		
	}
	
	public function json_siswa($id){
		echo $this->M_global->getJsonRincianSiswa($id);
	}
	//function upload foto siswa jika berhasil
	public function fotoSiswa(){
		if($this->session->userdata('user') == 'root'){
			$data['header'] = 'root/v_header';
			$data['footer'] = 'root/v_footer';
		} else {
			$data['header'] = 'administrator/v_header';
			$data['footer'] = 'administrator/v_footer';
		}
		//data di ktp siswa
		$data['title'] = 'Foto Siswa';
		$data['kelas'] = $this->M_global->getNamaId('kelas','id_kelas',$this->session->userdata('kelas'),'nama_kelas');
		$data['siswa'] = $this->M_global->getNamaId('siswa','id_siswa',$this->session->userdata('id_new'),'nama');
		$data['tgl_lahir'] = $this->M_global->getNamaId('siswa','id_siswa',$this->session->userdata('id_new'),'tgl_lahir');
		$data['alamat'] = $this->M_global->getNamaId('siswa','id_siswa',$this->session->userdata('id_new'),'alamat');
		$this->load->view('v_upload_foto', $data);
	}
	
	public function do_upload(){
		//menangani upload
		$status = "bisa";
    	$msg = "message";
    	$file_element_name = 'userfile';
		
        $config['upload_path'] = './asset/image/siswa/';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size'] = 10000;
		
		//$config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        
        $this->load->library('upload', $config);
       	
		$result = $this->upload->do_upload();
		if(!$result) {
			$status = 'error';
			$msg = $this->upload->display_errors();
		} else {
			$data = $this->upload->data();
			$status = 'bisa';
			$msg = $data['file_name'];
			$tmp_path = $data['full_path'];
			
			//save name to session
			$this->session->set_userdata(array('img_nm'=>$data['raw_name'].'_thumb'.$data['file_ext']));
			//resizing image
			$config_lib['image_library'] = 'gd2';
			$config_lib['source_image'] = $tmp_path;
			$config_lib['create_thumb'] = TRUE;
			$config_lib['maintain_ratio'] = TRUE;
			$config_lib['width'] = 162;
			$config_lib['height'] = 300;
			
			$this->load->library('image_lib', $config_lib);

			if(!$this->image_lib->resize()){
				$status = 'error';
				$msg = 'gagal resize';
			}
			//hapus file lama
			unlink($tmp_path);
		}
		/*
       	if (!$this->upload->do_upload($file_element_name)) {
           	$status = 'error';
           	//$msg = $this->upload->display_errors();
           	$msg = 'error mulu euy';
       	} else {
           	$data = $this->upload->data();
           	$status = 'bisa';
			$msg = $data['filename'];
       	}
       */
   		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	//fuction validasi jika berhasil, countdown
	public function success(){
			if($this->M_global->insertFoto()){
				//setelah selesai memasukkan foto, hapus semua session
				$array_items = array('nama' => '', 'tgl_lahir' => '',
						  'asal_sekolah' => '', 'telp' => '',
						  'nama_wali' => '', 'alamat' => '',
						  'telp' => '','jkel' => '',
						  'kelas' => '', 'jadwal' => '',
						  'paket' => '', 'bayar' => '',
						  'uang_muka' => '',
						  'img_nm'=>'',
						  'id_new'=>'');
			    $this->session->unset_userdata($array_items);
			} else {
				echo "gagal memasukkan foto";
			}
	      $this->load->view('v_success_input');
			 
	}
	
	private function cek_jkel(){
		//cek jenis kelamin
		
		if($this->session->userdata('jkel') == "L"){
		  return "Laki-Laki";
		} else {
		  return "Perempuan";
		}
	}
	
	private function format_tgl_idn(){
		//format tanggal untuk indonesia
		$exp = explode('/',$this->session->userdata('tgl_lahir'));
		if(count($exp) == 3) {
			$tmp = "";
			switch($exp[1]){
			  case 1:
			    $tmp = "Januari";
			    break;
			  case 2:
			    $tmp = "Februari";
			    break;
			  case 3:
			    $tmp = "Maret";
			    break;
			  case 4:
			    $tmp = "April";
			    break;
			  case 5:
			    $tmp = "Mei";
			    break;
			  case 6:
			    $tmp = "Juni";
			    break;
			  case 7:
			    $tmp = "Juli";
			    break;
			  case 8:
			    $tmp = "Agustus";
			    break;
			  case 9:
			    $tmp = "September";
			    break;
			  case 10:
			    $tmp = "Oktober";
			    break;
			  case 11:
			    $tmp = "November";
			    break;
			   case 12:
			    $tmp = "Desember";
			    break;
			}
			
			$date = $exp[0].' '.$tmp.' '.$exp[2];
		}
		
		
		return $date;
	}

	//split namafile dari foto tambahkan _thumb
	public function splitImageName($file){
		list($first, $second) = split('.', $file);
		$join = $first.'_thumb.'.$second;
		return $join;
	}
	
	public function do_upload_user(){
		$status = "bisa";
    	$msg = "message";
    	$file_element_name = 'userfile';
		
        $config['upload_path'] = './asset/image/user/';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size'] = 10000;
		
		//$config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        
        $this->load->library('upload', $config);
       	
		$result = $this->upload->do_upload();
		if(!$result) {
			$status = 'error';
			$msg = $this->upload->display_errors();
		} else {
			$data = $this->upload->data();
			$status = 'bisa';
			$msg = $data['file_name'];
			$tmp_path = $data['full_path'];
			
			//save name to session
			$this->session->set_userdata(array('foto_nm'=>$data['raw_name'].'_thumb'.$data['file_ext']));
			//resizing image
			$config_lib['image_library'] = 'gd2';
			$config_lib['source_image'] = $tmp_path;
			$config_lib['create_thumb'] = TRUE;
			$config_lib['maintain_ratio'] = TRUE;
			$config_lib['width'] = 162;
			$config_lib['height'] = 300;
			
			$this->load->library('image_lib', $config_lib);

			if(!$this->image_lib->resize()){
				$status = 'error';
				$msg = 'gagal resize';
			}
			//hapus file lama
			unlink($tmp_path);
		}
		
		$this->M_global->insertFotoUser();
		//	$status = "bisa";
		//} else {
			//$status = "error";
		//}
		

		/*
       	if (!$this->upload->do_upload($file_element_name)) {
           	$status = 'error';
           	//$msg = $this->upload->display_errors();
           	$msg = 'error mulu euy';
       	} else {
           	$data = $this->upload->data();
           	$status = 'bisa';
			$msg = $data['filename'];
       	}
       */
   		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	//getjson ------------
	public function getDataUser(){
		if($this->input->post("req", true) == true){
			echo $this->M_global->getDataUser();
		} else {
			echo "maaf";
		}
	}
}

/* Akhir File global.php */