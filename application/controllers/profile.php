<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_global');
	}
	
	public function index(){
		if(!$this->session->userdata('login'))
			show_404();
		
		$data = array();
		$data['title'] = 'Profile';
		if($this->session->userdata('level') == 1){
			$data['page'] = 'root/v_header';
		} else {
			$data['page'] = 'admin/v_header';
		}
		
		$this->load->view('v_profile_user', $data);
	}
	
	//update password
	public function updatePassword(){
		
		if(!$this->session->userdata('login'))
			show_404();
		if (!isset($_POST))
			show_404();

		//$tes = FALSE;
		if ($this->M_global->updatePassword()){
			echo json_encode(array('success' => true));
		} else {
			//echo json_encode(array('msg' => $this->M_global->updatePassword()));
			echo json_encode(array('msg' => 'Gagal mengubah password, periksa kembali inputan anda !'));
		
		}
	}
	
}