<?php 
ob_start(); 
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$nome        = $_POST['nome'];
$categoria   = $_POST['cod_estados'];  
$subcategoria= $_POST['cod_cidades']; 
$descricao   = addslashes($_POST['descricao']);  
@$pega       = $_GET["a"]; //pega o get

$clausula = "INSERT INTO produtos(categoria_id, subcategoria_id, nome_produto, descricao_produto) VALUES('". $categoria ."','". $subcategoria ."', '". $nome ."', '". $descricao ."')";
$nomeTabela     = "produtos";

// *** FAZ O CADASTRO NO BANCO DOS BANNERS DE DESTAQUES ***
if($pega==1)
{
		
			@$arquivo = $_FILES['imagem'];
			@$pasta = "produtos/";	   		
		    
			if(subirImagem2($pasta, $arquivo))
				{ 
					if (cadastroBanco2($clausula)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um produto.";
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
					atualizaProduto($campo, $codigo);
					
				} 
			else { /*header("location: listar.php");*/ header('Location: listar.php'); }

}

//ATUALIZAR
if($pega==2)
{
	
	if (!empty($_POST)) {
  
    $id = $_GET['id'];

//ver lógica da porra
  $update_command = sprintf("UPDATE produtos SET nome_produto = '%s', categoria_id = '%d' WHERE idprodutos = %d", $nome, $categoria, $id);
  
  if (mysql_query($update_command)) 
  {
	  
  if(!empty($_FILES['imagemnova']['name']))
  {
	
	if ($_FILES['imagemnova']['name']) 
		{
		$file_name = upload_image('imagemnova', $id, '../uploads/produtos/');
		    if ($file_name != "") 
								{
								   mysql_query(sprintf("UPDATE produtos SET image_name1 = '%s' WHERE idprodutos = %d", $file_name, $id));
								   $_SESSION['nomefinal7'] = $file_name;
								}
		}
	
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um produto.";
	salvaLog($mensagem);	
header('Location:listar.php'); 
  }
    else{
		
			$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um produto..";
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
	
	$from_delete = sprintf("SELECT * FROM produtos WHERE idprodutos = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/produtos/' . $delete['image_name1']);
	
	$delete_command = sprintf("DELETE FROM produtos WHERE idprodutos = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um produto do sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
header("location: listar.php"); exit;


}

ob_end_flush(); 
?>