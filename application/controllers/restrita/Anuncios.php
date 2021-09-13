<?php

//Controle responsavel por gerenciar aos Anuncios

defined('BASEPATH') OR exit('Ação não permitida');

class Anuncios extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		//Verifica se está logado

		if (!$this->ion_auth->logged_in())
		{
		  redirect('restrita/login');
		}

		/*
		//verifica se /e admin

		if (!$this->ion_auth->is_admin())
		{
		  redirect('/');
		}*/

	}

	public function index(){

		$data = array(
			'titulo'=>' Anúncios Cadastrados',

			'styles'=>array(
				'assets/bundles/datatables/datatables.min.css',
				'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
			),

			'scripts'=>array(
				'assets/bundles/datatables/datatables.min.js',
				'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
				'assets/bundles/jquery-ui/jquery-ui.min.js',
				'assets/js/page/datatables.js',

			),
			'anuncios'=> $this->core_model->get_all('anuncios'),
		);

		/*echo '<prev>';
		print_r($data['anuncios']);
		echo "</pre>";
		exit();*/

		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/anuncios/index');
		$this->load->view('restrita/layout/footer');

	}


}
