<?php
/*
$conexao = mysql_connect('mysql.andesturismo.com.br','andesturismo02','c1a5k0');
$db = mysql_select_db('andesturismo02');
*/

$conexao = mysql_connect('mysql.andesturismo.com.br','andesturismo02','c1a5k0');
$db = mysql_select_db('andesturismo02');

 @$pegaId = $_GET["id"];
 
//If directory doesnot exists create it.
$output_dir = "../uploads/imagens/roteiros/";

if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
       	 	$fileName = $_FILES["myfile"]["name"];
			
			@$cod = $fileName;
			@$cod = md5($fileName);
			@$cod = $cod . "_" . $pegaId . ".jpg";
			
       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $cod); //$fileName
			
			
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$fileName;
				  
				  mysql_query("INSERT INTO imagens_roteiros (img, id_roteiro) VALUES ('$cod','$pegaId')");
    	
		}
    	else
    	{
    	    	$fileCount = count($_FILES["myfile"]['name']);
    		  for($i=0; $i < $fileCount; $i++)
    		  {
    		  	$fileName = $_FILES["myfile"]["name"][$i];
	       	 	 $ret[$fileName]= $output_dir.$fileName;
				 
				 @$cod = $fileName;
				@$cod = md5($fileName);
				
				@$cod = $cod."_".$pegaId.".jpg";
				 
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir. $cod); //$fileName
								
				  mysql_query("INSERT INTO imagens_roteiros VALUES ('$cod','$pegaId')");
				
    		  }
    	
    	}
    }
    echo json_encode($ret);
 
}

?>