<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <script src="js/slides.min.jquery.js"></script>
        <script>
            $(function(){
                // Set starting slide to 1
                var startSlide = 1;
                // Get slide number if it exists
                if (window.location.hash) {
                    startSlide = window.location.hash.replace('#','');
                }
                // Initialize Slides
                $('#slides').slides({
                    preload: true,
                    generatePagination: true,
                    play: 8000,
                    pause: 10500,
                    hoverPause: true,
                    // Get the starting slide
                    start: startSlide
                });
            });
        </script>
        <title>
            Primous Soluções Inteligentes
        </title>
        <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=491946624176915";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        <div id="content">
            <div id="header">
                <h2 id="logo">
                    <a href="http://www.primous.com.br"  ><image src="imagens/logo.png" /></a>
                    Primous Soluções Inteligentes
                </h2>
                <div id="menu">
                    <?php echo $menuItens; ?>
                </div>
            </div>
            <div id="intro">
                <div id="slides">
                    <div class="slides_container">
                        <div class="slide">
                            <h2>Soluções em Software</h2>
                            <image src="imagens/software/cima_box.png" style="margin-left: 10px;" />
                         </div>
                        <div class="slide">  
                            <image src="imagens/software/box_300_259.png" style="float: right; margin: 10px 50px;" />
                            <h1>Gestão para Institutos de Beleza e Estética</h1>
                            <p>
                                EstetSys é a solução criada pela Primous em parceria com empresários da Serra Gaúcha, para atender a necessidade
                            de empresas do ramo de estética e serviços. Esta ferramenta foi desenvolvida com base nas melhores práticas de gestão e anos de
                            experiência em administração de negócios.
                            </p>
                            <p><a href="<?php echo site_url(); ?>estetisys">Veja como iniciar</a></p>
                        </div>
                        <div class="slide">
                            <image src="imagens/software/site_300_259.png" style="float: right; margin: 10px 50px;" />
                            <h1>Soluções para Web</h1>
                            <p>A Primous tem a solução completa para sua empresa, tanto na gestão do negócio, como de sua imagem na internet. 
                            Criação de sites especializados e integrados a ferramenta EstetiSys para oferecer a melhor experiência de interação com seus clientes.
                            </p>
                            <p><a href="<?php echo site_url(); ?>produto#web" >Veja mais sobre a solução completa.</a></p>
                        </div>
                        <div class="slide">
                             <image src="imagens/software/integrado_400_250.png" style="float: left; margin: 10px 50px;" />
                           <h1>Sua empresa mais conectada!</h1>
                           <p style="float: left; width: 300px;">A Primous possui serviços na web integrados a seus softwares. Customize a maneira de se comunicar com seus clientes!
                               Proporcionando dessa forma o diferencial ao seu negócio.
                               <strong>Você mais conectado.</strong></p>
                            <p style="float: left; width: 300px;"><a href="<?php echo site_url(); ?>produto#integradas">Descubra as soluções integradas</a></p>
                        </div>
                    </div>
                </div>
                <!--
                <a href="#" class="prev"><img src="imagens/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
                <a href="#" class="next"><img src="imagens/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
                -->
           </div>

            <div id="menuIntro">
                <div class="menuIntroItem">
                    <a id="gestao" href="produto">
                        <image src="imagens/menus/gestao.png"/>
                        <h2>Soluções em Gestão</h2>
                    </a>
                </div>
                <div class="menuIntroItem">
                    <a href="produto">
                        <image src="imagens/menus/web.png"/>
                        <h2>Soluções Web</h2>
                    </a>
                </div>
                <div class="menuIntroItem">
                    <a href="produto">
                        <image src="imagens/menus/integradas.png"/>
                        <h2>Soluções integradas</h2>
                    </a>
                </div>
             </div>
            <div id="painel">
                <div class="textoEsquerda">
                        <?php echo anchor("estetisys/downloads/", '<img src="imagens/software/um_box_300_300.png" width="300px" BORDER="0" />') ?> 
                        <div id="link-download">
                            <?php echo anchor("estetisys/downloads/",'Baixe o EstetiSys'); ?> 
                        </div>
                    </div>
                    <div id="conteudoEstetiSys" class="textoDireita">
                        <p>
                            <h2><a href="estetisys">EstetiSys e o Sebrae</a></h3>    
                            EstetSys é a solução criada pela Primous baseada nos fundamentos apresentados pelo Sebrae com
							parceria de empresários da Serra Gaúcha para atender a necessidade de empresas do ramo de 
                            estética e serviços. Esta ferramenta foi desenvolvida com base nas melhores práticas de gestão e 
                            anos de experiência em administração de negócios.
                            </br>
                            Com ele é possível realizar o controle de todos as comandas de serviços prestados, produtos vendidos e cálculos 
                            para pagamento de comissões. Sua interface foi especialmente desenhada para facilidade no uso e manutenção.
                            </br>
                            </br>
                            Controle suas contas!

                            <h4>A quem se destina?</h4>
                            <li>Salões de Beleza</li>
                            <li>Centros de Estética</li>
                            <li>Salas de Massagem e Pilates</li>
                       </p>
                    </p>
                        
                    </div>
                <br />
            </div> 
                <div id="menuFooter">
                        <h3>Redes sociais</h3>
                </div>
         
                <div class="redesSociais">
                    <div class="fb-like-box" 
                         data-href="https://www.facebook.com/pages/Primous-Solu%C3%A7%C3%B5es-Inteligentes/447275648662048" 
                         data-width="500" data-show-faces="true" data-stream="true" data-border-color="f86605" data-header="false"></div>
                </div>
            <a class="twitter-timeline" href="https://twitter.com/primoussi" data-widget-id="292578555852898304">Tweets de @primoussi</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 
