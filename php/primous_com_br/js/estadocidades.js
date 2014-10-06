$(function(){

    $("select[name=estado]").change(function(){

        estado = $(this).val();

        if ( estado === '')
            return false;

        resetaCombo('cidade');

        $.getJSON('../ajax/cidades/'+ estado, function (data){

            var option = new Array();

            $.each(data, function(i, obj){

                option[i] = document.createElement('option');
                $( option[i] ).attr( {value : obj.id} );
                $( option[i] ).append( obj.nome );

                $("select[name='cidade']").append( option[i] );

            });

        });

    });

});

function resetaCombo( el ) {
   $("select[name='"+el+"']").empty();
   var option = document.createElement('option');
   $( option ).attr( {value : ''} );
   $( option ).append( 'Escolha' );
   $("select[name='"+el+"']").append( option );
}

