<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index()
	{

		$data = array(
			'titulo' => 'Seja bem Vindo(a)',
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
			'categorias_pai_sidebar'=>$this->anuncios_model->get_all_categorias_pai_home(),
			
		);

		$data['anuncios'] = $this->anuncios_model->get_all_anuncios_radom(array('anuncios.anuncio_publicado'=> 1));

		/*print_r($data['categorias_pai_sidebar']);
		exit();*/


			
		
		$this->load->view('web/layout/header',$data);
		$this->load->view('web/home/index');
		$this->load->view('web/layout/footer');
	}
}
