<?php
session_start(); //pega os dados da busca e salva na sessao

include("inc/functions.php");
// Conexão com o MySQL
// ========================
$_BS['MySQL']['servidor'] = 'mysql.andesturismo.com.br';
$_BS['MySQL']['usuario'] = 'andesturismo02';
$_BS['MySQL']['senha'] = 'c1a5k0';
$_BS['MySQL']['banco'] = 'andesturismo02';
mysql_connect($_BS['MySQL']['servidor'], $_BS['MySQL']['usuario'], $_BS['MySQL']['senha']);
mysql_select_db($_BS['MySQL']['banco']);
// ====(Fim da conexão)====

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
include "cria_sessao.php";
$sessao = $_SESSION["vinicius"];

/* mexeu aqui */
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
<title>Andes Turismo - Resultado de Hotéis</title>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>

 <!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />


<script>
//<![CDATA[
this.imagePreview = function(){ 
 /* CONFIG */
xOffset = 200; // distancia do topo //
yOffset = 30; // distancia a esquerda //

// estas duas variáveis determinam a distância popup a partir do cursor
// se precisar ajuste para obter o resultado correto

/* END CONFIG */
$("a.preview").hover(function(e){
this.t = this.title;
this.title = "";
var c = (this.t != "") ? "<br/>" + this.t : "";
$("body").append("<p id='preview' style='z-index:9998'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");
$("#preview")
.css("top",(e.pageY - xOffset) + "px")
.css("left",(e.pageX + yOffset) + "px")
.fadeIn("fast");
},
function(){
this.title = this.t;
$("#preview").remove();
});
$("a.preview").mousemove(function(e){
$("#preview")
.css("top",(e.pageY - xOffset) + "px")
.css("left",(e.pageX + yOffset) + "px");
});
};

  $(function() {
	  
	$('.fancybox').fancybox();	  
	  
setTimeout(function(){ $('.aparece-busca').show(), $('.progress').hide(); }, 2000);
	  
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

    },300);
	  
	  imagePreview();
	  

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
.organiza_meio{width:100%; height:auto; min-height:800px;}
.alinha_meio{width:1035px; margin:0 auto;}

.descricao_hotel{float:left; width:250px}
.checkin_checkout{float:left; margin-left:20px; width:450px}

.alinha_conteudo_hotel{width:1035px; height:auto; min-height:190px;  margin:0 auto; position:relative; clear:both  }
.alinha_formulario{position:relative; width:1035px; margin:0 auto; height:550px; clear:both}
.gallery{padding:3px;}
</style>
</head>

<body>

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
      <li><a href="#"> Busca de Hotéis</a></li>
      <li class="active">Resultados</li>
    </ol>
</div>

</div>

<div class="organiza_meio">
 <div class="alinha_meio">
    <div class="page-header">
      <h1> Busca de Hotéis <small> Resultados</small></h1>
    </div>
  

  <div class="progress">
      <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0" data-percentage="100">
        
      </div>
  </div>  

<div class="aparece-busca" style="display:none">

<p> <strong> Você buscou por: </strong> 
<?php if(!empty($_SESSION["palavra-chave"])){ print $_SESSION["palavra-chave"] . " "; } ?>
<?php if(!empty($_SESSION["checkin"])){ print "<strong>Checkin:</strong>      ". formatarData($_SESSION["checkin"]); } ?>
<?php if(!empty($_SESSION["checkout"])){ print "<strong> - Checkout: </strong>". formatarData($_SESSION["checkout"]); } ?>
<?php if(!empty($_SESSION["adultos"])){ print "<strong> Adultos: </strong>    ". $_SESSION["adultos"]; } ?>
<?php if(!empty($_SESSION["criancas"])){ print ",<strong> Crianças: </strong>  ". $_SESSION["criancas"]; } ?>
<?php if(!empty($_SESSION["quartos"])){ print "<strong> e Quartos: </strong>  ". $_SESSION["quartos"]; } ?>
</p>

