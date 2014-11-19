<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');

$_COOKIE["paises"]="current";
$_COOKIE["paises1"]="current";
$_COOKIE["paises2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de um Destino ou País</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um destino ou país.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do Destino ou País.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="usuarios_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
                        <p>
                            <label for="nome">Nome do Destino País </label>
                            <input class="text-input small-input" type="text" id="nome" name="nome" maxlength="150" value=""/>
                        </p>
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
						© Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>
