<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");

$sql_pegaRoteiros = mysql_query("SELECT * FROM roteiros");  

$_COOKIE["videos"]="current";
$_COOKIE["videos1"]="current";
$_COOKIE["videos2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de um Vídeo de Roteiro</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um vídeo em um roteiro.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do Vídeo.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="usuarios_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
                    <p class="required-input">
                        <select name="roteiros" id="roteiros" required>
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaRoteiros))
{ 
?>
		   <option value="<?php  echo $row['idroteiros']; ?>"><?php  echo $row['nome_roteiro']; ?> </option> 
           
           
	   <?php  } ?>
		</select>      </td>
    </tr>
                        
                        </p>
                        <p>
                            <label for="nome">Nome </label>
                            <input class="text-input small-input" type="text" id="nome" name="nome" value=""/>
                        </p>

                        <p>
							<label for="conta">ID Youtube  </label>
							<input class="text-input large-input required"type="text"id="conta"name="conta" value=""/>
                        
                        <small> Como pegar o seu ID: <a href="img-youtube.jpg" target="_blank">Clique aqui para ver a imagem de referência.</a></strong></small></p><br>
                        
                        <br/>
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
