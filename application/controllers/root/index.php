<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_root');
	}
	
	public function index(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		$data['title'] = 'Villa Merah | root';
		$data['page'] = 'root/v_home';
		$this->load->view('root/v_index', $data);
	}
	
	/* ---------------------------- Siswa ---------------------- */
	
	/* view siswa */
	public function siswa(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		$data['title'] = 'Siswa';
		$data['page'] = 'root/v_siswa';
		$this->load->view('root/v_index', $data);
	}
	
	public function updateSiswa($id){
		if(!$this->session->userdata('login') && ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->updateSiswa($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal mengubah data'));
		}
	}
	
	public function hapusSiswa(){
		if(!$this->session->userdata('login') && ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();
		
		$id = intval(addslashes($_POST['id']));
		if ($this->M_root->hapusSiswa($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal menghapus data'));
		}
	}
	// end siswa
	
	/* ------------------------------- Sekolah ---------------------- */
	public function sekolah(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level') != 1)){
			show_404();
		}
		$data['title'] = 'Data Sekolah';
		$data['page'] = 'root/v_sekolah';
		$this->load->view('root/v_index', $data);
	}
	
	public function createSekolah() {
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->createSekolah()){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal Input ! Sekolah sudah ada'));
		}
	}
	
	public function updateSekolah($id){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->updateSekolah($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal Update ! Sekolah sudah ada'));
		}
	}
	
	public function hapusSekolah(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();
		
		$id = intval(addslashes($_POST['id']));
		if ($this->M_root->hapusSekolah($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal menghapus data'));
		}
	}
	//end sekolah
	
	//bagian jadwal
	
	public function jadwal(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		$data['title'] = 'Jadwal';
		$data['page'] = 'root/v_jadwal';
		$this->load->view('root/v_index', $data);
	}
	
	public function createJadwal() {
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		//$tes = true;
		//if($tes){
		if ($this->M_root->createJadwal()){
			echo json_encode(array('success' => true));
		}
		else{
			echo json_encode(array('msg' => 'Gagal Input Jadwal ! Jadwal sudah ada'));
		}
	}
	
	public function updateJadwal($id){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->updateJadwal($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal mengubah jadwal! Jadwal sudah ada'));
		}
	}
	
	public function hapusJadwal(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();
		
		$id = intval(addslashes($_POST['id']));
		if ($this->M_root->hapusJadwal($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal menghapus data'));
		}
	}
	//end jadwal
	
	//bagian kelas
	public function kelas(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		$data['title'] = 'Kelas';
		$data['page'] = 'root/v_kelas';
		$this->load->view('root/v_index', $data);
	}
	
	public function createKelas() {
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->createKelas())
			echo json_encode(array('success' => true));
		else
			echo json_encode(array('msg' => 'Gagal Input ! Kelas Sudah Ada'));
	}
	
	public function updateKelas($id){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->updateKelas($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal Update ! Kelas Sudah Ada'));
		}
	}
	
	public function hapusKelas(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();
		
		$id = intval(addslashes($_POST['id']));
		if ($this->M_root->hapusKelas($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal menghapus data'));
		}
	}
	//end kelas
	
	//bagian user
	public function user(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		
		$data['title'] = 'User';
		$data['page'] = 'root/v_user';
		$data['level'] = $this->M_root->getLevel();
		$this->load->view('root/v_index', $data);
	}
	
	public function createUser() {
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->createUser())
			echo json_encode(array('success' => true));
		else
			echo json_encode(array('msg' => 'Gagal membuat user baru, periksa kembali inputan anda'));
	}
	
	public function updateUser($id){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->updateUser($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal mengubah user'));
		}
	}
	
	public function hapusUser(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();
		
		$id = intval(addslashes($_POST['id']));
		if ($this->M_root->hapusUser($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal menghapus data'));
		}
	}
	//end user
	
	//bagian level
	public function level(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		$data['title'] = 'Level';
		$data['page'] = 'root/v_level';
		$this->load->view('root/v_index', $data);
	}
	
	public function createLevel() {
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->createLevel())
			echo json_encode(array('success' => true));
		else
			echo json_encode(array('msg' => 'Gagal Input! Id  atau Nama Level Sudah Ada'));
	}
	
	public function updateLevel($id){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->updateLevel($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal Update! Level Sudah Ada'));
		}
	}
	
	public function hapusLevel(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();
		
		$id = intval(addslashes($_POST['id']));
		if ($this->M_root->hapusLevel($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal menghapus data'));
		}
	}
	//end level
	
	//bagian paket
	public function paket(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		$data['title'] = 'Paket';
		$data['page'] = 'root/v_paket';
		$this->load->view('root/v_index', $data);
	}
	
	public function createPaket() {
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->createPaket())
			echo json_encode(array('success' => true));
		else
			echo json_encode(array('msg' => 'Gagal Input ! Paket Sudah Ada'));
	}
	
	public function updatePaket($id){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->updatePaket($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal Update! Paket Sudah Ada'));
		}
	}
	
	public function hapusPaket(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();
		
		$id = intval(addslashes($_POST['id']));
		if ($this->M_root->hapusPaket($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal menghapus data'));
		}
	}
	//end paket
	
	//biaya
	public function biaya(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		//load m_global
		$this->load->model('M_global');
		$data['title'] = 'Biaya';
		$data['page'] = 'root/v_biaya';
		$data['paket'] = $this->M_global->getData('paket');
		$this->load->view('root/v_index', $data);
	}
	
	public function createBiaya() {
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->createBiaya())
			echo json_encode(array('success' => true));
		else
			echo json_encode(array('msg' => 'Gagal Input ! Biaya dengan paket tersebut sudah ada'));
	}
	
	public function updateBiaya($id){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();

		if ($this->M_root->updateBiaya($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal Update!'));
		}
	}
	
	public function hapusBiaya(){
		if(!$this->session->userdata('login') or ($this->session->userdata('level')!=1))
			show_404();
		if (!isset($_POST))
			show_404();
		
		$id = intval(addslashes($_POST['id']));
		if ($this->M_root->hapusBiaya($id)){
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => 'Gagal menghapus data'));
		}
	}
	
	//end biaya
	
	
	/* passing json */
	public function jsonSiswa(){
		echo $this->M_root->getJsonSiswa();
	}
	
	public function jsonSekolah(){
		echo $this->M_root->getJsonSekolah();
	} 
	
	public function jsonJadwal(){
		echo $this->M_root->getJsonJadwal();
	} 
	
	public function jsonKelas(){
		echo $this->M_root->getJsonKelas();
	} 
	
	public function jsonUser(){
		echo $this->M_root->getJsonUser();
	} 
	
	public function jsonLevel(){
		echo $this->M_root->getJsonLevel();
	} 
	
	public function jsonPaket(){
		echo $this->M_root->getJsonPaket();
	} 
	
	public function jsonBiaya(){
		echo $this->M_root->getJsonBiaya();
	} 
	
	public function tes(){
		echo preg_replace('/\s+/','',strtolower('SMAN 15 Tangerang'));
		echo $this->session->userdata('level');
	}
}

/* akhir file root/index.php */