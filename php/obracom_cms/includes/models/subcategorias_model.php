<?php

include_once "model.php";

class SubcategoriasModel extends Model{

    function __construct()
    {
        $this->table   = "subcategorias";
        $this->col_id  = "idsubcategorias";
    }

}

?>