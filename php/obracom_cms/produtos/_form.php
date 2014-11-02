<form id="form-produto" class="form-default" action="<?= $action_form ?>" method="post" enctype="multipart/form-data">    
    <fieldset>
        
        <?php if(isset($produto['id'])) { ?>
            <input id="id" type="hidden" name="id" value="<?= $produto['id'] ?>">
            <a class="produto button botao-cadastrar" href="editar.php?galeria=1&id=<?= $produto['id'] ?>">
                Editar imagens
            </a>
        
            <input id="editar_galeria" type="hidden" name="editar_galeria" value="true">
       <?php }else{ ?>
            <input id="editar_galeria" type="hidden" name="editar_galeria" value="false">
       <?php } ?>
        
        <div>
            <label>Categoria</label>
            <select id="categoria" name="categoria_id" >
                <?php foreach ($listCategorias as $cat) { ?>
                    <option value="<?= $cat['id'] ?>" 
                        <?= $cat['id'] == if_exist($produto['categoria_id']) ? 'selected': ''; ?> />
                        <?= $cat['nome'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- <div>
            <label>Imagem Principal</label>
            <input id="imagem" class="text-input" name="imagem" type="file" />
        </div> -->

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
                    <input class="botao-remove" 
                           type="button" 
                           value="-" 
                          >
                </div>
                   
            </div>
            <div id="cor-painel">
                <?php 
                  $i = 0;
                  if(isset($listCores))
                     foreach($listCores as $cor) { 
                ?>
                    <input id="<?= "cor-$i" ?>" 
                            name="<?= "cor[$i]" ?>" 
                            class="cor-adicionada <?= "cor-adicionada-$i" ?> valid" 
                            type="text" 
                            maxlength="10" 
                            value="<?= $cor['cor'] ?>" 
                            readonly 
                            style="background-color: #<?= $cor['cor'] ?>;">
                
                  <!--    <input id="<?= "remove-$i" ?>" 
                            class="botao-remove <?= "cor-adicionada-$i" ?>" 
                            type="button" 
                            value="-" 
                            visibility="visible">   -->
                <?php  $i++;
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
                      rows="15"><?= if_exist($produto['descricao']) ?></textarea>
        </div>
        
        <div>
            <label>Valor Original</label>
            <input class="text-input small-input mascara-valor required"
                   type="text"
                   id="valor_original"
                   name="valor_original"
                   maxlength="255"
                   value="<?= if_exist($produto['valor_original']) ?>"/>
        </div>
        
        <div>
            <label>Valor Promocional</label>
            <input class="text-input small-input mascara-valor required"
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
                   value="1"
				   <?php if(if_exist($produto['oferta_imperdivel_home'],0)==1) echo "checked" ;   ?>
				   />
        </div>
        
        <div>
            <label for="disponivel">Disponível?</label>
            <input type="checkbox"
                   id="disponivel"
                   name="disponivel"
                   value="1"
				   <?php if(if_exist($produto['disponivel'],0)==1) echo "checked" ;   ?>
				   />
        </div>

        <div>
            <label for="ativo">Ativo?</label>
            <input type="checkbox"
                   id="ativo"
                   name="ativo"
                   value="1"
				   <?php if(if_exist($produto['ativo'],0)==1) echo "checked" ;   ?>
				   />
        </div>
        
        <div class="continuar">
            <button type="submit"  class="button" id="btn_send" >Salvar</button>
        </div>

</fieldset>
<div class="clear"></div>
<!-- End .clear -->
</form>

<div id="dialog-confirm" title="Galeria" hidden>
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;">
    </span>Deseja editar a galeria de imagens do produto?</p>
</div>

<script type="text/javascript">
    
    $('#form-produto').submit(function(){
        
        if(!$(this).valid())
          return false;

        doSubmit = $('#editar_galeria').val() != "false";
        if(!doSubmit){
            $( "#dialog-confirm" ).dialog({
                  resizable: false,
                  height:140,
                  modal: true,
                  buttons: {
                    "Sim": function() {
                      $('#editar_galeria').val("1");
                    
                      $('#form-produto').submit();
                      $( this ).dialog( "close" );
                    },
                    "Finalizar Cadastro": function() {
                      $('#editar_galeria').val("0");
                      
                      $('#form-produto').submit();
                      $( this ).dialog( "close" );
                    }
                  }
            });
        }
        
        return doSubmit;

    });    
    
    $("#adiciona-cor").click(function(){
        quantidade = $('.cor-adicionada').length
        document.getElementById('cor').color.hidePicker()
        
        novaCor = $('#cor').clone()
        novaCor.attr("id"    ,"cor-"+quantidade)
        novaCor.attr("name"  ,"cor["+quantidade+"]")
        novaCor.attr("class" ,"cor-adicionada cor-adicionada-"+quantidade)
        
        /*
        botaoRemove = $("#cor-button-modelo").clone(true,true);
        botaoRemove.attr("id"        ,"remove-"+quantidade)
        botaoRemove.attr("visibility","visible");
        botaoRemove.attr("class"     ,"cor-adicionada-"+quantidade)
        
        botaoRemove.appendTo('#cor-painel')*/
        novaCor.appendTo('#cor-painel')
    });

    $(".botao-remove").click(function(){
        ultimaCor = $('.cor-adicionada:last-child').attr("id");
        $('#'+ultimaCor).remove();
    });    

/* MASCARAS */
$(".mascara-data").mask("99/99/9999",{ placeholder: "dd/mm/yyyy"});
$(".mascara-valor").focusout(function(){
      valor = $(this).val();
      
      if(valor.indexOf(',')<0)
         valor = valor+",00";

      valor = valor.replace(/[^0-9]/gi,'');
      valor = valor.substring(0, valor.length-2)+","+valor.substring(valor.length-2);
      
      if(valor.length>3)
        $(this).val(valor);
      else
        $(this).val("");
        
});
$(".mascara-telefone").mask("(999)9999-9999");

jQuery.validator.addMethod("validaUnico", function(value, element)
{ 
    retorno = true;
    campo = element.id;
    valor = value;
    id    = $("#id").val();

    if(valor!="" && id==undefined){
      $.ajaxSetup({async: false});
      $.get( "validacao.php?campo="+campo+"&valor="+valor, function( data ) {
        if (data == "1")
        {
            retorno = false;
        }else{
            retorno = true; 
        }
      });
    }
   return retorno;  
}, "Valor já foi utilizado."); 

$(function(){
    $.validator.messages.required = 'Campo deve ser informado.';
});

$("#form-produto").validate({
      rules:
      {
          nome: { required: true },
          nome_seo: { required: true , validaUnico:true},
          codigo: { required: true , validaUnico:true},
          valor_original:           { required: true },         
          valor_promocional:        { required: true },
      },
});

</script>