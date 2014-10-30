<?php

class MensagemHelper{
    
    public static function insertSucesso($mensagem = "Cadastro efetuado com sucesso!")
    {
        $_SESSION['ok']  = $mensagem;
    }

    public static function updateSucesso($mensagem = "Atualizado o registro com sucesso!")
    {
        $_SESSION['ok'] = $mensagem;
    } 

    public static function deleteSucesso($mensagem = "Removido o registro com sucesso!")
    {
        $_SESSION['ok'] = $mensagem;
    } 

    public static function sucesso($mensagem = '')
    {
        if(empty($mensagem))
           $_SESSION['ok']  = "Processo realizado com sucesso.";
        else
           $_SESSION['ok']  = $mensagem;
    }

    public static function erro($mensagem = '')
    {
        if(empty($mensagem))
           $_SESSION['erro']  = "Ops! Desculpe-nos. Não foi possível salvar, tente novamente mais tarde ou contate o suporte.";
        else
           $_SESSION['erro']  = $mensagem;
    }

    public static function showSessionMensagem()
    {
        if(isset($_SESSION['erro']) && !empty($_SESSION['erro'])) { 
            echo "<div id='errado' 
                       class='notification error png_bg'>
                       <a href='#' 
                          class='close'>
                           <img src='../imagens/icones/cross_grey_small.png' 
                                title='Fechar esta notificação' 
                                alt='fechar' />
                       </a>
                   <div> ".$_SESSION['erro']." </div> </div>";    
            $_SESSION['erro']=""; 
        } 
            
        if(isset($_SESSION['ok']) && !empty($_SESSION['ok'])) { 
            echo "<div class='notification success png_bg'>
                     <a class='close' 
                        href='#'>
                        <img alt='fechar' 
                             title='Fechar esta notificação' 
                             src='../imagens/icones/cross_grey_small.png'/>
                     </a>
                     <div> 
                        <strong> ".$_SESSION['ok']."</strong>
                     </div>
                </div>";
            $_SESSION['ok']=""; 
        } 
    }
    
}

?>