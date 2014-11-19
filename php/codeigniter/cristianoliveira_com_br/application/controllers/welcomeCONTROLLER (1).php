<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class welcomeCONTROLLER extends CI_Controller {


	public function index()
	{
		$this->load->helper('url');
		
		$this->load->helper('assets');
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
		$paramVIEW['meta']	= "java, php, android, ruby on rails, c#, tutoriais";
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		$this->load->view('conteudo/homeVIEW');
		$this->load->view('default/rodapeVIEW');
	}
}
