<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Status da sua compra</h1>
        
        <div class="voltar"><a href="<?php echo SITE_URL ?>/area-cliente">&#171; IR PARA PÁGINA DO CLIENTE</a></div>
        
        <h2>Obrigado por ter realizado a compra conosco!</h2>
		
		<p>Assim que seu pagamento no PagSeguro for aprovado, você receberá um email informativo.</p>

		<h3>Código do Compra: <?php echo $compra->get_codigo() ?></h3>

		<h3>Código do PagSeguro: <?php echo $pagseguro_identificador ?></h3>
		
		<p>Caso tenha dúvidas sobre a compra, entre em contato com o Movel Clube através da <a href="" class="colorbox-atendimento" style="color:#BC2A27; text-decoration: none">Central de Atendimento ao Cliente</a>.</p>
		
		<p><br /><br /><br /><br /><br /><br /></p>

        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>