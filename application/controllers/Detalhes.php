<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalhes extends CI_Controller {


	public function index($anuncio_codigo = NULL){

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
	
	
			/*print_r($this->session->userdata());
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
			$this->session->set_userdata('pergunta', $pergunta);
			redirect('login');
		}
		$this->form_validation->set_rules('pergunta', 'Pergunta', 'trim|required|min_length[4]|max_length[200]');


		//Visitante logado

		if(!$anuncio_id || !$anuncio = $this->anuncios_model->get_by_id(array('anuncio_id' => $anuncio_id))){



		redirect($this->session->userdata('url_anterior'));

		}else{

		//Anuncio existe


			// Não pertiremos o anunciante fazer perguntas no seu anuncio
		if($anuncio->anuncio_user_id == $this->session->userdata('user_id')){
			$this->session->set_flashdata('erro_pergunta','Você não pode fazer uma pergunta para o seu anúncio');
			redirect($this->session->userdata('url_anterior').'#pergunta');
			}


			//validando o form

			
			$this->form_validation->set_rules('pergunta', 'Pergunta', 'trim|required|min_length[4]|max_length[200]');

			if($this->form_validation->run()){

				
				/*print_r($this->input->post());
				exit();*/

				$data = elements(
					array('pergunta'				
				
				), $this->input->post()
			);

			$data['anuncio_id'] = $anuncio->anuncio_id;
			$data['anuncio_user_id'] = $anuncio->id;
			$data['anunciante_pergunta_id'] = $this->session->userdata('user_id');

			$data = html_escape($data);

			/*print_r($data);
			exit();*/

			// inserimos na tabela principal do banco de dados
			$this->core_model->insert('anuncios_perguntas', $data);
			// inserimos na tabela historido do banco de dados
			$this->core_model->insert('anuncios_perguntas_historico', $data);

			//removemos da sessão a pergunta anterior (antes do login)salva no values no html
			$this->session->unset_userdata('pergunta');

			$this->session->set_flashdata('sucesso_pergunta','Sua pergunta foi enviada para o anunciante. Você será notificado por e-mail quando ela for respondida =)');
			redirect($this->session->userdata('url_anterior').'#pergunta');


			}else{
				//erros de validação

				$this->session->set_flashdata('erro_pergunta',validation_errors());

				redirect($this->session->userdata('url_anterior').'#pergunta');
				
				
			}

		}

	}
}
