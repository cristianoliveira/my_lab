<?php
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

	$idr = $_GET['idr'];
	
	$delete_command = sprintf("DELETE FROM relacoes_paises_roteiros WHERE id_roteiro= %d", $idr);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Os países foram removidos.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Países removidos com sucesso!";
	header('Location: listar.php');


?>