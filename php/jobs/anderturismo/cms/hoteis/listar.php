<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

//######### INICIO Paginação
        $numreg = 10; // Quantos registros por página vai ser mostrado
        if (!isset($_GET['pg'])) {
                @$_GET['pg'] = 0;
        }
        $inicial = $_GET['pg'] * $numreg;
        
//######### FIM dados Paginação
@$pegaOrdem = $_GET["ordem"];
@$identico  = $_GET["identificacao"];

if(@$identico!=""){ $sql = mysql_query("SELECT * FROM hoteis WHERE identificacao LIKE '%$identico%' LIMIT $inicial, $numreg"); 
	$sql_conta = mysql_query("SELECT * FROM hoteis");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
}
else{
if(@$pegaOrdem!=""){ $sql = mysql_query("SELECT * FROM hoteis ORDER BY nome_hotel $pegaOrdem LIMIT $inicial, $numreg");}
 else{  $sql = mysql_query("SELECT * FROM hoteis LIMIT $inicial, $numreg"); }           

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM hoteis");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
}
$_COOKIE["hoteis"]="current";	
$_COOKIE["hoteis1"]="";
$_COOKIE["hoteis2"]="current";
?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<body class="destaques lista">

<table width=100% cellpading=0 cellspacing=0>
</table>

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
		<h2>Lista de Hotéis Cadastrados</h2>
		<p id="page-intro">Abaixo estão listados todos hotéis que são exibidos no site.</p>
		 <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
            
           <?php  if(@$_SESSION['ok2']==1) { ?>
			<div class="notification attention png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> Esse hotel já existe. </strong> Cadastre novamente.</div></div>
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
      <input class="text-input small-input required" type="text" id="identificacao" name="identificacao" maxlength="255" placeholder="Digite aqui o código do hotel" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
      <input type="submit" value="Buscar" />
      </form>
      </div>
      <div style="height:10px;"> </div>  
    	
  <div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

				<h3>Hotéis</h3>
			  <input class="destaques button botao-cadastrar" type="button" value="Cadastrar um Hotel"  onclick="javascript: location.href='cadastro.php';"  />
			  <div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">

<?php
if(mysql_num_rows($sql)>0){
	?>
				<table>

					<thead>
						<tr>
							<th class="current"><a href="#">Nome do Hotel</a></th>	
                            <th class="current">Status</th>
                            <th class="current">Código Controle</th>
                            <th class="current">Ações</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<td colspan="3">
<?php  include("../includes/_paginate.php"); ?>
								 <!-- End .pagination -->								
								<div class="clear"></div>
							</td>
						</tr>
					</tfoot>

					<tbody>
<?php  

$cont = 0;
// Exibe o resultado da nossa consulta
while ($row = mysql_fetch_array($sql))
{
$ativo = $row['status'];
switch ($ativo) {
    case 1: @$status="Ativo"; break;
    case 2: @$status="Pausado"; break;
}
?>
                    
														<tr <?php if($row['status']==2){?> style="background-color:#ffebeb"  <?php } ?>>
									<td >
										<a href="editar.php?id=<?php echo $row['idhoteis'] ; ?>" title="Edit"> <?php echo $row['nome_hotel'] ; ?> </a>
                                    </td>
									<td class=""><?php echo @$status; ?></td>
                                    <td class=""><?php echo  $row['identificacao']; ?></td>
                                    <td>
										<!-- Icons -->
										<a href="editar.php?id=<?php echo $row['idhoteis']; ?>"title="Editar hotel">
											<img src="../imagens/icones/pencil.png" alt="Editar" align="left" style="margin-right:8px;" />
										</a>
                                        
                                         <a href="pause.php?id=<?php echo $row['idhoteis']; ?>" title="Pausar Hotel" class="item-confirmar"  onclick="if(!confirm('Nesta AÇÃO você irá retirar a visualização do hotel na busca do site. Está certo disso?')) return false;"> 
                                        	<img <?php if($row['status']==2){?> src="../imagens/icones/pause-on.png" <?php } else{ ?>src="../imagens/icones/pause.png" <?php } ?>alt="Galeria de Imagens" hspace="5" border="0" align="left" style="margin-right:8px;" align="left" />
                                        </a>
                                        
                                        
                                        <a href="galeria.php?id=<?php echo $row['idhoteis']; ?>" title="Galeria de Imagens" class="item-confirmar"> 
                                        	<img src="../imagens/icones/galeria.gif" alt="Galeria de Imagens" hspace="5" border="0" align="left" style="margin-right:8px;" align="left" />
                                        </a>
                                        
                                        
										<a href="acao.php?a=3&id=<?php echo $row['idhoteis']; ?>" title="Excluir hotel" class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse hotel? VERIFIQUE SE NÃO HÁ APARTAMENTOS CADASTRADOS.')) return false;">
											<img src="../imagens/icones/cross.png"alt="Excluir"/>
										</a>
									</td>
								</tr>
<?php  
$cont = $cont + 1;
 }

?>
												</tbody>

				</table>
<?php } else { echo "Nenhuma notícia encontrada."; } ?>
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
