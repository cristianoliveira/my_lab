<?php
include("inc/functions.php");
// Chama a classe PHPMailer (pode baixar ela aqui: http://phpmailer.sourceforge.net)
include('class.phpmailer.php');
 
// Instancia o objeto $mail a partir da Classe PHPMailer
$mail = new PHPMailer();

/*
escolhe_apartamento

checkin
checkout
quartos
adultos
filhos

nome
email

codigo_hotel
nome_hotel

cidade
endereco
telefone
mensagem

echo $campoNome . "\n";
echo $campoEmail . "\n";
echo $campoTelefone . "\n";
echo $campoAssunto . "\n";
echo $campoMensagem . "\n";
*/

// Recupera os dados do formulário
$escolheApto     = $_POST['escolhe_apartamento'];
$checkin         = $_POST['checkin'];
$checkout        = $_POST['checkout'];
$quartos         = $_POST['quartos'];
$adultos         = $_POST['adultos'];
$filhos          = $_POST['filhos'];

$nomeHotel       = $_POST['nome_hotel'];
$codigoHotel     = $_POST['codigo_hotel'];
$pegaHotelok     = $_POST['codigo_retorno'];

$nome            = $_POST['nome'];
$email           = $_POST['email'];
$cidade          = $_POST['cidade'];
$endereco        = $_POST['endereco'];
$telefone        = $_POST['telefone'];
$campoMensagem   = addslashes($_POST['mensagem']);

// Recupera o nome do arquivo
//$arquivo_nome = $arquivo['name'];
 
// Recupera o caminho temporario do arquivo no servidor
//$arquivo_caminho = $arquivo['tmp_name'];

 
// Monta a mensagem que será enviada
$corpo = "<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Transitional//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
<html xmlns=http://www.w3.org/1999/xhtml>
<head>
<meta http-equiv=Content-Type content=text/html; charset=utf-8 />
<title>Untitled Document</title>
<style type=text/css>
body,td,th {
	font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #666;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>
<body>
<table width=100 border=0 cellspacing=5 cellpadding=10>
  <tr>
    <td><a href=www.andesturismo.com.br target=_blank><img src=http://www.andesturismo.com.br/novo/imagens/topo-email.jpg width=640 height=80 border=0 /></a></td>
  </tr>
  <tr>
     <h2> Solicitação Pré-Reserva de Hotéis </h2><br />
		   <h3> Informações do Hotel </h2>

           <p><strong>Hotel:</strong> $nomeHotel</p>
		   <p><strong>Código:</strong> $codigoHotel</p>
		   <p><strong>Data Checkin:</strong> $checkin</p>
		   <p><strong>Data Checkout:</strong> $checkout</p>
		   <p><strong> Apartamento:</strong> $escolheApto </p>
		   <hr />
		   
		   <h3> Informações do Cliente </h2>		   
		   <p><strong>Nome Completo:</strong> $nome</p>
		   <p><strong>E-mail:</strong> $email</p>
		   <p><strong>Cidade:</strong> $cidade</p>
		   <p><strong>Endereço:</strong> $endereco</p>
		   <p><strong>Telefone:</strong> $telefone</p>
		   <p><strong>Mensagem:</strong> $campoMensagem</p>
	  
	  <p>===================== <br />
        Equipe Andes Turismo<br />
        www.andesturismo.com.br        </p>
      <div id=assinatura>
        <p>51 3342.0123 | novidades@andesturismo.com.br <br />
          Av. Assis Brasil, 1652 / 401. Passo D'Areia - Porto Alegre - RS </p>
      </div></td>
  </tr>
</table>
</body>
</html>
	";

 
// Informo o Host, From, subject e para quem o e-mail será enviado
$mail->Host = 'localhost';
$mail->From = 'reservas@andesturismo.com.br'; //anaizolanadvogada@anaizolanadvocacia.com.br
$mail->Subject = 'Solicitação Pré-Reserva de Hotel';
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

	echo "<meta http-equiv='refresh' content='0; url=agendamento.php?r=1&id=$pegaHotelok'>";
	//echo 'E-mail enviado co sucesso';
}
else {
    echo 'Erro:' . $mail->ErrorInfo;
}

?>