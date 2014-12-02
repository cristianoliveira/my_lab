<?php 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

/*
nome
nivel
imagem
descricao
infos
localizacao_texto
localizacao_mapa
status
*/

@$nome      = $_POST["nome"];
@$nivel     = $_POST["nivel"];
@$descricao = addslashes($_POST["descricao"]);
@$infos     = addslashes($_POST["infos"]);
@$loc1      = $_POST["localizacao_texto"];
@$loc2      = $_POST["localizacao_mapa"];
@$status    = $_POST["status"];
@$code = rand(2, 999999); // Gera código de identificação para o hotel

@$pega      = $_GET["a"]; //pega o get

$camposForm = "'', '".$nome ."', '". $nivel ."', '' ,'".$descricao ."' ,'". $infos ."' ,'".$loc1 ."' ,'". $loc2 ."' , '". $status ."', '". $code ."'";
$nomeTabela     = "hoteis";

// *** FAZ O CADASTRO NO BANCO DOS HOTÉIS ***
if($pega==1)
{
$result = mysql_query("SELECT * FROM hoteis WHERE nome_hotel='$nome'");
$res    = mysql_num_rows($result);

if($res==0){ 


			@$arquivo = $_FILES['imagem'];
			@$pasta = "hoteis/";	   		

			if(subirImagem($pasta, $arquivo))
				{ 
					if (cadastroHotel($nomeTabela, $camposForm)) 
						{ 
							$_SESSION['ok'] = "Cadastro efetuado com sucesso! Recomendamos criar os tipos de apartamentos <a href='../apartamentos/cadastro.php'>(clique aqui)</a> e logo após inserir os valores: <a href='../precos/cadastro.php'>(clique aqui)</a>."; $_SESSION['ok2']=2;
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um htel.";
							salvaLog($mensagem);
							header("location: listar.php"); //header("location: listar.php?p=1&g=2");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte.";  $_SESSION['ok2']=2;
							header("location: listar.php");
						 }
								
					$codigo = $_SESSION['uidc'];
					$campo  =  $_SESSION['nomefinal'];
								
					atualizaHotel($campo, $codigo);
					
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
	@$nome      = $_POST["nome"];
@$nivel     = $_POST["nivel"];
@$descricao = addslashes($_POST["descricao"]);
@$infos     = addslashes($_POST["infos"]);
@$loc1      = $_POST["localizacao_texto"];
@$loc2      = $_POST["localizacao_mapa"];
@$status    = $_POST["status"];
@$imagematual    = $_POST["imagematual"];
	@$imagematual = $_POST['imagematual'];

//ver lógica da porra
$update_command = sprintf("UPDATE hoteis SET nome_hotel = '%s', estrelas = '%d', descricao = '%s', informacoes_adicionais = '%s', localizacao = '%s', mapa = '%s', status = '%d' WHERE idhoteis = %d", $nome, $nivel, $descricao, $infos, $loc1, $loc2, $status, $id);
  
  if (mysql_query($update_command)) 
  {
	  
  if(!empty($_FILES['imagemnova']['name']))
  {
	
	if ($_FILES['imagemnova']['name']) 
		{
		$file_name = upload_image('imagemnova', $id, '../uploads/hoteis/');
		    if ($file_name != "") 
								{
								   mysql_query(sprintf("UPDATE hoteis SET imagem_principal = '%s' WHERE idhoteis = %d", $file_name, $id));
								   	@unlink('../uploads/hoteis/' . $imagematual);
								   $_SESSION['nomefinal2'] = $file_name;
								}
		}
	
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um hotel.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Atualizado o registro com sucesso!"; $_SESSION['ok2']=2;
	
	header('Location:listar.php');
  }
    else{
		
			$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um hotel.";
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
	
	$from_delete = sprintf("SELECT * FROM hoteis WHERE idhoteis = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/hoteis/' . $delete['imagem_principal']);
	
	$delete_command = sprintf("DELETE FROM hoteis WHERE idhoteis = %d", $id);
	
	mysql_query($delete_command);
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um hotel."; $_SESSION['ok2']=2;
	salvaLog($mensagem);
	$_SESSION['ok'] = "Removido o registro com sucesso!";
	header('Location:listar.php');

}

?>