<?php $testa = mysql_fetch_assoc($query2); if(!empty($testa)){ ?> 
<div class="alert alert-info" role="alert"> Você encontrou o que procurava. Aqui estão os resultados de sua busca. </div>
<?php } else{ ?>
<div class="alert alert-danger" role="alert"> Infelizmente não temos o que você procura agora. Mas talvez você possa se interessar por alguns dos hotéis abaixo. Obrigado! </div>
<?php 
//if(!empty($query)){
while ($resultado = mysql_fetch_assoc($query5)) { ?>
<!--- AQUI REPETE -->
<div class="panel panel-default">
  <div class="panel-body">
          <h3 style="color:#069">
			  <?php print $resultado['nome_hotel']; ?>
              <?php if($var=$resultado['estrelas']){ $x = 1; while ($x <= $var) { ?>    
                <img src="imagens/estrela.png" width="20"  height="20"/>
              <?php $x = $x + 1; } } ?>
              <small> Cód. <?php print $resultado['identificacao']; ?> </small>
          </h3>
          <p><strong> <?php print $resultado['localizacao']; ?> </strong><br /></p>
 
  
  <div class="cabecalho_hotel">
  	<div class="imagem_principal"> 
    	<div class="row">
          <div class="col-xs-6 col-md-3">
            <a class="thumbnail">
              <img src="imagem.php?arquivo=cms/uploads/hoteis/<?php echo $resultado['imagem_principal']; ?>&largura=236&altura=168" />
            </a>
          </div>

          <small>
          	<?php echo $resultado['descricao']; ?>
          </small>
        

  
  </div>
 
  </div>
</div>
  
  <div class="alinha_conteudo_hotel">
    <div class="descricao_hotel" > 
      <?php $codigo=$resultado['idhoteis']; ?>   
    <ul id="imagepreview">
 	<?php
	$sql_pegaImagens = mysql_query("SELECT * FROM imagens WHERE id_imovel=$codigo");
	while ($row = mysql_fetch_assoc($sql_pegaImagens)){ 
	?>
        
        <!--- repete -->
        <li>
            <a href="imagem.php?arquivo=cms/uploads/imagens/hoteis/<?php echo $row['img']; ?>&largura=640&altura=480" class="preview" title="<?php $resultado['nome_hotel']; ?>">
                <img src="imagem.php?arquivo=cms/uploads/imagens/hoteis/<?php echo $row['img']; ?>&largura=66&altura=66" />
            </a>  
        </li> 
        <!--- repete -->
     <?php  } ?>
</ul>
    
    </div>    
    <div class="checkin_checkout"> 
    
    
     
         <div class="list-group">
         
      <a href="#" class="list-group-item active">
            <strong> Tabela de Preços </strong>
          </a>
         
    <?php
	$sql_pegPrecos = mysql_query("SELECT * FROM precos, apartamentos, hoteis WHERE hotel_id=idhoteis AND apartamento_id=idapartamentos AND hotel_id=$codigo");
	while ($row = mysql_fetch_array($sql_pegPrecos)){ 
	?>
          <a href="#" class="list-group-item">
          <?php echo $row['nome_apartamento'] . $row['sigla']; ?><strong> R$ <?php echo $row['valor']; ?> </strong>
          </a>
    <?php  } ?>


        </div>

    </div>
  </div>
  

        </div>

<div style="margin-left:20px; margin-bottom:20px">        
<button type="button" class="btn btn-warning glyphicon glyphicon-share" style="margin-top:5px;" onClick="location.href='pagina-hotel.php?id=<?php echo $resultado['idhoteis']; ?>'" >
<span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;"> Ver mais detalhes </span>
</button>

<br />

<button type="button" class="btn btn-primary glyphicon glyphicon-thumbs-up" style="margin-top:5px;" onClick="location.href='pagina-hotel.php?id=<?php echo $resultado['idhoteis']; ?>'">
<span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;"> Quero este hotel </span>
</button>

</div>


    </div>
<!--- FIM REPETE --> 
<?php }  ?>



<!-- AQUI É QUANDO NÃO HAVIA RESULTADO -->
<?php } ?>


