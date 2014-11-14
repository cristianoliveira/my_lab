<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class appCONTROLLER extends CI_Controller {
	
	 public function __construct(){
    	parent::__construct();

		$this->load->helper('url');
		$this->load->helper('assets');
	         // Your own constructor code
		
	}
	
	
	public function mkt(){
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
			
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		$this->load->view('conteudo/app/homeVIEW');
		$this->load->view('default/rodapeVIEW');
		
	}
}
