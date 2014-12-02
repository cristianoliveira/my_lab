<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');

$_COOKIE["usuarios"]="current";
$_COOKIE["usuarios1"]="current";
$_COOKIE["usuarios2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de um Usuário</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um usuário.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do Usuário.</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="usuarios_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
                        <p>
                            <label for="nome">Nome Completo</label>
                            <input class="text-input small-input" type="text" id="nome" name="nome" maxlength="150" value=""/>
                        </p>

                        <p>
							<label for="conta">Usuário </label>
							<input class="text-input large-input required"type="text"id="conta"name="conta"maxlength="100"value=""/>
                            <br/><small> Este será o usuário que dá acesso ao login do gerenciador.</small>
						</p>

						<p>
							<label for="senha">Senha</label>
							<input class="text-input large-input required" id="senha" name="senha" maxlength="255" value="" type="password"/>
						</p>
						
                        <p>
                            <label for="email">E-mail </label>
                            <input class="text-input small-input" type="text" id="email" name="email" maxlength="320" value=""/>
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
