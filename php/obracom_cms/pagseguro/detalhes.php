<?php  
include("../includes/cabecalho.php");
include("../includes/check_authentication.php");
include("../includes/functions.php");
include("../includes/logs.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/models/pagseguro_model.php");

$pagseguro   = new PagSeguroModel();
$codigo      = Parameter::GET('codigo', 0);

if($codigo!=0)
{
    try {
         $transacao = $pagseguro->getTransacao($codigo);
    } catch (Exception $e) {
         $transacao = null;
    }
}
        
$pagseguro_tab = $pagseguro_gerenciar = "current";

?>
<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
            <h2>Detalhamento da Transação</h2>
            
            <?php showSessionMessage(); ?>
            
        <div class="content-box"><!-- Start Content Box -->

        <div class="content-box-header">
            <h3>Dados da Transação</h3>
                
                <div class="clear"></div>
                <a class="produto button botao-cadastrar" href="../pagseguro/listar.php">
                    Voltar
                </a>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
                
               <div id="content-transacao">
                    <?php if(isset($transacao)){ ?>
                    <table id="pagseguro-dados-transacao" class="pagseguro-dados">
                        <thead><h3>Detalhes da Transação</h3> </thead>
                        <tr>
                            <td><h5>Código</h5></td>
                            <td><?= $transacao->getCode() ?></td>
                        </tr>
                        <tr>
                            <td><h5>Status</h5></td>
                            <td><?= $pagseguro->STATUS_TRANSACAO[$transacao->getStatus()->getValue()] ?></td>
                        </tr>
                        <tr>
                            <td><h5>Referência</h5></td>
                            <td><?= $transacao->getReference() ?></td>
                        </tr>
                    </table>
                    <?php  if ($transacao->getSender()) { ?>
                    <table id="pagseguro-dados-cliente" class="pagseguro-dados">
                        <thead> <h3>Dados do Cliente </h3></thead>
                        <tr>
                            <td><h5>Nome</h5></td>
                            <td> <?= $transacao->getSender()->getName() ?></td>
                        </tr>
                        <tr>
                            <td><h5>Email</h5></td>
                            <td><?= $transacao->getSender()->getEmail() ?></td>
                        </tr>
                        <tr>
                            <td><h5>Telefone</h5></td>
                            <td>
                               <?php if ($transacao->getSender()->getPhone()) { 
                                   echo  $transacao->getSender()->getPhone()->getAreaCode() . " - " .
                                                $transacao->getSender()->getPhone()->getNumber();
                                } ?>
                            </td>
                        </tr>
                    </table>
                    <?php   } ?>
                    <?php  if ($transacao->getItems()) { ?>
                    <table id="pagseguro-dados-cliente" class="pagseguro-dados">
                        <thead> <h3>Dados da Compra </h3></thead>
                        <?php if (is_array($transacao->getItems()))
                                 foreach ($transacao->getItems() as $key => $item) {
                            ?>
                        <tr>
                            <td><h5>Descrição</h5></td>
                            <td> <?= $item->getDescription() ?></td>
                        </tr>
                        <tr>
                            <td><h5>Quantidade</h5></td>
                            <td><?= $item->getQuantity() ?></td>
                        </tr>
                        <tr>
                            <td><h5>Valor</h5></td>
                            <td><?= $item->getAmount() ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php   } ?>
                    <?php } else { ?>
                    <div> Nada foi encontrado com o código: <?= $codigo ?></div>
                    <?php } ?>
                    
               </div>

            </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->


            <div id="footer">
                <small> <!-- Remove this notice or replace it with whatever you want -->
                        &#169; Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
                </small>
            </div><!-- End #footer -->
            
        </div> <!-- End #main-content -->
        
    </div></body>
  
</html>
