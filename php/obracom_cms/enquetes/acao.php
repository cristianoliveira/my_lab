<?php
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/models/enquetes_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");


    $enquetes       = new EnquetesModel();
    $dados          = Parameter::POST();
	$dados['ativo'] = isset($dados['ativo'])?0:1;
    $idenquete      = Parameter::GET('id');
	
    $acao         = Parameter::GET('a', 0); //isset($_GET["a"])? $_GET["a"] : -1; 
	
	log_file(" enquete ID = $idenquete");
            
    switch ($acao) {
        case 1: // INSERT
            
            if($enquetes->insert($dados))
            {
                MensagemHelper::insertSucesso();
            }
            else
                MensagemHelper::erro();
            
            break;

        case 2: // UPDATE
            
            if($enquetes->updateById($dados['id'], $dados))
            {
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