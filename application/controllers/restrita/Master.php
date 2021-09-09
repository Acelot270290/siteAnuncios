<?php

//Controle responsavel por gerenciar as categorias pai

defined('BASEPATH') OR exit('Ação não permitida');

class Master extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$data = array(
			'titulo'=>'Categorias Pai',

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
			'masters'=> $this->core_model->get_all('categorias_pai'),
		);

		/*echo '<prev>';
		print_r($data['masters']);
		echo "</pre>";
		exit();*/

		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/master/index');
		$this->load->view('restrita/layout/footer');

	}
}
