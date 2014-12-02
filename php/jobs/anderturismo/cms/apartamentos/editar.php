<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$_COOKIE["apartamentos"]="current";	
$_COOKIE["apartamentos1"]="";
$_COOKIE["apartamentos2"]="current";

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM apartamentos WHERE idapartamentos = %d", $_GET['id']);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}
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
					<h2>Editar um Apartamento</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para editar um apartamento.</p>
            
             <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do Apartamento.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=2&id=<?php echo $_GET["id"]; ?>" id="aptos_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
                    
                        <p>
                            <label for="nome">Tipo do Apartamento</label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="255" value="<?php  echo $manda['nome_apartamento']; ?>" required/>
                            <br>
                            <small> *Ex: Quarto Solteiro (Single Room) </small>
                        </p>
                                                <p>
                            <label for="nome">Sigla </label>
                            <input class="text-input small-input required" type="text" id="sigla" name="sigla" maxlength="50" value="<?php  echo $manda['sigla']; ?>" required/><br>
							<small> *Ex: SGL </small>
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
