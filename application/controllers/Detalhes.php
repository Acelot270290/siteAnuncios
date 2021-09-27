<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalhes extends CI_Controller {


	public function index($anuncio_codigo = NULL)
	{

		if(!$anuncio_codigo || !$anuncio = $this->anuncios_model->get_by_id(array('anuncio_codigo'=>$anuncio_codigo))){
			redirect('/');
		}else{

			//Jogamos na seção alguns atributos na sesção para podermos implementar a pesquisa persolanizada
			$this->session->set_userdata('anuncio_detalhado', $anuncio);


			$data = array(
				'titulo' => 'Detalhes dp Anúncio'. $anuncio->anuncio_titulo,
				'anuncio'=> $anuncio,
				'anuncios_fotos'=> $this->core_model->get_all('anuncios_fotos', array('foto_anuncio_id' => $anuncio->anuncio_id)),
				'todos_anuncios_anunciante'=> $this->anuncios_model->get_all($anuncio->anuncio_user_id),//recuperando todos os anuncios do dono do anuncios que está sendo detalhado

				
			);
	
	
			/*print_r($data['anuncios']);
			exit();*/


			
	
	
				
			
			$this->load->view('web/layout/header',$data);
			$this->load->view('web/detalhes/index');
			$this->load->view('web/layout/footer');

		}


	}
}
