<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
$_COOKIE["banners"]="current";
$_COOKIE["classe6"]="current";
$_COOKIE["classe7"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de um Banner</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um destaque no sistema.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados de um banner</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="banners_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>

						
                        <p>
                            <label for="nome">Título</label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="150" value=""/> <small> * Somente para uso interno </small>
                        </p>
                        <p>
					    <label for="link">Link</label>
							<input class="text-input large-input"id="link"name="link"maxlength="255"value=""/>
                            <br/><small>Digite ou cole no campo acima o link <strong>completo</strong> para o conteúdo.</small>
						</p>


                        <p>
							<label for="imagem">Imagem</label>
						  <input class="text-input required" type="file" name="imagem" id="imagem" value=""/><br />
	                        <small>Edite a imagem na Ferramenta Crop, clique aqui para editar a imagem.</small></p>

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
