<?php
 
//include "../previa/admin/includes/log.php";

 class SQLBuilder
 {
    
    private $_SELECT   = "SELECT %s";
    private $_UPDATE   = "UPDATE %s SET %s";
    private $_FROM     = "  FROM %s";
    private $_WHERE    = " WHERE %s";
    private $_JOIN     = "  JOIN %s ON (%s)";
    private $_AND      = "   AND %s ";
    private $_OR       = "    OR %s ";
    private $_GROUP_BY = " GROUP BY %s ";
    private $_ORDER_BY = " ORDER BY %s ";
    private $_LIMIT    = " LIMIT %s ";
    private $_INSERT   = " INSERT INTO %s (%s) VALUES (%s)";
    private $_DELETE   = " DELETE FROM %s %s";

    private $select  = "";
    private $from    = "";
    private $where   = "";
    private $limit   = "";
    private $groupBy = "";
    private $orderBy = "";
    private $insert  = '';
    private $update  = '';
   
    public function select($string)
    {
        $this->select = sprintf($this->_SELECT, $string);
        return $this;
    }

    public function update($table, $columns_values = array(), $where='')
    {
        $sets = '';
        foreach ($columns_values as $col => $val) {
            if (is_string($val))
            {
                $sets .= sprintf("%s = '%s',", $col, $val);
            }
            else 
                if (is_bool($val))
                {
                    $val   = $val?1:0;
                    $sets .= sprintf("%s = '%s',", $col, $val);
                }
                else
                {
                    $sets .= sprintf("%s = %s ,", $col, $val);
                }
        }

        $this->update = sprintf($this->_UPDATE, $table, substr($sets, 0,strlen($sets)-1));

        if (!empty($where)) {
            $this->update .= " WHERE ".$where;
        }

        return $this;
    }

     public function from($string)
     {
        $this->from  = sprintf($this->_FROM, $string);
         return $this;
     }

    public function join($table, $condicao)
    {
        $this->from  .= sprintf($this->_JOIN, $table, $condicao);
        return $this;
    }

     public function where($where)
     {
        $string = '';
        
         
        if(!empty($where))
        {
            if(is_array($where))
            {   
                foreach ($where as $key => $value) 
                {
                    $string .= $value; 
                }
            }
            else
                $string = $where;

           $this->where = sprintf($this->_WHERE, $string); 
        }
        return $this;
     }

    public function _and($string)
    {
        $this->where .= sprintf($this->_AND, $string); 
        return $this;
    }

    public function _or($string)
    {
        $this->where .= sprintf($this->_OR, $string); 
        return $this;
    }

    public function groupBy($string)
    {
        $this->where = sprintf($this->_GROUP_BY, $string); 
        return $this;
    }

    public function orderBy($string)
    {
        $this->where = sprintf($this->_ORDER_BY, $string); 
        return $this;
    }

    public function limit($init=0, $end=0)
    {
        $this->limit = sprintf($this->_LIMIT, $init);
        
        if ($end >0)
            $this->limit = $this->limit. ", $end";
         
        return $this;
    }

    //Insert
    public function insert($table, $values = array())
    {

        $insertCol = '';
        $insertVal = '';
        
        foreach ($values as $key => $value) {

            $insertCol .= ",$key";

            if (is_string($value))
                $insertVal .= ",'$value'";
            else
                $insertVal .= ",$value";
        }

        if(!empty($insertCol) and !empty($insertVal))
            $this->insert = sprintf($this->_INSERT
                                   , $table
                                   , substr($insertCol, 1)
                                   , substr($insertVal, 1)
                                   );
        return $this;
    }

    public function delete($table, $where='')
    {
        $_where = '';

        if (!empty($where)) {
            $_where .= " WHERE ".$where;
        }

        $this->delete = sprintf($this->_DELETE, $table, $_where);
       
        return $this;
    }

    public function clean()
    {
        $this->select  =
           $this->from    =
           $this->where   =
           $this->groupBy =
           $this->orderBy =
           $this->update  =
           $this->delete  =
           $this->limit   =
           $this->insert  = '';
    }

    //@Override 
    public function __toString()
    {
        $return = '';
        if(!empty($this->select))
        {
            $return =  $this->select  .
                       $this->from    .
                       $this->where   .
                       $this->limit   .
                       $this->groupBy .
                       $this->orderBy;
        }
        if(!empty($this->update))
        {
            $return =  $this->update.$this->where;
        }
        if(!empty($this->insert))
        {
            $return =  $this->insert;    
        }
        if(!empty($this->delete))
        {
            $return =  $this->delete.$this->where;    
        }

        $this->clean();

        //log_file('SQL - '.$return);


        return $return.';';
    }

 }


?>