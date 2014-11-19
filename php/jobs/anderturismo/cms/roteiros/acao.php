<?php 
ob_start(); 
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

/*
nome
subtitulo
preco_avista
preco_parcelado
imagem
data_inicio
data_fim
titulo_completo
datas_completas
programacao_diaria
viagens_programadas
viagens_individuais
viagens_grupo
destaque_home
destaque_roteiros
status_roteiro
tipo_transporte
capas
feriado
sem_data
texto_destaque_home
*/
$nome               = $_POST['nome'];
$subtitulo          = $_POST['subtitulo'];
$data_inicio        = $_POST['data_inicio'];
$data_fim           = $_POST['data_fim'];
$avista             = $_POST['avista'];
$parcelado          = $_POST['parcelado'];
$titulo_completo    = $_POST['titulo_completo'];
$datas_completas    = $_POST['datas_completas'];
$programacao_diaria = addslashes($_POST['programacao_diaria']);
$viagens_programadas= $_POST['viagens_programadas'];
$viagens_grupo      = $_POST['viagens_grupo'];
$viagens_individuais= $_POST['viagens_individuais'];
$destaque_home      = $_POST['destaque_home'];
$destaque_roteiros  = $_POST['destaque_roteiros'];
$status_roteiro     = $_POST['status_roteiro'];
$tipo_transporte    = $_POST['tipo_transporte'];
$capas              = $_POST['capas'];
$feriado            = $_POST['feriado'];

//Novos campos adicionados em 13/11/2014 às 11h19
$semdata            = $_POST['sem_data'];
$texto_destaque     = $_POST['texto_destaque_home'];

$data1 = $data_inicio;
$data_inicio = implode("-",array_reverse(explode("/",$data1)));

$data2 = $data_fim;
$data_fim = implode("-",array_reverse(explode("/",$data2)));

@$code = rand(2, 9999); // Gera código de identificação para o roteiro
@$pega       = $_GET["a"]; //pega o get

$camposForm = "'', '". $nome ."', '". $code ."', '". $subtitulo ."', '". $avista ."', '". $parcelado ."', '', '". $data_inicio ."', '". $data_fim ."', '". $titulo_completo ."', '". $datas_completas ."', '". $programacao_diaria ."', ". $viagens_programadas .", ". $viagens_grupo .",  ". $viagens_individuais .",  ". $destaque_home .", ". $destaque_roteiros .", ". $status_roteiro .", ". $tipo_transporte .", ". $capas .", ". $feriado .", '". $texto_destaque ."', ". $semdata ." ";
$nomeTabela     = "roteiros";


// *** FAZ O CADASTRO NO BANCO DOS BANNERS DE DESTAQUES ***
if($pega==1)
{
		
			@$arquivo = $_FILES['imagem'];
			@$pasta = "roteiros/";	   		
		    
			if(subirImagem2($pasta, $arquivo))
				{ 
					if (cadastroBanco($nomeTabela, $camposForm)) 
						{
						//pega países relacionados 
						$pegaPaises = $_POST['paises']; 
						$quantidade = count($pegaPaises); 
						
						//echo $_SESSION['uidc']; exit;
						
						for ($i=0; $i<$quantidade; $i++) 
						  { 
							//echo "Telefone: ".$pegaPaises[$i]."<br />"; 
							//$pegaPaises[$i]; $_SESSION['uidc'];
							
							$roteiro = $_SESSION['uidc'];
							$pais = $pegaPaises[$i];
 
				//consulta sql - inserção
				$query = mysql_query("INSERT INTO relacoes_paises_roteiros (id_roteiro, id_pais) VALUES ('$roteiro', '$pais')") or die(mysql_error());						
							
						  }
						//exit();
													
							$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
							$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um produto.";
							salvaLog($mensagem);
							header("location: listar.php?pg=1&p=&g=");
						}
					else { 
							$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte.";
						
						header("location: listar.php?pg=1&p=&g=");
						 }
								
					@$codigo = $_SESSION['uidc'];
					$campo  =  $_SESSION['nomefinal'];
					$_SESSION['nomefinal3'] = $campo;				
					atualizaRoteiro($campo, $codigo);
					
				} 
			else { /*header("location: listar.php");*/ header('Location: listar.php?pg=1&p=&g='); }

}

