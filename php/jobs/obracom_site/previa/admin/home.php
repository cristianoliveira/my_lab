<?php 
include("includes/database_connection.php");
include("includes/check_authentication.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type"content="text/html; charset=UTF-8">

	

	<title>OBRACMS</title>

	<!--                       CSS                       -->

	<!-- Reset Stylesheet -->
	<link rel="stylesheet"href="css/reset.css"type="text/css"media="screen">

	<!-- Main Stylesheet -->
	<link rel="stylesheet"href="css/style.css"type="text/css"media="screen">

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

	<!-- Funções javascript do sistema-->
	<script type="text/javascript"src="js/functions.js"></script>

<script src="js/ga.js"type="text/javascript"></script><script src="js/ga.js"type="text/javascript"></script></head>

<body class="home">

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar">
			
	<?php  include("includes/sidebar.php"); ?></div> <!-- End #sidebar -->		
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
		<h2>Bem-vindo(a) <?php  echo utf8_encode(@$_SESSION['nome_usuario']); ?>.</h2>
		<p id="page-intro">Escolha uma das opções no menu ao lado.</p>
		
        


			<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						© Copyright 2014 OBRA Comunicação | <a href="home#body-wrapper">Ir para o topo</a>
				</small>
  </div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div>
  

<embed id="chrome-plugin-npapi-helper"type="application/chrome-extension-helper"style="visibility:hidden;max-width:1px;max-height:1px,position:absolute;left:-100px;top:-100px;">    <div id="facebox"style="display:none;">       <div class="popup">         <table>           <tbody>             <tr>               <td class="tl"></td><td class="b"></td><td class="tr"></td>             </tr>             <tr>               <td class="b"></td>               <td class="body">                 <div class="content">                 </div>                 <div class="footer">                   <a href="home#"class="close">                     <img src="./js/closelabel.gif"title="close"class="close_image">                   </a>                 </div>               </td>               <td class="b"></td>             </tr>             <tr>               <td class="bl"></td><td class="b"></td><td class="br"></td>             </tr>           </tbody>         </table>       </div>     </div></body></html>