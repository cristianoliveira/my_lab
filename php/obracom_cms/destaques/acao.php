<?php
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/models/destaques_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/helpers/file_helper.php");

    $destaques         = new DestaquesModel();
    
    $acao            = Parameter::GET('a', 0); //isset($_GET["a"])? $_GET["a"] : -1; 
    $id              = Parameter::POST('id', false);
    $titulo          = Parameter::POST('titulo');
    $imagem          = Parameter::POST('imagem');

    switch ($acao) {
        case 1: // INSERT
            
               $nomeArquivoServidor = uniqid("destaque-");

               log_file('Fazendo upload...'.$imagem);
                
                if(FileHelper::base64ToJpg( $imagem
                                          , $_SERVER[DOCUMENT_ROOT].'/uploads/destaques/'.$nomeArquivoServidor.".jpg"))
                {
                    log_file('Upload feito.');
                    
                    if($destaques->insert(array( 'link'      => Parameter::POST('link')  
                                                    , 'imagem'    => $nomeArquivoServidor.".jpg"
                                                    , 'titulo'    => Parameter::POST('titulo')))){

                        MensagemHelper::sucesso("Upload realizado com sucesso.");
                    }else
                        MensagemHelper::erro("Erro ao salvar imagem no banco.");
                        

                }   
                
            break;

        case 2: // UPDATE
            
            if(!$id)
            {
                MensagemHelper::erro("Selecione um destaque.");
            }
            else
            {
               
               $nomeArquivoServidor = uniqid("destaque-");

               log_file('Fazendo upload...'.$imagem);
                
                if(FileHelper::base64ToJpg( $imagem
                                          , $_SERVER[DOCUMENT_ROOT].'/uploads/destaques/'.$nomeArquivoServidor.".jpg"))
                {
                    log_file('Upload feito.');
                    
                    if($destaques->updateById( $id
                                           , array( 'link'      => Parameter::POST('link')  
                                           , 'imagem'    => $nomeArquivoServidor.".jpg"
                                           , 'titulo'    => Parameter::POST('titulo')))){

                        MensagemHelper::sucesso("Upload realizado com sucesso.");
                    }else
                        MensagemHelper::erro("Erro ao salvar imagem no banco.");
                        

                }   
                
            }

            break;

        case 3: // DELETE
            $id = Parameter::GET('id');
            if($destaques->delete("id = $id"))
            {
                MensagemHelper::deleteSucesso();
            }
            else
                MensagemHelper::erro();
                            
            break;
    }

    header('Location:listar.php'); 

?>