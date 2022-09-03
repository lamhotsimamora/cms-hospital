<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Page extends CI_Controller {

	private function loadDataNavbar(){
		$this->load->model("M_navbar");
		return ($this->M_navbar->loadDataNavbar());
	}

	private function loadDataNavbarChild(){
		$this->load->model("M_navbar");
		return ($this->M_navbar->loadDataNavbarChild());
	}

	// www.example.com/page/p/visi-misi

	public function p($link=null){
		if ($link){

			$this->load->model("M_page");

			$this->M_page->slug = $link;

			$check = $this->M_page->checkDataBySlug();

			if ($check){
				$data['data'] = $this->M_page->getDataBySlug();

				$data['data_navbar'] = $this->loadDataNavbar();
				$data['data_navbar_child'] = $this->loadDataNavbarChild();

				$this->load->view('user/page',$data);
			}else{
				redirect('.');
			}
		}else{
			redirect('.');
		}
	}

}
