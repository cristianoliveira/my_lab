<?php
session_start();
/**
 * Demo script for SecureSession
 * 
 * Requirement: PHP 5.2.1+
 *
 * @author    Enrico Zimuel (enrico@zimuel.it)
 * @copyright GNU General Public License 
 */
require_once 'inc/SecureSession.php';

// change the default session folder in a temporary dir
$sessionPath = sys_get_temp_dir();
session_save_path($sessionPath);


if (empty($_SESSION['time'])) {
    $_SESSION['time'] = time();
}    

$filename = session_id();

if(empty($_SESSION["vinicius"])){
	$_SESSION["vinicius"] = $filename;
}

//echo $filename;

//setcookie('sessao', $nome, (time() + (2 * 3600)));

// Pega o valor do Cookie 'nome' definido anteriormente:
//$sessao = $_COOKIE['nome']; // Ciclano

//echo $valor; exit;
?>