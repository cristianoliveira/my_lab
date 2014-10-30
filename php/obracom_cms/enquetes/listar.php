<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
// include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/models/enquetes_model.php");
include("../includes/helpers/variaveis_helper.php");

    $enquetes = new EnquetesModel();

    $numreg     = 10; 
    $_GET['pg'] = $inicial  = isset($_GET['pg']) ? ($_GET['pg'] * $numreg) : 0;
        
    $quantreg     = $enquetes->getCount();
    $listEnquetes = $enquetes->getLimit($inicial, $numreg);

    $enquetes_tab = $enquetes_gerenciar = "current";
?>
<script> 
confirmaExclusaoenquete = function()
{
    return confirm('Você tem certeza que deseja excluir este item?');
}
</script>

<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->        
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Lista de enquetes cadastrados</h2>
            <p id="page-intro">Abaixo estão todos os enquetes cadastrados no site. </p>
               
               <?php showSessionMessage(); ?>
            
            <div class="content-box"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>Categorias</h3>
                    <input type="button" value="Cadastrar novo enquete" 
                            class="produto button botao-cadastrar" 
                            onClick="javascript: location.href='cadastro.php';">

                    <div class="clear"></div>
                    </div> <!-- End .content-box-header -->

                <div class="content-box-content">
                    <table width="592">
                        <thead>
                            <tr>
                                <th class="current">
                                    <a href="/enquetes/listar.php?ordem=nome&desc=1" class="down">Pergunta</a>
                                </th>
                                <th class="current">
                                    <a href="/enquetes/listar.php?ordem=email&desc=1" class="down">Pergunta Seo</a>
                                </th>
                                <th class="current">
                                    <a href="/enquetes/listar.php?ordem=telefone&desc=1" class="down">Ativa</a>
                                </th>
                                <th class="current">&nbsp;</th>
                                <th class="current">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($listEnquetes as $enquete) {  ?>
                                <tr>
                                    <td>
                                        <a href="editar.php?id=<?= $enquete['id'] ?>" title="Editar enquete">
                                             <?= $enquete['pergunta'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= $enquete['pergunta_seo']; ?>
                                    </td>
                                    <td>
                                        <?= $enquete['ativa'] == 1? "Sim":"Não"; ?>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td nowrap><!-- Icons -->
                                        <a href="editar.php?id=<?= $enquete['id']; ?>" 
                                            title="Editar a enquete"> 
                                                <img src="../imagens/icones/pencil.png"alt="Editar" border="0" align="left"/> 
                                        </a> 
                                        <a href="acao.php?a=3&id=<?= $enquete['id']; ?>" 
                                            title="Excluir a enquete" 
                                            class="item-confirmar"  
                                            onclick="return confirmaExclusaoenquete()"> 
                                                <img src="../imagens/icones/cross.png" alt="Excluir" hspace="5" border="0" align="left"/> 
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
