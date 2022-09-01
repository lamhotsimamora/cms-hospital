<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_feedback extends CI_Model
{	
	// Definisi field/colomn tabel
	public $id_new;
	public $title;
	public $description;
	public $date_created;
	public $foto;
	//

	// Definisi nama tabel
	protected $table      = 'news';
	protected $primaryKey = 'id_news';
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
			->where(['id_news' => $this->id_news]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? $data[0]:null;
	}

	public function checkDataById(){
		$this->db->select('id_news')
			->from($this->table)
			->where(['id_news' => $this->id_news]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? true:false;
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


	public function save_data()
	{
		$data = array(
			'title' => $this->title,
			'description' => $this->description,
			'foto' => $this->foto
		);
		$this->db->where('id_new', $this->id_new);
		return $this->db->update($this->table, $data);
	}

	public function daftar()
	{
		$data = array(
			'title' => $this->title,
			'description' => $this->description,
			'foto' => $this->foto,
			'date_created'=>$this->date_created
		);
		return $this->db->insert($this->table, $data);
	}
	
	public function delete_data(){
		return $this->db->delete($this->table, array('id_news' => $this->id_news));
	}
}
