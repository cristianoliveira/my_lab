<?php 
include('database_config.php');

$conexao = mysql_connect("$db_host","$db_user","$db_pass");
$db      = mysql_select_db("$db_database_name");
?>
