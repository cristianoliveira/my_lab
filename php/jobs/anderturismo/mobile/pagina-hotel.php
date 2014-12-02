<?php
session_start();

include("../inc/inc.bkl.php");

$codigo = $_GET["id"];

$sql5 = sprintf("SELECT * FROM `hoteis` WHERE idhoteis = %d", $codigo);
// Executa a consulta
$query5  = mysql_query($sql5);

/* mexeu aqui */
//cria sessao único do visitante
include "../cria_sessao.php";
$sessao = $_SESSION["vinicius"];

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
    <title>Busca de Hotéis - Andes Turismo</title><!-- Define o título da página -->
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
        <li><a href="index.php#busca-hoteis">Busca de Hotéis</a></li>
        <li class="active">Resultados</li>
      </ol>
      <!-- FIM BREADCRUMB -->
      <!-- TÍTULO PÁGINA -->
      <div class="page-header">
          <h2>Busca de Hotéis <small>Resultados</small></h2>
      </div>
      <!-- FIM TÍTULO PÁGINA -->
  </div>
  <!-- /////// FIM DIV CABEÇALHO //////// -->


  <!-- /////// DIV CONTEÚDO MEIO //////// -->
  <div class="conteudoMeio container">
      <!-- MODAL -->
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div id="modal" class="modal-content">
            
          </div>
        </div>
      </div>
      <!-- FIM MODAL -->

      <!-- CONTEÚDO PÁGINA -->
        <ul id="lista-hoteis" class="list-group">
                <?php while ($resultado = mysql_fetch_assoc($query5)) { ?>
                <li class="list-group-item col-xs-12">
                    <div class="titulo"><?php print $resultado['nome_hotel']; ?></div>
                    <div id="estrelas" class="e<?php echo $resultado['estrelas']; ?>"></div>
                    <small> Cód. <?php print $resultado['identificacao']; ?> </small><br/>
                    <h6><?php print $resultado['localizacao']; ?></h6>
                    <ul class="list-group">
                       <li class="list-group-item col-xs-4">
                          <a rel="imagem.php?arquivo=../cms/uploads/imagens/hoteis/<?php echo $resultado['imagem_principal']; ?>&largura=640&altura=480" class="abremodal"><img src="imagem.php?arquivo=../cms/uploads/hoteis/<?php echo $resultado['imagem_principal']; ?>&largura=236&altura=168" class="principal" /></a>
                          <p>
                            <?php
                              $codigo=$resultado['idhoteis'];
                              $sql_pegaImagens = mysql_query("SELECT * FROM imagens WHERE id_imovel=$codigo");
                              while ($row = mysql_fetch_assoc($sql_pegaImagens)){ 
                            ?>
                            <a rel="imagem.php?arquivo=../cms/uploads/imagens/hoteis/<?php echo $row['img']; ?>&largura=640&altura=480" class="abremodal"><img src="imagem.php?arquivo=../cms/uploads/imagens/hoteis/<?php echo $row['img']; ?>&largura=66&altura=66" /></a>
                            <?php  } ?>
                          </p>
                          <p><a href="pagina-hotel.php?id=<?php echo $resultado['idhoteis']; ?>" class="btn btn-warning">
                            <span class="glyphicon glyphicon-share"></span> Ver mais detalhes
                          </a></p>
                          <p><a href="agendamento.php?id=<?php print $resultado['idhoteis']; ?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-thumbs-up"></span> Quero este hotel
                          </a></p>
                       </li>
                       <li class="list-group-item col-xs-8">
                        <?php echo $resultado['descricao']; ?><br/><br/>
                        <ul class="list-group">
                          <li class="list-group-item active">Tabela de Preços</li>
                          <?php
                            $sql_pegPrecos = mysql_query("SELECT * FROM precos, apartamentos, hoteis WHERE hotel_id=idhoteis AND apartamento_id=idapartamentos AND hotel_id=$codigo");
                            while ($row = mysql_fetch_array($sql_pegPrecos)){ 
                          ?>
                          <li class="list-group-item"><?php echo $row['nome_apartamento'] . $row['sigla']; ?> R$ <strong><?php echo $row['valor']; ?></strong></li>
                          <?php } ?>
                        </ul>
                       </li>
                    </ul>
                    <div class="titulo clear">Informações Adicionais</div>
                    <?php echo $resultado['informacoes_adicionais']; ?><br/>

                    <div class="titulo clear">Localização</div>
                    <h6><?php echo $resultado['localizacao']; ?></h6>
                    <iframe id="mapa" src="<?php echo $resultado['mapa']; ?>" width="100%" height="315" frameborder="0" style="border:0"></iframe><br/>

                    <a href="agendamento.php?id=<?php print $resultado['idhoteis']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up quero"></span>&nbsp; Quero este hotel</a>
                </li>
                <?php } ?>
        </ul>
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
        $('.modal').html('<img src="imagens/'+img+'" />');
        $('.modal').modal();
    });
  </script>
  <!-- (Fim) Script responsável por abrir a modal e colocar o conteúdo do atributo rel do link na imagem da modal -->
</html>
<!-- /////// FIM DO RODAPÉ //////// -->