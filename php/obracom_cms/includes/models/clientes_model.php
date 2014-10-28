<?php

 include_once 'model.php';

/* 
*	Cliente Model
*  	Encarregado de acessar os dados do cliente no banco de dados.
*
*/

class ClientesModel extends Model{
	
	function __construct()
    {
		$this->table  = 'fd_clientes';
        $this->col_id = 'id';
    }
	
	public function postParameters($dados)
	{
		//Obrigatorios
		foreach($dados  as $key => $val)
		{
			if(empty($dados[$key]))
			    unset($dados[$key]);
			else
			{
				if(substr($key,0,3) == 'ddd')
				{	
					$key_tel = substr($key,4);
					$ddd     = $dados[$key];
					$dados[$key_tel] = $ddd . $dados[$key_tel];
					unset($dados[$key]);
				}
			}
		}
		
		unset($dados['pessoa_tipo']);
		
		if(isset($dados['senha']))
			if($dados['senha']!=$dados['confirma_senha'])
				return null;
			else
				unset($dados['confirma_senha']);
		
		unset($dados['id']);
		
		return $dados;
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