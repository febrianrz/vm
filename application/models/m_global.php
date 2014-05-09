<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * File ini untuk keperluan akses global yang dapat dilakukan oleh
 * admin ataupun pegawai biasa
 */

class M_global extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function updatePassword(){
		$cur = $this->setPassword($this->input->post('cu_password', TRUE));
		$new = $this->setPassword($this->input->post('new_password', TRUE));
		$re = $this->setPassword($this->input->post('re_password', TRUE));
		
		
		if($cur != $this->getPassword()){
			return FALSE;
		} else {
			if($new != $re){
				return FALSE;
			} else {
				$this->db->where('username', $this->session->userdata('user'));
				$this->db->update('user',array(
					'password'=> $new
				));
				return TRUE;
			}
		}
		//return $cur;
	}
	
	//encrypt password menjadi SHA1
	function setPassword($string){
		return $this->encrypt->sha1($string);
	}
	
	//get current password
	function getPassword(){
		$query = $this->db->get_where('user', array('username' => $this->session->userdata('user')));
		$tmp = $query->row();
		return $tmp->password;
	}
	
	function getData($name){
		return $this->db->get($name);
	}
	
	/*--------------- Bagian Form Pemdaftaran Siswa -----------------*/
	public function saveSiswa(){
		$data['nama']= $this->input->post('nama', TRUE);
		$data['jkel']= $this->input->post('jkel', TRUE);
		//setting format tanggal tahun-bulan-tanggal
		$data['tgl_lahir'] = $this->input->post('tgl_lahir', TRUE);
		$data['alamat'] = $this->input->post('alamat', TRUE);
		$data['asal_sekolah'] = $this->input->post('asal_sekolah', TRUE);
		$data['telp'] = $this->input->post('telp', TRUE);
		$data['nama_wali'] = $this->input->post('nama_wali', TRUE);
		$data['telp_wali'] = $this->input->post('telp_wali', TRUE);
		
		$this->session->set_userdata($data);
	}
	
	public function saveKelas(){
		$data['kelas']= $this->input->post('kelas', TRUE);
		$data['jadwal'] = $this->input->post('jadwal', TRUE);
				
		$this->session->set_userdata($data);
	}
	
	public function saveAdministrasi(){
		$data['paket']= $this->input->post('paket', TRUE);
		$data['bayar'] = $this->input->post('bayar', TRUE);
		$data['biaya']= $this->input->post('uang_muka', TRUE);
				
		$this->session->set_userdata($data);
	}
	
	public function validasi(){
		$data['nama'] = $this->input->post('nama', TRUE);
		$data['tgl_lahir'] = $this->input->post('tgl_lahir', TRUE);
		$data['asal_sekolah'] = $this->input->post('asal_sekolah', TRUE);
		$data['telp'] = $this->input->post('telp', TRUE);
		$data['nama_wali'] = $this->input->post('nama_wali', TRUE);
		$data['telp_wali'] = $this->input->post('telp_wali', TRUE);
		
		return $data;
	}

	//mengambil string / nama dari id
	public function getName($id, $tabel){
		$column = "id_".$tabel;
		
		$query = $this->db->get_where($tabel,array($column => $id));
		$tmp = $query->row();
		
		return $tmp;
	}
	
	//masuk database siswa
	public function inputSiswa(){
		if(!$this->session->userdata('login'))
			show_404();
		if (!isset($_POST))
			show_404();
		
		//data siswa
		$nama_siswa = $this->session->userdata('nama');
		$tgl_lahir = $this->format_tanggal($this->session->userdata('tgl_lahir'));
		$asal_sekolah = $this->session->userdata('asal_sekolah');
		$telp_siswa = $this->session->userdata('telp');
		$alamat = $this->session->userdata('alamat');
		$nama_wali = $this->session->userdata('nama_wali');
		$telp_wali = $this->session->userdata('telp_wali');
		$jkel = $this->session->userdata('jkel');
		
		$tmp_sklh = $this->getSekolah($asal_sekolah);
		
		
		$this->db->insert('siswa',array(
			'nama'=>$nama_siswa,
			'tgl_lahir'=>$tgl_lahir,
			'asal_sekolah'=>$tmp_sklh,
			'telp' => $telp_siswa,
			'nama_wali' => $nama_wali,
			'telp_wali' => $telp_wali,
			'alamat' => $alamat,
			'jenis_kelamin' => $jkel		
		));
		
		//masuk siswa dan relasinya dengan kelas, paket dan jadwal
		$this->db->insert('data_siswa',array(
			'id_siswa'=>$this->getNewSiswa(),
			'id_kelas'=>$this->session->userdata('kelas'),
			'id_jadwal'=>$this->session->userdata('jadwal'),
			'id_paket'=>$this->session->userdata('paket')
		));
		
		$tmp_biaya = 1	;
		//simpan session sementara id siswa baru
		$this->session->set_userdata(array('id_new'=>$this->getNewSiswa()));
		
		//masuk siswa dan relasisnya dengan biaya
		//cek apakah membayar cash atau kredit
		if($this->session->userdata('bayar') == 'cash'){
			//cek jenis paket dan ketika angsuran pertama = 0 yg menandakan bayar cash
			$tmp_query = $this->db->get_where('biaya',array(
							'id_paket'=>$this->session->userdata('paket'),
							'ang_1'=>0
						));
			$tmp_result = $tmp_query->row();
			$tmp_biaya = $tmp_result->id_biaya;
			
		} else {
			//kalau bayarnya kredit langsung copas dari session biaya
			$tmp_biaya = $this->session->userdata('biaya');
			
		}
		//memasukkan data ketabel cicilan siswa
		$this->insertCicilan($tmp_biaya);
		
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	//insert cicilan
	private function insertCicilan($biaya){
		if($this->session->userdata('bayar') == 'cash' or $this->session->userdata('bayar') == ''){
			$this->db->insert('cicilan', array(
				'id_siswa'=>$this->getNewSiswa(),
				'id_biaya'=>$biaya,
				'ang_1'=>'y',
				'ang_2'=>'y',
				'ang_3'=>'y',
				'ang_4'=>'y'
			));
		} else {
			//memasukkan data ketabel cicilan siswa
			$this->db->insert('cicilan', array(
				'id_siswa'=>$this->getNewSiswa(),
				'id_biaya'=>$biaya
			));
		}
	}
	
	//memasukkan foto
	public function insertFoto(){
		$this->db->where('id_siswa',$this->session->userdata('id_new'));
		$this->db->update('siswa', array(
			'foto'=>$this->session->userdata('img_nm')
		));
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	//atur biaya
	public function getBiaya($id){
		
		$id_paket = $this->session->userdata('paket');
		$tmp = array();
		if($id == ""){
			$query = $this->db->get_where('biaya', array('id_paket' => $id_paket, 'ang_1' => 0));
			$tmp = $query->row();
		} else {
			$query = $this->db->get_where('biaya',array('id_biaya' => $id, 'id_paket' => $id_paket));
			$tmp = $query->row();
		}
		
		return $tmp;
	}
	
	public function getRincian(){
		$result = array();
		$id_biaya = $this->session->userdata('biaya');
		$criteria = $this->db->get_where('biaya',array('id_biaya' => $id_biaya));
		$tmp = $criteria->row();
	
		$paket_query = $this->db->get_where('paket', array('id_paket' => $tmp->id_paket));
		$tmp_paket = $paket_query->row();
		$row[] = array(
			'id'=>$tmp->id_biaya,
			'total'=>number_format($tmp->total_biaya,2,',','.'),
			'paket'=>$tmp_paket->nama_paket,
			'discount'=>number_format($tmp->discount,2,',','.'),
			'dp'=>number_format($tmp->dp,2,',','.'),
			'cb'=>number_format($tmp->cash_back,2,',','.'),
			'a_1'=>number_format($tmp->ang_1,2,',','.'),
			'a_2'=>number_format($tmp->ang_2,2,',','.'),
			'a_3'=>number_format($tmp->ang_3,2,',','.'),
			'a_4'=>number_format($tmp->ang_4,2,',','.')
		);
		
		$result=array_merge($result,array('rows'=>$row));
		return json_encode($result);
	}
	
	
	 private function format_tanggal($date){
		//mengatur format tanggal sesuai database tahun-tanggal-bulan
		//$hasil = date("Y-m-d", strtotime($date));	
		$exp = explode('/',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		
		return $date;
	}
	
	//cek sekolah, jika sekolah baru maka masuk database, jika tidak, hanya ambil id saja
	private function getSekolah($nm_sklh){
		$query = $this->db->get_where('sekolah', array('nama_sekolah' => $nm_sklh));
		$jumlah = $query->num_rows();
		$tmp = $query->row();
		$id_sekolah = 0;
		if($jumlah != 0){
			//$sekolah = $tmp->nama_sekolah;
			$id_sekolah = $tmp->id_sekolah;
		} else {
			$in_new = $this->db->insert('sekolah',array(
				      'nama_sekolah'=>strtoupper($nm_sklh),	
				  ));
			$get_sklh = $this->db->get_where('sekolah', array('nama_sekolah' => $nm_sklh));
			$jumlah_sklh = $get_sklh->num_rows();
			$tmp_2 = $get_sklh->row();
			$id_sekolah = $tmp_2->id_sekolah;
			//$sekolah = 'Sekolah Tidak Terdeteksi';
		}
		return $id_sekolah;
	}
	
	//ambil id_siswa baru daftar
	private function getNewSiswa(){
		$this->db->order_by('tgl_daftar','desc');
		$tmp = $this->db->get('siswa');
		$result = $tmp->row();
		
		return $result->id_siswa;
	}
	
	public function getNamaId($tabel, $column, $key, $balik){
		$query = $this->db->get_where($tabel, array($column => $key));
		$tmp = $query->row();
		
		return $tmp->$balik;
	}	
	
	public function insertFotoUser(){
		$this->db->where('username', $this->session->userdata('user'));
		$this->db->update('user',array(
			'foto'=> $this->session->userdata('foto_nm')
		));
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	//ambil record-record
	private function getRecord($tabel,$key){
		$tmp = "id_".$tabel; 
		$query = $this->db->get_where($tabel, array($tmp => $key));
		return $query->row();
	}
	
	//dengan menentukan kolom dengan primary key sendiri
	private function getRecords($tabel,$key,$kolom){
		$query = $this->db->get_where($tabel, array($kolom => $key));
		return $query->row();
	}
	
	//check user dengan id tertentu
	public function checkId($tabel,$kolom,$id){
		$query = $this->db->get_where($tabel, array($kolom=> $id));
		if($query->num_rows() != 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	//json data rincian siswa
	public function getJsonRincianSiswa($id){
		$siswa = $this->getRecord('siswa',$id);
		$sekolah = $this->getRecord('sekolah', $siswa->asal_sekolah);
		
		$tmp = $this->getRecords('data_siswa', $id, 'id_siswa');
		
		$kelas = $this->getRecord('kelas', $tmp->id_kelas);
		$paket = $this->getRecord('paket', $tmp->id_paket);
		
		//cicilan
		$cicilan = $this->getRecords('cicilan', $id, 'id_siswa');
		$biaya = $this->getRecords('biaya', $cicilan->id_biaya, 'id_biaya');
		
		$arr_user = array(
		 	'id' => $id,
		 	'nama' => $siswa->nama,
		 	'tgl_lahir' => $siswa->tgl_lahir,
		 	'jkel' => $siswa->jenis_kelamin,
		 	'sekolah' => $sekolah->nama_sekolah,
			'telp' => $siswa->telp,
			'kelas' => $kelas->nama_kelas,
			'paket' => $paket->nama_paket,
			'foto' => $siswa->foto,
			'discount'=> $biaya->discount,
			'dp' => $biaya->dp,
			'cb' => $biaya->cash_back,
			'ang_1' => $biaya->ang_1,
			'ang_2' => $biaya->ang_2,
			'ang_3' => $biaya->ang_3,
			'ang_4' => $biaya->ang_4,
			'total' => $biaya->total_biaya,
			'cicilan_1' => $cicilan->ang_1,
			'cicilan_2' => $cicilan->ang_2,
			'cicilan_3' => $cicilan->ang_3,
			'cicilan_4' => $cicilan->ang_4	
		 );
		 return json_encode($arr_user);
	}
	
	
	
	// bagian data user -------------
	public function getDataUser(){
		$query = $this->db->get_where('user', array('username'=>$this->session->userdata('user')));
		$result = $query->row();
		
		$arr_user = array(
			//'success'=>'true',
			'username'=>$result->username,
			//'status'=>$result->status,
			'level'=>$result->level,
			//'id'=>$result->id_user,
			'nama'=>$result->nama_lengkap,
			'foto'=>$result->foto
		);
		
		return json_encode($arr_user);
		//echo "getRecord";
	}
}


/* AKhir file m_global.php */