<?php

/*
 * Method to load css files into your project.
 *
 * Accepts a string or array as parameter.
 * @author Cristian Oliveira
 * @version 1.0
 * @param String $msg

 *  */
if (!function_exists('jalert')) {

	function jalert($msg) {
          return ' <script type="text/javascript">
                    alert("'.$msg.'");
                    </script>';
	}

}

