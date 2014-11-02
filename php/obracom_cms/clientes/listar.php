<?php  
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/cabecalho.php"); 
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_authentication.php');
include($_SERVER['DOCUMENT_ROOT']."/includes/logs.php");

include($_SERVER['DOCUMENT_ROOT']."/includes/models/clientes_model.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/helpers/variaveis_helper.php");

    $clientes = new ClientesModel();

    $numreg       = 10; 
    
    //Sem tempo para arrumar GO HORSE
    $_GET['pg']   = Parameter::GET('pg', 0);
    $inicial      = $_GET['pg'] * 10;
    $_GET['p']    = Parameter::GET('p', 0);
    $_GET['g']    = Parameter::GET('g', 0);
    
    $orderBy      = Parameter::GET('ordem','');
    $quantreg     = $clientes->getCount();
    $listClientes = $clientes->getLimit($inicial, $numreg, $orderBy);

    $clientes_tab = $clientes_gerenciar = "current";
?>
<script> 
confirmaExclusaoCliente = function()
{
    return confirm('Você tem certeza que deseja excluir este cliente?');
}
</script>

<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include($_SERVER['DOCUMENT_ROOT']."/includes/sidebar.php"); ?></div> <!-- End #sidebar -->        
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Lista de Clientes</h2>
            <p id="page-intro">Abaixo estão todos os clientes cadastrados no site. </p>
               
               <?php showSessionMessage(); ?>
            
            <div class="content-box"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>Clientes</h3>
                    <input type="button" value="Cadastrar novo cliente" 
                            class="produto button botao-cadastrar" 
                            onClick="javascript: location.href='cadastro.php';">

                    <div class="clear"></div>
                    </div> <!-- End .content-box-header -->

                <div class="content-box-content">
                    <table width="592">
                        <thead>
                            <tr>
                                <th class="current">
                                    <a href="/clientes/listar.php?ordem=nome&desc=1" class="down">Nome</a>
                                </th>
                                <th class="current">
                                    <a href="/clientes/listar.php?ordem=email&desc=1" class="down">Email</a>
                                </th>
                                <th class="current">
                                    <a href="/clientes/listar.php?ordem=telefone_principal&desc=1" class="down">Telefone Principal</a>
                                </th>
                                <th class="current">&nbsp;</th>
                                <th class="current">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($listClientes as $cliente) {  ?>
                                <tr>
                                    <td>
                                        <a href="editar.php?id=<?= $cliente['id'] ?>" title="Editar cliente">
                                             <?php echo if_null($cliente['nome'], $cliente['razao_social']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $cliente['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cliente['telefone_principal']; ?>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td nowrap><!-- Icons -->
                                        <a href="editar.php?id=<?= $cliente['id']; ?>" 
                                            title="Editar a cliente"> 
                                                <img src="../imagens/icones/pencil.png"alt="Editar" border="0" align="left"/> 
                                        </a> 
                                        <a href="acao.php?a=3&id=<?= $cliente['id']; ?>" 
                                            title="Excluir a cliente" 
                                            class="item-confirmar"  
                                            onclick="return confirmaExclusaoCliente()"> 
                                                <img src="../imagens/icones/cross.png" alt="Excluir" hspace="5" border="0" align="left"/> 
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <td colspan="7">

                                    <?php  include($_SERVER['DOCUMENT_ROOT']."/includes/_paginate.php"); ?>
                                    
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
