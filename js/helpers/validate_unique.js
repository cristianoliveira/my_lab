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