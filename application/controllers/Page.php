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

	public function detail($id_page=null){
		if ($id_page){

			$this->load->model("M_page");

			$this->M_page->id_page = $id_page;

			$check = $this->M_page->checkDataById();

			if ($check){
				$data['data'] = $this->M_page->getDataById();
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
