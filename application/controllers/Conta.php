<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Verifica se está logado

		if (!$this->ion_auth->logged_in())
		{
		  redirect('login');
		}

	}

	public function index(){

		//motando os dados do anunciante e mostrando o total de anuncios cadastrado por ele

		$anunciante = get_info_anunciante();

		$data = array(
			'titulo' => 'Gerenciar minha conta',
			'anunciante' => $anunciante,
			'total_anuncios_cadastrados'=>$this->core_model->count_all_results('anuncios', array('anuncio_user_id'=> $anunciante->id)),

		);
	
		
		$this->load->view('web/layout/header',$data);
		$this->load->view('web/conta/index');
		$this->load->view('web/layout/footer');
	}


	public function perfil(){

		/*
		*Recuperamos o login do user para edição no perfil
		*/

		$user_id = $this->session->userdata('user_id');

	 //se a variavel nao tiver um valor caimos no login 
		if(!$user_id){
			redirect('login');

		}else{

			//tesmos os dados e podemos continuar com a edição


			$usuario = get_info_anunciante();

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

				$this->form_validation->set_rules('password','Senha','trim|min_length[6]|max_length[200]');
				$this->form_validation->set_rules('confirma_senha','Confirma Senha','trim|matches[password]');





				if($this->form_validation->run()){

					//print_r($this->input->post());
					

					/*
					* Entualizando os dados no banco

					first_name: "Alan",
					last_name: "Diniz",
					user_cpf: "142.061.837-75",
					phone: "(24) 99232-3522",
					email: "contato@adsites.org",
					user_cep: "25615-131",
					user_endereco: "Rua Dr. Bojean",
					user_numero_endereco: "1042",
					user_bairro: "Esperança",
					user_cidade: "Petrópolis",
					user_estado: "RJ",
					active: "1",
					perfil: "1",
					user_foto: "user-5.jpg",
					usuario_id: "1"
					*/

					$data = elements(

						array(

							'first_name',
							'last_name',
							'password',
							'user_cpf',
							'phone',
							'email',
							'user_cep',
							'user_endereco',
							'user_numero_endereco',
							'user_bairro',
							'user_cidade',
							'user_estado',
							'user_foto',

						), $this->input->post(),
					);

					// removo do array data o password caso o mesmo nao seja informado, pois não é obrigatorio
					if(!$data['password']){

						unset($data['password']);

					}

	
					$id = $usuario->id;
					
					if($this->ion_auth->update($id, $data)){


						//mensagem de dados salvo com sucesso
						$this->session->set_flashdata('sucesso','Seu Perfil foi Atualizado com Sucesso!');
					}else{
						//mensagem de erro de dados não salvo com sucesso
						$this->session->set_flashdata('erro','Erro aao atualizar o seu Perfil');
					}
					// metodo fetch retorna para o controlador principal na view
					redirect($this->router->fetch_class() . '/perfil');

			//motando os dados do anunciante e mostrando o total de anuncios cadastrado por ele
	
				}else{

					//erros de validação
						
			$data = array(
				'titulo' => 'Gerenciar o meu perfil',

				'scripts'=>array(
					'assets/mask/jquery.mask.min.js',
					'assets/mask/custom.js',
					'assets/js/anunciantes.js',
				),


				'usuario' => $usuario,
	
			);
		
			
			$this->load->view('web/layout/header',$data);
			$this->load->view('web/conta/perfil');
			$this->load->view('web/layout/footer');

				}
			


		}

	}

	public function anuncios(){

		//motando os dados do anunciante e mostrando o total de anuncios cadastrado por ele

		$anunciante = get_info_anunciante();

		$data = array(
			'titulo' => 'Meus Anúncios',

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
		);

		//só enviamos para a view se existir pelo menos um anuncio cadastrado do anunciante logado
		if($anuncios = $this->anuncios_model->get_all($anunciante->id)){
			$data['anuncios'] = $anuncios;
		}
		


		

		
		$this->load->view('web/layout/header',$data);
		$this->load->view('web/conta/anuncios');
		$this->load->view('web/layout/footer');
	}

	public function perguntas(){

		//motando os dados do anunciante e mostrando o total de anuncios cadastrado por ele

		$anunciante = get_info_anunciante();

		$data = array(
			'titulo' => 'Perguntas Realizadas',

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
		);

		//só enviamos para a view se existir pelo menos uma pergunta realizada
		if($perguntas = $this->core_model->get_all('anuncios_perguntas', array('anuncio_user_id' =>$this->session->userdata('user_id')))){
			$data['perguntas'] = $perguntas;
		}

		/*print_r($perguntas);
		exit();*/
		


		

		
		$this->load->view('web/layout/header',$data);
		$this->load->view('web/conta/perguntas');
		$this->load->view('web/layout/footer');
	}

	public function core($anuncio_id=NULL){

		//Função só será utilizada para cadastrar ou editar um anuncio

		$anuncio_id = (int) $anuncio_id;

		if(!$anuncio_id){

			//Cadastrando

			$this->form_validation->set_rules('anuncio_titulo','Título do anúncio','trim|required|min_length[4]|max_length[240]');
			$this->form_validation->set_rules('anuncio_preco','Preço', 'trim|required');
			$this->form_validation->set_rules('anuncio_categoria_pai_id','Categoria Principal', 'trim|required');
			$this->form_validation->set_rules('anuncio_categoria_id','Subcategoria', 'trim|required');
			$this->form_validation->set_rules('anuncio_situacao','Situação do produto', 'trim|required');
			$this->form_validation->set_rules('anuncio_localizacao_cep','Localização do Anúncio','trim|required|exact_length[9]');
			$this->form_validation->set_rules('anuncio_descricao','Título do anúncio','trim|required|min_length[10]|max_length[5000]');
			
			
			$fotos_produtos = $this->input->post('fotos_produtos');

			//Para validarmos as fotos tipo array, temos que fazer desta forma
			if(!$fotos_produtos){

				$this->form_validation->set_rules('fotos_produtos','Imagens do item','trim|required');

			}

			if($this->form_validation->run()){

		
				
						
						$data = elements(

							array(

								'anuncio_codigo',
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
						*Precisamos validar novamente o anuncio portando deixamos o mesmo não publicado até aprovação
						*/

						$data['anuncio_publicado'] = 0;

						//Referenciando o id do anunciante logado

						$data['anuncio_user_id'] = $this->session->userdata('user_id');


						/*
						*Recuperamos a sessão obejto anuncio endereço sessao
						*/
													
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


						

						//removendo a virgula do preço para inserir no banco
						$data['anuncio_preco'] = str_replace(',', '',$data['anuncio_preco']);

						//Cadastramos o anuncio no banco de dados e recupreamos o ultimo id da tabela anucios
						$this->core_model->insert('anuncios', $data, TRUE);

						$anuncio_id = $this->session->userdata('last_id');

	


						$fotos_produtos = $this->input->post('fotos_produtos');

						//Contamos quantas imagens vieram no input
						$total_fotos = count($fotos_produtos);

						for($i = 0; $i < $total_fotos; $i++){
							$data = array(
								'foto_anuncio_id' => $anuncio_id,
								'foto_nome' => $fotos_produtos[$i],
							);

								$this->core_model->insert('anuncios_fotos', $data);

						}

						$anunciante = $this->ion_auth->user($anuncio->anuncio_user_id)->row();

							/*
							*montamos um objeto com todos os dados site
							*/
							$sistema = info_header_footer();
							$this->email->set_mailtype("html");
							$this->email->set_newline("\r\n");
							$from_email = $sistema->sistema_email;
							$to_email = $anunciante->email;

							$this->email->from($from_email, $sistema->sistema_nome_fantasia);
							$this->email->to($to_email);
							$this->email->subject('Falta muito pouco para o seu anúncio ser publicado!');
							$this->email->message('Olá ' . $anunciante->first_name . ' ' . $anunciante->last_name . ' seu anúncio está em análise e em breve será publicado<br><br>'
							.'Assim que isso ocorrer enviaremos um e-mail informando você<br>'
							.'<strong>Título do anúncio: </strong>&nbsp;' . $this->input->post('anuncio_titulo'));

							$this->load->library('encryption'); //evita o envio de span

							if($this->email->send(FALSE)){

								/*
								* O email foi enviado
								*/


							}else{

								/*
								* erro de enviar o email e jogamos no flashdata para verificar os erros
								*/

								$this->session->set_flashdata("erro", $this->email->print_debugger('header'));


							}

								
						redirect($this->router->fetch_class().'/anuncios');
			}else{

				//Erros de Validação

				$data = array(
					'titulo'=>' Cadastrar Anúncio',
					
		
					'styles'=>array(
						'assets/jquery-upload-file/css/uploadfile.css',
						'assets//select2/select2.min.css',
					),
		
					'scripts'=>array(
						'assets/sweetalert2/sweetalert2.all.min.js',// para confirma a exclusão da imagem do formulário
						'assets/jquery-upload-file/js/jquery.uploadfile.js',
						'assets/jquery-upload-file/js/anuncios.js',
						'assets/mask/jquery.mask.min.js',
						'assets/mask/custom.js',
						'assets/select2/select2.min.js',
						'assets/js/anuncios.js',

		
					),
					'codigo_gerado'=> $this->core_model->generate_unique_code('anuncios', 'numeric', 8, 'anuncio_codigo'),
					
					'categorias_pai'=>$this->anuncios_model->get_all_categorias_pai(),

				);
		
		
				/*echo '<prev>';
				print_r($data);
				echo "</pre>";
				exit();*/
		
				$this->load->view('web/layout/header',$data);
				$this->load->view('web/conta/core');
				$this->load->view('web/layout/footer');


			}


		}else{

			//editando...


					//Verificamos se  anuncio id na base de dados

		if(!$anuncio = $this->anuncios_model->get_by_id(array('anuncio_id'=> $anuncio_id))){

			//Cadastrando

			$this->session->flashdata('erro','Anúncio não encontrado');

			redirect($this->router->fetch_class().'/anuncios');


		}else{

			/*
			*Garantimos que o anunciante só pode editar o seu
			*/

			if($anuncio->anuncio_user_id != $this->session->userdata('user_id')){

	
				$this->session->flashdata('erro','Este Anúncio não está atribuido a sua conta de anunciante.');
	
				redirect($this->router->fetch_class().'/anuncios');
			}

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
						*Precisamos validar novamente o anuncio portando deixamos o mesmo não publicado até aprovação
						*/

						$data['anuncio_publicado'] = 0;

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

						$anunciante = $this->ion_auth->user($anuncio->anuncio_user_id)->row();

							/*
							*montamos um objeto com todos os dados site
							*/
							$sistema = info_header_footer();
							$this->email->set_mailtype("html");
							$this->email->set_newline("\r\n");
							$from_email = $sistema->sistema_email;
							$to_email = $anunciante->email;

							$this->email->from($from_email, $sistema->sistema_nome_fantasia);
							$this->email->to($to_email);
							$this->email->subject('Falta muito pouco para o seu anúncio ser publicado!');
							$this->email->message('Olá ' . $anunciante->first_name . ' ' . $anunciante->last_name . ' seu anúncio está em análise e em breve será publicado<br><br>'
							.'Assim que isso ocorrer enviaremos um e-mail informando você<br>'
							.'<strong>Título do anúncio: </strong>&nbsp;' . $this->input->post('anuncio_titulo'));

							$this->load->library('encryption'); //evita o envio de span

							if($this->email->send(FALSE)){

								/*
								* O email foi enviado
								*/


							}else{

								/*
								* erro de enviar o email e jogamos no flashdata para verificar os erros
								*/

								$this->session->set_flashdata("erro", $this->email->print_debugger('header'));


							}

								
						redirect($this->router->fetch_class().'/anuncios');
			}else{

				//Erros de Validação

				$data = array(
					'titulo'=>' Editar Anúncio',
					
		
					'styles'=>array(
						'assets/jquery-upload-file/css/uploadfile.css',
						'assets//select2/select2.min.css',
					),
		
					'scripts'=>array(
						'assets/sweetalert2/sweetalert2.all.min.js',// para confirma a exclusão da imagem do formulário
						'assets/jquery-upload-file/js/jquery.uploadfile.js',
						'assets/jquery-upload-file/js/anuncios.js',
						'assets/mask/jquery.mask.min.js',
						'assets/mask/custom.js',
						'assets/select2/select2.min.js',
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
		
				$this->load->view('web/layout/header',$data);
				$this->load->view('web/conta/core');
				$this->load->view('web/layout/footer');


			}




		}

		}

	}

	public function responder($pergunta_id = null){

		$pergunta_id = (int) $pergunta_id;

		if(!$pergunta_id || !$pergunta = $this->core_model->get_by_id('anuncios_perguntas', array('pergunta_id'=>$pergunta_id, 'anuncio_user_id'=>$this->session->userdata('user_id')))){

			$this->session->set_flashdata('erro', 'Não encontramos a pergunta ou ela não está associada ao seu anúncio');
			redirect($this->router->fetch_class().'/perguntas');

		}else{

			/*
			* Perguntada encontrada e passamos para a validação do formulario
			*/

			$this->form_validation->set_rules('resposta', 'Sua reposta', 'trim|min_length[4]|max_length[200]');

			if($this->form_validation->run()){

				/*print($this->input->post());
				exit();*/

			}else{


				$data = array(
					'titulo' => 'Responder Perguntas',
					'pergunta'=> $pergunta

				);

				print_r($data);
				exit();
			
				
				$this->load->view('web/layout/header',$data);
				$this->load->view('web/conta/responder');
				$this->load->view('web/layout/footer');

			}
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

	/*
	* Função que deleta o anuncios
	*/
	public function delete($anuncio_id = NULL){

		$anuncio_id = (int) $anuncio_id;

		if(!$anuncio_id || !$anuncio =  $this->anuncios_model->get_by_id(array('anuncio_id'=> $anuncio_id))){

			//Cadastrando

			$this->session->flashdata('erro','Anúncio não encontrado');

			redirect($this->router->fetch_class().'/anuncios');
		}

		if(!$anuncio_id || !$anuncio =  $this->anuncios_model->get_by_id(array('anuncio_id'=> $anuncio_id))){

			//Cadastrando

			$this->session->flashdata('erro','Anúncio não encontrado');

			redirect($this->router->fetch_class().'/anuncios');
		}

		// Garantimos que o anunciante só pode excluir o seu anúncio e não de outros users

		if($anuncio->anuncio_user_id != $this->session->userdata('user_id')){

	
			$this->session->flashdata('erro','Este Anúncio não está atribuido a sua conta de anunciante.');

			redirect($this->router->fetch_class().'/anuncios');
		}

		//Recuperamos todas as imagens do anuncio
		$fotos_anuncio = $this->core_model->get_all('anuncios_fotos',array('foto_anuncio_id' =>$anuncio->anuncio_id));

		//Excluindo o anuncio 

		$this->core_model->delete('anuncios',array('anuncio_id'=>$anuncio->anuncio_id) );

		//exluindo as imagens do anuncio
		if($fotos_anuncio){

			foreach($fotos_anuncio as $foto){

				$foto_grande = FCPATH . 'uploads/anuncios/'.$foto->foto_nome;
				$foto_pequena = FCPATH . 'uploads/anuncios/'.$foto->foto_nome;

				if(file_exists($foto_grande)){
					unlink($foto_grande);
				}
				if(file_exists($foto_pequena)){
					unlink($foto_pequena);
				}

			}
		}

		redirect($this->router->fetch_class().'/anuncios');

	}

}
