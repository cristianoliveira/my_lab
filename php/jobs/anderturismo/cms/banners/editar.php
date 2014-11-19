<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM banners WHERE idbanners = %d", $_GET['id']);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

$_COOKIE["banners"]="current";
$_COOKIE["banners1"]="";
$_COOKIE["banners2"]="current";
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
					<h2>Editar um Banner</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um destaque no sistema.</p>
            <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados de um destaque</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=2&id=<?php  echo $_GET['id']; ?>" id="banners_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>

                        <p>
                            <label for="nome">Título Principal</label>
                          <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="255" value="<?php  echo $manda['titulo_principal']; ?>"/> <small> * Título Principal que vai na HOME </small>
                        </p>
                        <p>
                            <label for="nome">Subtítulo</label>
                          <input class="text-input small-input required" type="text" id="subtitulo" name="subtitulo" maxlength="255" value="<?php  echo $manda['subtitulo']; ?>" /> <small> * Subtítulo que vai na HOME </small>
                        </p>
                        <p>
                            <label for="nome">Tipo</label>
                          <input class="text-input small-input required" type="text" id="tipo" name="tipo" maxlength="255" value="<?php  echo $manda['tipo']; ?>" /> <small> * Texto 3 abaixo do subtítulo </small>
                        </p>
                        <p>
					    <label for="link">Link</label>
						  <input class="text-input large-input" id="link" name="link" value="<?php  echo $manda['link']; ?>"/>
                            <br/><small>Digite ou cole no campo acima o link <strong>completo</strong> para o conteúdo.</small>
						</p>
                        
                        <p>
                            <label for="nome">Orientação</label>
                          <select name="orientacao" id="orientacao">
                            <option value="horizontal" <?php  if ($manda['orientacao'] == "horizontal") { echo 'selected="selected"'; } ?>> Horizontal </option>         
                           <option value="vertical" <?php  if ($manda['orientacao'] == "vertical") { echo 'selected="selected"'; } ?>>  Vertical </option>
                            </select>
                        </p>
                        
                         <p>
					    <label for="link">Rotação 1 e 2</label>
						   <input class="text-input little-input" id="rotacao1" name="rotacao1" maxlength="255" value="<?php  echo $manda['rotacao1']; ?>"/>
                           <input class="text-input little-input" id="rotacao2" name="rotacao2" maxlength="255" value="<?php  echo $manda['rotacao2']; ?>"/>
                           <a href="#" class="ketchup tooltip" title="É como ele ABRE o banner. Na dúvida insira '0' (zero).">Não entendeu? Passe o mouse.</a>
                            <br/><small> Configurações para a animação do banner.</small>
						</p>
                        

                         <p>
					    <label for="link">Escala 1 e 2</label>
						   <input class="text-input little-input"id="escala1"name="escala1" maxlength="255"value="<?php  echo $manda['escala1']; ?>"/>
                           <input class="text-input little-input"id="escala2" name="escala2"maxlength="255"value="<?php  echo $manda['escala2']; ?>"/>
                           <a href="#" class="ketchup tooltip" title="É como ele FECHA o banner. Na dúvida insira '0' (zero).">Não entendeu? Passe o mouse.</a>
                            <br/><small> Configurações para a animação do banner.</small>
						</p>

<?php  if (isset($manda['imagem'])) { ?>
    
    <p>
							<label for="imagem">Imagem Atual</label>
                         	<a id="example1" href="../uploads/banners/<?php  echo $manda['imagem']; ?>">&raquo; Clique aqui para visualizar</a>
                          <br />
	                   
			  </p>
<?php  } ?>

                      <p>
							<label for="imagem">Nova Imagem</label>
						  <input class="text-input" type="file" name="imagemnova" id="imagemnova" value=""/><br />
	                        <small>Envie arquivos <strong>JPG</strong> com no máximo <strong>1mb</strong> de tamanho. A imagem deve ter o tamanho de (ou maior) que <strong>1024  x 600</strong> pixels. 
                            <a href="home-banner-01.jpg" class="foo"  target="_blank">Veja modelo: Clicando aqui.</a> 
                            Ou clique aqui e vá para nossa <a href="../crop/index.php#banners">Ferramenta de Edição de Imagens</a>.</small>
					  </p>

					  <p>
                        	<input type="submit" class="button" id="btn_send" name="btn_send" value="Atualizar" />
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
