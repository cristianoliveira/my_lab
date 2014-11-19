<?php include 'includes/cabecalho.php'; ?>

<div class="conteudo">
	<div class="container">
    	
        <h1>Identificação</h1>
        
        <div class="status">
        	<img src="<?php echo SITE_BASE ?>/views/imagens/status-identificacao.png" alt="Identificação do cliente" />
        </div>
        
        <div class="opcoes">
        	<div class="cliente">            	
                <div class="box">
                	<form method="post" action="<?php echo SITE_URL ?>/area-cliente/login" id="form-cliente" >
                    
                        <label>E-mail:</label>
                        <input type="text" name="email" id="identificacao_email" maxlength="255" />
                        
                        <label>Senha:</label>
                        <input type="password" name="senha" id="identificacao_senha" />

		                <div id="form-identificacao-notificacao"></div>

                        <button type="submit">Enviar</button>
					</form>
                    <div class="esqueci-senha">
                    	<p>ESQUECI MINHA SENHA</p>
                        <a href="<?php echo SITE_URL ?>/area-cliente/esqueci-senha" id="botao_esqueci_senha"><img src="<?php echo SITE_BASE ?>/views/imagens/enviar-para-meu-email.gif" alt="Enviar a senha para o meu e-mail" /></a>
	                    <div id="form-senha-notificacao"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>


                    <?php /*<div class="email-mudou">
                    	<p>MEU E-MAIL MUDOU</p>
                        <a href="#"><img src="<?php echo SITE_BASE ?>/views/imagens/alterar-email.gif" alt="Alterar o meu e-mail" /></a>
                        <div class="clear"></div>
                    </div> */ ?>
                </div>
            </div>
            <div class="nao-cliente">            	
                <div class="box">
                	<form method="post" action="<?php echo SITE_URL ?>/area-cliente/cadastro" id="form-cep" >
                    
                        <button type="submit">Enviar</button>

                        <div class="clear"></div>
					</form>

                    <?php /*<div class="esqueci-cep">
                    	<p>NÃO SEI MEU CEP</p>
                        <a href="#"><img src="<?php echo SITE_BASE ?>/views/imagens/nao-sei-cep.gif" alt="Não sei meu cep" /></a>
                        <div class="clear"></div>
                    </div> */ ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>