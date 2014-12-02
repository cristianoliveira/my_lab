<?php  
include("../includes/cabecalho.php");
include('../includes/check_authentication.php');
include("../includes/database_connection.php");

$_COOKIE["roteiros"] = "current";
$_COOKIE["roteiros1"]  = "current";
$_COOKIE["roteiros2"]  = "";
?>

<body class="produtos form">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
					<h2>Adição de um Roteiro</h2>
                    
			<p id="page-intro">Utilize o formulário abaixo para incluir um roteiro no sistema.</p>
		
					<div class="notification information png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> 
                    	O Status do Roteiro para entrar no ar é o ATIVO. Caso queira apenas cadastrá-lo e não publicar no site, coloque STATUS como PAUSADO.
                    </strong></div></div>

		<div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

									<h3> Dados do Roteiro </h3>
                                    
                                    <ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Capa do Roteiro</a></li> <!-- href must be unique and match the id of target div -->
                        
                        
						<li><a href="#tab2">Parte Interna</a></li>
					</ul>
				
				<div class="clear"></div>

			</div> <!-- End .content-box-header -->
			<div class="content-box-content">

				<form action="acao.php?a=1" name="roteiros_form" id="roteiros_form" method="post" enctype="multipart/form-data">	

					<fieldset>

				<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->			
					  <h3 style="color:#069"> CADASTRE AQUI A PARTE DO ROTEIRO QUE SERÁ A CAPA DELE</h3>
						<p>
							<label>Nome do Roteiro</label>
							<input class="text-input medium-input required" type="text" id="nome" name="nome" value=""  />
						</p>
                        
                        <p>
						  <label>Imagem Principal do Roteiro</label>
					    <input class="text-input small-input" type="file" id="imagem" name="imagem"  /><br />
  <small>O arquivo da foto deve estar no formato JPEG e tamanho de 1024x768 ou superior. A imagem será redimensionada para o tamanho de 1084x310.</small><br>
						</p>
                        
                         <p>
							<label>Datas da Capa</label>
							<input class="text-input medium-input required" type="text" id="datas_completas" name="datas_completas"  /><small> *Datas abaixo do título na descrição do roteiro. </small>
						</p>   
                        
                        <p>                                              

        
        <h3 style="color:#069"> Relacionar Destinos e Países </h3>
		<a id="addPais"><img src="../imagens/additem.png" height="16" width="16" style="vertical-align: middle"> Adicionar </a>
        <a id="removerCampo"><img src="../imagens/remover.gif" height="16" width="16" style="vertical-align: middle"> Remover </a>
        <p> </p>
        

<div id="paises">

        <label for="pais">
        <select name="paises[]" id="paises[]">
        <?php
				$sql = "SELECT * FROM paises ORDER BY idpaises";
						
				$res = mysql_query( $sql );
				while ( $row = mysql_fetch_assoc( $res ) ) {
					echo '<option value="'.$row['idpaises'].'">'.$row['nome_pais'].'</option>';
				}
			?>
        </select>
        
               
               
        </label>
</div>
      </p>
      <p> <a class="button2" href="#tab2"> Próxima Etapa >> </a> </p>
    </div>
    
    
   <div class="tab-content" id="tab2"> 
   
   <h3 style="color:#069"> CADASTRE AQUI A PARTE INTERNA DO ROTEIRO </h3>
      
                        
                        <p>
							<label>Subtítulo do Roteiro</label>
							<input class="text-input medium-input required" type="text" id="subtitulo" name="subtitulo" /><small> *Subtítulo da página interna do roteiro. </small>
						</p>
                        
                                                <p>
							<label>Preço à vista</label>
							<input class="text-input medium-input required" type="text" id="avista" name="avista" />
						</p>
                        
                                                <p>
							<label>Preço parcelado</label>
							<input class="text-input medium-input required" type="text" id="parcelado" name="parcelado" /><small> * Ex: Entrada de R$ xxx,xx + 4x de R$ xxx,xx (Cheques). </small>
						</p>
						
                                                    
                        <p>
						  <label>Data de Início</label>
					    <input class="text-input small-date required" type="text" id="data_inicio" name="data_inicio" />
                        <br />
					  <small>O roteiro permanecerá no site até o período pré-estabelecido. Depois desse período ele ficará guardado.</small><br />
					  </p>
                                                    
                      <p>
						  <label>Data Fim</label>
					    <input class="text-input small-date required" type="text" id="data_fim" name="data_fim" /><br />
					  <small>O roteiro permanecerá no site até o período pré-estabelecido. Depois desse período ele ficará guardado.</small><br />
					  </p> 
                      
                      <p>
			       <label for="dc">Sem data determinada</label>
			       <select name="sem_data" id="sem_data">
                    <option value="0"> Não </option>         
                   <option value="1"> Sim </option>
		            </select>
                    <small> *Este item serve para os roteiros sem datas definidas. Quando setado como <strong>SIM</strong> ele entrará na <strong>HOME</strong> como &quot;<strong>Agende a sua viagem</strong>&quot; e o campo <strong>Datas da Capa</strong> será ignorado.</small>
		          </p> 
