<?php

//Controle responsavel por gerenciar as categorias pai

defined('BASEPATH') OR exit('Ação não permitida');

class Sistema extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		//Verifica se está logado

		if (!$this->ion_auth->logged_in())
		{
		  redirect('restrita/login');
		}

		//verifica se é admin

		if (!$this->ion_auth->is_admin())
		{
		  redirect('/');
		}

	}

	public function index(){

		$this->form_validation->set_rules('sistema_razao_social', 'Razão Social','trim|required|min_length[4]|max_length[130]');
		$this->form_validation->set_rules('sistema_nome_fantasia', 'Nome Fantasia','trim|required|min_length[4]|max_length[130]');
		$this->form_validation->set_rules('sistema_cnpj', 'CNPJ','trim|required|exact_length[18]' );
		$this->form_validation->set_rules('sistema_ie', 'Inscrição Estadual','trim|required|min_length[5]|max_length[25]');
		$this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone Fixo','trim|required|exact_length[14]');
		$this->form_validation->set_rules('sistema_telefone_movel', 'Telefone Movel','trim|required|min_length[14]|max_length[15]');
		$this->form_validation->set_rules('sistema_email', 'Email','trim|required|valid_email|min_length[5]|max_length[90]');
		$this->form_validation->set_rules('sistema_site_titulo', 'Titulo do Site','trim|required|min_length[5]|max_length[200]');
		$this->form_validation->set_rules('sistema_cep', 'Titulo do Site','trim|required|exact_length[9]');
		$this->form_validation->set_rules('sistema_endereco', 'Endereço','trim|required|min_length[5]|max_length[200]');
		$this->form_validation->set_rules('sistema_numero', 'Número','trim|max_length[20]');
		$this->form_validation->set_rules('sistema_bairro', 'Bairro','trim|required|min_length[3]|max_length[90]');
		$this->form_validation->set_rules('sistema_cidade', 'Cidade','trim|required|min_length[3]|max_length[40]');
		$this->form_validation->set_rules('sistema_estado', 'Estado','trim|required|exact_length[2]');

		if($this->form_validation->run()){
						/*
						*
						{
						sistema_razao_social: "Anuncios Inc",
						sistema_nome_fantasia: "Anúncios legais",
						sistema_cnpj: "80.838.809/0001-26",
						sistema_ie: "683.90228-49",
						sistema_telefone_fixo: "(41) 3232-3030",
						sistema_telefone_movel: "(41) 9999-9999",
						sistema_email: "anuncioslegais@contato.com.br",
						sistema_site_titulo: "Anúncios legais",
						sistema_cep: "80510-000",
						sistema_endereco: "Rua da Programação",
						sistema_numero: "54",
						sistema_bairro: "Centro",
						sistema_cidade: "Curitiba",
						sistema_estado: "PR"
						},	
						*/
						$data = elements(

							array(
								'sistema_razao_social',
								'sistema_nome_fantasia',
								'sistema_cnpj',
								'sistema_ie',
								'sistema_telefone_fixo',
								'sistema_telefone_movel',
								'sistema_email',
								'sistema_site_titulo',
								'sistema_cep',
								'sistema_endereco',
								'sistema_numero',
								'sistema_bairro',
								'sistema_cidade',
								'sistema_estado'
							),$this->input->post()
						);

						$data = html_escape($data);

						$this->core_model->update('sistema', $data, array('sistema_id' => 1));
						redirect('restrita/' .$this->router->fetch_class());

		}else{

			//Erros de validação

			$data = array(
				'titulo'=>'Genrenciamento do sistema do site',
	
				'scripts'=>array(
	
					'assets/mask/jquery.mask.min.js',
					'assets/mask/custom.js',
				),
	
				'sistema'=> $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
			);
	
			/*echo '<prev>';
			print_r($data['sistema']);
			echo "</pre>";
			exit();*/
	
			$this->load->view('restrita/layout/header',$data);
			$this->load->view('restrita/sistema/index');
			$this->load->view('restrita/layout/footer');
		}

	}
}
