<?php 
ob_start();
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$nome      = $_POST["nome"];
@$subtitulo = $_POST["subtitulo"];
@$tipo      = $_POST["tipo"];
@$link      = $_POST["link"];
@$orientacao= $_POST["orientacao"];
@$rotacao1  = $_POST["rotacao1"];
@$rotacao2  = $_POST["rotacao2"];
@$escala1   = $_POST["escala1"];
@$escala2   = $_POST["escala2"];
@$ordem     = $_POST["ordem"];
@$publicar  = $_POST["publicar"];

@$pega      = $_GET["a"]; //pega o get

$camposForm = "'','".$nome ."','". $subtitulo ."','". $tipo."','". $link."','". $orientacao."','". $rotacao1."','". $rotacao2."','". $escala1."','". $escala2."','','". $ordem."','". $publicar."'";

// *** FAZ O CADASTRO NO BANCO DOS BANNERS DE DESTAQUES ***
if($pega==1)
{

			@$arquivo = $_FILES['imagem'];
			@$pasta = "banners/";	   		

			if(subirImagem($pasta, $arquivo))
				{ 
					if (cadastroBanner($camposForm)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um banner de destaque.";
							salvaLog($mensagem);
							header("location: listar.php?p=1&g=2");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php?p=1&g=2"); exit;
						 }
								
					$codigo = $_SESSION['uidc'];
					$campo  =  $_SESSION['nomefinal'];					
					atualizaBanner($campo, $codigo);
					
				} 
			else { header("location: listar.php?p=1&g=2"); exit;
			 }

}

//ATUALIZAR
if($pega==2)
{
		
if (!empty($_POST)) {

  $id        = $_GET['id'];

  $update_command = sprintf("UPDATE banners SET titulo_principal = '%s', subtitulo = '%s', tipo = '%s', link = '%s', orientacao = '%s', rotacao1 = '%s', rotacao2 = '%s', escala1 = '%s', escala2 = '%s', ordem = %d, publicar = %d WHERE idbanners = %d", 
  $nome, $subtitulo, $tipo, $link, $orientacao, $rotacao1, $rotacao2, $escala1, $escala2, $ordem, $publicar, $id);
  if (mysql_query($update_command)) {
	if ($_FILES['imagemnova']['name']) {
		$file_name = upload_image('imagemnova', $id, '../uploads/banners/');
		if ($file_name != "") {
		   mysql_query(sprintf("UPDATE banners SET imagem = '%s' WHERE idbanners = %d", $file_name, $id));
		}
	}
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um banner de destaque.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Atualizado o registro com sucesso!";
    header('Location:listar.php?p=1&g=2'); exit;
  }
}


}

//DELETAR
if($pega==3)
{

	$id = $_GET['id'];
	
	$from_delete = sprintf("SELECT * FROM banners WHERE idbanners = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/banners/' . $delete['imagem']);
	
	$delete_command = sprintf("DELETE FROM banners WHERE idbanners = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um banner de destaque.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php?p=1&g=2'); exit;

}
ob_end_flush(); 
?>