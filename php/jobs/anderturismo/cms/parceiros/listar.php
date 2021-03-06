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
        
        // Faz o Select pegando o registro inicial até a quantidade de registros para página
        $sql = mysql_query("SELECT * FROM parceiros LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM parceiros");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação

$_COOKIE["parceiros"]="current";
$_COOKIE["parceiros1"]="";
$_COOKIE["parceiros2"]="current"

?>


<body class="produtos lista">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
		<h2>Lista de Parceiros cadastrados</h2>
		<p id="page-intro">Abaixo estão todos parceiros cadastrados no site. </p>
 <?php  if(@$_SESSION['erro']!="") { ?>
<div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
		<div class="content-box"><!-- Start Content Box -->

		  <div class="content-box-header">

				<h3>Nossos parceiros</h3>

				<input type="button" value="Cadastrar novo parceiro" class="produto button botao-cadastrar" onClick="javascript: location.href='cadastro.php';">

				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">

				<table width="592">

					<thead>
						<tr>
						  <th class="current"><a href="/produtos/ordenar-por/nome/ordem/desc" class="down">Parceiro</a></th>
                          <th class="current">&nbsp;</th>
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
														<tr>
														  <td ><a href="editar.php?p=6&g=2&id=<?php echo $row['idparceiros']; ?>" title="Editar parceiro">
														    <?php echo $row['nome_parceiro']; ?>
														    </a></td>
                                                            
                                                          <td>&nbsp;</td>
									<td nowrap><!-- Icons -->
									  <a href="editar.php?p=6&g=2&id=<?php echo $row['idparceiros']; ?>" title="Editar parceiro"> <img src="../imagens/icones/pencil.png"alt="Editar" border="0" align="left"/> </a> <a href="acao.php?a=3&id=<?php echo $row['idparceiros']; ?>" title="Excluir parceiro" class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse Parceiro?')) return false;"> <img src="../imagens/icones/cross.png"alt="Excluir" hspace="5" border="0" align="left"/> </a></td>
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
