<?php 
@session_start();
session_destroy();

$_SESSION['flash_error'] = 'Saiu do sistema!';


header("location: login.php");
?>
