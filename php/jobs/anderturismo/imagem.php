<?php
include('m2brimagem.class.php');
$arquivo	= $_GET['arquivo']; //pega de 1 diretório
$largura	= $_GET['largura'];
$altura		= $_GET['altura'];
$oImg = new m2brimagem($arquivo);
$valida = $oImg->valida();
if ($valida == 'OK') {
	$oImg->redimensiona($largura,$altura,'crop');
    $oImg->grava(); //salva
} else {
	die($valida);
}
exit;


?>