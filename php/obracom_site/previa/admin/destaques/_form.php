<form id="form-destaque" class="form-default" method="post" action="<?= $form_action ?>"  >
        
    <?php if(isset($destaque['id'])) { ?>
    <input type="hidden"  
            name="id" 
            value="<?= $destaque['id'] ?>"
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
                       value="<?= if_exist($destaque['titulo']) ?>"/> 
                <small> * Somente para uso interno </small>
            </div>
            
            <div>
                <label for="imagem">Imagem</label>
                <div style="width: 500px;">
                  <div id="preview-crop" class="cropme" style="width: 879px; height: 184px; margin auto"></div>
                  <small>Edite a imagem na Ferramenta Crop, clique aqui para editar a imagem.</small>
                  <input type="hidden" 
                         name="imagem" 
                         id="imagem" 
                         value="<?= if_exist($destaque['imagem']) ?>"/><br />
                </div>
            </div>
            <div>
                <label for="link">Link</label>
                <input class="text-input large-input"
                       id="link"
                       name="link"
                       maxlength="255"
                       value="<?= if_exist($destaque['link']) ?>"/>
                <br/><small>Digite ou cole no campo acima o link <strong>completo</strong> para o conteúdo.</small>
            </div>

            <?php if(isset($destaque['id'])) { ?>
                <a href="<?= site_url('uploads/destaques/'.$destaque['imagem']) ?>" target="_blank">
                  <img src="<?= site_url('uploads/destaques/'.$destaque['imagem']) ?>" style="width:100px;" />
                  <br />
                  Visualizar 
                </a>
            <?php } ?>
            <div class="continuar">
                <button type="submit"  class="button" id="btn_send" >Salvar</button>
            </div>
        </div>            
            
    <div id="form_cadastro_notification"></div>
</form>
<script type="text/javascript">
    $('#preview-crop').simpleCropper();
    $('#form-destaque').submit(function(){
        img     = $('#preview-crop').find('img');
        source  = img.attr('src');

        $('#imagem').val(source);

    })
</script>