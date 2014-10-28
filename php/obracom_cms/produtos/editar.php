<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/logs.php");

include("../includes/models/produtos_model.php");
include("../includes/models/categorias_model.php");
include("../includes/models/subcategorias_model.php");
include("../includes/helpers/mensagem_helper.php");


	$produtos       = new ProdutosModel();
	$categorias     = new CategoriasModel();
    $subcategorias  = new SubcategoriasModel();

    $listProdutos   = $produtos->getById($_GET['id']);

    if(empty($listProdutos))
    	header('Location:listar.php');

    $listCategorias    = $categorias->getAll(); 
    $listSubCategorias = $subcategorias->getAll();
    
$_COOKIE["produtos"] = "current";
$_COOKIE["produtos1"]  = "";
$_COOKIE["produtos2"]  = "current";
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

					<h3>Dados de um Produto</h3>

					<div class="clear"></div>

				</div> <!-- End .content-box-header -->

				<div class="content-box-content">

			    <?php 
                     $acao        = "Atualizar";
                     $action_form = "acao.php?a=2&id=".$_GET['id'];
                     include('_form.php'); 
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
