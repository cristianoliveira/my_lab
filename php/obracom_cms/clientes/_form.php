<form id="clientes_form" class="form-default" action="<= $action_form ?>" method="post" enctype="multipart/form-data">    
    <fieldset>

        <?php if(isset($cliente['idcliente'])) { ?>
        <input class ="text-input medium-input required"
                type  ="hidden"
                id    ="id"
                name  ="id"
                maxlength="255"
                value="<?= $cliente['idcliente'] ?>" 
                required/>
        <?php } ?>
        <div>
            <label>Nome</label>
            <input class ="text-input medium-input required"
                    type  ="text"
                    id    ="nome_cliente"
                    name  ="nome_cliente"
                    maxlength="255"
                    value="<?= $cliente['nome_cliente'] ?>" 
                    required/>
        </div>
        <div>
            <label>CPF</label>
            <input class="text-input medium-input required"
                    type ="text"
                    id   ="cpf"
                    name ="cpf"
                    maxlength="255"
                    value="<?= $cliente['cpf'] ?>" required/>
        </div>
        <div>
            <label>Sexo</label>
            <select name="genero" id="genero" value="<?= $cliente['genero'] ?>">
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
        </div>
        <div>
            <label>Data Nascimento</label>
            <input class="text-input medium-input required"
                    type ="date"
                    id   ="nascimento"
                    name ="nascimento"
                    maxlength="255"
                    value="<?= $cliente['nome_cliente'] ?>"/>
        </div>
        <div>
            <label>Telefone Principal</label>
            <input class="text-input small-input required"
                    type ="phone"
                    id   ="telefone_principal_prefix"
                    name ="telefone_principal_prefix"
                    maxlength="3"
                    value="<?= substr($cliente['telefone_principal'], 0 , 3) ?>" 
                    required/>
            <input class="text-input medium-input required"
                    type ="phone"
                    id   ="telefone_principal"
                    name ="telefone_principal"
                    maxlength="9"
                    value="<?= substr($cliente['telefone_principal'], 3, strlen($cliente['telefone_principal'])-3) ?>" 
                    required/>
        </div>
        <div>
            <label>Email</label>
            <input class="text-input medium-input required"
                    type ="email"
                    id   ="email_cliente"
                    name ="email_cliente"
                    maxlength="255"
                    value="<?= $cliente['email_cliente'] ?>" 
                    required/>
        </div>
        <div>
            <label>Senha</label>
            <input class="text-input medium-input required"
                    type ="password"
                    id   ="senha"
                    name ="senha"
                    maxlength="255"
                    value="<?= $cliente[0]['senha'] ?>" 
                    required/>
        </div>
        <div>
            <input class="button"type="submit" value="<?= $acao ?>"/>
        </div>
    </fieldset>

    <div class="clear"></div><!-- End .clear -->
</form>