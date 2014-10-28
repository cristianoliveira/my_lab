<?php

include_once "model.php";
 
 class UsuariosModel extends Model{
 
	function __construct()
	{
		$this->table  = 'usuarios';
		$this->col_id = 'idusuario';
	}

 }
 
?>