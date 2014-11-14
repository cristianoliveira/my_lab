<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/logs.php");

include("../includes/models/produtos_model.php");
include("../includes/models/categorias_model.php");
include("../includes/models/produtos_cores_model.php");
include("../includes/models/produtos_imagens_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");


    $produtos       = new ProdutosModel();
    $categorias     = new CategoriasModel();
    $coresProduto   = new ProdutosCoresModel();
    
    $produto   = $produtos->getById($_GET['id']);

    if(empty($produto))
        header('Location:listar.php');

    $listCategorias    = $categorias->getAll(); 
    $listCores         = $coresProduto->getCoresByProdutoId($produto['id']); 
    
    $galeria           = Parameter::GET('galeria', 0) == 1; 
    
    if($galeria)
    {
        $idProduto      = Parameter::GET('id'); 
        $imagensProduto = new ProdutosImagensModel();
        $listImagens    = $imagensProduto->getImagensFromProduto($idProduto);
    }

    $produtos_tab      = $produtos_tab_gerenciar = "current";

?>

<script type="text/javascript" src="../js/jscolor/jscolor.js"></script>

<body class="destaques formulario">

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Editar um Produto</h2>

            <p id="page-intro">Utilize o formulário abaixo para editar um produto no site.</p>
            
            <?php  MensagemHelper::showSessionMensagem(); ?>

            <div class="content-box"><!-- Start Content Box -->

                <div class="content-box-header">
                <?php if(!$galeria) { ?>
                          <h3>Dados de um Produto</h3>
                <?php } else { ?>
                          <h3>Imagens do Produto</h3>
                <?php } ?>
                
                <div class="clear"></div>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">

                <?php 
                     
                     if(!$galeria)
                     {
                         $action_form = "acao.php?a=2&id=".$_GET['id'];
                         $acao        = "Atualizar";
                         include('_form.php'); 
                     }
                     else
                     {
                        $action_form = "acao.php?a=4";
                        include('_form_galeria.php'); 
                     }

                ?>

                </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->


        <div id="footer">
            <small> <!-- Remove this notice or replace it with whatever you want -->
                &#169; Copyright 2012 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
            </small>
        </div><!-- End #footer -->

    </div> <!-- End #main-content -->

</div></body>

</html>
