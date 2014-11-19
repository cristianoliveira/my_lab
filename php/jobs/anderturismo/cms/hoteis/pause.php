<?php 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

//ATUALIZAR
$codigo_hotel = $_GET["id"];

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM hoteis WHERE idhoteis = %d", $codigo_hotel);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

$_COOKIE["hoteis"]="current";	
$_COOKIE["hoteis1"]="";
$_COOKIE["hoteis2"]="current";

//echo $manda['status']; *debug

$i=$manda['status'];

switch($i){ 
	case 1:  mysql_query(sprintf("UPDATE hoteis SET status = %d WHERE idhoteis = %d", 2, $codigo_hotel)); $mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um status de hotel."; 
	salvaLog($mensagem); $_SESSION['ok'] = "Status de hotel atualizado!"; $_SESSION['ok2']=2; header('Location:listar.php'); break; 
	
	case 2:  mysql_query(sprintf("UPDATE hoteis SET status = %d WHERE idhoteis = %d", 1, $codigo_hotel)); $mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um status de hotel."; 
	salvaLog($mensagem); $_SESSION['ok'] = "Status de hotel atualizado!"; $_SESSION['ok2']=2; header('Location:listar.php'); break; 
}	
?>