<?php

//controle para pagina de login

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	public function __construct(){

		parent::__construct();
	}
	public function index() {

		$data = array(
			'titulo' => 'Faça o seu Login',
		);

		$this->load->view('web/layout/header',$data);
		$this->load->view('web/login/index');
		$this->load->view('web/layout/footer');

		

	}

	public function auth(){

		/*email: "alan.diniz@ucp.br",
		password: "Acelot.270290",
		remember: "on"*/

		$identity = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = ($this->input->post('remember' ? TRUE : FALSE));


		if($this->ion_auth->login($identity, $password, $remember)){
			//somente pessoas administradores

			if($this->ion_auth->is_admin()){

				redirect('restrita');

			}else{
				redirect('/');


			}

		}else{
			//Erro de Login

			$this->session->set_flashdata('erro', 'Verifique suas credenciais de acesso');
			redirect($this->router->fetch_class());
		}

		print_r($this->input->post());
	}

	public function logout(){
		$this->ion_auth->logout();
		redirect($this->router->fetch_class());
	}

}