//ATUALIZAR
if($pega==2)
{
	
	if (!empty($_POST)) {
  
    $id = $_GET['id'];
	//Novos campos adicionados em 13/11/2014 às 11h19
$semdata            = $_POST['sem_data'];
$texto_destaque     = $_POST['texto_destaque_home'];


//ver lógica da porra
  $update_command = sprintf("UPDATE roteiros SET nome_roteiro = '%s', subtitulo = '%s', preco_avista = '%s', preco_parcelado = '%s', data_inicio = '%s', data_fim = '%s', titulo_completo = '%s', datas_completas = '%s', programacao_diaria = '%s', viagens_programadas = %d, viagens_grupo = %d, viagens_individuais = %d, destaque_home_cabecalho = %d, destaque_home_roteiros = %d, status_roteiro = %d, tipo_transporte = %d, capas_roteiros = %d, feriado = %d, texto_destaque_home = '%s', sem_data = %d WHERE idroteiros = %d", $nome, $subtitulo, $avista, $parcelado, $data_inicio,$data_fim,$titulo_completo,$datas_completas,$programacao_diaria,$viagens_programadas, $viagens_grupo, $viagens_individuais, $destaque_home,$destaque_roteiros,$status_roteiro,$tipo_transporte,$capas,$feriado,$texto_destaque,$sem_data, $id);
 
  if (mysql_query($update_command)) 
  {
  
  //pega países relacionados 
    // deletar tudo e inserir novamente
 	$id = $_GET['id'];
	$delete_command = sprintf("DELETE FROM relacoes_paises_roteiros WHERE id_roteiro = %d", $id);
	mysql_query($delete_command);
	
	 //pega países relacionados 
						$pegaPaises = $_POST['paises']; 
						$quantidade = count($pegaPaises); 
						
						//echo $_SESSION['uidc']; exit;
						
						for ($i=0; $i<$quantidade; $i++) 
						  { 
							//echo "Telefone: ".$pegaPaises[$i]."<br />"; 
							//$pegaPaises[$i]; $_SESSION['uidc'];
							
							$roteiro = $_SESSION['uidc'];
							$pais = $pegaPaises[$i];
 
				//consulta sql - inserção
				$query = mysql_query("INSERT INTO relacoes_paises_roteiros (id_roteiro, id_pais) VALUES ('$id', '$pais')") or die(mysql_error());						
							
						  }

  	  
	  
	  
  if(!empty($_FILES['imagemnova']['name']))
  {
	
	if ($_FILES['imagemnova']['name']) 
		{
		$file_name = upload_image('imagemnova', $id, '../uploads/roteiros/');
		    if ($file_name != "") 
								{
								   mysql_query(sprintf("UPDATE roteiros SET imagem_roteiro = '%s' WHERE idroteiros = %d", $file_name, $id));
								   $_SESSION['nomefinal7'] = $file_name;
								}
		}
	
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um roteiro.";
	salvaLog($mensagem);	
header('Location:listar.php'); 
  }
    else{
		
			$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou um roteiro.";
			salvaLog($mensagem);
			$_SESSION['ok'] = "Roteiro atualizado com com sucesso!";
			header('Location:listar.php');	 
			
	}
  
   
  }


	} //if !empty $_POST
} //if $pega==2



//DELETAR
if($pega==3)
{

	$id = $_GET['id'];
	
	$from_delete = sprintf("SELECT * FROM roteiros WHERE idroteiros = %d", $id);
	$query = mysql_query($from_delete);
	$delete = mysql_fetch_array($query);
	
	@unlink('../uploads/roteiros/' . $delete['imagem_roteiro']);
	
	$delete_command = sprintf("DELETE FROM roteiros WHERE idroteiros = %d", $id);
	
	mysql_query($delete_command);
	
		/* remove galeria */
	$from_delete2 = sprintf("SELECT * FROM imagens_roteiro WHERE id_roteiro = %d", $id);
	$query2 = mysql_query($from_delete2);
	$delete2 = mysql_fetch_array($query2);
	
	@unlink('../uploads/imagens/roteiros/' . $delete['img']);
	
	$delete_command2 = sprintf("DELETE FROM imagens WHERE id_imovel = %d", $id);
	mysql_query($delete_command2);
	/* fim remove galeria */
	
	$mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Removeu um roteiro do sistema.";
	salvaLog($mensagem);
	$_SESSION['ok'] = "Roteiro removido com sucesso!";
header("location: listar.php"); exit;


}

ob_end_flush(); 
?>