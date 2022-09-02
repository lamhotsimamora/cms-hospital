<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_page extends CI_Model
{
	// Definisi field/colomn tabel
	public $id_page;
	public $title;
	public $description;
	public $cover;
	public $date_created;
	public $time_created;
	//

	// Definisi nama tabel
	protected $table      = 'page';

	protected $primaryKey = 'id_page';
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
			->where(['id_page' => $this->id_page]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data) > 0 ? $data[0] : null;
	}

	public function checkDataById()
	{
		$this->db->select('id_page')
			->from($this->table)
			->where(['id_page' => $this->id_page]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data) > 0 ? true : false;
	}

	public function getIdPost()
	{
		$this->db->select('id_page')
			->from($this->table)
			->where(['id_page' => $this->id_page]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? $data[0] : false;
	}

	public function search()
	{
		$this->db->select('*')
			->from($this->table)
			->where(['title' => $this->title]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}


	public function updateData()
	{
		$data = array(
			'title' => $this->title,
			'description' => $this->description,
			'cover' => $this->cover,
			'date_created' => $this->date_created,
			'time_created' => $this->time_created,
		);
		$this->db->where('id_page', $this->id_page);
		return $this->db->update($this->table, $data);
	}

	public function addData()
	{
		$data = array(
			'title' => $this->title,
			'description' => $this->description,
			'cover' => $this->cover,
			'date_created' => $this->date_created,
			'time_created' => $this->time_created,
		);
		return $this->db->insert($this->table, $data);
	}

	public function searchData($search)
	{
		$this->db->select('*')
			->from($this->table)
			->like('title', $this->title);

		$obj = $this->db->get();

		$data  = $obj->result();

		return count($data) > 0 ? $data : false;
	}

	public function delete_data()
	{
		return $this->db->delete($this->table, array('id_page' => $this->id_page));
	}
}