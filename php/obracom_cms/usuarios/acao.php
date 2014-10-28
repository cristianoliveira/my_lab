<?php
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/helpers/messagem_helper.php");
include("../includes/models/usuarios_model.php");

    $usuarios     = new UsuariosModel();
    $dadosUsuario = $_POST;
    $acao         = isset($_GET["a"])? $_GET["a"] : -1; 
    
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

            if($usuarios->update($dadosUsuario, "idusuario = $idusuario"))
            {
                MensagemHelper::updateSucesso();
            }
            else
                MensagemHelper::erro();

            break;

        case 3: // DELETE
            
            $idusuario = $usuarios->getParameterID();

            if($usuarios->delete("idusuario = $idusuario"))
            {
                MensagemHelper::deleteSucesso();
            }
            else
                MensagemHelper::erro();

            break;
    }

    header('Location:listar.php'); 

?>