<?php 
ob_start();
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$nome      = $_POST["nome"];
@$pega      = $_GET["a"]; //pega o get

$camposForm = "'', '". $nome ."', ''";
$nomeTabela     = "capa_roteiros";

// *** FAZ O CADASTRO NO BANCO DOS BANNERS DE DESTAQUES ***
if($pega==1)
{

			@$arquivo = $_FILES['imagem'];
			@$pasta = "capas/";	   		

			if(subirImagem($pasta, $arquivo))
				{ 
					if (cadastraCapa($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou uma capa de roteiro.";
							salvaLog($mensagem);
							header("location: listar.php?p=5&g=2");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php?p=5&g=2"); 
						 }
								
					$codigo = $_SESSION['uidc'];
					$campo  =  $_SESSION['nomefinal'];					
					atualizaCapa($campo, $codigo);
					
				} 
			else { header("location: listar.php?p=5&g=2"); 
			 }

}

//ATUALIZAR
if($pega==2)
{
		
if (!empty($_POST)) {
  $nome      = $_POST['nome'];
  $id        = $_GET['id'];

  $update_command = sprintf("UPDATE capa_roteiros SET nome_capa = '%s' WHERE idcapas = %d", $nome, $id);
  if (mysql_query($update_command)) {
	if ($_FILES['imagemnova']['name']) {
		$file_name = upload_image('imagemnova', $id, '../uploads/capas/');
		if ($file_name != "") {
		   mysql_query(sprintf("UPDATE capa_roteiros SET imagem = '%s' WHERE idcapas = %d", $file_name, $id));
		}
	}
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou uma capa de roteiro.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Atualizado o registro com sucesso!";
    header('Location:listar.php?p=5&g=2'); exit;
  }
}


}

//DELETAR
if($pega==3)
{

	$id = $_GET['id'];
	
	$from_delete = sprintf("SELECT * FROM capa_roteiros WHERE idcapas = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/capas/' . $delete['imagem']);
	
	$delete_command = sprintf("DELETE FROM capa_roteiros WHERE idcapas = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu uma capa de roteiro.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php?p=5&g=2'); exit;

}
ob_end_flush(); 
?>