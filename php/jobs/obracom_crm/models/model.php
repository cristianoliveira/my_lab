<?php
include('../models/SQLBuilder.php');
include("../includes/database_connection.php");

class Model{
    
    public $sqlBuilder;
	public $table;
	public $col_id = 'id';

    function __construct()
    {
        $this->sqlBuilder = new SQLBuilder();
    }

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
	    $this->sqlBuilder->select('*')->from($this->table);
		return $this->get_rows();
	}
	
	public function getLimit($ini, $end = 0)
	{
	    $this->sqlBuilder->select('*')
		                 ->from($this->table)
						 ->limit($ini, $end);
		return $this->get_rows();
	}
	
	public function getById($id)
	{
	    $this->sqlBuilder->select('*')
		                 ->from($this->table)
						 ->where($this->col_id." = $id");
		return $this->get_first();
	}
	
	public function getCount()
	{
		$this->sqlBuilder->select('1')
		                 ->from($this->table);
		$sql_conta = mysql_query($this->sqlBuilder);        
        $quantreg  = mysql_num_rows($sql_conta);
		return $quantreg;
	}
	
	public function doInsert($dadosCliente = array())
    {
        $this->sqlBuilder->insert($this->table, $dadosCliente);
        return $this->execute_insert();
    }

    public function doUpdate($dadosCliente = array(), $where='')
    {
        $this->sqlBuilder->update($this->table, $dadosCliente)
                         ->where($where);
        return $this->execute_insert();
    }

	public function doDelete($where)
	{
		$this->sqlBuilder->delete($this->table, $where);
        return $this->execute();
	}
	
}

?>