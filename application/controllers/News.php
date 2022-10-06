<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class News extends CI_Controller {


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
		$this->load->model('M_hospital');
		$this->load->model('M_header');
		$this->load->model('M_page');
		$this->load->model('M_social_media');
	}

	public function search($query=null){
		if ($query){

			validationInput($query);

			$this->M_post->title = $query;
			$this->M_post->description = $query;

			$data = $this->M_post->loadData_byWhere();

			$data['result_data'] = $data;

			$this->load->view('user/search',$data);
		}
	}
	

}
