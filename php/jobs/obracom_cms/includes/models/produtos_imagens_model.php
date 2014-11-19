<?php

include_once("model.php");

class ProdutosImagensModel extends Model{

    function __construct()
    {
        $this->table  = 'fd_produtos_imagens';
        $this->col_id = 'id';
    }

    public function getImagensFromProduto($idProduto)
    {
        return $this->getWhere("produto_id = $idProduto");
    }
}

?>