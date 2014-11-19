<?php

class UrlHelper{
    
    public static function site($url=null)
    {
    	return "http://$_SERVER[SERVER_NAME]". !empty($url) ? "/$url" : "";
    } 
}

?>
