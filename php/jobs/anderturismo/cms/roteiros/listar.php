<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

//######### INICIO Paginação
        $numreg = 50; // Quantos registros por página vai ser mostrado
        if (!isset($_GET['pg'])) {
                @$_GET['pg'] = 0;
        }
        $inicial = $_GET['pg'] * $numreg;
        
//######### FIM dados Paginação
@$pegaOrdem = $_GET["ordem"];
@$identico  = $_GET["identificacao"];

if(@$identico!=""){ $sql = mysql_query("SELECT * FROM roteiros WHERE identificacao LIKE '%$identico%' LIMIT $inicial, $numreg"); 
	$sql_conta = mysql_query("SELECT * FROM roteiros");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
}
else{
if(@$pegaOrdem!=""){ $sql = mysql_query("SELECT * FROM roteiros ORDER BY nome_roteiro $pegaOrdem LIMIT $inicial, $numreg");}
 else{  $sql = mysql_query("SELECT * FROM roteiros LIMIT $inicial, $numreg"); }           

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM roteiros");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
}

$_COOKIE["roteiros"] = "current";
$_COOKIE["roteiros1"]  = "";
$_COOKIE["roteiros2"]  = "current";
?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<body class="produtos lista">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
		<h2>Lista de Roteiros cadastrados</h2>
		<p id="page-intro"> Utilize as nossas ferramentas de seleção e código para encontrar mais facilmente seu roteiro cadastrado. </p>
 <?php  if(@$_SESSION['erro']!="") { ?>
<div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
            	<div>
        <form name="form" id="form">
			  <select name="ordem" id="ordem" onChange="MM_jumpMenu('parent',this,0)" style="float:left">
              <option value=""> --- Selecione a opção -- </option>
			    <option value="listar.php?ordem=asc"> NOME A-Z (Crescente) </option>
                <option value="listar.php?ordem=desc"> NOME Z-A (Decrescente) </option>
		      </select>
	  </form>

</div><div>
      <form name="procurar" id="procurar" action="listar.php" method="get">
      <input class="text-input small-input required" type="text" id="identificacao" name="identificacao" maxlength="255" placeholder="Digite aqui o código do roteiro" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
      <input type="submit" value="Buscar" />
      </form>
      </div>
      <div style="height:10px;"> </div>
		<div class="content-box"><!-- Start Content Box -->

		  <div class="content-box-header">

				<h3>Roteiros</h3>

				<input type="button" value="Cadastrar novo roteiro" class="produto button botao-cadastrar" onClick="javascript: location.href='cadastro.php?p=2&g=1';">

				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">

				<table width="592">

					<thead>
						<tr>
						  <th class="current"><a href="/produtos/ordenar-por/nome/ordem/desc" class="down">Nome do Roteiro</a></th>
                          <th class="current"><a href="/produtos/ordenar-por/nome/ordem/desc" class="down">Status</a></th>
                           <th class="current">Código Controle</th>
							<th class="current">Ações</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<td colspan="7">

								<?php  include("../includes/_paginate.php"); ?>
								
								<div class="clear"></div>
							</td>
						</tr>
					</tfoot>

					<tbody>
                    <?php  $cont = 0;
// Exibe o resultado da nossa consulta
while ($row = mysql_fetch_array($sql))
{ 

?>
														<tr <?php if($row['status_roteiro']==2){?> style="background-color:#ffebeb"  <?php } ?>>
														  <td><a href="/produto/editar/3" title="Editar produto &quot;Cadeira&quot;">
														   <?php echo $row['nome_roteiro']; ?>
														    </a></td>
                                                            
                                                          <td><a href="/produto/editar/3" title="Editar produto &quot;Cadeira&quot;">
														    <?php 
															if($row['status_roteiro']==1){ print "Ativo"; } 
															if($row['status_roteiro']==2){ print "Pausado"; }
															if($row['status_roteiro']==3){ print "Inativo"; }
															?>
														    </a></td>
                                                            <td class=""><?php echo  $row['identificacao']; ?></td>
									<td nowrap>
             <!-- Icons -->
<a href="editar.php?id=<?php echo $row['idroteiros']; ?>"title="Editar o roteiro"> <img src="../imagens/icones/pencil.png"alt="Editar" border="0" align="left" style="padding-right:10px;" /> </a> 

 <a href="pause.php?id=<?php echo $row['idroteiros']; ?>" title="Pausar Hotel" class="item-confirmar"  onclick="if(!confirm('Nesta AÇÃO você ativa ou remove a visualização do roteiro na busca do site. Está certo disso?')) return false;"> 
 <img <?php if($row['status_roteiro']==2){?> src="../imagens/icones/pause-on.png" <?php } else{ ?>src="../imagens/icones/pause.png" <?php } ?> alt="Galeria de Imagens" hspace="5" border="0" align="left" style="margin-right:8px;" align="left" />
 </a>

<a href="galeria.php?id=<?php echo $row['idroteiros']; ?>" title="Gerenciar galeria de cada roteiro."><img src="../imagens/galeria.gif" width="20" height="20" alt="Galeria" align="left" style="padding-left:10px;" /></a>

<a href="acao.php?a=3&id=<?php echo $row['idroteiros']; ?>" title="Excluir o roteiro" class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse roteiro? Esta ação é sem volta. Junto removerá também TODA a galeria de imagens desse roteiro.')) return false;"><img src="../imagens/icones/cross.png"alt="Excluir" hspace="5" border="0" align="left" style="padding-left:10px;" /> </a>

       

            
            </td>
								                    </tr>
                              <?php  
$cont = $cont + 1;
}
?>  
                                
                                
												</tbody>

				</table>

		  </div> <!-- End .content-box-content -->

		</div> <!-- End .content-box -->


			<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						&#169; Copyright 2014 Obra Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>
