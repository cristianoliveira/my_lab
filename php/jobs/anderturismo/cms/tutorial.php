<?php 
include("includes/database_connection.php");
include("includes/check_authentication.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	

	<title>OBRACMS</title>

	<!--                       CSS                       -->

	<!-- Reset Stylesheet -->
	<link rel="stylesheet"href="css/reset.css"type="text/css"media="screen">

	<!-- Main Stylesheet -->
	<link rel="stylesheet"href="css/style.css"type="text/css"media="screen">
    <link rel="stylesheet"href="css/blue.css"type="text/css"media="screen">

	<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
	<link rel="stylesheet"href="css/invalid.css"type="text/css"media="screen">

	<link rel="stylesheet"href="css/jquery-ui-1.8.14.custom.css"type="text/css"media="screen">

	<!-- Internet Explorer Fixes Stylesheet -->

	<!--[if lte IE 7]>
		<link rel="stylesheet"href="views/css/ie.css"type="text/css"media="screen"/>
	<![endif]-->

	<!--                       Javascripts                       -->

	<!-- jQuery -->
	<script type="text/javascript"src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript"src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
	<script type="text/javascript"src="js/jquery.ui.datepicker-pt-BR.js"></script>

	<!-- jQuery Configuration -->
	<script type="text/javascript"src="js/simpla.jquery.configuration.js"></script>

	<!-- Facebox jQuery Plugin -->
	<script type="text/javascript"src="js/facebox.js"></script>

	<!-- jQuery WYSIWYG Plugin -->
	<script type="text/javascript"src="js/jquery.wysiwyg.js"></script>

	<!-- jQuery Validate Plugin -->
	<script type="text/javascript"src="js/jquery.validate.min.js"></script>
	<!-- jQuery Masked Input Plugin -->
	<script type="text/javascript"src="js/jquery.maskedinput-1.3.min.js"></script>
	<!-- jQuery Price Format Plugin -->
	<script type="text/javascript"src="js/jquery.price_format.1.5.js"></script>

	<!-- Fun��es javascript do sistema-->
	<script type="text/javascript"src="js/functions.js"></script>

<script src="js/ga.js"type="text/javascript"></script><script src="js/ga.js"type="text/javascript"></script></head>

<body class="home">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar">
			
	<?php  include("includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript est&aacute; desativado ou n&atilde;o &eacute; suportado pelo seu navegador. Por favor <a href="http://browsehappy.com/" title="Atualize para um navegador melhor">atualize</a> o seu browser ou <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Ative o JavaScript no seu navegador">ative</a> Javascript para navegar pela interface corretamente.
				  </div>
				</div>
			</noscript>
		<!-- Page Head -->
			<!-- Page Head -->
			<h2>Tutorial</h2>
			<p id="page-intro">Assista ao tutorial de como usar a nova ferramenta de edi&ccedil;&atilde;o</p><!-- End .shortcut-buttons-set -->
      <div style="height:150px;">
        <video width="640" height="480" controls>
          <source src="tutorial.mp4" type="video/mp4" />
          <source src="tutorial.ogg" type="video/ogg" />
          Your browser does not support the video tag. </video>
      </div>
      <div id="footer">
		  <small> <!-- Remove this notice or replace it with whatever you want -->
				  � Copyright 2014 OBRA Comunica��o | <a href="home#body-wrapper">Ir para o topo</a>
		  </small>
  </div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div>
  

<embed id="chrome-plugin-npapi-helper"type="application/chrome-extension-helper"style="visibility:hidden;max-width:1px;max-height:1px,position:absolute;left:-100px;top:-100px;">    <div id="facebox"style="display:none;">       <div class="popup">         <table>           <tbody>             <tr>               <td class="tl"></td><td class="b"></td><td class="tr"></td>             </tr>             <tr>               <td class="b"></td>               <td class="body">                 <div class="content">                 </div>                 <div class="footer">                   <a href="home#"class="close">                     <img src="./js/closelabel.gif"title="close"class="close_image">                   </a>                 </div>               </td>               <td class="b"></td>             </tr>             <tr>               <td class="bl"></td><td class="b"></td><td class="br"></td>             </tr>           </tbody>         </table>       </div>     </div></body></html>