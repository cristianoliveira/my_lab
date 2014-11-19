<?php
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");


@$codigo = $_REQUEST["1"];


$sql = mysql_query("SELECT * FROM news ORDER BY nome ASC");


$_COOKIE["news"]="current";
$_COOKIE["news1"]="";
$_COOKIE["news2"]="current";



	
/*
@$data = $row['data'];	
echo $row['nomedocara']; echo "<br />";
echo $row['resposta'];    echo "<br />";
echo $row['nomepromo'];     echo "<br />";
echo $row['pergunta'];     echo "<br />";
echo $row['nomecliente'];     echo "<br />";
echo $row['fone'];     echo "<br />";
echo $row['email'];     echo "<br />";
echo $row['documento'];     echo "<br />";
echo $row['cidade'];     echo "<br />";
echo $row['estado'];     echo "<br />";

echo date("d/n/Y G:i:s", strtotime($row['data'])); 

// Saída = 01/08/2011 16:30:08
*/


//echo "<hr />";




/*
* Criando e exportando planilhas do Excel
* http://blog.thiagobelem.net/
*/

// Definimos o nome do arquivo que será exportado
$arquivo = 'lista-emails.xls';

// Criamos uma tabela HTML com o formato da planilha
$html = '<strong> LISTA DE E-MAILS </strong>';
$html .= '
<table width=550 border=1 cellspacing=2 cellpadding=2>
  <tr style=color:#fff>
    <td align=center bgcolor=#003366><strong>Nome do Cliente</strong></td>
	<td align=center bgcolor=#003366><strong>E-mail</strong></td>
  </tr>';


$cont = 0;
// Exibe o resultado da nossa consulta
while ($row = mysql_fetch_array($sql))
{ 
$html .='<tr>';
$html .='<td>'.$row['nome'].'</td>';
$html .='<td>'.$row['email'].'</td>';
$html .='</tr>';

 $cont = $cont + 1; 
}

$html .='</tr></table>';

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

// Envia o conteúdo do arquivo
echo $html;
echo "<script>javascript:window.close();</script>";
exit;

?>