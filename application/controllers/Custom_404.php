<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Custom_404 extends CI_Controller {

	public function index(){

		$data = array(

			'titulo' => 'Página não encontrada'
		);

		if($this->ion_auth->is_admin()){

		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/custom_404_admin');
		$this->load->view('restrita/layout/footer');
		}else{

		$this->load->view('web/layout/header',$data);
		$this->load->view('web/custom_404_web');
		$this->load->view('web/layout/footer');

		}

	}



}
