<?php
$_BS['MySQL']['servidor'] = 'mysql.andesturismo.com.br';
$_BS['MySQL']['usuario'] = 'andesturismo02';
$_BS['MySQL']['senha'] = 'c1a5k0';
$_BS['MySQL']['banco'] = 'andesturismo02';
//$con = mysql_connect($_BS['MySQL']['servidor'], $_BS['MySQL']['usuario'], $_BS['MySQL']['senha']) or trigger_error(mysql_error(),E_USER_ERROR);

$conexao = mysql_connect("mysql.andesturismo.com.br","andesturismo02","c1a5k0");
mysql_select_db("andesturismo02", $conexao);


/*
$_BS['MySQL']['servidor'] = 'localhost';
$_BS['MySQL']['usuario'] = 'root';
$_BS['MySQL']['senha'] = '';
$_BS['MySQL']['banco'] = 'andesturismo';
mysql_connect($_BS['MySQL']['servidor'], $_BS['MySQL']['usuario'], $_BS['MySQL']['senha']);
mysql_select_db($_BS['MySQL']['banco']);
// ====(Fim da conexão)====
*/
?>