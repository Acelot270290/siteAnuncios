<?php

//Controle responsavel por gerenciar aos Anuncios

defined('BASEPATH') OR exit('Ação não permitida');


/*
*Verificar o arquivo php.ini do wamp saber se a extensção php_openssl está descomentado
*/

/*
*Habilitar na sua conta o envio de emails para aplicativos menos seguros [sem essa confiduração nao funciona no gmail]
*/

$config = array();
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.hostinger.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'contato@infoanuncios.com.br';
$config['smtp_pass'] = 'Acelot.270290';
$config['mailtype'] = 'text';
$config['newline'] = '\r\n'; //sem está linha não funcionar bizarro rs
