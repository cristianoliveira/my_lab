<?php
include("inc/inc.bkl.php");
//$codigo = @$_POST["codigo_roteiro"];
$codigo = @$_GET["id"];
/* === CONSULTA 1: Roteiros breadcrumbs ==== */
$roteiros_meio1 = "SELECT * FROM `roteiros` WHERE idroteiros=$codigo AND status_roteiro = 1 LIMIT 1";
$destaques1 = mysql_query($roteiros_meio1); // Executa a consulta

/* === CONSULTA 2: Roteiro específico ==== */
$roteiros_meio = "SELECT * FROM `roteiros` WHERE idroteiros=$codigo AND status_roteiro = 1 LIMIT 1";
$destaques = mysql_query($roteiros_meio); // Executa a consulta

$sql2   = "SELECT * FROM `imagens_roteiros` WHERE id_roteiro=$codigo";
$query2 = mysql_query($sql2); // Executa a consulta

$sql3   = "SELECT * FROM `videos_roteiros` WHERE id_roteiro=$codigo";
$query3 = mysql_query($sql3); // Executa a consulta

$sql4   = "SELECT * FROM `roteiros` WHERE idroteiros=$codigo AND status_roteiro = 1 LIMIT 1";
$query4 = mysql_query($sql4); // Executa a consulta

// Modifica a zona de tempo a ser utilizada. Disnovível desde o PHP 5.1
date_default_timezone_set('UTC');

// Exibe a data atual formato banco
$data_atual = date("Y-m-d"); 

//cria sessao único do visitante
include "cria_sessao.php";
$sessao = $_SESSION["vinicius"];

/*  === CONSULTA 3: Roteiros Selecionados ==== */
$seleciona    = "SELECT * FROM `roteiros`, `roteiros_selecionados` WHERE id_roteiro=idroteiros AND sessao= '$sessao' AND data_inicio >= $data_atual ORDER BY data_inicio ASC LIMIT 5";
$selecionados = mysql_query($seleciona); // Executa a consulta
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php while ($descricaoAdd = mysql_fetch_assoc($query4)) { ?> 
<meta property="og:title" content="<?php echo strip_tags($descricaoAdd['nome_roteiro']); ?>" />
<meta property="og:image" content="http://www.andesturismo.com.br/novo/cms/uploads/roteiros/<?php echo $descricaoAdd['imagem_roteiro']; ?>" /> 
<meta property="og:description" content="<?php echo strip_tags($descricaoAdd['subtitulo']); ?>" />  
<meta property="og:url" content="http://www.andesturismo.com.br/novo/pagina-roteiro.php?id=<?php echo $descricaoAdd['idroteiros']; ?>" />
<?php } ?>

<title>Andes Turismo - Roteiros</title>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/redmond/jquery-ui.css">

 <!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!-- Redes addthis --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-544fbe62707f7eef" async="async"></script>


