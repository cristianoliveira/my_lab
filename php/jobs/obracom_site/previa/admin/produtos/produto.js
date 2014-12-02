  
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
    
    //Seletor de cores
    adicionaCor = function()
    {

        div        = $('<div></div>');
        div.attr("class","cores");
        quantidade = $('.cor-image-adicionada').length;
       // document.getElementById('cor').color.hidePicker()
        
        novaCor    = $('#cor-seletor-preview').clone();
        novaCor.attr("id"    ,"cor-preview-"+quantidade);
        //novaCor.attr("name"  ,"cor["+quantidade+"]");
        novaCor.attr("class" ,"cor-image-adicionada");
        novaCor.show();
        
        novaCorInput = $('#cor-seletor').clone();
        novaCorInput.attr("id"    ,"cor-"+quantidade);
        novaCorInput.attr("name"  ,"cor["+quantidade+"]['imagem']");
        novaCorInput.attr("class" ,"cor-input-adicionada");
        novaCorInput.hide();

        novaCorNome = $('#cor-nome').clone();
        novaCorNome.attr("id"    ,"cor-nome-"+quantidade);
        novaCorNome.attr("name"  ,"cor["+quantidade+"]['nome']");
        novaCorNome.attr("class" ,"cor-input-adicionada cor-input-nome");
        novaCorNome.show();

        labelForNome = $('<label>Nome da cor</label>');
        labelForNome.attr('for',"cor["+quantidade+"]['nome']");


        novaCor.appendTo(div);
        novaCorInput.appendTo(div);
        labelForNome.appendTo(div);
        novaCorNome.appendTo(div);

        div.appendTo('#cor-painel');
    };

    $('#cor-seletor').change(function(){
        var seletor = $(this);
        
        if(seletor.val()!="")
        {
            var preview = document.querySelector('#cor-seletor-preview');
            var reader  = new FileReader();

            var file    = seletor.prop('files');
            reader.onloadend = function(){
                preview.src = reader.result;
                adicionaCor();
                seletor.val("");
            }

            if(file[0])
            {
                reader.readAsDataURL(file[0]);
            }
            else
            {
                preview.src = "";
            }
        }
    });

    $("#adiciona-cor").click(function(){
        var seletor = $('#cor-seletor');
        seletor.click();

    });

    $(".botao-remove").click(function(){
        lastCorImage = $('.cor-image-adicionada').last();
        lastCorImage.remove();
        
        lastCorInput = $('.cor-input-adicionada').last();
        lastCorInput.remove();
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