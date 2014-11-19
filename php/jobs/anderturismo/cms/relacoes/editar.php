<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$_COOKIE["roteiros"]="current";	
$_COOKIE["relacionados1"]="";
$_COOKIE["relacionados2"]="current";

//Pega Dados e Mostra-os.
$query = sprintf("SELECT* FROM roteiros, relacoes_roteiros WHERE roteiro_principal=idroteiros AND idrelacoes=%d", $_GET['id']);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_pegaCategoria = mysql_query("SELECT * FROM solucoes, servicos_relacionados WHERE idservicos =".$_GET['id']); 
$sql_pegaRoteiro1 = mysql_query("SELECT * FROM roteiros"); 
$sql_pegaRoteiro2 = mysql_query("SELECT * FROM roteiros");         
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
					<h2>Editar uma Relação</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para editar uma relação.</p>
            
             <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados da Relação.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=2&id=<?php echo $_GET["id"]; ?>" id="relacoes_form" method="post">	
                

					<fieldset>
                    
                    <p class="required-input">
                        <label>Roteiro Principal</label>
		<select name="hotel1" id="hotel1" required="required">
        <option value="">--- Selecione o hotel ---</option>
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaRoteiro1))
{ 
?>
		   <option value="<?php  echo $row['idroteiros']; ?>"  <?php  if (@$row['idroteiros'] == @$manda['roteiro_principal']) { echo 'selected="selected"'; } ?>><?php  echo utf8_encode($row['nome_roteiro']); ?> </option> 
           
           
	   <?php  } ?>
		</select>      
                        
                        </p>
                        
                        
                    
                                                                <p class="required-input">
                        <label>Roteiro Relacionado</label>
		<select name="hotel1" id="hotel1" required="required">
        <option value="">--- Selecione o hotel ---</option>
		<?php 	
		
		while ($row2 = mysql_fetch_array($sql_pegaRoteiro2))
{ 
?>
		   <option value="<?php  echo $row2['idroteiros']; ?>"  <?php  if (@$row2['idroteiros'] == @$manda['relacionado']) { echo 'selected="selected"'; } ?>><?php  echo utf8_encode($row2['nome_roteiro']); ?> </option> 
           
           
	   <?php  } ?>
		</select>      
                        
                        </p>
                        
                 
                        	<input type="submit" class="button" id="btn_send" name="btn_send" value="Atualizar Relação" />
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
