<?php 
@session_start();
//session_destroy();

// Remove as variáveis da sessão (caso elas existam)
unset($_SESSION['usuario_logado_id'], $_SESSION['nome_usuario'], $_SESSION['usuario_do_cara'], $_SESSION['flash_error'], $_SESSION['logout']);

$_SESSION['logout']=1;
header("location:login.php");
?>
