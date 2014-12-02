$(document).ready(function()
{
    $("#data, #data_inicial, #data_final").datepicker({showButtonPanel: true});
	$("#data, #data_inicial, #data_final").mask('99/99/9999', {placeholder: ' '});
	
	// Adiciona um prompt antes de cada "confirmação"no FatorCMS
	$('.item-confirmar').click(function()
	{
		return confirm($(this).attr('title')+'?');
	});
	
    //---

	$.validator.setDefaults({
		errorElement: 'span',
		errorClass: 'input-notification-error'
	});
    //---
	// Validação do formulário de cadastro

    $("#usuario_form").validate(
    {
        rules:
        {
            email:{required:true , email:true}
        },
        messages: {
            nome:   'Obrigatório',
            usuario:'Obrigatório',
            senha:  'Obrigatória',
            email:  {required:'Obrigatório', email:'Digite um email válido.'}
        }
    });
    //----
	
	

    $("#galeria_form").validate(
    {
        messages: {
            codigo:   'Obrigatório',
            nome: 'Obrigatório'
        }
    });
    //----

    $("#destaque_form").validate(
    {
        rules:{
            link:{required:true}
        },
        messages:{
            titulo:'Obrigatório',
            descricao_destaque: 'Obrigatória',
            link:'Obrigatório',
            imagem: 'Obrigatória'
        }
    });
	//---

    $("#promocao_form").validate(
        {
            rules:{
                link:{required:true}
            },
            messages:{
                titulo:'Obrigatório',
                descricao_promocao: 'Obrigatória',
                link:'Obrigatório',
                imagem: 'Obrigatória'
            }
        });
        //---

	// Funcionamento dos botões de cadastro nas listagens

	$('.destaques .botao-cadastrar').click(function()
	{
		document.location = SITE_URL+'/fatorcms/destaque';
	});
    $('.plantas .botao-cadastrar').click(function()
	{
		document.location = SITE_URL+'/fatorcms/planta';
	});
    $('.projetos .botao-cadastrar').click(function()
	{
		document.location = SITE_URL+'/fatorcms/projeto';
	});
    $('.trabalhos .botao-cadastrar').click(function()
	{
		document.location = SITE_URL+'/fatorcms/trabalho';
	});
    $('.promocoes .botao-cadastrar').click(function()
	{
		document.location = SITE_URL+'/fatorcms/promocao';
	});

    //----------

    $('#cep').mask("99999-999");
    $('#telefone').mask("(99) 9999-9999");
});

//----------
// Initialise TinyMCE for all textareas
/*tinyMCE.init({
	mode : 'exact',
	elements : 'descricao,completa,diferencial,objetivos,conteudos,duracao,conteudo,pre_requisitos,horarios,estagio_obrigatorio,area_atuacao,convenios',
	entity_encoding : 'raw',
	theme : 'advanced',
	width : '97.5%',
	height : '350px',
	language : 'br',
	plugins : 'searchreplace,contextmenu,paste,filemanager,imagemanager',
	paste_auto_cleanup_on_paste : true,
	theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,pasteword,removeformat,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,code',
	theme_advanced_buttons2 : '',
	theme_advanced_buttons3 : '',
	theme_advanced_toolbar_location : 'top',
	theme_advanced_toolbar_align : 'center',
	theme_advanced_statusbar_location : 'none',
	theme_advanced_resizing : false,
	relative_urls : false,
    remove_script_host : false,
	onchange_callback: function(editor) {
		tinyMCE.triggerSave();
		var $editor = $("#"+ editor.id);
		if ($editor.closest('form').data('validator').settings.onfocusout !== false)
		{
			$editor.valid();
		}
	}
});*/


//----------

jQuery.validator.addMethod("dateBR", function(value, element)
{
	//contando chars
	if(value.length!=10) return false;
	// verificando data
	var data 		= value;
	var dia 		= data.substr(0,2);
	var barra1		= data.substr(2,1);
	var mes 		= data.substr(3,2);
	var barra2		= data.substr(5,1);
	var ano 		= data.substr(6,4);
	if(data.length!=10||barra1!="/"||barra2!="/"||isNaN(dia)||isNaN(mes)||isNaN(ano)||dia>31||mes>12)return false;
	if((mes==4||mes==6||mes==9||mes==11)&&dia==31)return false;
	if(mes==2 && (dia>29||(dia==29&&ano%4!=0)))return false;
	if(ano < 1900)return false;
	return true;
}, "Informe uma data válida.");  // Mensagem padrão
