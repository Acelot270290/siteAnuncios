<?php

defined('BASEPATH') OR exit('Ação não Permitida');

class Core_model extends CI_Model	{

	public function get_all($tabela = NULL, $condicoes = NULL, $limite = NULL){

		if($tabela && $this->db->table_exists($tabela)){

			if(is_array($condicoes)){

				$this->db->where($condicoes);

			}

			if($limite){
				$this->db->limit($limite);
			}

			$this->db->order_by(1, 'DESC');

			return $this->db->get($tabela)->result();

		}else{
			return false;
		}

	}

	public function get_by_id($tabela = NULL, $condicoes = NULL){

		if($tabela && $this->db->table_exists($tabela) && is_array($condicoes)){

			$this->db->where($condicoes);
			$this->db ->limit('1');


			return $this->db->get($tabela)->row();

		}else{
			return false;
		}

	}

	public function insert($tabela = NULL, $data = NULL, $get_last_id = NULL){

		if($tabela && $this->db->table_exists($tabela) && is_array($data)){

			$this->db->insert($tabela, $data);

			// verifica o ultimo id para inserir no banco de dados
			if($get_last_id){

				$this->session->set_userdata('last_id', $this->db->insert_id());

			}

			if($this->db->affected_rows() > 0){

				$this->session->set_flashdata('sucesso', 'Dados salvo com sucesso');

			}else{
				$this->session->set_flashdata('erro', 'Erro ao Salvar os dados');


			}
		}else{
			return false;
		}

	}

	public function update($tabela = NULL, $data = NULL, $condicoes = NULL){

		if($tabela && $this->db->table_exists($tabela) && is_array($data) && is_array($condicoes)){
			

			if($this->db->update($tabela, $data, $condicoes)){

				$this->session->set_flashdata('sucesso','Dados salvo com sucesso');

			}else{
				$this->session->set_flashdata('erro', 'Erro ao Salvar os dados');

			}
		}else{
			
			return false;
		}

	

	}

	public function delete($tabela = NULL, $condicoes = NULL){

		if($tabela && $this->db->table_exists($tabela) && is_array($condicoes)){
			

			if($this->db->delete($tabela = NULL, $condicoes= NULL)){

				$this->session->set_flashdata('sucesso','Registro deletado com Sucesso');

			}else{
				$this->session->set_flashdata('erro', 'Erro ao tentar deletar');

			}
		}	else{
			return false;
		}

	

	}

	public function generate_unique_code($tabela = NULL, $tipo_codigo = NULL, $tamanho_codigo = NULL, $campo_procura = NULL ){

		do{

			$codigo = random_string($tipo_codigo, $tamanho_codigo);
			$this->db->where($campo_procura, $codigo);
			$this->db->from($tabela);


		}while($this->db->count_all_results() >= 1);

		return $codigo;

	}

	public function count_all_results($tabela = NULL, $condicoes = NULL){

		if($tabela && $this->db->table_exists($tabela)){

			if(is_array($condicoes)){

				$this->db->where($condicoes);

			}

			return $this->db->count_all_results($tabela);



		}else{
			return false;
		}


	}
}


