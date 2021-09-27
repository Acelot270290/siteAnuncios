<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca extends CI_Controller {

	public function index(){




		$this->load->view('web/layout/header',$data);
		$this->load->view('web/detalhes/index');
		$this->load->view('web/layout/footer');
	

	}

public function estado($anuncio_estado = null){

	if(!$anuncio_estado){
		redirect('/');
	}else{

		//recuperamos da sessao o anuncio detalhado do controller
		$anuncio = $this->session->userdata('anuncio_detalhado');

		$data = array(

			'titulo'=> 'Busca pelo estado'.$anuncio_estado,
			'anuncios'=> $this->anuncios_model->get_all_by(array('anuncio_estado'=> $anuncio_estado, 'anuncio_categoria_pai_id'=> $anuncio->anuncio_categoria_pai_id, 'anuncio_categoria_id'=> $anuncio->anuncio_categoria_id)),
			

		);
		

		foreach($data['anuncios'] as $anuncio){

			$data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
			$data['categoria_nome'] = $anuncio->categoria_nome;
			


			break;
		}

		$data['informacao_busca'] = 'Encontrados em '. $anuncio_estado;

		/*print_r($anuncio);
		exit();*/

		$this->load->view('web/layout/header',$data);
		$this->load->view('web/home/index');
		$this->load->view('web/layout/footer');

	}

}
		
	


}
