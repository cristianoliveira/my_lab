<?php  
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/cabecalho.php"); 
include($_SERVER['DOCUMENT_ROOT'].'/includes/check_authentication.php');
include($_SERVER['DOCUMENT_ROOT']."/includes/logs.php");

include($_SERVER['DOCUMENT_ROOT']."/includes/helpers/variaveis_helper.php");

include($_SERVER['DOCUMENT_ROOT'].'/includes/models/pagseguro_model.php');

    
    $pagseguro      = new PagSeguroModel();

     //    $listTransacoes = $pagseguro->getTransacoesDesde($data);

    $numreg        = 10; 
    $_GET['pg']    =  $inicial = Parameter::GET('pg', 0);
    $orderBy       = Parameter::GET('ordem','');
    $quantreg      = 50;//count($listTransacoes);
    $pagseguro_tab = $pagseguro_gerenciar = "current";
?>

<script type="text/javascript">

var pagina = 0;

$(function(){
    var pagina = 0;
    $.get("ajax.php?acao=consulta_pagseguro",function(data){
        $('#lista-transacoes tbody').html(data);
    });

    $("#proxima-pagina").click(function(){
        $("#lista-transacoes tbody").html("<tr><td>Buscando dados...</td></tr>");
        pagina++;
        $.get("ajax.php?acao=consulta_pagseguro&pagina="+pagina,function(data){
             $('#lista-transacoes tbody').html(data);
             
        })
    });

    $("#anterior-pagina").click(function(){
    $("#lista-transacoes tbody").html("<tr><td>Buscando dados...</td></tr>");
        pagina--;
        $.get("ajax.php?acao=consulta_pagseguro&pagina="+pagina,function(data){
            $('#lista-transacoes tbody').html(data);
        })
    });
})




</script>

<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include($_SERVER['DOCUMENT_ROOT']."/includes/sidebar.php"); ?></div> <!-- End #sidebar -->        
        <div id="main-content"> <!-- Main Content Section with everything -->

            <!-- Page Head -->
            <h2>Lista de transações do PagSeguro</h2>
            <p id="page-intro">Abaixo estão todas as transações referente ao pagseguro cia@ciadoescritorio.com.br. Nos últimos 30 dias.</p>
               
               <?php showSessionMessage(); ?>
            
            <div class="content-box"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>Transações</h3>
                    <input type="button" value="Consultar por código" 
                            class="produto button botao-cadastrar" 
                            onClick="javascript: location.href='consulta.php';">

                    <div class="clear"></div>
                    </div> <!-- End .content-box-header -->

                <div class="content-box-content">
                    <table id="lista-transacoes" width="592">
                        <thead>
                            <tr>
                                <th class="current">
                                    Código
                                </th>
                                <th class="current">
                                    Data
                                </th>
                                <th class="current">
                                    Cliente
                                </th>
                                <th class="current">
                                    Meio Pagamento
                                </th>
                                <th class="current">
                                    Status
                                </th>
                                <th class="current">
                                    Valor
                                </th>
                                <th class="current">&nbsp;</th>
                                <th class="current">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    Consultando dados do pagseguro...
                                </td>
                            </tr>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <td colspan="7">

                                    <div class="pagination">
                                        <a id="anterior-pagina" href="#">&laquo; anterior</a>
                                        <a id="proxima-pagina" href="#">próximo &raquo;</a>
                                    </div>
                                    
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
