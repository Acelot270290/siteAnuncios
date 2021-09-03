<?php

//Controle responsavel por gerenciar os usuários

defined('BASEPATH') OR exit('Ação não permitida');

class Usuarios extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$data = array(
			'titulo'=>'Usuários Cadastrados',

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
			'usuarios'=> $this->ion_auth->users()->result(),
		);

		/*echo '<prev>';
		print_r($data);
		echo "</pre>";
		exit();*/

		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/usuarios/index');
		$this->load->view('restrita/layout/footer');

	}

	public function core($usuario_id = NULL){

		//esse metodo será responsavel de edição e criação de usuarios
		$usuario_id = (int) $usuario_id;

		if(!$usuario_id){

			// Cadatras novo usuarios

			exit('Novo usuário endo cadastrado');

		}else{
			// verificamos se o user id existe no banco de dados

			if(!$usuario = $this->ion_auth->user($usuario_id)->row()){

				exit ('Usuários não encontrado');

			}else{

				//Usuario encontrado e agora passamos as validações, exemplos abaixo

				$this->form_validation->set_rules('first_name','Nome','trim|required');
				$this->form_validation->set_rules('last_name','Sobrenome','trim|required');

				if($this->form_validation->run()){

			/*echo '<prev>';
			print_r($this->input->post);
			echo "</pre>";
			exit();*/

				}else{
					$data = array(
						'titulo' => 'Editando Usuário',

						'scripts'=>array(
							'assets/mask/jquery.mask.min.js',
							'assets/mask/custom.js',
							'assets/js/usuarios.js',
							
			
						),



						'usuario' => $usuario,
						'perfil' => $this->ion_auth->get_users_groups($usuario->id)->row(),
						'grupos' => $this->ion_auth->groups()->result(),
					);

					
	
			/*echo '<prev>';
			print_r($data);
			echo "</pre>";
			exit();*/
	
					$this->load->view('restrita/layout/header',$data);
					$this->load->view('restrita/usuarios/core');
					$this->load->view('restrita/layout/footer');
			

				}

				

			}

		}

	}

	public function preenche_endereco(){

		if(!$this->input->is_ajax_request()){

			exit('Ação não permitida');

		}

		$this->form_validation->set_rules('user_cep', 'CEP','trim|required|exact_length[9]');

		/*
		*Retornarar os dados para o javascript usuarios.js
		*/
		$retorno = array();


		if($this->form_validation->run()){

			//Cep Validado quanto ao seu formato passamos para  o inicio da requisição


			/*
			*https://viacep.com.br/ws/25615131/json/
			*/

			// formatando o cep de acordo com a api via CEP exemplo acima

			$cep = str_replace("-", "", $this->input->post('user_cep'));

			$url = "https://viacep.com.br/ws/";
			$url .= $cep;
			$url .= "/json/";

			$jsonsite = file_get_contents($url);
			$resultado_requisicao = json_decode($jsonsite);

			

			if(isset($resultado_requisicao->erro)){
				
				$retorno['erro'] = 3;
				$retorno['user_cep'] = 'Por Favor informe um CEP válido';
				$retorno['mensagem'] = 'Por Favor informe um CEP válido';

			}else{

				//print_r($resultado_requisicao);



				$retorno['erro'] = 0;
				$retorno['user_endereco'] = $resultado_requisicao->logradouro;
				$retorno['user_bairro'] = $resultado_requisicao->bairro;
				$retorno['user_cidade'] = $resultado_requisicao->localidade;
				$retorno['user_estado'] = $resultado_requisicao->uf;
				$retorno['mensagem'] = 'Cep encontrado';

			}


		}else{

		// Erros de Validação

		$retorno['erro'] = 3;
		$retorno['user_cep'] = validation_errors();
		$retorno['mensagem'] = validation_errors();

		}

		/*
		*Retorno os dados contidos no retorno

		*/

		echo json_encode($retorno);

	}

	public function uploud_file(){

		$config['upload_path'] = './uploads/usuarios/';
		$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
		$config['encrypt_name'] = true;
		$config['max_size'] = 1048;
		$config['max_width'] = 500;
		$config['max_height'] = 500;
		$config['min_width'] = 350;
		$config['min_height'] = 340;

		//Carregando  bliblioteca o Uploud
		$this->load->library('upload', $config);

		if($this->upload->do_upload('user_foto_file')){

			$data = array(
				'erro' => 0,
				'foto_enviada' => $this->upload->data(),
				'user_foto' => $this->upload->data('file_name'),
				'mensagem'=> 'Foto enviada com sucesso',
			);

			/*
			*Criando a copia numa versão meenor para mobile
			*/

			$config['image_library'] = 'gd2';
			$config['source_image'] = './uploads/usuarios/' . $this->upload->data('file_name');
			$config['new_image'] = './uploads/usuarios/small/' . $this->upload->data('file_name');
			$config['width'] = 300;
			$config['height'] = 280;
			$this->load->library('image_lib', $config);

			// Verificamos se houver erro no resize

			if(!$this->image_lib->resize()){

				$data['erro'] = 3;
				$data['mensagem'] = $this->image_lib->display_errors('<span>', '</span>');

			}


		}else{
			//caso tenha erros no uplouds da imagem

			$data = array(

				'erro'=> 3,
				'mensagem' => $this->upload->display_errors('<span>', '</span>'),
			);
		}

		echo json_encode($data);
	}

}
