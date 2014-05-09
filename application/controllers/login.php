<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_login');
	}
	
	public function index(){
		//echo "tes";
		//$this->load->view('v_login');
		
		if($this->uri->total_segments() == 0){
			redirect(base_url('login'),'refresh');
			//echo base_url('login');
		}
		//echo $this->uri->total_segments();
		if($this->session->userdata("login") == FALSE){
			$this->load->view('v_login');
			//echo "false";
		} else {
			//echo "bisa";
			if($this->session->userdata('level') == 1){
				redirect(base_url('root/index'));
			} else {
				redirect(base_url('administrator/home'));
			}
		}
	}
	
	public function cek_login(){
		if($this->M_login->login()){
			if($this->session->userdata('level') == 1){
				echo 'root/index';
			} else {
				echo 'administrator/home';
			}
		} else {
			echo 'false';
		}
	}
	
	// untuk logout, hapus semua session
	public function logout(){
		$this->M_login->setStatus($this->session->userdata('user'), 0);
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
	
	public function jsonBackground(){
		//harus direquest, gaboleh direct
		if($this->input->post('req', true) == true){
			$gambar = array(
				0=>'satu',
				1=>'dua',
				2=>'tiga',
				3=>'empat',
				4=>'lima',
				5=>'enam'
			);
			$row = array();
			for($i = 0; $i <= 5; $i++){
				$array[] = array(
					'tes'=>$gambar[$i]
				);
			}
			$row = array_merge($row,array('row'=>$array));
		
			echo json_encode($row);
		} else {
			//echo "maaf,";
			show_404();
		}
	}
}

/* Akhir file login.php */
