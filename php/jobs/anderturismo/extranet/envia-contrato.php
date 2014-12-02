<?php
//include("inc/functions.php");
// Chama a classe PHPMailer (pode baixar ela aqui: http://phpmailer.sourceforge.net)
//include('class.phpmailer.php');
 
// Instancia o objeto $mail a partir da Classe PHPMailer
//$mail = new PHPMailer();

// Recupera os dados do formulário

@$nome            = $_POST['nome'];
@$endereco        = $_POST['endereco'];
@$documento       = $_POST['documento'];
@$bairro	      = $_POST['bairro'];
@$cidade          = $_POST['cidade'];
@$cep          	  = $_POST['cep'];
@$contato         = $_POST['contato'];
@$fonecoml        = $_POST['fonecoml'];
@$email           = $_POST['email'];
@$fonecelular     = $_POST['fonecelular'];
@$datareserva     = $_POST['datareserva'];
@$validadereserva = $_POST['validadereserva'];

@$nomepacote   	  = $_POST['nomepacote'];
@$saida           = $_POST['saida'];
@$regresso     	  = $_POST['regresso'];

@$hotel   	      = $_POST['hotel'];
@$tipoacomodacao  = $_POST['tipoacomodacao'];
@$compartircom 	  = $_POST['compartircom'];

@$cidadeembarque   = $_POST['cidadeembarque'];
@$enderecoembarque = $_POST['enderecoembarque'];
@$observacoes 	   = $_POST['observacoes'];

@$nomeresp        = $_POST['nomeresp'];
@$dataresp  	  = $_POST['dataresp'];
@$passresp 	      = $_POST['passresp'];
@$documentoresp   = $_POST['documentoresp'];
@$emissaopassresp = $_POST['emissaopassresp'];
@$cpfresp 	      = $_POST['cpfresp'];
@$valpassresp     = $_POST['valpassresp'];
@$estcivresp  	  = $_POST['estcivresp'];
@$profissaoresp	  = $_POST['profissaoresp'];
@$foneresresp     = $_POST['foneresresp'];
@$fonecelresp     = $_POST['fonecelresp'];
@$cidaderesp  	  = $_POST['cidaderesp'];
@$estadoresp 	  = $_POST['estadoresp'];
@$bairroresp   	  = $_POST['bairroresp'];
@$cepresp		  = $_POST['cepresp'];
@$endresresp 	  = $_POST['endresresp'];
@$emailresp       = $_POST['emailresp'];

@$nome1        	  = $_POST['nome1'];
@$sexo1        	  = $_POST['sexo1'];
@$datanasc1       = $_POST['datanasc1'];
@$documento1      = $_POST['documento1'];
@$cpf1        	  = $_POST['cpf1'];
@$nome2        	  = $_POST['nome2'];
@$sexo2        	  = $_POST['sexo2'];
@$datanasc2       = $_POST['datanasc2'];
@$documento2      = $_POST['documento2'];
@$cpf2        	  = $_POST['cpf2'];

@$valorpessoa     = $_POST['valorpessoa'];
@$cambio          = $_POST['cambio'];
@$tipopagamento   = $_POST['tipopagamento'];
@$desconto        = $_POST['desconto'];
@$valortaxas      = $_POST['valortaxas'];
@$valorfinal      = $_POST['valorfinal'];

@$numerorecibo    = $_POST['numerorecibo'];

@$pagtipo1        = $_POST['pagtipo1'];
@$pagdetalhes1    = $_POST['pagdetalhes1'];
@$pagpara1        = $_POST['pagpara1'];
@$pagvalor1       = $_POST['pagvalor1'];

@$pagtipo2        = $_POST['pagtipo2'];
@$pagdetalhes2    = $_POST['pagdetalhes2'];
@$pagpara2        = $_POST['pagpara2'];
@$pagvalor2       = $_POST['pagvalor2'];

@$pagtipo3        = $_POST['pagtipo3'];
@$pagdetalhes3    = $_POST['pagdetalhes3'];
@$pagpara3        = $_POST['pagpara3'];
@$pagvalor3       = $_POST['pagvalor3'];

@$pagtipo4        = $_POST['pagtipo4'];
@$pagdetalhes4    = $_POST['pagdetalhes4'];
@$pagpara4        = $_POST['pagpara4'];
@$pagvalor4       = $_POST['pagvalor4'];

@$pagtipo5        = $_POST['pagtipo5'];
@$pagdetalhes5    = $_POST['pagdetalhes5'];
@$pagpara5        = $_POST['pagpara5'];
@$pagvalor5       = $_POST['pagvalor5'];

