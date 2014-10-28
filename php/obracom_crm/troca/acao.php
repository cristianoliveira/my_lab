<?php 
ob_start();

include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$descricao = addslashes($_POST["descricao"]);
@$pega      = $_GET["a"]; //pega o get
$camposForm = "'','".$descricao ."', ''";
$nomeTabela     = "imoveis";


//ATUALIZAR
if($pega==2)
{
	
	if (!empty($_POST)) {
  
    $id = $_GET['id'];
	@$imagematual = $_POST['imagematual'];

//ver lógica da porra
$update_command = sprintf("UPDATE imoveis SET descricao = '%s' WHERE idimoveis = %d", $descricao, $id);
  
  if (mysql_query($update_command)) 
  {
	  
  if(!empty($_FILES['imagemnova']['name']))
  {
	
	if ($_FILES['imagemnova']['name']) 
		{
		$file_name = upload_image('imagemnova', $id, '../uploads/imoveis/');
		    if ($file_name != "") 
								{
								   mysql_query(sprintf("UPDATE imoveis SET imagem = '%s' WHERE idimoveis = %d", $file_name, $id));
								   $_SESSION['nomefinal2'] = $file_name;
								}
		}
	
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou o Troca de Óleo.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Atualizado o registro com sucesso!";
	
	header('Location:listar.php?p=3&g=2'); exit;
  }
    else{
		
			$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou o Troca de Óleo.";
			salvaLog($mensagem);
			$_SESSION['ok'] = "Atualizado o registro com sucesso!";
			header('Location:listar.php?p=3&g=2'); exit;	
			
	}
  
   
  }


	} //if !empty $_POST
} //if $pega==2

ob_end_flush();
?>