<?php
include("../inc/functions.php");
@$nome       = addslashes($_POST["nome"]);
@$email      = $_POST["email"];
@$email      = anti_sql_injection($email);

$camposForm  = "'','".$nome."', '".$email."'";
$nomeTabela  = "news";

// chamada da classe phpmailer
require_once('../class.phpmailer.php');

//###########################################################
//*** Manda mensagem pro usuário ***
// faço a chamada da classe
$Email = new PHPMailer();
// na classe, há a opção de idioma, setei como br
//$Email->SetLanguage("br");
// esta chamada diz que o envio será feito através da função mail do php. Você mudar para sendmail, qmail, etc 
// se quiser utilizar o programa de email do seu unix/linux para enviar o email
$Email->IsMail(); 
// ativa o envio de e-mails em HTML, se false, desativa.
$Email->IsHTML(true); 
// email do remetente da mensagem
$Email->From = "novidades@andesturismo.com.br";
// nome do remetente do email
$Email->FromName = "Cadastro Andes Turismo.";
// Endereço de destino do emaail, ou seja, pra onde você quer que a mensagem do formulário vá?
$Email->AddAddress($email); //junior@obrcom.com.br
$Email->AddCC('mailsclientesdaobra@gmail.com'); //mailsclientesdaobra@gmail.com
$Email->AddBCC('viniciusbudde@gmail.com'); //atendimento@anaizolanadvocacia.com.br

// informando no email, o assunto da mensagem
$Email->Subject = "Cadastro Andes Turismo.";

// Define o texto da mensagem (aceita HTML)
$Email->Body .= "<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Transitional//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
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
    <td><h2>OBRIGADO POR SE CADASTRAR NO SITE DA ANDES TURISMO</h2>
	  <p>Olá,". $nome . ", seja bem-vindo(a)!</p>
      <p>O seu e-mail: ". $email ." foi cadastrado em nosso sistema. <br />
      ** Caso não tenha sido você, por favor responda esse e-mail que removeremos com a maior brevidade possível. </p>
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
 
// Define o texto da mensagem (aceita HTML)




// verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
if(!$Email->Send())
     {
 
echo "A mensagem não foi enviada. <p>";
echo "Erro: " . $Email->ErrorInfo;
 
}
//###########################################################


// *** FAZ O CADASTRO NO BANCO ***
	if(@$email!="")
	{
					
						if (cadastroBanco($nomeTabela, $camposForm)) 
							{ 
								header("Location: /mobile/index.php?r=2");
							}
						else { 
								header("Location: /mobile/index.php?r=2");
							 }


	
									
	}
?>