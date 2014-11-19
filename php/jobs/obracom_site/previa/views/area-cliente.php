<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.'); ?>

<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Área do Cliente</h1>
        
        <div class="voltar"><a href="<?php echo $anterior ?>">&#171; VOLTAR</a></div>
        
        <p class="titulo-interna">Bem-vindo ao seu espaço de compras</p>
        
        <p>Confira detalhes sobre a entrega do seu pedido ou histórico de suas compras.</p>

		<?php if ( ! is_null($notificacao) AND strlen($notificacao->get_mensagem()) > 0) { ?>
            <div id="form_notification" class="<?php echo $notificacao->get_tipo() ?>" style="margin: 40px 0 -84px;padding: 8px"><?php echo $notificacao->get_mensagem() ?></div>
        <?php } ?>

        <div class="painel-controle">
            <ul>
                <li class="meu-cadastro">
                    <p><a href="<?php echo SITE_URL ?>/area-cliente/alterar-email">- Alterar meu e-mail</a></p>
                    <p><a href="<?php echo SITE_URL ?>/area-cliente/alterar-meus-dados">- Alterar meus dados cadastrais</a></p>
                    <p><a href="<?php echo SITE_URL ?>/area-cliente/alterar-senha">- Alterar minha senha</a></p>
                </li>
                <li class="servicos">
                    <p><a href="<?php echo SITE_URL ?>/trocas-devolucoes">- Trocas & Devoluções</a></p>
                </li>
                <li class="entrega">
                    <p><a href="<?php echo SITE_URL ?>/area-cliente/consultar-pedidos">- Consultar meu pedidos</a></p>
                </li>
                <li class="contato">
                    <p><a href="#" class="colorbox-atendimento">- Dúvidas, sugestões e reclamações</a></p>
                </li>
                <li class="pagamento">
                    <p><a href="#" class="colorbox-atendimento">- Rever seu pagamento com a PagSeguro</a></p>
                </li>
	            <li class="em-branco">&nbsp;</li>
	            <li class="logout">
                    <p><a href="<?php echo SITE_URL ?>/area-cliente/logout">- Sair do sistema</a></p>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
            
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>