<?php
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/models/empresas_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");

    echo "aa";
    $acao         = Parameter::GET('a', 0); //isset($_GET["a"])? $_GET["a"] : -1; 
    
    $empresas     = new EmpresasModel();
    $dadosempresa = Parameter::POST();
    $idempresa    = Parameter::POST('id');
    
    switch ($acao) {
        // case 1: // INSERT
            
        //     if($empresas->insert($dadosempresa))
        //     {
        //         MensagemHelper::insertSucesso();
        //     }
        //     else
        //         MensagemHelper::erro();
            
        //     break;

        case 2: // UPDATE
            
            if($empresas->updateById($idempresa, $dadosempresa))
            {
                MensagemHelper::updateSucesso();
            }
            else
                MensagemHelper::erro();

            break;

        // case 3: // DELETE
            
        //     if($empresas->delete("id = $idempresa"))
        //     {
        //         MensagemHelper::deleteSucesso();
        //     }
        //     else
        //         MensagemHelper::erro();
                            
        //     break;
    }

    header('Location:listar.php'); 

?>