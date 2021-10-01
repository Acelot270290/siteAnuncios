<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca extends CI_Controller {



	public function index(){

		$busca = $this->input->post('busca');

		if(!$busca){
			redirect('/');
		}else{

			/*
			*Pesquisa princpal do site
			*/


			if(!$anuncios = $this->anuncios_model->get_all_by_busca($busca)){

				redirect('/');

				

			}else{

				
				/*
				*Anuncios encontrada pelo input
				*/

				$data = array(
					'titulo'=> 'Busca pelo produto'.$busca,
					'informacao_busca'=> 'Termo digitado '.$busca,
	
				);

				foreach($anuncios as $anuncio){

					$data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
					$data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
					$data['categoria_nome'] = $anuncio->categoria_nome;
					$data['categoria_meta_link'] = $anuncio->categoria_meta_link;
					
		
		
					break;
				}



				$data['anuncios'] = $anuncios;


					$this->load->view('web/layout/header',$data);
					$this->load->view('web/home/index');
					$this->load->view('web/layout/footer');
			}

		}
	

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
			$data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
			$data['categoria_nome'] = $anuncio->categoria_nome;
			$data['categoria_meta_link'] = $anuncio->categoria_meta_link;
			


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

public function cidade($anuncio_cidade_metalink = null){

	if(!$anuncio_cidade_metalink){
		redirect('/');
	}else{

		//recuperamos da sessao o anuncio detalhado do controller
		$anuncio = $this->session->userdata('anuncio_detalhado');

		$data = array(

			'titulo'=> 'Busca pela cidade'.$anuncio->anuncio_cidade,
			'anuncios'=> $this->anuncios_model->get_all_by(array('anuncio_cidade_metalink'=> $anuncio_cidade_metalink, 'anuncio_categoria_pai_id'=> $anuncio->anuncio_categoria_pai_id, 'anuncio_categoria_id'=> $anuncio->anuncio_categoria_id)),
			

		);
		

		foreach($data['anuncios'] as $anuncio){

			$data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
			$data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
			$data['categoria_nome'] = $anuncio->categoria_nome;
			$data['categoria_meta_link'] = $anuncio->categoria_meta_link;
			$data['anuncio_estado'] = $anuncio->anuncio_estado;
			


			break;
		}

		$data['informacao_busca'] = 'Encontrados na cidade de '. $anuncio->anuncio_cidade;

		/*print_r($anuncio);
		exit();*/

		$this->load->view('web/layout/header',$data);
		$this->load->view('web/home/index');
		$this->load->view('web/layout/footer');

	}


}

public function bairro($anuncio_bairro_metalink = null){

	if(!$anuncio_bairro_metalink){
		redirect('/');
	}else{

		//recuperamos da sessao o anuncio detalhado do controller
		$anuncio = $this->session->userdata('anuncio_detalhado');

		$data = array(

			'titulo'=> 'Busca pelo bairro'.$anuncio->anuncio_bairro. ' na cidade de'. $anuncio->anuncio_cidade. ', no estado - '.$anuncio->anuncio_estado,
			'anuncios'=> $this->anuncios_model->get_all_by(array('anuncio_bairro_metalink'=> $anuncio_bairro_metalink, 'anuncio_cidade'=> $anuncio->anuncio_cidade, 'anuncio_estado'=>$anuncio->anuncio_estado, 'anuncio_categoria_pai_id'=> $anuncio->anuncio_categoria_pai_id, 'anuncio_categoria_id'=> $anuncio->anuncio_categoria_id)),
			

		);
		

		foreach($data['anuncios'] as $anuncio){

			$data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
			$data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
			$data['categoria_nome'] = $anuncio->categoria_nome;
			$data['categoria_meta_link'] = $anuncio->categoria_meta_link;
			$data['anuncio_estado'] = $anuncio->anuncio_estado;
			$data['anuncio_cidade'] = $anuncio->anuncio_cidade;
			


			break;
		}

		$data['informacao_busca'] = 'Encontrados no bairro '. $anuncio->anuncio_bairro;

		/*print_r($anuncio);
		exit();*/

		$this->load->view('web/layout/header',$data);
		$this->load->view('web/home/index');
		$this->load->view('web/layout/footer');

	}


}

public function master($categoria_pai_meta_link = null){

	if(!$categoria_pai_meta_link){
		redirect('/');
	}else{



		$data = array(

			
			'anuncios'=> $this->anuncios_model->get_all_by(array('categoria_pai_meta_link'=> $categoria_pai_meta_link)),
			

		);

		foreach($data['anuncios'] as $anuncio){

			$data['titulo']= 'Busca pela categoria Principal'.$anuncio->categoria_pai_nome;

			$data['informacao_busca'] = 'Exibindo todos os anúncios  da categoria principal: '. $anuncio->categoria_pai_nome;

			


			break;
		}



		/*print_r($anuncio);
		exit();*/

		$this->load->view('web/layout/header',$data);
		$this->load->view('web/home/index');
		$this->load->view('web/layout/footer');

	}


}

public function categoria($categoria_meta_link = null){

	if(!$categoria_meta_link){
		redirect('/');
	}else{



		$data = array(

			'anuncios'=> $this->anuncios_model->get_all_by(array('categoria_meta_link'=> $categoria_meta_link)),
			

		);

		foreach($data['anuncios'] as $anuncio){

			$data['titulo']= 'Busca pela categoria secundária'.$anuncio->categoria_pai_nome;
			$data['categoria_pai_nome'] = $anuncio->categoria_pai_nome;
			$data['categoria_pai_meta_link'] = $anuncio->categoria_pai_meta_link;
	


			break;
		}


		$data['informacao_busca'] = 'Exibindo todos os anúncios  da categoria secundária: '.$anuncio->categoria_nome;

		/*print_r($anuncio);
		exit();*/

		$this->load->view('web/layout/header',$data);
		$this->load->view('web/home/index');
		$this->load->view('web/layout/footer');

	}


}

public function busca_ajax(){
	if(!$this->input->is_ajax_request()){

	exit('Ação não permitida');
	}
	$busca = $this->input->post('busca');
	

			if(!$busca){
				redirect('/');
			}else{

				$anuncios = $this->anuncios_model->get_all_by_busca($busca);

				$data['response'] = 'false';

				if($anuncios){

					$data['response'] = 'true';
					$data['message'] = array();

					foreach($anuncios as $anuncio){
						$data['message'][] = array(

							'value'=>$anuncio->anuncio_titulo,

						);
					}

				}

				echo json_encode($data);
				
			}

		}

}
