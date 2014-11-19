<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");

$sql_pegaHoteis = mysql_query("SELECT * FROM hoteis");     
$sql_pegaAptos  = mysql_query("SELECT * FROM apartamentos"); 

$_COOKIE["precos"]="current";	
$_COOKIE["precos1"]="current";
$_COOKIE["precos2"]="";

?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de Preço</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir preço.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do Preço.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="tabelaprecos_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
                    
                                            <p class="required-input">
                        <label>A qual hotel está vinculado?</label>
		<select name="hotel" id="hotel" required>
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaHoteis))
{ 
?>
		   <option value="<?php  echo $row['idhoteis']; ?>"><?php  echo $row['nome_hotel']; ?> </option> 
           
           
	   <?php  } ?>
		</select>      </td>
    </tr>
                        
                        </p>
                        
                        
                        <p class="required-input">
                        <label>Tipo do Apartamento</label>
		<select name="apto" id="apto" required>
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaAptos))
{ 
?>
		   <option value="<?php  echo $row['idapartamentos']; ?>"><?php  echo $row['nome_apartamento']; ?> </option> 
           
           
	   <?php  } ?>
		</select>      </td>
    </tr>
                        
                        </p>
                        
                        
                    
                        <p>
                            <label for="nome">Valor Diária</label>
                            <input class="text-input small-input required" type="text" id="valor" name="valor" maxlength="255" value="" required/>
                        </p>

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
						© Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>
