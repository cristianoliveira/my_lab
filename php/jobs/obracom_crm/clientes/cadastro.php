<?php  
include("../includes/cabecalho.php");
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
  
  //Menu Sidebar
  $clientes_tab = $clientes_adicionar = "current";
?>

<body class="produtos form">

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->        
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
                    <h2>Adição de Cliente</h2>
            <p id="page-intro">Utilize o formulário abaixo para incluir um Cliente no sistema.</p>
        
        
        <div class="content-box"><!-- Start Content Box -->

            <div class="content-box-header">

                                    <h3>Dados do Cliente.</h3>
                
                <div class="clear"></div>
            </div> <!-- End .content-box-header -->
            <div class="content-box-content">
                <form id="clientes_form" class="form-default" action="acao.php?a=1" method="post" enctype="multipart/form-data">    
                    <fieldset>
                        <div>
                            <label>Nome</label>
                            <input class ="text-input medium-input required"
                                    type  ="text"
                                    id    ="nome_cliente"
                                    name  ="nome_cliente"
                                    maxlength="255"
                                    value="" required/>
                        </div>
                        <div>
                            <label>CPF</label>
                            <input class="text-input medium-input required"
                                    type ="text"
                                    id   ="cpf"
                                    name ="cpf"
                                    maxlength="255"
                                    value="" required/>
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
                                    value=""/>
                        </div>
                        <div>
                            <label>Telefone Principal</label>
                            <input class="text-input small-input required"
                                    type ="phone"
                                    id   ="telefone_principal_prefix"
                                    name ="telefone_principal_prefix"
                                    maxlength="3"
                                    value="" required/>
                            <input class="text-input medium-input required"
                                    type ="phone"
                                    id   ="telefone_principal"
                                    name ="telefone_principal"
                                    maxlength="9"
                                    value="" required/>
                        </div>
                        <div>
                            <label>Email</label>
                            <input class="text-input medium-input required"
                                    type ="email"
                                    id   ="email_cliente"
                                    name ="email_cliente"
                                    maxlength="255"
                                    value="" required/>
                        </div>
                        <div>
                            <label>Senha</label>
                            <input class="text-input medium-input required"
                                    type ="password"
                                    id   ="senha"
                                    name ="senha"
                                    maxlength="255"
                                    value="" required/>
                        </div>
                        <div>
                            <input class="button"type="submit"value="Adicionar"/>
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
