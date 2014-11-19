<?php

 include_once 'model.php';

/* 
*    Clientes Enderecos Model
*
*/

class ClientesEnderecosModel extends Model{
    
    function __construct()
    {
        $this->table  = 'fd_clientes_enderecos';
        $this->col_id = 'id';
    }

    public function getEnderecoByClienteId($clienteId)
    {
        $this->buildSql()->select("*")
                         ->from($this->table)
                         ->where("cliente_id = $clienteId");

        return $this->get_first();
    }

    public function existEnderecoForClienteId(  $clienteId)
    {
    	$this->buildSql()->select("1")
                         ->from($this->table)
                         ->where("cliente_id = $clienteId");

        $registros = $this->get_count();

        return $registros == 0;
    }

    public function save($dadosEndereco)
    {
        $cep = $dadosEndereco['cep'];
        $dadosEndereco['cep']= $cep['prefix'].$cep['sufix'];
        
        if(isset($dadosEndereco['id']))
        {
            return $this->updateById($dadosEndereco['id'], $dadosEndereco);   
        }
        else
        {
            return $this->insert($dadosEndereco);   
        }
    }

}

?>