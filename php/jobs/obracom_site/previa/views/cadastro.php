<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Novo Cadastro</h1>
        
        <div class="voltar"><a href="<?php echo $anterior ?>">&#171; VOLTAR</a></div>
        
        <p class="titulo-interna">Você está a dois passos de ingressar na família movelclube.com</p>
        
        <div class="navegue-forms">
        	<img src="<?php echo SITE_BASE ?>/views/imagens/form-dados-cadastrais-ativo.gif" alt="Formulário dos Dados Cadastrais" />
            <img src="<?php echo SITE_BASE ?>/views/imagens/form-endereco.gif" alt="Formulário do Endereço" />
        </div>
        
        <p>Entendemos que este seja um processo um pouco trabalhoso no início, mas prometemos compensar na agilidade após o cadastro para poder comprar com tamanha facilidade e que esteja ao seu alcance tudo o que estiver procurando. Bem vindo(a) ao clube.</p>
        
        <form method="post" action="<?php echo SITE_URL ?>/area-cliente/cadastro#form_cadastro_notification" id="form-dados-cadastrais" >

            <ul>
            	<li class="pessoa">            
                    <input type="radio" name="pessoa_tipo" value="fisica" <?php echo (! $pessoa_tipo OR $pessoa_tipo == 'fisica') ? 'checked="checked"' : ''?> style="margin:0;"><p>Pessoa Física</p>
                    <input type="radio" name="pessoa_tipo" value="juridica" <?php echo ($pessoa_tipo AND $pessoa_tipo == 'juridica') ? 'checked="checked"' : ''?> style="margin:0;"><p>Pessoa Jurídica</p>
            	</li>

	            <li class="pessoa_fisica">
                    <label>Nome completo &#42;</label>
                    <input type="text" name="nome" id="form_nome" maxlength="100" class="required" value="<?php echo $cliente ? $cliente->get_nome() : '' ?>" />
                </li>
                <li class="pessoa_fisica">
                    <label>CPF &#42;</label>
                    <input type="text" name="cpf" id="form_cpf" maxlength="11" class="required" value="<?php echo $cliente ? $cliente->get_cpf() : '' ?>" /><br />
                    <p><span>(Apenas números, sem pontos ou traços)</span></p>
                </li>

                <li class="pessoa_juridica">
                	<label>Razão social &#42;</label>
            		<input type="text" name="razao_social" id="form_razao_social" maxlength="100" class="required" value="<?php echo $cliente ? $cliente->get_razao_social() : '' ?>" />
                </li>
            	<li class="pessoa_juridica">
            		<label>CNPJ &#42;</label>
            		<input type="text" name="cnpj" id="form_cnpj" maxlength="14" class="required" value="<?php echo $cliente ? $cliente->get_cnpj() : '' ?>" /><br />
                    <p><span>(Apenas números, sem pontos ou traços)</span></p>
            	</li>
	            <li class="pessoa_juridica">
                    <label>Nome do responsável &#42;</label>
                    <input type="text" name="responsavel_nome" id="form_responsavel_nome" maxlength="100" class="required" value="<?php echo $cliente ? $cliente->get_responsavel_nome() : '' ?>" />
                </li>
                <li class="pessoa_juridica">
                    <label>CPF do responsável &#42;</label>
                    <input type="text" name="responsavel_cpf" id="form_responsavel_cpf" maxlength="11" class="required" value="<?php echo $cliente ? $cliente->get_responsavel_cpf() : '' ?>" /><br />
                    <p><span>(Apenas números, sem pontos ou traços)</span></p>
                </li>

            	<li>
            		<label>Sexo &#42;</label>
            		<select name="genero" id="form_genero" class="required">
                      <option value="">Selecione</option>	
                      <option value="feminino" <?php echo ($cliente AND $cliente->get_genero() == 'feminino') ? 'selected="selected"' : '' ?>>Feminino</option>
                      <option value="masculino" <?php echo ($cliente AND $cliente->get_genero() == 'masculino') ? 'selected="selected"' : '' ?>>Masculino</option>
                    </select>
                </li>
            	<li>
                	<label>Data de Nascimento &#42;</label>
            		<input type="text" class="required padrao" name="nascimento" id="form_nascimento" maxlength="10" value="<?php echo ($cliente AND ! is_null($cliente->get_nascimento())) ? date('d/m/Y', strtotime($cliente->get_nascimento())) : '' ?>" /><br />
                    <p><span>(DD/MM/AAAA)</span></p>
                </li>
            	<li>
            		<label>Telefone Principal &#42;</label>
            		<input type="text" class="required ddd" name="ddd_principal" id="form_ddd_principal" maxlength="2" value="<?php echo $cliente ? substr($cliente->get_telefone_principal(), 0, 2) : '' ?>" />
            		<p> - </p>
                    <input type="text" class="required telefone" name="tel_principal" id="form_tel_principal" maxlength="8" value="<?php echo $cliente ? substr($cliente->get_telefone_principal(), 2) : '' ?>" /><br />
                    <p><span>(DDD - Telefone)</span></p>
            	</li>
            	<li>
                	<label class="nao-obrigatorio">Telefone Celular</label>
            		<input type="text" class="ddd" name="ddd_celular" id="form_ddd_celular" maxlength="2" value="<?php echo $cliente ? substr($cliente->get_telefone_celular(), 0, 2) : '' ?>" />
            		<p> - </p>
                    <input type="text" class="telefone" name="tel_celular" id="form_tel_celular" maxlength="8" value="<?php echo $cliente ? substr($cliente->get_telefone_celular(), 2) : '' ?>" /><br />
                    <p><span>(DDD - Telefone) (Opcional)</span></p>
                </li>
            	<li>
            		<label class="nao-obrigatorio">Telefone Comercial</label>
            		<input type="text" class="ddd" name="ddd_comercial" id="form_ddd_comercial" maxlength="2" value="<?php echo $cliente ? substr($cliente->get_telefone_comercial(), 0, 2) : '' ?>" />
            		<p> - </p>
                    <input type="text" class="telefone" name="tel_comercial" id="form_tel_comercial" maxlength="8" value="<?php echo $cliente ? substr($cliente->get_telefone_comercial(), 2) : '' ?>" /><br />
                    <p><span>(DDD - Telefone) (Opcional)</span></p>
            	</li>
           		<li class="separador"></li>
                <li>
                	<label>Como gostaria de ser chamado? &#42;</label>
            		<input type="text" class="required padrao" name="apelido" id="form_apelido" maxlength="100" value="<?php echo $cliente ? $cliente->get_apelido() : '' ?>"  /><br />
                    <p><span>(Primeiro nome, sobrenome, apelido, etc...)</span></p>
                </li>
            	<li>
            		<label>E-mail &#42;</label>
            		<input type="text" name="email" id="form_email" maxlength="255" class="required" value="<?php echo $cliente ? $cliente->get_email() : '' ?>" />
            	</li>
            	<li>
                	<label>Senha &#42;</label>
            		<input type="password" class="required padrao" name="senha" id="form_senha" /><br />
                    <p><span>Sua senha deve ter no mínimo de 6 caracteres</span></p>
                </li>
            	<li>
            		<label>Confirme a senha &#42;</label>
            		<input type="password" class="required padrao" name="confirma_senha" id="form_confirma_senha" />
            	</li>
            	<li class="continuar">
                	<button type="submit">Enviar</button>
                </li>
			</ul>            
            
            <?php if ( ! is_null($notificacao) AND strlen($notificacao->get_mensagem()) > 0) { ?>
		        <div id="form_cadastro_notification" class="erro"><?php echo $notificacao->get_mensagem() ?></div>
		    <?php } else { ?>
	            <div id="form_cadastro_notification"></div>
		    <?php } ?>
        </form>
            
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>
