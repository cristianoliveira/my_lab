<?php

 include_once 'model.php';

/* Cliente Model
*  Encarregado de acessar os dados do cliente no banco de dados.


id	int(10)	Não 	 	 
cliente_id	int(10)	Não 	 	 
endereco	varchar(100)	Sim 	NULL 	 
numero	int(10)	Sim 	NULL 	 
complemento	varchar(100)	Sim 	NULL 	 
referencia	text	Sim 	NULL 	 
bairro	varchar(50)	Sim 	NULL 	 
cidade	varchar(100)	Sim 	NULL 	 
estado	varchar(2)	Sim 	NULL 	 
cep	int(8)	Sim 	NULL 	 
tipo	enum('residencial', 'comercial', 'outro')	Sim 	NULL 	 


*/

class ClientesModel extends Model{
	
	function __construct()
    {
		$this->table  = 'fd_clientes';
        $this->col_id = 'id';
    }
	
	public function postParameters()
	{
		//Obrigatorios
		$data = array(
			  'nome'               => $_POST['nome']
			 ,'email'              => $_POST['email']
			 ,'senha'              => $_POST['senha'] 
			 ,'cpf'                => $_POST['cpf']
			 ,'genero'             => $_POST['genero']
			 ,'nascimento'         => $_POST['nascimento']
			 ,'telefone_principal' => $_POST['telefone_principal']
			 ,'email_cliente'      => $_POST['email_cliente']
			 ,'senha'              => $_POST['senha'] 
		  );

		  //Opcionais
		  if(isset($_POST['telefone_celular']))
			$data[] = array('telefone_celular'   => $_POST['telefone_celular']);
		  
		  if(isset($_POST['telefone_comercial']))
			$data[] = array('telefone_comercial' => $_POST['telefone_comercial']);
		  
		  if(isset($_POST['apelido_cliente']))
			$data[] = array('apelido_cliente'    => $_POST['apelido_cliente']);
		 
		  return $data;
	}

	public function getParameterID()
	{
		$id = NULL;

		if(isset($_POST['id']))
			$id = $_POST['id'];
		elseif(isset($_GET['id']))
			$id = $_GET['id'];
		
		return $id;
	}  

} 

?>