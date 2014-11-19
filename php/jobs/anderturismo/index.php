<?php
// Turn off all error reporting
error_reporting(0);

include("inc/inc.bkl.php");
//include("cria_sessao.php");


// Modifica a zona de tempo a ser utilizada. Disnovível desde o PHP 5.1
date_default_timezone_set('UTC');

// Exibe a data atual formato banco
$data_atual = date("Y-m-d"); 

session_start();
//cria sessao único do visitante
$sessao = $_SESSION["vinicius"];
//echo $sessao;
//exit();

/* === CONSULTA 1: Roteiros Ativos ==== */
/* Roteiros Destaques Cabeçalho */
$roteiros_cabecalho = "SELECT * FROM `roteiros` WHERE status_roteiro=1 AND destaque_home_cabecalho=1 AND data_inicio >= $data_atual ORDER BY rand() LIMIT 6";
$exclusivos = mysql_query($roteiros_cabecalho); // Executa a consulta

if(empty($_GET["maisroteiros"])){
/* === CONSULTA 2: Roteiros Destaques corpo do site abaixo das buscas ==== */
$roteiros_meio = "SELECT * FROM `roteiros` WHERE status_roteiro=1 AND destaque_home_roteiros=1 AND data_fim >= $data_atual ORDER BY rand() LIMIT 8";
} else{ $maisroteiroscont=$_GET["maisroteiros"];  $roteiros_meio = "SELECT * FROM `roteiros` WHERE status_roteiro=1 AND destaque_home_roteiros=1 AND data_fim >= $data_atual ORDER BY rand() LIMIT $maisroteiroscont"; }

$destaques = mysqli_query($roteiros_meio); // Executa a consulta

echo "aaa".mysql_error();
print_r($destaques);

/*  === CONSULTA 3: Roteiros Selecionados ==== */
$seleciona    = "SELECT * FROM `roteiros`, `roteiros_selecionados` WHERE id_roteiro=idroteiros AND sessao= '$sessao' AND data_inicio >= $data_atual ORDER BY data_inicio ASC LIMIT 5";
$selecionados = mysql_query($seleciona); // Executa a consulta

/*  === CONSULTA 4: Banners dinâmicos ==== */
$banners      = "SELECT * FROM `banners` ORDER BY rand()";
$pega_banners = mysql_query($banners); // Executa a consulta

/*  === CONSULTA 5: Pega Países / Destinos ==== */
$paises      = "SELECT * FROM `paises` ORDER BY nome_pais ASC";
$pega_paises = mysql_query($paises); // Executa a consulta

/*  === CONSULTA 6: Pega Parceiros ==== */
$parceiros      = "SELECT * FROM `parceiros` ORDER BY rand() LIMIT 1";
$pega_parceiros    = mysql_query($parceiros); // Executa a consulta
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Andes ::: Viagens e Turismo :::</title>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/redmond/jquery-ui.css">

<script>

