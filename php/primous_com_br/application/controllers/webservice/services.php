<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class services extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function data_servidor()
    {
        echo date("Y-m-d");
    }

}
