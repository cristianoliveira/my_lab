<?php

include_once "model.php";

class BannersModel extends Model{

	function __construct()
    {
        $this->table  = 'fd_banners';
        $this->col_id = 'id';
    }
	
}  

?>