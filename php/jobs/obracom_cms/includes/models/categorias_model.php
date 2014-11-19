<?php

 include_once "model.php";

	class CategoriasModel extends Model{

		function __construct()
		{
			$this->table  = 'fd_categorias';
			$this->col_id = 'id';
		}
		
	}  

?>