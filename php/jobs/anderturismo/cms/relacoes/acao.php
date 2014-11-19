<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$hotel1   = $_POST["hotel1"];
@$hotel2   = $_POST["hotel2"];
@$pega       = $_GET["a"]; //pega o get

$camposForm = "'', '". $hotel1 ."', '". $hotel2 ."'";
$nomeTabela = "relacoes_roteiros";

// *** FAZ O CADASTRO NO BANCO DOS USUÁRIOS ***
if($pega==1)
{
	if($hotel1!=$hotel2){
				
					if (cadastroBanco($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Relação cadastrada com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou uma relação no sistema.";
							salvaLog($mensagem);
							header("location: listar.php?p=4&g=1");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php?p=4&g=1");
						 }
	}else{
		$_SESSION['erro'] = "A relação entre dois hotéis devem ser cadastradas por hotéis diferentes. Não é possível relacionar o hotel com ele mesmo."; 
		header("location: listar.php?p=4&g=1");
		
	}
								
}

//ATUALIZAR
if($pega==2)
{
	
if (!empty($_POST)) {
  $id = $_GET['id'];
	@$hotel1   = $_POST["hotel1"];
	@$hotel2   = $_POST["hotel2"];

 $update_command = sprintf("UPDATE relacoes_roteiros SET roteiro_principal = '%d', relacionado = '%d' WHERE idrelacoes = %d", $hotel1, $hotel2, $id);

  if (mysql_query($update_command)) 
  {
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou uma relação de roteiro.";
		salvaLog($mensagem);
			$_SESSION['ok'] = "Relação atualizada com sucesso!";
    header('Location:listar.php?p=4&g=1');
  }
  else { echo "Problemas? Contate o administrador.";}
 }
}

//DELETAR
if($pega==3)
{
	$id = $_GET['id'];
	
	$delete_command = sprintf("DELETE FROM relacoes_roteiros WHERE idrelacoes = %d", $id);
	mysql_query($delete_command);
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu uma relação.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Relação removida com sucesso!";
	header('Location:listar.php?p=4&g=2');

}



?>