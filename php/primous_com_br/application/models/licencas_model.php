<?php
class licencas_model extends CI_Model {
    
    CONST tabela = 'tlicencas_estetisys';
    
       function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    
    function getlicenca($chaveCliente)
    {   
                    $this->db->where(array("chave_cliente"=>$chaveCliente));
        $query   =  $this->db->get(self::tabela);
        $licenca =  $query->result();
        
        if(count($licenca)>0)
        {
           return json_encode($licenca[0]);
        }
        else
        {
           return null; 
        }
    }
    
    public function SolicitaTrial($chaveCliente)
    {
        if($this->ExisteChave($chaveCliente) == 0){
            $licenca = 
                    array("chave_cliente"=>$chaveCliente,
                          "data_cadastro"=>date("Y-m-d"),
                          "data_vencimento"=>date('Y-m-d', strtotime("+30 days")),
                          "serial"=>"1",
                          "nome_cliente"=>"Testar como trial",
                          "email_cliente"=>"sem email",
                          "tipo"  => 1,
                          "ativa" => 1);
            
            var_dump($licenca);
            $this->db->insert(self::tabela,$licenca);
        }
    }
            
    public function ExisteChave($chaveCliente)
    {   
                    $this->db->where("chave_cliente",$chaveCliente);
        $query   =  $this->db->get(self::tabela);
        $licenca =  $query->result();
        $valido  = 0;
        
        if(count($licenca)>0)
        {
           return 1;
        }else
        {
           return 0; 
        }
    }    
    
function getAll(){
      $query = $this->db->get(self::tabela);
      return $query->result();
      }

function existsUnico($object){
    
    if (!empty($object[0])){
        $result = $object[0];
    }else{
        $result = false;
    }
  return $result;
}

}
?>