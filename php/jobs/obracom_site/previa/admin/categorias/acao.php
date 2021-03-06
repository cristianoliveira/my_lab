<?php
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/models/categorias_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");

    $categorias     = new CategoriasModel();
    $dados          = $_POST;
    $acao           = par_get('a');//isset($_GET["a"])? $_GET["a"] : -1; 
    $id             = $categorias->getParameterID();
    
    switch ($acao) {
        // case Acao::INSERT: // INSERT
            
        //     if($categorias->insert($dados))
        //     {
        //         MensagemHelper::insertSucesso();
        //     }
        //     else
        //         MensagemHelper::erro();
            
        //     break;

        case Acao::UPDATE: // UPDATE
            

            if($categorias->updateById($id, $dados))
            {
                MensagemHelper::updateSucesso();
            }
            else
                MensagemHelper::erro();

            break;

        // case Acao::DELETE: // DELETE
            
        //     if($categorias->deleteById($id))
        //     {
        //         MensagemHelper::deleteSucesso();
        //     }
        //     else
        //         MensagemHelper::erro();

        //     break;
    }

    header('Location:listar.php'); 

?>