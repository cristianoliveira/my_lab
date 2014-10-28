<?php
include('../includes/models/SQLBuilder.php');
include("../includes/database_connection.php");

class Model{
    
    public $sqlBuilder;
	public $table;
	public $col_id = 'id';

    public function buildSql()
    {
        $this->sqlBuilder = new SQLBuilder();
        return $this->sqlBuilder;
    }

    public function get_rows()
    {
        $return = array();
        $sql = mysql_query($this->sqlBuilder) or die("Erro ao afetuar tentar acessar o banco de dados");

        while($row = mysql_fetch_array($sql))
              $return[] = $row;

        return $return;
    }

    public function get_first()
    {
        $return = array();
        $sql    = mysql_query($this->sqlBuilder) or die("Erro ao afetuar tentar acessar o banco de dados");
        return mysql_fetch_array($sql);
    }

    public function get_rows_by_query($query)
    {
        $return = array();
        $sql = mysql_query($query) or die("Erro ao afetuar tentar acessar o banco de dados");

        while($row = mysql_fetch_array($sql))
              $return[] = $row;

         error_log(mysql_error($conexao));

        return $return;
    }
    
    public function execute_insert()
    {
        $result = mysql_query($this->sqlBuilder);

        if ($result) {
            $id_grupo = mysql_insert_id();
            $_SESSION['uidc'] = $id_grupo;
            return true;
        } else {
            return false;
        }
    }

    public function execute_update()
    {
        $result = mysql_query($this->sqlBuilder);

        if ($result) {
            $id_grupo = mysql_insert_id();
            $_SESSION['uidc'] = $id_grupo;
            return true;
        } else {
            error_log(mysql_error($conexao));
            return false;
        }
    }

    public function execute()
    {
        $result = mysql_query($this->sqlBuilder);
        if ($result) {
            return true;
        } else {
            error_log(mysql_error($conexao));
            return false;
        }
    }

    public function execute_sql($sql)
    {
        $result = mysql_query($sql);
        if ($result) {
            return true;
        } else {
            error_log(mysql_error($conexao));
            return false;
        }
    }

    public function get_count()
    {
        $sql_conta = mysql_query($this->sqlBuilder);        
        $quantreg  = mysql_num_rows($sql_conta);
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
	
	public function getLimit($ini, $end = 0)
	{
	    $this->buildSql()->select('*')
		                 ->from($this->table)
						 ->limit($ini, $end);
		return $this->get_rows();
	}
	
	public function getById($id)
	{
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
		
		$sql_conta = mysql_query($sql);        
        $quantreg  = mysql_num_rows($sql_conta);
		return $quantreg;
	}
	
	public function insert($dadosCliente = array())
    {
        $this->buildSql()->insert($this->table, $dadosCliente);
        return $this->execute_insert();
    }

    public function update($dadosCliente = array(), $where='')
    {
        $this->buildSql()->update($this->table, $dadosCliente)
                         ->where($where);
        return $this->execute_insert();
    }

	public function delete($where)
	{
		$this->buildSql()->delete($this->table, $where);
        return $this->execute();
	}
	
}

?>