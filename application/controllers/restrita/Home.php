<?php

/*
*Controller Responsavel da area restrita
*/

defined('BASEPATH') OR exit('Acação não permitida');

class Home extends CI_Controller{
	public function __construct(){
		parent::__construct();

		/*
		*Definir se há sessão é valida
		*/

		/*
		*Definir se é admin
		*/
		
		
	}
	public function index(){
		$this->load->view('restrita/home/index');
	}
}
