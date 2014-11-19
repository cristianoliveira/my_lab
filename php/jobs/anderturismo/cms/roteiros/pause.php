<?php 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

//ATUALIZAR
$codigo_roteiro = $_GET["id"];

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM roteiros WHERE idroteiros = %d", $codigo_roteiro);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

$_COOKIE["roteiros"]="current";	
$_COOKIE["roteiros1"]="";
$_COOKIE["roteiros2"]="current";

//echo $manda['status']; *debug

$i=$manda['status_roteiro'];

switch($i){ 
	case 1:  mysql_query(sprintf("UPDATE roteiros SET status_roteiro = %d WHERE idroteiros = %d", 2, $codigo_roteiro)); $mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Pausou um roteiro."; 
	salvaLog($mensagem); $_SESSION['ok'] = "Pausou um roteiro."; $_SESSION['ok2']=2; header('Location:listar.php'); break; 
	
	case 2:  mysql_query(sprintf("UPDATE roteiros SET status_roteiro = %d WHERE idroteiros = %d", 1, $codigo_roteiro)); $mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Ativou um roteiro."; 
	salvaLog($mensagem); $_SESSION['ok'] = "Ativou um roteiro."; $_SESSION['ok2']=2; header('Location:listar.php'); break; 
}	
?>