<?php  
include("../includes/functions.php");
include('../includes/check_authentication.php');
include("../includes/logs.php");

include("../includes/models/empresas_model.php");
include("../includes/helpers/variaveis_helper.php");

include("../includes/cabecalho.php"); 

    $empresas = new EmpresasModel();

    
    //TODO melhorar isto...
    $numreg       = 10; 
    $_GET['pg']   = Parameter::GET('pg', 0);
    $inicial      = $_GET['pg'] * 10;
    $_GET['p']    = Parameter::GET('p', 0);
    $_GET['g']    = Parameter::GET('g', 0);
    
    $orderBy      = Parameter::GET('ordem','');
    $listempresas = $empresas->getLimit(0, 1, null);

    $empresa_tab = $empresa_gerenciar = "current";
?>
<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->        
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Detalhes empresa</h2>
            <p id="page-intro">Descrição sobre a empresa. </p>
               
               <?php showSessionMessage(); ?>
            
            <div class="content-box"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>Empresa</h3>
                    <div class="clear"></div>
                    </div> <!-- End .content-box-header -->

                <div class="content-box-content">
                    <table width="592">
                        <thead>
                            <tr>
                                <th class="current">
                                    Detalhes
                                </th>
                                <th class="current">&nbsp;</th>
                                <th class="current">&nbsp;</th>
                                <th class="current">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($listempresas as $empresa) {  ?>
                                <tr>
                                    <td>
                                        <strong>Slogan</strong>
                                    </td>
                                    <td>
                                        <?php echo if_exist($empresa['slogan']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong> Descrição </strong>
                                    </td>
                                    <td>
                                        <?php echo $empresa['descricao']; ?>
                                    </td>   
                                    <td>&nbsp;</td>
                                    <td nowrap><!-- Icons -->
                                        <a href="editar.php?id=<?= $empresa['id']; ?>" 
                                            title="Editar a empresa"> 
                                                <img src="../imagens/icones/pencil.png"alt="Editar" border="0" align="left"/> 
                                        </a> 
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    
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
