<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$nome       = $_POST["nome"];
@$conta      = $_POST["conta"];
@$senha      = $_POST["senha"];
@$email      = $_POST["email"];
@$status      = $_POST["status"];

@$pega      = $_GET["a"]; //pega o get

$camposForm = "'', '". $nome ."', '". $conta . "', '". $senha ."', '". $email . "', 1";
$nomeTabela = "usuarios";

// *** FAZ O CADASTRO NO BANCO DOS USUÁRIOS ***
if($pega==1)
{

$result = mysql_query("SELECT * FROM usuarios WHERE conta='$nome'");
$res    = mysql_num_rows($result);

if($res==0){ 
				
					if (cadastroBanco($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um usuario no sistema.";
							salvaLog($mensagem);
							header("location: listar.php?p=8&g=1");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php?p=8&g=1");
						 }
								
}
else{
			$_SESSION['ok2']=1;
        header('Location:listar.php');
	
}

}

//ATUALIZAR
if($pega==2)
{
	
if (!empty($_POST)) {
  $id = $_GET['id'];
  @$nome       = $_POST["nome"];
  @$conta      = $_POST["conta"];
  @$senha      = $_POST["senha"];
  @$email      = $_POST["email"];
  @$status      = $_POST["status"];

 $update_command = sprintf("UPDATE usuarios SET nome_usuario = '%s', conta = '%s', senha = '%s', email_usuario = '%s', status = '%d'  WHERE idusuario = %d", $nome, $conta, $senha, $email, $status, $id);

  if (mysql_query($update_command)) 
  {
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um usuário no sistema.";
		salvaLog($mensagem);
			$_SESSION['ok'] = "Usuário atualizado com sucesso!";
    header('Location:listar.php?p=8&g=1');
  }
  else { echo "deu pau";}
 }
}

//DELETAR
if($pega==3)
{
	$id = $_GET['id'];
	
	$delete_command = sprintf("DELETE FROM usuarios WHERE idusuario = %d", $id);
	mysql_query($delete_command);
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um usuário do sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php?p=8&g=2');

}



?>