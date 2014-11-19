<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
$_COOKIE["banners"]="current";
$_COOKIE["banners1"]="current";
$_COOKIE["banners2"]="";
?>

<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de um Banner</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um destaque no sistema.</p>
            
            			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="../images/icons/cross_grey_small.png" title="Fechar" alt="close" /></a>
				<div>
					<strong> Atenção: </strong> Para o banner funcionar de maneira fullscreen como ele se apresenta, o ideal é ter o tamanho especificado.
				</div>
			</div>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados de um banner</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="banners_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>

						
                        <p>
                            <label for="nome">Título Principal</label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="255" value=""/> <small> * Título Principal que vai na HOME </small>
                        </p>
                        <p>
                            <label for="nome">Subtítulo</label>
                            <input class="text-input small-input required" type="text" id="subtitulo" name="subtitulo" maxlength="255" value=""/> <small> * Subtítulo que vai na HOME </small>
                        </p>
                        <p>
                            <label for="nome">Tipo</label>
                            <input class="text-input small-input required" type="text" id="tipo" name="tipo" maxlength="255" value=""/> <small> * Texto 3 abaixo do subtítulo </small>
                        </p>
                        <p>
					    <label for="link">Link</label>
							<input class="text-input small-input"id="link"name="link"maxlength="255"value=""/>
                            <br/><small>Digite ou cole no campo acima o link <strong>completo</strong> para o conteúdo.</small>
						</p>
                        
                        <p>
                            <label for="nome">Orientação</label>
                           <select name="orientacao" id="orientacao">
                            <option value="horizontal"> Horizontal </option>         
                           <option value="vertical">  Vertical </option>
                            </select>
                        </p>
                        
                         <p>
					    <label for="link">Rotação 1 e 2</label>
							<input class="text-input little-input"id="rotacao1"name="rotacao1"maxlength="255"value=""/>
                            <input class="text-input little-input"id="rotacao2"name="rotacao2"maxlength="255"value=""/> 
                            <a href="#" class="ketchup tooltip" title="É como ele ABRE o banner. Na dúvida insira '0' (zero).">Não entendeu? Passe o mouse.</a>
                            
                            
                            <br/><small> Configurações para a animação do banner.</small>
						</p>
                        

                         <p>
					    <label for="link">Escala 1 e 2</label>
							<input class="text-input little-input"id="escala1"name="escala1" maxlength="255"value=""/>
                            <input class="text-input little-input"id="escala2" name="escala2"maxlength="255"value=""/>
                            <a href="#" class="ketchup tooltip" title="É como ele FECHA o banner. Na dúvida insira '0' (zero).">Não entendeu? Passe o mouse.</a>
                            <br/><small> Configurações para a animação do banner.</small>
						</p>

                        <p>
							<label for="imagem">Imagem</label>
						  <input class="text-input required" type="file" name="imagem" id="imagem" value=""/><br />
	                        <small>Envie arquivos <strong>JPG</strong> com no máximo <strong>1mb</strong> de tamanho. A imagem deve ter o tamanho de (ou maior) que <strong>1024  x 600</strong> pixels. 
                            <a href="home-banner-01.jpg" class="foo"  target="_blank">Veja modelo: Clicando aqui.</a> 
                            Ou clique aqui e vá para nossa <a href="../crop/index.php#banners">Ferramenta de Edição de Imagens</a>.</small>
                        </p>

					<p>
                            <label for="nome">Ordem</label>
                           <select name="ordem" id="ordem">
						<?php $i = 1; while ($i <= 250): ?>						
							<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>         
						<?php $i++; endwhile; ?>
                            </select>
                        </p>
                        
                        <p>
                            <label for="nome">Publicar?</label>
                           <select name="publicar" id="publicar">
                            <option value="1"> Sim </option>         
                           <option value="2">  Não </option>
                            </select>
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
