<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$nome       = $_POST["nome"];
@$sigla      = $_POST["sigla"];
@$pega       = $_GET["a"]; //pega o get

$camposForm = "'', '". $nome ."', '". $sigla ."'";
$nomeTabela = "apartamentos";

// *** FAZ O CADASTRO NO BANCO DOS USUÁRIOS ***
if($pega==1)
{
				
					if (cadastroBanco($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Tipo de Apartamento cadastrado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um tipo de apto no sistema.";
							salvaLog($mensagem);
							header("location: listar.php");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php");
						 }
								
}

//ATUALIZAR
if($pega==2)
{
	
if (!empty($_POST)) {
    @$id         = $_GET['id'];
	@$nome       = $_POST["nome"];
	@$sigla      = $_POST["sigla"];
	@$pega       = $_GET["a"]; //pega o get

 $update_command = sprintf("UPDATE apartamentos SET nome_apartamento = '%d',sigla = '%s' WHERE idapartamentos = %d", $nome, $sigla, $id);

  if (mysql_query($update_command)) 
  {
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um tipo de apartamento.";
		salvaLog($mensagem);
			$_SESSION['ok'] = "Tipo de Apartamento atualizado com sucesso!";
    header('Location:listar.php');
  }
  else { echo "Problemas? Contate o administrador.";}
 }
}

//DELETAR
if($pega==3)
{
	$id = $_GET['id'];
	
	$delete_command = sprintf("DELETE FROM apartamentos WHERE idapartamentos = %d", $id);
	mysql_query($delete_command);
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um tipo de apto.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Tipo de apartamento removido com sucesso!";
	header('Location:listar.php');

}



?>