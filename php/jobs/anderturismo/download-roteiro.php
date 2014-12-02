<?php
	include("inc/mpdf/mpdf.php");
	include_once("inc/inc.bkl.php");
	$id = $_POST['codigo']; // MUDEI AQUI PARA POST, FAVOR não alterar.
	$roteiro = mysql_query("SELECT c.imagem, r.nome_roteiro, r.subtitulo, r.datas_completas, r.programacao_diaria FROM roteiros 
		as r INNER JOIN capa_roteiros as c ON r.capas_roteiros = c.idcapas WHERE idroteiros = '$id' LIMIT 1");
	if(mysql_num_rows($roteiro) > 0 ){
		$linha_roteiro = mysql_fetch_array($roteiro);
	    $mpdf = new mPDF('','A4', '', 'Tahoma', '', '', '', '', '', '', '');
		$stylesheet = file_get_contents('inc/mpdf/style.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML('<div id="capa" style="background:url(cms/uploads/capas/'.$linha_roteiro['imagem'].');"></div>');
		$mpdf->AddPage('', 'A4', '', '', '', 13, 13, 18, 13);
		$mpdf->WriteHTML('<style>@page {margin: 30px;}</style>');
			$mpdf->WriteHTML('<div class="page-header"><h2>'.$linha_roteiro['nome_roteiro'].'</h2></div>');
			$mpdf->WriteHTML('<h3>'.$linha_roteiro['subtitulo'].'</h3>');

			
			$mpdf->WriteHTML('<h4>'.$linha_roteiro['datas_completas'].'</h4>');
			$mpdf->WriteHTML('<p>'.$linha_roteiro['programacao_diaria'].'</p><br/>');
			/*$mpdf->WriteHTML('<p class="azul">Valores, condições e todos os detalhes para esta viagem, favor baixe o 
				arquivo em word <br/> ou pdf através do menu "Roteiro Completo".</p>');*/
			$mpdf->WriteHTML('<div id="preencherodape"></div><div id="rodape"><strong> Andes Turismo - Grupo Andes Travel Brasil </strong><br />
								<p> Av. Assis Brasil, 1652 / 401. Passo D\'Areia - Porto Alegre - RS </p>
								<p> CEP 91010-001 - Telefone: 51 3342.0123 </p>
								<p> E-mail: contato@andesturismo.com.br</p><br />
								<p><img src="imagens/formas_pagamento.png" width="318" height="61" /></p></div>');
		$mpdf->Output();
	}else{
		 $mpdf = new mPDF('','A4', '', 'Tahoma', 10, 10, 10, 10, '', '', '');
		 $mpdf->WriteHTML('<p style="text-align:center;">O roteiro não foi encontrado!</p>');
		 $mpdf->Output();
	}
	exit();
?>