@$pagtipo6        = $_POST['pagtipo6'];
@$pagdetalhes6    = $_POST['pagdetalhes6'];
@$pagpara6        = $_POST['pagpara6'];
@$pagvalor6       = $_POST['pagvalor6'];

@$pagtipo7        = $_POST['pagtipo7'];
@$pagdetalhes7    = $_POST['pagdetalhes7'];
@$pagpara7        = $_POST['pagpara7'];
@$pagvalor7       = $_POST['pagvalor7'];

@$pagtipo8        = $_POST['pagtipo8'];
@$pagdetalhes8    = $_POST['pagdetalhes8'];
@$pagpara8        = $_POST['pagpara8'];
@$pagvalor8       = $_POST['pagvalor8'];

@$pagtipo9        = $_POST['pagtipo9'];
@$pagdetalhes9    = $_POST['pagdetalhes9'];
@$pagpara9        = $_POST['pagpara9'];
@$pagvalor9       = $_POST['pagvalor9'];

@$pagtipo10       = $_POST['pagtipo10'];
@$pagdetalhes10   = $_POST['pagdetalhes10'];
@$pagpara10       = $_POST['pagpara10'];
@$pagvalor10      = $_POST['pagvalor10'];

/*
echo @$nome . "\n";
echo @$email . "\n";
echo @$cidade . "\n";
echo @$endereco . "\n";
echo @$telefone . "\n";
echo @$mensagem . "\n";
exit();
*/

// Recupera o nome do arquivo
//$arquivo_nome = $arquivo['name'];
 
