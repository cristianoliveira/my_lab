<?php  
include("../includes/cabecalho.php");
include("../includes/check_authentication.php");
include("../includes/functions.php");
include("../includes/logs.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/helpers/mensagem_helper.php");

$pagseguro_tab = $pagseguro_procurar = "current";

?>
<body>

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
            <h2>Detalhamento da Transação</h2>
            
            <?php showSessionMessage(); ?>
            
        <div class="content-box"><!-- Start Content Box -->

        <div class="content-box-header">
            <h3>Dados da Transação</h3>
                
                <div class="clear"></div>
                <a class="produto button botao-cadastrar" href="../pagseguro/listar.php">
                    Voltar
                </a>

            </div> <!-- End .content-box-header -->

             <div class="content-box-content">
                    <form id="form-cliente" class="form-default" method="get" action="detalhes.php"  >
                        <div class="pessoa_fisica">
                            <label>Código &#42;</label>
                            <input type="text" 
                                   class="text-input large-input required" 
                                   id="codigo" 
                                   name="codigo" 
                                   maxlength="100" 
                                   value="" 
                            />
                        </div>
                         <div class="continuar">
                            <button type="submit">Buscar    </button>
                        </div>
                    </form>
              
            </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->


            <div id="footer">
                <small> <!-- Remove this notice or replace it with whatever you want -->
                        &#169; Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
                </small>
            </div><!-- End #footer -->
            
        </div> <!-- End #main-content -->
        
    </div>
</body>
  
</html>
