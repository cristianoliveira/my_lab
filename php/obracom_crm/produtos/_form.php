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
                          type="button" 
                          value="-" 
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
        <label for="cod_cidades">Sub-categoria</label>
        <select name="cod_cidades" id="cod_cidades">
            <!--option value="">-- Escolha uma subcategoria --</option -->
            <?php  
            while($row2 = mysql_fetch_array($sql_pegaCategoria2)){ ?>
            <option value="<?php  echo $row2['idsubcategorias'] ?>" <?php  if ($row2['idsubcategorias'] == $manda['subcategoria_id']) { echo 'selected="selected"'; } ?>><?php  echo $row2['nome_subcategoria']; ?>
            </option><?php  } ?>

        </select>


    </p>

    <p>
        <label>Descrição </label>
        <textarea class="text-input textarea" id="descricao" name="descricao" cols="79" rows="15"><?php  echo $manda['descricao_produto']; ?></textarea>
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
    $("#adiciona-cor").click(function(){
        quantidade = $('.cor-adicionada').length
        novaCor = $('#cor').clone()
        document.getElementById('cor').color.hidePicker()
        novaCor.attr("name"  ,"cor["+quantidade+"]")
        novaCor.attr("class" ,"cor-adicionada")
        novaCor.appendTo('#cores')
    });

    $("#remove-cor").click(function(){
        cor  = $(":focus")
        clas = cor.attr('class')
        if(clas==".cor-adicionada"){
            cor.remove();
        }
    });

   
</script>