// Recupera o caminho temporario do arquivo no servidor
//$arquivo_caminho = $arquivo['tmp_name'];

 
// Monta a mensagem que será enviada
$corpo = "
           <h2> FICHA DE CONFIRMAÇÃO DE RESERVAS DE PACOTES TURÍSTICOS - Andes Turismo </h2>
		   <hr />
	
		   <h3> Agente de viagem / Agência de viagem </h3>		   
		   <p><strong>Nome/Empresa:</strong> $nome</p>
		   <p><strong>Endereço:</strong> $endereco</p>
		   <p><strong>CPF / RG / CNPJ:</strong> $documento</p>
		   <p><strong>Bairro:</strong> $bairro</p>
		   <p><strong>Cidade:</strong> $cidade</p>
		   <p><strong>CEP:</strong> $cep</p>
		   <p><strong>Contato:</strong> $contato</p>
		   <p><strong>Fone coml:</strong> $fonecoml</p>
		   <p><strong>E-mail:</strong> $email</p>
		   <p><strong>Fone Celular:</strong> $fonecelular</p>
		   <p><strong>Data da Reserva:</strong> $datareserva</p>
		   <p><strong>Validade da Reserva:</strong> $validadereserva</p><br/>
		   
		   <h3> Programa de viagem - pacote turístico </h3>		   
		   <p><strong>Nome do pacote:</strong> $nomepacote</p>
		   <p><strong>Saída:</strong> $saida</p>
		   <p><strong>Regresso:</strong> $regresso</p><br/>

		   <h3> Hotéis previstos </h3>		   
		   <p><strong>Indique o hotel:</strong> $hotel</p>
		   <p><strong>Tipo de acomodação:</strong> $tipoacomodacao</p>
		   <p><strong>Apto a compartir com Sr/Sra.:</strong> $compartircom</p><br/>

		   <h3> Local de embarque </h3>		   
		   <p><strong>Cidade de embarque:</strong> $cidadeembarque</p>
		   <p><strong>Endereço de embarque:</strong> $enderecoembarque</p>
		   <p><strong>Observações:</strong> $observacoes</p><br/>

		   <h3> Responsável pelo pagamento </h3>		   
		   <p><strong>Nome:</strong> $nomeresp</p>	
		   <p><strong>Data de nascimento:</strong> $dataresp</p>
		   <p><strong>Passaporte N°:</strong> $passresp</p>
		   <p><strong>RG / Passaporte:</strong> $documentoresp</p>
		   <p><strong>Emissão Passaporte:</strong> $emissaopassresp</p>
		   <p><strong>Cadastro Pessoa Física (CPF):</strong> $cpfresp</p>
		   <p><strong>Validade Passaporte:</strong> $valpassresp</p>
		   <p><strong>Estado civil:</strong> $estcivresp</p>
		   <p><strong>Profissão:</strong> $profissaoresp</p>
		   <p><strong>Fone residencial:</strong> $foneresresp</p>
		   <p><strong>Fone celular:</strong> $fonecelresp</p>
		   <p><strong>Mora na Cidade de:</strong> $cidaderesp</p>
		   <p><strong>Estado:</strong> $estadoresp</p>
		   <p><strong>Bairro:</strong> $bairroresp</p>
		   <p><strong>CEP:</strong> $cepresp</p>
		   <p><strong>Endereço residencial:</strong> $endresresp</p>
		   <p><strong>Endereço eletrônico / E-mail:</strong> $emailresp</p><br/>

		   <h3> Dados dos passageiros </h3>
		   <h5> Passageiro 1 </h5>		   
		   <p><strong>Nome:</strong> $nome</p>
		   <p><strong>Sexo:</strong> $email</p>
		   <p><strong>Data Nasc.:</strong> $cidade</p>
		   <p><strong>RG / Passaporte:</strong> $email</p>
		   <p><strong>CPF:</strong> $cidade</p>
		   <h5> Passageiro 2 </h5>		   
		   <p><strong>Nome:</strong> $nome</p>
		   <p><strong>Sexo:</strong> $email</p>
		   <p><strong>Data Nasc.:</strong> $cidade</p>
		   <p><strong>RG / Passaporte:</strong> $email</p>
		   <p><strong>CPF:</strong> $c</p><br/>";

		   for($i = 1; $i < 11; $i++){
		   		$corpo .= "<h5> Passageiro $i </h5>		   
			   	<p><strong>Nome:</strong> $nome$i</p>
			  	<p><strong>Sexo:</strong> $sexo$i</p>
			   	<p><strong>Data Nasc.:</strong> $datanasc$i</p>
			   	<p><strong>RG / Passaporte:</strong> $documento$i</p>
			   	<p><strong>CPF:</strong> $cpf$i</p>";				
		   			
		   }

		   $corpo .= "<br/><h3> Valores </h3>		   
		   <p><strong>Valor por pessoa em U$D:</strong> $valorpessoa</p>
		   <p><strong>Câmbio:</strong> $cambio</p>
		   <p><strong>Parcelado / a Vista:</strong> $tipopagamento</p>
		   <p><strong>Desconto:</strong> $desconto</p>
		   <p><strong>Valor Taxas R$:</strong> $valortaxas</p>
		   <p><strong>Valor final R$:</strong> $valorfinal</p><br/>

		   <p><strong>Número do recibo:</strong> $numerorecibo</p><br/>";

		   for($i = 1; $i < 11; $i++){
		   		$corpo .= "<h3> Pagamentos </h3>
				   <h5> $i° Pagamento </h5>		   
				   <p><strong>Tipo de Operação:</strong> $pagtipo$i</p>
				   <p><strong>Detalhes da venda (dinheiro/cheque/cartão):</strong> $pagdetalhes$i</p>
				   <p><strong>Para:</strong> $pagpara$i</p>
				   <p><strong>Valor R$:</strong> $pagvalor$i</p>";			
		   }

		   $corpo .= "<div style=width:100%;height:50px;background-color:#CCC>
		   <small style=margin-left:20px;margin-top:10px;font-family:verdana>
		   	Andes Turismo - Grupo Andes Travel Brasil
			Av. Assis Brasil, 1652 / 401. Passo D'Areia - Porto Alegre - RS
			CEP 91010-001 - Telefone: 51 3342.0123
			E-mail: contato@andesturismo.com.br
		   </small>
		   </div>
	";

 
// Informo o Host, From, subject e para quem o e-mail será enviado
$mail->Host = 'localhost';
$mail->From = 'contato@andesturismo.com.br'; //anaizolanadvogada@anaizolanadvocacia.com.br
$mail->Subject = 'Envio de Ficha';
$mail->AddAddress('junior@obrcom.com.br'); //anaizolanadvogada@gmail.com
$mail->AddCC('mailsclientesdaobra@gmail.com'); //mailsclientesdaobra@gmail.com
$mail->AddBCC('viniciusbudde@gmail.com'); //atendimento@anaizolanadvocacia.com.br
 
// Informa que a mensagem deve ser enviada em HTML
$mail->IsHTML(true);
 
// Informa o corpo da mensagem
$mail->Body = $corpo;
 
// Se o e-mail destino não suportar HTML ele envia o texto simples
//$mail->AltBody = $corpoSimples;
 
// Anexa o arquivo
//$mail->AddAttachment($arquivo_caminho, $arquivo_nome);      // attachment

//$mail->Send();
//$mail->AddAttachment($arquivo_caminho, $arquivo_nome);
//$mail->AddAttachment($arquivo_caminho2, $arquivo_nome2);

 
// Tenta enviar o e-mail e analisa o resultado
if ($mail->Send()) {
    header("location: fale-conosco.php?r=1");
	//echo 'E-mail enviado co sucesso';
}
else {
    echo 'Erro:' . $mail->ErrorInfo;
}

?>