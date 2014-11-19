<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM hoteis WHERE idhoteis = %d", $_GET['id']);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

$_COOKIE["hoteis"]="current";	
$_COOKIE["hoteis1"]="";
$_COOKIE["hoteis2"]="current";
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
					<h2>Editar um Hotel</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para editar um hotel no sistema.</p>
            <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados do Hotel</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
                
                <form action="acao.php?a=2&id=<?php  echo $_GET['id']; ?>" id="hoteis_form" method="post" enctype="multipart/form-data">	
<fieldset>
                        <p>
                            <label for="nome">Nome do Hotel</label>
                            <input class="text-input small-input required" type="text" id="nome" name="nome" maxlength="255" value="<?php  echo $manda['nome_hotel']; ?>"/>
                        </p>
                        
                        <p>
                            <label for="nome">Nível do Hotel</label>
                            <select name="nivel" id="nivel" class="text-input small-select required">
                              <option value="0">--- Selecione ---</option>
                              <option value="1" <?php  if ($manda['estrelas'] == 1) { echo 'selected="selected"'; } ?>>1 Estrela</option>
                              <option value="2" <?php  if ($manda['estrelas'] == 2) { echo 'selected="selected"'; } ?>>2 Estrelas</option>
                              <option value="3" <?php  if ($manda['estrelas'] == 3) { echo 'selected="selected"'; } ?>>3 Estrelas</option>
                              <option value="4" <?php  if ($manda['estrelas'] == 4) { echo 'selected="selected"'; } ?>>4 Estrelas</option>
                              <option value="5" <?php  if ($manda['estrelas'] == 5) { echo 'selected="selected"'; } ?>>5 Estrelas</option>
                              <option value="6" <?php  if ($manda['estrelas'] == 6) { echo 'selected="selected"'; } ?>>6 Estrelas</option>
                            </select>
                            
                        </p>
                        
                      <p>
                            <label for="nome">Status do Hotel</label>
                            <select name="status" id="status" class="text-input small-select required">
                              <option value="1" <?php  if ($manda['status'] == 1) { echo 'selected="selected"'; } ?>>Ativo</option>
                              <option value="2" <?php  if ($manda['status'] == 2) { echo 'selected="selected"'; } ?>>Pausado</option>
                            </select><br>
                            <small> *Em situação de <strong> pause </strong> ele não aparecerá na busca do site. </small>
            </p>
                        
<?php  if (isset($manda['imagem_principal'])) { ?>
    
    <p>
							<label for="imagematual">Imagem Atual</label>
                         	<a id="example1" href="../uploads/hoteis/<?php  echo $manda['imagem_principal']; ?>">&raquo; Clique aqui para visualizar</a>
                            <input type="hidden" value="<?php  echo $manda['imagem_principal']; ?>" name="imagematual" />
                          <br />
	                   
			  </p>
<?php  } ?>

                        <p>
							<label for="imagem">Nova Imagem</label>
						  <input class="text-input" type="file" name="imagemnova" id="imagemnova" /><br />
						  <small><a href="../crop/">Use a nossa ferramenta de edição de imagens: clique aqui. </a></small><br />

						<p>
                            

						<p>
                        
                        <p>
                            <label for="descricao">Descrição Principal</label>
                            <textarea class="text-input textarea wysiwyg" id="descricao" name="descricao" cols="79" rows="15"><?php  echo $manda['descricao']; ?></textarea>
                            <small> * Recomenda-se no <strong>mínimo 155 caracteres</strong> (somando os espaços). </small>
                            <br>
                        </p>
                        
                        <p>
                            <label for="descricao">Informações Adicionais</label>
                            <textarea class="text-input textarea wysiwyg required" id="infos" name="infos" cols="79" rows="15"><?php  echo $manda['informacoes_adicionais']; ?></textarea>
                            <small> * Recomenda-se no <strong>mínimo 155 caracteres</strong> (somando os espaços). </small>
                            <br>
                        </p>
                        
                        <p>
                            <label for="nome">Localização (Texto)</label>
                            <input class="text-input large-input" type="text" id="localizacao_texto" name="localizacao_texto" value="<?php  echo $manda['localizacao']; ?>" />
                        </p>
                                                
                       
                         <p>
                            <label for="nome">Cadastrar NOVA Localização (Mapa)</label>
                            <input class="text-input large-input" type="text" id="localizacao_mapa_nova" name="localizacao_mapa_nova" />
                            <input type="hidden" name="pegamapahotel" value="<?php  echo $manda['mapa']; ?>">
                            <br>
                        </p>
                        
                          <?php  echo $manda['mapa']; ?>                     
                        
                            <strong> Não conseguiu inserir o mapa? <a href="https://www.youtube.com/watch?v=5XoVTihHLzM" class="more"> Assista o Tutorial em vídeo</a>. 
                            Caso ainda não tenha entendido:  <a href="https://support.google.com/maps/answer/3544418?hl=pt-BR" target="_blank"> Leia o passo-a-passo do Google.</a></strong>
                            Ou também nesta opção em imagem:<a href="imagem-ilustrativo-passo-a-passo.jpg" target="_blank" class="fancybox"  id="example1"> Clique aqui </a></p>

					
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
						&#169; Copyright 201 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>
