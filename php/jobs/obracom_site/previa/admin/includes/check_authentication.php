<?php 
@session_start();
if (isset($_SESSION['usuario_logado_id']) && isset($_SESSION['nome_usuario'])){
   $user_logged_name = $_SESSION['nome_usuario'];
}
else {
   $_SESSION['flash_error'] = 'Área restrita, é necessário realizar o login.';
   header("Location: http://".$_SERVER[SERVER_NAME]."/previa/admin/login.php");
}
?>
