<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Verifica se está logado

		if (!$this->ion_auth->logged_in())
		{
		  redirect('login');
		}

	}

	public function index(){

		//motando os dados do anunciante e mostrando o total de anuncios cadastrado por ele

		$anunciante = $this->ion_auth->user()->row();

		$data = array(
			'titulo' => 'Gerenciar minha conta',
			'anunciante' => $anunciante,
			'total_anuncios_cadastrados'=>$this->core_model->count_all_results('anuncios', array('anuncio_user_id'=> $anunciante->id)),

		);
	
		
		$this->load->view('web/layout/header',$data);
		$this->load->view('web/conta/index');
		$this->load->view('web/layout/footer');
	}
}
