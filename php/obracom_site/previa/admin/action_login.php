<?php 
include("includes/database_connection.php");
include("includes/functions.php");
include("includes/logs.php");
include("includes/models/usuarios_model.php");

@session_start();

$username = trim($_POST['log']);
$password = trim($_POST['pwd']);

	if(!empty($username) and !empty($password) ){
		
		$usuarios = new UsuariosModel();
		$dados    = array('usuario'=> $username, 'senha' => $password);
		$usuario  = $usuarios->getFirst($dados);
			
		if(!empty($usuario)){
			$_SESSION['usuario_logado_id'] = $usuario['id']; //ID do usuário logado.
			$_SESSION['nome_usuario']      = $usuario['nome']; // nome do usuário logado.
			$_SESSION['usuario_do_cara']   = $usuario['usuario']; // o usuário do cara logado.
			header('Location:clientes/listar.php');  
		}
		else
		{
			$_SESSION['flash_error'] = 'Usuário e/ou senha inválido(s)!';
			$mensagem = "[TENTATIVA DE LOGIN] - Com os dados: Usuário: " . $username. " / Senha: " . $password. " -> USUARIO OU SENHA INVALIDOS <-";
			//salvaLog($mensagem);
			header('Location:'.site_url('login.php')); 
		}
	} 
	else
	{
		$_SESSION['flash_error'] = 'Preencha todos os campos!';
		header('Location:'.site_url('login.php')); 
	}	
	
	//Não sei se vai continuar sendo utilizado abaixo! - Cristian Oliveira
	/*
    $sql  = 'SELECT *';
    $sql .= 'FROM usuarios ';
    $sql .= 'WHERE conta = \'' . anti_sql_injection($username) . '\' ';
    $sql .= 'AND senha = \'' . anti_sql_injection($password) . '\' ';
	
	
	//echo $sql;
	
	//$sql_user = sprintf($sql, $username, $password);
	
	//$rs_user = mysql_query($sql_user) or die("Erro ao afetuar consulta");
	
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
		header('Location:categorias/listar.php');  
	  }
	}
	else {
	  $_SESSION['flash_error'] = 'Usuário e/ou senha inválido(s)!';
		  $mensagem = "[TENTATIVA DE LOGIN] - Com os dados: Usuário: " . $username. " / Senha: " . $password. " -> USUARIO OU SENHA INVALIDOS <-";
	  salvaLog($mensagem);
	  header('Location:login.php');  
	}
} else {  
		$_SESSION['flash_error'] = 'Preencha os campos corretamente.'; 
			  $mensagem = "[TENTATIVA DE LOGIN] - Com os dados: Usuário: " . $username. " / Senha: " . $password. " -> NAO PREENCHEU OS DADOS <-";
		  salvaLog($mensagem);		
		header('Location:login.php'); }
		*/
?>
