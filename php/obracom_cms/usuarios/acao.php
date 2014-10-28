<?php
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/helpers/messagem_helper.php");
include("../includes/models/usuarios_model.php");
include("../includes/helpers/variaveis_helper.php");

    $usuarios     = new UsuariosModel();
    $dadosUsuario = $_POST;
    $acao         = par_get('a');//isset($_GET["a"])? $_GET["a"] : -1; 
    
    switch ($acao) {
        case 1: // INSERT
            
            if($usuarios->insert($dadosUsuario))
            {
                MensagemHelper::insertSucesso();
            }
            else
                MensagemHelper::erro();
            
            break;

        case 2: // UPDATE
            
             $idusuario = $usuarios->getParameterID();

            if($usuarios->updateById($idusuario, $dadosUsuario))
            {
                MensagemHelper::updateSucesso();
            }
            else
                MensagemHelper::erro();

            break;

        case 3: // DELETE
            
            $idusuario = $usuarios->getParameterID();

            if($usuarios->deleteById($idusuario))
            {
                MensagemHelper::deleteSucesso();
            }
            else
                MensagemHelper::erro();

            break;
    }

    header('Location:listar.php'); 

?>