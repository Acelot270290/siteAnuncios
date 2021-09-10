<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	public function __construct(){
		parent::__construct();

				//Verifica se está logado

				if (!$this->ion_auth->logged_in())
				{
				  redirect('restrita/login');
				}
		
				//verifica se /e admin
		
				if (!$this->ion_auth->is_admin())
				{
				  redirect('/');
				}
	}
	public function index() {

		$data = array(
			'titulo' => 'Home Administração',
		);

		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/home/index');
		$this->load->view('restrita/layout/footer');

		

	}

}
