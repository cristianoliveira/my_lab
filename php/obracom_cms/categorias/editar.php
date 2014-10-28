<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM categorias WHERE idcategorias = %d", $_GET['id']);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_pegaCategoria = mysql_query("SELECT * FROM categorias WHERE idcategorias =".$_GET['id']);        
        //$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
		
$_COOKIE["categorias"]="current";
$_COOKIE["categorias1"]="";
$_COOKIE["categorias2"]="current";
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
					<h2>Editar uma Categoria</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para editar uma categoria no site.</p>
            <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados de uma Categoria</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
			   <form action="acao.php?a=2&id=<?php  echo $_GET['id']; ?>" id="banners_form" method="post" enctype="multipart/form-data">	
			    <fieldset>
			      <p>
			        <label>Nome</label>
			        <input class="text-input medium-input required"type="text"id="nome"name="nome"maxlength="255"value="<?php  echo $manda['nome_categoria']; ?>"/>
			      </p>
                  
                  <p>
			        <label>Subtítulo Capa</label>
			        <input class="text-input medium-input required"type="text"id="subtitulo"name="subtitulo"maxlength="125"value="<?php  echo $manda['subtitulo_capa']; ?>"/>
                    
			      </p>
			      <?php  if (isset($manda['imagem'])) { ?>
    
    <p>
							<label for="imagem">Imagem Atual</label>
                         	<a id="example1" href="../uploads/categorias/<?php  echo $manda['imagem']; ?>" target="_blank">&raquo; Clique aqui para visualizar</a>
                          <br />
	                   
													</p>
<?php  } ?>

                        <p>
							<label for="imagem">Novo Arquivo </label>
						  <input class="text-input" type="file" name="imagemnova" id="imagemnova" /><br />
						 <small>Edite a imagem na Ferramenta Crop, <a href="../crop/index.php">clique aqui para editar a imagem</a>.</small>
			        </td>
			        </tr>
		          </p>
                                          <p>
                        <label>Descrição </label>
							<textarea class="text-input textarea" id="descricao" name="descricao" cols="79" rows="15"><?php  echo $manda['breve_descricao']; ?></textarea><br>
                        <small>No máximo 125 caracteres.</small>
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
						&#169; Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>
