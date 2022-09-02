<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Users extends CI_Controller {

	public function AuthLogin(){
		$admin = $this->session->has_userdata('admin');
		$token = $this->session->has_userdata('token');
		
		if ($admin==false || $admin ==null || $token == false || $token == null)
		{
			return false;
		}else{
			
			$token = $this->session->userdata('token');
			$token = $token[0]->{"token"};

			$this->M_admin->token = $token;
		
			if (!$this->M_admin->checkToken()){
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
		$this->load->model('M_user');
		$this->load->model('M_navbar');
	}

	public function index(){
		//if ($this->AuthLogin()){
			
			$data['data_navbar'] = $this->loadDataNavbar();
			$data['data_navbar_child'] = $this->loadDataNavbarChild();
			$this->load->view('user/home',$data);
		//}else{
			//$this->load->view('user/login');
		//}
	}

	private function loadDataNavbar(){
		return ($this->M_navbar->loadDataNavbar());
	}

	private function loadDataNavbarChild(){
		return ($this->M_navbar->loadDataNavbarChild());
	}

	public function login(){
		if (!$this->AuthLogin()){
			$this->load->view('user/login');
		}else{
			$this->load->view('user/admin');
		}
	}

	

	public function home(){
		if ($this->AuthLogin()){
			$this->load->view('user/home');
		}
		else{
			$this->load->view('user/login');
		}
	}


	public function logout(){
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('token');
		redirect(base_url('/'));
	}

	public function api_login()
	{
		$response = array('message'=>'Login Failed','result'=>false);

		$this->M_admin->username =  $this->input->post('username');
		$this->M_admin->password = $this->input->post('password');

		$result = $this->M_admin->login();
		
		if ($result){

			$token= $this->M_admin->getToken();
	
			$this->session->set_userdata('admin',true);
			$this->session->set_userdata('token',$token);

			$response = array('message'=>'Login Success','result'=>true);
		}
		echo json_encode($response);
	}

	public function api_load_data()
	{
		if (!$this->AuthLogin()){
			exit(json_encode(array('message'=>'access denied')));
		}
		$this->load->model('M_peserta');
		$result = $this->M_peserta->loadData();

		echo json_encode($result);
	}

	public function api_search_data(){
		if (!$this->AuthLogin()){
			exit(json_encode(array('message'=>'access denied')));
		}
		$this->load->model('M_peserta');
		$search = $this->M_peserta->id_peserta = $this->input->post('search');
	
		validationInput($search);

		$result = $this->M_peserta->searchData($search);
		echo json_encode($result);
	}

		
	public function api_delete_data(){

		if (!$this->AuthLogin()){
			exit(json_encode(array('message'=>'access denied')));
		}
		$this->load->model('M_peserta');
		$id_peserta=$this->M_peserta->id_peserta = $this->input->post('id_peserta');
	
		validationInput($id_peserta);

		$result = $this->M_peserta->delete_data();
		echo json_encode($result);
	}

}

