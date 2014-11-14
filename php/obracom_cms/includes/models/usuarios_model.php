<?php

include_once "model.php";
 
 class UsuariosModel extends Model{
 
    function __construct()
    {
        $this->table  = 'fd_usuarios';
        $this->col_id = 'id';
    }    
    
    private function trataDados($dados)
    {
        $dados['senha'] = sha1 ($dados['senha']);
        return $dados;
    }
    
    public function insert($dados = array())
    {
        $dados = $this->trataDados($dados);
        return parent::insert($dados);
    }

    public function updateById($id, $dados = array())
    {
        $dados = $this->trataDados($dados);
        return parent::updateById($id, $dados);
    }
    
    public function getFirst($dados = array())
    {        
        $dados = $this->trataDados($dados);
        
        $this->buildSql()->select('*')
                           ->from($this->table)
                          ->where(sprintf("usuario = '%s'", $dados['usuario']))
                           ->_and(sprintf("senha   = '%s'", $dados['senha']));
        $exist = $this->get_first();
        return $exist;
    }
 }
 
?>