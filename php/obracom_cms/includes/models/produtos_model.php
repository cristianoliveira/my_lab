<?php

include_once "model.php";

class ProdutosModel extends Model{

	function __construct()
    {
        $this->table  = 'produtos';
        $this->col_id = 'idprodutos';
    }
	
}  

?>