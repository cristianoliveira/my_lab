<div class="content-box-header">
	<h3> Imagens do Produto </h3>
		<a class="produto button botao-cadastrar" href="listar.php">
			Finalizar
		</a>
    <div class="clear"></div>
</div>

<form id="form-produto" class="form-default" action="<?= $action_form ?>" method="post" enctype="multipart/form-data">    
    <fieldset>
        
        <input name="produto" type="hidden" value="<?= $idProduto ?>" />
                
        <div class="produto-galeria">
            <label>Upload de imagem</label>
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

        <div class="produto-galeria" style="float: left;">
        <?php 
            if(isset($listImagens)) { 
               foreach ($listImagens as $imagem) { 
        ?>
            <div class="produto-tumb-galeria">
               <img src="../uploads/produtos/<?= $value ?>" />
               <a   class="" href="../uploads/produtos/<?= $imagem['imagem'] ?>" target="_blank">
                  &raquo; Clique aqui para visualizar
               </a>
            </div>
        <?php
               }
            }
        ?>
        </div>
        
        
    </fieldset>
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