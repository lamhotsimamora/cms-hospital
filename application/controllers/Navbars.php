<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Navbars extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index(){
		//if ($this->AuthLogin()){
			$this->load->view('user/home');
		//}else{
			//$this->load->view('user/login');
		//}
	}

}
