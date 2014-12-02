<?php
session_start(); //pega os dados da busca e salva na sessao

include("../inc/inc.bkl.php");
include("../inc/functions.php");

// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante
/* ativa só qdo estiver online 
if (!isset($_GET['consulta'])) {
header("Location: http://www.andesturismo.com.br/");
exit;
}
*/
// Se houve busca, continue o script:

// Salva o que foi buscado em uma variável 
@$busca    = $_POST['palavra-chave'];
@$checkin  = $_POST['checkin'];
@$checkout = $_POST['checkout'];
@$adultos  = $_POST['adultos'];
@$criancas = $_POST['criancas'];
@$quartos  = $_POST['quartos'];


if(!empty($busca))   { $_SESSION["palavra-chave"] = $busca;   }
if(!empty($checkin)) { $_SESSION["checkin"]       = $checkin; }
if(!empty($checkout)){ $_SESSION["checkout"]      = $checkout;}
if(!empty($adultos)) { $_SESSION["adultos"]       = $adultos; }
if(!empty($criancas)){ $_SESSION["criancas"]      = $criancas;}
if(!empty($quartos)) { $_SESSION["quartos"]       = $quartos; }

// Usa a função mysql_real_escape_string() para evitar erros no MySQL
$busca    = mysql_real_escape_string($busca);
$checkin  = mysql_real_escape_string($checkin);
$checkout = mysql_real_escape_string($checkout);
$adultos  = mysql_real_escape_string($adultos);
$quartos  = mysql_real_escape_string($quartos);

// ============================================
//######### INICIO Paginação
        $numreg = 15; // Quantos registros por página vai ser mostrado
        if (!isset($_GET['pg'])) {
                @$_GET['pg'] = 0;
        }
        $inicial = $_GET['pg'] * $numreg;
        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM hoteis WHERE (`status` = 1) AND ((`nome_hotel` LIKE '%".$busca."%') OR (`localizacao` LIKE '%".$busca."%') OR (`identificacao` LIKE '%".$busca."%')) ORDER BY `nome_hotel` DESC");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação

// Monta outra consulta MySQL para a busca
$sql = "SELECT * FROM `hoteis` WHERE (`status` = 1) AND ((`nome_hotel` LIKE '%".$busca."%') OR (`localizacao` LIKE '%".$busca."%') OR (`identificacao` LIKE '%".$busca."%')) ORDER BY `nome_hotel` DESC LIMIT $inicial, $numreg";
// Executa a consulta
$query  = mysql_query($sql);
$query2 = mysql_query($sql);

$sql5 = "SELECT * FROM `hoteis` WHERE (`status` = 1) ORDER BY `nome_hotel` ASC LIMIT $inicial, $numreg";
// Executa a consulta
$query5  = mysql_query($sql5);
// ============================================

//cria sessao único do visitante
include "../cria_sessao.php";
$sessao = $_SESSION["vinicius"];

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
    <title>Andes Turismo - Resultado de Hotéis</title><!-- Define o título da página -->
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

      <p> <strong> Você buscou por: </strong> 
      <?php if(!empty($_SESSION["palavra-chave"])){ print $_SESSION["palavra-chave"] . " "; } ?>
      <?php if(!empty($_SESSION["checkin"])){ print "<strong>Checkin:</strong>      ". formatarData($_SESSION["checkin"]); } ?>
      <?php if(!empty($_SESSION["checkout"])){ print "<strong> - Checkout: </strong>". formatarData($_SESSION["checkout"]); } ?>
      <?php if(!empty($_SESSION["adultos"])){ print "<strong> Adultos: </strong>    ". $_SESSION["adultos"]; } ?>
      <?php if(!empty($_SESSION["criancas"])){ print ",<strong> Crianças: </strong>  ". $_SESSION["criancas"]; } ?>
      <?php if(!empty($_SESSION["quartos"])){ print "<strong> e Quartos: </strong>  ". $_SESSION["quartos"]; } ?>
      </p>

      <!-- CONTEÚDO PÁGINA -->
        <div class="progress">
          <div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0" data-percentage="100">
            <span class="sr-only">99% Complete</span>
          </div>
        </div>

        <?php $testa = mysql_fetch_assoc($query2); if(!empty($testa)){ ?> 
        <div class="alert alert-info" role="alert"> Você encontrou o que procurava. Aqui estão os resultados de sua busca. </div>
        <?php } else{ ?>
        <div class="alert alert-danger" role="alert"> Infelizmente não temos o que você procura agora. Mas talvez você possa se interessar por alguns dos hotéis abaixo. Obrigado! </div>
        <?php } ?>

        <ul id="lista-hoteis" class="list-group">
            <?php while ($resultado = mysql_fetch_assoc($query5)) { ?>
            <li class="list-group-item col-xs-12">
                <div class="titulo"><?php print $resultado['nome_hotel']; ?></div>
                <div id="estrelas" class="e<?php echo $resultado['estrelas']; ?>"></div>
                <small> Cód. <?php print $resultado['identificacao']; ?> </small><br/>
                <h6><?php print $resultado['localizacao']; ?></h6>
                <ul class="list-group">
                   <li class="list-group-item col-xs-4">
                      <a rel="imagem.php?arquivo=../cms/uploads/hoteis/<?php echo $resultado['imagem_principal']; ?>&largura=640&altura=480" class="abremodal">
                        <img src="imagem.php?arquivo=../cms/uploads/hoteis/<?php echo $resultado['imagem_principal']; ?>&largura=236&altura=168" class="principal" /></a>
                      <p>
                        <?php
                          $codigo=$resultado['idhoteis'];
                          $sql_pegaImagens = mysql_query("SELECT * FROM imagens WHERE id_imovel=$codigo");
                          while ($row = mysql_fetch_assoc($sql_pegaImagens)){ 
                        ?>
                        <a rel="imagem.php?arquivo=../cms/uploads/imagens/hoteis/<?php echo $row['img']; ?>&largura=640&altura=480" class="abremodal">
                          <img src="imagem.php?arquivo=../cms/uploads/imagens/hoteis/<?php echo $row['img']; ?>&largura=66&altura=66" /></a>
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
            </li>
            <?php } ?>
        </ul>

        <div class="text-center">
            <small>Todos os preços do site são sujeitos à disponibilidade de lugares no ato da solicitação da reserva e a alteração sem aviso prévio.</small><br/>
            <?php include("../inc/_paginate.php"); ?>
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
    $(function() {
        setTimeout(function(){
                $('.progress-bar').each(function() {
                    var me = $(this);
                    var perc = me.attr("data-percentage");
                    //TODO: left and right text handling
                    var current_perc = 0;
                    var progress = setInterval(function() {
                        if (current_perc>=perc) {
                            clearInterval(progress);
                        } else {
                            current_perc +=20;
                            me.css('width', (current_perc)+'%');
                        }
                        me.text((current_perc)+'%');
                    }, 50);
                }); 
    },300)});
  </script>
  <!-- (Fim) Script responsável por abrir a modal e colocar o conteúdo do atributo rel do link na imagem da modal -->
</html>
<!-- /////// FIM DO RODAPÉ //////// -->