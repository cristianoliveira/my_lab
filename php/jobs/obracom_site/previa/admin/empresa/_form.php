<form id="form-cliente" class="form-default" method="post" action="<?= $form_action ?>"  >
        
    <?php if(isset($empresa['id'])) { ?>
    <input type="hidden"  
            name="id" 
            value="<?= $empresa['id'] ?>" />
    <?php } ?>
        <div>
            <label>Slogan</label>
            <input class="text-input medium-input required"
               type="text"
               id="slogan"
               name="slogan"
               maxlength="255"
               value="<?= if_exist($empresa['slogan']) ?>"/>
            <br />
        </div>
        <div>
            <label>Descrição</label>
            <textarea class="text-input textarea" 
                  id="descricao" 
                  name="descricao" 
                  cols="79" 
                  rows="15"><?= if_exist($empresa['descricao']) ?></textarea>
        </div>
        <div class="continuar">
            <button type="submit"  class="button" id="btn_send" >Salvar</button>
        </div>
            
    <div id="form_cadastro_notification"></div>
</form>
