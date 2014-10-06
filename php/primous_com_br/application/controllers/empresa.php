<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class empresa extends CI_Controller {

     public function __construct(){
    	parent::__construct();

		$this->load->helper('url');
		$this->load->helper('menu');
        $this->paramCabecalho['menuItens']	= getMenu(2);
		 // Your own constructor code
		//$this->load->model('noticiasMODEL','noticias',TRUE);
	//$this->paramRodapeVIEW['localizacao'] = $this->noticias->get_html_page('localizacao',FALSE); 

	}

	public function index()
	{   
		$this->load->view('cabecalhoView',$this->paramCabecalho);
		$this->load->view('empresaView');
		$this->load->view('rodapeView');
	}
}
