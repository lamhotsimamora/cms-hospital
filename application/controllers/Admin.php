<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Admin extends CI_Controller
{

	public function AuthLogin()
	{
		$admin = $this->session->has_userdata('admin');
		$token = $this->session->has_userdata('token');

		if ($admin == false || $admin == null || $token == false || $token == null) {
			return false;
		} else {

			$token = $this->session->userdata('token');
			$token = $token[0]->{"token"};

			$this->M_admin->token = $token;

			if (!$this->M_admin->checkToken()) {
				$this->session->unset_userdata('admin');
				$this->session->unset_userdata('token');
				return false;
			}
		}
		return true;
	}

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index()
	{
		if ($this->AuthLogin()) {
			$this->load->view('admin/home');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function login()
	{
		if (!$this->AuthLogin()) {
			$this->load->view('admin/login');
		} else {
			$this->load->view('admin/admin');
		}
	}


	public function home()
	{
		$this->load->view('admin/home');
	}

	public function docters()
	{
		$this->load->view('admin/docters');
	}
	public function spesialis()
	{
		$this->load->view('admin/spesialis');
	}



	public function logout()
	{
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('token');
		redirect(base_url('/'));
	}

	public function api_login()
	{
		$response = array('message' => 'Login Failed', 'result' => false);

		$this->M_admin->username =  $this->input->post('username');
		$this->M_admin->password = $this->input->post('password');

		$result = $this->M_admin->login();

		if ($result) {

			$token = $this->M_admin->getToken();

			$this->session->set_userdata('admin', true);
			$this->session->set_userdata('token', $token);

			$response = array('message' => 'Login Success', 'result' => true);
		}
		echo json_encode($response);
	}

	public function api_load_data()
	{
		// if (!$this->AuthLogin()){
		// 	exit(json_encode(array('message'=>'access denied')));
		// }
		$this->load->model('M_peserta');
		$result = $this->M_peserta->loadData();

		echo json_encode($result);
	}

	public function api_search_data()
	{
		// if (!$this->AuthLogin()){
		// 	exit(json_encode(array('message'=>'access denied')));
		// }
		$this->load->model('M_peserta');
		$search = $this->M_peserta->id_peserta = $this->input->post('search');

		validationInput($search);

		$result = $this->M_peserta->searchData($search);
		echo json_encode($result);
	}


	public function api_delete_data()
	{

		// if (!$this->AuthLogin()){
		// 	exit(json_encode(array('message'=>'access denied')));
		// }
		$this->load->model('M_peserta');
		$id_peserta = $this->M_peserta->id_peserta = $this->input->post('id_peserta');

		validationInput($id_peserta);

		$result = $this->M_peserta->delete_data();
		echo json_encode($result);
	}

	public function api_load_data_docters()
	{
		$this->load->model('M_docter');

		$response['data'] = $this->M_docter->loadData();
		$response['result'] = true;

		echo json_encode($response);
	}

	public function api_load_spesialis()
	{
		$this->load->model('M_spesialis');

		$response['data'] = $this->M_spesialis->loadData();
		$response['result'] = true;

		echo json_encode($response);
	}

	public function api_add_docter()
	{
		$this->load->model('M_docter');

		$nama = $this->input->post('nama');
		$id_spesialis = $this->input->post('id_spesialis');
		$ket = $this->input->post('ket');

		validationInput($nama, $id_spesialis, $ket);

		$this->M_docter->nama = $nama;
		$this->M_docter->id_spesialis = $id_spesialis;
		$this->M_docter->ket = $ket;

		$result =  $this->M_docter->addData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_delete_docter()
	{
		$this->load->model('M_docter');

		$id_docter = $this->input->post('id_docter');

		validationInput($id_docter);

		$this->M_docter->id_docter = $id_docter;

		$result =  $this->M_docter->delete_data();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}	


	public function add(){
		$this->M_admin->add();
	}

}