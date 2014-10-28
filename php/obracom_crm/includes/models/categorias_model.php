<?php

 include_once "model.php";

	class CategoriasModel extends Model{

		function __construct()
		{
			$this->table  = 'categorias';
			$this->col_id = 'idcategorias';
		}
		
	}  

?>