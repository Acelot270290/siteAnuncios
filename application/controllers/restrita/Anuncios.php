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

	public function get_categorias_filhas(){
		//recupera todas as categorias filhas de acordo com as categorias pai iformada no ajax request

		if(!$this->input->is_ajax_request()){
			exit('Ação não permitida');
		}

		$categorias = array();
		$anuncio_categoria_pai_id = $this->input->post('anuncio_categoria_pai_id');

		if('anuncio_categoria_pai_id'){

			$categorias = $this->core_model->get_all('categorias', array('categoria_pai_id' =>$anuncio_categoria_pai_id, 'categoria_ativa'=> 1));

		}

		echo json_encode($categorias);

	}

	//  Função que valida o cep informado é válido, caso sim setamos o objeto com todos os enereços
	public function valida_anuncio_localizacao_cep(){

		if(!$this->input->is_ajax_request()){
			exit('Ação não permitida');
		}

		$this->form_validation->set_rules('anuncio_localizacao_cep', 'Localização do Anúncio','trim|required|exact_length[9]');

		/*
		*Retornarar os dados para o javascript anuncios.js
		*/
		$retorno = array();


		if($this->form_validation->run()){

			//Cep Validado quanto ao seu formato passamos para  o inicio da requisição


			/*
			*https://viacep.com.br/ws/25615131/json/
			*/

			// formatando o cep de acordo com a api via CEP exemplo acima

			$cep = str_replace("-", "", $this->input->post('anuncio_localizacao_cep'));

			$url = "https://viacep.com.br/ws/";
			$url .= $cep;
			$url .= "/json/";

			$jsonsite = file_get_contents($url);
			$resultado_requisicao = json_decode($jsonsite);

			

			if(isset($resultado_requisicao->erro)){
				
				$retorno['erro'] = 3;
				$retorno['anuncio_localizacao_cep'] = '<span class="text-danger"> Por favor informe um CEP válido</span>';

			}else{

				//print_r($resultado_requisicao);
				//Agora cetamos na sessão do objeto em anuncios para recuperar no método core


				$this->session->set_userdata('anuncio_endereco_sessao', $resultado_requisicao);


				$retorno['erro'] = 0;
				$retorno['anuncio_localizacao_cep'] = '<span class="text-info"> Seu CEP  foi validado</span>';
			}


		}else{

		// Erros de Validação

		$retorno['erro'] = 3;
		$retorno['anuncio_localizacao_cep'] = form_error('anuncio_localizacao_cep', '<div class="text-danger">','</div>');

		}

		/*
		*Retorno os dados contidos no retorno

		*/

		echo json_encode($retorno);


	}

	public function upload(){

		$config['upload_path'] = './uploads/anuncios/';
		$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
		$config['encrypt_name'] = true;
		$config['max_size'] = 2048;
		$config['max_width'] = 1000;
		$config['max_height'] = 1000;

		//Carregando  bliblioteca o Uploud
		$this->load->library('upload', $config);

		if($this->upload->do_upload('foto_produto')){

			$data = array(
				'erro' => 0,
				'uploaded_data' => $this->upload->data(),
				'foto_nome' => $this->upload->data('file_name'),
				'mensagem'=> 'Foto enviada com sucesso',
			);

			/*
			*Criando a copia numa versão menor para mobile
			*/

			$config['image_library'] = 'gd2';
			$config['source_image'] = './uploads/anuncios/' . $this->upload->data('file_name');
			$config['new_image'] = './uploads/anuncios/small/' . $this->upload->data('file_name');
			$config['width'] = 300;
			$config['height'] = 280;
			$this->load->library('image_lib', $config);

			// Verificamos se houver erro no resize

			if(!$this->image_lib->resize()){

				$data['erro'] = 3;
				$data['mensagem'] = $this->image_lib->display_errors('<span class="text-danger">', '</span>');

			}


		}else{
			//caso tenha erros no uplouds da imagem

			$data = array(

				'erro'=> 3,
				'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
			);
		}

		echo json_encode($data);
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
			$this->form_validation->set_rules('anuncio_preco','Preço', 'trim|required');
			$this->form_validation->set_rules('anuncio_situacao','Situação do produto', 'trim|required');

			//Verificamos se a categoria Pai veio no post
			$anuncio_categoria_pai_id = $this->input->post('anuncio_categoria_pai_id');

			if($anuncio_categoria_pai_id){

			$this->form_validation->set_rules('anuncio_categoria_id','Subcategoria', 'trim|required');

			}

			$this->form_validation->set_rules('anuncio_localizacao_cep','Localização do Anúncio','trim|required|exact_length[9]');
			$this->form_validation->set_rules('anuncio_descricao','Título do anúncio','trim|required|min_length[10]|max_length[5000]');
			
			
			$fotos_produtos = $this->input->post('fotos_produtos');

			//Para validarmos as fotos tipo array, temos que fazer desta forma
			if(!$fotos_produtos){

				$this->form_validation->set_rules('fotos_produtos','Imagens do item','trim|required');

			}

			if($this->form_validation->run()){
			
				


						/*
						*{
					anuncio_titulo: "Controle Ps4",
					anuncio_preco: "100.00",
					anuncio_categoria_pai_id: "",
					anuncio_categoria_id: "",
					anuncio_publicado: "0",
					anuncio_situacao: "0",
					anuncio_localizacao_cep: "25615-131",
					anuncio_descricao: "Controle Ps4",
					fotos_produtos: {
					0: "597d24848ccf854c89ed3e82724211df.jpg",
					1: "4814109dfe7f2775ea1353a8c1bcfb7e.jpg"
					},
			
						*/
						
						$data = elements(

							array(

								'anuncio_titulo',
								'anuncio_preco',
								'anuncio_categoria_pai_id',
								'anuncio_categoria_id',
								'anuncio_publicado',
								'anuncio_situacao',
								'anuncio_localizacao_cep',
								'anuncio_descricao',

							), $this->input->post()
						);

						/*
						*Compondo o endereço completo do anúncio a partir dos dados do objeto 'anuncio_endereco_sessao'
						só fazemos isso se o cep informado no post for diferente na base de dados
						*/

						if($anuncio->anuncio_localizacao_cep != $data['anuncio_localizacao_cep']){

							
							$anuncio_endereco_sessao = $this->session->userdata('anuncio_endereco_sessao');
							$data['anuncio_logradouro'] = $anuncio_endereco_sessao->logradouro;
							$data['anuncio_bairro'] = $anuncio_endereco_sessao->bairro;
							$data['anuncio_cidade'] = $anuncio_endereco_sessao->localidade;
							$data['anuncio_estado'] = $anuncio_endereco_sessao->uf;
	
							/*
							*motando os meta-link endereço para pesquisa na hora publica
							*/
	
							$data['anuncio_bairro_metalink'] = url_amigavel($data['anuncio_bairro']);
							$data['anuncio_cidade_metalink'] = url_amigavel($data['anuncio_cidade']);
	
							/*
							*Removemos da sessão anuncio_endereco_sessao, não precisamos mais dele
							*/
	
							$this->session->unset('anuncio_endereco_sessao');



						}

						if(!$data['anuncio_categoria_pai_id']){
							unset($data['anuncio_categoria_pai_id']);

						}

						if(!$data['anuncio_categoria_id']){
							unset($data['anuncio_categoria_id']);

						}

						//removendo a virgula do preço para inserir no banco
						$data['anuncio_preco'] = str_replace(',', '',$data['anuncio_preco']);

						//Atualizando o anuncio no banco de dados
						$this->core_model->update('anuncios', $data, array('anuncio_id'=>$anuncio->anuncio_id));

						/*
						*removendo as imagens antigas e inserir as imagens novas
						*/

						$this->core_model->delete('anuncios_fotos', array('foto_anuncio_id'=>$anuncio->anuncio_id));


						$fotos_produtos = $this->input->post('fotos_produtos');

						//Contamos quantas imagens vieram no input
						$total_fotos = count($fotos_produtos);

						for($i = 0; $i < $total_fotos; $i++){
							$data = array(
								'foto_anuncio_id' => $anuncio->anuncio_id,
								'foto_nome' => $fotos_produtos[$i],
							);

								$this->core_model->insert('anuncios_fotos', $data);

						}

						redirect('restrita/' . $this->router->fetch_class());



			}else{

				//Erros de Validação

				$data = array(
					'titulo'=>' Editar Anúncio',
					
		
					'styles'=>array(
						'assets/jquery-upload-file/css/uploadfile.css',
						'assets/bundles/select2/dist/css/select2.min.css',
					),
		
					'scripts'=>array(
						'assets/sweetalert2/sweetalert2.all.min.js',// para confirma a exclusão da imagem do formulário
						'assets/jquery-upload-file/js/jquery.uploadfile.js',
						'assets/jquery-upload-file/js/anuncios.js',
						'assets/mask/jquery.mask.min.js',
						'assets/mask/custom.js',
						'assets/bundles/select2/dist/js/select2.full.min.js',
						'assets/js/anuncios.js',

		
					),
					'anuncio'=> $anuncio,
					'fotos_anuncio' => $this->core_model->get_all('anuncios_fotos', array('foto_anuncio_id'=>$anuncio_id)),
					'categorias_pai'=>$this->anuncios_model->get_all_categorias_pai(),

				);
		
		
				/*echo '<prev>';
				print_r($data);
				echo "</pre>";
				exit();*/
		
				$this->load->view('restrita/layout/header',$data);
				$this->load->view('restrita/anuncios/core');
				$this->load->view('restrita/layout/footer');


			}




		}


	}


}
