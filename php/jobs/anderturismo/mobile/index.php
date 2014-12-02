<?php

include("../inc/inc.bkl.php");

// Modifica a zona de tempo a ser utilizada. Disnovível desde o PHP 5.1
date_default_timezone_set('UTC');

// Exibe a data atual formato banco
$data_atual = date("Y-m-d"); 

//cria sessao único do visitante
include "../cria_sessao.php";
$sessao = $_SESSION["vinicius"];
//echo $sessao; exit();

/* === CONSULTA 1: Roteiros Ativos ==== */
/* Roteiros Destaques Cabeçalho */
$roteiros_cabecalho = "SELECT * FROM `roteiros` WHERE status_roteiro=1 AND destaque_home_cabecalho=1 AND data_inicio >= $data_atual ORDER BY data_inicio LIMIT 8";
$exclusivos = mysql_query($roteiros_cabecalho); // Executa a consulta

/* === CONSULTA 2: Roteiros Destaques corpo do site abaixo das buscas ==== */
$roteiros_meio = "SELECT * FROM `roteiros` WHERE status_roteiro=1 AND destaque_home_roteiros=1 AND data_fim >= $data_atual ORDER BY data_fim LIMIT 8";
$destaques = mysql_query($roteiros_meio); // Executa a consulta

/*  === CONSULTA 3: Roteiros Selecionados ==== */
$seleciona    = "SELECT * FROM `roteiros`, `roteiros_selecionados` WHERE id_roteiro=idroteiros AND sessao= '$sessao' AND data_inicio >= $data_atual ORDER BY data_inicio ASC LIMIT 5";
$selecionados = mysql_query($seleciona); // Executa a consulta

/*  === CONSULTA 4: Banners dinâmicos ==== */
$banners      = "SELECT * FROM `banners` ORDER BY rand()";
$pega_banners = mysql_query($banners); // Executa a consulta

