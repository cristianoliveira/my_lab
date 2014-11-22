<?php  
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/models/clientes_model.php");
include("../includes/models/clientes_enderecos_model.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/helpers/mensagem_helper.php");

include("../includes/cabecalho.php"); 

//Pega Dados e Mostra-os.
$clientes   = new ClientesModel();
$enderecos  = new ClientesEnderecosModel();

$idcliente    = Parameter::REQUEST('id'  ,0);
$endereco     = Parameter::GET('endereco', false);

$cliente   = $clientes->getById($idcliente);

if(empty($cliente))
   header('Location:listar.php');

$cliente['nascimento'] =  date("d/m/Y", strtotime($cliente['nascimento']));

        
$clientes_tab = $clientes_gerenciar = "current";

?>
<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
            <h2>Editar cliente</h2>
            
            <p id="page-intro">Utilize o formulário abaixo para editar uma categoria no site.</p>
            
            <?php showSessionMessage(); ?>
            
        <div class="content-box"><!-- Start Content Box -->

        <div class="content-box-header">
        <?php if(!$endereco){ ?>
            <h3>Dados Cliente</h3>
        <?php }else{ ?>
            <h3>Endereço do Cliente</h3>
        <?php } ?>
                <div class="clear"></div>
        </div> <!-- End .content-box-header -->

            <div class="content-box-content">
                
                <?php 
                    if(!$endereco)
                    {
                        $form_action = "acao.php?a=2&endereco=1";
                        include "_form.php";
                    }else
                    {
                        $endereco_cliente = $enderecos->getEnderecoByClienteId($idcliente);
                        $endereco_cliente['cliente_id'] = $idcliente;
                        $form_action = "acao.php?a=4";
                        include "_form_endereco.php";
                    }
                ?>

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
