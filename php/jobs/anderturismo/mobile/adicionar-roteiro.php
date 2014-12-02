<?php
// adiciona produto a tbl_carrinho(id,cod,nome,preco,qtd,sessao)
include("../inc/functions.php");

$pcp = trim($_POST["codigo_roteiro"]); //pega código produto
//$sessao = $_COOKIE['sessao'];
include "../cria_sessao.php";
$sessao = $_SESSION["vinicius"];

$result = select("roteiros","*","WHERE idroteiros=$pcp",NULL); //seleciona na tabela de produtos o produto em si
for($i=0;$i<count($result);$i++)
{
	//echo $result[$i]['nome_produto'] . "<br>";
		
/*
$link = mysql_connect("robb0188.publiccloud.com.br:3306", "obrac_obracms", "23593nsj");
mysql_select_db("obracomunicacao_agrovida", $link);
*/

include("../inc/inc.bkl.php");

$itens_orcamento = mysql_query("SELECT * FROM roteiros_selecionados WHERE id_roteiro = $pcp AND sessao = '$sessao'", $link);
$num_rows = mysql_num_rows($itens_orcamento);

if(empty($num_rows)){
	
	 		// se ok, insere, se não, não.
			$camposForm = "'', '". $result[$i]['idroteiros'] ."', '". $result[$i]['nome_roteiro'] . "', '". $sessao ."'";
			if (insereCarrinho($camposForm))   //e adiciona na tabela carrinho.
		
								{ 
									$_SESSION['ok'] = "Cadastro efetuado com sucesso!";
									//echo $_SESSION['ok'];
									if(@$_GET["a"]==1){ header("Location: /mobile/index.php?r=1"); }
									if(@$_GET["a"]==2){ header("Location: /mobile/pagina-roteiro.php?r=2"); }
									if(@$_GET["a"]==3){ header("Location: /mobile/busca-rapida.php?r=3"); }
									
								}
							else { 
									$_SESSION['erro'] = "Ops! Desculpe-nos. Não foi possível adicionar, tente novamente mais tarde ou contate o suporte."; 
									//header("location: listar.php?p=8&g=1");
			}
	 
	 
}
else{ 
									if(@$_GET["a"]==1){ header("Location: /mobile/index.php?r=1"); }
									if(@$_GET["a"]==2){ header("Location: /mobile/promocoes.php?r=2"); }
									if(@$_GET["a"]==3){ header("Location: /mobile/produtos.php?r=3"); }
}

	
}
?>