<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * query untuk cek username dan password untuk login
 */


class M_login extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_global');
	}
	
	function login(){
		$username = $this->input->post('username', TRUE);
		$password = $this->M_global->setPassword($this->input->post('password', TRUE));
		
		$query = $this->db->get_where('user', array('username' => $username,'password' => $password));
		$tmp = $query->row();
		if($query->num_rows() != 0){
			$this->session->set_userdata('login', TRUE);
			$this->session->set_userdata('user', $username);
			$this->session->set_userdata('level', $tmp->level );
			$this->session->set_userdata('date_login', date('d-m-20y h:i:s')  );
			$this->setStatus($username, 1);
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	//setup active status
	public function setStatus($id,$st){
		$this->db->where('username', $id);
		$this->db->update('user',array(
			'status'=> $st
		));
	}
	
}
