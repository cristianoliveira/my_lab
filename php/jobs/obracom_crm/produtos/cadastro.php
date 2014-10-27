<?php  
include("../includes/cabecalho.php");
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../models/categorias_model.php");

  $categorias     = new CategoriasModel();
  $listCategorias = $categorias->getAll();
    
$_COOKIE["produtos"] = "current";
$_COOKIE["produtos1"]  = "current";
$_COOKIE["produtos2"]  = "";
?>

<body class="produtos form">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
					<h2>Adição de um Produto</h2>
			<p id="page-intro">Utilize o formulário abaixo para incluir um produto no sistema.</p>
		
		
		<div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

									<h3>Dados do Produto.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">

				<form action="acao.php?a=1" name="produtos" id="produtos" method="post" enctype="multipart/form-data">	

					<fieldset>

						
						<p>
							<label>Nome</label>
							<input class="text-input medium-input required" type="text" id="nome" name="nome" maxlength="512" value="" />
						</p>
						<p style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px">
						  <label>Imagem do Produto</label>
					    <input class="text-input small-input" type="file" id="imagem" name="imagem" /><br />
  <small>Edite a imagem na Ferramenta Crop, <a href="../crop/index.php">clique aqui para editar a imagem.</a></small><br />
													</p>
                                                    
                       
                       
                        
                        <p>
		<label for="cod_estados">Categoria</label>
		<select name="cod_estados" id="cod_estados">
			<option value="">-- Escolha uma categoria --</option>
			<?php foreach($listCategorias as $categoria){ ?>
			    <option value="<?= $categoria['idcategorias'] ?>"><?= $categoria['nome_categoria'] ?></option>
			<?php } ?>
		</select>
         </p>

<p>
		<label for="cod_cidades">Sub-categoria</label>
		<select name="cod_cidades" id="cod_cidades">
			<option value="">-- Escolha uma subcategoria --</option>
           
		</select>
         

                        </p>
                        <p>
                        <label>Descrição </label>
							<textarea class="text-input textarea" id="descricao" name="descricao" cols="79" rows="15"></textarea>
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
						&#169; Copyright 2013 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div>
    
      
    
    </body>
  
</html>
