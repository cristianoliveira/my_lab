<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
    <div class="container">

        <h1>Endereços</h1>

        <div class="voltar"><a href="<?php echo $anterior ?>">&#171; VOLTAR</a></div>

        <p class="titulo-interna">Endereços para Entrega</p>

        <div class="navegue-forms">
            <img src="<?php echo SITE_BASE ?>/views/imagens/form-dados-cadastrais.gif" alt="Formulário dos Dados Cadastrais" />
            <img src="<?php echo SITE_BASE ?>/views/imagens/form-endereco-ativo.gif" alt="Formulário do Endereço" />
            <img src="<?php echo SITE_BASE ?>/views/imagens/form-confirmacao.gif" alt="Confirmação do Cadastro" />            
        </div>
        <form method="POST" action="<?php echo SITE_URL ?>/carrinho/endereco_escolhido" id="form-escolha-endereco">
            <ul>
                <li class="opcoes selecionado">
                    <div class="endereco">
                        <p class="titulo">Endereço 1 (Padrão)</p>
                        <p><?php echo $cliente->get_entrega_endereco() ?>, <?php echo $cliente->get_entrega_numero() ?><?php echo  $cliente->get_entrega_complemento() != NULL ? '/'.$cliente->get_entrega_complemento() : '' ?></p>
                        <p><?php echo $cliente->get_entrega_cidade() ?>, <?php echo $cliente->get_entrega_estado() ?></p>
                        <p>CEP <?php echo $cliente->get_entrega_cep() ?></p>
                    </div>
                    <div class="botao">
                    	<input type="radio" name="endereco" id="radio-endereco1" value="padrao" checked="checked"/>
                    	<span class="acao-endereco-editar">Editar</span>
                	</div>
                </li>
                <?php
                    $i = 1;
                    foreach ($enderecos as $endereco)
                    { ?>
                        <li class="opcoes">
                            <div class="endereco">
                                <p class="titulo">Endereço <?php echo ++$i ?></p>
                                <p><?php echo $endereco->get_endereco() ?>, <?php echo $endereco->get_numero() ?><?php echo $endereco->get_complemento() != NULL ? "/".$endereco->get_complemento() : "" ?></p>
                                <p><?php echo $endereco->get_cidade().', '.$endereco->get_estado() ?></p>
                                <p>CEP <?php echo $endereco->get_cep() ?></p>
                            </div>
                            <div class="botao">
                            	<input type="radio" name="endereco" id="radio-endereco<?php echo $i ?>" value="<?php echo $endereco->get_id(); ?>" />
                            	<span class="acao-endereco-editar">Editar</span><br /><span class="acao-endereco-remover">Remover</span>
                        	</div>
                        </li>
                    <?php }
                ?>
            </ul>
                <div class="clear"></div>
                <button type="submit">Enviar</button>
            
            <div class="clear"></div>
        </form>
		<div class="clear"></div>
        
        <p id="titulo-edit-cad" class="titulo-interna">Incluir novo endereço</p>

        <form method="post" action="<?php echo SITE_URL ?>/carrinho/gerenciar_endereco/" id="form-endereco">
            <input type="hidden" name="acao" value="inserir" id="acao-form-endereco" />
            <input type="hidden" name="id" value="" id="endereco_id" />
            <ul>
                <li>
                    <label>CEP &#42;</label>
                    <input type="text" class="cep-1 required" name="cep1" id="form_cep_1" maxlength="5" value="" />
                    <p> - </p>
                    <input type="text" class="cep-2 required" name="cep2" id="form_cep_2" maxlength="3" value="" />
                </li>
                <li class="tipo-endereco">
                    <label>Identificação do Endereço &#42;</label>
                    <input type="radio" name="tipo" value="residencial" checked="checked" style="margin:0;"><p>Residencial</p>
                    <input type="radio" name="tipo" value="comercial" style="margin:0;"><p>Comercial</p>
                    <input type="radio" name="tipo" value="outro" style="margin:0;"><p>Outro</p>
                </li>
                <li>
                    <label>Endereço &#42;</label>
                    <input type="text" name="endereco" id="form_endereco" maxlength="100" class="required" value="" />
                </li>
                <li>
                    <label>Número &#42;</label>
                    <input type="text" name="numero" id="form_numero" maxlength="6" class="required" value="" />
                </li>
                <li>
                    <label class="nao-obrigatorio">Complemento</label>
                    <input type="text" class="padrao" name="complemento" id="form_complemento" maxlength="100" value="" /><br />
                    <span>(Opcional)</span>
                </li>
                <li>
                    <label class="nao-obrigatorio">Informações de Referência</label>
                    <textarea type="text" name="referencia" id="form_referencia" style="resize:none;overflow:auto"></textarea>
                </li>
                <li>
                    <label>Bairro &#42;</label>
                    <input type="text" class="padrao required" name="bairro" id="form_bairro" maxlength="50" value="" />
                </li>
                <li>
                    <label>Cidade &#42;</label>
                    <select class="padrao required" name="cidade" id="form_cidade">
                        <option value="Alvorada">Alvorada</option>
                        <option value="Bento Gonçalves">Bento Gonçalves</option>
                        <option value="Cachoeirinha">Cachoeirinha</option>
                        <option value="Canoas">Canoas</option>
                        <option value="Caxias do Sul">Caxias do Sul</option>
                        <option value="Eldorado do Sul"="selected">Eldorado do Sul</option>
                        <option value="Esteio">Esteio</option>
                        <option value="Farroupilha">Farroupilha</option>
                        <option value="Flores da Cunha">Flores da Cunha</option>
                        <option value="Garibaldi">Garibaldi</option>
                        <option value="Gravataí">Gravataí</option>
                        <option value="Guaíba">Guaíba</option>
                        <option value="Novo Hamburgo" >Novo Hamburgo</option>
                        <option value="Porto Alegre">Porto Alegre</option>
                        <option value="São Leopoldo">São Leopoldo</option>
                        <option value="Sapucaia do Sul">Sapucaia do Sul</option>
                        <option value="Viamão">Viamão</option>
                        <option value="Outra">Outra</option>
                    </select>
                </li>
                <li>
                    <label>Estado &#42;</label>
                    <!--<input type="text" class="padrao required" name="estado" id="form_uf" maxlength="2" style="text-transform: uppercase" value="" />-->
                    <select class="padrao required" name="estado" id="form_uf">
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
                </li>
                <li class="continuar">
                    <button type="submit">Enviar</button>
                </li>
            </ul>
            <?php if ( ! is_null($notificacao) AND strlen($notificacao->get_mensagem()) > 0) { ?>
            <div id="form_cadastro_notification" class="<?php echo $notificacao->get_tipo() ?>"><?php echo $notificacao->get_mensagem() ?></div>
            <?php } else { ?>
            <div id="form_cadastro_notification"></div>
            <?php } ?>
        </form>

        <div class="clear"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#form-escolha-endereco input[type=radio]").change(function() {
            id = $(this).attr('id');
            $("#form-escolha-endereco li").each(function(){
                $(this).removeClass('selecionado');
            });
            $('#' + id).parent().parent().addClass('selecionado');
        });
        $('.acao-endereco-editar').click(function(){
            var id = $(this).parent().find('input[type=radio]').val();
            $('#endereco_id').val(id)
            $('#titulo-edit-cad').text('Editar Endereço');
            $('#acao-form-endereco').val('editar');
            $.post(
                '<?php echo SITE_URL ?>/carrinho/carregar-endereco',
                {id: id},
                function(json){
                    var cep = json.cep+'';
                    $('#form_cep_1').val(cep.substr(0, 5));
                    $('#form_cep_2').val(cep.substr(5, 3));
                    $('#form-endereco input[type=radio]').removeAttr('checked');
                    var endereco_tipo = json.endereco_tipo;
                    $('#form-endereco input[type=radio]').each(function(){
                        if ($(this).val() == endereco_tipo)
                        {
                            $(this).attr('checked', 'checked');
                        }
                    });
                    var endereco = json.endereco;
                    $('#form_endereco').val(endereco);
                    var numero = json.numero;
                    $('#form_numero').val(json.numero);
                    var complemento = json.complemento;
                    $('#form_complemento').val(complemento);
                    var referencia = json.referencia;
                    $('#form_referencia').val(referencia);
                    var bairro = json.bairro;
                    $('#form_bairro').val(bairro);
                    $('select#form_cidade option').removeAttr('selected');
                    var cidade = json.cidade;
                    $('select#form_cidade option').each(function(){
                        if ($(this).val() == cidade)
                        {
                            $(this).attr('selected', 'selected');
                        }
                    })
                    var estado = json.estado;
                    $('select#form_uf option').each(function(){
                        if ($(this).val() == estado)
                        {
                            $(this).attr('selected', 'selected');
                        }
                    })

                    //$('#form_uf').val(estado);
                },
                'json'
            );
        });
        $('.acao-endereco-remover').click(function(){
            if (confirm('Deseja mesmo excluir este endereço?'))
            {
                var id = $(this).parent().find('input[type=radio]').val();
                $.post(
                    '<?php echo SITE_URL ?>/carrinho/remover_endereco',
                    {id: id},
                    function() {
                        location.href='<?php echo SITE_URL ?>/carrinho/selecionar_endereco';
                    }
                );
            }
        });
    });
</script>

<style>
    .acao-endereco-editar, .acao-endereco-remover {
        cursor: pointer;
    }
</style>

<?php include 'includes/rodape.php'; ?>