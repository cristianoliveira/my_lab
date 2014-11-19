<?php
$arquivo = $_GET['arquivo'];
$arquivo = 'arquivos/'.$arquivo.'.doc';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT\n");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
$tamanho = filesize($arquivo);
header("Content-Length: $tamanho;\n");
header("Content-Disposition: attachment; filename=\"$arquivo\";\n\n");
readfile($arquivo);
exit();
?>