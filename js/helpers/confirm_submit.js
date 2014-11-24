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