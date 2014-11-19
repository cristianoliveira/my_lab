<?php 
//include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

@$nome       = $_POST["nome"];
@$pega       = $_GET["a"]; //pega o get
@$id         = $_GET['id'];

$camposForm = "'', '".$nome."', ''";
$nomeTabela = "downloads";

// *** FAZ O CADASTRO NO BANCO DAS CATEGORIAS ***
if($pega==1)
{
		
			@$arquivo = $_FILES['imagem'];
			@$pasta = "downloads/";	   		
		    
			if(subirImagem3($pasta, $arquivo))
				{ 
					if (cadastroBanco($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Catálogo cadastrado com sucesso!";
							salvaLog($mensagem);
							
							header("location: listar.php?p=2&g=2");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte."; 
							header("location: listar.php?p=2&g=2");
						 }
								
					$codigo = $_SESSION['uidc'];
					$campo  = $_SESSION['nomefinal'];
															
					atualizaRevista($campo, $codigo);
					
				} 
			else { //header("location: listar.php?p=3&g=1"); 
			}

}

//ATUALIZAR
if($pega==2)
{
	
if (!empty($_POST)) {
  $id = $_GET['id'];
  @$nome       = $_POST["nome"];

 $update_command = sprintf("UPDATE downloads SET titulo = '%s'  WHERE id = %d", $nome, $id);

  if (mysql_query($update_command)) 
  {
	  		/* subir imagem */
			// Verifica se o campo PDF está vazio
			if (!isset($_FILES['imagemnova'])) {
			
			// Caso queira mudar o nome do arquivo basta descomentar a linha abaixo e fazer a modificação
			//$_FILES['imagemnova']['name'] = "nome_do_arquivo.pdf";
			
				
			//$tipodocara = substr($_FILES['imagemnova'], -3);
			//$_FILES['imagemnova']['name'] = 'artigo_'.time(). '.'.$tipodocara;
			
			
			$_FILES['imagemnova']['name'] = 'download_'.time(). ".pdf";		
			
			// Move o arquivo para uma pasta
			move_uploaded_file($_FILES['imagemnova']['tmp_name'],"../uploads/downloads/".$_FILES['imagemnova']['name']);
			
			// $pdf_path é a variável que guarda o endereço em que o PDF foi salvo (para adicionar na base de dados)
			$pdf_path = "../uploads/downloads/".$_FILES['imagemnova']['name'];
			
			 $update_command2 = sprintf("UPDATE downloads SET arquivo = '%s' WHERE id = %d", $_FILES['imagemnova']['name'], $id);
			 mysql_query($update_command2);
			
			
			} /*else {
			// Caso seja falso, retornará o erro
			 echo "Não foi possível enviar o arquivo";
			}*/
			
	        $mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um download no sistema.";
		    salvaLog($mensagem);
			$_SESSION['ok'] = "Download atualizado com sucesso!";
            header('Location:listar.php?p=2&g=1');
  }
  else { echo "Não foi possível realizar esta operação. Favor contatar o suporte técnico!";}
 }
}

//DELETAR *** Cuidar, pois terá que verificar se há produtos.
if($pega==3)
{

	$id = $_GET['id'];
	
	$from_delete = sprintf("SELECT * FROM downloads WHERE id = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/downloads/' . $delete['arquivo']);
	
	$delete_command = sprintf("DELETE FROM downloads WHERE id = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um arquivo de download.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o downloads com sucesso!";
	header('Location:listar.php?p=2&g=2');

}

?>