<?php 
//if(!empty($query)){
while ($resultado = mysql_fetch_assoc($query)) { ?>
<!--- AQUI REPETE -->
<div class="panel panel-default">
  <div class="panel-body">
          <h3 style="color:#069">
			  <?php print $resultado['nome_hotel']; ?>
              <?php if($var=$resultado['estrelas']){ $x = 1; while ($x <= $var) { ?>    
                <img src="imagens/estrela.png" width="20"  height="20"/>
              <?php $x = $x + 1; } } ?>
              <small> Cód. <?php print $resultado['identificacao']; ?> </small>
          </h3>
          <p><strong> <?php print $resultado['localizacao']; ?> </strong><br /></p>
 
  
  <div class="cabecalho_hotel">
  	<div class="imagem_principal"> 
    	<div class="row">
          <div class="col-xs-6 col-md-3">
            <a class="thumbnail">
              <img src="imagem.php?arquivo=cms/uploads/hoteis/<?php echo $resultado['imagem_principal']; ?>&largura=236&altura=168" />
            </a>
          </div>

          <small>
          	<?php echo $resultado['descricao']; ?>
          </small>
        

  
  </div>
 
  </div>
</div>
  
  <div class="alinha_conteudo_hotel">
    <div class="descricao_hotel" > 
      <?php $codigo=$resultado['idhoteis']; ?>   
    <ul id="imagepreview">
 	<?php
	$sql_pegaImagens = mysql_query("SELECT * FROM imagens WHERE id_imovel=$codigo");
	while ($row = mysql_fetch_assoc($sql_pegaImagens)){ 
	?>
        
        <!--- repete -->
        <li>
            <a href="cms/uploads/imagens/hoteis/<?php echo $row['img']; ?>" class="fancybox" title="<?php $resultado['nome_hotel']; ?>" target="_blank">
                <img src="imagem.php?arquivo=cms/uploads/imagens/hoteis/<?php echo $row['img']; ?>&largura=66&altura=66" />
            </a>  
        </li> 
        <!--- repete -->
     <?php  } ?>
</ul>
    
    </div>    
    <div class="checkin_checkout"> 
    
    
     
         <div class="list-group">
         
      <a href="#" class="list-group-item active">
            <strong> Tabela de Preços </strong>
          </a>
         
    <?php
	$sql_pegPrecos = mysql_query("SELECT * FROM precos, apartamentos, hoteis WHERE hotel_id=idhoteis AND apartamento_id=idapartamentos AND hotel_id=$codigo");
	while ($row = mysql_fetch_array($sql_pegPrecos)){ 
	?>
          <a href="#" class="list-group-item">
          <?php echo $row['nome_apartamento'] . $row['sigla']; ?><strong> R$ <?php echo $row['valor']; ?> </strong>
          </a>
    <?php  } ?>


        </div>

    </div>
  </div>
  

        </div>

<div style="margin-left:20px; margin-bottom:20px">        
<button type="button" class="btn btn-warning glyphicon glyphicon-share" style="margin-top:5px;" onClick="location.href='pagina-hotel.php?id=<?php echo $resultado['idhoteis']; ?>'">
<span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;"> Ver mais detalhes </span>
</button>

<br />
<button type="button" class="btn btn-primary glyphicon glyphicon-thumbs-up" style="margin-top:5px;" onClick="location.href='pagina-hotel.php?id=<?php echo $resultado['idhoteis']; ?>'" >
<span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;"> Quero este hotel </span>
</button>
</div>


    </div>
<!--- FIM REPETE --> 
<?php }  ?>





 
 <?php  include("inc/_paginate.php"); ?>
  
 </div>
 
   
    

  </div>
</div>
<!-- fim meio -->




<center><small>
Todos os preços do site são sujeitos à disponibilidade de lugares no ato da solicitação da reserva e a alteração sem aviso prévio.
</small></center>

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
