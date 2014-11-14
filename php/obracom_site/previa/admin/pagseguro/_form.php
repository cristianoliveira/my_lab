<form id="form-cliente" class="form-default" method="post" action="<?= $form_action ?>"  >
        
    <?php if(isset($cliente['id'])) { ?>
    <input type="hidden"  
            name="id" 
            value="<?= $cliente['id'] ?>"
    />
    <?php } ?>
        
        <div>
            <div class="radio-input">            
                <input type="radio" 
                       id="pessoa_tipo_fisica"  
                       name="pessoa_tipo" 
                       value="fisica" 
                       <?= (if_exist($cliente['cpf'])!="")? 'checked="checked"' : '' ?>
                >
                     Pessoa Física
                </input>
                <input type="radio" 
                       id="pessoa_tipo_juridica" 
                       name="pessoa_tipo" 
                       value="juridica"
                       <?= (if_exist($cliente['cnpj'])!="")? 'checked="checked"' : '' ?>
                >
                     Pessoa Jurídica
                </input>
            </div>

            <div class="pessoa_fisica">
                <label>Nome completo &#42;</label>
                <input type="text" 
                       class="text-input large-input required" 
                       id="form_nome" 
                       name="nome" 
                       maxlength="100" 
                       value="<?= if_exist($cliente['nome']) ?>" 
                />
            </div>
            <div class="pessoa_fisica">
                <label>CPF &#42;</label>
                <input type="text" 
                       class="text-input required" 
                       id="form_cpf" 
                       name="cpf" 
                       maxlength="11" 
                       value="<?= if_exist($cliente['cpf']) ?>" 
                />
                <br />
                <p><span>(Apenas números, sem pontos ou traços)</span></p>
            </div>

            <div class="pessoa_juridica">
                <label>Razão social &#42;</label>
                <input type="text" 
                       class="text-input large-input required" 
                       id="form_razao_social" 
                       name="razao_social" 
                       maxlength="100" 
                       value="<?= if_exist($cliente['razao_social']) ?>" 
                />
            </div>
            <div class="pessoa_juridica">
                <label>CNPJ &#42;</label>
                <input type="text" 
                       class="text-input required" 
                       id="form_cnpj" 
                       name="cnpj" 
                       maxlength="14" 
                       value="<?= if_exist($cliente['cnpj']) ?>" 
                />
                <br />
                <p><span>(Apenas números, sem pontos ou traços)</span></p>
            </div>
            <div class="pessoa_juridica">
                <label>Nome do responsável &#42;</label>
                <input type="text" 
                       class="text-input large-input required" 
                       id="form_responsavel_nome" 
                       name="responsavel_nome" 
                       maxlength="100" 
                       value="<?= if_exist($cliente['responsavel_nome']) ?>" />
            </div>
            <div class="pessoa_juridica">
                <label>CPF do responsável &#42;</label>
                <input type="text" 
                       class="text-input required" 
                       id="form_responsavel_cpf" 
                       name="responsavel_cpf" 
                       maxlength="11" 
                       value="<?= if_exist($cliente['responsavel_cpf']) ?>" 
                />
                <br />
                <p><span>(Apenas números, sem pontos ou traços)</span></p>
            </div>

            <div>
                <label>Sexo &#42;</label>
                <select name="genero" id="form_genero" class="text-input required">
                  <option value="">Selecione</option>    
                  <option value="feminino"  <?= (if_exist($cliente['genero']) == "feminino")? "selected" : ""; ?> >
                        Feminino
                  </option>
                  <option value="masculino" <?= (if_exist($cliente['genero']) == "masculino")? "selected" : ""; ?> >
                        Masculino
                  </option>
                </select>
            </div>
            <div>
                <label>Data de Nascimento &#42;</label>
                <input type="text" 
                       class="text-input small-text required" 
                       id="nascimento"
                       name="nascimento"  
                       maxlength="10" 
                       value="<?= if_exist($cliente['nascimento']) ?>" />
                <br />
                <p><span>(DD/MM/AAAA)</span></p>
            </div>
            <div>
                <label>Telefone Principal &#42;</label>
                <input type="text" 
                       class="text-input ddd" 
                       id="ddd_telefone_principal" 
                       name="ddd_telefone_principal" 
                       maxlength="2" 
                       value="<?= substr(if_exist($cliente['telefone_principal']),0,2) ?>" />
                -
                <input type="text" 
                       class="text-input required telefone" 
                       id="telefone_principal" 
                       name="telefone_principal" 
                       maxlength="8" 
                       value="<?= substr(if_exist($cliente['telefone_principal']),2) ?>" />
                <p><span>(DDD - Telefone)</span></p>
            </div>
            <div>
                <label class="nao-obrigatorio">Telefone Celular</label>
                <input type="text" 
                       class="text-input ddd" 
                       id="ddd_telefone_celular" 
                       name="ddd_telefone_celular" 
                       maxlength="2" 
                       value="<?= substr(if_exist($cliente['telefone_celular']),0,2) ?>" />
                - 
                <input type="text" 
                       class="text-input telefone" 
                       id="telefone_celular" 
                       name="telefone_celular" 
                       maxlength="8" 
                       value="<?= substr(if_exist($cliente['telefone_celular']),2) ?>" /><br />
                <p><span>(DDD - Telefone) (Opcional)</span></p>
            </div>
            <div>
                <label class="nao-obrigatorio">Telefone Comercial</label>
                <input type="text" 
                       class="text-input ddd" 
                       id="ddd_telefone_comercial" 
                       name="ddd_telefone_comercial" 
                       maxlength="2" 
                       value="<?= substr(if_exist($cliente['telefone_comercial']),0,2) ?>" />
                - 
                <input type="text" 
                       class="text-input telefone" 
                       id="form_tel_celular" 
                       name="telefone_comercial" 
                       maxlength="8" 
                       value="<?= substr(if_exist($cliente['telefone_comercial']),2) ?>" /><br />
                <p><span>(DDD - Telefone) (Opcional)</span></p>
            </div>
            <div class="separador"></div>
            <div>
                <label>Como gostaria de ser chamado? &#42;</label>
                <input type="text" 
                        class="text-input required padrao" 
                        id="form_apedivdo" 
                        name="apelido" 
                        maxlength="100" 
                        value="<?= if_exist($cliente['apelido']) ?>"
                />
                <br />
                <p><span>(Primeiro nome, sobrenome, apedivdo, etc...)</span></p>
            </div>
            <div>
                <label>E-mail &#42;</label>
                <input type="text" 
                        class="text-input required" 
                        id="form_email" 
                        name="email" 
                        maxlength="255" 
                        value="<?= if_exist($cliente['email']) ?>" 
                />
            </div>
            <div>
                <label>Senha &#42;</label>
                <input type="password" 
                        class="text-input required padrao" 
                        name="senha" 
                        id="form_senha" 
                />
                <br />
                <p><span>Sua senha deve ter no mínimo de 6 caracteres</span></p>
            </div>
            <div>
                <label>Confirme a senha &#42;</label>
                <input type="password" 
                        class="text-input required padrao" 
                        id="confirmacao_senha" 
                        name="confirmacao_senha" 
                />
            </div>
            <div class="continuar">
                <button type="submit">Enviar</button>
            </div>
        </div>            
            
    <div id="form_cadastro_notification"></div>
