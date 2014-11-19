$(document).ready(function()
{
	// Adiciona um prompt antes de cada "confirmação" no FatorCMS
	$('.item-confirmar').click(function()
	{
		return confirm($(this).attr('title')+'?');
	});

	// Todos os botões "voltar" fazem a mesma coisa
	$('.voltar').click(function()
	{
		history.go(-1);
	});

	//-----

	// Configurações padrões do plugin de validação
	$.validator.setDefaults({
		errorElement: 'span',
		errorClass: 'input-notification-error',
		errorPlacement: function(error, element)
		{
			// Se for um input radio, coloca a mensagem depois do último
			if (element.attr('type') === 'radio')
			{
				error.insertAfter(element.parent().children('span:last'));
			}
			else
			{
				// Se não for, coloca normalmente depois do input
				error.insertAfter(element);
			}
		}
	});
	
	// Validação do formulário de cadastro

	if ($("#cliente_form").length)
	{
		// Todas as máscaras do formulário
		$('#cpf, #responsavel_cpf').mask('999.999.999-99',{placeholder:' '});
		$('#cnpj').mask('99.999.999/9999-99',{placeholder:' '});
		$('#telefone_residencial').mask('(99) 9999-9999',{placeholder:' '});
		$('#telefone_comercial').mask('(99) 9999-9999',{placeholder:' '});
		$('#telefone_celular').mask('(99) 9999-9999',{placeholder:' '});
		$('#entrega_numero').mask('9?999999',{placeholder:' '});
		$('#entrega_estado').mask('aa',{placeholder:' '});
		$('#entrega_cep').mask('99999-999',{placeholder:' '});

		$("#nascimento").datepicker({showButtonPanel: true});

		$("#cliente_form").validate(
		{
			rules: {
				nome: 'required',
				email: {required:true, email:true},
				senha: {required: function(element) {return $(element).hasClass('required')}, minlength:6},
                cpf: {minlength: 14},
                cnpj: {minlength: 18},
                responsavel_cpf: {minlength: 14},
				ativo: 'required',
				entrega_endereco: {required: true},
                entrega_numero: {required: true, number:true},
				entrega_bairro: {required: true},
				entrega_cidade: {required: true},
				entrega_estado: {required: true, minlength:2},
				entrega_cep: {required: true, minlength:9}
			},
			messages: {
                nome: 'Obrigatório',
				email: {required:'Obrigatório', email:'Endereço de e-mail inválido'},
				senha: {required:'Obrigatória', minlength:'A senha deve conter no mínimo 6 caracteres'},
                cpf: {minlength:'Digite todos os números do CPF'},
                cnpj: {minlength:'Digite todos os números do CNPJ'},
				responsavel_cpf: {minlength:'Digite todos os números do CPF'},
				ativo : 'Obrigatório',
				entrega_endereco: {required:'Obrigatório'},
                entrega_numero: {required:'Obrigatório', number:'Digite somente números'},
				entrega_bairro: {required:'Obrigatório'},
				entrega_cidade: {required:'Obrigatório'},
				entrega_estado: {required:'Obrigatório', minlength:'Digite as duas letras da sigla do estado'},
				entrega_cep: {required:'Obrigatório', minlength:'Digite todos os números do CEP'}
			}
		});
	}

	//-----

	if ($("#enquete_form").length)
	{
		$("#enquete_form").validate(
		{
			messages: {
				pergunta: 'Obrigatória'
			}
		});
	}

	//-----

	if ($("#opcao_form").length)
	{
		// Máscaras do formulário
		$('#votos').mask('9?99999',{placeholder:''});

		$("#opcao_form").validate(
		{
			messages: {
				opcao: 'Obrigatório'
			}
		});
	}

	//-----

	if ($("#destaque_form").length)
	{
		$("#destaque_form").validate(
		{
			messages: {
		        titulo: 'Obrigatório',
				imagem: 'Obrigatória'
			}
		});
	}

	//-----

	if ($("#produto_form").length)
	{
		// autoSuggest para tags
		$('#tags').autoSuggest(
			SITE_URL+'/fatorcms/tags/ajax-buscar',
			{
				startText:'',
				emptyText:'Nenhuma tag encontrada',
				selectedItemProp:'nome',
				selectedValuesProp:'nome',
				searchObjProps:'nome',
				asHtmlID:'tags',
				neverSubmit:true,
				preFill:tags.itens
			}
		);


		$('a.apagar_imagem').click(function(e)
		{
	        e.preventDefault();

	        var resposta = confirm('Tem certeza que deseja excluir esta imagem?');

	        if (resposta)
	        {
	            var $this = $(this);
	            var $parent = $this.parent().parent();

	            var id = $(this).parent().siblings('input[name=id]').val();

	            $.ajax({
	                url: SITE_URL + '/fatorcms/produto/apagar-imagem/' + id,
	                type: 'GET',
	                success: function(data) {
	                    obj = eval('(' + data + ')');
	                    if (obj.resultado == 1) {
	                        $parent.hide('slow', function(){$parent.remove()});
	                    }
	                }
	            });
	        }
	    });

	    $('a.atualizar_imagem').click(function(e)
	    {
	        e.preventDefault();

	        var $this = $(this);
	        var $parent = $this.parent().parent();

	        var id = $(this).parent().siblings('input[name=id]').val();
	        var input = $(this).parent().siblings('input[name=titulo]');
	        var titulo = $(this).parent().siblings('input[name=titulo]').val();


	        $.ajax({
	            url: SITE_URL + '/fatorcms/produto/atualizar-imagem/' + id,
	            type: 'POST',
	            data: {'titulo' : titulo},
	            beforeSend: function()
	            {
	                $this.fadeOut(500, function()
	                {
	                    $this.text('Atualizando...').fadeIn(500).fadeOut(2000);
	                });
	            },

	            success: function(data) {
	                obj = eval('(' + data + ')');
	                if (obj.resultado == 1) {
	                    $this.fadeIn(2000, function()
	                    {
	                        $(input).animate({
	                            backgroundColor : '#D5FFCE'
	                        }, 2000);
	                        $(input).delay(2000).css('background', "url('/fatorcms/views/imagens/icones/tick_circle.png') no-repeat center right");
	                        $this.text('Atualizado!');
	                        $this.fadeOut(2000, function() {
	                            $this.text('Atualizar').fadeIn(250);
	                        });
	                        $(input).animate({
	                            backgroundColor : 'white'
	                        }, 2000);
	                        var t = setTimeout( function() { $(input).css('background', 'none'); $(input).css('background', 'none'); }, 10000);
	                    });
	                }
	            },
	            error: function(data) {
	                console.log(data);
	            }
	        });
	    });


		$('a.apagar_cor').click(function(e)
		{
	        e.preventDefault();

	        var resposta = confirm('Tem certeza que deseja excluir esta cor?');

	        if (resposta)
	        {
	            var $this = $(this);
	            var $parent = $this.parent().parent();

	            var id = $(this).parent().siblings('input[name=id]').val();

	            $.ajax({
	                url: SITE_URL + '/fatorcms/produto/apagar-cor/' + id,
	                type: 'GET',
	                success: function(data) {
	                    obj = eval('(' + data + ')');
	                    if (obj.resultado == 1) {
	                        $parent.hide('slow', function(){$parent.remove()});
	                    }
	                }
	            });
	        }
	    });

	    $('a.atualizar_cor').click(function(e)
	    {
	        e.preventDefault();

	        var $this = $(this);
	        var $parent = $this.parent().parent();

	        var id = $(this).parent().siblings('input[name=id]').val();
	        var input = $(this).parent().siblings('input[name=nome]');
	        var nome = $(this).parent().siblings('input[name=nome]').val();


	        $.ajax({
	            url: SITE_URL + '/fatorcms/produto/atualizar-cor/' + id,
	            type: 'POST',
	            data: {'nome' : nome},
	            beforeSend: function()
	            {
	                $this.fadeOut(500, function()
	                {
	                    $this.text('Atualizando...').fadeIn(500).fadeOut(2000);
	                });
	            },

	            success: function(data) {
	                obj = eval('(' + data + ')');
	                if (obj.resultado == 1) {
	                    $this.fadeIn(2000, function()
	                    {
	                        $(input).animate({
	                            backgroundColor : '#D5FFCE'
	                        }, 2000);
	                        $(input).delay(2000).css('background', "url('/fatorcms/views/imagens/icones/tick_circle.png') no-repeat center right");
	                        $this.text('Atualizado!');
	                        $this.fadeOut(2000, function() {
	                            $this.text('Atualizar').fadeIn(250);
	                        });
	                        $(input).animate({
	                            backgroundColor : 'white'
	                        }, 2000);
	                        var t = setTimeout( function() { $(input).css('background', 'none'); $(input).css('background', 'none'); }, 10000);
	                    });
	                }
	            },
	            error: function(data) {
	                console.log(data);
	            }
	        });
	    });


		// Máscaras do formulário
        $('#valor_original, #valor_promocional').priceFormat({prefix: 'R$ ',centsSeparator: ',', thousandsSeparator: '.'});

		$("#produto_form").validate(
		{
			rules: {
				nome: 'required',
				categoria_id: 'required',
				grupo_id: 'required',
				/*codigo: 'required',*/
                valor_original: 'required',
                largura: { required: true, numerico: true },
                altura: { required: true, numerico: true },
                comprimento: { required: true, numerico: true },
                peso: { required: true, numerico: true },
				/*estoque: 'required',*/
				descricao: 'required'
			},
			messages: {
                nome: 'Obrigatório',
				categoria_id: 'Obrigatória',
				/*grupo_id: 'Obrigatório',*/
				codigo: 'Obrigatório',
                valor_original: 'Obrigatório',
                largura: {required:'Obrigatória'},
                altura: {required:'Obrigatória'},
                comprimento: {required:'Obrigatório'},
                peso: {required:'Obrigatório'},
				/*estoque: 'Obrigatório',*/
				descricao: 'Obrigatória'
			},
			highlight: function(element, errorClass, validClass)
			{
				if($(element).attr('id') == 'descricao')
				{
					// jWYSIWYG - Coloca o erro na DIV pai do textarea
					//$('.campo-'+$(element).attr('id')+' .wysiwyg').addClass(errorClass).removeClass(validClass);
					// TinyMCE - Coloca o erro na TABLE do TinyMCE
					$('.campo-'+$(element).attr('id')+' .mceLayout').addClass(errorClass).removeClass(validClass);
				}
				else
				{
					// Os outros campos permanecem recebem a classe de erro diretamente
					$(element).addClass(errorClass).removeClass(validClass);
				}
			},
			unhighlight: function(element, errorClass, validClass)
			{
				if($(element).attr('id') == 'descricao')
				{
					// jWYSIWYG
					//$('.campo-'+$(element).attr('id')+' .wysiwyg').removeClass(errorClass).addClass(validClass);
					// TinyMCE
					$('.campo-'+$(element).attr('id')+' .mceLayout').removeClass(errorClass).addClass(validClass);
				}
				else
				{
					$(element).removeClass(errorClass).addClass(validClass);
				}
			}
			// TinyMCE
			,errorPlacement: function(error, element)
			{
				// position error label after generated textarea
				if (element.is("textarea"))
				{
					error.insertAfter(element.next());
				}
				else
				{
					error.insertAfter(element)
				}
			}
		});
	}

	//-----

	if ($('#usuario_form').length)
	{
        $('#usuario_form').validate(
		{
			rules: {
				nome: 'required',
				usuario: 'required',
				senha: {
					required: function(element) {return $(element).hasClass('required')},
                    minlength: 6
				}
			},
			messages: {
				nome: 'Obrigatório',
				usuario: 'Obrigatório',
                senha: {
					required: 'Obrigatória',
                    minlength: 'A senha deve ter no mínimo 6 caracteres'
				}
			}
        });
	}

	//-----

	// Limpa o valor do campo próximo ao link
	$('.input-limpar').click(function()
	{
		$(this).parent().siblings('input').val('');
		return false;
	})

	//-----

	// Funcionamento dos botões de cadastro nas listagens
	$('.produtos.lista .botao-cadastrar').click(function()
	{
		document.location.href = SITE_URL+'/fatorcms/produto/cadastrar';
	});
	$('.destaques.lista .botao-cadastrar').click(function()
	{
		document.location.href = SITE_URL+'/fatorcms/destaque/cadastrar';
	});
	$('.enquetes.lista .botao-cadastrar').click(function()
	{
		document.location.href = SITE_URL+'/fatorcms/enquete/cadastrar';
	});
	$('.enquete.form .botao-cadastrar').click(function()
	{
		document.location.href = SITE_URL+'/fatorcms/enquete-opcao/cadastrar/'+$(this).attr('id');
	});
    $('#cliente_form .botao-cadastrar').click(function()
    {
        document.location.href = SITE_URL+'/fatorcms/endereco/cadastrar';
    });
});

