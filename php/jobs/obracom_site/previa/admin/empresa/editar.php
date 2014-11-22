<?php  
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/models/empresas_model.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/helpers/mensagem_helper.php");

include("../includes/cabecalho.php"); 

//Pega Dados e Mostra-os.
$empresas  = new empresasModel();

$idempresa = $empresas->getParameterId();
$empresa   = $empresas->getById($idempresa);

if(empty($empresa))
   header('Location:listar.php');
        
$empresas_tab = $empresas_gerenciar = "current";

?>
<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
            <h2>Editar empresa</h2>
            
            <p id="page-intro">Utilize o formulário abaixo para editar uma categoria no site.</p>
            
            <?php showSessionMessage(); ?>
            
        <div class="content-box"><!-- Start Content Box -->

        <div class="content-box-header">
            <h3>Dados empresa</h3>
                
                <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
                
                <?php 
                    $acao        = "Atualizar";
                    $form_action = "acao.php?a=2";
                    include "_form.php";
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
