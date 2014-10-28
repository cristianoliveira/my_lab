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
        $sql = mysql_query("SELECT * FROM empresa LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM empresa");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
        
$_COOKIE["empresa"]="current";
$_COOKIE["classe1"]="current";
?>

<body class="destaques lista">

<table width=100% cellpading=0 cellspacing=0>
</table>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
<h2>Bem-vindo(a), <?php  echo @$_SESSION['nome_usuario']; ?>.</h2>
        <p id="page-intro">Escolha uma das opções no menu ao lado ou abaixo e administre o seu site.</p>
         <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>    
            <?php  $_SESSION['erro']=""; } ?>
            
            <?php  if(@$_SESSION['ok']!="") { ?>
            <div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
            <?php  $_SESSION['ok']=""; } ?>
        
  <div class="content-box"><!-- Start Content Box -->

            <div class="content-box-header">

                <h3>Empresa</h3>
              <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
<?php  $cont = 0;

if(mysql_num_rows($sql)!=""){ 
?>
                <table>

                    <thead>
                        <tr>
                            <th class="current"><a href="#"class="down">Conteúdo</a></th>                            <th class="current">&nbsp;</th>                            <th class="current">Ações</th>
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
                    
                                                        <tr>
                                    <td>
                                        <a href="editar.php?p=4&g=2&id=<?php echo $row['idempresa']; ?>" title="Editar o conteúdo."> A Empresa </a>
                                    </td>
                                    <td class="">&nbsp;</td>
                                    <td>
                                        <!-- Icons -->
                                        <a href="editar.php?p=4&g=2&id=<?php echo $row['idempresa']; ?>" title="Editar o conteúdo.">
                                            <img src="../imagens/icones/pencil.png"alt="Editar"/>
                                        </a></td>
                                </tr>
<?php  
$cont = $cont + 1;
}
?>
                                                </tbody>

                </table>
                <?php } else{ echo "Não há conteúdo cadastrado no momento."; } ?>

      </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->


            <div id="footer">
                <small> <!-- Remove this notice or replace it with whatever you want -->
                        &#169; Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
                </small>
            </div><!-- End #footer -->
            
        </div> <!-- End #main-content -->
        
    </div></body>
  
</html>
