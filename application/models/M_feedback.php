<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_feedback extends CI_Model
{	
	// Definisi field/colomn tabel
	public $id_feedback;
	public $rating;
	//

	// Definisi nama tabel
	protected $table      = 'feedback';
	protected $primaryKey = 'id_rating';
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
			->where(['id_feedback' => $this->primaryKey]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? $data[0]:null;
	}


	public function add()
	{
		$data = array(
			'rating' => $this->rating
		);
		return $this->db->insert($this->table, $data);
	}
	
	public function delete_data(){
		return $this->db->delete($this->table, array('id_feedback' => $this->id_feedback));
	}
}
