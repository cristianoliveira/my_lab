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

$nome            = $_POST['nome'];
$email           = $_POST['email'];
$cidade          = $_POST['cidade'];
$endereco        = $_POST['endereco'];
$telefone        = $_POST['telefone'];
$campoMensagem   = addslashes($_POST['mensagem']);


echo $escolheApto."1<br/>";
echo $checkin."2<br/>";
echo $checkout."3<br/>";
echo $quartos."4<br/>";
echo $adultos."5<br/>";
echo $filhos."6<br/>";
echo $nomeHotel."7<br/>";
echo $codigoHotel."8<br/>";
echo $nome."9<br/>";
echo $email."10<br/>";
echo $cidade."11<br/>";
echo $endereco."12<br/>";
echo $telefone."13<br/>";
echo $campoMensagem."14<br/>";
exit;

// Recupera o nome do arquivo
//$arquivo_nome = $arquivo['name'];
 
// Recupera o caminho temporario do arquivo no servidor
//$arquivo_caminho = $arquivo['tmp_name'];

 
// Monta a mensagem que será enviada
$corpo = "
           <h2> Solicitação Pré-Reserva de Hotéis </h2>
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
		   
		   <div style=width:100%;height:50px;background-color:#CCC>
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
    header("location: agendamento.php?r=1");
	//echo 'E-mail enviado co sucesso';
}
else {
    echo 'Erro:' . $mail->ErrorInfo;
}

?>