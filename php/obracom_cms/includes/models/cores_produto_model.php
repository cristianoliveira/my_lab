<?php

include_once "model.php";

class CoresProdutoModel extends Model{

	function __construct()
    {
        $this->table  = 'fd_produtos_cores';
        $this->col_id = 'id';
    }
	
	function getCoresByProdutoId($id)
	{
		$this->buildSql()->select("*")
		                 ->from($this->table)
						 ->where("produto_id = $id");
		return $this->get_rows();
	}
	
	
	function insertInProduto($idProduto, $cores)
	{
		$cores['produto_id'] = $idProduto;
		return $this->insert($cores);
	}
	
	function updateCoresDoProduto($idProduto, $cores)
	{
		$this->delete("produto_id = $idProduto");
		$this->insertInProduto($idProduto, $cores);
	}
	
}  

?>