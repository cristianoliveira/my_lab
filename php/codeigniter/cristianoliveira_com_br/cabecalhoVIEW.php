<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<rel="shortcuticon" href="<?php echo load_img('favicon.ico'); ?>" type="image/x-icon" />
<link href="<?php echo load_img('favicon.ico'); ?>" rel="shortcut">
<title>cristianoliveira.com.br -  Desenvolvedor Freelancer</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="description" content="Um empreendedor apaixonado por desenvolvimento web, mobile e desktop." />
<META NAME="Keywords" CONTENT="empreendedorismo, Freelancer, projetos, desenvolvimento web, caxias do sul, <?php if (isset($meta)) echo $meta; ?>">
<?php echo $css; ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<?php echo $js; ?>
<?php if(empty($timer)) $timer = 8000; ?>
  <script>
	$(document).ready(function() {
			$('#slider').s3Slider({
				timeOut: <?php echo $timer; ?>
			});
		});
   </script>
<script language="javascript">
     /*imagem01 = new Image();
     imagem01.src = <?php echo $img1; ?>;
      
     imagem02 = new Image();
     imagem02.src = <?php echo $img2; ?>;
      
     imagem03 = new Image();
     imagem03.src = <?php echo $img3; ?>;
	*/
</script>
   </head>
<body>
<div id="page">
  <div id="header">
    <div class="logo">
      <h1>
      <?php echo load_img('logo.png',array('class'=>'img_menu','style'=>'margin-right:10px;')); ?>
      <a href="<?php echo base_url(); ?>" title="Desenvolvedor por paixão">Cristian Oliveira</a></h1>
      <div style="margin:0 -20px 20px 0px; text-align:right">"Desenvolvedor por paixão. Empreendedor por instinto."</div>
    </div>
<!--/logo
    <div class="rss"> <a href="#" class="big"><span>Subscribe to our RSS</span></a> </div>
    <!--/rss -->
    <div class="clr"></div>
    <div class="menu_resize">
      <div class="topnav">
        <ul>
          <li class="item_menu">
          	<a href="<?php echo site_url(''); ?>" title="Cristian Oliveira - home"><?php echo load_img('home.gif',array('class'=>'img_menu')); ?></a>
          </li>
          <li class="item_menu">
          	<a href="<?php echo site_url('sobre/mobile'); ?>" title="Desenvolvimento de Aplicativos para Celular"><?php echo load_img('celular.png',array('class'=>'img_menu')); ?></a>
        	  </li>
          <li class="item_menu">
          	<a href="<?php echo site_url('sobre/sites'); ?>" title="Criação de Web Sites"><?php echo load_img('web.gif',array('class'=>'img_menu')); ?></a>
          </li>
          <li class="item_menu"><a href="<?php echo site_url('sobre/sistemas'); ?>" title="Desenvolvimento de Sistemas para Gestão Personalizados"><?php echo load_img('sistema.png',array('class'=>'img_menu')); ?></a>
          </li>
          <li class="item_menu">
          	<a href="http://blog.cristianoliveira.com.br" title="Tutoriais sobre Desenvolvimento"><?php echo load_img('tutoriais.png',array('class'=>'img_menu')); ?></a>
          </li>
          <!--<li class="item_menu">
          	<a href="<?php echo site_url('app/market'); ?>" title="Baixe aplicativos para experimentar"><?php echo load_img('download.png',array('class'=>'img_menu')); ?></a>
          </li>-->
          <li class="item_menu">
          	<a href="<?php echo site_url('sobre/portfolio'); ?>" title="Portfolio de Cristian Oliveira"><?php echo load_img('portfolio.png',array('class'=>'img_menu')); ?></a>
          </li>
          <li class="item_menu">
          	<a href="<?php echo site_url('sobre/cristianoliveira'); ?>" title="Saiba mais sobre Cristian Oliveira"><?php echo load_img('about_me.png',array('class'=>'img_menu')); ?></a>
          </li>
          <li class="item_menu">
          	<a href="<?php echo site_url('sobre/contato'); ?>" title="Contato"><?php echo load_img('contato.png',array('class'=>'img_menu')); ?></a>
          </li>
        </ul>
      </div>
      <!--/topnav <div class="search">
        <form id="form" name="form" method="post" action="">
          <span>
          <input name="q" type="text" class="keywords" id="textfield" maxlength="50" value="Search..." />
          </span>
          <input name="b" type="image" src="../../images/search.gif" class="button" />
        </form>
      </div>
      <!--/search -->
     </div>