</form>
<script>
    isPessoaFisica = function()
    {
       var value = $( "input:checked" ).val();
       return (value == 'fisica');
    }

    validaTipoPessoa = function()
    {
        if(isPessoaFisica())
        { 
            $('.pessoa_juridica').hide();
            $('.pessoa_juridica').find('input').val("");

            $('.pessoa_fisica').show();
        }
        else
        {
            $('.pessoa_fisica').hide();
            $('.pessoa_fisica').find('input').val("");

            $('.pessoa_juridica').show();
          }
    };

    $(function(){
        validaTipoPessoa();
        $.validator.messages.required = 'Campo deve ser informado.';
        $.validator.messages.number   = 'Informe somente números.';
        $.validator.messages.email    = 'Email incorreto.'
    });

    $('input').click(function(){
        validaTipoPessoa();

        $("#form-cliente").validate({
            rules:
            {
                nome            :{ required: '#pessoa_tipo_fisica:checked' },
                cpf             :{ required: '#pessoa_tipo_fisica:checked'   ,  number:true },
                razao_social    :{ required: '#pessoa_tipo_juridica:checked' },
                cnpj            :{ required: '#pessoa_tipo_juridica:checked' ,  number:true },
                responsavel_nome:{ required: '#pessoa_tipo_juridica:checked' },
                responsavel_cpf :{ required: '#pessoa_tipo_juridica:checked' },
                email              :{ required: true , email: true},         
                genero             :{ required: true },
                ddd_telefone_principal :  { required: true, number: true },         
                telefone_principal :      { required: true, number: true },         
                ddd_telefone_celular:     { number: true },         
                telefone_celular:         { number: true },
                ddd_telefone_comercial:   { number: true },         
                telefone_comercial:       { number: true },
                confirmacao_senha:        { confirmacaoSenha: true },
            },
        })
    });

    $("#nascimento").datepicker({showButtonPanel: true});
</script>