<?php

include_once "model.php";

class ProdutosModel extends Model{

	function __construct()
    {
        $this->table  = 'fd_produtos';
        $this->col_id = 'id';
    }
	
}  

?>