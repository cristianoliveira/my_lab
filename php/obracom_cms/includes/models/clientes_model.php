<?php

 include_once 'model.php';

/* Cliente Model
*  Encarregado de acessar os dados do cliente no banco de dados.
*    

TABLE SCHEMA:
create table clientes 
( 
   idcliente          INT(10)      NOT NULL AUTO_INCREMENT,
   nome_cliente       VARCHAR(200) NOT NULL COMMENT 'Nome completo',
   cpf                VARCHAR(30)  NOT NULL,
   genero             VARCHAR(1)   NOT NULL COMMENT '(M) Masculino / (F) Feminino',
   nascimento         DATE,
   telefone_principal VARCHAR(30),
   telefone_celular   VARCHAR(30),
   telefone_comercial VARCHAR(30),
   apelido_cliente    VARCHAR(200),
   email_cliente      VARCHAR(200),
   senha              VARCHAR(200),
   UNIQUE (idcliente),
   PRIMARY KEY (idcliente) 
) ENGINE = MYISAM;


*/

class ClientesModel extends Model{
	
	function __construct()
    {
		$this->table  = 'clientes';
        $this->col_id = 'idcliente';
    }
	
	public function postParameters()
	{
		//Obrigatorios
		$data = array(
			'nome_cliente'       => $_POST['nome_cliente']
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