<div class="notification attention png_bg">
							<a href="#" class="close"><img src="../imagens/icones/cross_circle.png" title="Ok, entendi. Fechar esta notificação." alt="close" /></a>
							<div>
								As datas definidas são importantes para a BUSCA RÁPIDA e também para programar os roteiros (se eles irão entrar ou não no site).
							</div>
						</div> 

<br>
<br>
                  
                  <h3 style="color:#069"> INFORMAÇÕES ABAIXO DA IMAGEM PRINCIPAL DA PÁGINA DO ROTEIRO </h3>
                      
                                              <p>
							<label>Título Completo</label>
							<input class="text-input medium-input required" type="text" id="titulo_completo" name="titulo_completo"  /><small> *Título na descrição do roteiro. </small>
						</p>
                        
                        
                        
                        <p>
                        <label>Programação Diária </label>
							<textarea class="text-input textarea wysiwyg" id="programacao_diaria" name="programacao_diaria" cols="79" rows="15"></textarea>
                        </p>
                                                   
                  
                  <p>
			       <label for="vp">Selecione o tipo de Viagem </label>
			       <select name="viagens_programadas" id="viagens_programadas">
                    <option value=""> --- VIAGENS PROGRAMADAS --- </option>
                    <option value="0"> Não </option>         
                   <option value="1"> Sim </option>
		            </select>
                    
                   
			       <select name="viagens_grupo" id="viagens_grupo">
                   <option value=""> --- VIAGENS EM GRUPO --- </option>
                    <option value="0"> Não </option>         
                   <option value="1"> Sim </option>
		            </select>
                    
                   
			       <select name="viagens_individuais" id="viagens_individuais">
                   <option value=""> --- VIAGENS INDIVIDUAIS --- </option>
                    <option value="0"> Não </option>         
                   <option value="1"> Sim </option>
		            </select>
		          </p>
                  
                  <p>
			       <label for="dc">Destaque Cabeçalho</label>
			       <select name="destaque_home" id="destaque_home">
                    <option value="0"> Não </option>         
                   <option value="1"> Sim </option>
		            </select>
                    <small> *Este item destaca o roteiro para o cabeçalho da página principal. Em cima das buscas. </small>
		          </p>
                  
                   <p>
			       <label for="df">Texto Destaque (Home)</label>
			       <input class="text-input small-input required" type="text" id="texto_destaque_home" name="texto_destaque_home" maxlength="20" /><br>
                   <small> *Este item é o texto que aparece quando passamos o mouse sobre o roteiro em destaque no cabeçalho. Acima das buscas. Tamanho máximo: 20 caracteres. </small>
		          </p>  
                  
                                    <p>
			       <label for="dr">Destaque Roteiros</label>
			       <select name="destaque_roteiros" id="destaque_roteiros">
                    <option value="0"> Não </option>         
                   <option value="1"> Sim </option>
		            </select>
                    <small> *Este item destaca o roteiro para a o meio do site. Em baixo das buscas. Caso marque esta opção e a de cima (Destaque Cabeçalho) aparecerá em ambos. </small>
		          </p>
                  
                  <p>
			       <label for="tt">Tipo de Transporte</label>
			       <select name="tipo_transporte" id="tipo_transporte">
                    <option value="1"> Terrestre </option>         
                    <option value="2"> Rodoviário </option>
                    <option value="3"> Aéreo </option>
                    <option value="4"> Cruzeiro </option>
                    <option value="5"> Combinados </option>
	              </select>
		          </p> 
                  
                  <p>
			       <label for="fdd">Feriado</label>
			       <select name="feriado" id="feriado">
			<option value="0"> Não </option>         
		   <option value="1"> Sim </option>
		
 
		            </select>
		          </p> 
                  

                  
                                     
                                                
                        
                         <p>                                              
		<label for="lcapas">Qual a capa que vai no PDF?</label>
		<select name="capas" id="capas" class="required">
			<option value="0">-- Escolha uma capa --</option>
			<?php
				$sql = "SELECT *
						FROM capa_roteiros
						ORDER BY idcapas";
				$res = mysql_query( $sql );
				while ( $row = mysql_fetch_assoc( $res ) ) {
					echo '<option value="'.$row['idcapas'].'">'.$row['nome_capa'].'</option>';
				}
			?>
		 </select></p>
         
                              <p>
			       <label for="sr">Status do Roteiro</label>
			       <select name="status_roteiro" id="status_roteiro" class="required">
                    <option value=""> --- SELECIONE O STATUS --- </option>
                    <option value="1"> Ativo </option>         
                    <option value="2"> Pausado </option>
		            </select>
                                        <small> *Este item define se o roteiro estará disponível no site (ou não). </small>
		          </p>               
        
                        
                        <p>
							<input class="button" style="width:300px; height:34px;" type="submit" value="Adicionar Roteiro Novo"/>
                            <a class="button2" href="#tab1" style="float:right"> << Etapa Anterior </a>
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
		
	</div>
    
      
    
    </body>
  
</html>
