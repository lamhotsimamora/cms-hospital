<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Post extends CI_Controller {

	private function loadDataNavbar(){
		$this->load->model("M_navbar");
		return ($this->M_navbar->loadDataNavbar());
	}

	private function loadDataNavbarChild(){
		$this->load->model("M_navbar");
		return ($this->M_navbar->loadDataNavbarChild());
	}

	public function detail($id_post=null){
		if ($id_post){

			$this->load->model("M_post");

			$this->M_post->id_post = $id_post;

			$check = $this->M_post->checkDataById();

			if ($check){
				$data['data'] = $this->M_post->getDataById();
				$data['data_navbar'] = $this->loadDataNavbar();
				$data['data_navbar_child'] = $this->loadDataNavbarChild();


				$this->load->view('user/post',$data);
			}else{
				redirect('.');
			}
		}else{
			redirect('.');
		}
	}

}
