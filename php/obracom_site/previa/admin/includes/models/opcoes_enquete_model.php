<?php

 include_once 'model.php';

class OpcoesEnqueteModel extends Model{
	
	function __construct()
    {
		$this->table  = 'fd_enquetes_opcoes';
        $this->col_id = 'id';
    }


    public function getByEnqueteId($id)
    {
    	return $this->getWhere("enquete_id = $id");
    }

    public function updateOpcoesEnquete($id, $opcoes = array())
    {
        if($opcoes!=null)
        {
            foreach ($opcoes as $opcao) {

                if(!$this->updateById(if_exist($opcao['id'],0), $opcao))
                if(!$this->insert(array( 'enquete_id'=>$id
                                       , 'opcao'     =>$opcao['opcao']
                                       , 'votos'     => 0           )))
                {
                    MensagemHelper::erro('Erro ao gravar opicao '.$opcao);
                    return false;
                }
            }
        }
        return true;
    }
} 

?>