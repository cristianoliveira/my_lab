<form id="form-produto" class="form-default" action="<?= $action_form ?>" method="post" enctype="multipart/form-data">    
    <fieldset>
        
        <div>
            <label>Categoria</label>
            <select id="categoria" name="categoria" >
                <?php foreach ($listCategorias as $cat) { ?>
                    <option value="<?= $cat['idcategorias'] ?>" <?= $cat['idcategorias'] == $produto['categoria_id'] ? 'selected': ''; ?> />
                        <?= $cat['nome_categoria'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div>
            <label>Imagem Principal</label>
            <input id="imagem_principal" class="text-input" name="imagem_principal" type="file" />
        </div>

        <div id="cores">
            <div>
                <label>Cores 
                   <input id="cor"
                           name="modelo"
                           class="seletor-cor color"
                           type="text"
                           maxlength="10"
                           value="<?= $produto['nome_produto'] ?>"/>
                   <input id="adiciona-cor" 
                          type="button" 
                          value="+" 
                          >
                   <input id="remove-cor"
                          class="botao-remove" 
                          type="button" 
                          value="-"
                          visibility="false" 
                          >
                </label>
            </div>
        </div>


        <div>
            <label>Nome</label>
            <input class="text-input medium-input required"
                   type="text"
                   id="nome"
                   name="nome"
                   maxlength="255"
                   value="<?= $produto['nome_produto'] ?>"/>
        </div>




        <?php  if (isset($produto['image_name1'])) { ?>

        <p>
            <label for="imagem">Imagem Atual</label>
            <a id="example1" href="../uploads/produtos/<?php  echo $produto['image_name1']; ?>" target="_blank">&raquo; Clique aqui para visualizar</a>
            <br />

        </p>
        <?php  } ?>

        <p>
            <label for="imagem">Novo Arquivo </label>
            <input class="text-input" type="file" name="imagemnova" id="imagemnova" /><br />
            <small>Edite a imagem na Ferramenta Crop, <a href="../crop/index.php">clique aqui para editar a imagem.</a></small></p>

            <p class="required-input">
                <label for="cod_estados">Categoria</label>
                <select name="cod_estados" id="cod_estados">
                    <?php  
                    while($row = mysql_fetch_array($sql_pegaCategoria)){ ?>
                    <option value="<?php  echo $row['idcategorias'] ?>" <?php  if ($row['idcategorias'] == $manda['categoria_id']) { echo 'selected="selected"'; } ?>><?php  echo $row['nome_categoria']; ?>
                    </option><?php  } ?>


                </select>
            </td>
        </tr>
    </p>

    <p>
        <input class="button"type="submit"value="<?= $acao ?>"/>
    </p>
</fieldset>
<div class="clear"></div>
<!-- End .clear -->
</form>
<script type="text/javascript">
    $("#form-produto").validate({
        rules: {
                imagem_principal: {
                    imagemTypeValidate: true,
                },
            },
    });

    removeCor = function(e){
        $(".botao-remove").click(function(){
            valor = $(this).id
            cor   = valor[1]

            $("#".cor).remove();
            $(this).remove();
        })
    }

    $("#adiciona-cor").click(function(){
        quantidade = $('.cor-adicionada').length
        document.getElementById('cor').color.hidePicker()
        
        novaCor = $('#cor').clone()
        novaCor.attr("id"    ,"cor["+quantidade+"]")
        novaCor.attr("name"  ,"cor["+quantidade+"]")
        novaCor.attr("class" ,"cor-adicionada")
        
        botaoRemove = $("#remove-cor").clone(true,true);
        botaoRemove.attr("id"    ,"remove-cor["+quantidade+"]")
        botaoRemove.attr("visibility","true");

        novaCor.appendTo('#cores')
        botaoRemove.appendTo('#cores')
    });

    $(".botao-remove").click(function(){
            valor = $(this).attr("id").split('-')
            cor   = valor[1]

            $("#".cor).remove();
            $(valor).remove();
    });    
   
</script>