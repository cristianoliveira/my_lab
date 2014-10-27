<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM produtos WHERE idprodutos = %d", $_GET['id']);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_pegaCategoria = mysql_query("SELECT * FROM categorias, produtos WHERE idprodutos =".$_GET['id']); 
		        $sql_pegaCategoria2 = mysql_query("SELECT * FROM subcategorias, produtos WHERE idprodutos =".$_GET['id']);         
        //$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
		
$_COOKIE["produtos"] = "current";
$_COOKIE["produtos1"]  = "";
$_COOKIE["produtos2"]  = "current";
?>
<script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	
	<script type="text/javascript">
		$(document).ready(function() {

			$("a#example1").fancybox();

		});
	</script>


<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Editar um Produto</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para editar um produto no site.</p>
            <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados de um Produto</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
			   <form action="acao.php?a=2&id=<?php  echo $_GET['id']; ?>" id="banners_form" method="post" enctype="multipart/form-data">	
			    <fieldset>
			      <p>
			        <label>Nome</label>
			        <input class="text-input medium-input required"type="text"id="nome"name="nome"maxlength="255"value="<?php  echo $manda['nome_produto']; ?>"/>
			      </p>
			      <?php  if (isset($manda['image_name1'])) { ?>
    
    <p>
							<label for="imagem">Imagem Atual</label>
                         	<a id="example1" href="../uploads/produtos/<?php  echo $manda['image_name1']; ?>" target="_blank">&raquo; Clique aqui para visualizar</a>
                          <br />
	                   
													</p>
<?php  } ?>

                        <p>
							<label for="imagem">Novo Arquivo </label>
						  <input class="text-input" type="file" name="imagemnova" id="imagemnova" /><br />
						 <small>Edite a imagem na Ferramenta Crop, <a href="../crop/index.php">clique aqui para editar a imagem.</a></small></p>
           
			      <p class="required-input">
			       <label for="cod_estados">Categoria</label>
			       <select name="cod_estados" id="cod_estados">
			         <?php  
		while($row = mysql_fetch_array($sql_pegaCategoria)){ ?>
		   <option value="<?php  echo $row['idcategorias'] ?>" <?php  if ($row['idcategorias'] == $manda['categoria_id']) { echo 'selected="selected"'; } ?>><?php  echo $row['nome_categoria']; ?>
           </option><?php  } ?>
		
 
		            </select>
			        </td>
			        </tr>
		          </p>
                  
                  
<p>
		<label for="cod_cidades">Sub-categoria</label>
		<select name="cod_cidades" id="cod_cidades">
			<!--option value="">-- Escolha uma subcategoria --</option -->
            <?php  
		while($row2 = mysql_fetch_array($sql_pegaCategoria2)){ ?>
		   <option value="<?php  echo $row2['idsubcategorias'] ?>" <?php  if ($row2['idsubcategorias'] == $manda['subcategoria_id']) { echo 'selected="selected"'; } ?>><?php  echo $row2['nome_subcategoria']; ?>
           </option><?php  } ?>
           
		</select>
         

                        </p>
                        
                        <p>
                        <label>Descrição </label>
							<textarea class="text-input textarea" id="descricao" name="descricao" cols="79" rows="15"><?php  echo $manda['descricao_produto']; ?></textarea>
                        </p>
                  
                  
                  
                  
			      <p>
			        <input class="button"type="submit"value="Atualizar"/>
		          </p>
		        </fieldset>
			    <div class="clear"></div>
			    <!-- End .clear -->
		      </form>
			</div> <!-- End .content-box-content -->

		</div> <!-- End .content-box -->


			<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						&#169; Copyright 2012 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>
