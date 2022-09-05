<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Post extends CI_Controller {

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
		return ($this->M_navbar->loadDataNavbar());
	}

	private function loadDataNavbarChild(){
		return ($this->M_navbar->loadDataNavbarChild());
	}

	public function detail($id_post=null){
		if ($id_post){

			$this->M_post->id_post = $id_post;

			$check = $this->M_post->checkDataById();

			if ($check){
				$data['data'] = $this->M_post->getDataById();
				$data['data_navbar'] = $this->loadDataNavbar();
				$data['data_navbar_child'] = $this->loadDataNavbarChild();
				$data['data_footer'] = $this->loadDataFooter();
				$data['data_partner'] = $this->loadDataPartner();
				$data['data_map'] = $this->loadDataMap();
				$data['data_slideshow'] = $this->loadDataSlideShows();

				$this->load->view('user/post',$data);
			}else{
				redirect('.');
			}
		}else{
			redirect('.');
		}
	}
	private function loadDataSlideShows(){
		return $this->M_slideshows->loadData();
	}
	
	
	private function loadDataMap(){
		return ($this->M_map->loadData());
	}

	private function loadDataPartner(){
		return ($this->M_partner->loadData());
	}


	private function loadDataFooter(){
		return ($this->M_footer->loadData());
	}

}
