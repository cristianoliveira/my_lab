<?php  
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/helpers/variaveis_helper.php");
include("../includes/models/categorias_model.php");

include("../includes/cabecalho.php"); 

    $categorias = new CategoriasModel();

    //Sem tempo para arrumar GO HORSE
    $numreg         = 10;  
    $_GET['pg']   = Parameter::GET('pg', 0);
    $inicial      = $_GET['pg'] * 10;
    $_GET['p']    = Parameter::GET('p', 0);
    $_GET['g']    = Parameter::GET('g', 0);
    
    $orderBy        = Parameter::GET('ordem','');    
    $listcategorias = $categorias->getLimit($inicial, $numreg, $orderBy);
    $quantreg       = $categorias->getCount();


    $categorias_tab = $categorias_gerenciar = "current";
?>

<body>

        <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Lista de Categorias</h2>
            <p id="page-intro">Abaixo estão listados todos os categorias.</p>
            
			<?php  showSessionMessage(); ?>
            
                  <div class="content-box"><!-- Start Content Box -->

                        <div class="content-box-header">

                            <h3>Categorias</h3>
                          <input class="destaques button botao-cadastrar" 
                                 type="button" 
                                 value="Cadastrar nova categoria"  
                                 onclick="javascript: location.href='cadastro.php?p=8&g=1';"  />
                          <div class="clear"></div>

                        </div> <!-- End .content-box-header -->

                    <div class="content-box-content">

                        <table>

                            <thead>
                                <tr>
                                    <th class="current"><a href="<?= site_url('categorias/listar.php?ordem=nome&desc=1') ?>"
                                        class="down">Título</a></th>                            
                                    <th class="">&nbsp;</th>                            
                                    <th>Ações</th>
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
                                        <a href="editar.php?id=<?= $categoria['id'] ?>" title=""> 
                                            <?php echo $categoria['nome'] ; ?> 
                                        </a>
                                    </td>
                                    <td class="">
                                        &nbsp;
                                    </td>
                                    <td>
                                        <!-- Icons -->
                                        <a href="editar.php?id=<?php echo $categoria['id']; ?>"title="Editar o categoria.">
                                            <img src="../imagens/icones/pencil.png"alt="Editar"/>
                                        </a>
                                        <a href="acao.php?a=3&id=<?php echo $categoria['id']; ?>" 
                                           title="Excluir a categoria" class="item-confirmar"  
                                           onclick="if(!confirm('Você tem certeza que deseja excluir?')) return false;" >
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
