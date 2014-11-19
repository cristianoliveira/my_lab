<?php
session_start();

//debug
/*
echo $_SESSION["palavra-chave"] . "<br>";
echo $_SESSION["checkin"] . "<br>";
echo $_SESSION["checkout"] . "<br>";
echo $_SESSION["adultos"] . "<br>";
echo $_SESSION["criancas"] . "<br>";
echo $_SESSION["quartos"] . "<br>";
exit();
*/

//echo @$_POST["escolhe_apartamento"]; exit();


// Conexão com o MySQL
// ========================
$_BS['MySQL']['servidor'] = 'mysql.andesturismo.com.br';
$_BS['MySQL']['usuario'] = 'andesturismo02';
$_BS['MySQL']['senha'] = 'c1a5k0';
$_BS['MySQL']['banco'] = 'andesturismo02';
mysql_connect($_BS['MySQL']['servidor'], $_BS['MySQL']['usuario'], $_BS['MySQL']['senha']);
mysql_select_db($_BS['MySQL']['banco']);
// ====(Fim da conexão)====

$codigo = $_GET["id"];

$sql5 = sprintf("SELECT * FROM `hoteis` WHERE idhoteis = %d", $codigo);
// Executa a consulta
$query5  = mysql_query($sql5);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Andes Turismo - Agendar Hotel</title>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/redmond/jquery-ui.css">

