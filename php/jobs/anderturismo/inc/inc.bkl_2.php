<?php 
$_BS['MySQL']['servidor'] = 'mysql.andesturismo.com.br';
$_BS['MySQL']['usuario'] = 'andesturismo02';
$_BS['MySQL']['senha'] = 'c1a5k0';
$_BS['MySQL']['banco'] = 'andesturismo02';
mysql_connect($_BS['MySQL']['servidor'], $_BS['MySQL']['usuario'], $_BS['MySQL']['senha']);
mysql_select_db($_BS['MySQL']['banco']);
?>