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

}
