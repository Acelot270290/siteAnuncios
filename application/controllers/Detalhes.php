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
				'titulo' => 'Detalhes do Anúncio '. $anuncio->anuncio_titulo,
				'anuncio'=> $anuncio,
				'anuncio_user'=> $anuncio,
				'anuncios_fotos'=> $this->core_model->get_all('anuncios_fotos', array('foto_anuncio_id' => $anuncio->anuncio_id)),
				'todos_anuncios_anunciante'=> $this->anuncios_model->get_all($anuncio->anuncio_user_id),//recuperando todos os anuncios do dono do anuncios que está sendo detalhado

				'anuncio_perguntas'=> $this->anuncios_model->get_perguntas_anuncio_historico(array('anuncios_perguntas_historico.anuncio_id'=>$anuncio->anuncio_id)),

				
			);
	
	
			/*print_r($data['anuncio_perguntas']);
			exit();*/


			
	
	
			$this->session->set_userdata('url_anterior',current_url());

		
			
			$this->load->view('web/layout/header',$data);
			$this->load->view('web/detalhes/index');
			$this->load->view('web/layout/footer');

		}


	}

	public function perguntar($anuncio_id = null){

		$anuncio_id = (int) $anuncio_id;

		if(!$this->ion_auth->logged_in()){

			//recupreamos o que veio no post no name pergunta antes de ser feito o login e setamos na seção para quando o visitante realizar o login e redirecionarmos para o Login
			$pergunta = $this->input->post('pergunta');
			$this->session->set_userdata('pergunta',$pergunta);
			redirect('login');
		}

	//Visitante logado

	if(!$anuncio_id || $anuncio = $this->anuncios_model->get_by_id(array('anuncio_id'=> $anuncio_id))){

		redirect($this->session->userdata('url_anterior'));

	}else{
		//Anuncio existe

		if($anuncio->anuncio_user_id == $this->session->userdata('user_id')){

			$this->session->set_flashdata('erro_pergunta','Você não pode fazer uma pergunta para o seu anúncio');
			redirect($this->session->userdata('url_anterior').'#pergunta');
		}

	}

	}
}
