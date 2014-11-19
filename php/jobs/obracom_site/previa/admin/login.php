<?php  @session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"xml:lang="en"lang="en">

  <head>

    <meta http-equiv="Content-Type"content="text/html; charset=utf-8"/>

<title>OBRACMS</title>

	<!-- Main Stylesheet -->
<link rel="stylesheet" id="wp-admin-css" href="login_arquivos/wp-admin.css" type="text/css" media="all">
<link rel="stylesheet" id="colors-fresh-css" href="login_arquivos/colors-fresh.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery.js"></script>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript" src="login_arquivos/ga.js"></script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>

<?php  if(@$_SESSION['flash_error'] != ""){ ?>
<script type="text/javascript">
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
function s(id,pos){g(id).left=pos+'px';}
function g(id){return document.getElementById(id).style;}
function shake(id,a,d){c=a.shift();s(id,c);if(a.length>0){setTimeout(function(){shake(id,a,d);},d);}else{try{g(id).position='static';wp_attempt_focus();}catch(e){}}}
addLoadEvent(function(){ var p=new Array(15,30,15,0,-15,-30,-15,0);p=p.concat(p.concat(p));var i=document.forms[0].id;g(i).position='relative';shake(i,p,20);});
</script>
<?php  } ?>

<body class="login" onload="MM_preloadImages('compativel_cor.jpg')">
<div id="login">
<div  align="center">
  <h1><img src="imagens/logo_login.png" alt="" width="221" height="127" /></h1>
</div><br />

<?php  if(@$_SESSION['flash_error'] != ""){ ?>
<div id="login_error">	<strong>ERRO</strong>: <?php  echo @$_SESSION['flash_error']; ?><br /></div>
<?php  } ?>

<form name="loginform" id="loginform" action="action_login.php" method="post">
	<p>
		<label for="user_login">Seu Usuário<br>
		<input name="log" id="user_login" class="input" size="20" tabindex="10" type="text"></label>
	</p>
	<p>
		<label for="user_pass">Sua Senha<br>
		<input name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" type="password"></label>
	</p>
	<p class="submit">
		<input name="wp-submit" id="wp-submit" class="button-primary" value="Entrar" tabindex="100" type="submit">
		<input name="redirect_to" value="/wp-admin/" type="hidden">
		<input name="testcookie" value="1" type="hidden">
	</p>
</form>



<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('user_login');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>
<script type="text/javascript" src="login_arquivos/jquery_002.js"></script>
<script type="text/javascript" src="login_arquivos/jquery_003.js"></script>
<script type="text/javascript" src="login_arquivos/et-ptemplates-frontend.js"></script>
<div class="clear"></div>


<div id="fancybox-tmp"></div><div id="fancybox-loading"><div></div></div><div id="fancybox-overlay"></div><div id="fancybox-wrap"><div id="fancybox-outer"><div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div><div id="fancybox-content"></div><a id="fancybox-close"></a><div id="fancybox-title"></div><a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a><a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a></div></div>

<p> </p><br /><br />

<center>
  <p><a href="#"><img src="imagens/compativel2.jpg" width="350" height="138" id="Image1" onmouseover="MM_swapImage('Image1','','imagens/compativel_cor.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></p></center>
</body></html>