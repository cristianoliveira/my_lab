<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");
include("../includes/models/categorias_model.php");

    $categorias = new CategoriasModel();

    paginacao(10);
        
    $listcategorias = $categorias->getLimit($inicial, $numreg);
    $quantreg       = $categorias->getCount();

    $categorias_tab = $categorias_gerenciar = "current";
?>

<body>

        <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Lista de Usuários cadastrados</h2>
            <p id="page-intro">Abaixo estão listados todos os usuários.</p>
            
			<?php  showSessionMessage(); ?>
            
                  <div class="content-box"><!-- Start Content Box -->

                        <div class="content-box-header">

                            <h3>Destaques</h3>
                          <input class="destaques button botao-cadastrar" type="button" value="Cadastrar um usuário"  onclick="javascript: location.href='cadastro.php?p=8&g=1';"  />
                          <div class="clear"></div>

                        </div> <!-- End .content-box-header -->

                    <div class="content-box-content">

                        <table>

                            <thead>
                                <tr>
                                    <th class="current"><a href="#"class="down">Título</a></th>                            <th class="">&nbsp;</th>                            <th>Ações</th>
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
                            <?php  foreach($listcategorias as $categoria) { ?>
                                <tr>
                                    <td class="current">
                                        <a href="#" title=""> <?php echo $categoria['nome'] ; ?> </a>
                                    </td>
                                    <td class="">
                                        &nbsp;
                                    </td>
                                    <td>
                                        <!-- Icons -->
                                        <a href="editar.php?p=8&g=2&id=<?php echo $categoria['id']; ?>"title="Editar o usuário.">
                                            <img src="../imagens/icones/pencil.png"alt="Editar"/>
                                        </a>
                                        <a href="acao.php?a=3&id=<?php echo $categoria['id']; ?>" 
                                           title="Excluir a categoria" class="item-confirmar"  
                                           onclick="if(!confirm('Você tem certeza que deseja excluir essa categoria?')) return false;" >
                                            <img src="../imagens/icones/cross.png"alt="Excluir"/>
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
                            © Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
                    </small>
                </div><!-- End #footer -->
                
            </div> <!-- End #main-content -->
            
        </div>
    </body>
</html>
