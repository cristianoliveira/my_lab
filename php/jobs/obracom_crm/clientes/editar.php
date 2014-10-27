<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");
include("../models/clientes_model.php");

//Pega Dados e Mostra-os.
$clientes  = new ClientesModel();

$idcliente = $clientes->getParameterId();
$cliente   = $clientes->getWhere("idcliente = $idcliente");

if(empty($cliente))
   header('Location:listar.php');
        
$clientes_tab = $clientes_gerenciar = "current";

?>
<script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" media="screen" />
     
    <script type="text/javascript">
        $(document).ready(function() {

            $("a#example1").fancybox();

        });
    </script>


<body class="destaques formulario">

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
                    <h2>Editar uma Categoria</h2>
            
            <p id="page-intro">Utilize o formulário abaixo para editar uma categoria no site.</p>
            
            <?php showSessionMessage(); ?>
            
        <div class="content-box"><!-- Start Content Box -->

        <div class="content-box-header">
            <h3>Dados Cliente</h3>
                
                <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
                <form id="clientes_form" class="form-default" action="acao.php?a=2" method="post" enctype="multipart/form-data">    
                    <fieldset>
                            <input class ="text-input medium-input required"
                                    type  ="hidden"
                                    id    ="id"
                                    name  ="id"
                                    maxlength="255"
                                    value="<?= $cliente[0]['idcliente'] ?>" 
                                    required/>

                        <div>
                            <label>Nome</label>
                            <input class ="text-input medium-input required"
                                    type  ="text"
                                    id    ="nome_cliente"
                                    name  ="nome_cliente"
                                    maxlength="255"
                                    value="<?= $cliente[0]['nome_cliente'] ?>" 
                                    required/>
                        </div>
                        <div>
                            <label>CPF</label>
                            <input class="text-input medium-input required"
                                    type ="text"
                                    id   ="cpf"
                                    name ="cpf"
                                    maxlength="255"
                                    value="<?= $cliente[0]['cpf'] ?>" required/>
                        </div>
                        <div>
                            <label>Sexo</label>
                            <select name="genero" id="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div>
                            <label>Data Nascimento</label>
                            <input class="text-input medium-input required"
                                    type ="date"
                                    id   ="nascimento"
                                    name ="nascimento"
                                    maxlength="255"
                                    value="<?= $cliente[0]['nome_cliente'] ?>"/>
                        </div>
                        <div>
                            <label>Telefone Principal</label>
                            <input class="text-input small-input required"
                                    type ="phone"
                                    id   ="telefone_principal_prefix"
                                    name ="telefone_principal_prefix"
                                    maxlength="3"
                                    value="<?= substr($cliente[0]['telefone_principal'], 0 , 3) ?>" 
                                    required/>
                            <input class="text-input medium-input required"
                                    type ="phone"
                                    id   ="telefone_principal"
                                    name ="telefone_principal"
                                    maxlength="9"
                                    value="<?= substr($cliente[0]['telefone_principal'], 3, strlen($cliente[0]['telefone_principal'])-3) ?>" 
                                    required/>
                        </div>
                        <div>
                            <label>Email</label>
                            <input class="text-input medium-input required"
                                    type ="email"
                                    id   ="email_cliente"
                                    name ="email_cliente"
                                    maxlength="255"
                                    value="<?= $cliente[0]['email_cliente'] ?>" 
                                    required/>
                        </div>
                        <div>
                            <label>Senha</label>
                            <input class="text-input medium-input required"
                                    type ="password"
                                    id   ="senha"
                                    name ="senha"
                                    maxlength="255"
                                    value="<?= $cliente[0]['senha'] ?>" 
                                    required/>
                        </div>
                        <div>
                            <input class="button"type="submit"value="Alterar"/>
                        </div>
                     </fieldset>

                    <div class="clear"></div><!-- End .clear -->
                </form>

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
