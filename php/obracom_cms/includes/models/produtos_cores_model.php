<?php

include_once "model.php";

class ProdutosCoresModel extends Model{

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
        if(count($cores)>0)
        {
            $coresFormatada = array();
            foreach ($cores as $value) {
                $coresFormatada['cor']        = $value; 
                $coresFormatada['produto_id'] = $idProduto;
                
                if(!$this->insert($coresFormatada))
                	return false;
            }

            return true;
        }else
            return true;
    }
    
    function updateCoresDoProduto($idProduto, $cores)
    {
        $this->delete("produto_id = $idProduto");
        return $this->insertInProduto($idProduto, $cores);
    }
    
}  

?>