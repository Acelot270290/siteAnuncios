<?php

//Controle responsavel por gerenciar as categorias pai

defined('BASEPATH') OR exit('Ação não permitida');

class Categorias extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$data = array(
			'titulo'=>'Categorias Cadastradas',

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
			'categorias'=> $this->core_model->get_all('categorias'),
		);

		/*echo '<prev>';
		print_r($data['masters']);
		echo "</pre>";
		exit();*/

		$this->load->view('restrita/layout/header',$data);
		$this->load->view('restrita/categorias/index');
		$this->load->view('restrita/layout/footer');

	}

	public function core($categoria_pai_id = NULL){

		$categoria_pai_id = (int) $categoria_pai_id;

		if(!$categoria_pai_id){

			/*
			*Cadastrando a Categoria
			*/

			$this->form_validation->set_rules('categoria_pai_nome', 'Categoria Pai' ,'trim|required|min_length[4]|max_length[40]|callback_valida_nome_categoria');
			$this->form_validation->set_rules('categoria_pai_classe_icone', 'Icone da categoria' ,'trim|required|min_length[3]|max_length[20]');


			if($this->form_validation->run()){

				//Formulário validado... salvamos no banco de dados

				/*
				*
					categoria_pai_nome: "Games",
					categoria_pai_classe_icone: "ini-game",
					categoria_pai_ativa: "1",
					categoria_pai_id: "1"
				*/

				$data = elements(
					array(
						'categoria_pai_nome',
						'categoria_pai_classe_icone',
						'categoria_pai_ativa',
					), $this->input->post()
				);

				//definindo o meta link da categoria

				$data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

				$data = html_escape($data);


				$this->core_model->insert('categorias_pai', $data);
				
				redirect('restrita/' . $this->router->fetch_class());
		
			}else{
				//erros de validação

				$data = array(
					'titulo'=>'Adicionando Categoria Pai',
					
				);
		
				/*echo '<prev>';
				print_r($data['categoria']);
				echo "</pre>";
				exit();*/
		
				$this->load->view('restrita/layout/header',$data);
				$this->load->view('restrita/master/core');
				$this->load->view('restrita/layout/footer');
			}

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

					/*
					*
						categoria_pai_nome: "Games",
						categoria_pai_classe_icone: "ini-game",
						categoria_pai_ativa: "1",
						categoria_pai_id: "1"
					*/

					$data = elements(
						array(
							'categoria_pai_nome',
							'categoria_pai_classe_icone',
							'categoria_pai_ativa',
						), $this->input->post()
					);

					//definindo o meta link da categoria

					$data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

					$data = html_escape($data);


					$this->core_model->update('categorias_pai', $data, array('categoria_pai_id'=> $categoria->categoria_pai_id));
					
					redirect('restrita/' . $this->router->fetch_class());
			
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

			if($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome))){

				$this->form_validation->set_message('valida_nome_categoria','Essa categoria já existe');

				return false;

			}else{

				return true;

			}

			}else{

				//Editando

				if($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome, 'categoria_pai_id !='=> $categoria_pai_id))){

					$this->form_validation->set_message('valida_nome_categoria','Essa categoria já existe');

					return false;
			}else{
				return true;
			}

		}
	}

	public function delete($categoria_pai_id = null){

		$categoria_pai_id = (int) $categoria_pai_id;

		If(!$categoria_pai_id || !$categoria = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))){
			$this->session->set_flashdata('erro','Categoria não foi encontrada');
			redirect('restrita/' . $this->router->fetch_class());
		}

		If($categoria->categoria_pai_ativa == 1){
			$this->session->set_flashdata('erro','Não é permitido excluir uma Categoria Pai que esteja Ativa');
			redirect('restrita/' . $this->router->fetch_class());

		}

		/*echo '<pre>';
		print_r($categoria);
		exit;*/

		$this->core_model->delete('categorias_pai', array(
			'categoria_pai_id' => $categoria->categoria_pai_id
		
		));

		redirect('restrita/' . $this->router->fetch_class());

	}

}
