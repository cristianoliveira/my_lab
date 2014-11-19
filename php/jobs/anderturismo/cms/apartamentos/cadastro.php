<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");

$sql_pegaCategoria = mysql_query("SELECT * FROM solucoes");     

$_COOKIE["apartamentos"]="current";	
$_COOKIE["apartamentos1"]="current";
$_COOKIE["apartamentos2"]="";

?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de Apartamento</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um tipo de apartamento.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do Apartamento.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="aptos_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
                                          
                    
                      <p>
                            <label for="nome">Tipo do Aparamento</label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="255" value="" required/><br>
                            <small> *Ex: Quarto Solteiro (Single Room) </small>
                        </p>
                                                <p>
                            <label for="url"> Sigla </label>
                            <input class="text-input small-input required" type="text" id="sigla" name="sigla" maxlength="50" value=""/><br>
							<small> *Ex: SGL </small>
                        </p>
                        <p>
                        	<input type="submit" class="button" id="btn_send" name="btn_send" value="Cadastrar Apartamento" />
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
