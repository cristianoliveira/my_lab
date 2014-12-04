<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$data = array(
			'header' => $this->load->view('layout/header','',true),
	        'footer' => $this->load->view('layout/footer','',true)
		);
		
		$this->load->view('main/content', $data);
	}
}