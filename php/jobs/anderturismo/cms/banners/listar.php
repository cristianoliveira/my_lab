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
        $sql = mysql_query("SELECT * FROM banners LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM banners");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação

$_COOKIE["banners"]="current";
$_COOKIE["banners1"]="";
$_COOKIE["banners2"]="current";
?>

<body class="destaques lista">

<table width=100% cellpading=0 cellspacing=0>
</table>

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
		<h2>Lista de Banners cadastrados</h2>
		<p id="page-intro">Abaixo estão listados todos os destaques que são exibidos na página inicial do site.</p>
		 <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>
		
  <div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

				<h3>Destaques</h3>
			  <input class="destaques button botao-cadastrar" type="button" value="Cadastrar um banner"  onclick="javascript: location.href='cadastro.php?p=1&g=1';"  />
			  <div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">

				<table>

					<thead>
						<tr>
							<th class="current"><a href="#"class="down">Título</a></th>
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
<?php  $cont = 0;
// Exibe o resultado da nossa consulta
while ($row = mysql_fetch_array($sql))
{ 
?>
                    
														<tr colspan="2">
									<td>
										<a href="editar.php?a=2&id=<?php echo $row['idbanners']; ?>"> <?php echo $row['titulo_principal'] ; ?> </a>
                                    </td>
                                    <td>
										<!-- Icons -->
										<a href="editar.php?a=2&id=<?php echo $row['idbanners']; ?>" title="Editar o banner.">
											<img src="../imagens/icones/pencil.png"alt="Editar"/>
										</a>
										<a href="acao.php?a=3&id=<?php echo $row['idbanners']; ?>" title="Excluir o banner." class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse banner? ')) return false;">
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
