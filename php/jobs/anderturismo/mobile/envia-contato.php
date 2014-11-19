<?php
//include("inc/functions.php");
// Chama a classe PHPMailer (pode baixar ela aqui: http://phpmailer.sourceforge.net)
//include('class.phpmailer.php');
 
// Instancia o objeto $mail a partir da Classe PHPMailer
//$mail = new PHPMailer();

// Recupera os dados do formulário

@$nome            = $_POST['nome'];
@$email           = $_POST['email'];
@$cidade          = $_POST['cidade'];
@$endereco        = $_POST['endereco'];
@$telefone        = $_POST['telefone'];
@$mensagem        = addslashes($_POST['mensagem']);

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
           <h2> Contato - Andes Turismo </h2>
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
$mail->From = 'contato@andesturismo.com.br'; //anaizolanadvogada@anaizolanadvocacia.com.br
$mail->Subject = 'Envio de contato';
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