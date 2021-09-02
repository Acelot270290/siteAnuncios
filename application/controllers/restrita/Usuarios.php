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


			$cr = curl_init();

			//definindo a url de busca
			curl_setopt($cr, CURLOPT_URL, $url);
			

			//curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);

			$resultado_requisicao = curl_exec($cr);
			

			//curl_close($cr);

			//transformando o resultado em um objeto para facilitar o acesso ao seus atributos
			$resultado_requisicao = json_decode($resultado_requisicao);


			echo '<prev>';
			print_r($resultado_requisicao);
			exit();


		}else{
			// Erros de Validação
		}

	}

}
