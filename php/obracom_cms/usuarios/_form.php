<form class="form-default" action="<?= $action_form ?>" id="banners_form" method="post" enctype="multipart/form-data">    <fieldset>
        
    <?php if(isset($usuario['id'])) { ?>
              <input class="text-input small-input required" 
                     type="hidden" 
                     id="nome" 
                     name="nome" 
                     maxlength="150" 
                     value="<?= if_exist($usuario['id']) ?>"/>

    <?php } ?>
        <div>
            <label for="nome">Nome Completo</label>
            <input class="text-input small-input required" 
                   type="text" 
                   id="nome" 
                   name="nome" 
                   maxlength="150" 
                   value="<?= if_exist($usuario['nome']) ?>"/>
        </div>

        <div>
            <label for="usuario">Usuário </label>
            <input class="text-input large-input"
                   type="text"
                   id="usuario"
                   name="usuario"
                   maxlength="100"
                   value="<?= if_exist($usuario['usuario']) ?>"/>
            <br/><small> Este será o usuário que dá acesso ao login do gerenciador.</small>
        </div>

        <div>
            <label for="senha">Senha</label>
            <input class="text-input large-input" 
                   id="senha" 
                   name="senha"
                   maxlength="255" 
                   type="password"/>
        </div>

        <div>
            <input type="submit" class="button" id="btn_send" value="<?= $acao ?>" />
        </div>

    </fieldset>

    <div class="clear"></div><!-- End .clear -->

</form>