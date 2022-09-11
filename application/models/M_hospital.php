<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_hospital extends CI_Model
{		
	// Definisi field/colomn tabel
	public $id_hospital;
	public $nama;
	public $alamat;
	public $hp;
	public $foto;
	//

	// Definisi nama tabel
	protected $table      = 'hospitals';
	protected $primaryKey = 'id_hospital';
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
		$data  = $obj->result_array();
		return count($data)>0 ? $data[0] : false;
	}

	public function loadData_byId(){
		$this->db->select('*')
			->from($this->table)
			->where(['id_hospital' => $this->id_hospital]);

		$obj = $this->db->get();
		$data  = $obj->result_array();
		return count($data)>0 ? $data[0]:null;
	}

	public function saveFoto(){
		$query = $this->db->query(
			"update hospitals set foto='".$this->foto."' 
		WHERE id_hospital=".$this->id_hospital."");
		return $query;
	}

	public function updateData()
	{
		$data = array(
			'nama' => $this->nama,
			'alamat' => $this->alamat,
			'hp' => $this->hp
		);
		$this->db->where('id_hospital', $this->id_hospital);
		return $this->db->update($this->table, $data);
	}
	
	public function delete_data(){
		return $this->db->delete($this->table, array('id_news' => $this->id_news));
	}
}
