<?php

$lang['email_must_be_array'] = "O método de validação do e-mail deve ser passado num array.";
$lang['email_invalid_address'] = "Endereço de e-mail inválido: %s";
$lang['email_attachment_missing'] = "Não foi possível localizar o seguinte anexo do e-mail: %s";
$lang['email_attachment_unreadable'] = "Não foi possível abrir o seguinte anexo: %s";
$lang['email_no_recipients'] = "Deverá incluir os destinatários: To, Cc, ou Bcc";
$lang['email_send_failure_phpmail'] = "Não foi possível enviar o e-mail usando a função mail() do PHP. O servidor não está configurado para enviar e-mails desta forma.";
$lang['email_send_failure_sendmail'] = "Não foi possível enviar o e-mail usando o sendmail via PHP. O servidor não está configurado para enviar e-mails desta forma.";
$lang['email_send_failure_smtp'] = "Não foi possível enviar o e-mail usando o SMTP via PHP. O servidor não está configurado para enviar e-mails desta forma.";
$lang['email_sent'] = "A sua mensagem foi enviada com sucesso através do seguinte protocolo: %s";
$lang['email_no_socket'] = "Não foi possível abrir um socket para o Sendmail. Por favor confira suas configurações.";
$lang['email_no_hostname'] = "Não especificou um servidor SMTP.";
$lang['email_smtp_error'] = "Os seguintes erros de SMTP foram encontrados: %s";
$lang['email_no_smtp_unpw'] = "Erro: Deverá fornecer um utilizador e uma palavra-passe SMTP.";
$lang['email_failed_smtp_login'] = "Falha ao enviar o comando AUTH LOGIN. Erro: %s";
$lang['email_smtp_auth_un'] = "Falha ao autenticar o utilizador. Erro: %s";
$lang['email_smtp_auth_pw'] = "Falha ao autenticar a palavra-passe. Erro: %s";
$lang['email_smtp_data_failure'] = "Não foi possível enviar os dados: %s";

?>