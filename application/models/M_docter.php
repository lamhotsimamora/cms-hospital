<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_docter extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_docter;
	public $name;
	public $id_spesialis;
	public $ket;
	//

	// Definisi nama tabel
	protected $table      = 'docters';
	protected $primaryKey = 'id_docter';
	protected $useAutoIncrement = true;

	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	public function loadData()
	{
		$this->db->select('*')
			->from($this->table);
		$obj = $this->db->get();
		$data  = $obj->result();
		return $data;
	}

	public function loadData_byId(){
		$this->db->select('*')
			->from($this->table)
			->where(['id_peserta' => $this->id_peserta]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? $data[0]:null;
	}

	public function checkDataById(){
		$this->db->select('id_peserta')
			->from($this->table)
			->where(['id_peserta' => $this->id_peserta]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? true:false;
	}

	

	public function getIdDocter(){
		$this->db->select('id_docter')
			->from($this->table)
			->where(['token' => $this->token]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? $data[0] : false;
	}

	public function search()
	{
		$this->db->select('*')
			->from($this->table)
			->where(['nama_lengkap' => $this->nama_lengkap]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}

	

	public function save_data()
	{
		$data = array(
			'nama_lengkap' => $this->nama_lengkap,
			'agama' => $this->agama
			
		);
		$this->db->where('id_peserta', $this->id_peserta);
		return $this->db->update($this->table, $data);
	}

	public function daftar()
	{
		$data = array(
			'username' => $this->username,
			'password' => _md5($this->password),
			'token' => createTokenPeserta($this->username),
			'tgl_daftar'=>_getDate()
		);
		return $this->db->insert($this->table, $data);
	}

	public function searchData($search){
		$this->db->select('*')
		->from($this->table)
		->like('nama_lengkap' ,$search);

		$obj = $this->db->get();

		$data  = $obj->result();

		return count($data)>0 ? $data : false;
	}

	public function checkUsername(){
		$this->db->select('id_peserta')
			->from($this->table)
			->where(['username' => $this->username]);

		$obj = $this->db->get();

		$data  = $obj->result();

		return count($data)>0 ? true : false;
	}

	public function checkToken()
	{
		$this->db->select('id_peserta')
			->from($this->table)
			->where(['token' => $this->token]);

		$obj = $this->db->get();

		$data  = $obj->result();

		return count($data)>0 ? true : false;
	}

	public function getToken()
	{
		$this->db->select('token')
			->from($this->table)
			->where(['username' => $this->username, 'password' => _md5($this->password)]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return $data;
	}
	
	public function add()
	{
		$data = array(
			'nama_lengkap' => $this->nama_lengkap,
			'alamat' => $this->alamat,
			'kartu_keluarga' => $this->kartu_keluarga
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{
		$data = array(
			'nama_lengkap' => $this->nama_lengkap,
			'alamat' => $this->alamat,
			'kartu_keluarga' => $this->kartu_keluarga
		);
		$this->db->where('id_peserta', $this->id_peserta);
		return $this->db->update($this->table, $data);
	}

	public function delete_data(){
		return $this->db->delete($this->table, array('id_peserta' => $this->id_peserta));
	}
}
