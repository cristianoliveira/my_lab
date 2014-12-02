<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");

$sql_pegaRoteiro1 = mysql_query("SELECT * FROM roteiros");  
$sql_pegaRoteiro2 = mysql_query("SELECT * FROM roteiros");        

$_COOKIE["roteiros"]="current";	
$_COOKIE["relacionados1"]="current";
$_COOKIE["relacionados2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de um Roteiro Relacionado</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um roteiro relaconado.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados da Relação.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="relacoes_form" method="post">	
                

					<fieldset>
                    
                                            <p class="required-input">
                        <label>Roteiro Principal</label>
		<select name="hotel1" id="hotel1" required="required" >
        <option value="">--- Selecione o hotel ---</option>
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaRoteiro1))
{ 
?>
		   <option value="<?php  echo $row['idroteiros']; ?>"><?php  echo utf8_encode($row['nome_roteiro']); ?> </option> 
           
           
	   <?php  } ?>
		</select>      
                        
                        </p>
                        
                        <p class="required-input">
                        <label>Roteiro relacionado</label>
		<select name="hotel2" id="hotel2" required="required" >
        <option value="">--- Selecione o hotel ---</option>
		<?php 	
		
		while ($row2 = mysql_fetch_array($sql_pegaRoteiro2))
{ 
?>
		   <option value="<?php  echo $row2['idroteiros']; ?>"><?php  echo utf8_encode($row2['nome_roteiro']); ?> </option> 
           
           
	   <?php  } ?>
		</select> 
        <small> O roteiro relacionado é aquele que aparece abaixo da página do roteiro como sugestão </small>     
                        
                        </p>
                    



                        <p>
                        	<input type="submit" class="button" id="btn_send" name="btn_send" value="Cadastrar relação" />
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
