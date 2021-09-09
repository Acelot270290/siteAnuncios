<?php

//Controle responsavel por gerenciar as categorias pai

defined('BASEPATH') OR exit('Ação não permitida');

class Master extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$data = array(
			'titulo'=>'Categorias Pai',

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
			'masters'=> $this->core_model->get_all('categorias_pai'),
		);

		/*echo '<prev>';
		print_r($data['masters']);
		echo "</pre>";
		exit();*/

		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/master/index');
		$this->load->view('restrita/layout/footer');

	}

	public function core($categoria_pai_id = NULL){

		$categoria_pai_id = (int) $categoria_pai_id;

		if(!$categoria_pai_id){

			/*
			*Cadastrando a Categoria
			*/

		}else{

			/*
			*Verificamos se a categoria foi informa, ms devemos garantir sua existencia no banco de dados
			*/

			If(!$categoria = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))){

				$this->session->set_flashdata('erro','Categoria não foi encontrada');
				redirect('restrita/' . $this->router->fetch_class());

			}else{
				
				/*
				*Categoria encontrada e passamos para as validações
				*/

				$this->form_validation->set_rules('categoria_pai_nome', 'Categoria Pai' ,'trim|required|min_length[4]|max_length[40]|callback_valida_nome_categoria');
				$this->form_validation->set_rules('categoria_pai_classe_icone', 'Icone da categoria' ,'trim|required|min_length[3]|max_length[20]');


				if($this->form_validation->run()){

					//Formulário validado... salvamos no banco de dados

					echo '<prev>';
					print_r($this->input->post());
					echo "</pre>";
					exit();

				}else{
					//erros de validação

					$data = array(
						'titulo'=>'Editar Categoria Pai',
						'categoria' =>$categoria,
					);
			
					/*echo '<prev>';
					print_r($data['categoria']);
					echo "</pre>";
					exit();*/
			
					$this->load->view('restrita/layout/header',$data);
					$this->load->view('restrita/master/core');
					$this->load->view('restrita/layout/footer');
				}

			}


		}



	}

	public function valida_nome_categoria($categoria_pai_nome){

		$categoria_pai_id = $this->input->post('categoria_pai_id');

		if(!$categoria_pai_id){

			//Cadastrando

			if($this->core_model->get_by_id('categoria_pai', array('categoria_pai_nome' => $categoria_pai_nome))){

				$this->form_validation->set_message('valida_nome_categoria','Essa categoria já existe');

				return false;

			}else{

				return true;

			}

			}else{

				//Editando

				if($this->core_model->get_by_id('categoria_pai', array('categoria_pai_nome' => $categoria_pai_nome, 'categoria_pai_id !='=> $categoria_pai_id))){

					$this->form_validation->set_message('valida_nome_categoria','Essa categoria já existe');

					return false;
			}else{
				return true;
			}

		}
	}

}
