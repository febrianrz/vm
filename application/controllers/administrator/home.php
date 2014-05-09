<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	function index(){
		if(!$this->session->userdata('login')){
			redirect(base_url('login'));
		}
		
		$data['title'] = 'belajar passing';
		$data['page'] = 'admin/v_home';
		$this->load->view('admin/vmain_admin',$data);
	}
	
	function daftar(){
		if(!$this->session->userdata('login')){
			redirect(base_url('login'));
		}
		
		$data['title'] = 'Daftar';
		$data['page'] = 'v_daftar_siswa';
		
		$this->load->view('admin/vmain_admin', $data);
	}
}
	