<form id="form-produto" class="form-default" action="<?= $action_form ?>" method="post" enctype="multipart/form-data">    
    <fieldset>
        
        <div>
            <label>Categoria</label>
            <select id="categoria" name="categoria" >
                <?php foreach ($listCategorias as $cat) { ?>
                    <option value="<?= $cat['id'] ?>" 
					    <?= $cat['id'] == if_exist($produto['categoria_id']) ? 'selected': ''; ?> />
                        <?= $cat['nome'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div>
            <label>Imagem Principal</label>
            <input id="imagem" class="text-input" name="imagem" type="file" />
        </div>

        <div id="cores">
            <div>
                <label>Cores</label>
				<div>
				Clique para selecionar
					<input id="cor"
                           class="cor-seletor color"
                           type="text"
                           maxlength="10"
						   readonly
						   />
                    <input id="adiciona-cor" 
                           type="button" 
                           value="+" 
                          >
                    <input id="cor-button-modelo"
                           class="botao-remove" 
                           type="button" 
                           value="-" 
                          >
				</div>
                   
            </div>
			<div id="cor-painel">
				<?php 
				  $i = 0;
				  if(isset($coresProduto))
					 foreach($coresProduto as $cor) { 
				?>
					<input id="<?= "cor[$i]" ?>" 
							name="<?= "cor[$i]" ?>" 
							class="cor-adicionada <?= "cor-adicionada-$i" ?> valid" 
							type="text" 
							maxlength="10" 
							value="" 
							readonly 
							style="background-color: <?= $cor ?>;">
				<?php 
						$i++;
					 } 
			    ?>
			</div>
        </div>


        <div>
            <label>Nome</label>
            <input class="text-input medium-input required"
                   type="text"
                   id="nome"
                   name="nome"
                   maxlength="255"
                   value="<?= if_exist($produto['nome']) ?>"/>
        </div>

		<div>
            <label>Nome Seo</label>
            <input class="text-input medium-input required"
                   type="text"
                   id="nome_seo"
                   name="nome_seo"
                   maxlength="255"
                   value="<?= if_exist($produto['nome_seo']) ?>"/>
        </div>
		
		<div>
            <label>Código</label>
            <input class="text-input small-input required"
                   type="text"
                   id="codigo"
                   name="codigo"
                   maxlength="255"
                   value="<?= if_exist($produto['codigo']) ?>"/>
        </div>
		
		<div>
            <label>Resumo</label>
            <input class="text-input medium-input required"
                   type="text"
                   id="resumo"
                   name="resumo"
                   maxlength="255"
                   value="<?= if_exist($produto['resumo']) ?>"/>
        </div>

		<div>
            <label>Descrição</label>
		    <textarea class="text-input textarea" 
			          id="descricao" 
					  name="descricao" 
					  cols="79" 
					  rows="15">
				<?= if_exist($produto['descricao']) ?>
			</textarea>
        </div>
		
		<div>
            <label>Valor Original</label>
            <input class="text-input small-input required"
                   type="text"
                   id="valor_original"
                   name="valor_original"
                   maxlength="255"
                   value="<?= if_exist($produto['valor_original']) ?>"/>
        </div>
		
		<div>
            <label>Valor Promocional</label>
            <input class="text-input small-input required"
                   type="text"
                   id="valor_promocional"
                   name="valor_promocional"
                   maxlength="255"
                   value="<?= if_exist($produto['valor_promocional']) ?>"/>
        </div>
		
		<div>
            <label for="oferta_imperdivel_home">Oferta Imperdível?</label>
            <input type="checkbox"
                   id="oferta_imperdivel_home"
                   name="oferta_imperdivel_home"
                   value="<?= if_exist($produto['oferta_imperdivel_home']) ?>"/>
        </div>
		
        <?php  if (isset($produto['image_name1'])) { ?>

        <p>
            <label for="imagem">Imagem Atual</label>
            <a id="example1" href="../uploads/produtos/<?php  echo $produto['image_name1']; ?>" target="_blank">&raquo; Clique aqui para visualizar</a>
            <br />

        </p>
        <?php  } ?>


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
        document.getElementById('cor').color.hidePicker()
        
        novaCor = $('#cor').clone()
        novaCor.attr("id"    ,"cor["+quantidade+"]")
        novaCor.attr("name"  ,"cor["+quantidade+"]")
        novaCor.attr("class" ,"cor-adicionada cor-adicionada-"+quantidade)
        
        botaoRemove = $("#cor-button-modelo").clone(true,true);
        botaoRemove.attr("id"        ,"remove-"+quantidade)
        botaoRemove.attr("visibility","visible");
	    botaoRemove.attr("class"     ,"cor-adicionada-"+quantidade)
        
        novaCor.appendTo('#cor-painel')
        botaoRemove.appendTo('#cor-painel')
    });

    $(".botao-remove").click(function(){
            valor = $(this).attr("id").split('-')
            cor   = valor[1]

            $(".cor-adicionada-"+cor).remove();
    });    
   
</script>