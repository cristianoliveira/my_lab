<?php

session_start();

$_BS['MySQL']['servidor'] = 'mysql.andesturismo.com.br';
$_BS['MySQL']['usuario'] = 'andesturismo02';
$_BS['MySQL']['senha'] = 'c1a5k0';
$_BS['MySQL']['banco'] = 'andesturismo02';
//$con = mysql_connect($_BS['MySQL']['servidor'], $_BS['MySQL']['usuario'], $_BS['MySQL']['senha']) or trigger_error(mysql_error(),E_USER_ERROR);

$conexao = mysqli_connect("mysql.andesturismo.com.br","andesturismo02","c1a5k0", 'andesturismo02');

// echo "ERR ".mysqli_connect_errno();
// echo "ERR ".mysql_error();

// Modifica a zona de tempo a ser utilizada. Disnovível desde o PHP 5.1
date_default_timezone_set('UTC');

// Exibe a data atual formato banco
$data_atual = date("Y-m-d"); 

//cria sessao único do visitante
$sessao = 'c084ac290de644ca917d8b9c046d0416';//$_POST["token"];

/* === CONSULTA 2: Roteiros Destaques corpo do site abaixo das buscas ==== */
$roteiros_meio2 = "SELECT * FROM `roteiros`, roteiros_selecionados WHERE id_roteiro=idroteiros AND status_roteiro=1 AND sessao='$sessao' AND data_inicio >= $data_atual ORDER BY data_fim";
$destaques = mysqli_query( $conexao, $roteiros_meio2); // Executa a consulta

/*  === CONSULTA 3: Roteiros Selecionados ==== */
$roteiros_meio = "SELECT * FROM `roteiros`, roteiros_selecionados WHERE id_roteiro=idroteiros AND status_roteiro=1 AND sessao='$sessao' AND data_inicio >= $data_atual ORDER BY data_fim";
$selecionados = mysqli_query( $conexao, $roteiros_meio); // Executa a consulta

echo "$roteiros_meio";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Andes Turismo - Roteiro selecionados</title>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/redmond/jquery-ui.css">

<script>
  $(function() {

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
			clear:both;
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

.alinha_conteudo_hotel{width:1035px; height:auto; min-height:450px;  margin:0 auto; position:relative; clear:both  }
.alinha_formulario{position:relative; width:1035px; margin:0 auto; height:550px; clear:both}
.gallery{padding:3px;}

/* roteiros destaques */
.alinha_destaques{width:1035px; height:auto; min-height:150px;  margin:0 auto;  }
.roteiro_destaque{width:250px; height:420px; min-height:410px; background-color:#fff3c5; border-top-right-radius:20px; border-top-left-radius:20px; float:left;  margin-left:8px; margin-bottom:8px;}
.titulo_destaque{width:250px; margin:0; height:40px;  background: linear-gradient(to top, #fbdd77 , #edc114); /* Standard syntax */ border-top-right-radius:20px; border-top-left-radius:20px; 
line-height:40px; vertical-align:middle; text-align:center; color:#2676ba; font-weight:bold; text-transform:uppercase}
legend{background-color:#ffe488; text-align:center; color:#d92029; font-weight:700; font-size:15px; height:30px; line-height:30px; vertical-align:middle; border-bottom:0;}

.descricao_roteiro{width:250px; margin; text-align:center; color:#1f6fb2; font-weight:bold; font-size:12px; margin-bottom:6px;}
.espaco-mais{height:250px;}
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
      <li class="active"> 
      Roteiros selecionados
      </li>    
      
      </ol>
</div>

</div>

<div class="organiza_meio">
 <div class="alinha_meio">
    <div class="page-header">
      <h1> Roteiros Selecionados </h1>
    </div>
   <?php 
    if(mysqli_num_rows($destaques)>0){
   while ($pegaDestaques = mysqli_fetch_assoc($destaques)) { ?> 
    <!-- REPETE -->
    <div class="roteiro_destaque">
    <div class="titulo_destaque"> <?php echo  $pegaDestaques['nome_roteiro']; ?> </div>
    <ul id="imagepreview2">
     <li>
            <a href="imagem.php?arquivo=cms/uploads/roteiros/<?php echo  $pegaDestaques['imagem_roteiro']; ?>&largura=640&altura=480" class="preview2" title="">
               <img src="imagem.php?arquivo=cms/uploads/roteiros/<?php echo  $pegaDestaques['imagem_roteiro']; ?>&largura=250&altura=207" />
            </a>  
        </li> 
     </ul>
    <legend class="formata_legend"> <?php echo  $pegaDestaques['datas_completas']; ?> </legend>
    <div class="descricao_roteiro"> 
       <?php
$paises = "SELECT * FROM `paises`,`roteiros`,`relacoes_paises_roteiros` WHERE idroteiros=id_roteiro AND idpaises=id_pais AND id_roteiro=".$pegaDestaques['idroteiros'];         

                $pega_paises = mysqli_query($conexao,$paises); // Executa a consulta
                $cont = mysqli_num_rows($pega_paises); // Conta número de linhas da consulta
                $i = 0;

                        
                        while ($paisok = mysqli_fetch_array($conexao,$pega_paises))
                            {
                                $i++;
                                if($i == $cont){
                                    echo  $paisok['nome_pais']  .  "."; //pega nome do pais e concatena com ponto por ser o último
                                }else{
                                    echo  $paisok['nome_pais']  .  ", "; //pega nome do pais e concatena com vírgula
                                }
                            }
   ?>
    </div>

	<div align="center">
    <form action="pagina-roteiro.php" method="post" name="frmVerRoteiros">
    <button type="submit" class="btn btn-primary glyphicon glyphicon-zoom-in" >
         <span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">Veja mais</span>
    </button>
     <input type="hidden" name="codigo_roteiro" value="<?php echo  $pegaDestaques['idroteiros']; ?>" />
    </form>
    </div>

 
    </div>    
    <!-- FIM REPETE -->
    <?php } 
	} else{ echo "Não há roteiros selecionados no momento."; } ?> 

 
  </div>
</div>
<!-- fim meio -->


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
