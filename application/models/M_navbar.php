<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_navbar extends CI_Model
{	
	// Definisi field/colomn tabel
	public $id_navbar;
	public $title;
	public $link;
	//

	// Definisi nama tabel
	protected $table      = 'navbar';
	protected $table_2      = 'navbar_child';
	protected $primaryKey = 'id_navbar';
	protected $useAutoIncrement = true;

	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	public function loadDataNavbar()
	{
		$this->db->select('*')
			->from($this->table)
			->order_by('id_navbar', 'desc');
		$obj = $this->db->get();
		return $obj->result_array();
	}

	public function loadDataNavbarChild()
	{
		$this->db->select('*')
			->from($this->table_2);
		$obj = $this->db->get();
		return $obj->result_array();
	}

	public function addData()
	{
		$data = array(
			'title' => $this->title,
			'link' => $this->link
		);
		return $this->db->insert($this->table, $data);
	}
	

	public function loadData_byId(){
		$this->db->select('*')
			->from($this->table)
			->where(['id_navbar' => $this->primaryKey]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? $data[0]:null;
	}

	public function checkDataById(){
		$this->db->select('id_navbar')
			->from($this->table)
			->where(['id_navbar' => $this->primaryKey]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? true:false;
	}

	public function updateData()
	{
		$data = array(
			'title' => $this->title,
			'link' => $this->link
		);
		$this->db->where('id_navbar', $this->id_navbar);
		return $this->db->update($this->table, $data);
	}
	
	public function delete_data(){
		return $this->db->delete($this->table, array('id_navbar' => $this->id_navbar));
	}
}
