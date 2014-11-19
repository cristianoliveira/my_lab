<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$pega      = $_GET["a"]; //pega o get

$nomeTabela = "empresa";
$camposForm = "'',''";

// *** FAZ O CADASTRO NO BANCO DOS BANNERS DE DESTAQUES ***
if(@$pega==1){

	@$descricao = addslashes($_POST['descricao']);
	@$imagem1   = $_FILES['imagem1'];

	if (!empty($_POST)) {
	
	  $insert_command = sprintf("INSERT INTO empresa (imagem1, descricao) VALUES ('%s', '%s')", $imagem1, $descricao);
	  if (mysql_query($insert_command)) {	
		
		$last_id = mysql_insert_id();
		
		if ($_FILES['imagem1']['name']) {
		   $file_name = upload_image('imagem1', $last_id . '1', '../uploads/empresa/');
		   if (isset($file_name)) {
			  mysql_query(sprintf("UPDATE empresa SET imagem1 = '%s' WHERE idempresa = %d", $file_name, $last_id));
			  $_SESSION['e1'] = $file_name;
		   }   
		}
		
					
		$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
		$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou uma galeria de categoria.";
		salvaLog($mensagem);
		header("location: listar.php");
	  }
	}
}
//ATUALIZAR
//ATUALIZAR
if($pega==2)
{
	
	if (!empty($_POST)) {
  
    $id = $_GET['id'];
	@$imagematual = $_POST['imagematual'];
	@$descricao = addslashes($_POST["descricao"]);

//ver lógica da porra
$update_command = sprintf("UPDATE empresa SET descricao = '%s' WHERE idempresa = %d", $descricao, $id);
  
  if (mysql_query($update_command)) 
  {
	  
  if(!empty($_FILES['imagemnova1']['name']))
  {
	
	if ($_FILES['imagemnova1']['name']) 
		{
		$file_name = upload_image('imagemnova1', $id, '../uploads/empresa/');
		    if ($file_name != "") 
								{
								   mysql_query(sprintf("UPDATE empresa SET imagem1 = '%s' WHERE idempresa = %d", $file_name, $id));
								   $mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou conteúdo da Empresa.";
								   //$_SESSION['nomefinal2'] = $file_name;
								   header('Location:listar.php');
								}
		}
	
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou conteúdo da Empresa.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Atualizado o registro com sucesso!";
	
	header('Location:listar.php');
  }
  
  header('Location:listar.php');
   
  }


	} //if !empty $_POST
} //if $pega==2

?>