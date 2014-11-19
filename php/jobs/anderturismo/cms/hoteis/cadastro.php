<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');

$_COOKIE["hoteis"]="current";	
$_COOKIE["hoteis1"]="current";
$_COOKIE["hoteis2"]="";
?>
<script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	
	<script type="text/javascript">
		$(document).ready(function() {			
				

			$("a#example1").fancybox();
			
			$("a.more").click(function() {
    $.fancybox({
            'padding'       : 0,
            'autoScale'     : false,
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            'title'         : this.title,
            'width'     : 680,
            'height'        : 495,
            'href'          : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
            'type'          : 'swf',
            'swf'           : {
                 'wmode'        : 'transparent',
                'allowfullscreen'   : 'true'
            }
        });

    return false;
});

		});
	</script>
<body class="destaques formulario">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
					<h2>Cadastro de Hotel</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para incluir um hotel no site.</p>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do hotel</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=1" id="hoteis_form" method="post" enctype="multipart/form-data">	
                

					<fieldset>
						
                        <p>
                            <label for="nome">Nome do Hotel</label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="255" value=""/>
                        </p>
                        
                        <p>
                            <label for="nome">Nível do Hotel</label>
                            <select name="nivel" id="nivel" class="text-input small-select required">
                              <option value="0">--- Selecione ---</option>
                              <option value="1">1 Estrela</option>
                              <option value="2">2 Estrelas</option>
                              <option value="3">3 Estrelas</option>
                              <option value="4">4 Estrelas</option>
                              <option value="5">5 Estrelas</option>
                              <option value="6">6 Estrelas</option>
                            </select>
                            
                        </p>
                        
                      <p>
                            <label for="nome">Status do Hotel</label>
                            <select name="status" id="status" class="text-input small-select required">
                              <option value="1">Ativo</option>
                              <option value="2">Pausado</option>
                            </select><br>
                            <small> *Em situação de <strong> pause </strong> ele não aparecerá na busca do site. </small>
                        </p>
                        
                        <p>
						  <label for="imagem">Imagem Principal</label>
						  <input class="text-input text required" type="file" name="imagem" id="imagem" /><br />
	                        <small><a href="../crop/">Use a nossa ferramenta de edição de imagens: clique aqui. </a></small><br />                    
                        </p>
                            

						<p>
                        
                        <p>
                            <label for="descricao">Descrição Principal</label>
                            <textarea class="text-textarea textarea wysiwyg" id="descricao" name="descricao" cols="79" rows="15" autofocus></textarea>
                            <small> * Recomenda-se no <strong>mínimo 255 caracteres</strong> (somando os espaços). </small>
                            <br>
                        </p>
                        
                        <p>
                            <label for="descricao">Informações Adicionais</label>
                            <textarea class="text-input textarea wysiwyg required" id="infos" name="infos" cols="79" rows="15"></textarea>
                            <small> * Recomenda-se no <strong>mínimo 255 caracteres</strong> (somando os espaços). </small>
                            <br>
                        </p>
                        
                        <p>
                            <label for="nome">Localização (Texto)</label>
                            <input class="text-input large-input" type="text" id="localizacao_texto" name="localizacao_texto" value=""/>
                        </p>
                        
                         <p>
                            <label for="nome">Localização (Mapa)</label>
                            <input class="text-input large-input" type="text" id="localizacao_mapa" name="localizacao_mapa" value=""/><br>
                            <strong> Não conseguiu inserir o mapa? <a href="http://www.youtube.com/watch?v=5XoVTihHLzM" class="more"> Assista o Tutorial em vídeo</a>. 
                            Caso ainda não tenha entendido:  <a href="https://support.google.com/maps/answer/3544418?hl=pt-BR" target="_blank"> Leia o passo-a-passo do Google.</a></strong>
                            Ou também nesta opção em imagem:<a href="imagem-ilustrativo-passo-a-passo.jpg" target="_blank" class="fancybox"  id="example1"> Clique aqui </a></p>
                        
                        <p>

                        	<input type="submit" class="button" id="btn_send" name="btn_send" value="Cadastrar Hotel" />
						</p>


					</fieldset>

					<div class="clear"></div><!-- End .clear -->

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
