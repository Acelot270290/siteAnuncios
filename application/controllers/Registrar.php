<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrar extends CI_Controller {


	public function index(){


				$this->form_validation->set_rules('first_name','Nome','trim|required|min_length[3]|max_length[45]');
				$this->form_validation->set_rules('last_name','Sobrenome','trim|required|min_length[3]|max_length[45]');
				$this->form_validation->set_rules('user_cpf','CPF','trim|required|exact_length[14]|callback_valida_cpf');
				$this->form_validation->set_rules('phone','Telefone','trim|required|min_length[14]|max_length[15]|callback_valida_telefone');
				$this->form_validation->set_rules('email','E-mail','trim|required|valid_email|max_length[150]');
				$this->form_validation->set_rules('user_cep','CEP','trim|required|exact_length[9]');
				$this->form_validation->set_rules('user_endereco','Endereço','trim|required|min_length[5]|max_length[45]');
				$this->form_validation->set_rules('user_numero_endereco','Número','trim|min_length[3]|max_length[45]');
				$this->form_validation->set_rules('user_bairro','Bairro','trim|required|min_length[5]|max_length[45]');
				$this->form_validation->set_rules('user_cidade','Cidade','trim|required|min_length[4]|max_length[45]');
				$this->form_validation->set_rules('user_estado','Estado','trim|required|exact_length[2]');
				$this->form_validation->set_rules('user_foto','Foto do Usuário','required');

				//Validando as senhas

				$this->form_validation->set_rules('password','Senha','trim|required|min_length[6]|max_length[200]');
				$this->form_validation->set_rules('confirma_senha','Confirma Senha','trim|matches[password]');





				if($this->form_validation->run()){

					

					
					$username = $this->input->post('first_name'). ' '. $this->input->post('last_name');
					$password = $this->input->post('password');
					$email = $this->input->post('email');
					
					$additional_data = elements(

						array(

							'first_name',
							'last_name',
							'user_cpf',
							'phone',
							'user_cep',
							'user_endereco',
							'user_numero_endereco',
							'user_bairro',
							'user_cidade',
							'user_estado',
							'user_foto',
							'usuario_id',

						), $this->input->post(),
					);

					//Conta criada como ativa
					$additional_data['active'] = 1;

					

					$group = array('2'); // anunciante

					if($this->ion_auth->register($username, $password, $email, $additional_data, $group)){

						$this->session->set_flashdata('sucesso','Sua conta foi criada com sucesso. Aproveite para fazer o login');
						redirect('login');

					}else{


						$this->session->set_flashdata('erro','Erro ao cadastrar o Usuário');

					// metodo fetch retorna para o controlador principal na view
					redirect($this->router->fetch_class());
					}

			//motando os dados do anunciante e mostrando o total de anuncios cadastrado por ele
	
				}else{

					//erros de validação
						
			$data = array(
				'titulo' => 'Criar Conta',

				'scripts'=>array(
					'assets/mask/jquery.mask.min.js',
					'assets/mask/custom.js',
					'assets/js/registrar.js',
				),


	
			);
		
			
			$this->load->view('web/layout/header',$data);
			$this->load->view('web/registrar/index');
			$this->load->view('web/layout/footer');

				}
	
		

	}

	public function valida_cpf($cpf) {

        if ($this->input->post('usuario_id')) {

			//Editando o usuários

            $usuario_id = $this->input->post('usuario_id');

            if ($this->core_model->get_by_id('users', array('id !=' => $usuario_id, 'user_cpf' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'O campo {field} já existe, ele deve ser único');
                return FALSE;
            }
        }else{
				//Cadastrando usuário

			if ($this->core_model->get_by_id('users', array('user_cpf' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'O campo {field} já existe, ele deve ser único');
                return FALSE;
            }
					
		}

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c); //Se PHP version < 7.4, $cpf{$c}
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) { //Se PHP version < 7.4, $cpf{$c}
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

	public function valida_telefone($phone){

		$usuario_id = $this->input->post('usuario_id');

		if(!$usuario_id){

			//Caso o user nao venha, vamos casdastrar

			if($this->core_model->get_by_id('users', array('phone'=>$phone))){

				$this->form_validation->set_message('valida_telefone','Este telefone já existe');

				return false;

			}else{

				
				return true;
			}

		}else{

			//Estou editano o user

			if($this->core_model->get_by_id('users', array('phone'=>$phone, 'id!=' =>$usuario_id))){

				$this->form_validation->set_message('valida_telefone','Este telefone já existe');

				return false;

			}else{

				
				return true;
			}

		}

	}

	public function valida_email($email){

		$usuario_id = $this->input->post('usuario_id');

		if(!$usuario_id){

			//Caso o user nao venha, vamos casdastrar

			if($this->core_model->get_by_id('users', array('email'=>$email))){

				$this->form_validation->set_message('valida_email','Este e-mail já existe');

				return false;

			}else{
				return true;
			}

		}else{

			//Estou editano o user

			if($this->core_model->get_by_id('users', array('email'=>$email, 'id!=' =>$usuario_id))){

				$this->form_validation->set_message('valida_email','Este e-mail já existe');

				return false;
			}else{
				return true;
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
		$retorno['user_cep'] = form_error('phone', '<div class="text-danger">','</div>');
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
			*Criando a copia numa versão menor para mobile
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
}
