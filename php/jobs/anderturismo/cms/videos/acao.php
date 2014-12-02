<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$nome       = $_POST["nome"];
@$conta      = $_POST["conta"];
@$codigo      = $_POST["roteiros"];
@$pega      = $_GET["a"]; //pega o get


$camposForm = "'', '". $nome ."', '". $conta ."', '". $codigo ."'";

// *** FAZ O CADASTRO NO BANCO DOS USUÁRIOS ***
if($pega==1)
{
				
					if (cadastraVideo($camposForm)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um vídeo no roteiro.";
							salvaLog($mensagem);
							header("location: listar.php?p=8&g=1");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php?p=8&g=1");
						 }
								

}

//ATUALIZAR
if($pega==2)
{
	
if (!empty($_POST)) {
  $id = $_GET['id'];
  @$nome       = $_POST["nome"];
  @$conta      = $_POST["conta"];
  @$codigo     = $_POST["roteiros"];

 $update_command = sprintf("UPDATE videos_roteiros SET nome = '%s', link = '%s', id_roteiro = '%d' WHERE idvideos = %d", $nome, $conta, $codigo, $id);

  if (mysql_query($update_command)) 
  {
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um vídeo do roteiro.";
		salvaLog($mensagem);
			$_SESSION['ok'] = "Vídeo atualizado com sucesso!";
    header('Location:listar.php?p=8&g=1');
  }
  else { echo "Ocorreu algum imprevisto na hora da atualização.";}
 }
}

//DELETAR
if($pega==3)
{
	$id = $_GET['id'];
	
	$delete_command = sprintf("DELETE FROM videos_roteiros WHERE idvideos = %d", $id);
	mysql_query($delete_command);
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um vídeo do sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Vídeo removido com sucesso!";
	header('Location:listar.php?p=8&g=2');

}



?>