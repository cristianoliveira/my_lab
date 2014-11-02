
<form id="form-produto" class="form-default" action="<?= $action_form ?>" method="post" enctype="multipart/form-data">    
    <fieldset>
        
        <input name="produto" type="hidden" value="<?= $idProduto ?>" />
        <a class="produto button botao-cadastrar" href="listar.php">
            Finalizar
        </a>
        
        <div class="galeria-upload-form">
            <label>Upload de imagem </label>
                <input id="imagem" class="text-input" name="imagem_produto" type="hidden" />
            
            <div>
                <div id="preview-crop" class="cropme" style="width: 500px; height: 350px; "></div>
            </div>
            <div style="float: left;">
                <label for="titulo">Titulo</label>
                <input id="titulo" class="text-input large-input" name="titulo" type="text" />
                <input style="margin:10px 0;" class="button" type="submit" value="Enviar"/>
            </div>
        </div>
    </fieldset>
    <div class="galeria-thumbs" >
        <?php 
            if(isset($listImagens)) { 
               foreach ($listImagens as $imagem) { 
        ?>
            <div class="galeria-thumb">
                <h5><?= $imagem['titulo'] ?></h5>
                <img src="<?= "http://$_SERVER[SERVER_NAME]" ?>/uploads/produtos/<?= $imagem['imagem'] ?>" />
                <div>
                    <a class="button" style="width:80%; margin:5px 0" href="<?= "http://$_SERVER[SERVER_NAME]" ?>/uploads/produtos/<?= $imagem['imagem'] ?>" target="_blank">
                      Visualizar
                    </a>
                    <a class="button" style="width:80%; margin:5px 0" <?= 'href="acao.php?a=5&produto='.$produto['id'].'&id='.$imagem['id'].'"' ?> >
                      Remover
                    </a>
                </div>
            </div>
            
        <?php
               }
            }
        ?>
        </div>
<div class="clear"></div>

<!-- End .clear -->
</form>
<script type="text/javascript">
    $('#preview-crop').simpleCropper();
    $('#form-produto').submit(function(){
        img     = $('#preview-crop').find('img');
        source  = img.attr('src');

        $('#imagem').val(source);

    })
</script>