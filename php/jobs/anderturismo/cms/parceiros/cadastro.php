<?php  
include("../includes/cabecalho.php");
include('../includes/check_authentication.php');
include("../includes/database_connection.php");

$sql_pegaCategoria = mysql_query("SELECT * FROM solucoes"); 

$_COOKIE["parceiros"]="current";
$_COOKIE["parceiros1"]="current";
$_COOKIE["parceiros2"]="";
?>

<body class="produtos form">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
					<h2>Adição de um Parceiro</h2>
			<p id="page-intro">Utilize o formulário abaixo para incluir um parceiro.</p>
		
		
		<div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

									<h3>Dados do Parceiro.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">

				<form action="acao.php?a=1" id="banners_form" method="post" enctype="multipart/form-data">	

					<fieldset>
                    
                                                             
						
						<p>
							<label>Nome</label>
							<input class="text-input medium-input required" type="text" id="nome" name="nome" maxlength="255" value=""/>
                            <small> * Somente para uso interno </small>
						</p>
						<label>Logotipo do parceiro</label>
					    <input class="text-input small-input" type="file" id="imagem" name="imagem"/><br />
  <small>O arquivo  deve estar no formato JPEG. A imagem será redimensionada para o tamanho de 214x156 pixels. Atenção: A imagem não deverá ter borda, cor do fundo tem que ser branca.<br>
  <a href="../crop/">Use a nossa ferramenta de edição de imagens: clique aqui. </a></small><br />
						</p>
						<p>
							<input class="button"type="submit"value="Adicionar"/>
						</p>

					</fieldset>

					<div class="clear"></div><!-- End .clear -->

				</form>

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
