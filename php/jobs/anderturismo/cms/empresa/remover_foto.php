<?php
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

	$id = $_GET["id"];
	
	$from_delete = sprintf("SELECT * FROM imagens WHERE id = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/imagens/empresa/' . $delete['img']);
	
	$delete_command = sprintf("DELETE FROM imagens WHERE id = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu uma imagem da empresa.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removeu a imagem com sucesso!";
	header('Location:listar.php');


?>