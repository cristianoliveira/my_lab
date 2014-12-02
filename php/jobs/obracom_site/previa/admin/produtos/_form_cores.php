
<?php include_once("../includes/functions.php") ?>
<form id="form-produto" class="form-default" action="<?= $action_form ?>" method="post" enctype="multipart/form-data">    
    <fieldset>
        
        <input name="produto" type="hidden" value="<?= $idProduto ?>" />
        <a class="produto button botao-cadastrar" href="listar.php">
            Finalizar
        </a>
        <a class="produto button botao-cadastrar" href="editar.php?id=<?= $idProduto ?>">
            Editar Produto
        </a>
        
        <div class="galeria-upload-form">
            <label>Upload de cor do produto.</label>
                <input id="imagem" class="text-input" name="imagem" type="hidden" />
            
            <div>
                <div id="preview-crop" class="cropme" style="width: 100px; height: 100px;"></div>
            </div>
            <div style="float: left;">
                <label for="nome">Nome da Cor</label>
                <input id="nome" class="text-input large-input" name="nome" type="text" />
                <input style="margin:10px 0;" class="button" type="submit" value="Enviar"/>
            </div>
        </div>
    </fieldset>
    <div class="galeria-thumbs" >
        <?php 
            if(isset($listCores)) { 
               foreach ($listCores as $cor) { 
        ?>
            <div class="galeria-thumb">
                <h5><?= $cor['titulo'] ?></h5>
                <img src="<?= site_url('uploads/produtos/'.$cor['imagem']); ?>" />
                <div>
                    <a class="button" 
                       style="width:80%; margin:5px 0" 
                       href="<?= site_url('uploads/produtos/'.$cor['imagem']); ?>" 
                       target="_blank">
                      Visualizar
                    </a>
                    <a class="button" style="width:80%; margin:5px 0" <?= 'href="acao.php?a=7&produto='.$produto['id'].'&id='.$cor['id'].'"' ?> >
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
    $('#preview-crop').simpleCropper(700,600);
    $('#form-produto').submit(function(){
        img     = $('#preview-crop').find('img');
        source  = img.attr('src');

        $('#imagem').val(source);

    })
</script>