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
			    <h3>Adicionar Opções</h3>
                <label>Texto</label>
                <input type="text" 
                       class="opcao text-input large-input required" 
                       id="opcao"  />
			          <button id="enquete-botao-adicionar" type="button" >Adicionar</button>
                <button id="enquete-botao-remover"   type="button" >Remover</button>
            </div>
			
			<div id="enquete-opcoes">
        <?php 
          if(isset($listOpcoes))
          {
              $i = 0;
              foreach ($listOpcoes as $opcao) { ?>
                  <input type="text" 
                        class="opcao-adicionada opcao-adicionada-<?= $opcao['id'] ?> text-input medium-input" 
                        id="opcao-<?= $i ?>" 
                        name="opcao[<?= $i ?>][opcao]" 
                        value="<?= $opcao['opcao'] ?>"
                        readonly
                  />
                  <input type="hidden" 
                        class="opcao-adicionada opcao-adicionada-<?= $opcao['id'] ?> text-input medium-input" 
                        id="opcao-<?= $i ?>" 
                        name="opcao[<?= $i ?>][enquete_id]" 
                        value="<?= $opcao['enquete_id'] ?>"
                  />
                  <input type="hidden" 
                        class="opcao-adicionada opcao-adicionada-<?= $opcao['id'] ?> text-input medium-input" 
                        id="opcao-<?= $i ?>" 
                        name="opcao[<?= $i ?>][id]" 
                        value="<?= $opcao['id'] ?>"
                  />
                 <button id="<?= $opcao['id'] ?>" class="botao-remover-opcao botao-remover-opcao-<?= $opcao['id'] ?>" type="button">Remover</button>
           
        <?php 
                $i++;
              } 
          }
           ?>
			</div>
			
            <div class="continuar">
                <button type="submit"  class="button" id="btn_send" >Salvar</button>
            </div>
        </div>            
            
    <div id="form_cadastro_notification"></div>
</form>
<script>
	$("#enquete-botao-adicionar").click(function(){
        quantidade = $('.opcao-adicionada').length;
        
		    nova = $('#opcao').clone();
        nova.attr("id"    ,"opcao-adicionada-"+quantidade);
        nova.attr("name"  ,"opcao["+quantidade+"][opcao]");
        nova.attr("class" ,"opcao-adicionada opcao-adicionada-"+quantidade+" text-input large-input");
        
        // botaoRemove = $("#enquete-botao-adicionar").clone(true,true);
        // botaoRemove.attr("id"        ,"remove-"+quantidade)
        // botaoRemove.attr("visibility","visible");
        // botaoRemove.attr("class"     ,"opcao-adicionada-"+quantidade)
        // botaoRemove.val("-")
		
        nova.appendTo('#enquete-opcoes');
        // botaoRemove.appendTo('#enquete-opcoes')
    });

    $('#enquete-botao-remover').click(function(){
        $('.opcao-adicionada:last-child').remove();
    });

    $('.botao-remover-opcao').click(function(){
        if(confirm("Deseja remover este item?"))
        {
            id = (this).id;
            $.get( "ajax.php?acao=delete_opcao&idopcao="+id, function( data ) {
                if (data == "1")
                {
                    $(".opcao-adicionada-"+id).remove();
                    $(".botao-remover-opcao-"+id).remove();
                }else{
                    alert('Não foi possível remover esta opção.');
                }
            });
        }
    });

</script>