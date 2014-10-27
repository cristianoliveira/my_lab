<?php
//produtos_model.php

include '../models/model.php';

class ProdutosModel extends Model{

	const TABLE_PRODUTO   = 'produtos';
	
	function __construct()
    {
        $this->table  = 'produtos';
        $this->col_id = 'idprodutos';
    }
	
	
	public function get($cols='*', $limit_init=0, $limit_end = 0)
    {
        $this->sqlBuilder->select($cols)
                           ->from($this->table)
                          ->limit($limit_init, $limit_end);
        return $this->get_rows();
    }
	
}  

?>