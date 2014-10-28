<?php
ob_start(); 
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$nome        = $_POST['nome'];
$sub         = $_POST['subtitulo'];
$desc        = addslashes($_POST['descricao']);  
@$pega      = $_GET["a"]; //pega o get

$clausula = "INSERT INTO categorias(idcategorias, nome_categoria, subtitulo_capa, breve_descricao) VALUES('','". $nome ."', '". $sub ."', '". $desc ."')";
$nomeTabela     = "categorias";

// *** FAZ O CADASTRO NO BANCO DOS BANNERS DE DESTAQUES ***
if($pega==1)
{
		
			@$arquivo = $_FILES['imagem'];
			@$pasta = "categorias/";	   		
		    
			if(subirImagem2($pasta, $arquivo))
				{ 
					if (cadastroBanco2($clausula)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou uma categoria.";
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
					atualizaCategoria($campo, $codigo);
					
				} 
			else { header("location: listar.php");   }

}

//ATUALIZAR
if($pega==2)
{
	
	if (!empty($_POST)) {
  
    $id = $_GET['id'];

//ver lógica da porra
  $update_command = sprintf("UPDATE categorias SET nome_categoria = '%s', subtitulo_capa = '%s', breve_descricao = '%s'  WHERE idcategorias = %d", $nome, $sub, $desc, $id);
  
  if (mysql_query($update_command)) 
  {
	  
  if(!empty($_FILES['imagemnova']['name']))
  {
	
	if ($_FILES['imagemnova']['name']) 
		{
		$file_name = upload_image('imagemnova', $id, '../uploads/categorias/');
		    if ($file_name != "") 
								{
								   mysql_query(sprintf("UPDATE categorias SET imagem = '%s' WHERE idcategorias = %d", $file_name, $id));
								   $_SESSION['nomefinal7'] = $file_name;
								}
		}
	
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou uma categoria.";
	salvaLog($mensagem);	
	header('Location:listar.php'); 
  }
    else{
		
			$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou uma categoria...";
			salvaLog($mensagem);
			$_SESSION['ok'] = "Atualizado o registro com sucesso!";
			header('Location:listar.php'); 	
			
	}
  
   
  }


	} //if !empty $_POST
} //if $pega==2



//DELETAR
if($pega==3)
{

	$id = $_GET['id'];
	
	$from_delete = sprintf("SELECT * FROM categorias WHERE idcategorias = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/categorias/' . $delete['imagem_categoria']);
	
	$delete_command = sprintf("DELETE FROM categorias WHERE idcategorias = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu uma categoria do sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php'); 	


}
ob_end_flush(); 

?>