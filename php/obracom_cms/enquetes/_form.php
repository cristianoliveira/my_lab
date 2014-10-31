<form id="form-enquetes" class="form-default" method="post" action="<?= $form_action ?>"  >
        
    <?php if(isset($enquete['id'])) { ?>
    <input type="hidden"  
            name="id" 
            value="<?= $enquete['id'] ?>"
    />
    <?php } ?>
        
        <div>
            <div>
                <label>Pergunta</label>
                <input type="text" 
                       class="text-input large-input required" 
                       id="pergunta" 
                       name="pergunta" 
                       value="<?= if_exist($enquete['pergunta']) ?>" 
                />
            </div>
            <div>
                <label>Pergunta Seo</label>
                <input type="text" 
                       class="text-input large-input required" 
                       id="pergunta_seo" 
                       name="pergunta_seo" 
                       value="<?= if_exist($enquete['pergunta_seo']) ?>" 
                />
            </div>
            <div>
                <label>Ativo</label>
                <input type="checkbox" 
                       class="checkbox" 
                       id="ativa" 
                       name="ativa" 
                       value="1"
                       <?= (if_exist($enquete['ativa'],0) == 1)? "checked":""; ?>
                />
            </div>
			
			<div>
			    <h3>Adicionar Opições</h3>
                <label>Texto</label>
                <input type="text" 
                       class="opicao text-input large-input required" 
                       id="opicao"  />
			          <button id="enquete-botao-adicionar" type="button" >Adicionar</button>
                <button id="enquete-botao-remover"   type="button" >Remover</button>
            </div>
			
			<div id="enquete-opcoes">
			</div>
			
            <div class="continuar">
                <button type="submit"><?= $acao ?></button>
            </div>
        </div>            
            
    <div id="form_cadastro_notification"></div>
</form>
<script>
	$("#enquete-botao-adicionar").click(function(){
        quantidade = $('.opicao').length;
        
		    novaCor = $('#opicao').clone();
        novaCor.attr("id"    ,"opicao["+quantidade+"]");
        novaCor.attr("name"  ,"opicao["+quantidade+"]");
        novaCor.attr("class" ,"opicao-adicionada opicao-adicionada-"+quantidade+" text-input large-input");
        
        // botaoRemove = $("#enquete-botao-adicionar").clone(true,true);
        // botaoRemove.attr("id"        ,"remove-"+quantidade)
        // botaoRemove.attr("visibility","visible");
        // botaoRemove.attr("class"     ,"opicao-adicionada-"+quantidade)
        // botaoRemove.val("-")
		
        novaCor.appendTo('#enquete-opcoes');
        // botaoRemove.appendTo('#enquete-opcoes')
    });

    $('#enquete-botao-remover').click(function(){
        ultimo = $('.opicao-adicionada').length - 1;
        $("#opicao["+ultimo+"]").remove();
    });

    

</script>