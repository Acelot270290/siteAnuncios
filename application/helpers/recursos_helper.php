<?php

defined('BASEPATH') or exit('Ação não permitida');


function url_amigavel($string = NULL) {
    $string = remove_acentos($string);
    return url_title($string, '-', TRUE);
}

function remove_acentos($string = NULL) {
    $procurar = array('À', 'Á', 'Ã', 'Â', 'É', 'Ê', 'Í', 'Ó', 'Õ', 'Ô', 'Ú', 'Ü', 'Ç', 'à', 'á', 'ã', 'â', 'é', 'ê', 'í', 'ó', 'õ', 'ô', 'ú', 'ü', 'ç');
    $substituir = array('a', 'a', 'a', 'a', 'e', 'r', 'i', 'o', 'o', 'o', 'u', 'u', 'c', 'a', 'a', 'a', 'a', 'e', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'c');
    return str_replace($procurar, $substituir, $string);
}

function formata_data_banco_com_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Segunda-feira";
    } elseif ($dia_sem == 2) {
        $semana = "Terça-feira";
    } elseif ($dia_sem == 3) {
        $semana = "Quarta-feira";
    } elseif ($dia_sem == 4) {
        $semana = "Quinta-feira";
    } elseif ($dia_sem == 5) {
        $semana = "Sexta-feira";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano . ' ' . $hora;
}

function formata_data_banco_sem_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Segunda-feira";
    } elseif ($dia_sem == 2) {
        $semana = "Terça-feira";
    } elseif ($dia_sem == 3) {
        $semana = "Quarta-feira";
    } elseif ($dia_sem == 4) {
        $semana = "Quinta-feira";
    } elseif ($dia_sem == 5) {
        $semana = "Sexta-feira";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano;
}

//Função recupera as informações do website para ser usado no header ou footer
function info_header_footer(){

	$CI = &get_instance();

	$sistema = $CI->core_model->get_by_id('sistema', array('sistema_id'=>1));

	return $sistema;
}

/*
*Recupera as informações do anunciante do sidebar
*/
function get_info_anunciante(){

	$CI = &get_instance();

	$anunciante = $CI->ion_auth->user()->row();

	return $anunciante;
}

//recuperamos as categorias pai para ser exibida na area publica
function categorias_pai_sidebar(){


	$CI = & get_instance();

	$categorias_pai = $CI->anuncios_model->get_all_categorias_pai_home();

	return $categorias_pai;
}

// recuperamos as perguntas feitas para exibir na area do anunciante e que esteja sem resposta
function get_perguntas_sem_respostas(){


	$CI = & get_instance();

	$user_id = $CI->session->userdata('user_id');

	$perguntas_sem_resposta = $CI->core_model->count_all_results('anuncios_perguntas',array('pergunta_respondida' => 0, 'anuncio_user_id'=> $user_id));

	return $perguntas_sem_resposta;
}

// Categorias filhas exibidas na navbar
function categorias_filhas_navbar(){


	$CI = & get_instance();

	$categorias = $CI->anuncios_model->get_categorias_filhas_navbar();

	
	return $categorias;
}

// recuperamos os anuncios que precisa ser editados na navbar da area restrita
function get_anuncios_nao_editados(){


	$CI = & get_instance();

$anuncios_nao_editados = $CI->core_model->count_all_results('anuncios', array('anuncio_publicado'=>0));


	return $anuncios_nao_editados;
}

// mostra na navbar contas bloqueadas
function get_contas_bloqueadas(){


	$CI = & get_instance();

$contas_bloqueadas = $CI->core_model->count_all_results('users', array('active'=>0));


	return $contas_bloqueadas;
}
