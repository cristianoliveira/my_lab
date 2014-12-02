<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
$_COOKIE["capas"]="current";
$_COOKIE["capas1"]="current";
$_COOKIE["capas2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de uma Capa</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir uma capa no sistema.</p>
            
            			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="../images/icons/cross_grey_small.png" title="Fechar" alt="close" /></a>
				<div>
					<strong> Atenção: </strong> Essas capas são relacionadas na hora do cadastro de roteiros.
				</div>
			</div>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados de uma Capa</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="capas_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>

						
                        <p>
                            <label for="nome">Nome da Capa</label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" value=""/> <small> * Somente para uso interno </small>
                        </p>


                        <p>
							<label for="imagem">Imagem</label>
						  <input class="text-input required" type="file" name="imagem" id="imagem" value=""/><br />
						<small>Envie uma imagem em <strong>JPEG,</strong> formato A4, retrato, com até 15mb de tamanho.</small>                            
                        Exemplo de Arquivo: <a href="capa_roteiros_pdf.psd" target="_blank">Clique aqui para fazer download do PSD</a>.</p>

						<p>
                        	<input type="submit" class="button" id="btn_send" name="btn_send" value="Cadastrar capa" />
						</p>


					</fieldset>

					<div class="clear"></div><!-- End .clear -->

				</form>

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
