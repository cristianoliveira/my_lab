<?php 
include('includes/database_connection.php');
include('includes/functions.php');
include("includes/logs.php");

@session_start();

$username = trim($_POST['log']);
$password = trim($_POST['pwd']);


if(!empty($username) and !empty($password) ){
	
    $sql  = 'SELECT *';
    $sql .= 'FROM usuarios ';
    $sql .= 'WHERE conta = \'' . anti_sql_injection($username) . '\' ';
    $sql .= 'AND senha = \'' . anti_sql_injection($password) . '\' ';
	
	//echo $sql;
	
	$sql_user = sprintf($sql, $username, $password);
	
	$rs_user = mysql_query($sql_user) or die("Erro ao afetuar consulta");
	
	if (mysql_num_rows($rs_user) > 0) {
	  $user = mysql_fetch_array($rs_user);
	  if ($user['status'] == false) {
		$_SESSION['flash_error'] = 'Usuário inativo no sistema!';
			$mensagem = "[TENTATIVA DE LOGIN] - Com os dados:" . $username. "/" . $password;
		salvaLog($mensagem);
		header('Location:login.php');  
	  }
	  else {   
		$_SESSION['usuario_logado_id'] = $user['idusuario']; //ID do usuário logado.
		$_SESSION['nome_usuario'] = $user['nome_usuario']; // nome do usuário logado.
		$_SESSION['usuario_do_cara'] = $user['conta']; // o usuário do cara logado.
		header('Location:home.php');  
	  }
	}
	else {
	  $_SESSION['flash_error'] = 'Usuário e/ou senha inválido(s)!';
		  $mensagem = "[TENTATIVA DE LOGIN] - Com os dados: Usuário: " . $username. " / Senha: " . $password. " -> USUARIO OU SENHA INVALIDOS <-";
		  $_SESSION['logout']=0;
	  salvaLog($mensagem);
	  header('Location:login.php');  
	}
} else {  
		$_SESSION['flash_error'] = 'Preencha os campos corretamente.'; 
			  $mensagem = "[TENTATIVA DE LOGIN] - Com os dados: Usuário: " . $username. " / Senha: " . $password. " -> NAO PREENCHEU OS DADOS <-";
			   $_SESSION['logout']=0;
		  salvaLog($mensagem);		
		header('Location:login.php'); }
?>
