<?php

 include_once 'model.php';

class EmpresasModel extends Model{

    function __construct()
    {
        $this->table  = 'fd_empresas';
        $this->col_id = 'id';
    }

}

?>