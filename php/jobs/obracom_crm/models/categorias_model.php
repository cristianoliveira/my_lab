<?php
   <?php
//produtos_model.php

include '../models/model.php';

class CategoriasModel extends Model{

	function __construct()
    {
        $this->table  = 'categorias';
        $this->col_id = 'idcategorias';
    }
	
	
	public function get($cols='*', $limit_init=0, $limit_end = 0)
    {
        $this->sqlBuilder->select($cols)
                           ->from($this->table)
                          ->limit($limit_init, $limit_end);
        return $this->get_rows();
    }

	public function getCategorias()
	{
		$this->sqlBuilder->select('*')
		                 ->from($this->table);
		return $this->get_first();
	}

	
}  

?>


?>