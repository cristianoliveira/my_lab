<form class="form-default" action="<?= $action_form ?>" id="banners_form" method="post" enctype="multipart/form-data">    <fieldset>
        
        <div>
            <label for="nome">Nome</label>
            <input class="text-input small-input required" 
                   type="text" 
                   id="nome" 
                   name="nome" 
                   maxlength="150" 
                   value="<?= if_exist($usuario['nome']) ?>"/>
        </div>

        <div>
            <label for="nome">Nome SEO</label>
            <input class="text-input large-input" 
                   type="text" 
                   id="nome_seo" 
                   name="nome_seo" 
                   value="<?= if_exist($usuario['nome_seo']) ?>"/>
        </div>
        

        <div>
            <input type="submit" class="button" id="btn_send" value="<?= $acao ?>" />
        </div>

    </fieldset>

    <div class="clear"></div><!-- End .clear -->

</form>