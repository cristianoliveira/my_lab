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

<link rel="stylesheet" href="<?php echo SITE_BASE ?>/views/css/estilo.css" type="text/css" media="screen" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>-->

<!-- Colorbox -->
<link rel="stylesheet" href="<?php echo SITE_BASE ?>/views/js/colorbox/colorbox.css" type="text/css" media="screen" />
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
        
        <div class="central-atendimento">
        	<a href="#" class="colorbox-atendimento">CENTRAL DE ATENDIMENTO AO CLIENTE</a>
        </div>
        
        <!-- Conteúdo de exibição do Colorbox -->
        <div style="display:none">
           <div id="central-atendimento">
                
                <div class="topo"></div>

                <div class="clear"></div>
                
                <div class="box">
                    
                    <div class="logo-colorbox">
                    	<a href="<?php echo SITE_URL ?>" title="Ir para a página inicial da Movel Clube"><img src="<?php echo SITE_BASE ?>/views/imagens/logo-colorbox.png" alt="Movel Clube" /></a>
                    </div>
        
                    <div id="form_sucesso"></div>
        
                    <form method="post" action="<?php echo SITE_URL ?>/central-relacionamento/enviar" name="formAtendimento" id="form-atendimento" >

                        <p>Todos os campos são obrigatórios</p>
        
                        <label>Nome</label>
                        <input type="text" name="informacao_nome" id="informacao_nome" maxlength="100" style="margin:0 10px 0 40px;" value="<?php echo $cliente ? (is_null($cliente->get_responsavel_nome()) ? $cliente->get_nome() : $cliente->get_responsavel_nome()) : '' ?>" />
        
                        <label>E-mail</label>
                        <input type="text" name="informacao_email" id="informacao_email" maxlength="255" style="margin-left: 10px; width: 339px;" value="<?php echo $cliente ? $cliente->get_email() : '' ?>" />
                        
                        <div class="clear"></div>
        
                        <label>Fone</label>
                        <input type="text" name="informacao_ddd" id="informacao_ddd" maxlength="2" style="width:25px;margin:0 10px 0 45px;" value="<?php echo $cliente ? substr($cliente->get_telefone_principal(), 0, 2) : '' ?>" />
                        <input type="text" name="informacao_fone" id="informacao_fone" maxlength="10" style="width:160px; margin-right:10px;" value="<?php echo $cliente ? substr($cliente->get_telefone_principal(), 2) : '' ?>" />
                        
                        <label>Estado</label>
                        <select size="1" id="uf" name="uf" style="width:50px; margin:0 10px;">
							<option value="AC" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'AC') ? 'selected="selected"' : '' ?>>AC</option>
							<option value="AL" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'AL') ? 'selected="selected"' : '' ?>>AL</option>
							<option value="AP" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'AP') ? 'selected="selected"' : '' ?>>AP</option>
							<option value="AM" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'AM') ? 'selected="selected"' : '' ?>>AM</option>
							<option value="BA" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'BA') ? 'selected="selected"' : '' ?>>BA</option>
							<option value="CE" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'CE') ? 'selected="selected"' : '' ?>>CE</option>
							<option value="DF" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'DF') ? 'selected="selected"' : '' ?>>DF</option>
							<option value="ES" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'ES') ? 'selected="selected"' : '' ?>>ES</option>
							<option value="GO" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'GO') ? 'selected="selected"' : '' ?>>GO</option>
							<option value="MA" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'MA') ? 'selected="selected"' : '' ?>>MA</option>
							<option value="MT" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'MT') ? 'selected="selected"' : '' ?>>MT</option>
							<option value="MS" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'MS') ? 'selected="selected"' : '' ?>>MS</option>
							<option value="PA" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'PA') ? 'selected="selected"' : '' ?>>PA</option>
							<option value="PB" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'PB') ? 'selected="selected"' : '' ?>>PB</option>
							<option value="PR" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'PR') ? 'selected="selected"' : '' ?>>PR</option>
							<option value="PE" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'PE') ? 'selected="selected"' : '' ?>>PE</option>
							<option value="PI" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'PI') ? 'selected="selected"' : '' ?>>PI</option>
							<option value="RJ" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'RJ') ? 'selected="selected"' : '' ?>>RJ</option>
							<option value="RN" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'RN') ? 'selected="selected"' : '' ?>>RN</option>
							<option value="RS" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'RS') ? 'selected="selected"' : '' ?>>RS</option>
							<option value="RO" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'RO') ? 'selected="selected"' : '' ?>>RO</option>
							<option value="RR" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'RR') ? 'selected="selected"' : '' ?>>RR</option>
							<option value="SC" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'SC') ? 'selected="selected"' : '' ?>>SC</option>
							<option value="SP" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'SP') ? 'selected="selected"' : '' ?>>SP</option>
							<option value="SE" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'SE') ? 'selected="selected"' : '' ?>>SE</option>
							<option value="TO" <?php echo ($cliente AND $cliente->get_entrega_estado() == 'TO') ? 'selected="selected"' : '' ?>>TO</option>
                        </select>
                        
                        <label>Cidade</label>
                        <input type="text" name="informacao_cidade" id="informacao_cidade" maxlength="100" style="margin-left:10px;width:364px;" value="<?php echo $cliente ? $cliente->get_entrega_cidade() : '' ?>" />
                        
                        <div class="clear"></div>
                        
                        <label>Assunto</label>
                        <select size="1" id="assunto" name="assunto" style="width:225px; margin-left:25px;">
                          <option value="Comprando no movelclube.com">Comprando no movelclube.com</option>	
                          <option value="Institucional">Institucional</option>
                          <option value="Processo de Entrega">Processo de Entrega</option>
                          <option value="Pagamento">Pagamento</option>	
                          <option value="Produtos">Produtos</option>
                          <option value="Promoções e Descontos">Promoções e Descontos</option>
                          <option value="Serviços">Serviços</option>	
                          <option value="Trocas e Devoluções">Trocas e Devoluções</option>
                        </select>                        
                        
                        <div class="clear"></div>                       
        
                        <label>Mensagem</label>
                        <textarea type="text" name="informacao_mensagem" id="informacao_mensagem" style="overflow:auto;margin-left:10px;"></textarea>
        
                        <button type="submit" >Enviar</button>
        
                        <div id="form_erro"></div>
                        
                        <div class="clear"></div>

                        <?php /*
                        <div class="perguntas-frequentes">
                        	<p>Perguntas Frequentes</p>
                        </div>
                        */ ?>
        
                    </form>

                    <div id="form_notification"></div>

                    <div class="clear"></div>

        		</div>

                <div class="clear"></div>
                
                <div class="inferior"></div>
                
            </div>
        </div>  
        
        <div class="clear"></div>

    </div>
</div>