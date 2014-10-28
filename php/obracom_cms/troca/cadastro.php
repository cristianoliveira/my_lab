<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');

$_COOKIE["novidades"]="current";	
$_COOKIE["novidades1"]="current";
$_COOKIE["novidades2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Adicionar Imóvel</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um imóvel no site.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados de um Imóvel</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="banners_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
                    
					
                        <p>
                            <label for="nome">Título</label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="255" value=""/>
                        </p>
                        
                        <p>
                        	<label for="categoria"> Categoria </label>
                            <select name="categoria" id="categoria" class="text-input required">
					<option value="0">Selecione a categoria do imóvel</option>
					<option value="1">Nossas Casas</option>
					<option value="2">Obras Entregues</option>
				  </select>
                        </p>
                        
                        <p>
                            <label for="descricao">Descrição</label>
                            <textarea class="text-input textarea wysiwyg required" id="descricao" name="descricao" cols="79" rows="15"></textarea>
                            <br>
                        </p>
                        <p>
						  <label for="imagem">Imagem*</label>
						  <input class="text-input required" type="file" name="imagem" id="imagem" value=""/><br />
	                        <small>Esta imagem será usada nas listagens de imóveis e deverá ter um tamanho máximo de 3 mb.</small></p>

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
						&#169; Copyright 2013 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>
