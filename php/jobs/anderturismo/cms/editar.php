<?php
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$_COOKIE["roteiros"] = "current";
$_COOKIE["roteiros1"]  = "";
$_COOKIE["roteiros2"]  = "current";

//Pega Dados e Mostra-os.
$query = sprintf("SELECT * FROM roteiros WHERE idroteiros = %d", $_GET['id']);
$recordset = mysql_query($query) or die("Erro ao afetuar consulta");
if (mysql_num_rows($recordset) == 0)  header('Location:listar.php'); else {  $manda = mysql_fetch_array($recordset);	}

$sql_pegaHoteis = mysql_query("SELECT * FROM capa_roteiros");

$pegaroteiro = $_GET['id'];
$sql_pegaRelacoes = mysql_query("SELECT * FROM relacoes_paises_roteiros WHERE id_roteiro = $pegaroteiro"); 
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
					<h2>Editar um Roteiro</h2>
            
			<p id="page-intro">Utilize o formulário abaixo para editar um roteiro no site.</p>
            <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
            <?php  if(@$manda['status_roteiro']==2) { ?>
			<div class="notification error png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> Você está editando um ROTEIRO PAUSADO. Para ele ir ao ar, por favor mude o STATUS. Importante lembrar que se não alterar as datas de início e fim ele não irá para o ar. </strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
		<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

									<h3>Dados de um Roteiro</h3>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
			   <form action="acao.php?a=2&id=<?php  echo $_GET['id']; ?>" id="roteiros_form" method="post" enctype="multipart/form-data">	
			    <fieldset>
                
                
              <p>
							<label>Nome do Roteiro</label>
                            <input class="text-input medium-input required" type="text" id="nome" name="nome" value="<?php  echo $manda['nome_roteiro']; ?>"  />
				  </p>
                        
                        <p>
							<label>Subtítulo do Roteiro</label>
							<input class="text-input medium-input required" type="text" id="subtitulo" name="subtitulo" value="<?php  echo $manda['subtitulo']; ?>" /><small> *Subtítulo da página interna do roteiro. </small>
						</p>
                        
                                                <p>
							<label>Preço à vista</label>
							<input class="text-input medium-input required" type="text" id="avista" name="avista" value="<?php  echo $manda['preco_avista']; ?>" />
						</p>
                        
                                                <p>
							<label>Preço parcelado</label>
							<input class="text-input medium-input required" type="text" id="parcelado" name="parcelado" value="<?php  echo $manda['preco_parcelado']; ?>" /><small> * Ex: Entrada de R$ xxx,xx + 4x de R$ xxx,xx (Cheques). </small>
						</p>
                        
                         <?php  if (isset($manda['imagem_roteiro'])) { ?>
    
    <p>
							<label for="imagem">Imagem Atual</label>
                         	<a id="example1" href="../uploads/roteiros/<?php  echo $manda['imagem_roteiro']; ?>" target="_blank">&raquo; Clique aqui para visualizar</a>
                          <br />
	                   
				  </p>
<?php  } ?>

                  <p>
							<label for="imagem">Novo Arquivo </label>
						  <input class="text-input" type="file" name="imagemnova" id="imagemnova" /><br />
						 <small>O arquivo da foto deve estar no formato JPEG e tamanho de 1024x768 ou superior. A imagem será redimensionada para o tamanho de 1084x310.</small></p>

<?php
$data1 = $manda['data_inicio'];
$data1 = implode("/",array_reverse(explode("-",$data1)));

$data2 = $manda['data_fim'];
$data2 = implode("/",array_reverse(explode("-",$data2)));

?>
                        
						
				  <label>Data de Início</label>
					    <input class="text-input small-date required" type="text" id="data_inicio" name="data_inicio" value="<?php  echo $data1; ?>" /><br />
					  <small>O roteiro permanecerá no site até o período pré-estabelecido. Depois desse período ele ficará pausado.</small><br />
													</p>
                                                    
                      <p>
						  <label>Data Fim</label>
					    <input class="text-input small-date required" type="text" id="data_fim" name="data_fim"  value="<?php  echo $data2; ?>" /><br />
					  <small>O roteiro permanecerá no site até o período pré-estabelecido. Depois desse período ele ficará pausado.</small><br />
													</p> 
                      
                                              <p>
							<label>Título Completo</label>
							<input class="text-input medium-input required" type="text" id="titulo_completo" name="titulo_completo" required value="<?php  echo $manda['titulo_completo']; ?>" /><small> *Título na descrição do roteiro. </small>
						</p>
                        
                         <p>
							<label>Datas Completas</label>
							<input class="text-input medium-input required" type="text" id="datas_completas" name="datas_completas" required value="<?php  echo $manda['datas_completas']; ?>" /><small> *Datas abaixo do título na descrição do roteiro. </small>
						</p> 
                        
                        <p>
                        <label>Programação Diária </label>
							<textarea class="text-input textarea wysiwyg" id="programacao_diaria" name="programacao_diaria" cols="79" rows="15"><?php  echo $manda['programacao_diaria']; ?></textarea>
                        </p>
                                                   
                  <p>
			       <label for="vp">Viagens Programadas</label>
			       <select name="viagens_programadas" id="viagens_programadas">
                    <option value="0" <?php  if ($manda['viagens_programadas'] == 0) { echo 'selected="selected"'; } ?>> Não </option>         
                   <option value="1"  <?php  if ($manda['viagens_programadas'] == 1) { echo 'selected="selected"'; } ?>> Sim </option>
		            </select>
		          </p>
                  
                                    <p>
			       <label for="vp">Selecione o tipo de Viagem </label>
			       <select name="viagens_programadas" id="viagens_programadas">
                    <option value=""> --- VIAGENS PROGRAMADAS --- </option>
                    <option value="0" <?php  if ($manda['viagens_programadas'] == 0) { echo 'selected="selected"'; } ?>> Não </option>         
                   <option value="1"  <?php  if ($manda['viagens_programadas'] == 1) { echo 'selected="selected"'; } ?>> Sim </option>
		            </select>
                    
                   
			       <select name="viagens_grupo" id="viagens_grupo">
                   <option value=""> --- VIAGENS EM GRUPO --- </option>
                    <option value="0" <?php  if ($manda['viagens_grupo'] == 0) { echo 'selected="selected"'; } ?>> Não </option>         
                   <option value="1"  <?php  if ($manda['viagens_grupo'] == 1) { echo 'selected="selected"'; } ?>> Sim </option>
		            </select>
                    
                   
			       <select name="viagens_individuais" id="viagens_individuais">
                   <option value=""> --- VIAGENS INDIVIDUAIS --- </option>
                    <option value="0" <?php  if ($manda['viagens_individuais'] == 0) { echo 'selected="selected"'; } ?>> Não </option>         
                   <option value="1"  <?php  if ($manda['viagens_individuais'] == 1) { echo 'selected="selected"'; } ?>> Sim </option>
		            </select>
		          </p>
                  
                  <p>
			       <label for="dc">Destaque Cabeçalho</label>
			       <select name="destaque_home" id="destaque_home">
                    <option value="0" <?php  if ($manda['destaque_home_cabecalho'] == 0) { echo 'selected="selected"'; } ?> > Não </option>         
                   <option value="1" <?php  if ($manda['destaque_home_cabecalho'] == 1) { echo 'selected="selected"'; } ?>> Sim </option>
		            </select>
                    <small> *Este item destaca o roteiro para o cabeçalho da página principal. Em cima das buscas. </small>
		          </p>  
                  
                                    <p>
			       <label for="dr">Destaque Roteiros</label>
			       <select name="destaque_roteiros" id="destaque_roteiros">
                    <option value="0" <?php  if ($manda['destaque_home_roteiros'] == 0) { echo 'selected="selected"'; } ?>> Não </option>         
                   <option value="1" <?php  if ($manda['destaque_home_roteiros'] == 1) { echo 'selected="selected"'; } ?>> Sim </option>
		            </select>
                    <small> *Este item destaca o roteiro para a o meio do site. Em baixo das buscas. Caso marque esta opção e a de cima (Destaque Cabeçalho) aparecerá em ambos. </small>
		          </p>

                  
                  <p>
			       <label for="sr">Status do Roteiro</label>
			       <select name="status_roteiro" id="status_roteiro" required="required">
                    <option value=""<?php  if ($manda['status_roteiro'] == "") { echo 'selected="selected"'; } ?>> --- SELECIONE O STATUS --- </option>
                    <option value="1" <?php  if ($manda['status_roteiro'] == 1) { echo 'selected="selected"'; } ?>> Ativo </option>         
                    <option value="2" <?php  if ($manda['status_roteiro'] == 2) { echo 'selected="selected"'; } ?>> Pausado </option>
                    <option value="3" <?php  if ($manda['status_roteiro'] == 3) { echo 'selected="selected"'; } ?>> Inativo </option>
		            </select>
		          </p>
                  
                <p>
			       <label for="tt">Tipo de Transporte</label>
			       <select name="tipo_transporte" id="tipo_transporte">
                    <option value="" <?php  if ($manda['tipo_transporte'] == "") { echo 'selected="selected"'; } ?>> --- SELECIONE O STATUS --- </option>
                    <option value="1" <?php  if ($manda['tipo_transporte'] == 1) { echo 'selected="selected"'; } ?>> Terrestre </option>         
                    <option value="2" <?php  if ($manda['tipo_transporte'] == 2) { echo 'selected="selected"'; } ?>> Rodoviário </option>
                    <option value="3" <?php  if ($manda['tipo_transporte'] == 3) { echo 'selected="selected"'; } ?>> Aéreo </option>
                    <option value="4" <?php  if ($manda['tipo_transporte'] == 4) { echo 'selected="selected"'; } ?>> Cruzeiro </option>
                    <option value="5" <?php  if ($manda['tipo_transporte'] == 5) { echo 'selected="selected"'; } ?>> Combinados </option>
	              </select>
		          </p>                       
                                                
                        
                  <p>
                    <label for="lcapas">Qual a capa que vai no PDF?</label>
                    <select name="capas" id="capas">
                    <option value="0">-- Escolha uma capa --</option>
		<?php 	
		
		while ($row = mysql_fetch_array($sql_pegaHoteis))
{ 
?>
		   <option value="<?php  echo $row['idcapas']; ?>" <?php  if (@$row['idcapas'] == @$manda['capas_roteiros']) { echo 'selected="selected"'; } ?>><?php  echo $row['nome_capa']; ?> </option> 
           
           
	   <?php  } ?>
		</select>
                  </p>
                  <p>
                    <label for="fdd">Feriado</label>
                    <select name="feriado" id="feriado">
                      <option value="0" <?php  if ($manda['tipo_transporte'] == 0) { echo 'selected="selected"'; } ?>> Não </option>
                      <option value="1"  <?php  if ($manda['tipo_transporte'] == 1) { echo 'selected="selected"'; } ?>> Sim </option>
                    </select>
                  </p>
                  
<p>&nbsp;</p> 
<p>                                              

        
        <h2> Relacionar Países</h2>
		<a id="addPais"><img src="../imagens/additem.png" height="16" width="16" style="vertical-align: middle"> Adicionar </a>
        <a id="removerCampo"><img src="../imagens/remover.gif" height="16" width="16" style="vertical-align: middle"> Remover </a>
        <p> </p>
        
        <?php 
		if(mysql_num_rows($sql_pegaRelacoes)>0){  
		while ($oi = mysql_fetch_array($sql_pegaRelacoes))	{ ?>
<div id="paises">

        <label for="pais">


        <select name="paises[]" id="paises[]">
        <?php
				$sql = "SELECT * FROM paises ORDER BY idpaises";
				$res = mysql_query($sql);
				while ( $row = mysql_fetch_assoc( $res ) ) {
					//echo '<option value="'.$row['idpaises'].'">'.$row['nome_pais'].'</option>';
			?>
            
            <option value="<?php  echo $row['idpaises']; ?>" <?php  if (@$row['idpaises'] == @$oi['id_pais']) { echo 'selected="selected"'; } ?>><?php  echo $row['nome_pais']; ?> </option> 
			
            
            <?php } ?>	                    
        </select>
               
        </label>
</div>
<?php } } else{ ?> 
<div id="paises">
<label for="pais">


        <select name="paises[]" id="paises[]">
        <?php
				$sql = "SELECT * FROM paises ORDER BY idpaises";
				$res = mysql_query($sql);
				while ( $row = mysql_fetch_assoc( $res ) ) {
					//echo '<option value="'.$row['idpaises'].'">'.$row['nome_pais'].'</option>';
			?>
            
            <option value="<?php  echo $row['idpaises']; ?>" <?php  if (@$row['idpaises'] == @$oi['id_pais']) { echo 'selected="selected"'; } ?>><?php  echo $row['nome_pais']; ?> </option> 
            
                         
        </select>
         <a href="remover_pais.php?idr=<?php  echo $id; ?>&id=<?php  echo $row['idpaises']; ?>"> (x) Remover esse país </a>
			
            
            <?php } ?>	      
               
        </label>
        </div>
<?php } ?>
      </p>  
                
			      <p>
			        <input class="button"type="submit"value="Atualizar Roteiro"/>
		          </p>
		        </fieldset>
			    <div class="clear"></div>
			    <!-- End .clear -->
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