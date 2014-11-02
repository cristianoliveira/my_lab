<?php
require_once(dirname(__FILE__).'/sqlbuilder.php');


class Model{
    
    public  $sqlBuilder;
	public  $table;
	public  $col_id = 'id';
    private $conexao  = null;
    private $database = null;
    
    private function getConexao()
    {
        require($_SERVER['DOCUMENT_ROOT']."/includes/database_config.php");
        if($this->conexao == null || !mysqli_ping($this->conexao))
        {
            $this->conexao   = mysqli_connect($db_host, $db_user, $db_pass, $db_database_name);
        }
        return $this->conexao;
    }

    public function buildSql()
    {
        $this->sqlBuilder = new SQLBuilder();
        return $this->sqlBuilder;
    }

    public function get_rows()
    {
        $return = array();
        $sql = mysqli_query($this->getConexao(), $this->sqlBuilder) or die("Erro ao afetuar tentar acessar o banco de dados");

        while($row = mysqli_fetch_array($sql))
              $return[] = $row;

        return $return;
    }

    public function get_first()
    {
        $sql    = mysqli_query($this->getConexao(), $this->sqlBuilder) or die("Erro ao afetuar tentar acessar o banco de dados");
        return mysqli_fetch_array($sql);
    }

    public function get_rows_by_query($query)
    {
        $return = array();
        $sql = mysqli_query(getConexao(), $query) or die("Erro ao afetuar tentar acessar o banco de dados");

        while($row = mysqli_fetch_array($sql))
              $return[] = $row;

         error_log(mysqli_error($this->getConexao()));

        return $return;
    }
    
    public function execute_insert()
    {
        $result = mysqli_query($this->getConexao(),$this->sqlBuilder);

        if ($result) {
            //Não sei se é utilizado em outro lugar
			$id_grupo = mysqli_insert_id($this->getConexao());
            $_SESSION['uidc'] = $id_grupo;
			
			$this->setLastId();
			
            return true;
        } else {
            return false;
        }
    }

    public function execute_update()
    {
        $result = mysqli_query($this->sqlBuilder);

        if ($result) {
		    //Não sei se é utilizado em outro lugar
            $id_grupo = mysqli_insert_id($this->getConexao());
            $_SESSION['uidc'] = $id_grupo;
			
			$this->setLastId();
			
            return true;
        } else {
            error_log(mysqli_error($this->getConexao()));
            return false;
        }
    }

    public function execute()
    {
        $result = mysqli_query($this->getConexao(),$this->sqlBuilder);
        if ($result) {
            $this->setLastId();
			return true;
        } else {
            error_log(mysqli_error($this->getConexao()));
            return false;
        }
    }

    public function execute_sql($sql)
    {
        $result = mysqli_query($this->getConexao(), $sql);
        if ($result) {
            return true;
        } else {
            error_log(mysqli_error($this->getConexao()));
            return false;
        }
    }

    public function get_count()
    {
        $sql_conta = mysqli_query($this->getConexao(), $this->sqlBuilder);        
        $quantreg  = mysqli_num_rows($sql_conta);
        return  $quantreg;
    }

    public function getParameterId()
    {
        return isset($_GET['id'])? $_GET['id'] : 0;
    }

	public function getAll()
	{
	    $this->buildSql()->select('*')->from($this->table);
		return $this->get_rows();
	}
	
	public function getLimit($ini, $end = 0, $orderBy = "")
	{
	    $builder =  $this->buildSql()
                         ->select('*')
		                 ->from($this->table)
						 ->limit($ini, $end);

        if(!empty($orderBy))
            $builder->orderBy($orderBy);
           
		return $this->get_rows();
	}
	
	public function getById($id)
	{
		if(!isset($id))
		    return false;
			
	    $this->buildSql()->select('*')
		                 ->from($this->table)
						 ->where($this->col_id." = $id");
		return $this->get_first();
	}
	
	public function getWhere($where)
    {
        $this->buildSql()->select("*")
                           ->from($this->table)
                          ->where($where);

        return $this->get_rows();
    }
	
	public function getCount()
	{
		$sql = $this->buildSql()->select('1')
		                        ->from($this->table);
		
		$sql_conta = mysqli_query($this->getConexao(), $sql);        
        $quantreg  = mysqli_num_rows($sql_conta);
		return $quantreg;
	}
	
	public function insert($dados = array())
    {
        $this->buildSql()->insert($this->table, $dados);
        return $this->execute_insert();
    }

    public function update($dados = array(), $where='')
    {
		if(isset($dados[$this->col_id])){
		   unset($dados[$this->col_id]);
		}
		
        $this->buildSql()->update($this->table, $dados)
                         ->where($where);
        return $this->execute_insert();
    }
	
	public function updateById($id, $dados = array())
    {
			
        if(isset($dados[$this->col_id])){
		   unset($dados[$this->col_id]);
		}
		
        $this->buildSql()->update($this->table, $dados)
                          ->where($this->col_id." = $id");
						  
        return $this->execute_insert();
    }
	
	public function delete($where='')
	{
		$this->buildSql()->delete($this->table, $where);
        return $this->execute();
	}
	
	public function deleteById($id){
		
        $this->buildSql()->delete($this->table, $this->col_id." = $id");
        return $this->execute();
	}

	public function setLastId()
	{
		try{
			$last_id = mysqli_insert_id($this->getConexao());
			$_SESSION['last_id'] = $last_id;
		}catch(Exception $ex)
		{
			$_SESSION['last_id'] = "";
		}
	}
	
	public function getLastId()
	{
		return mysqli_insert_id($this->getConexao());
	}
	
}

?>