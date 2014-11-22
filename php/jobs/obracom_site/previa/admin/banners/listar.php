<?php  
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/models/banners_model.php");
include("../includes/helpers/variaveis_helper.php");

include("../includes/cabecalho.php"); 

    $banners = new BannersModel();

    //Sem tempo para arrumar GO HORSE
    $numreg         = 10;  
    $_GET['pg']   = Parameter::GET('pg', 0);
    $inicial      = $_GET['pg'] * 10;
    $_GET['p']    = Parameter::GET('p', 0);
    $_GET['g']    = Parameter::GET('g', 0);
    
    $quantreg     = $banners->getCount();
    $listbanners  = $banners->getLimit($inicial, $numreg, Parameter::GET('ordem'));

    $banners_tab = $banners_gerenciar = "current";
?>
<script> 
confirmaExclusaobanner = function()
{
    return confirm('Você tem certeza que deseja excluir este banner?');
}
</script>

<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->        
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Lista de Banners</h2>
            <p id="page-intro">Abaixo estão todos os banners cadastrados no site. </p>
               
               <?php showSessionMessage(); ?>
            
            <div class="content-box"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>Banners</h3>
                    <input type="button" value="Cadastrar novo banner" 
                            class="produto button botao-cadastrar" 
                            onClick="javascript: location.href='cadastro.php';">

                    <div class="clear"></div>
                    </div> <!-- End .content-box-header -->

                <div class="content-box-content">
                    <table width="592">
                        <thead>
                            <tr>
                                <th class="current">
                                    <a href="<?= site_url('banners/listar.php?ordem=&desc=1') ?>" class="down">Titulo</a>
                                </th>
                                <th class="current">
                                    <a href="<?= site_url('banners/listar.php?ordem=link&desc=1') ?>" class="down">Link</a>
                                </th>
                                <th class="current">
                                    <a href="<?= site_url('banners/listar.php?ordem=imagem&desc=1') ?>" class="down">Imagem</a>
                                </th>
                                <th class="current">&nbsp;</th>
                                <th class="current">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($listbanners as $banner) {  ?>
                                <tr>
                                    <td>
                                        <a href="editar.php?id=<?= $banner['id'] ?>" title="Editar banner">
                                             <?= $banner['titulo']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= $banner['link']; ?>
                                    </td>
                                    <td>
                                        <img style="width:100px;" src="<?php echo site_url('uploads/banners/'.$banner['imagem']) ?>" />
                                    </td>
                                    <td>&nbsp;</td>
                                    <td nowrap><!-- Icons -->
                                        <a href="editar.php?id=<?= $banner['id']; ?>" 
                                            title="Editar a banner"> 
                                                <img src="../imagens/icones/pencil.png"alt="Editar" border="0" align="left"/> 
                                        </a> 
                                        <a href="acao.php?a=3&id=<?= $banner['id']; ?>" 
                                            title="Excluir a banner" 
                                            class="item-confirmar"  
                                            onclick="return confirmaExclusaobanner()"> 
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
