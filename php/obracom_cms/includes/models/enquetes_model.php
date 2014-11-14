<?php

 include_once 'model.php';

class EnquetesModel extends Model{
	
	function __construct()
    {
		$this->table  = 'fd_enquetes';
        $this->col_id = 'id';
    }

} 

?>