<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$nome       = $_POST["nome"];
@$pega      = $_GET["a"]; //pega o get

$camposForm = "'', '". $nome ."'";
$nomeTabela = "paises";

// *** FAZ O CADASTRO NO BANCO DOS USUÁRIOS ***
if($pega==1)
{

$result = mysql_query("SELECT * FROM paises WHERE nome_pais='$nome'");
$res    = mysql_num_rows($result);

if($res==0){ 
				
					if (cadastroBanco($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Destino ou País cadastrado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um destino ou país no sistema.";
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

 $update_command = sprintf("UPDATE paises SET nome_pais = '%s' WHERE idpaises = %d", $nome, $id);

  if (mysql_query($update_command)) 
  {
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um destino ou país no sistema.";
		salvaLog($mensagem);
			$_SESSION['ok'] = "Destino ou País atualizado com sucesso!";
    header('Location:listar.php?p=7&g=1');
  }
  else { echo "Ocorreu algum problema. Favor contatar o suporte.";}
 }
}

//DELETAR
if($pega==3)
{
	$id = $_GET['id'];
	
	$delete_command = sprintf("DELETE FROM paises WHERE idpaises = %d", $id);
	mysql_query($delete_command);
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um destino ou país do sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php?p=8&g=2');

}



?>