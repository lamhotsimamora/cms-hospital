<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_navbar');
		$this->load->model('M_slideshows');
		$this->load->model('M_docter');
		$this->load->model('M_footer');
		$this->load->model('M_map');
		$this->load->model('M_partner');
		$this->load->model('M_post');
	}

	private function loadDataNavbar(){
		$this->load->model("M_navbar");
		return ($this->M_navbar->loadDataNavbar());
	}

	private function loadDataNavbarChild(){
		$this->load->model("M_navbar");
		return ($this->M_navbar->loadDataNavbarChild());
	}

	// www.example.com/page/p/visi-misi

	private function loadDataPartner(){
		return ($this->M_partner->loadData());
	}


	private function loadDataFooter(){
		return ($this->M_footer->loadData());
	}

	public function p($link=null){
		if ($link){

			$this->load->model("M_page");

			$this->M_page->slug = $link;

			$check = $this->M_page->checkDataBySlug();

			if ($check){
				$data['data'] = $this->M_page->getDataBySlug();

				$data['data_navbar'] = $this->loadDataNavbar();
				$data['data_navbar_child'] = $this->loadDataNavbarChild();
				$data['data_footer'] = $this->loadDataFooter();
				$data['data_partner'] = $this->loadDataPartner();

				$this->load->view('user/page',$data);
			}else{
				redirect('.');
			}
		}else{
			redirect('.');
		}
	}

}
