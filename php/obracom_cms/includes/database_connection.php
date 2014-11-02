<?php 
include(dirname(__FILE__) .'/database_config.php');

$conexao = mysqli_connect("$db_host", "$db_user","$db_pass");
$db      = mysqli_select_db($conexao, "$db_database_name");

?>
