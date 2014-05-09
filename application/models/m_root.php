<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_root extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	// bagian Siswa
	public function updateSiswa($id){
		$this->db->where('id_siswa', $id);
		$id_sekolah = $this->cekIdSekolah(($this->input->post('sekolah', true)));
		return $this->db->update('siswa',array(
			'id_siswa'=> $this->input->post('id',true),
			'nama'=>$this->input->post('nama',true),
			'asal_sekolah'=>$id_sekolah,
			'telp'=>$this->input->post('telepon',true),
			'nama_wali'=>$this->input->post('wali',true),
			'telp_wali'=>$this->input->post('telp_wali',true)
		));
	}
	
	public function hapusSiswa($id){
		//hapus relasi siswa dengan data_siswa, paket, kelas, dan jadwal
		$this->db->delete('data_siswa',array('id_siswa'=>$id));
		//hapus relasi siswa dengan cicilannya
		$this->db->delete('cicilan',array('id_siswa'=>$id));
		return $this->db->delete('siswa',array('id_siswa'=>$id));
	}
	//akhir siswa
	
	//bagian sekolah
	public function createSekolah()
	{
		$nmsekolah = $this->input->post('nama',TRUE);
		if($this->cekExists('sekolah',$nmsekolah)){
			return FALSE;
		} else {
			$id = $this->getId('sekolah', 'id_sekolah');
			$this->db->insert('sekolah',array(
				'id_sekolah'=>$id,
				'nama_sekolah'=>strtoupper($nmsekolah)
			));
			return true;
		}		
	}
	
	public function updateSekolah($id){
		$nmsekolah = $this->input->post('nama', true);
		if($this->cekExists('sekolah',$nmsekolah)){
			return FALSE;
		} else {
			$this->db->where('id_sekolah', $id);
			$this->db->update('sekolah',array(
				'nama_sekolah'=>strtoupper($nmsekolah)
			));
			return TRUE;
		}
	}
	
	public function hapusSekolah($id){
		return $this->db->delete('sekolah',array('id_sekolah'=>$id));
	}
	//akhir sekolah
	
	//bagian jadwal
	public function createJadwal()
	{
		$hari = strtoupper($this->input->post('hari',TRUE));
		$jam = $this->input->post('jam',TRUE);
		//pengecekkan hari dan jam jika sama
		$query = $this->db->get_where('jadwal', array('hari'=>$hari,'jam'=>$jam));
		if($query->num_rows() != 0){
		//if($this->cekExists('jadwal',$hari)){
			return FALSE;
		} else {
			$id = $this->getId('jadwal', 'id_jadwal');
			$this->db->insert('jadwal',array(
				'id_jadwal'=>$id,
				'hari'=>$hari,
				'jam'=>$jam,
			));
			return true;
		}
		//return FALSE;	
	}
	
	public function updateJadwal($id){
		$hari = strtoupper($this->input->post('hari',TRUE));
		$jam = $this->input->post('jam',TRUE);
		//pengecekkan hari dan jam jika sama
		$query = $this->db->get_where('jadwal', array('hari'=>$hari,'jam'=>$jam));
		if($query->num_rows() != 0){
			return true;	
		} else {
			$this->db->where('id_jadwal', $id);
			$this->db->update('jadwal',array(
				'hari'=>$this->input->post('hari',true),
				'jam'=>$this->input->post('jam',true)
			));
			return TRUE;
		}
	}
	
	public function hapusJadwal($id){
		return $this->db->delete('jadwal',array('id_jadwal'=>$id));
	}
	//akhir jadwal
	
	//bagian kelas
	public function createKelas()
	{
		$nmkelas = $this->input->post('nama',TRUE);
		if($this->cekExists('kelas',$nmkelas)){
			return FALSE;
		} else {
			$id = $this->getId('kelas', 'id_kelas');
			$this->db->insert('kelas',array(
				'id_kelas'=>$id,
				'nama_kelas'=>strtoupper($nmkelas)
			));
			return true;
		}
	}
	
	public function updateKelas($id){
		$nmkelas = $this->input->post('nama',TRUE);
		if($this->cekExists('kelas',$nmkelas)){
			return FALSE;
		} else {
			$this->db->where('id_kelas', $id);
			$this->db->update('kelas',array(
				'nama_Kelas'=>strtoupper($nmkelas)
			));
			return true;
		}
	}
	
	public function hapusKelas($id){
		return $this->db->delete('kelas',array('id_kelas'=>$id));
	}
	//akhir kelas
	
	//bagian user
	public function createUser()
	{
		$this->load->model('M_global');
		$username = $this->input->post('username', TRUE);
		//cek jika username sudah ada
		$query = $this->db->get_where('user',array('username' => $username));
		
		if($query->num_rows() != 0){
			return FALSE;
		} else {
			$password = $this->M_global->setPassword($this->input->post('password', TRUE));
			$re_password = $this->M_global->setPassword($this->input->post('re_password', TRUE));
			//cek password dan re_password sesuai atau tidak
			if($password != $re_password){
				return FALSE;
			} else {
				$id = $this->getId('user', 'id_user');
				$this->db->insert('user',array(
					'id_user'=>$id,
					'nama_lengkap'=>$this->input->post('nama_lengkap', true),
					'username'=> $username,
					'password'=>$password,
					'level'=>$this->input->post('level', true)
				));
			}
			
			return TRUE;
		}
		//return true;
	}
	
	public function updateUser($id){
		
		$this->load->model('M_global');	
		$username = $this->input->post('username', TRUE);
		
		$password = $this->M_global->setPassword($this->input->post('password',true));
		$re_password = $this->M_global->setPassword($this->input->post('re_password', TRUE));
		//$query = $this->db->get_where('level',array('nama_level'=>));
		//$tmp = $query->row();
		
		if($password != $re_password){
			return false;
		} else {
			
			$this->db->where('id_user', $id);
			$this->db->update('user',array(
				'nama_lenkap'=>$this->input->post('nama_lengkap'),
				'username'=> $username,
				'password'=>$password,
				'level'=>$this->input->post('level', true)
			));
			return TRUE;
		}
		
		//return true;
	}
	
	public function hapusUser($id){
		return $this->db->delete('user',array('id_user'=>$id));
	}
	//akhir user
	
	//bagian level
	public function createLevel()
	{
		$tmp_level = $this->input->post('nama',TRUE);
		
		if($this->cekExists('level',$tmp_level)){
			return FALSE;
		} else {
			$id = $this->getId('level', 'id_level');		
			$this->db->insert('level',array(
				'id_level'=>$id,
				'nama_level'=>$tmp_level
			));
			return TRUE;
		}
	}
	
	public function updateLevel($id){
		$tmp_level = $this->input->post('nama', TRUE);
		
		if($this->cekExists('level', $tmp_level)){
			return false;
		} else {
			$this->db->where('id_level', $id);
			$this->db->update('level',array(
				'nama_level'=>$tmp_level
			));
			return true;
		}
	}
	
	public function hapusLevel($id){
		return $this->db->delete('level',array('id_level'=>$id));
	}
	//akhir level
	
	//bagian paket
	public function createPaket()
	{
		$nmpaket = $this->input->post('nama',TRUE);
		if($this->cekExists('paket',$nmpaket)){
			return FALSE;
		} else {
			$id = $this->getId('paket', 'id_paket');
			$this->db->insert('paket',array(
				'id_paket'=>$id,
				'nama_paket'=>strtoupper($nmpaket)
			));
			return true;
		}		
	}
	
	public function updatePaket($id){
		$nmpaket = $this->input->post('nama', true);
		if($this->cekExists('paket',$nmpaket)){
			return FALSE;
		} else {
			$this->db->where('id_paket', $id);
			$this->db->update('paket',array(
				'nama_paket'=>strtoupper($nmpaket)
			));
			return TRUE;
		}
	}
	
	public function hapusPaket($id){
		return $this->db->delete('paket',array('id_paket'=>$id));
	}
	//akhir paket
	
	//bagian biaya
	public function createBiaya()
	{
		$id = $this->getId('biaya', 'id_biaya');
		$this->db->insert('biaya',array(
			'id_biaya'=>$id,
			'total_biaya'=>$this->input->post('total',TRUE),
			'id_paket'=>$this->input->post('paket',TRUE),
			'discount'=>$this->input->post('discount',TRUE),
			'dp'=>$this->input->post('dp',TRUE),
			'cash_back'=>$this->input->post('cb',TRUE),
			'ang_1'=>$this->input->post('a_1',TRUE),
			'ang_2'=>$this->input->post('a_2',TRUE),
			'ang_3'=>$this->input->post('a_3',TRUE),
			'ang_4'=>$this->input->post('a_4',TRUE)
		));
		return true;
			
	}
	
	public function updateBiaya($id){
		$query = $this->db->get_where('paket',array('nama_paket'=>$this->input->post('paket', true)));
		$tmp = $query->row();
		
		$this->db->where('id_biaya', $id);
		$this->db->update('biaya',array(
			'id_paket'=>$tmp->id_paket,
			'total_biaya'=>$this->input->post('total',true),
			'discount'=>$this->input->post('discount',true),
			'dp'=>$this->input->post('dp',true),
			'cash_back'=>$this->input->post('cb',true),
			'ang_1'=>$this->input->post('a_1',true),
			'ang_2'=>$this->input->post('a_2',true),
			'ang_3'=>$this->input->post('a_3',true),
			'ang_4'=>$this->input->post('a_4',true)
		));
		return TRUE;
		
	}
	
	public function hapusBiaya($id){
		return $this->db->delete('biaya',array('id_biaya'=>$id));
	}
	//akhir biaya
	
	
	
	/* get json */
	public function getJsonSiswa(){
		$result = array();
		$criteria = $this->db->get('siswa');
		
		foreach($criteria->result_array() as $data)
		{
			$tmp_link = "<a href='".base_url()."all_access/siswa/".$data['id_siswa']."'>".$data['nama']."</a>";//.base_url().'all_access/siswa/'.$data['id']."'>".$data['nama']."</a>";
			//$tmp_link = 'tes';
			$sekolah = $this->getNamaSekolah($data['asal_sekolah']);
			$row[] = array(
				'id'=>$data['id_siswa'],
				'jenis_kelamin'=>$data['jenis_kelamin'],
				'nama'=>$data['nama'],
				'nama_link'=>$tmp_link,
				'tgl_lahir'=>$data['tgl_lahir'],
				'sekolah'=>$sekolah,
				'telepon'=>$data['telp'],
				'wali'=>$data['nama_wali'],
				'telp_wali'=>$data['telp_wali'],
				'alamat' => $data['alamat']
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	public function getJsonSekolah(){
		$result = array();
		$criteria = $this->db->get('sekolah');
		
		foreach($criteria->result_array() as $data)
		{
			$row[] = array(
				'id'=>$data['id_sekolah'],
				'nama'=>$data['nama_sekolah']
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	public function getJsonJadwal(){
		$result = array();
		$criteria = $this->db->get('jadwal');
		
		foreach($criteria->result_array() as $data)
		{
			$row[] = array(
				'id'=>$data['id_jadwal'],
				'hari'=>$data['hari'],
				'jam'=>$data['jam']
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	public function getJsonKelas(){
		$result = array();
		$criteria = $this->db->get('kelas');
		
		foreach($criteria->result_array() as $data)
		{
			$row[] = array(
				'id'=>$data['id_kelas'],
				'nama'=>$data['nama_kelas']
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	public function getJsonUser(){
		$result = array();
		$criteria = $this->db->get('user');
		
		foreach($criteria->result_array() as $data)
		{
			$level = $this->getNamaLevel($data['level']);
			$status = $this->cekStatus($data['status']);
			$row[] = array(
				'nama_lengkap'=>$data['nama_lengkap'],
				'id'=>$data['id_user'],
				'username'=>$data['username'],
				'status'=>$status,
				'level'=>$level
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	
	public function getJsonLevel(){
		$result = array();
		$criteria = $this->db->get('level');
		
		foreach($criteria->result_array() as $data)
		{
			$row[] = array(
				'id'=>$data['id_level'],
				'nama'=>$data['nama_level']
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	public function getJsonPaket(){
		$result = array();
		$criteria = $this->db->get('paket');
		
		foreach($criteria->result_array() as $data)
		{
			$row[] = array(
				'id'=>$data['id_paket'],
				'nama'=>$data['nama_paket']
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	public function getJsonBiaya(){
		$result = array();
		$criteria = $this->db->get('biaya');
		
		foreach($criteria->result_array() as $data) {
			$paket_query = $this->db->get_where('paket',array('id_paket'=>$data['id_paket']));
			$tmp = $paket_query->row();
			$row[] = array(
				'id'=>$data['id_biaya'],
				'total'=>$data['total_biaya'],
				'paket'=>$tmp->nama_paket,
				'discount'=>$data['discount'],
				'dp'=>$data['dp'],
				'cb'=>$data['cash_back'],
				'a_1'=>$data['ang_1'],
				'a_2'=>$data['ang_2'],
				'a_3'=>$data['ang_3'],
				'a_4'=>$data['ang_4']
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	
	//end json
	//get nama sekolah
	private function getNamaSekolah($id){
		$query = $this->db->get_where('sekolah', array('id_sekolah' => $id));
		$jumlah = $query->num_rows();
		$tmp = $query->row();
		$sekolah = '';
		if($jumlah != 0){
			$sekolah = $tmp->nama_sekolah;
		} else {
			$sekolah = 'Sekolah Tidak Terdeteksi';
		}
		return $sekolah;
	}
	
	//cek sekolah sudah ada atau belum
	private function cekExists($tabel,$nama){
		$tmp = strtolower(preg_replace('/\s+/', '', $nama));
		$sql = "select * from $tabel where replace(lower(nama_$tabel),' ','') = '$tmp'";	
		$query = $this->db->query($sql);
		if($query->num_rows() != 0){
			return true;
		} else {
			return false;
		}		
	}
	
	//cek exist custom
	private function cekExistCustom($tabel, $record=array()){
		$sql = "select * from $tabel where $record[1] = $record[2] or $record[3] = '$record[4]'";
		$query = $this->db->query($sql);
		
		if($query->num_rows() != 0){
			return TRUE;
		}  else {
			return FALSE;
		}
		
	}
	
	//cek level untuk update
	private function setLevel($level){
		$query = $this->db->get_where('level',array('nama_level'=>$level));
		$tmp = $query->row();
		return $tmp->id_level;
	}
	
	
	//cek status
	private function cekStatus($id){
		if($id == 1){
			return "Aktif";
		} else {
			return "Tidak Aktif";
		}
	}
	
	private function getNamaLevel($id){
		$query = $this->db->get_where('level', array('id_level' => $id));
		$jumlah = $query->num_rows();
		$tmp = $query->row();
		$level = '';
		if($jumlah != 0){
			$level = $tmp->nama_level;
		} else {
			$level = 'Level Tidak Terdeteksi';
		}
		return $level;
	}
	
	public function getLevel(){
		return $this->db->get('level');
	}
	
	//get id dengan nilai terbesar
	private function getId($tabel,$column){
		$this->db->select_max($column,'tmp');
		$query = $this->db->get($tabel)->row();
		$tmp = $query->tmp + 1;
		return $tmp;
		
	}
		
}
