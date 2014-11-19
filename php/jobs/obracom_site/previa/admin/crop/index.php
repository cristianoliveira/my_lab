<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
$_COOKIE["crop"]="current";
$_COOKIE["crop1"]="current";
$_COOKIE["crop2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Ferramenta de Edição de Imagem</h2>
            
			<p id="page-intro">Utilize a ferramenta para cortar a imagem de acordo a sua necessidade no CMS.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>É bem simples, cliquei no ícone da foto abaixo, escolha a imagem, corte-a dê ok e em seguida clique com o botão direito para salvar imagem.</h3>
				
				<div class="clear"></div>

		  </div> <!-- End .content-box-header -->

			<div>
            
            <?php include("crop.html"); ?>
            
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
