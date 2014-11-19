<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class clientes extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('menu');
        $this->load->helper('jalert');
        $this->load->helper('form');
        $this->load->library('cliente');
        

        $this->paramCabecalho['menuItens'] = getMenu(4);
     }

    public function index() {
        $this->var['cliente'] = new cliente();
        
        $this->load->view('cabecalhoView', $this->paramCabecalho);
        $this->load->view('clientes/cadastroView', $this->var);
        $this->load->view('rodapeView');
    }

}
