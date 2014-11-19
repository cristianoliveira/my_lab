<?php
$link = mysql_connect('mysql06-farm13.kinghost.net', 'movelclube', 'j6t4h2');
if (!$link) {
die('Não conseguiu conectar: ' . mysql_error());
}

// seleciona o banco movelclube
$db_selected = mysql_select_db('movelclube', $link);
if (!$db_selected) {
die ('Não pode selecionar o banco movelclube : ' . mysql_error());
}

?>