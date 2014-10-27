<?php
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../models/clientes_model.php");

    $clientes = new ClientesModel();

    $dadosCliente = $clientes->postParameters();

    $acao     = isset($_GET["a"])? $_GET["a"] : -1; 
    
    switch ($acao) {
        case 1: // INSERT
            
             error_log("ACAO INSERT");

            if($clientes->insert($dadosCliente))
            {
                 $_SESSION['ok']  = "Cadastro efetuado com sucesso!";
                 $mensagem        = "[Usuario: ". $_SESSION['nome_usuario'] ."] Cadastrou um cliente.";
                 salvaLog($mensagem);
            }
            else
            {
                 $_SESSION['erro']  = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte.";
            }
            break;

        case 2: // UPDATE
            
             error_log("ACAO UPDATE");
             $idcliente = $clientes->getParameterID();

            if($clientes->update($dadosCliente, "idcliente = $idcliente"))
            {
                $mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou uma categoria...";
                salvaLog($mensagem);
                $_SESSION['ok'] = "Atualizado o registro com sucesso!";
            }
            break;

        case 3: // DELETE
            
            $idcliente = $clientes->getParameterID();

            if($clientes->delete("idcliente = $idcliente"))
            {
                $mensagem = "[Usuario: ". $_SESSION['nome_usuario'] ."] Atualizou uma categoria...";
                salvaLog($mensagem);
                $_SESSION['ok'] = "Removido o registro com sucesso!";
            }            
            break;
    }

    header('Location:listar.php'); 

?>