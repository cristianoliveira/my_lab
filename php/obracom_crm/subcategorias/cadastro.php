<?php  
include("../includes/cabecalho.php");
include('../includes/check_authentication.php');
include("../includes/database_connection.php");


        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_pegaCategoria = mysql_query("SELECT * FROM categorias");        
        //$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação

$_COOKIE["subcategorias"]="current";
$_COOKIE["subcategorias1"]="current";
$_COOKIE["subcategorias2"]="";
?>

<body class="produtos form">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
					<h2>Adição de uma Sub-Categoria</h2>
			<p id="page-intro">Utilize o formulário abaixo para incluir uma sub-categoria no sistema.</p>
		
		
		<div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

									<h3>Dados da Sub-Categoria.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">

				<form action="acao.php?a=1" id="banners_form" method="post" enctype="multipart/form-data">	

					<fieldset>

						
						<p>
							<label>Nome</label>
							<input class="text-input medium-input required"type="text"id="nome"name="nome"maxlength="255"value=""/>
						</p>
						<p style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px">
						  <label>Imagem da Subcategoria </label>
					    <input class="text-input small-input"type="file"id="imagem"name="imagem"/><br />
					    <small>Edite a imagem na Ferramenta Crop, <a href="../crop/index.php">clique aqui para editar a imagem.</a></small><br />
													</p>
                                                    
                       
                        <p class="required-input">
                        <label>Categoria</label>
		<select name="categoria" id="categoria">
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaCategoria))
{ ?>
		   <option value="<?php  echo $row['idcategorias']; ?>"><?php  echo $row['nome_categoria']; ?>
           
           </option> 
	   <?php  } ?>
		</select>      </td>
    </tr>
                        
                        </p>
                        <p>
                          <label>Descrição </label>
                          <textarea class="text-input textarea" id="descricao" name="descricao" cols="79" rows="15"></textarea>
                        </p>
                        <p class="required-input">&nbsp;</p>
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
		
	</div></body>
  
</html>
