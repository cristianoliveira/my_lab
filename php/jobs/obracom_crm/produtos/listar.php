<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");
include("../models/produtos_model.php");
include("../models/categorias_model.php");

    $produtos   = new ProdutosModel();
	$categorias = new CategoriasModel();

	$numreg   = 10; 
    $inicial  = isset($_GET['pg']) ? ($_GET['pg'] * $numreg) : 0;
            
    $listProdutos = $produtos->getLimit($inicial, $numreg);
    $quantreg     = $produtos->getCount(); // Quantidade de registros pra paginação

$_COOKIE["produtos"] = "current";
$_COOKIE["produtos1"]  = "";
$_COOKIE["produtos2"]  = "current";
?>


<body class="produtos lista">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
		<h2>Lista de Produtos cadastrados</h2>
		<p id="page-intro">Abaixo estão todos os produtos cadastrados no site, bem como em qual categoria. </p>
        <?php  showSessionMessage(); ?>
		<div class="content-box"><!-- Start Content Box -->

		  <div class="content-box-header">

				<h3>Produtos</h3>

				<input type="button" value="Cadastrar novo produto" class="produto button botao-cadastrar" onClick="javascript: location.href='cadastro.php?p=2&g=1';">

				<div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">

				<table width="592">

					<thead>
						<tr>
						  <th class="current"><a href="/produtos/ordenar-por/nome/ordem/desc" class="down">Nome</a></th>
                          <th class="current"><a href="/produtos/ordenar-por/nome/ordem/desc" class="down">Categoria</a></th>
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
                    <?php  $cont = 0; ?>
                    <?php foreach ($listProdutos as $produto) { ?>
                    <?php $categoria = $categorias->getById($produto['categoria_id']); ?>
                    
						<tr>
							<td class="current">
								<a href="/produto/editar/3" title="Editar produto &quot;Cadeira&quot;">
									<?php echo $produto['nome_produto']; ?>
								</a>
							</td>
							<td class="current">
								<a href="/produto/editar/3" title="Editar produto &quot;Cadeira&quot;">
									<?php echo $categoria['nome_categoria']; ?>
								</a>
							</td>
							<td nowrap><!-- Icons -->
								<a href="editar.php?id=<?php echo $produto['idprodutos']; ?>"title="Editar o produto"> 
									<img src="../imagens/icones/pencil.png"alt="Editar" border="0" align="left" style="padding-left:10px;" /> 
								</a>
								<a href="galeria.php?id=<?php echo $produto['idprodutos']; ?>" title="Editar os downloads de cada produto.">
									<img src="../imagens/pdf.png" width="20" height="20" alt="Galeria" align="left" style="padding-left:10px;" />
								</a>
								<a href="acao.php?a=3&id=<?php echo $produto['idprodutos']; ?>" title="Excluir o produto" class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse item?')) return false;">
									<img src="../imagens/icones/cross.png"alt="Excluir" hspace="5" border="0" align="left" style="padding-left:10px;" /> 
								</a>
							</td>
						</tr>
                                
                    <?php } ?>
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
		
	</div>
  </body>
</html>
