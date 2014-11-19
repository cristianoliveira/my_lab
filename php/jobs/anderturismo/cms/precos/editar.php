<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$_COOKIE["precos"]="current";	
$_COOKIE["precos1"]="";
$_COOKIE["precos2"]="current";

$sql_pegaHoteis = mysql_query("SELECT * FROM hoteis");     
$sql_pegaAptos  = mysql_query("SELECT * FROM apartamentos"); 

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM precos WHERE idprecos = %d", $_GET['id']);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_pegaCategoria = mysql_query("SELECT * FROM precos WHERE idprecos =".$_GET['id']); 
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
					<h2>Editar um Preço</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para editar um preço.</p>
            
             <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do Preço.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=2&id=<?php echo $_GET["id"]; ?>" id="tabelaprecos_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
                    
                                            <p class="required-input">
                        <label>A qual hotel está relacionado?</label>
		<select name="hotel" id="hotel" required>
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaHoteis))
{ 
?>
		   <option value="<?php  echo $row['idhoteis']; ?>" <?php  if (@$row['idhoteis'] == @$manda['hotel_id']) { echo 'selected="selected"'; } ?>><?php  echo $row['nome_hotel']; ?> </option> 
           
           
	   <?php  } ?>
		</select>      </td>
    </tr>
                        
                        </p>
                        
                        
                        
                        <p class="required-input">
                        <label>Tipo de Apartamento</label>
		<select name="apto" id="apto" required>
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaAptos))
{ 
?>
		   <option value="<?php  echo $row['idapartamentos']; ?>" <?php  if (@$row['idapartamentos'] == @$manda['apartamento_id']) { echo 'selected="selected"'; } ?>><?php  echo $row['nome_apartamento']; ?> </option> 
           
           
	   <?php  } 
	   
	   $num = $manda['valor']; 
 
	   ?>
		</select>      </td>
    </tr>
                        
                        </p>
                        
                    
                        <p>
                            <label for="nome">Valor Diária</label>
                            <input class="text-input small-input required" type="text" id="valor" name="valor" maxlength="255" value="<?php  echo $manda['valor']; ?>" required />
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
