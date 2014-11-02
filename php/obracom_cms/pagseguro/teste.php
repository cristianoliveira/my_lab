<?php
	
	include('../includes/models/pagseguro_model.php');

	$pagseguro = new PagSeguroModel();
	//$data = $pagseguro->getDadosTransacao('7BF67651218F4E84BB36D510F16BC5A0');

	//echo "TRANSACAO $data->code";
	
	$dateTime = new DateTime();
	$dateTime->sub(new DateInterval("P90D"));
	$dataIni     = $dateTime->format(DateTime::W3C);
	
	$dateTime = new DateTime();
	$data     = $dateTime->format(DateTime::W3C);
	
	$result = $pagseguro->getTransacoesDesde($dataIni);

	print_r($result);

	foreach ($result as $res) {
		$transacao = $pagseguro->getTransacao($res['codigo']);

		print_r($transacao);
	}

	print_r($result);
	print_r(libxml_get_errors());
?>