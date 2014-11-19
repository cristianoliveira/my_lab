<?php  

include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");


@$codigo = $_REQUEST["2"];



$sql = mysql_query("SELECT * FROM news ORDER BY nome ASC");

$_COOKIE["respostas"]="current";
$_COOKIE["classe6"]="";
$_COOKIE["classe7"]="current";


 
$cont = 0;
// Exibe o resultado da nossa consulta
while ($row = mysql_fetch_array($sql))
{

echo $row['nome']; echo "<br />";
echo $row['email'];    echo "<br />";

// Saída = 01/08/2011 16:30:08


echo "<hr />";

 $cont = $cont + 1; 
}
?> 