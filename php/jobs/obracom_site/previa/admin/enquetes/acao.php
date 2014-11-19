<?php
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/models/enquetes_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/models/opcoes_enquete_model.php");

    $enquetes       = new EnquetesModel();
    $opcoesEnquete  = new OpcoesEnqueteModel();

    $dados          = Parameter::POST();
	$dados['ativa'] = Parameter::POST('ativa',0);
    $opcoes         = $dados['opcao'];
    
    unset($dados['opcao']);
    
    $idenquete      = Parameter::GET('id');
    $acao           = Parameter::GET('a', 0); //isset($_GET["a"])? $_GET["a"] : -1; 
	
	log_file(" enquete ID = $idenquete");
            
    switch ($acao) {
        case 1: // INSERT
            
            $opcoes  = Parameter::POST('opcao', null);
    
            if($enquetes->insert($dados))
            {
                $newEnqueteId = $enquetes->getLastId();
                
                if($opcoes!=null)
                {
                    foreach ($opcoes as $opcao) {
                        print_r($opcao);
                        if(!$opcoesEnquete->insert(array( 'enquete_id'=>$newEnqueteId
                                                        , 'opcao'     =>$opcao['opcao']
                                                        , 'votos'     => 0            )))
                        {
                            MensagemHelper::erro('Erro ao gravar opicao '.$opcao);
                        }
                    }
                }

                MensagemHelper::insertSucesso();
            }
            else
                MensagemHelper::erro();
            
            break;

        case 2: // UPDATE
            
            if($enquetes->updateById($dados['id'], $dados))
            {
                if($opcoesEnquete->updateOpcoesEnquete($dados['id'], $opcoes))
                    MensagemHelper::updateSucesso();
            }
            else
                MensagemHelper::erro();

            break;

        case 3: // DELETE
            
            if($enquetes->deleteById($idenquete))
            {
                MensagemHelper::deleteSucesso();
            }
            else
                MensagemHelper::erro();
                            
            break;
        
    }

    header('Location:listar.php'); 

?>