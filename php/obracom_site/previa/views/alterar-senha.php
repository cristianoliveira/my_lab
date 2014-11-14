<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Alterar sua senha</h1>
        
        <div class="voltar"><a href="<?php echo SITE_URL ?>/area-cliente">&#171; VOLTAR</a></div>
        
        <p class="subtitulo-interna">Digite sua senha.</p>
        
        <p>Depois digite a nova senha, e o atual e-mail cadastrado. Depois clique em "Continuar".</p>
        
        <form method="post" action="<?php echo SITE_URL ?>/area-cliente/alterar-senha" id="form-alterar-senha" >

            <ul>
            	<li>
            		<label>Senha:</label>
            		<input type="password" name="senha" id="form_senha" />
            	</li>
                <li>
            		<label>Nova Senha:</label>
            		<input type="password" name="nova_senha" id="form_nova_senha" />
            	</li>
                <li>
            		<label>E-mail:</label>
            		<input type="text" name="email" id="form_email" maxlength="255" value="<?php echo $email ?>" />
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