<?php  
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/models/produtos_model.php");
include("../includes/models/categorias_model.php");
include("../includes/helpers/variaveis_helper.php");

include("../includes/cabecalho.php"); 

    $produtos   = new ProdutosModel();
    $categorias = new CategoriasModel();

    //TODO melhorar isto...
    $numreg         = 10;  
    $_GET['pg']   = Parameter::GET('pg', 0);
    $inicial      = $_GET['pg'] * 10;
    $_GET['p']    = Parameter::GET('p', 0);
    $_GET['g']    = Parameter::GET('g', 0);
    
            
    $listProdutos = $produtos->getLimit($inicial, $numreg, Parameter::GET('ordem'));
    $quantreg     = $produtos->getCount(); // Quantidade de registros pra paginação

    $produtos_tab  = $produtos_tab_gerenciar = "current";
?>


<body class="produtos lista">

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->        
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
        <h2>Lista de Produtos</h2>
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
                            <th class="current"><a href="listar.php?ordem=nome&desc=1" class="down">Nome</a></th>
                            <th class="current"><a href="listar.php?ordem=categoria_id&desc=1" class="down">Categoria</a></th>
                            <th class="current mascara-valor"><a href="listar.php?ordem=valor_original&desc=1" class="down">Valor</a></th>
                            <th class="current">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php  $cont = 0; ?>
                    <?php foreach ($listProdutos as $produto) { ?>
                    <?php $categoria = $categorias->getById($produto['categoria_id']); ?>
                    
                        <tr>
                            <td class="current">
                                    <?php echo $produto['nome']; ?>
                            </td>
                            <td class="current">
                                    <?php echo $categoria['nome']; ?>
                            </td>
                            <td class="current mascara-valor" >
                                    <?php echo str_replace('.',',',$produto['valor_original']); ?>
                            </td>

                            <td nowrap><!-- Icons -->
                                <a href="editar.php?id=<?= $produto['id']; ?>"title="Editar o produto"> 
                                    <img src="../imagens/icones/pencil.png"alt="Editar" border="0" align="left" style="padding-left:10px;" /> 
                                </a>
                                <a href="editar.php?galeria=1&id=<?= $produto['id']; ?>" title="Editar as imagens do produto.">
                                    <img src="../imagens/pdf.png" width="20" height="20" alt="Galeria" align="left" style="padding-left:10px;" />
                                </a>
                                <a href="acao.php?a=3&id=<?= $produto['id']; ?>" title="Excluir o produto" class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse item?')) return false;">
                                    <img src="../imagens/icones/cross.png"alt="Excluir" hspace="5" border="0" align="left" style="padding-left:10px;" /> 
                                </a>
                            </td>
                        </tr>
                                
                    <?php } ?>
                </tbody>
                <tfoot>
                        <tr>
                            <td colspan="7">

                                <?php  include("../includes/_paginate.php"); ?>
                                
                                <div class="clear"></div>
                            </td>
                        </tr>
                    </tfoot>
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
