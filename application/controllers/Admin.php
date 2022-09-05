<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Admin extends CI_Controller
{	
	private $data;

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
		$this->load->model('M_hospital');
		$this->data['data_hospital'] = $this->loadDataHospital();
	}

	private function loadDataHospital(){
		$this->M_hospital->id_hospital = 1;
		return $this->M_hospital->loadData_byId(1);
	}


	public function index()
	{
		if ($this->AuthLogin()) {
			$this->load->view('admin/home',$this->data);
		} else {
			$this->load->view('admin/login');
		}
	}

	public function login()
	{
		if (!$this->AuthLogin()) {
			$this->load->view('admin/login');
		} else {
			redirect('/admin/home');
		}
	}


	public function home()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/home',$this->data);
		}
	}

	public function post()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/post_all',$this->data);
		}
	}

	public function page()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/page_all',$this->data);
		}
	}

	public function addPost()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/addPost',$this->data);
		}
	}

	public function addPage()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/addPage',$this->data);
		}
	}

	public function navbar()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/navbar',$this->data);
		}
	}

	public function slideshow()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/slideshows',$this->data);
		}
	}

	public function footer()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/footer',$this->data);
		}
	}

	public function map()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/map',$this->data);
		}
	}



	public function docters()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/docters',$this->data);
		}
	}

	public function spesialis()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/spesialis',$this->data);
		}
	}

	public function hospital()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/hospital',$this->data);
		}
	}

	public function partner()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/partner',$this->data);
		}
	}

	public function feedback()
	{
		if (!$this->AuthLogin()) {
			redirect('/admin/login');
		} else {
			$this->load->view('admin/feedback',$this->data);
		}
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

	public function api_load_hospital()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}
		$this->load->model('M_hospital');
		$result = $this->M_hospital->loadData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
			$response['data'] = $result;
		}
		echo json_encode($response);
	}

	public function api_load_footer()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}
		$this->load->model('M_footer');
		$result = $this->M_footer->loadData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
			$response['data'] = $result;
		}
		echo json_encode($response);
	}

	public function api_load_map()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}
		$this->load->model('M_map');
		$result = $this->M_map->loadData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
			$response['data'] = $result;
		}
		echo json_encode($response);
	}




	public function api_search_data()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}
		$this->load->model('M_peserta');
		$search = $this->M_peserta->id_peserta = $this->input->post('search');

		validationInput($search);

		$result = $this->M_peserta->searchData($search);
		echo json_encode($result);
	}


	public function api_delete_spesialis()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}
		$this->load->model('M_spesialis');
		$id_spesialis = $this->input->post('id_spesialis');

		validationInput($id_spesialis);
		$this->M_spesialis->id_spesialis = $id_spesialis;

		$result = $this->M_spesialis->delete_data();

		$response['result'] = false;

		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_delete_slideshow()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}
		$this->load->model('M_slideshows');
		$id_slideshow = $this->input->post('id_slideshow');

		validationInput($id_slideshow);
		$this->M_slideshows->id_slideshow = $id_slideshow;

		$result = $this->M_slideshows->delete_data();

		$response['result'] = false;

		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_search_docter()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_docter');

		$search = $this->input->post('search');

		validationInput($search);

		$this->M_docter->search = $search;

		$result =  $this->M_docter->searchData($search);

		$response['result'] = false;

		if ($result) {
			$response['data'] = $result;
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_search_post()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_post');

		$search = $this->input->post('search');

		validationInput($search);

		$this->M_post->search = $search;

		$result =  $this->M_post->searchData($search);

		$response['result'] = false;

		if ($result) {
			$response['data'] = $result;
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_load_all_slideshow()
	{
		$this->load->model('M_slideshows');

		$response['data'] = $this->M_slideshows->loadData();
		$response['result'] = true;

		echo json_encode($response);
	}

	public function api_load_all_post()
	{
		$this->load->model('M_post');

		$response['data'] = $this->M_post->loadData();
		$response['result'] = true;

		echo json_encode($response);
	}

	public function api_load_all_page()
	{
		$this->load->model('M_page');

		$response['data'] = $this->M_page->loadData();
		$response['result'] = true;

		echo json_encode($response);
	}

	public function api_load_data_docters()
	{
		$this->load->model('M_docter');

		$response['data'] = $this->M_docter->loadData();
		$response['result'] = true;

		echo json_encode($response);
	}

	public function api_load_all_navbar()
	{
		$this->load->model('M_navbar');

		$response['data'] = $this->M_navbar->loadDataNavbar();
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

	public function api_add_slideshow()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_slideshows');

		$title = $this->input->post('title');
		$description = $this->input->post('description');

		validationInput($title, $description);

		$this->M_slideshows->title = $title;
		$this->M_slideshows->description = $description;

		$result =  $this->M_slideshows->addData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_add_partner()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_partner');

		$title = $this->input->post('title');
		$link = $this->input->post('link');

		validationInput($title, $link);

		$this->M_partner->title = $title;
		$this->M_partner->link = $link;

		$result =  $this->M_partner->addData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}


	public function api_add_spesialis()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_spesialis');

		$spesialis = $this->input->post('spesialis');

		validationInput($spesialis);

		$this->M_spesialis->spesialis = $spesialis;

		$result =  $this->M_spesialis->addData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_update_post()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_post');

		$id_post = $this->input->post('id_post');
		$title = $this->input->post('title');
		$description = $this->input->post('description');

		validationInput($id_post, $title, $description);

		$this->M_post->title = $title;
		$this->M_post->description = $description;
		$this->M_post->id_post = $id_post;

		$result =  $this->M_post->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_update_map()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_map');

		$location = $this->input->post('location');

		validationInput($location);

		$this->M_map->location = $location;

		$result =  $this->M_map->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}


	public function api_update_footer()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_footer');

		$footer = $this->input->post('footer');

		validationInput($footer);

		$this->M_footer->footer = $footer;

		$result =  $this->M_footer->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}


	public function api_update_slideshow()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_slideshows');

		$id_slideshow = $this->input->post('id_slideshow');
		$title = $this->input->post('title');
		$description = $this->input->post('description');

		validationInput($id_slideshow, $title, $description);

		$this->M_slideshows->title = $title;
		$this->M_slideshows->description = $description;
		$this->M_slideshows->id_slideshow = $id_slideshow;

		$result =  $this->M_slideshows->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}


	public function api_update_page()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_page');

		$id_page = $this->input->post('id_page');
		$name = $this->input->post('name');
		$description = $this->input->post('description');

		validationInput($id_page, $name, $description);

		$this->M_page->name = $name;
		$this->M_page->description = $description;
		$this->M_page->id_page = $id_page;

		$result =  $this->M_page->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function editPost($id_post = null)
	{
		if ($id_post) {
			$this->load->model("M_post");

			$this->M_post->id_post = $id_post;

			$result = $this->M_post->checkDataById();

			if ($result) {
				$response['data'] = $this->M_post->getDataById();

				$this->load->view("admin/editPost", $response);
			} else {
				redirect('/admin/post');
			}
		} else {
			redirect('/admin/post');
		}
	}

	public function editPage($id_page = null)
	{
		if ($id_page) {

			$this->load->model("M_page");

			$this->M_page->id_page = $id_page;

			$result = $this->M_page->checkDataById();

			if ($result) {
				$response['data'] = $this->M_page->getDataById();
				$response['data_hospital'] = $this->data['data_hospital'];

				$this->load->view("admin/editPage", $response);
			} else {
				redirect('/admin/page');
			}
		} else {
			redirect('/admin/page');
		}
	}

	public function api_load_feedback(){
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_feedback');


		$result =  $this->M_feedback->loadData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
			$response['data'] = $result;
		}
		echo json_encode($response);
	}

	public function api_send_feedback(){
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_feedback');

		$rating = $this->input->post('rating');

		validationInput($rating);

		$this->M_feedback->rating = $rating;

		$result =  $this->M_feedback->addData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_add_post()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_post');

		$title = $this->input->post('title');
		$description = $this->input->post('description');

		validationInput($title, $description);

		$this->M_post->title = $title;
		$this->M_post->description = $description;

		$result =  $this->M_post->addData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_add_page()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_page');

		$name = $this->input->post('name');
		$description = $this->input->post('description');

		validationInput($name, $description);

		$this->M_page->name = $name;
		$this->M_page->description = $description;

		$result =  $this->M_page->addData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_delete_post()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_post');

		$id_post = $this->input->post('id_post');

		validationInput($id_post);

		$this->M_post->id_post = $id_post;

		$result =  $this->M_post->delete_data();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_delete_partner()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_partner');

		$id_partner = $this->input->post('id_partner');

		validationInput($id_partner);

		$this->M_partner->id_partner = $id_partner;

		$result =  $this->M_partner->delete_data();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}


	public function api_delete_navbar()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_navbar');

		$id_navbar = $this->input->post('id_navbar');

		validationInput($id_navbar);

		$this->M_navbar->id_navbar = $id_navbar;

		$result =  $this->M_navbar->delete_data();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_delete_navbar_child()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_navbar');

		$id_navbar_child = $this->input->post('id_navbar_child');

		validationInput($id_navbar_child);

		$this->M_navbar->id_navbar_child = $id_navbar_child;

		$result =  $this->M_navbar->delete_data_navbar_child();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_delete_page()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_page');

		$id_page = $this->input->post('id_page');

		validationInput($id_page);

		$this->M_page->id_page = $id_page;

		$result =  $this->M_page->delete_data();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}


	public  function api_update_hospital()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_hospital');

		$nama = $this->input->post('nama');
		$hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$id = $this->input->post('id');

		$id = 1;

		validationInput($nama, $alamat, $hp, $id);

		$this->M_hospital->nama = $nama;
		$this->M_hospital->alamat = $alamat;
		$this->M_hospital->hp = $hp;
		$this->M_hospital->id_hospital = $id;

		$result =  $this->M_hospital->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_update_spesialis()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_spesialis');

		$id_spesialis = $this->input->post('id_spesialis');
		$spesialis = $this->input->post('spesialis');

		validationInput($spesialis, $id_spesialis);

		$this->M_spesialis->id_spesialis = $id_spesialis;
		$this->M_spesialis->spesialis = $spesialis;

		$result =  $this->M_spesialis->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_update_partner()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_partner');

		$id_partner = $this->input->post('id_partner');
		$title = $this->input->post('title');
		$link = $this->input->post('link');

		validationInput($id_partner, $title, $link);

		$this->M_partner->id_partner = $id_partner;
		$this->M_partner->title = $title;
		$this->M_partner->link = $link;

		$result =  $this->M_partner->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}



	public function api_add_docter()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

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

	public function api_add_navbar()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_navbar');

		$title = $this->input->post('title');
		$link = $this->input->post('link');

		validationInput($title, $link);

		$this->M_navbar->title = $title;
		$this->M_navbar->link = $link;

		$result =  $this->M_navbar->addData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_add_navbar_child()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_navbar');

		$title = $this->input->post('title');
		$link = $this->input->post('link');
		$id_navbar = $this->input->post('id_navbar');

		validationInput($title, $link, $id_navbar);

		$this->M_navbar->title = $title;
		$this->M_navbar->id_navbar = $id_navbar;
		$this->M_navbar->link = $link;

		$result =  $this->M_navbar->addDataNavbarChild();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_load_navbar_child_byId()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_navbar');

		$id_navbar = $this->input->post('id_navbar');

		validationInput($id_navbar);

		$this->M_navbar->id_navbar = $id_navbar;

		$result =  $this->M_navbar->loadDataChildById();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
			$response['data'] = $result;
		}
		echo json_encode($response);
	}


	public function api_update_docter()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_docter');

		$id_spesialis = $this->input->post('id_spesialis');
		$id_docter = $this->input->post('id_docter');
		$ket = $this->input->post('ket');
		$nama = $this->input->post('nama');

		validationInput($nama, $id_spesialis, $ket, $id_docter);

		$this->M_docter->id_spesialis = $id_spesialis;
		$this->M_docter->id_docter = $id_docter;
		$this->M_docter->ket = $ket;
		$this->M_docter->nama = $nama;

		$result =  $this->M_docter->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_update_navbar()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$this->load->model('M_navbar');

		$id_navbar = $this->input->post('id_navbar');
		$title = $this->input->post('title');
		$link = $this->input->post('link');

		validationInput($title, $id_navbar, $link);

		$this->M_navbar->id_navbar = $id_navbar;
		$this->M_navbar->title = $title;
		$this->M_navbar->link = $link;

		$result =  $this->M_navbar->updateData();

		$response['result'] = false;
		if ($result) {
			$response['result'] = true;
		}
		echo json_encode($response);
	}

	public function api_delete_docter()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

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

	public function api_upload_foto_docter()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$id_docter = $this->input->post('id');

		validationInput($id_docter);

		$fileName = generateFileName();

		$config['upload_path']      = './public/img/docters/';
		$config['allowed_types']    = 'jpeg|gif|jpg|png';
		$config['max_size']         = 1500;
		$config['file_name']        = $fileName;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		$result = array('result' => false, 'message' => 'File gagal diupload!');

		$result_upload = $this->upload->do_upload('file_img');

		if ($result_upload) {
			$this->load->model("M_docter");
			$this->M_docter->id_docter = _replaceSq($id_docter);

			$filename = $this->upload->data('file_name');

			$this->M_docter->foto = $filename;

			$save = $this->M_docter->saveFoto();

			if ($save) {
				$result = array('result' => true, 'message' => 'File berhasil diupload !');
			}
		}

		echo json_encode($result);
	}

	public function api_upload_foto_partner()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$id_partner = $this->input->post('id');

		validationInput($id_partner);

		$fileName = generateFileName();

		$config['upload_path']      = './public/img/partners/';
		$config['allowed_types']    = 'jpeg|gif|jpg|png';
		$config['max_size']         = 1500;
		$config['file_name']        = $fileName;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		$result = array('result' => false, 'message' => 'File gagal diupload!');

		$result_upload = $this->upload->do_upload('file_img');

		if ($result_upload) {
			$this->load->model("M_partner");
			$this->M_partner->id_partner = _replaceSq($id_partner);

			$filename = $this->upload->data('file_name');

			$this->M_partner->foto = $filename;

			$save = $this->M_partner->saveFoto();

			if ($save) {
				$result = array('result' => true, 'message' => 'File berhasil diupload !');
			}
		}

		echo json_encode($result);
	}


	public function api_upload_foto_slideshow()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$id_slideshow = $this->input->post('id');

		validationInput($id_slideshow);

		$fileName = generateFileName();

		$config['upload_path']      = './public/img/slideshow/';
		$config['allowed_types']    = 'jpeg|gif|jpg|png';
		$config['max_size']         = 1500;
		$config['file_name']        = $fileName;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		$result = array('result' => false, 'message' => 'File gagal diupload!');

		$result_upload = $this->upload->do_upload('file_img');

		if ($result_upload) {
			$this->load->model("M_slideshows");
			$this->M_slideshows->id_slideshow = _replaceSq($id_slideshow);

			$filename = $this->upload->data('file_name');

			$this->M_slideshows->image = $filename;

			$save = $this->M_slideshows->saveFoto();

			if ($save) {
				$result = array('result' => true, 'message' => 'File berhasil diupload !');
			}
		}

		echo json_encode($result);
	}


	public function api_upload_foto_hospital()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$id_hospital = $this->input->post('id');

		validationInput($id_hospital);

		$fileName = generateFileName();

		$config['upload_path']      = './public/img/hospital/';
		$config['allowed_types']    = 'jpeg|gif|jpg|png';
		$config['max_size']         = 1500;
		$config['file_name']        = $fileName;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		$result = array('result' => false, 'message' => 'File gagal diupload!');

		$result_upload = $this->upload->do_upload('file_img');

		if ($result_upload) {
			$this->load->model("M_hospital");
			$this->M_hospital->id_hospital = _replaceSq($id_hospital);

			$filename = $this->upload->data('file_name');

			$this->M_hospital->foto = $filename;

			$save = $this->M_hospital->saveFoto();

			if ($save) {
				$result = array('result' => true, 'message' => 'File berhasil diupload !');
			}
		}

		echo json_encode($result);
	}

	public function api_upload_foto_post()
	{
		if (!$this->AuthLogin()) {
			exit(json_encode(array('message' => 'access denied')));
		}

		$id_post = $this->input->post('id');

		validationInput($id_post);

		$fileName = generateFileName();

		$config['upload_path']      = './public/img/posts/';
		$config['allowed_types']    = 'jpeg|gif|jpg|png';
		$config['max_size']         = 1500;
		$config['file_name']        = $fileName;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		$result = array('result' => false, 'message' => 'File gagal diupload!');

		$result_upload = $this->upload->do_upload('file_img');

		if ($result_upload) {
			$this->load->model("M_post");
			$this->M_post->id_post = _replaceSq($id_post);

			$filename = $this->upload->data('file_name');

			$this->M_post->cover = $filename;

			$save = $this->M_post->saveFoto();

			if ($save) {
				$result = array('result' => true, 'message' => 'File berhasil diupload !');
			}
		}

		echo json_encode($result);
	}

	public function api_load_data_partner()
	{
		$this->load->model('M_partner');

		$data['data'] = $this->M_partner->loadData();

		echo json_encode($data);
	}

	public function logout()
	{
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('token');
		redirect(base_url('/'));
	}
}