?>
<!-- /////// HEAD //////// -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Andes Turismo</title><!-- Define o título da página -->
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
  </div>
  <!-- /////// FIM DIV CABEÇALHO //////// -->


  <!-- /////// DIV CONTEÚDO MEIO //////// -->
  <div class="conteudoMeio container">
      <!-- CONTEÚDO PÁGINA -->
        <ul id="lista-home" class="list-group">
            <li class="list-group-item col-xs-6 box-azul">
                <a name="busca-rapida"><h4>BUSCA RÁPIDA</h4></a>
                <h5>A busca rápida tenta procupar o mais próximo do que você digita.</h5>
                <form action="" method="" id="form_home">
                    <input type="text" name="busca" id="busca" class="form-control" />
                    <div id="filtros">
                      <button type="button" class="btn btn-primary" id="abre_filtros">+ Filtros</button><br/>
                      <div class="aparece_filtros">
                          <p><label>País</label><br />
                              <select name="pais" class="form-control">
                                  <option value="Brasil">Brasil</option>
                                  <option value="Estados Unidos">Estados Unidos</option>
                                  <option value="Russia">Russia</option>
                              </select>
                          </p>
                          <p><label>Mês</label><br /><input type="month" class="form-control"></p>
                          <p><label>Data</label><br /><input type="date" class="form-control"></p>
                          <p><label>Feriado</label><br />
                              <select name="feriado" class="form-control">
                                  <option value="0">Não</option>
                                  <option value="1">Sim</option>
                              </select>
                          </p>
                          <p> 
                            <input name="terrestre" type="checkbox" id="terrestre">
                            <label for="terrestre"> Terrestre </label><br />
                            <input name="rodoviario" type="checkbox" id="rodoviario">
                            <label for="rodoviario"> Rodoviário </label><br /> 
                            <input name="aereo" type="checkbox" id="aereo">
                            <label for="aereo"> Aéreo</label><br />
                            <input name="cruzeiro" type="checkbox" id="cruzeiro">
                            <label for="cruzeiro"> Cruzeiro</label><br />
                            <input name="combinados" type="checkbox" id="combinados">
                            <label for="combinados"> Combinados</label><br />
                            <input name="individual" type="checkbox" id="individual">
                            <label for="individual"> Individual</label><br />  
                          </p>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Efetuar Busca" />
                </form>
            </li>
            <li class="list-group-item col-xs-6 box-amarelo">
                <a name="busca-hoteis"><h4>BUSCA DE HOTÉIS</h4></a>
                <form action="busca-hoteis.php" method="post" id="form_home">
                    <input type="text" name="busca" class="form-control" placeholder="Nome, endereço ou código do hotel" /><br/>

                    <ul class="list-group">
                        <li class="list-group-item col-xs-6">
                            <label>Entrada</label>
                            <input type="text" class="form-control" name="checkin" />
                        </li>
                        <li class="list-group-item col-xs-6">
                            <label>Saída</label>
                            <input type="text" class="form-control" name="checkout" />
                        </li>
                    </ul>

                    <ul class="list-group">
                        <li class="list-group-item col-xs-4">
                            <label>Adultos</label>
                            <input type="number" class="form-control" name="adultos" min="0" />
                        </li>
                        <li class="list-group-item col-xs-4">
                            <label>Crianças</label>
                            <input type="number" class="form-control" name="criancas" min="0" />
                        </li>
                        <li class="list-group-item col-xs-4">
                            <label>Quartos</label>
                            <input type="number" class="form-control" name="quartos" min="0" />
                        </li>
                    </ul>

                    <input type="submit" class="btn btn-primary" value="Efetuar Busca" />
                </form>
            </li>
        </ul>

        <ul id="lista" class="list-group">
            <?php while ($pegaDestaques = mysql_fetch_assoc($destaques)) { ?> 
            <li class="list-group-item col-xs-6">
                <div class="titulo"><?php echo $pegaDestaques['nome_roteiro']; ?></div>
                <img src="imagem.php?arquivo=../cms/uploads/roteiros/<?php echo  $pegaDestaques['imagem_roteiro']; ?>&largura=250&altura=207" alt="<?php echo $pegaDestaques['nome_roteiro']; ?>" title="<?php echo $pegaDestaques['nome_roteiro']; ?>" />
                <div class="saida">Saídas: <?php echo  $pegaDestaques['datas_completas']; ?></div>
                <div class="locais">
                    <p><?php echo  $pegaDestaques['idroteiros']; ?></p>
                    <p>
                      <form action="pagina-roteiro.php" method="post">
                        <button type="submit" class="btn btn-info">
                          <span class="glyphicon glyphicon-zoom-in"></span> Veja mais
                        </button>
                        <input type="hidden" name="codigo_roteiro" value="<?php echo $pegaDestaques['idroteiros']; ?>" />
                      </form>
                    </p>
                    <p>
                      <form action="adicionar-roteiro.php?a=1" method="post" name="frmVerRoteiros">
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-check"></span> Adicionar aos seus roteiros
                        </button>
                        <input type="hidden" name="codigo_roteiro" value="<?php echo  $pegaDestaques['idroteiros']; ?>" />
                      </form>
                    </p>
                </div>
            </li>
            <?php } ?>
        </ul>

        <img src="imagens/img_home-parceiras.jpg" class="img-responsive" /><br/>
        <a href="https://www.facebook.com/andesturismo?fref=ts">
          <img src="imagens/img_home-redes_capa.jpg" class="img-responsive" />
        </a>

        <ul id="lista-homenews" class="list-group">
            <li class="list-group-item col-xs-7 sb">
                <h4 class="azul esq">QUER RECEBER NOVIDADES POR E-MAIL? </h4>
                <h5>Então cadastre-se aqui.</h5>
            </li>
            <li class="list-group-item col-xs-5 sb">
                <form method="post" action="adiciona-news.php">
                    <input type="text" placeholder="Insira seu nome" class="form-control wd40" />
                    <input type="email" placeholder="Seu e-mail" class="form-control wd40" />
                    <input type="submit" class="btn btn-primary wd20" value="Cadastrar" />
                </form>
            </li>
        </ul>

        <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fandesturismopoa&amp;width=1135&amp;height=158&amp;border_color=%23fff&amp;colorscheme=light&amp;show_faces=true&amp;stream=false&amp;header=false&amp;height=258&amp;locale=pt_BR" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:260px; margin-top:5px;" allowtransparency="true"></iframe>
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

  <!-- (Início) Script que mostra e esconde filtro do formulário -->
      <script type="text/javascript">
        $('#abre_filtros').click(function(){
          if($('.aparece_filtros').css('display') == 'none'){
            $('.aparece_filtros').slideDown("slow");
          }else{
            $('.aparece_filtros').slideUp("slow");
          }
        });
      </script>
  <!-- (Fim) Script que mostra e esconde filtro do formulário -->
</html>
<!-- /////// FIM DO RODAPÉ //////// -->