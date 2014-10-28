<?php
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/models/clientes_model.php");
include("../includes/helpers/messagem_helper.php");


    $clientes     = new ClientesModel();
    $dadosCliente = $_POST;
    $acao         = isset($_GET["a"])? $_GET["a"] : -1; 
    $idcliente    = $clientes->getParameterID();

            
    switch ($acao) {
        case 1: // INSERT
            
            if($clientes->insert($dadosCliente))
            {
                MensagemHelper::insertSucesso();
            }
            else
                MensagemHelper::erro();
            
            break;

        case 2: // UPDATE
            
            if($clientes->update($dadosCliente, "idcliente = $idcliente"))
            {
                MensagemHelper::updateSucesso();
            }
            else
                MensageHelper::erro();

            break;

        case 3: // DELETE
            
            if($clientes->delete("idcliente = $idcliente"))
            {
                MensagemHelper::deleteSucesso();
            }
            else
                MensageHelper::erro();
                            
            break;
    }

    header('Location:listar.php'); 

?>