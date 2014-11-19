<?php
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/models/clientes_model.php");
include("../includes/models/clientes_enderecos_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");


    $clientes          = new ClientesModel();
    $dadosCliente      = $clientes->postParameters(Parameter::POST());
    
    $redirectToEndereco = Parameter::GET('endereco', false) == 1; 
    $acao               = Parameter::GET('a', 0); //isset($_GET["a"])? $_GET["a"] : -1; 
    
    $idcliente          = $clientes->getParameterID();
    
    if(isset($dadosCliente['nascimento']))
        $dadosCliente['nascimento'] = date("Y-m-d", strtotime(str_replace('/', '-', $dadosCliente['nascimento'])));
            
    switch ($acao) {
        case Acao::INSERT: // INSERT
            
            if($clientes->insert($dadosCliente))
            {
                $idcliente = $clientes->getLastId();
                MensagemHelper::insertSucesso();
            }
            else
                MensagemHelper::erro();
            
            break;

        case Acao::UPDATE: // UPDATE
            
            if($clientes->update($dadosCliente, "id = $idcliente"))
            {
                MensagemHelper::updateSucesso();
            }
            else
                MensagemHelper::erro();

            break;

        case Acao::DELETE: // DELETE
            
            if($clientes->delete("id = $idcliente"))
            {
                MensagemHelper::deleteSucesso();
            }
            else
                MensagemHelper::erro();
                            
            break;

        case 4: // EDIT ENDERECO
            
            $enderecoCliente  = new ClientesEnderecosModel();
            $dadosEndereco    = Parameter::POST();

            if($enderecoCliente->save($dadosEndereco))
            {
                MensagemHelper::updateSucesso();
            }
            else
                MensagemHelper::erro();
                            
            break;
    }
    
    if($redirectToEndereco || $acao == 1)
    {
        header("Location:editar.php?id=$idcliente&endereco=1");
    }
    else
    {
        header('Location:listar.php'); 
    }

?>