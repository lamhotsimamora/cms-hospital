<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_spesialis extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_spesialis;
	public $spesialis;
	//

	// Definisi nama tabel
	protected $table      = 'spesialis';

	protected $primaryKey = 'id_spesialis';
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

	public function loadData_byId()
	{
		$this->db->select('*')
			->from($this->table)
			->where(['id_spesialis' => $this->id_spesialis]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data) > 0 ? $data[0] : null;
	}

	public function checkDataById()
	{
		$this->db->select('id_spesialis')
			->from($this->table)
			->where(['id_spesialis' => $this->id_spesialis]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data) > 0 ? true : false;
	}


	public function search()
	{
		$this->db->select('*')
			->from($this->table)
			->where(['spesialis' => $this->spesialis]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}


	public function updateData()
	{
		$data = array(
			'spesialis' => $this->spesialis
		);
		$this->db->where('id_spesialis', $this->id_spesialis);
		return $this->db->update($this->table, $data);
	}

	public function addData()
	{
		$data = array(
			'spesialis' => $this->spesialis
		);
		return $this->db->insert($this->table, $data);
	}

	public function searchData($search)
	{
		$this->db->select('*')
			->from($this->table)
			->like('spesialis', $search);

		$obj = $this->db->get();

		$data  = $obj->result();

		return count($data) > 0 ? $data : false;
	}

	public function delete_data()
	{
		return $this->db->delete($this->table, array('id_spesialis' => $this->id_spesialis));
	}
}
