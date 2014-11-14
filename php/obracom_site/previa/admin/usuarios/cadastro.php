<?php  
include("../includes/cabecalho.php"); 

include("../includes/helpers/variaveis_helper.php"); 
include('../includes/check_authentication.php');

    $usuarios_tab = $usuarios_adicionar = "current";
?>

<body class="destaques formulario">

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Cadastro de Usuário</h2>

            <p id="page-intro">Utilize o formulário abaixo para incluir um usuário.</p>

            <div class="content-box"><!-- Start Content Box -->

                <div class="content-box-header">
                    <h3>Dados do Usuário</h3>
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->

                <div class="content-box-content">
                    <?php 
                         $acao        = "Cadastrar";
                         $action_form = "acao.php?a=1";
                         include('_form.php'); 
                     ?>
                </div> <!-- End .content-box-content -->
            </div> <!-- End .content-box -->
            <div id="footer">
                <small> <!-- Remove this notice or replace it with whatever you want -->
                    © Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
                </small>
            </div><!-- End #footer -->
            
        </div> <!-- End #main-content -->
        
    </div></body>

    </html>
