//Seletor de cores
    $('#cor-seletor-preview').click(function(){
        var seletor = $('#cor-seletor');
        seletor.click();
    });

    $('#cor-seletor').change(function(){
        var seletor = $(this);
        var preview = document.querySelector('#cor-seletor-preview');
        var reader  = new FileReader();

        var file    = seletor.prop('files');
        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(file[0])
        {
            reader.readAsDataURL(file[0]);
        }
        else
        {
            preview.src = "";
        }
    });