<script>
  $(function() {
	  var dates = $( "#checkin, #checkout" ).datepicker({
		dateFormat: 'dd/mm/yy',
		
		    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    
    nextText: 'Próximo',
    prevText: 'Anterior',
		
		defaultDate: "+1w",
		changeMonth: true,
		onSelect: function( selectedDate ) {
			var option = this.id == "checkin" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});
	
$( "#dialog" ).dialog();
$('.btn_mais_filtros').click( //botão roteiros topo
    function() {
	$( ".aparece_filtros" ).slideToggle( "slow" );
   });

$('.glyphicon-globe').click( //botão roteiros topo
    function() {
	$( ".layer_flutuante" ).slideToggle( "fast" );
   });
   
   				var Page = (function() {
					
					var $navArrows = $( '#nav-arrows' ),
						$nav = $( '#nav-dots > span' ),
						slitslider = $( '#slider' ).slitslider( {
							onBeforeChange : function( slide, pos ) {

								$nav.removeClass( 'nav-dot-current' );
								$nav.eq( pos ).addClass( 'nav-dot-current' );

							}
						} ),
						
						
						

						init = function() {

							initEvents();
							
						},
						initEvents = function() {
							
														// add navigation events
							$navArrows.children( ':last' ).on( 'click', function() {

								slitslider.next();
								return false;

							} );

							$navArrows.children( ':first' ).on( 'click', function() {
								
								slitslider.previous();
								return false;

							} );

							$nav.each( function( i ) {
							
								$( this ).on( 'click', function( event ) {
									
									var $dot = $( this );
									
									if( !slitslider.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slitslider.jump( i + 1 );
									return false;
								
								} );
								
							} );

						};

						return { init : init };

				})();

				Page.init();


  });
  </script>
  

<link rel="stylesheet" href="./css/bootstrap.min.css">


		<script type="text/javascript" src="player/modernizr.custom.79639.js"></script>
        <script type="text/javascript" src="player/jquery.ba-cond.min.js"></script>
		<script type="text/javascript" src="player/jquery.slitslider.js"></script>
		<noscript>
			<link rel="stylesheet" type="text/css" href="player/styleNoJS.css" />
		</noscript>
        <link rel="stylesheet" href="css/forms-min.css">
        <link rel="stylesheet" href="css/buttons-min.css">

<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
@font-face {
    font-family: "Humanst531 BT";
    src: url(fonts/Hum521l.ttf) format("truetype");
}
.fundo_amarelo_topo{width:100%; height:40px; background: linear-gradient(#ebbb01, #ffe592); }
.alinha_login_extranet{width:1035px; height:20px; margin:0 auto;}
.fundo_login_extranet{
	width:180px; height:60px; background: linear-gradient(0deg, #ea533f, #f56552);
	margin-top:-40px;
	border-bottom-left-radius:20px; border-bottom-right-radius:20px; 
	border-left:2px solid #db301a; border-right:2px solid #db301a; border-bottom:2px solid #db301a;
	box-shadow:  0px 2px 2px 0px rgba(20, 20, 20, 0.35);
	float:right; }
.login_extranet{width:143px; height:34px; margin:0 auto; margin-top:15px; }
.alinha_topo_menu{width:1132px; height:115px; margin:0 auto; margin-bottom:15px; margin-top:-20px; }
.logotipo{float:left; width:232px; height:115px; margin-top:12px; background-color:#0FF }
.alinha_menu{float:right; width:900px; height:100px; margin-top:35px; }

/* ########### */
/* menu */
.menu{
  font-family: "Humanst531 BT", "Trebuchet MS", Arial, Helvetica, sans-serif;
  float:right;
  margin-top:9px;
  width:900px;
}
.menu .menu-list{
  list-style: none;
}
.menu a{
  color: #666;
  text-decoration: none;
  display: block;
  cursor: pointer;
  text-transform: uppercase;
  font-size: 14px;
  font-weight: 300;
  display: table-cell;
  height:75px;
  vertical-align:middle;
  clear:both;
}
.menu > .menu-list > li{
  float: left;
  position: relative;
  text-align:center;
  border-right: 1px solid #ebbb01;
}
.menu > .menu-list > li > a {
  padding: 15px;
  margin: 10px 10px;
   transition: opacity .25s ease-in-out;
   -moz-transition: opacity .25s ease-in-out;
   -webkit-transition: opacity .25s ease-in-out;
}
.menu > .menu-list > li:hover a {
  color: #d92028;
  background-color:#fdf8e6
}

.barra_azul{
	width:100%;
	height: 39px;
	background-color:#428bca;
	/* background: linear-gradient(180deg,#418ac8, #2d6ca2);*/
	border-top: 1px solid #2b669a;
	}
.centraliza_botao_roteiros{width:1035px; margin:0 auto; height: 39px;}

.alinha_layer_flutuante{height: auto; position: absolute; z-index:9999; background-color:#36C}
.layer_flutuante{width:303px; height:auto; background-color:#2e6ea5; float:right; position:absolute; z-index:9999; margin-left:732px; margin-top:37px }
.alinha_roteiros_clicados{width:200px; height:auto; margin:0 auto; margin-top:20px; }

.organiza_roteiros{height:80px;}
.imagem1{float: left; width:40px; height:72px; border-radius:10px; }
.borda_imagem{border:2px solid #8cc9ff; border-radius:3px;}
.titulo1{float: right; width:105px; height:72px; text-align:center; color:#fff; font-weight:bold; padding-top:20px;}
/* ########### */

/* RODAPÉ */
footer {
            background-image: url(imagens/fundo_rodape.jpg);
			background-repeat: repeat;
            width: 100%;
			height:287px;
            bottom: 0;
            position: relative;
			margin-top:20px;
			text-align:center;
			padding-top:25px;
        }
.assinatura{float:right; margin-right:20px; margin-bottom:20px; margin-top:-20px; position: relative;}

/* breadcrumbs */
.caminhos{width:100%; height:38px; background-color:#f5f5f5; margin-top:8px;}
.alinha_caminhos{width:1035px; margin:0 auto;}
.organiza_meio{width:100%; height:auto}
.alinha_meio{width:1035px; margin:0 auto;}

.descricao_hotel{float:left; width:390px}
.checkin_checkout{float:left; margin-left:20px; width:450px}

.alinha_conteudo_hotel{width:1035px; height:auto; min-height:190px;  margin:0 auto; position:relative; clear:both  }
.alinha_formulario{position:relative; width:1035px; margin:0 auto; height:550px; clear:both}
</style>
</head>

<body>
<?php if(@$_GET["r"]==1){ ?>
<div id="dialog" title="Agendamento">
  <p> A solicitação foi concluída. Em breve iremos entrar em contato para confirmação de dados. Obrigado! </p>
</div>
<?php } ?>
<header>
<!-- INÍCIO CABEÇALHO -->
<div class="fundo_amarelo_topo"> </div>

<!-- ESPAÇO PARA AGÊNCIAS DE VIAGENS -->
<a href="#">
<div class="alinha_login_extranet"> 
	<div class="fundo_login_extranet">
		<div class="login_extranet"><img src="imagens/login_extranet.png" width="143" height="34" /> </div>
    </div>
</div>
</a>
<!-- FIM EPAV -->

<!-- MENU -->
<div class="alinha_topo_menu">
	<div class="logotipo"><a href="index.php"><img src="imagens/logo_andes.jpg" width="232" height="115" border="0"/></a> </div>
    <div class="alinha_menu">
		<div class="menu">
          <ul class="menu-list">
            <li><a href="index.php">Home <br /> Início </a></li>
            <li><a href="nossa-empresa.php">Nossa <br /> Empresa </a></li>
            <li><a href="viagens-programadas.php">Viagens <br /> Programadas </a></li>
            <li><a href="viagens-em-grupo.php">Viagens <br /> em grupo </a></li>
            <li><a href="viagens-individuais.php">Viagens <br /> Individuais </a></li>
            <li><a href="fale-conosco.php">Fale <br /> Conosco </a></li>
            <li><a href="nossas-noticias.php">Nossas <br /> Notícias </a></li>
            <li><a href="baixe-revistas-e-roteiros.php">Baixe Revistas <br /> e Roteiros </a></li>
          </ul>
        </div>   
    </div>
	
</div>
<!-- FIM MENU -->

<div class="barra_azul">
</div><!-- FIM BARRAZUL -->
</header>
<!-- FIM CABEÇALHO -->

<!-- meio -->


<div class="caminhos">
<div class="alinha_caminhos">
    <ol class="breadcrumb">
      <li><a href="#">Página Inicial</a></li>
      <li><a href="#">Hotéis</a></li>
      <li class="active">Agendamento de Hotel</li>
    </ol>
</div>

</div>

<div class="organiza_meio">
 <div class="alinha_meio">
    <div class="page-header">
      <h1> Agendamento de Hotel </h1>
    </div>
 
 <?php while ($resultado = mysql_fetch_assoc($query5)) { ?>
  <div class="cabecalho_hotel">
  	<div class="imagem_principal"> 
    	<div class="row">
          <div class="col-xs-6 col-md-3">

               <a href="#" class="thumbnail">
               <img src="imagem.php?arquivo=cms/uploads/hoteis/<?php echo  $resultado['imagem_principal']; ?>&largura=236&altura=168" />

            </a>
          </div>
          <h3 style="color:#069">  <?php print $resultado['nome_hotel']; ?> 
          <?php if($var=$resultado['estrelas']){ $x = 1; while ($x <= $var) { ?>    
                <img src="imagens/estrela.png" width="20"  height="20"/>
              <?php $x = $x + 1; } } ?>
              <small> Cód. <?php print $resultado['identificacao']; ?> </small>
          </h3>
          <p><strong><?php print $resultado['localizacao']; ?></strong><br /></p>
          <small>
          	<?php print $resultado['descricao']; ?>
          </small>
        
        </div>
    </div>
  
  </div>
  
  <div class="alinha_conteudo_hotel">
    <div class="descricao_hotel" > 
         <div class="list-group">
          <a href="#" class="list-group-item active">
            <strong> Tabela de Preços </strong><small style="float:right;"> Seleciona a sua opção: </small>
          </a>
<form name="enviaInteresse" action="envia-hotel.php" method="post">
   <?php
	$sql_pegPrecos = mysql_query("SELECT * FROM precos, apartamentos, hoteis WHERE hotel_id=idhoteis AND apartamento_id=idapartamentos AND hotel_id=$codigo");
	while ($row = mysql_fetch_array($sql_pegPrecos)){ 
	?>
          <a href="#" class="list-group-item">
          <input name="escolhe_apartamento" type="radio" value="<?php echo @$row['nome_apartamento'] ." - ".  @$row['sigla'] ; ?>" <?php if(@$row['idapartamentos']==@$_POST["escolhe_apartamento"]){ ?> checked="checked" <?php } ?> /> <?php echo $row['nome_apartamento'] . $row['sigla']; ?><br />
		<strong> R$ <?php echo $row['valor']; ?> </strong>
          </a>
    <?php  } ?>

        </div>
    </div>    
    <div class="checkin_checkout"> 
    

    <fieldset class="pure-form">
        <input type="text" style="width:155px;" name="checkin" id="checkin" value="<?php if(!empty($_POST["checkin"])){ echo $_POST["checkin"]; } else{ echo $_SESSION["checkin"]; } ?>" required="required" title="O Preenchimento da Data do Checkin é obrigatório!" placeholder="Entrada">
        <input type="text" style="width:155px;" name="checkout" id="checkout"  value="<?php if(!empty($_POST["checkout"])){ echo $_POST["checkout"]; } else{ echo $_SESSION["checkout"]; } ?>" required="required" title="O Preenchimento da Data do Checkout é obrigatório!" placeholder="Saída">&nbsp;
        <input type="number" value="<?php if(!empty($_POST["quartos"])){ echo $_POST["quartos"]; } else{ echo $_SESSION["quartos"]; } ?>" placeholder="Quantidade Quartos" style="width:307px; margin-top:5px; margin-bottom:5px" name="quartos">
        <input type="number" placeholder="Adultos" style="width:155px;" name="adultos" value="<?php if(!empty($_POST["adultos"])){ echo $_POST["adultos"]; } else{ echo $_SESSION["adultos"]; } ?>">
        <input type="number" placeholder="Filhos" style="width:155px;" name="filhos" value="<?php if(!empty($_POST["criancas"])){ echo $_POST["criancas"]; } else{ echo $_SESSION["criancas"]; } ?>">
    </fieldset>
    


    </div>
  </div>
  

  
  
  </div>
</div>
<!-- fim meio -->


<div class="alinha_formulario">  
  <!-- FORMULÁRIO INTERESSE -->

    <fieldset class="pure-form pure-form-stacked">
        <label for="name">Nome</label>
        <input id="nome" type="text" name="nome" placeholder="Nome" style="width:50%;" required="required" title="Por favor insira o nome completo">
        
        <label for="email">Email</label>
        <input id="email" type="email" name="email" placeholder="Email" style="width:50%;" required="required" title="O seu e-mail é de suma importância">
        
        <input name="codigo_hotel" type="hidden" value="<?php print $resultado['identificacao']; ?>" />
         <input name="codigo_retorno" type="hidden" value="<?php print $resultado['idhoteis']; ?>" />
        <input name="nome_hotel" type="hidden" value="<?php print $resultado['nome_hotel']; ?>" />

        <label for="cidade">Cidade</label>
        <input name="cidade" id="cidade" type="text" placeholder="Cidade" style="width:50%;" required="required">
        
        <label for="endereco">Endereço</label>
        <input id="endereco" name="endereco" type="text" placeholder="Endereço" style="width:50%;" required="required">
        
        <label for="telefone">Telefone</label>
        <input id="telefone" name="telefone" type="text" placeholder="Telefone" style="width:50%;" required="required" title="Como iremos entrar em contato? Seu telefone é fundamental para confirmamos os seus dados.">
        
        <label for="mensagem">Mensagem</label>
        <textarea name="mensagem" cols="" rows="" wrap="virtual" style="width:50%;"></textarea>

        <button type="submit" class="pure-button pure-button-primary">Enviar Reserva</button>
        
    </fieldset>
</form>
<?php } ?><br />

<small> Observação: O tarifáfio pode sofrer alterações de valor dependendo da data do envio deste contato. </small>

</div>

<footer>
<h4> Andes Turismo - Grupo Andes Travel Brasil </h4><br />
<p> Av. Assis Brasil, 1652 / 401. Passo D'Areia - Porto Alegre - RS </p>
<p> CEP 91010-001 - Telefone: 51 3342.0123 </p>
<p> E-mail: <a href="mailto:contato@andesturismo.com.br?subject=Contato">contato@andesturismo.com.br</a></p><br />
<p><img src="imagens/formas_pagamento.png" width="318" height="61" /></p>
<div class="assinatura"><a href="http://obracom.com.br/" target="_blank"><img src="imagens/assinatura_obracom.png" width="75" height="15" border="0" /></a></div>
</footer>
</body>
</html>
