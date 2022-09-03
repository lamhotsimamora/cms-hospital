<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_docter extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_docter;
	public $nama;
	public $id_spesialis;
	public $foto;
	public $ket;
	//

	// Definisi nama tabel
	protected $table      = 'docters';
	protected $view      = 'view_docters';

	protected $primaryKey = 'id_docter';
	protected $useAutoIncrement = true;

	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	public function loadData()
	{
		$this->db->select('*')
			->from($this->view);
		$obj = $this->db->get();
		$data  = $obj->result_array();
		return $data;
	}

	public function loadData_byId()
	{
		$this->db->select('*')
			->from($this->table)
			->where(['id_docter' => $this->id_docter]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data) > 0 ? $data[0] : null;
	}

	public function checkDataById()
	{
		$this->db->select('id_docter')
			->from($this->table)
			->where(['id_docter' => $this->id_docter]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data) > 0 ? true : false;
	}

	public function getIdDocter()
	{
		$this->db->select('id_docter')
			->from($this->table)
			->where(['id_docter' => $this->id_docter]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? $data[0] : false;
	}

	public function search()
	{
		$this->db->select('*')
			->from($this->table)
			->where(['nama' => $this->nama]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}

	public function saveFoto(){
		$query = $this->db->query(
			"update docters set foto='".$this->foto."' 
		WHERE id_docter=".$this->id_docter."");
		return $query;
	}

	public function updateData()
	{
		$data = array(
			'nama' => $this->nama,
			'id_spesialis' => $this->id_spesialis,
			'ket' => $this->ket
		);
		$this->db->where('id_docter', $this->id_docter);
		return $this->db->update($this->table, $data);
	}

	public function addData()
	{
		$data = array(
			'nama' => $this->nama,
			'id_spesialis' => $this->id_spesialis,
			'ket' => $this->ket
		);
		return $this->db->insert($this->table, $data);
	}

	public function searchData($search)
	{
		$this->db->select('*')
			->from($this->table)
			->like('nama', $search);

		$obj = $this->db->get();

		$data  = $obj->result();

		return count($data) > 0 ? $data : false;
	}

	public function delete_data()
	{
		return $this->db->delete($this->table, array('id_docter' => $this->id_docter));
	}
}
