<?php

include_once "model.php";

class DestaquesModel extends Model{

	function __construct()
    {
        $this->table  = 'fd_destaques';
        $this->col_id = 'id';
    }
	
}  

?>