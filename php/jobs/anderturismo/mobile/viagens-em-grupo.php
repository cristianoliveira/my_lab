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

/* mexeu aqui
//cria sessao único do visitante
include "cria_sessao.php";
$sessao = $_SESSION["vinicius"];*/

/*  === CONSULTA 3: Roteiros Selecionados ==== */
$seleciona    = "SELECT * FROM `roteiros`, `roteiros_selecionados` WHERE id_roteiro=idroteiros AND sessao= '$sessao' AND data_inicio >= $data_atual ORDER BY data_inicio ASC LIMIT 5";
$selecionados = mysql_query($seleciona); // Executa a consulta
?>
<!-- /////// HEAD //////// -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Viagens em Grupo - Andes Turismo</title><!-- Define o título da página -->
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
        <li class="active">Viagens em Grupo</li>
      </ol>
      <!-- FIM BREADCRUMB -->
      <!-- TÍTULO PÁGINA -->
      <div class="page-header">
        <h2>Viagens em Grupo</h2>
      </div>
      <!-- FIM TÍTULO PÁGINA -->
  </div>
  <!-- /////// FIM DIV CABEÇALHO //////// -->


  <!-- /////// DIV CONTEÚDO MEIO //////// -->
  <div class="conteudoMeio container">
      <!-- MODAL -->
      <div class="modal viagens fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div id="modal" class="modal-content">
            
          </div>
        </div>
      </div>
      <!-- FIM MODAL -->

      <!-- CONTEÚDO PÁGINA -->
        <?php 
        if(mysql_num_rows($destaques)>0){
        ?>
        <ul id="lista" class="list-group">
            <?php while ($pegaDestaques = mysql_fetch_assoc($destaques)) { ?>
            <li class="list-group-item col-xs-6">
                <div class="titulo"><?php echo $pegaDestaques['nome_roteiro']; ?></div>
                <a rel="imagem.php?arquivo=../cms/uploads/roteiros/<?php echo $pegaDestaques['imagem_roteiro']; ?>&largura=640&altura=480" class="abremodal">
                  <img src="imagem.php?arquivo=../cms/uploads/roteiros/<?php echo $pegaDestaques['imagem_roteiro']; ?>&largura=250&altura=207" alt="<?php echo $pegaDestaques['nome_roteiro']; ?>" title="<?php echo $pegaDestaques['nome_roteiro']; ?>" />
                </a>
                <div class="saida"><?php echo $pegaDestaques['datas_completas']; ?></div>
                <div class="locais">
                    <p>Lisboa, Madri, Londres, Vale do Loire, Chambord, Orleans, Paris e Luxemburgo.</p>
                    <p><a href="pagina-roteiro.php?id=<?php echo $pegaDestaques['idroteiros']; ?>" class="btn btn-info">
                      <span class="glyphicon glyphicon-zoom-in"></span> Veja mais
                    </a></p>
                    <p>
                      <form action="adicionar-roteiro.php?a=1" method="post" name="frmVerRoteiros">
                        <button class="btn btn-danger">
                          <span class="glyphicon glyphicon-check"></span> Adicionar aos seus roteiros
                        </button>
                        <input type="hidden" name="codigo_roteiro" value="<?php echo  $pegaDestaques['idroteiros']; ?>" />
                      </form>
                    </p>
                </div>
            </li>
            <?php } ?>
        </ul>
        <?php } else{ echo "<p>Não há roteiros em grupo cadastrados no momento.</p>"; } ?><br/>
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

  <!-- (Início) Script responsável por abrir a modal e colocar o conteúdo do atributo rel do link na imagem da modal -->
  <script type="text/javascript">
    $(".abremodal").click(function(){
        var img = $(this).attr('rel');
        $('.modal').html('<img src="'+img+'" />');
        $('.modal').modal();
    });
  </script>
  <!-- (Fim) Script responsável por abrir a modal e colocar o conteúdo do atributo rel do link na imagem da modal -->
</html>
<!-- /////// FIM DO RODAPÉ //////// -->