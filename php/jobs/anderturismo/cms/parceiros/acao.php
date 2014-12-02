<?php
ob_start(); 
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$nome        = $_POST['nome']; 
@$pega      = $_GET["a"]; //pega o get

$clausula = "INSERT INTO parceiros(idparceiros, nome_parceiro) VALUES('','". $nome ."')";
$nomeTabela = "parceiros";


// *** FAZ O CADASTRO NO BANCO DOS BANNERS DE DESTAQUES ***
if($pega==1)
{
		
			@$arquivo = $_FILES['imagem'];
			@$pasta = "parceiros/";	   		
		    
			if(subirImagem2($pasta, $arquivo))
				{ 
					if (cadastroBanco2($clausula)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um parceiro.";
							salvaLog($mensagem);
							header("location: listar.php"); 
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte.";
							
						header("location: listar.php");
						 }
								
					$codigo = $_SESSION['uidc'];
					$campo  =  $_SESSION['nomefinal'];
					$_SESSION['nomefinal3'] = $campo;				
					atualizaParceiro($campo, $codigo);
					
				} 
			else { header("location: listar.php");   }

}

//ATUALIZAR
if($pega==2)
{
	
	if (!empty($_POST)) {
  
    $id = $_GET['id'];

//ver lógica da porra
  $update_command = sprintf("UPDATE parceiros SET nome_parceiro = '%s' WHERE idparceiros = %d", $nome, $id);
  
  if (mysql_query($update_command)) 
  {
	  
  if(!empty($_FILES['imagemnova']['name']))
  {
	
	if ($_FILES['imagemnova']['name']) 
		{
		$file_name = upload_image('imagemnova', $id, '../uploads/parceiros/');
		    if ($file_name != "") 
								{
								   mysql_query(sprintf("UPDATE parceiros SET imagem_parceiro = '%s' WHERE idparceiros = %d", $file_name, $id));
								   $_SESSION['nomefinal7'] = $file_name;
								}
		}
	
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um parceiro.";
	salvaLog($mensagem);	
	header('Location:listar.php'); exit;
  }
    else{
		
			$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um parceiro.";
			salvaLog($mensagem);
			$_SESSION['ok'] = "Atualizado o registro com sucesso!";
			header('Location:listar.php'); exit;	
			
	}
  
   
  }


	} //if !empty $_POST
} //if $pega==2



//DELETAR
if($pega==3)
{

	$id = $_GET['id'];
	
	$from_delete = sprintf("SELECT * FROM parceiros WHERE idparceiros = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/parceiros/' . $delete['imagem_parceiro']);
	
	$delete_command = sprintf("DELETE FROM parceiros WHERE idparceiros = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um parceiro.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php');


}
ob_end_flush(); 
?>