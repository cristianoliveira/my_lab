<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.'); ?>

<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Alterar seu e-mail</h1>
        
        <div class="voltar"><a href="<?php echo SITE_URL ?>/area-cliente">&#171; VOLTAR</a></div>
        
        <p class="subtitulo-interna">Digite seu e-mail.</p>
        
        <p>Depois digite o novo e-mail, e sua atual senha de cadastro. Depois clique em "Continuar".</p>
        
        <form method="post" action="<?php echo SITE_URL ?>/area-cliente/alterar-email" id="form-alterar-email" >

            <ul>
            	<li>
            		<label>E-mail:</label>
            		<input type="text" name="email" id="form_email" maxlength="255" value="<?php echo $email ?>" />
            	</li>
                <li>
            		<label>Novo E-mail:</label>
            		<input type="text" name="novo_email" id="form_novo_email" maxlength="255" value="<?php echo $novo_email ?>" />
            	</li>
                <li>
            		<label>Senha:</label>
            		<input type="password" name="senha" id="form_senha" />
            	</li>


	            <li>
		            <?php if ( ! is_null($notificacao) AND strlen($notificacao->get_mensagem()) > 0) { ?>
		                <div id="form_notification" style="padding:5px; width: 300px" class="<?php echo $notificacao->get_tipo() ?>"><?php echo $notificacao->get_mensagem() ?></div>
                    <?php } else { ?>
		                <div id="form_notification" style="padding:5px; width: 300px"></div>
                    <?php } ?>
	            </li>

	            
            	<li class="continuar">
                	<button type="submit">Enviar</button>
                </li>
			</ul>
            
        </form>

        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>