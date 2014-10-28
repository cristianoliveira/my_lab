<?php 
ob_start(); 
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$nome        = $_POST['nome'];
$categoria   = $_POST['categoria'];  
$desc        = addslashes($_POST['descricao']);
@$pega      = $_GET["a"]; //pega o get

$clausula = "INSERT INTO subcategorias(id_categoria, nome_subcategoria, descricao_sub) VALUES('". $categoria ."', '". $nome ."', '". $nome ."')";
$nomeTabela     = "subcategorias";

// *** FAZ O CADASTRO NO BANCO DOS BANNERS DE DESTAQUES ***
if($pega==1)
{
		
			@$arquivo = $_FILES['imagem'];
			@$pasta = "subcategorias/";	   		
		    
			if(subirImagem2($pasta, $arquivo))
				{ 
					if (cadastroBanco2($clausula)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou uma subcategoria.";
							salvaLog($mensagem);
							header("location: listar.php");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte.";
							
						header("location: listar.php"); exit;
						 }
								
					$codigo = $_SESSION['uidc'];
					$campo  =  $_SESSION['nomefinal'];
					$_SESSION['nomefinal3'] = $campo;				
					atualizaSubCategoria($campo, $codigo);
					
				} 
			else { header("location: listar.php"); exit; }

}

//ATUALIZAR
if($pega==2)
{
	
	if (!empty($_POST)) {
  
    $id = $_GET['id'];
	$desc        = addslashes($_POST['descricao']);


//ver lógica da porra
  $update_command = sprintf("UPDATE subcategorias SET nome_subcategoria = '%s', id_categoria = '%d', descricao_sub = '%s' WHERE idsubcategorias = %d", $nome, $categoria, $desc, $id);
  
  if (mysql_query($update_command)) 
  {
	  
  if(!empty($_FILES['imagemnova']['name']))
  {
	
	if ($_FILES['imagemnova']['name']) 
		{
		$file_name = upload_image('imagemnova', $id, '../uploads/subcategorias/');
		    if ($file_name != "") 
								{
								   mysql_query(sprintf("UPDATE subcategorias SET imagem_subcategoria = '%s' WHERE idsubcategorias = %d", $file_name, $id));
								   $_SESSION['nomefinal7'] = $file_name;
								}
		}
	
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou uma subcategoria.";
	salvaLog($mensagem);	
	header('Location:listar.php'); exit;
  }
    else{
		
			$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou uma subcategoria..";
			salvaLog($mensagem);
			$_SESSION['ok'] = "Atualizado o registro com sucesso!";
			header('Location:listar.php');	 exit;
			
	}
  
   
  }


	} //if !empty $_POST
} //if $pega==2



//DELETAR
if($pega==3)
{

	$id = $_GET['id'];
	
	$from_delete = sprintf("SELECT * FROM subcategorias WHERE idsubcategorias = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/subcategorias/' . $delete['imagem_subcategoria']);
	
	$delete_command = sprintf("DELETE FROM subcategorias WHERE idsubcategorias = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu uma subcategoria do sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php');	 exit;


}
ob_end_flush(); 

?>