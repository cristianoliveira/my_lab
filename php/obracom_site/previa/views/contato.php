<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Contato</h1>
        
        <div class="voltar"><a href="<?php echo $anterior ?>">&#171; VOLTAR</a></div>
        
        <p class="subtitulo-interna">Formulário de Contato</p>
        
        <p>Preencha o formulário abaixo para entrar em contato com a Movel Clube.</p>

        <div id="form_contato_sucesso"></div>

        <form method="post" action="<?php echo SITE_URL ?>/contato/enviar" name="formContato" id="form-contato" >
        
        
            <input type="hidden" name="acao" value="enviar" />

            <label>Nome</label>
            <input type="text" name="contato_nome" id="contato_nome" maxlength="100" style="margin:0 10px 0 40px;" />

            <label>E-mail</label>
            <input type="text" name="contato_email" id="contato_email" maxlength="255" style="margin-left: 10px; width: 337px;"/>

            <div class="clear"></div>

            <label>Fone</label>
            <input type="text" name="contato_ddd" id="contato_ddd" maxlength="2" style="width:25px;margin:0 10px 0 45px;"/>
            <input type="text" name="contato_fone" id="contato_fone" maxlength="10" style="width:160px; margin-right:10px;"/>

            <label>Estado</label>
            <select size="1" id="contato_uf" name="contato_uf" style="width:50px; margin:0 10px;">
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MT">MT</option>
                <option value="MS">MS</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SP">SP</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
            </select>

            <label>Cidade</label>
            <input type="text" name="contato_cidade" id="contato_cidade" maxlength="100" style="margin-left:10px;width:362px;"/>

            <div class="clear"></div>

            <label>Assunto</label>
            <select size="1" id="contato_assunto" name="contato_assunto" style="width:225px; margin-left:25px;">
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
            
			<?php if (isset($_GET["pid"]) AND isset($_GET['pname'])) { ?>
				<label>Produto</label>
				<input name="contato_produto" type="text" id="contato_produto" style="width:350px; margin-left:25px;" value="<?php echo $_GET["pid"]." - ".$_GET["pname"]; ?>" readonly="readonly"/>
            <?php } ?>
            
  <div class="clear"></div>

            <label>Mensagem</label>
            <textarea type="text" name="contato_mensagem" id="contato_mensagem" style="overflow:auto;margin-left:10px;"></textarea>

            <button type="submit" >Enviar</button>

            <div id="form_contato_notification"></div>

            <div class="clear"></div>

        </form>
            
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>