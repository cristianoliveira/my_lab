<form class="form-default" action="<?= $action_form ?>" id="banners_form" method="post" enctype="multipart/form-data">    <fieldset>
        <div>
            <label for="nome">Nome Completo</label>
            <input class="text-input small-input required" 
                   type="text" 
                   id="nome" 
                   name="nome_usuario" 
                   maxlength="150" 
                   value="<?= $usuario['nome_usuario'] ?>"/>
        </div>

        <div>
            <label for="conta">Usuário </label>
            <input class="text-input large-input"
                   type="text"
                   id="conta"
                   name="conta"
                   maxlength="100"
                   value="<?= $usuario['conta'] ?>"/>
            <br/><small> Este será o usuário que dá acesso ao login do gerenciador.</small>
        </div>

        <div>
            <label for="senha">Senha</label>
            <input class="text-input large-input" 
                   id="senha" 
                   name="senha"
                   maxlength="255" 
                   value="<?= $usuario['senha'] ?>" 
                   type="password"/>
        </div>

        <div>
            <label for="email">E-mail </label>
            <input class="text-input small-input required" 
                   type="text" 
                   id="email" 
                   name="email_usuario" 
                   maxlength="320" 
                   value="<?= $usuario['email_usuario'] ?>"/>
        </div>

        <div>
            <input type="submit" class="button" id="btn_send" value="<?= $acao ?>" />
        </div>

    </fieldset>

    <div class="clear"></div><!-- End .clear -->

</form>