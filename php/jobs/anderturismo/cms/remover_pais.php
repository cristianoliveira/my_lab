<?php
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

	$id = $_GET['id'];
		$idr = $_GET['idr'];
	
	$delete_command = sprintf("DELETE FROM relacoes_paises_roteiros WHERE id_pais = %d AND id_roteiro= %d", $id, $idr);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu uma imagem do roteiro.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removeu a imagem com sucesso!";
	header('Location:listar.php');


?>