//<![CDATA[
this.imagePreview = function(){ 
 /* CONFIG */
xOffset = 200; // distancia do topo //
yOffset = 30; // distancia a esquerda //

// estas duas variáveis determinam a distância popup a partir do cursor
// se precisar ajuste para obter o resultado correto

/* END CONFIG */
$("a.preview2").hover(function(e){
this.t = this.title;
this.title = "";
var c = (this.t != "") ? "<br/>" + this.t : "";
$("body").append("<p id='preview2' style='z-index:9998'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");
$("#preview2")
.css("top",(e.pageY - xOffset) + "px")
.css("left",(e.pageX + yOffset) + "px")
.fadeIn("fast");
},
function(){
this.title = this.t;
$("#preview2").remove();
});
$("a.preview2").mousemove(function(e){
$("#preview2")
.css("top",(e.pageY - xOffset) + "px")
.css("left",(e.pageX + yOffset) + "px");
});
};

  $(function() {


		var dates = $( "#data_entra, #data_saida" ).datepicker({
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
			var option = this.id == "data_entra" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});

	


		$("#data_entra").datepicker({showButtonPanel: true});
		$("#data_saida").datepicker({showButtonPanel: true});
		
		
		$("#data_inicio, #data_fim").datepicker({
    dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
});

	

	  
	  //$( "#dialog" ).dialog();
	  
$('#dialog').dialog({
    autoOpen: true,
    show: "fade",
    hide: "fadeOut",
    modal: false,
    open: function(event, ui) {
        setTimeout(function(){
            $('#dialog').dialog('close');                
        }, 3000);
    }
});
	    
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

.organiza_roteiros{width:200px; height:80px; z-index:99999;}
.imagem1{float: left; width:40px; height:72px; border-radius:10px; }
.borda_imagem{border:2px solid #8cc9ff; border-radius:3px;}
.titulo1{float: right; width:105px; height:72px; text-align:center; color:#fff; font-weight:bold; padding-top:20px;}
/* ########### */

.fundo_player{ z-index:5; height:600px;} /* width:auto; height:650px; background-color:#0F0; */
.fundo_roteiros_destaques{width:1035px; height:150px; margin:0 auto; margin-top: -150px; position:relative; z-index:9955;
background: rgb(255, 244, 199) transparent;
background: rgba(255, 244, 199, 0.7);
filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#fff4c7, endColorstr=#fff4c7);/* Para navegadores IE 5.5 - 7 */
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#fff4c7, endColorstr=#fff4c7)"; /* Para navegadores IE 8 */
}

figcaption {
width:143px;
height:43px;
text-align:center;
font-family: Arial, Helvetica, sans-serif;
font-size: 11px;
color: white;
position:absolute;
margin-top: -48px;

margin-left: 3%;
padding: 9px;
color:#1e3f75;
text-transform:uppercase;
font-weight:bold;
background: rgb(235, 187, 1) transparent;
background: rgba(235, 187, 1, 0.7);
filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#ebbb01, endColorstr=#ebbb01);/* Para navegadores IE 5.5 - 7 */
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#ebbb01, endColorstr=#ebbb01)"; /* Para navegadores IE 8 */
}

a {
  color: #900;
  text-decoration: none;
}

a:hover {
  color: red;
  position: relative;
}

a[data-title]:hover:after {
  content: attr(data-title);
  padding: 8px 8px;
  color: #000;
  font-weight:bold;
  position: absolute;
  text-align:center;
  left: 5px;
  top: 125px;
  white-space: nowrap;
  z-index: 20px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-box-shadow: 0px 0px 4px #222;
  -webkit-box-shadow: 0px 0px 4px #222;
  box-shadow: 0px 0px 4px #222;
  background-color: #eec31a;
}

/* Estiliza lista dos roteiros exclusivos */
.destaques{list-style:none; border:1px solid inherit; float:left; margin-top:15px; margin-left:32px; }
.destaques li{position:relative; width:152px; float:left; margin-right:10px;  }
.destaques li a{color:#333;text-decoration:none; display:block; border-width:5px; border-style:solid; border-color:transparent}
.destaques li a:hover{background:#333; color:#fff; border:5px solid #1e3f75 }

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

/* BUSCAS */
.alinha_buscas{width:1035px; margin:0 auto; margin-top:10px; height: 345px;}
.busca_azul{width:500px; height:330px; background-color:#1e3f75; border-radius:20px; float:left; }
.busca_amarela{width:500px; height:330px; background-color:#eec31a; border-radius:20px; float:right; }
.titulo_busca{font-size:21px; color:#fff; font-family:"Myriad Pro", "Trebuchet MS", Tahoma; text-align: center; margin-top:20px; height:auto;}
.texto_auxiliar{font-size:13px; color:#fff; font-family:"Myriad Pro", "Trebuchet MS", Tahoma; text-align: center; margin-top:15px; height:auto;}
.campo_buscar_roteiro{text-align:center; height:50px; margin-top:50px;}
.campo_buscar_roteiro2{text-align:center; height:50px; margin-top:30px;}

.titulo_busca2{font-size:21px; color:#000; font-family:"Myriad Pro", "Trebuchet MS", Tahoma; text-align: center; margin-top:20px; height:auto;}
.texto_auxiliar2{font-size:13px; color:#000; font-family:"Myriad Pro", "Trebuchet MS", Tahoma; text-align: center; margin-top:5px; height:auto;}

.estiliza_input{padding: .5em .6em; display: inline-block; border: 1px solid #ccc; box-shadow: inset 0 1px 3px #ddd; border-radius: 4px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; width:75%; z-index:9998; }
.estiliza_input2{padding: .2em .3em; display: inline-block; border: 1px solid #ccc; box-shadow: inset 0 1px 3px #ddd; border-radius: 4px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;
box-sizing: border-box; width:165px; color:#06C }
.estiliza_input3{padding: .2em .3em; display: inline-block; border: 1px solid #ccc; box-shadow: inset 0 1px 3px #ddd; border-radius: 4px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;
box-sizing: border-box; width:95%;  }

.estiliza_input4{padding: .2em .3em; display: inline-block; border: 1px solid #ccc; box-shadow: inset 0 1px 3px #ddd; border-radius: 4px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;
box-sizing: border-box; width:200px; margin-right:5px;  }


.botao_buscar{width:150px; height:30px; margin:0 auto; margin-top:20px; }
.botao_buscar2{width:150px; height:30px; margin:0 auto; margin-top:20px; }
.btn_buscar{width:150px; height:35px; border-radius:4px; border:1px solid #407ceb; color:#fff; font-weight:bold; background-image: linear-gradient(to top, #3e91d7, #1c6bae);}
.btn_buscar:hover{background-color:#3e91d7; color:#1e3f75; border:1px solid #407ceb; background-image: linear-gradient(to top, #3e91d7, #1c6bae);}

.mais_filtros{width:150px; height:30px; margin:0 auto; margin-top:10px; }
.btn_mais_filtros{width:150px; height:35px; line-height:35px; vertical-align:middle; text-align:center; background-color:#2170b4; border-radius:4px; border:0; color:#fff; font-weight:bold}
.btn_mais_filtros:hover{background-color:#3e91d7; color:#1e3f75; border:0;}

.aparece_filtros{width:150px; height:350px; background-color:#3d90d8; position: relative; z-index:9999; display: none; margin-left:330px; margin-top:-80px; clear:both}
.alinha_filtros{width:122px; height: auto; margin:0 auto; color:#fff; font-size:11px; padding-top:12px;  }
.formatafiltros{width:100%; height:25px; border-radius:0; color:#06C; margin-top:-5px;}
.formatafiltros:focus{width:100%; height:25px; border-radius:0; color:#06C; margin-top:-5px; border-color:#1e3f75}

.alinha_datas{width:370px; height:50px; margin:0 auto; margin-top:-5px; }
.alinha_datas2{width:360px; height:50px; margin:0 auto; margin-top:8px; text-align:left; }
.data_entra{font-size:11px; color:#000;}

/* roteiros destaques */
.alinha_destaques{width:1035px; height:auto; min-height: 1430px;  margin:0 auto;  }
.roteiro_destaque{width:250px; height:420px; min-height:410px; background-color:#fff3c5; border-top-right-radius:20px; border-top-left-radius:20px; float:left;  margin-left:8px; margin-bottom:8px;}
.titulo_destaque{width:250px; margin:0; height:40px;  background: linear-gradient(to top, #fbdd77 , #edc114); /* Standard syntax */ border-top-right-radius:20px; border-top-left-radius:20px; 
line-height:40px; vertical-align:middle; text-align:center; color:#2676ba; font-weight:bold; text-transform:uppercase}
legend{background-color:#ffe488; text-align:center; color:#d92029; font-weight:700; font-size:15px; height:30px; line-height:30px; vertical-align:middle; border-bottom:0;}

.descricao_roteiro{width:250px; margin; text-align:center; color:#1f6fb2; font-weight:bold; font-size:12px; margin-bottom:6px;}
.parceiros-fundo{z-index:88;height:230px; clear:both; width:1035px;}
.parceiros-logotipos{width:118px; height:90px; background-color:#fff; margin:0 auto; z-index:999; position: relative; margin-top:-105px; }
.redes-sociais{margin-top:20px;}
.fundo-parceiros{margin-top:12px}
</style>
</head>

<body>
<?php if(@$_GET["r"]==1){ ?>
<div id="dialog" title="Roteiro adicionado"> <p> Você adicionou um roteiro. </p> </div>
<?php } if(@$_GET["r"]==2){ ?>
<div id="dialog" title="Newsletter"> <p> O seu e-mail foi adicionado. Obrigado. </p> </div>
<?php } ?>

<?php if(@$_GET["r"]==3){ ?>
<div id="dialog" title="Alerta"> <p> O roteiro selecionado já está incluído. Por favor, escolha outro. </p> </div>
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
	<div class="logotipo"><img src="imagens/logo_andes.jpg" width="232" height="115" /> </div>
    <div class="alinha_menu">
		<div class="menu">
          <ul class="menu-list">
            <li><a href="#">Home <br /> Início </a></li>
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
	<div class="centraliza_botao_roteiros">
            

        
        <button type="button" class="btn btn-primary glyphicon glyphicon-globe" style="float:right; width:305px; margin-top:-5px; height:38px; border:0;">
          <span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;" class="abrir">
          <?php if (mysql_num_rows($selecionados)>0){ ?>
          Confira os roteiros relacionados.
         

          </span>
        </button>
        
        
                    <!-- LAYER APARECE ROTEIROS CLICADOS -->
            <div class="layer_flutuante" style="display:none;">
              <div class="alinha_roteiros_clicados">
        
                    <!-- AQUI REPETE LIMIT DE 3 --> 
                    <?php while ($pegaSelecionados = mysql_fetch_assoc($selecionados)) { ?>     
                    <div class="organiza_roteiros">
                        <div class="imagem1">
                        	<img src="imagem.php?arquivo=cms/uploads/roteiros/<?php echo  $pegaSelecionados['imagem_roteiro']; ?>&largura=91&altura=72" class="borda_imagem" />
                        </div>
                        <div class="titulo1"> <?php echo  $pegaSelecionados['nome_roteiro']; ?> </div>
                    </div>  
                     <?php } ?>  
                    <!-- FIM REPETE -->      
                         
                 <form action="roteiros-selecionados.php" name="frmSelecionados" method="post">   
                 <button type="submit" class="btn btn-warning glyphicon glyphicon-asterisk" style="border:0; margin-bottom:20px; ">
                  <span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">Ver todos</span>
                  <input type="hidden" value="<?php echo  $sessao; ?>" name="token" />
                </button>       
              </div>
            </div>
        <!-- FIM ROTEIROS CLICADOS -->
        
         <?php } else { ?>
          Nenhum roteiro adicionado.    
          <?php } ?>     
        
   </div>   
   
</div><!-- FIM BARRAZUL -->
</header>
<!-- FIM CABEÇALHO -->
<main>
<!-- Player -->
<div class="fundo_player">
        <div class="container demo-2">
		
			<!-- Codrops top bar -->
			
            <div id="slider" class="sl-slider-wrapper">

				<div class="sl-slider">
				
                <?php while ($superbanners = mysql_fetch_assoc($pega_banners)) { ?> 
                
					<div class="sl-slide" data-orientation="<?php echo  $superbanners['orientacao']; ?>" data-slice1-rotation="<?php echo  $superbanners['rotacao1']; ?>" data-slice2-rotation="<?php echo  $superbanners['rotacao2']; ?>" data-slice1-scale="<?php echo  $superbanners['escala1']; ?>" data-slice2-scale="<?php echo  $superbanners['escala2']; ?>">
                    
						<div class="sl-slide-inner">
						<div class="bg-img bg-img-1" style="background-image: url(cms/uploads/banners/<?php echo  $superbanners['imagem']; ?>);">
                        </div>                        
                            <a href="<?php echo  $superbanners['link']; ?>" style="color:#fff; text-decoration:none"> 
							<h2><?php echo  $superbanners['titulo_principal']; ?></h2>
							<blockquote>
                            	<p><?php echo  $superbanners['subtitulo']; ?></p>
                            	<cite><?php echo  $superbanners['tipo']; ?></cite>
                            </blockquote>
                           </a>
						</div>
                         
					</div>
                 
				 <?php } ?>  
               
			  </div><!-- /sl-slider -->

  <nav id="nav-arrows" class="nav-arrows">
        <span class="nav-arrow-prev">Próximo</span>
        <span class="nav-arrow-next">Anterior</span>
    </nav>

				<nav id="nav-dots" class="nav-dots">
					<span class="nav-dot-current"></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</nav>

    </div><!-- /slider-wrapper --></div>	
</div>
<!-- Fim player -->

<!-- ROTEIROS DESTAQUES -->
<div class="fundo_roteiros_destaques">
    <ul class="destaques">
    <?php while ($pegaExclusivos = mysql_fetch_assoc($exclusivos)) { 
	$nomecerto = str_replace(" ", "-", $pegaExclusivos['nome_roteiro']);
	?>
        <li>
        	<figure>
            <a href="pagina-roteiro.php?roteiro=<?php echo  $nomecerto; ?>&id=<?php echo  $pegaExclusivos['idroteiros']; ?>" data-title="<?php echo  $pegaExclusivos['texto_destaque_home']; ?>">
               <img src="imagem.php?arquivo=cms/uploads/roteiros/<?php echo  $pegaExclusivos['imagem_roteiro']; ?>&largura=142&altura=111" />
            </a>
            <figcaption><?php echo  $pegaExclusivos['nome_roteiro']; ?></figcaption></figure>
        </li>
      <?php } ?>  
    </ul>
</div>
<!-- FIM ROTEIROS DESTAQUES -->

<!-- BUSCAS -->

<div class="alinha_buscas">
<a name="busca-rapida" id="busca-rapida"></a>
<form action="busca-rapida.php" method="post" name="busca-roteiros">
	<div class="busca_azul">
    	<div class="titulo_busca"> BUSCA RÁPIDA </div>
        <div class="texto_auxiliar"> A busca rápida tenta procurar o mais próximo do que você digita. </div>
        <div class="campo_buscar_roteiro"><input name="palavra-chave" type="input" class="estiliza_input"> </div>
        <div class="mais_filtros"><div class="btn_mais_filtros"  /> + Filtros </div> </div>      
        <div class="botao_buscar"><button name="btnBuscaRoteiros" id="btnBuscaRoteiros" class="btn_buscar" /> Efetuar Busca </button> </div>  
        <div class="aparece_filtros">
        	<div class="alinha_filtros">
            <p><label>Destinos</label><br />
                <select name="pais" class="formatafiltros">
                    <option value="">--- Selecione ---</option>
                     <?php while ($combopais = mysql_fetch_assoc($pega_paises)) { ?>
                     <option value="<?php echo  $combopais['idpaises']; ?>"><?php echo  $combopais['nome_pais']; ?></option>
                    <?php } ?> 
                </select>
            </p>
            <p><label>Data Início</label><br /><input name="mes" type="input" id="data_inicio" class="formatafiltros"></p>
            <p><label>Data Fim</label><br /><input name="data" type="input" id="data_fim" class="formatafiltros"></p>
            <p><label>Feriado</label><br />
                <select name="feriado" class="formatafiltros">
                    <option value="">--- Selecione ---</option>
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </p>
           
		
       <p> 
        <input name="terrestre" type="checkbox" id="terrestre" value="1">   <label for="terrestre" style="vertical-align: super"> Terrestre   </label>  <br />
		<input name="rodoviario" type="checkbox" id="rodoviario" value="2"> <label for="rodoviario" style="vertical-align: super"> Rodoviário </label>  <br />	
        <input name="aereo" type="checkbox" id="aereo" value="3">           <label for="aereo" style="vertical-align: super"> Aéreo           </label>  <br />
		<input name="cruzeiro" type="checkbox" id="cruzeiro" value="4">     <label for="cruzeiro" style="vertical-align: super"> Cruzeiro     </label>  <br />
        <input name="combinados" type="checkbox" id="combinados" value="5"> <label for="combinados" style="vertical-align: super"> Combinados </label>  <br />
		<!-- input name="individual" type="checkbox" id="individual"><label for="individual" style="vertical-align: super"> Individual</label>  <br / -->  
	   </p>

            </div>
        </div>    
    </div>
    </form>
        
    <div class="busca_amarela">
    <div class="titulo_busca2"> BUSCA DE HOTÉIS </div>
    <form name="busca-hoteis" method="post" action="busca-hoteis.php">
     <div class="campo_buscar_roteiro2"><input type="input" class="estiliza_input" name="palavra-chave" placeholder="Ex: Digite o nome do hotel, endereço ou código do hotel." required> </div>
     <div class="alinha_datas">
     	<div style="float:left"><label class="data_entra"> Entrada </label><br /><input type="input" id="data_entra" name="checkin" class="estiliza_input2" ></div>
        <div style="float:right"><label class="data_entra"> Saída </label><br /><input type="input" id="data_saida" name="checkout" class="estiliza_input2">
         </div>       
     </div>
     <div class="alinha_datas2">
     	<div style="float:left; width:120px;"><label class="data_entra"> Adultos </label><br /><input type="number" name="adultos" class="estiliza_input3"></div>
        <div style="float:left; width:120px"><label class="data_entra"> Crianças </label><br /><input type="number" name="criancas" class="estiliza_input3"> </div>
        <div style="float:left; width:120px"><label class="data_entra"> Quartos </label><br /><input type="number"  name="quartos" class="estiliza_input3"></div> 
     </div>
     
     <div class="botao_buscar2"><button class="btn_buscar" /> Efetuar Busca </button> </div>
    </form>
    </div>

</div>
<!-- FIM BUSCAS -->

<!-- ROTEIROS CAPA -->
<div class="alinha_destaques">
 <a name="maisroteiros" id="maisroteiros"></a>
<?php while ($pegaDestaques = mysql_fetch_assoc($destaques)) { ?> 
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
    <legend class="formata_legend">
	<?php
	 if($pegaDestaques['sem_data']==1){ echo "Agende a sua viagem"; } 
	      else{ echo  $pegaDestaques['datas_completas']; }
    ?>
    </legend>
    <div class="descricao_roteiro"> 
 
   <?php
$paises = "SELECT * FROM `paises`,`roteiros`,`relacoes_paises_roteiros` WHERE idroteiros=id_roteiro AND idpaises=id_pais AND id_roteiro=".$pegaDestaques['idroteiros'];         

                $pega_paises = mysql_query($paises); // Executa a consulta
                $cont = mysql_num_rows($pega_paises); // Conta número de linhas da consulta
                $i = 0;

                        
                        while ($paisok = mysql_fetch_array($pega_paises))
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
    <?php 	$nomecerto2 = str_replace(" ", "-", $pegaDestaques['nome_roteiro']); ?>
    <form action="pagina-roteiro.php?roteiro=<?= $nomecerto2; ?>&id=<?= $pegaDestaques['idroteiros']; ?>" method="post" name="frmVerRoteiros">
    <button type="submit" class="btn btn-primary glyphicon glyphicon-zoom-in" >
         <span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">Veja mais</span>
    </button>
    <input type="hidden" name="codigo_roteiro" value="<?php echo  $pegaDestaques['idroteiros']; ?>" />
    </form>
    </div>
	<div align="center">
    <form action="adicionar-roteiro.php?a=1&id=<?php echo  $pegaDestaques['idroteiros']; ?>" method="post" name="frmVerRoteiros">
    <button type="submit" class="btn btn-danger glyphicon glyphicon-check" style="margin-top:5px;" >
         <span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">Adicionar aos seus roteiros</span>
    </button>
    <input type="hidden" name="codigo_roteiro" value="<?php echo  $pegaDestaques['idroteiros']; ?>" />
    </form>
    </div>
 
    </div>    
    <!-- FIM REPETE -->
    <?php } ?>  
    

    
    <!-- WIDGETS -->
    
<div class="ver-mais-roteiros" align="right"> 
     <?php 
	 if(!empty($_GET["maisroteiros"])){
		 $cont = $_GET["maisroteiros"]; 
		 $cont= $cont;
	 } 
	 	else{ $cont= 8;  }
	 ?>  
    <form action="index.php?maisroteiros=<?= $cont+4; ?>#maisroteiros" method="post" name="frmVerRoteiros">
    <button type="submit" class="btn btn-info glyphicon glyphicon-picture" >
         <span style="text-align:left; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">Ver mais roteiros</span>
    </button>
    </form>
    </div>
    
<div class="fundo-parceiros">
    <a href="parceiros.php"><img src="imagens/parceiras.jpg" alt="Veja, também, nossas AGÊNCIAS de TURISMO PARCEIRAS, como a empresa ao lado. Saiba + Aqui. Parceiras, seja uma também." /></a>
    <div class="parceiros-logotipos"> 
    	 <?php while ($mostraparceiros = mysql_fetch_assoc($pega_parceiros)) { ?>
            <img src="imagem.php?arquivo=cms/uploads/parceiros/<?php echo  $mostraparceiros['imagem_parceiro']; ?>&largura=119&altura=90" />            
             <?php } ?> 

    </div>
    </div>
    <div class="redes-sociais">
    <img src="imagens/redes_capa.jpg" usemap="#Map" style="margin-top:5px" border="0" alt="ONDE NOS ENCONTRAR. Fique por dentro e seja atendido rapidamente. +5551 9909.5488 - Adicione nosso Whats App e consulte sobre Pacotes e Viagens." />
    <map name="Map" id="Map">
      <area shape="circle" coords="424,63,34" href="https://www.facebook.com/andesturismo?fref=ts" target="_blank" />
      <area shape="circle" coords="534,64,33" href="http://instagram.com/andes_turismo" target="_blank" />
    </map>
    </div>
    <!--- FIM WIDGETS -->
    <div style="margin-top:10px;">
    <div class="ajeita1" style="float:left">
    <p style="margin-top:5px; margin-bottom:5px;"><strong style="font-size:21px; color:#3486cb"> QUER RECEBER NOVIDADES POR E-MAIL? </strong><small> Então cadastre-se aqui. </small></p>    
    </div>
    <div class="ajeita2" style="float:left; margin-left:5px; margin-top:2px;">
    <form name="addNewsletter" method="post" action="adiciona-news.php" />
    <input type="input" class="estiliza_input4" placeholder="Insira seu nome" name="nome" required="required"><input type="email" class="estiliza_input4" placeholder="Seu e-mail" name="email" required="required"><input name="Cadastrar" type="submit" value="Cadastrar" class="botao_cadastrar" />
    </form>
    </p>
    </div>
    
                <div id="conexoesFacebook">  
                <!-- div id="tituloConexoesFacebook">facebook </div -->
<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fandesturismopoa&amp;width=1135&amp;height=158&amp;border_color=%23fff&amp;colorscheme=light&amp;show_faces=true&amp;stream=false&amp;header=false&amp;height=258&amp;locale=pt_BR" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:1030px; height:260px; margin-top:5px;" allowtransparency="true"></iframe>
            </div>
    
    
</div>
<!-- FIM MEIo -->





</main>

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
