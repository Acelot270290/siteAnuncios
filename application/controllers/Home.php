<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index()
	{

		$data = array(
			'titulo' => 'Seja bem Vindo(a)',
		);
			
		
		//$this->load->view('web/layout/header');
		$this->load->view('web/home/index');
		//$this->load->view('web/layout/footer');
	}
}
