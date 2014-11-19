<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Novo Cadastro</h1>
        
        <div class="voltar"><a href="<?php echo $anterior ?>">&#171; VOLTAR</a></div>
        
        <p class="titulo-interna">Você está a dois passos de ingressar na família movelclube.com</p>
        
        <div class="navegue-forms">
        	<a href="<?php echo SITE_URL ?>/area-cliente/cadastro" title="Clique para visualizar o formulário dos dados cadastrais"><img src="<?php echo SITE_BASE ?>/views/imagens/form-dados-cadastrais.gif" alt="Formulário dos Dados Cadastrais" /></a>
            <img src="<?php echo SITE_BASE ?>/views/imagens/form-endereco-ativo.gif" alt="Formulário do Endereço" />
        </div>
        
        <p>Entendemos que este seja um processo um pouco trabalhoso no início, mas prometemos compensar na agilidade após o cadastro para poder comprar com tamanha facilidade e que esteja ao seu alcance tudo o que estiver procurando. Bem vindo(a) ao clube.</p>
        
        <form method="post" action="<?php echo SITE_URL ?>/area-cliente/cadastro-endereco/#form_cadastro_notification" id="form-endereco" >

            <ul>
            	<li>
            		<label>CEP &#42;</label>
            		<input type="text" class="cep-1 required" name="entrega_cep_1" id="form_cep_1" maxlength="5" value="<?php echo $cliente ? substr($cliente->get_entrega_cep(), 0, 5) : '' ?>" />
            		<p> - </p>
                    <input type="text" class="cep-2 required" name="entrega_cep_2" id="form_cep_2" maxlength="3" value="<?php echo $cliente ? substr($cliente->get_entrega_cep(), 5, 3) : '' ?>" />
            	</li>
                <li class="tipo-endereco">            
                    <label>Identificação do Endereço &#42;</label>
                    <input type="radio" name="entrega_endereco_tipo" value="residencial" <?php echo ( ! $cliente OR $cliente->get_entrega_endereco_tipo() == 'residencial' ) ? 'checked="checked"' : '' ?> style="margin:0;"><p>Residencial</p>
                    <input type="radio" name="entrega_endereco_tipo" value="comercial" <?php echo ( $cliente AND $cliente->get_entrega_endereco_tipo() == 'comercial' ) ? 'checked="checked"' : '' ?> style="margin:0;"><p>Comercial</p>
                    <input type="radio" name="entrega_endereco_tipo" value="outro" <?php echo ( $cliente AND $cliente->get_entrega_endereco_tipo() == 'outro' ) ? 'checked="checked"' : '' ?> style="margin:0;"><p>Outro</p>
            	</li>
                <li>
                	<label>Endereço &#42;</label>
            		<input type="text" name="entrega_endereco" id="form_endereco" maxlength="100" class="required" value="<?php echo $cliente ? $cliente->get_entrega_endereco() : '' ?>" />
                </li>
            	<li>
            		<label>Número &#42;</label>
            		<input type="text" name="entrega_numero" id="form_numero" maxlength="6" class="required" value="<?php echo $cliente ? $cliente->get_entrega_numero() : '' ?>" />
            	</li>            	
            	<li>
                	<label class="nao-obrigatorio">Complemento</label>
            		<input type="text" class="padrao" name="entrega_complemento" id="form_complemento" maxlength="100" value="<?php echo $cliente ? $cliente->get_entrega_complemento() : '' ?>" /><br />
                    <span>(Opcional)</span>
                </li>
            	<li>
            		<label class="nao-obrigatorio">Informações de Referência</label>
            		<textarea type="text" name="entrega_referencia" id="form_referencia" style="resize:none;overflow:auto"><?php echo $cliente ? $cliente->get_entrega_referencia() : '' ?></textarea>
            	</li>
            	<li>
                	<label>Bairro &#42;</label>
            		<input type="text" class="padrao required" name="entrega_bairro" id="form_bairro" maxlength="50" value="<?php echo $cliente ? $cliente->get_entrega_bairro() : '' ?>" />
                </li>
            	<li>
            		<label>Cidade &#42;</label>
		            <select class="padrao required" name="entrega_cidade" id="form_cidade">
			            <option value="Alvorada" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Alvorada') ? 'selected="selected"': '' ?>>Alvorada</option>
                        <option value="Bento Gonçalves" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Bento Gonçalves') ? 'selected="selected"': '' ?>>Bento Gonçalves</option>
                        <option value="Cachoeirinha" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Cachoeirinha') ? 'selected="selected"': '' ?>>Cachoeirinha</option>
                        <option value="Canoas" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Canoas') ? 'selected="selected"': '' ?>>Canoas</option>
                        <option value="Caxias do Sul" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Caxias do Sul') ? 'selected="selected"': '' ?>>Caxias do Sul</option>
                        <option value="Eldorado do Sul" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Eldorado do Sul') ? 'selected="selected"': '' ?>>Eldorado do Sul</option>
                        <option value="Esteio" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Esteio') ? 'selected="selected"': '' ?>>Esteio</option>
                        <option value="Farroupilha" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Farroupilha') ? 'selected="selected"': '' ?>>Farroupilha</option>
                        <option value="Flores da Cunha" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Flores da Cunha') ? 'selected="selected"': '' ?>>Flores da Cunha</option>
                        <option value="Garibaldi" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Garibaldi') ? 'selected="selected"': '' ?>>Garibaldi</option>
                        <option value="Gravataí" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Gravataí') ? 'selected="selected"': '' ?>>Gravataí</option>
                        <option value="Guaíba" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Guaíba') ? 'selected="selected"': '' ?>>Guaíba</option>
                        <option value="Novo Hamburgo" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Novo Hamburgo') ? 'selected="selected"': '' ?>>Novo Hamburgo</option>
                        <option value="Porto Alegre" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Porto Alegre') ? 'selected="selected"': '' ?>>Porto Alegre</option>
                        <option value="São Leopoldo" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'São Leopoldo') ? 'selected="selected"': '' ?>>São Leopoldo</option>
                        <option value="Sapucaia do Sul" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Sapucaia do Sul') ? 'selected="selected"': '' ?>>Sapucaia do Sul</option>
                        <option value="Viamão" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Viamão') ? 'selected="selected"': '' ?>>Viamão</option>
                        <option value="Outra" <?php echo ($cliente AND $cliente->get_entrega_cidade() == 'Outra') ? 'selected="selected"': '' ?>>Outra</option>
		            </select>
            	</li>
                <li>
                	<label>Estado &#42;</label>

                    <select class="padrao required" name="entrega_estado" id="form_uf">
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