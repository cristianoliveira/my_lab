<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class produto extends CI_Controller {

     public function __construct(){
    	parent::__construct();

		$this->load->helper('url');
		$this->load->helper('assets');
	         $this->load->helper('menu');
	        $this->paramVIEW['menuItens']	= getMenu(3);
		// Your own constructor code
		//$this->load->model('noticiasMODEL','noticias',TRUE);
	//$this->paramRodapeVIEW['localizacao'] = $this->noticias->get_html_page('localizacao',FALSE); 

	}

	public function index()
	{   
		$this->load->view('cabecalhoFixoView',$this->paramVIEW);
		$this->load->view('produtoView');
                $this->load->view('rodapeView');
	}
}
