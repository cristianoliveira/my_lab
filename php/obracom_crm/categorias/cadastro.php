<?php  
include("../includes/cabecalho.php");
include('../includes/check_authentication.php');
include("../includes/database_connection.php");

$_COOKIE["categorias"]="current";
$_COOKIE["categorias1"]="current";
$_COOKIE["categorias2"]="";
?>

<body class="produtos form">

    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->        
    <div id="main-content"> <!-- Main Content Section with everything -->

        <!-- Page Head -->
                    <h2>Adição de uma Categoria</h2>
            <p id="page-intro">Utilize o formulário abaixo para incluir uma categoria no sistema.</p>
        
        
        <div class="content-box"><!-- Start Content Box -->
            <div class="content-box-header">
                  <h3>Dados da Categoria.</h3>
            <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">

                <form action="acao.php?a=1" id="banners_form" method="post" enctype="multipart/form-data">    

                    <fieldset>

                        
                        <p>
                            <label>Nome</label>
                            <input class="text-input medium-input required"type="text"id="nome"name="nome"maxlength="255"value=""/>
                        </p>
                      <p>
                            <label>Subtítulo de Capa</label>
                            <input class="text-input medium-input required"type="text"id="subtitulo"name="subtitulo"maxlength="125"value=""/><br>

                        </p>
                          <label>Imagem da Categoria </label>
                        <input class="text-input small-input"type="file"id="imagem"name="imagem"/><br />
  <small>Edite a imagem na Ferramenta Crop, <a href="../crop/index.php">clique aqui para editar a imagem.</a></small><br />
                        </p>
                        <p>
                        <label>Descrição </label>
                            <textarea class="text-input textarea" id="descricao" name="descricao" cols="79" rows="15"></textarea><br>
                       <small>No máximo 125 caracteres.</small>
                        </p>
                        <p>
                            <input class="button"type="submit"value="Adicionar"/>
                        </p>

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
