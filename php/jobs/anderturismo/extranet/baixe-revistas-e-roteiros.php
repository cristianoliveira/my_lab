<?php
include("../inc/inc.bkl.php");

// Modifica a zona de tempo a ser utilizada. Disnovível desde o PHP 5.1
date_default_timezone_set('UTC');

// Exibe a data atual formato banco
$data_atual = date("Y-m-d"); 

//cria sessao único do visitante
include "../cria_sessao.php";
$sessao = $_SESSION["vinicius"];

/* === CONSULTA 2: Roteiros Destaques corpo do site abaixo das buscas ==== */
$roteiros_meio = "SELECT * FROM `roteiros` WHERE status_roteiro=1 AND viagens_grupo=1 AND data_inicio >= $data_atual ORDER BY data_fim";
$destaques = mysql_query($roteiros_meio); // Executa a consulta

/*  === CONSULTA 3: Roteiros Selecionados ==== */
$seleciona    = "SELECT * FROM `roteiros`, `roteiros_selecionados` WHERE id_roteiro=idroteiros AND sessao= '$sessao' AND data_inicio >= $data_atual ORDER BY data_inicio ASC LIMIT 5";
$selecionados = mysql_query($seleciona); // Executa a consulta

/*  === CONSULTA 4: Downloads ==== */
$downloads      = "SELECT * FROM `downloads` ORDER BY titulo ASC";
$pega_downloads = mysql_query($downloads); // Executa a consulta
?>
<!-- /////// HEAD //////// -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Baixe Revistas e Roteiros - Andes Turismo</title><!-- Define o título da página -->
    <!-- (Início) Carrega o Bootstrap, Style, HTML5Shiv e Respond para navegadores desatualizados -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- (Fim) Carrega o Bootstrap, HTML 5 Shiv para navegadores desatualizados -->
  </head>
<!-- /////// FIM DO HEAD //////// -->


<!-- /////// BODY //////// -->
<body>

  <!-- /////// DIV CABEÇALHO //////// -->
    <div class="cabecalho container">
       <!-- MENU MOBILE -->
       <div class="navbar" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="botao-menu" data-toggle="collapse" data-target=".navbar-collapse">
              <img src="imagens/ico_menu.jpg" />
            </button>
            <!-- LOGO -->
            <a href="index.php">
              <img class="logo" src="imagens/logo_andes.jpg" alt="Andes Turismo" title="Andes Turismo" />
            </a>
            <!-- FIM LOGO -->
          </div>
          <div class="collapse navbar-collapse">
            <!-- /////// INCLUI MENU //////// -->
            <?php include_once "includes/menu.php"; ?>
          </div>
        </div>
      </div>
      <!-- FIM MENU MOBILE -->
      <!-- BREADCRUMB -->
      <ol class="breadcrumb">
        <li><a href="index.php">Página Principal</a></li>
        <li class="active">Baixe Revistas e Roteiros</li>
      </ol>
      <!-- FIM BREADCRUMB -->
      <!-- TÍTULO PÁGINA -->
      <div class="page-header">
        <h2>Baixe Revistas e Roteiros</h2>
      </div>
      <!-- FIM TÍTULO PÁGINA -->
  </div>
  <!-- /////// FIM DIV CABEÇALHO //////// -->


  <!-- /////// DIV CONTEÚDO MEIO //////// -->
  <div class="conteudoMeio container">
      <!-- CONTEÚDO PÁGINA -->
        <?php 
          if(mysql_num_rows($pega_downloads)>0){
        ?>
        <ul id="lista-revistas" class="list-group">
            <?php while ($ativos = mysql_fetch_assoc($pega_downloads)) { ?>
            <?php
              /* Transforma PDF em JPG */
              // lê a primeira página do PDF
              $im = new imagick('../cms/uploads/downloads/'.$ativos['arquivo']); //aqui insere o array do Banco

              $im->readImage('../cms/uploads/downloads/'.$ativos['arquivo'].'[0]');

              // converte para jpg 
              $im->setImageColorspace(255); 
              $im->setCompression(Imagick::COMPRESSION_JPEG); 
              $im->setCompressionQuality(100); 
              $im->setImageFormat('jpeg'); 

              //redimensiona 
              $im->resizeImage(150, 150, imagick::FILTER_LANCZOS, 1);  

              //grava imagem e salva nome
              $im->writeImage('../cms/uploads/downloads/'.$ativos['arquivo'].".jpg"); 
              $im->clear(); 
              $im->destroy(); 
            ?> 
            <li class="list-group-item col-xs-3">
                <img src="../cms/uploads/downloads/<?php echo $ativos['arquivo']; ?>.jpg" alt="<?= $ativos['titulo']; ?>" title="<?= $ativos['titulo']; ?>" />
                <h4 class="nome"><?= $ativos['titulo']; ?></h4>
                <p><a href="download.php?arquivo=<?php echo $ativos['arquivo']; ?>" class="btn btn-primary">
                      <span class="glyphicon glyphicon-save"></span> Fazer Download
                </a></p>
            </li>
            <?php } ?>
        </ul>
         <?php } else{ echo "Não há downloads cadastrados no momento."; }  ?> 
        <div class="text-center">
            <ul class="pager">
              <li><a href="javascript:window.history.go(-1)">&larr; Voltar</a></li>
            </ul>
        </div>
      <!-- FIM CONTEÚDO PÁGINA -->
  </div>
  <!-- /////// FIM DIV CONTEÚDO MEIO //////// -->


  <!-- /////// DIV RODAPÉ //////// -->
  <div class="rodape">
    <h4>Andes Turismo - Grupo Andes Travel Brasil</h4>
    <h5>Av. Assis Brasil, 1652 / 401. Passo D'Areia - Porto Alegre - RS</h5>
    <h5>CEP 91010-001 - Telefone: 51 3342.0123</h5>
    <h5>E-mail: contato@andesturismo.com.br</h5><br/>
    <img src="imagens/img_formas-pagamento.png" alt="Formas de Pagamento - Andes Turismo" title="Formas de Pagamento - Andes Turismo" />
  </div>
  <!-- /////// FIM DIV RODAPÉ //////// -->


</body>
<!-- /////// FIM DO BODY //////// -->


<!-- /////// RODAPÉ //////// -->
  <!-- (Início) Carrega jQuery (necessário para os plugins do Bootstrap) e Boostrap.js -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
  <!-- (Fim) Carrega jQuery (necessário para os plugins do Bootstrap) e Boostrap.js -->

</html>
<!-- /////// FIM DO RODAPÉ //////// -->