//----------

// Carrega o TinyMCE para as textareas especificadas pelos IDs

tinyMCE.init({
	mode : 'exact',
	elements : 'descricao',
	entity_encoding : 'raw',
	theme : 'advanced',
	width : '97.5%',
	height : '200px',
	language : 'br',
	plugins : 'searchreplace,contextmenu,paste',
	paste_auto_cleanup_on_paste : true,
	theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,pasteword,removeformat,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,code',
	theme_advanced_buttons2 : '',
	theme_advanced_buttons3 : '',
	theme_advanced_toolbar_location : 'top',
	theme_advanced_toolbar_align : 'center',
	theme_advanced_statusbar_location : 'none',
	theme_advanced_resizing : false,
	force_br_newlines : true,
	force_p_newlines : false,
	forced_root_block : '',
	onchange_callback: function(editor) {
		tinyMCE.triggerSave();
		var $editor = $("#" + editor.id);
		if ($editor.closest('form').data('validator').settings.onfocusout !== false)
		{
			$editor.valid();
		}
	}
});

//----------

// A partir do momento em as funções adicionais do Validator forem usadas, adicionar esta naquele arquivo
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

//-----

jQuery.validator.addMethod("numerico",function(value, element){
    var er = RegExp(/^([0-9]+)([\.,]{1}[0-9]+)?$/);
    return er.test(value);
},jQuery.validator.format('O valor deve ser numérico.'));


function textarea_contador_atualizar(limite, textarea, contador)
{
	var total = parseInt($(textarea).val().length);

	if (total > limite)
	{
		$(textarea).val($(textarea).val().substr(0,limite));
		total = limite;
	}

	$(contador).html(limite-total);
}