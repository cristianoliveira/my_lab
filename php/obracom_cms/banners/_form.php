<form id="form-banner" class="form-default" method="post" action="<?= $form_action ?>"  >
        
    <?php if(isset($banner['id'])) { ?>
    <input type="hidden"  
            name="id" 
            value="<?= $banner['id'] ?>"
    />
    <?php } ?>
        
        <div>
            <div>
                <label for="titulo">Título</label>
                <input class="text-input medium-input required" 
                       type="text" 
                       id="titulo" 
                       name="titulo" 
                       maxlength="150" 
                       value="<?= if_exist($banner['titulo']) ?>"/> 
                <small> * Somente para uso interno </small>
            </div>
            
            <div>
                <label for="imagem">Imagem</label>
                <div style="width: 500px;">
                  <div id="preview-crop" class="cropme" style="width: 500px; height: 350px; margin auto"></div>
                  <small>Edite a imagem na Ferramenta Crop, clique aqui para editar a imagem.</small>
                  <input type="hidden" 
                         name="imagem" 
                         id="imagem" 
                         value="<?= if_exist($banner['imagem'],'') ?>"/><br />
                </div>
            </div>
            <div>
                <label for="link">Link</label>
                <input class="text-input large-input"
                       id="link"
                       name="link"
                       maxlength="255"
                       value="<?= if_exist($banner['link']) ?>"/>
                <br/><small>Digite ou cole no campo acima o link <strong>completo</strong> para o conteúdo.</small>
            </div>

            <?php if(isset($banner['id'])) { ?>
                <a href="<?= site_url('uploads/banners/'.$banner['imagem']) ?>" target="_blank">
                  <img src="<?= site_url('uploads/banners/'.$banner['imagem']) ?>" style="width:100px;" />
                  <br />
                  Visualizar 
                </a>
            <?php } ?>
            <div>
                <input type="submit" class="button" id="btn_send" name="btn_send" value="Cadastrar" />
            </div>
        </div>            
            
    <div id="form_cadastro_notification"></div>
</form>
<script type="text/javascript">
    $('#preview-crop').simpleCropper();
    $('#form-banner').submit(function(){
        img     = $('#preview-crop').find('img');
        source  = img.attr('src');

        $('#imagem').val(source);

    })
</script>