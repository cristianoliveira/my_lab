<?php
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$cd = $_GET['cd'];

//DELETAR
if($cd!="")
{


	
	$from_delete = sprintf("SELECT * FROM imagens WHERE id = %d", $cd);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/cervejas/' . $delete['imagem']);
	
	$delete_command = sprintf("DELETE FROM imagens WHERE id = %d", $cd);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu uma foto.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removida foto com sucesso!";
	header('Location:listar.php?p=3&g=2');

}


?>