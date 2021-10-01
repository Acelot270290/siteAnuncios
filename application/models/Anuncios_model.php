<?php

//Funções qie será utilizada na area restrita e publica

defined('BASEPATH') OR exit('Ação não permitida');

class Anuncios_model extends CI_Model{

//Função que losta todos os anuncios do anuciante logado e tbm lista todos os anuncios para o admin

	public function get_all($user_id = NULL){
		$this->db->select([
			'anuncios.*',
			'categorias.categoria_nome',
			'categorias_pai.categoria_pai_nome',
			'users.id',
			'users.first_name',
			'users.last_name',
			'anuncios_fotos.foto_nome',

		]);


		//Se foi informado o user id retorna apenas os anuncios daquele usuario(anuciante)
		if($user_id){
			$this->db->where('anuncios.anuncio_user_id', $user_id);

		}

		//Criação dos joins

		$this->db->join('categorias', 'categorias.categoria_id = anuncios.anuncio_categoria_id','LEFT');
		$this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id','LEFT');
		$this->db->join('anuncios_fotos', 'anuncios_fotos.foto_anuncio_id = anuncios.anuncio_id','LEFT');
		$this->db->join('users', 'users.id = anuncios.anuncio_user_id','LEFT');

		$this->db->group_by('anuncios.anuncio_id');
		return $this->db->get('anuncios')->result();
	}

	//Exibe todos os anuncios de forma randomica
	public function get_all_anuncios_radom($condicoes = NULL){

		$this->db->select([
			'anuncios.*',
			'categorias.categoria_nome',
			'categorias.categoria_meta_link',
			'categorias_pai.categoria_pai_nome',
			'categorias_pai.categoria_pai_meta_link',
			'anuncios_fotos.foto_nome',
			'users.first_name',
			'users.last_name',

		]);

		$this->db->where($condicoes);


		//Criação dos joins

		$this->db->join('categorias', 'categorias.categoria_id = anuncios.anuncio_categoria_id','LEFT');
		$this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id','LEFT');
		$this->db->join('anuncios_fotos', 'anuncios_fotos.foto_anuncio_id = anuncios.anuncio_id','LEFT');
		$this->db->join('users', 'users.id = anuncios.anuncio_user_id','LEFT');


		$this->db->order_by('anuncios.anuncio_id','RANDOM');
		$this->db->group_by('anuncios.anuncio_id');
		return $this->db->get('anuncios')->result();
	}


	/*
	*Função para editar um anuncio na area restrita e também na area publica
	*/
	public function get_by_id($condicoes = NULL){
		$this->db->select([
			'anuncios.*',
			'categorias.categoria_id',
			'categorias.categoria_nome',
			'categorias.categoria_meta_link',
			'categorias_pai.categoria_pai_nome',
			'categorias_pai.categoria_pai_meta_link',
			'users.id',
			'CONCAT(users.first_name, " ", users.last_name) as nome_anunciante',
			'users.phone as telefone_anunciante',
			'users.created_on as anunciante_desde',
			'users.user_foto',


		]);


		if(is_array($condicoes)){
			$this->db->where($condicoes);

		}

		//Criação dos joins

		$this->db->join('categorias', 'categorias.categoria_id = anuncios.anuncio_categoria_id');
		$this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = anuncios.anuncio_categoria_pai_id');
		$this->db->join('users', 'users.id = anuncios.anuncio_user_id');

		return $this->db->get('anuncios')->row();
	}

	//recuperamos todas as categorias pai onde a categoria filha esteja atrelada a categoria pai (usamos no editar anuncios)
	public function get_all_categorias_pai(){

		$this->db->select([
			'categorias_pai.*',
		]);

		$this->db->where('categorias_pai.categoria_pai_ativa', 1);

		$this->db->join('categorias','categorias.categoria_pai_id = categorias_pai.categoria_pai_id');

		$this->db->group_by('categorias_pai.categoria_pai_id');

		return $this->db->get('categorias_pai')->result();

	}

	/*
	*Recuperamos todas as Categorias pai atrelhada publicados 
	*/

