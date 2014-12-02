<?php
ob_start();
@session_start();
// adiciona produto a tbl_carrinho(id,cod,nome,preco,qtd,sessao)
include("inc/functions.php");

$pcp = trim($_GET["id"]); //pega código produto

//cria sessao único do visitante
$sessao = $_SESSION["vinicius"];

$result = select("roteiros","*","WHERE idroteiros=$pcp",NULL); //seleciona na tabela de produtos o produto em si

for($i=0;$i<count($result);$i++)
{

	$conn = mysql_connect("mysql.andesturismo.com.br","andesturismo02","c1a5k0"); // editar host, usuario, senha
	mysql_select_db("andesturismo02",$conn); // editar para o seu banco de dados 

$itens_orcamento = mysql_query("SELECT * FROM roteiros_selecionados WHERE id_roteiro = $pcp AND sessao = '$sessao'");
$num_rows = mysql_num_rows($itens_orcamento);

if(empty($num_rows)){
	
	 		// se ok, insere, se não, não.
			$camposForm = "'', '". $result[$i]['idroteiros'] ."', '". $result[$i]['nome_roteiro'] . "', '". $sessao ."'";
			if (insereCarrinho($camposForm))   //e adiciona na tabela carrinho.
		
								{ 
									$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
									//echo $_SESSION['ok'];
									if(@$_GET["a"]==1){ echo "<meta http-equiv='refresh' content='0; url=index.php?r=1'>"; } //header("Location: index.php?r=1"); exit(); }
									
									/*if(@$_GET["a"]==2){  echo "<meta http-equiv='refresh' content='0; url=index.php?r=2'>"; } //header("Location: pagina-roteiro.php?r=2");  exit();}
									if(@$_GET["a"]==3){  echo "<meta http-equiv='refresh' content='0; url=index.php?r=3'>"; } //header("Location: busca-rapida.php?r=3"); exit(); } */
									
									
								}
							else { 
									$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível adicionar, tente novamente mais tarde ou contate o suporte."; 
									//header("location: listar.php?p=8&g=1");
			}
	 
	 
}
else{ 
									if(@$_GET["a"]==1){  echo "<meta http-equiv='refresh' content='0; url=index.php?r=3'>"; } //header("Location: index.php?r=1"); exit(); }
									if(@$_GET["a"]==2){  echo "<meta http-equiv='refresh' content='0; url=promocoes.php?r=2'>"; } //header("Location: promocoes.php?r=2"); exit(); }
									if(@$_GET["a"]==3){  echo "<meta http-equiv='refresh' content='0; url=produtos.php?r=3'>"; } //header("Location: produtos.php?r=3");  exit();}
}

	
}
ob_end_flush();
exit();
?>