<script>
  $(function() {

// aumentando a fonte
	$(".inc-font").click(function () {
		var size = $("body").css('font-size');

		size = size.replace('px', '');
		size = parseInt(size) + 4;

		$("#programacao").animate({'font-size' : size + 'px'});
	});

	//diminuindo a fonte
	$(".dec-font").click(function () {
		var size = $("body").css('font-size');

		size = size.replace('px', '');
		size = parseInt(size) - 2;

		$("#programacao").animate({'font-size' : size + 'px'});
	});

	// resetando a fonte
	$(".res-font").click(function () {
		$("#programacao").animate({'font-size' : '12px'});
	});
	  
	  
$('.fancybox').fancybox();	  
$( "#tabs" ).tabs();

$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

$('#myTab a[href="#profile"]').tab('show') // Select tab by name
$('#myTab a:first').tab('show') // Select first tab
$('#myTab a:last').tab('show') // Select last tab
$('#myTab li:eq(2) a').tab('show') // Select third tab (0-indexed)

$('#dialog').dialog({
    autoOpen: true,
    show: "fade",
    hide: "fadeOut",
    modal: false,
    open: function(event, ui) {
        setTimeout(function(){
            $('#dialog').dialog('close');                
        }, 3500);
    }
});

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

		<link rel="stylesheet" type="text/css" href="player/demo.css" />
        <link rel="stylesheet" type="text/css" href="player/style.css" />
        <link rel="stylesheet" type="text/css" href="player/custom.css" />
		<script type="text/javascript" src="player/modernizr.custom.79639.js"></script>
        <script type="text/javascript" src="player/jquery.ba-cond.min.js"></script>
		<script type="text/javascript" src="player/jquery.slitslider.js"></script>
		<noscript>
			<link rel="stylesheet" type="text/css" href="player/styleNoJS.css" />
		</noscript>


<style type="text/css">

.inputOk{width:250px;}
label,  input {
	display: block;
	float: left;
}

label {	
	text-align: left;
	width: 80px;
	padding-right: 5px;
	padding-bottom: 5px;
}

fieldset {
	border:0;
}

br {
	clear: left;
}
acessibilidade {background: #2b2b2b;  float: right;}
.acessibilidade ul {padding:10px; width: 940px;height:30px;margin: 0 auto;text-align:left;position: relative;}
.acessibilidade li {display: inline-block; float: right;margin-right:1px;}
.acessibilidade li a { color:#fff; font-size:0.8em;padding:5px;background: #F90;vertical-align: middle;display: block; height:auto;
-moz-border-radius: 8px; -webkit-border-radius: 8px; -khtml-border-radius: 8px;border-radius: 8px;}
.acessibilidade li a:hover {background: #FC0;}
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

.descricao_hotel{float:left; width:220px}
.checkin_checkout1{float:left; margin-left:20px; width:450px}
.checkin_checkout2{float:left; margin-left:20px; width:320px}


.alinha_conteudo_hotel{width:1035px; height:auto; min-height:190px;  margin:0 auto; position:relative; clear:both  }
.alinha_formulario{position:relative; width:1035px; margin:0 auto; height:550px; clear:both}
.gallery{padding:3px;}

textarea {
	width: 600px;
	height: 120px;
	border: 3px solid #cccccc;
	padding: 5px;
	font-family: Tahoma, sans-serif;
	background-image: url(bg.gif);
	background-position: bottom right;
	background-repeat: no-repeat;
}
</style>
</head>

<body>
<?php if(@$_GET["r"]==1){ ?>
<div id="dialog" title="Roteiros"> <p> Você enviou um interesse neste rotero. Aguarde contato. Obrigado. </p> </div>
<? } ?>

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
      <li> Roteiros </li>   
      <?php while ($pegaDestaques1 = mysql_fetch_assoc($destaques1)) { ?> 
      <li class="active"> <?php echo  $pegaDestaques1['nome_roteiro']; ?> </li>    
      <?php } ?>
      </ol>
      
</div>

</div>
<?php while ($pegaDestaques = mysql_fetch_assoc($destaques)) { ?>
<div class="organiza_meio">
 <div class="alinha_meio">
    <div class="page-header">
      <h1> <?php echo  $pegaDestaques['nome_roteiro']; ?> <small> <?php echo  $pegaDestaques['subtitulo']; ?> </small></h1>
    </div>
  

<div>
  <img src="imagem.php?arquivo=cms/uploads/roteiros/<?php echo  $pegaDestaques['imagem_roteiro']; ?>&largura=1055&altura=310" style="margin-bottom:25px" />
  <br />

<!-- Nav tabs -->
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#programacao" role="tab" data-toggle="tab">Programação</a></li>
  <li role="presentation"><a href="#imagens" role="tab" data-toggle="tab">Ver galeria de imagens</a></li>
  <li role="presentation"><a href="#videos" role="tab" data-toggle="tab">Ver galeria de vídeos</a></li>
  <li role="presentation"><a href="#precos" role="tab" data-toggle="tab">Ver preços e condições</a></li>
  <li role="presentation"><form name="frmDownloadRoteiro" action="download-roteiro.php" method="post" target="_blank">
	  <button type="submit" class="btn btn-warning btn-lg" style="height:40px;">
          <span class="glyphicon glyphicon-download"></span> Download Roteiro
        </button>
        <input type="hidden" name="codigo" value="<?php echo  $pegaDestaques['idroteiros']; ?>" />
        </form></li>
</ul>

<!-- Tab panes -->
 <div class="acessibilidade" align="right">
<ul>
<li><a class="inc-font" title="Aumentar fonte" href="#"> + A</a></li>
<li><a class="res-font" title="Tamanho normal da fonte" href="#"> Original</a></li>
<li><a class="dec-font" title="Diminuir fonte" href="#"> - A</a></li>
</ul>
</div>

<div class="tab-content" style="height:auto; min-height:350px">

  <div role="tabpanel" class="tab-pane active" id="programacao">

  	    <h3 style="color: #369"><?php echo  $pegaDestaques['titulo_completo']; ?></h3>
    <small style="color: #CE0000;"><strong><?php echo  $pegaDestaques['datas_completas']; ?></strong> </small>
	<p> <?php echo  $pegaDestaques['programacao_diaria']; ?> </p>
  <center><a href="#precos" role="tab" data-toggle="tab" style="background-color:#06C; color:#fff; text-align:center; padding:10px; border-radius:10px;">QUERO IR NESTE ROTEIRO </a></center>
  </div>
  
  <div role="tabpanel" class="tab-pane" id="imagens">
  	  <?php while ($resultado2 = mysql_fetch_assoc($query2)) { $i=0; ?>  
    <a class="fancybox" href="cms/uploads/imagens/roteiros/<?php echo  $resultado2['img']; ?>" data-fancybox-group="gallery" title="<?php echo  $pegaDestaques['nome_roteiro']; ?>">
         <img src="imagem.php?arquivo=cms/uploads/imagens/roteiros/<?php echo  $resultado2['img']; ?>&largura=150&altura=150" />
    </a>
  <?php } ?>
  
  </div>
  
  <div role="tabpanel" class="tab-pane" id="videos">
  	       <?php while ($resultado3 = mysql_fetch_assoc($query3)) { $i=0; ?>  
     <div style="float:left; width:250px; height:250px; text-align:center; margin-right:15px;">
     <h3><?php echo  $resultado3['nome']; ?> </h3>
    <iframe width="250" height="250" src="//www.youtube.com/embed/<?php echo  $resultado3['link']; ?>" frameborder="0" allowfullscreen></iframe><br />
	</div>
  <?php } ?>
  </div>
 
  <div role="tabpanel" class="tab-pane" id="precos">
  <form name="frmEnviaRoteiro" action="envia-roteiro.php" method="post"> 
  	    <h3 style="color: #369"><?php echo  $pegaDestaques['titulo_completo']; ?></h3>
    <small style="color: #CE0000;"><strong><?php echo  $pegaDestaques['datas_completas']; ?></strong> </small><br />
    <p><input name="preco" type="radio" value="<?=  $pegaDestaques['preco_avista']; ?>" /><strong> Opção 1: <?=  $pegaDestaques['preco_avista']; ?> </p></strong>
   <? if(!empty($pegaDestaques['preco_parcelado'])){ ?> 
    <p><input name="preco" type="radio" value="<?=  $pegaDestaques['preco_parcelado']; ?>" /><strong> Opção 2:<?=   $pegaDestaques['preco_parcelado']; ?> </p></strong>
    
   <? } ?>
   <p><input name="preco" type="radio" value="Personalizada" /><strong> Outra opção: Mande a sua (preencha abaixo) </p></strong>
   <p> <textarea name="proposta" cols="" rows=""></textarea></p><br />
<p>
 <fieldset>
  <label for="usuario">Nome:</label>
  <input type="text" name="nome" id="nome" required="required" class="inputOk" /><br />
  <label for="senha">E-mail:</label>
  <input type="email" id="email" name="email" required="required"  class="inputOk" /><br />
  <label for="senha">Telefone:</label>
  <input type="text" id="telefone" name="telefone" required="required"  class="inputOk" /><br />
  </fieldset>
  
    <input type="hidden" name="nomedoroteiro" value="<?php echo  $pegaDestaques['titulo_completo']; ?>" />
  <input type="hidden" name="datasroteiros" value="<?php echo  $pegaDestaques['datas_completas']; ?>" />
  <input type="hidden" name="identificacao" value="<?php echo  $pegaDestaques['identificacao']; ?>" />
 </p><br />
  
   <p>

    <button type="submit" class="btn btn-primary btn-lg" style="height:40px;">
          <span class="glyphicon glyphicon-play"></span> Enviar Proposta
        </button>
        </form>
   </p>
  </div>
  
</div>




<!-- Nav tabs -->


</div>
 
  </div>
</div>
<!-- fim meio -->
 <?php } ?>

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
