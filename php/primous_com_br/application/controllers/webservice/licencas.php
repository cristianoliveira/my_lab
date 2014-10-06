<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class licencas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('licencas_model','model',TRUE);
        
    }
    
    public function estetisys($chave_usuario)
    {
        echo $this->model->getlicenca($chave_usuario);
    }
    
    public function solicita_trial($app, $chave_usuario)
    {
        if($app=="estetisys")
           $this->model->SolicitaTrial($chave_usuario);
    }
    
    public function data_servidor()
    {
        echo date("Y-m-d");
    }

}
