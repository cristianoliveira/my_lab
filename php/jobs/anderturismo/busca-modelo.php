<?php
// Conexão com o MySQL
// ========================
$_BS['MySQL']['servidor'] = 'localhost';
$_BS['MySQL']['usuario'] = 'root';
$_BS['MySQL']['senha'] = '';
$_BS['MySQL']['banco'] = 'andesturismo';
mysql_connect($_BS['MySQL']['servidor'], $_BS['MySQL']['usuario'], $_BS['MySQL']['senha']);
mysql_select_db($_BS['MySQL']['banco']);
// ====(Fim da conexão)====

// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante
/* ativa só qdo estiver online 
if (!isset($_GET['consulta'])) {
header("Location: http://www.andesturismo.com.br/");
exit;
}
*/
// Se houve busca, continue o script:

// Salva o que foi buscado em uma variável 
/*palavra-chave
checkin
checkout
adultos
criancas
quartos
*/
$busca    = $_POST['palavra-chave'];
$checkin  = $_POST['checkin'];
$checkout = $_POST['checkout'];
$adultos  = $_POST['adultos'];
$criancas = $_POST['criancas'];
$quartos  = $_POST['quartos'];

// Usa a função mysql_real_escape_string() para evitar erros no MySQL
$busca    = mysql_real_escape_string($busca);
$checkin  = mysql_real_escape_string($checkin);
$checkout = mysql_real_escape_string($checkout);
$adultos  = mysql_real_escape_string($adultos);
$quartos  = mysql_real_escape_string($quartos);

// ============================================

// Monta outra consulta MySQL para a busca
$sql = "SELECT * FROM `hoteis` WHERE (`status` = 1) AND ((`nome_hotel` LIKE '%".$busca."%') OR (`localizacao` LIKE '%".$busca."%') OR (`identificacao` LIKE '%".$busca."%')) ORDER BY `nome_hotel` DESC";
// Executa a consulta
$query = mysql_query($sql);

// ============================================

// Começa a exibição dos resultados
if(empty($query)){print "oi"; } else{ echo "hhahaha"; }
?>