<?php
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/models/clientes_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");


    $clientes     = new ClientesModel();
    $dadosCliente = $clientes->postParameters(Parameter::POST());
	
    $acao         = Parameter::GET('a', 0); //isset($_GET["a"])? $_GET["a"] : -1; 
    $idcliente    = $clientes->getParameterID();
	
	log_file(" cliente ID = $idcliente");
            
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
            
            if($clientes->update($dadosCliente, "id = $idcliente"))
            {
                MensagemHelper::updateSucesso();
            }
            else
                MensagemHelper::erro();

            break;

        case 3: // DELETE
            
            if($clientes->delete("id = $idcliente"))
            {
                MensagemHelper::deleteSucesso();
            }
            else
                MensagemHelper::erro();
                            
            break;
    }

    header('Location:listar.php'); 

?>