<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");

$_COOKIE["downloads"]="current";
$_COOKIE["downloads1"]="current";
$_COOKIE["downloads2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de Revista ou Roteiro</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir uma Revista ou Roteiro para download no site.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados da Revista ou Roteiro.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="frmArtigos" method="post" enctype="multipart/form-data">	
                

					<fieldset>

						
                        <p>
                            <label for="nome">Nome que vai no site </label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="150" value=""/>
                        </p>
                        <p>
                          <label for="imagem">Arquivo</label>
						  <input class="text-input required" type="file" name="imagem" id="imagem" value=""/><br />
	                        <small>Envie arquivos <strong>PDF</strong> com no máximo <strong>30 Mb </strong> de tamanho.</small></p>
						<p>
                        	<input type="submit" class="button" id="btn_send" name="btn_send" value="Cadastrar" />
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
