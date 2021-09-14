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

		if($this->ion_auth->is_admin()){
			$data['anuncios'] = $this->anuncios_model->get_all();//não é informado nenhum paramentro se for admin

		}else{

			$data['anuncios'] = $this->anuncios_model->get_all($this->session->userdata('user_id'));


		}

		/*echo '<prev>';
		print_r($data['anuncios']);
		echo "</pre>";
		exit();*/

		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/anuncios/index');
		$this->load->view('restrita/layout/footer');

	}

	public function core($anuncio_id=NULL){

		//Função só será utilizada para editar um anuncio

		$anuncio_id = (int) $anuncio_id;

		//Verificamos se foi informado um anuncio id na base de dados

		if(!$anuncio_id || !$anuncio = $this->anuncios_model->get_by_id(array('anuncio_id'=> $anuncio_id))){

			//Cadastrando

			$this->session->flashdata('erro','Anúncio não encontrado');

			redirect('restrita/'. $this->router->fetch_class());


		}else{
			//Anuncio existe e passamos para as validações

			$this->form_validation->set_rules('anuncio_titulo','Título do anúncio','trim|required|min_length[4]|max_length[240]');
			$this->form_validation->set_rules('anuncio_preco','Preço'. 'trim|required');
			$this->form_validation->set_rules('anuncio_situacao','Situação do produto'. 'trim|required');

			//Verificamos se a categoria Pai veio no post
			$anuncio_categoria_pai_id = $this->input->post('anuncio_categoria_pai_id');

			if($anuncio_categoria_pai_id){

			$this->form_validation->set_rules('anuncio_categoria_pai_id','Sub categoria'. 'trim|required');

			}

			$this->form_validation->set_rules('anuncio_localizacao_cep','Localização do Anúncio','trim|required|exact_length[9]');
			$this->form_validation->set_rules('anuncio_descricao','Título do anúncio','trim|required|min_length[10]|max_length[5000]');
			$this->form_validation->set_rules('fotos_anuncios','Imagens do item','trim|required');

			if($this->form_validation->run()){

				print_r($this->input->post());
				exit();

			}else{

				//Erros de Validação

				$data = array(
					'titulo'=>' Editar Anúncio',
		
					'styles'=>array(
						'assets/jquery-upload-file/css/uploadfile.css',
					),
		
					'scripts'=>array(
						'assets/sweetalert2/sweetalert2.all.min.js',// para confirma a exclusão da imagem do formulário
						'assets/jquery-upload-file/js/jquery.uploadfile.js',
						'assets/jquery-upload-file/js/anuncios.js',

		
					),
					'anuncio'=> $anuncio,
					'fotos_anuncio' => $this->core_model->get_all('anuncios_fotos', array('foto_anuncio_id'=>$anuncio_id)),
					'categorias_pai'=>$this->anuncios_model->get_all_categorias_pai(),

				);
		
		
				echo '<prev>';
				print_r($data);
				echo "</pre>";
				exit();
		
				$this->load->view('restrita/layout/header',$data);
				$this->load->view('restrita/anuncios/index');
				$this->load->view('restrita/layout/footer');


			}




		}


	}


}
