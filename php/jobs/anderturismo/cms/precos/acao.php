<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$hotel     = $_POST["hotel"];
@$apto      = $_POST["apto"];
@$valor     = $_POST["valor"];
@$pega       = $_GET["a"]; //pega o get

//$valor = str_replace(".", ",", $valor);


$camposForm = "'', '". $hotel ."', '". $apto ."', '". $valor ."'";
$nomeTabela = "precos";

// *** FAZ O CADASTRO NO BANCO DOS USUÁRIOS ***
if($pega==1)
{
				
					if (cadastroBanco($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Preço cadastrado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um preço no sistema.";
							salvaLog($mensagem);
							header("location: listar.php?p=6&g=1");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php?p=6&g=1");
						 }
								
}

//ATUALIZAR
if($pega==2)
{
	
if (!empty($_POST)) {
    @$id         = $_GET['id'];
	@$hotel     = $_POST["hotel"];
	@$apto      = $_POST["apto"];
	@$valor     = $_POST["valor"];
	@$pega       = $_GET["a"]; //pega o get

 $update_command = sprintf("UPDATE precos SET hotel_id = '%d',apartamento_id = '%d',valor = '%s' WHERE idprecos = %d", $hotel, $apto, $valor, $id);

  if (mysql_query($update_command)) 
  {
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um preço do apartamento.";
		salvaLog($mensagem);
			$_SESSION['ok'] = "Preço atualizado com sucesso!";
    header('Location:listar.php?p=6&g=1');
  }
  else { echo "Problemas? Contate o administrador.";}
 }
}

//DELETAR
if($pega==3)
{
	$id = $_GET['id'];
	
	$delete_command = sprintf("DELETE FROM precos WHERE idprecos = %d", $id);
	mysql_query($delete_command);
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um preço no sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php?p=6&g=2');

}



?>