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
			'titulo' => 'Administração',
			'anuncios_nao_auditados'=> $this->core_model->count_all_results('anuncios', array('anuncio_publicado'=>0)),
			'anuncios_publicados'=> $this->core_model->count_all_results('anuncios', array('anuncio_publicado'=>1)),
			'total_anuciantes'=> $this->core_model->count_all_results('users_groups', array('group_id'=>2)),
			'contas_bloqueadas'=> $this->core_model->count_all_results('users', array('active'=>0)),
			'anuciantes'=> $this->ion_auth->users()->result(),


			'styles'=>array(
				'assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css',
				'assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css',
			),

			'scripts'=>array(
				'assets/bundles/owlcarousel2/dist/owl.carousel.min.js',
				'assets/js/page/widget-data.js',
	
			),

		);

	
		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/home/index');
		$this->load->view('restrita/layout/footer');

		

	}

}
