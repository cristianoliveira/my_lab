<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="pt-br" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="description" content="<?php echo $pagina_description; ?>" />
<meta name="keywords" content="<?php echo $pagina_keywords; ?>" />
<meta name="author" content="Fator Digital - http://www.fatordigital.com.br" />
<meta name="robots" content="all" />
<meta name="revisit-after" content="7 days" />
<title><?php echo strlen($pagina_title) > 0 ? $pagina_title.' - ' : '' ?>Móveis e Cadeiras :: movelclube.com ::</title>

<link rel="shortcut icon" href="<?php echo SITE_BASE ?>/views/imagens/favicon.ico" type="image/x-icon" />

<link rel="stylesheet" href="<?php echo SITE_BASE ?>/views/css/estilo.css" type="text/css" media="screen" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>-->

<!-- Nivo Slider -->
<link rel="stylesheet" href="<?php echo SITE_BASE ?>/views/js/nivoSlider/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo SITE_BASE ?>/views/js/nivoSlider/default/default.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo SITE_BASE ?>/views/js/nivoSlider/jquery.nivo.slider.pack.js"></script>

<!-- Colorbox -->
<link id="colorbox_sheet" rel="stylesheet" href="<?php echo SITE_BASE ?>/views/js/colorbox/colorbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo SITE_BASE ?>/views/js/colorbox/jquery.colorbox-min.js"></script>

<!-- Nice Forms -->
<link rel="stylesheet" href="<?php echo SITE_BASE ?>/views/js/nicejforms/niceforms-default.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo SITE_BASE ?>/views/js/nicejforms/niceforms.js"></script>
    
<script type="text/javascript" src="<?php echo SITE_BASE ?>/views/js/jquery.maskedinput-1.3.min.js"></script>

<link rel="stylesheet" href="<?php echo SITE_BASE ?>/views/js/tiptip/tipTip.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo SITE_BASE ?>/views/js/tiptip/jquery.tipTip.minified.js"></script>

<script type="text/javascript">
var SITE_URL = '<?php echo SITE_URL ?>';
var SITE_BASE = '<?php echo SITE_BASE ?>';
var redirecionar = '<?php echo $redirecionar ?>';
</script>

<script type="text/javascript" src="<?php echo SITE_BASE; ?>/views/js/validate/jquery.validate.min.js"></script>

<script type="text/javascript" src="<?php echo SITE_BASE; ?>/views/js/funcoes.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form-esqueci-senha').hide();
        $('#esqueci-senha').click(function(){
            $('#form-esqueci-senha').show();
        });
        $('#esque-senha-enviar').click(function(){
            $('#form-esqueci-senha').hide();
            alert('senha trocada!!!');
        });
    });

</script>

</head>

<body class="<?php echo $body_class; ?>">

<script type="text/javascript"> 
var $buoop = {};
$buoop.ol = window.onload;
window.onload=function(){
	try {if ($buoop.ol) $buoop.ol();}catch (e) {}
	var e = document.createElement("script");
	e.setAttribute("type", "text/javascript");
	e.setAttribute("src", "http://browser-update.org/update.js");
	document.body.appendChild(e);
}
</script>

<div class="cabecalho">

	<div class="container">

    	<div class="logo">
        	<a href="<?php echo SITE_URL ?>" title="Ir para a página inicial da Movel Clube"><img src="<?php echo SITE_BASE ?>/views/imagens/logo.jpg" alt="Movel Clube" /></a>
        </div>

		<?php if ( ! $cliente OR is_null($cliente->get_id())) { ?>
        
	        <div class="login">
	            <form method="post" action="<?php echo SITE_URL?>/area-cliente/login" id="form-login" >
					<label for="usuario">E-mail</label>
	                <div class="usuario">
						<input type="text" name="email" id="usuario" maxlength="255" />
	                </div>
	                <label for="senha">Senha</label>
	                <div class="senha">
						<input type="password" name="senha" id="senha" maxlength="100" />
	                </div>
	                <button type="submit">Acessar</button>
	            </form>

		        <div id="form-login-notificacao"></div>
                <a href="<?php echo SITE_URL.'/area-cliente/esqueci_senha' ?>">Esqueci minha senha</a>
	        </div>

		<?php } else { ?>
        
	        <div class="logado">
	            <p>Voce está logado como <span><?php echo is_null($cliente->get_responsavel_nome()) ? $cliente->get_nome() : $cliente->get_responsavel_nome() ?></span>.
                    É você? (<a href="<?php echo SITE_URL ?>/area-cliente/logout" >Sair</a>)</p>
	        </div>

		<?php } ?>
        
        <div class="carrinho">
        	<p class="itens">
		        <?php if ($carrinho AND count($carrinho) > 0) { ?>
		            <a href="<?php echo SITE_URL ?>/carrinho">Você tem <span><?php echo count($carrinho) ?> produto(s)</span> no carrinho.</a>
			    <?php } else { ?>
		            Seu carrinho está vazio.
			    <?php }  ?>
	        </p>

			<?php if ( ! $cliente OR is_null($cliente->get_id())) { ?>
                <p><span>Novo por aqui?</span> <a href="<?php echo SITE_URL?>/area-cliente/cadastro">Crie sua conta.</a></p>
	        <?php } else { ?>
	            <p><span>Acesse sua </span> <a href="<?php echo SITE_URL?>/area-cliente">área restrita.</a></p>
	        <?php } ?>
        </div>
		
        <div class="clear"></div>
        
		<div class="buscar">
        	<p>BUSCA DE PRODUTOS:</p>
            <form method="post" action="<?php echo SITE_URL ?>/produtos" id="form-buscar" >
				<label>BUSCAR</label>
                <div class="produto">
					<input type="text" 
					       name="texto" 
					       id="buscar_produto" 
					       maxlength="255" 
					       value="<?php echo isset($busca_texto) ? ($busca_texto) : '' ?>" />
                </div>
                <label>EM</label>
                <div class="categoria">
                    <select name="categoria_seo" id="buscar_categoria">
                      <option value="">TODO O SITE</option>
                      <option value="cadeiras" <?php echo (isset($categoria_seo) AND $categoria_seo == 'cadeiras') ? 'selected="selected"' : '' ?>>CADEIRAS</option>
                      <option value="mobiliario" <?php echo (isset($categoria_seo) AND $categoria_seo == 'mobiliario') ? 'selected="selected"' : '' ?>>MOBILIÁRIO</option>
                      <option value="acessorios" <?php echo (isset($categoria_seo) AND $categoria_seo == 'acessorios') ? 'selected="selected"' : '' ?>>ACESSÓRIOS</option>
                    </select>                    
                </div>

	            <button type="submit">Buscar Produtos</button>
            </form>

			<p id="busca-em-branco" style="font-size:12px;padding-left:262px;display:none">Você deve digitar uma ou mais palavras para realizar a pesquisa.</p>
        </div>
        
        <div class="clear"></div>

    </div>
</div>