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
    <title>Agendamento de Hotel - Andes Turismo</title><!-- Define o título da página -->
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

    <!-- /////// MODAL //////// --> 
    <?php if(@$_GET["r"]==1){ ?>
      <div class="alert alert-success" role="alert">A solicitação foi concluída. Em breve iremos entrar em contato para confirmação de dados. Obrigado!</div>
    <?php } ?>
    <!-- /////// FIM MODAL //////// -->

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
        <li class="active">Agendamento de Hotel</li>
      </ol>
      <!-- FIM BREADCRUMB -->
      <!-- TÍTULO PÁGINA -->
      <div class="page-header">
        <h2>Agendamento de Hotel</h2>
      </div>
      <!-- FIM TÍTULO PÁGINA -->
  </div>
  <!-- /////// FIM DIV CABEÇALHO //////// -->

  <!-- /////// DIV CONTEÚDO MEIO //////// -->
  <div class="conteudoMeio container agendamento">
      <!-- CONTEÚDO PÁGINA -->
      <form action="envia-hotel.php" method="post">
      <ul id="lista-hoteis" class="list-group">
          <?php while ($resultado = mysql_fetch_assoc($query5)) { ?>
              <li class="list-group-item col-xs-12 sb">
                  <ul class="list-group">
                      <li class="list-group-item col-xs-4">
                         <img src="imagem.php?arquivo=../cms/uploads/hoteis/<?php echo $resultado['imagem_principal']; ?>&largura=236&altura=168" class="principal" />
                      </li>
                      <li class="list-group-item col-xs-8">
                          <div class="titulo"><?php print $resultado['nome_hotel']; ?></div>
                          <div id="estrelas" class="e<?php echo $resultado['estrelas']; ?>"></div>
                          <small> Cód. <?php print $resultado['identificacao']; ?> </small><br/>
                          <h6><?php print $resultado['localizacao']; ?></h6>                         
                          <?php echo $resultado['descricao']; ?>
                          <input name="codigo_hotel" type="hidden" value="<?php print $resultado['identificacao']; ?>" />
                          <input name="nome_hotel" type="hidden" value="<?php print $resultado['nome_hotel']; ?>" />
                      </li>
                  </ul>
                  <ul class="list-group tabela-agenda">
                      <li class="list-group-item col-xs-6">
                      <ul class="list-group">
                        <li class="list-group-item active">Selecione a sua opção:</span></li>
                          <?php
                            $sql_pegPrecos = mysql_query("SELECT * FROM precos, apartamentos, hoteis WHERE hotel_id=idhoteis AND apartamento_id=idapartamentos AND hotel_id=$codigo");
                            while ($row = mysql_fetch_array($sql_pegPrecos)){ 
                          ?>
                          <li class="list-group-item">
                          <input name="escolhe_apartamento" type="radio" required value="<?php echo @$row['nome_apartamento']." - ".@$row['sigla'] ; ?>" <?php if(@$row['idapartamentos']==@$_POST["escolhe_apartamento"]){ ?> checked="checked" <?php } ?> /> <?php echo $row['nome_apartamento']." ".$row['sigla']; ?> 
                          <strong> R$ <?php echo $row['valor']; ?> </strong>
                          </li>
                         <?php } ?>
                      </ul>
                    </li>
                    <li class="list-group-item col-xs-6">
                      <ul class="list-group">
                          <li class="list-group-item col-xs-6 sb">
                              <label>Entrada</label>
                              <input type="text" class="form-control" name="checkin" value="<?php if(!empty($_POST["checkin"])){ echo $_POST["checkin"]; } else{ echo $_SESSION["checkin"]; } ?>" required />
                          </li>
                          <li class="list-group-item col-xs-6 sb">
                              <label>Saída</label>
                              <input type="text" class="form-control" name="checkout" value="<?php if(!empty($_POST["checkout"])){ echo $_POST["checkout"]; } else{ echo $_SESSION["checkout"]; } ?>" required />
                          </li>
                      </ul>

                      <ul class="list-group">
                          <li class="list-group-item col-xs-4 sb">
                              <label>Adultos</label>
                              <input type="number" class="form-control" name="adultos" min="0" value="<?php if(!empty($_POST["quartos"])){ echo $_POST["quartos"]; } else{ echo $_SESSION["quartos"]; } ?>" />
                          </li>
                          <li class="list-group-item col-xs-4 sb">
                              <label>Crianças</label>
                              <input type="number" class="form-control" name="filhos" min="0" value="<?php if(!empty($_POST["adultos"])){ echo $_POST["adultos"]; } else{ echo $_SESSION["adultos"]; } ?>" />
                          </li>
                          <li class="list-group-item col-xs-4 sb">
                              <label>Quartos</label>
                              <input type="number" class="form-control" name="quartos" min="0" value="<?php if(!empty($_POST["criancas"])){ echo $_POST["criancas"]; } else{ echo $_SESSION["criancas"]; } ?>" />
                          </li>
                      </ul>
                    </li>
                  </ul>
              </li>
              <?php } ?>
          </ul>
          <label>Nome Completo: </label>
          <input type="text" name="nome" class="form-control" placeholder="Nome Completo" required="required" /><br/>
          <label>E-mail: </label>
          <input type="email" name="email" class="form-control" placeholder="E-mail" required="required" /><br/>
          <label>Cidade: </label>
          <input type="text" name="cidade" class="form-control" placeholder="Cidade" required="required" /><br/>
          <label>Endereço: </label>
          <input type="text" name="endereco" class="form-control" placeholder="Endereço" required="required" /><br/>
          <label>Telefone: </label>
          <input type="text" name="telefone" class="form-control" placeholder="Telefone" required="required" /><br/>
          <label>Mensagem: </label>
          <textarea class="form-control" name="mensagem" placeholder="Mensagem" required="required" rows="3"></textarea><br/>
          <input type="submit" class="btn btn-primary" value="Enviar" />
      </form>

      <div class="text-center">
          <small> Observação: O tarifáfio pode sofrer alterações de valor dependendo da data do envio deste contato.</small><br/>
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