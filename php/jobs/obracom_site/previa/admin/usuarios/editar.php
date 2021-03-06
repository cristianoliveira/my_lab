<?php  
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include_once("../includes/helpers/variaveis_helper.php");
include_once("../includes/models/usuarios_model.php");

include("../includes/cabecalho.php"); 

    $usuarios  = new UsuariosModel();
    $idusuario = par_get("id");
    $usuario   = $usuarios->getById($idusuario);

    if(empty($usuario))
        header('Location:listar.php?p=8&g=2');
	
    $usuarios_tab = $usuarios_gerenciar = "current";

?>
<body class="destaques formulario">

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Editar um Usuário</h2>
            
            <p id="page-intro">Utilize o formulário abaixo para editar o usuário.</p>
            
            <?php showSessionMessage(); ?>
            
            <div class="content-box"><!-- Start Content Box -->

                <div class="content-box-header">

                    <h3>Dados do Usuário.</h3>
                    <div class="clear"></div>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">

                    <?php 
                         $acao        = "Atualizar";
                         $action_form = "acao.php?a=2&id=".$idusuario;
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