	public function get_all_categorias_pai_home(){

		$this->db->select([
			'categorias_pai.*',
			'COUNT(categoria_pai_id) as quantidade_anuncios'


		]);

		$this->db->where('categoria_pai_ativa',1);
		$this->db->where('anuncios.anuncio_publicado',1);

		$this->db->join('anuncios', 'anuncios.anuncio_categoria_pai_id = categorias_pai.categoria_pai_id');

		$this->db->group_by('categoria_pai_nome', 'ASC');

		return $this->db->get('categorias_pai')->result();


	}

	public function get_categorias_filhas_navbar(){

		$this->db->select([
			'categorias.*',


		]);

		$this->db->where('categoria_ativa',1);
		$this->db->where('anuncios.anuncio_publicado',1);

		$this->db->limit(4);

		$this->db->join('anuncios', 'anuncios.anuncio_categoria_id = categorias.categoria_id');

		$this->db->order_by('categoria_id', 'RANDOM');
		$this->db->group_by('categoria_id');

		return $this->db->get('categorias')->result();


	}


	//metodo que retorna os anuncios por estados, cidades, bairros e cidades e catgorias
	public function get_all_by($condicoes = null){

		if(is_array($condicoes)){

			$this->db->select([
				'anuncios.*',
				'categorias.categoria_id',
				'categorias.categoria_nome',
				'categorias.categoria_meta_link',
				'categorias_pai.categoria_pai_nome',
				'categorias_pai.categoria_pai_meta_link',
				'anuncios_fotos.foto_nome',
				'users.first_name',
				'users.last_name',
	
			]);

			$this->db->where('anuncios.anuncio_publicado',1);
			$this->db->where($condicoes);

			$this->db->group_by('anuncios.anuncio_id');

		$this->db->join('categorias', 'categorias.categoria_id = anuncios.anuncio_categoria_id','LEFT');
		$this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id','LEFT');
		$this->db->join('anuncios_fotos', 'anuncios_fotos.foto_anuncio_id = anuncios.anuncio_id','LEFT');
		$this->db->join('users', 'users.id = anuncios.anuncio_user_id','LEFT');

		return $this->db->get('anuncios')->result();
	

		}

	}

	//Recuperamos os anuncios de acordo com o temo digitado no input busca na navbar
	public function get_all_by_busca($busca = null){
		$this->db->select([
			'anuncios.*',
			'categorias.categoria_nome',
			'categorias.categoria_meta_link',
			'categorias_pai.categoria_pai_nome',
			'categorias_pai.categoria_pai_meta_link',
			'users.id',
			'users.first_name',
			'users.last_name',
			'anuncios_fotos.foto_nome',

		]);


		$this->db->like('anuncios.anuncio_titulo', $busca, 'BOTH');
		$this->db->where('anuncios.anuncio_publicado', 1);

		//Criação dos joins

		$this->db->join('categorias', 'categorias.categoria_id = anuncios.anuncio_categoria_id','LEFT');
		$this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id','LEFT');
		$this->db->join('anuncios_fotos', 'anuncios_fotos.foto_anuncio_id = anuncios.anuncio_id','LEFT');
		$this->db->join('users', 'users.id = anuncios.anuncio_user_id','LEFT');

		$this->db->group_by('anuncios.anuncio_id');
		return $this->db->get('anuncios')->result();
	}

	//recuperamos da tabela de historico todas as perguntas do anuncio que está sendo detalhado do controle
	public function get_perguntas_anuncio_historico($condicoes = null){


		if(is_array($condicoes)){
			$this->db->select([
			'anuncios_perguntas_historico.*',
			'anuncios.anuncio_titulo',
			'anuncios_fotos.foto_nome',
			'users.user_foto',
			'users.id as anunciante_id',
			'users.first_name as nome_anunciante_pergunta'
			]);

			$this->db->where($condicoes);

			$this->db->join('anuncios', 'anuncios.anuncio_id = anuncios_perguntas_historico.anuncio_id');
			$this->db->join('anuncios_fotos', 'anuncios_fotos.foto_anuncio_id = anuncios.anuncio_id');
			$this->db->join('users', 'users.id = anuncios_perguntas_historico.anunciante_pergunta_id');

			$this->db->order_by('anuncios_perguntas_historico.data_pergunta','DESC');

			$this->db->group_by('anuncios_perguntas_historico.pergunta');

			return $this->db->get('anuncios_perguntas_historico')->result();
		}else{
			return false;
		}
	}




}
