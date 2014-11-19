<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$nome       = $_POST["nome"];
@$email      = $_POST["email"];
@$pega      = $_GET["a"]; //pega o get

$camposForm = "'', '". $email ."', '". $nome . "'";
$nomeTabela = "news";

// *** FAZ O CADASTRO NO BANCO DOS USUÁRIOS ***
if($pega==1)
{
				
					if (cadastroBanco($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um e-mail no sistema.";
							salvaLog($mensagem);
							header("location: listar.php?p=5&g=1");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php?p=5&g=1");
						 }
								
}
else{
			$_SESSION['ok2']=1;
        header('Location:listar.php');
	
}


//ATUALIZAR
if($pega==2)
{
	
if (!empty($_POST)) {
  $id = $_GET['id'];
  @$nome       = $_POST["nome"];
  @$email      = $_POST["email"];

 $update_command = sprintf("UPDATE news SET nome = '%s', email = '%s'  WHERE id = %d", $nome, $email, $id);

  if (mysql_query($update_command)) 
  {
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um e-mail no sistema.";
		salvaLog($mensagem);
			$_SESSION['ok'] = "Usuário atualizado com sucesso!";
    header('Location:listar.php?p=5&g=1');
  }
  else { echo "deu pau";}
 }
}

//DELETAR
if($pega==3)
{
	$id = $_GET['id'];
	
	$delete_command = sprintf("DELETE FROM news WHERE id = %d", $id);
	mysql_query($delete_command);
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um e-mail do sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php?p=5&g=2');

}
?>