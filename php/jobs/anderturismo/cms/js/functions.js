$(document).ready(function()
{
	
	
		// Validação do formulário de Hotéis
		/*
nome
nivel
imagem
descricao
*/		
 $('.tooltip').tooltipster();


function removeCampo() {

	$("#removerCampo").click(function(){
	  $("#paises:last").remove();
	  i--;
  	});
  }
 
  $("#addPais").click(function () {  
	novoCampo = $("#paises:first").clone();
	novoCampo.find("select").val("");
	novoCampo.insertAfter("#paises:last");
	removeCampo();	
  });	
	
	
	
	// Adiciona um prompt antes de cada "confirmação"no OBRACMS
	$('.item-confirm').click(function()
	{
		return confirm($(this).attr('title')+'?');
	});
	
	
			$('#cod_estados').change(function(){
				if( $(this).val() ) {
					$('#cod_cidades').hide();
					$('.carregando').show();
					$.getJSON('subcategorias.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value=""></option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
						}	
						
						$('#cod_cidades').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#cod_cidades').html('<option value="">-- Escolha uma subcategoria --</option>');
				}
			})


	//-----

	// Marcar uma compra como utilizada, ou desfazer isso
	$('.compra_utilizar').click(function()
	{
		var id = $(this).attr('id');

		$(this).removeClass('sim nao').html('Aguarde...');

		$.post(
			$(this).attr('href'),
			{},
			function (data)
			{
				$('#'+id).html(data.conteudo);
				$('#'+id).addClass(data.class);
			},
			'json'
		);
		return false;
	});

	//-----

	jQuery.validator.setDefaults({
		errorElement: 'span',
		errorClass: 'input-notification-error'
	});
	
	// Validação do formulário de Categorias
	if ($('#frmCategorias').length)
	{
		$("#frmCategorias").validate(
		{
			rules: {
				nome           : 'required',
				imagem         : 'required',
				codigo         : 'required',
				dormitorios    : 'required',
				area_privativa : 'required'
			},
			messages: {
				nome           : 'obrigatório',
				imagem         : 'obrigatório',
				codigo         : 'obrigatório',
				dormitorios    : 'obrigatório',
				area_privativa : 'obrigatório'
			}
		});
	}
	
		// Validação do formulário de Categorias
	if ($('#frmCategorias').length)
	{
		$("#frmCategorias").validate(
		{
			rules: {
				nome: 'required'
			},
			messages: {
				nome: 'obrigatório'
			}
		});
	}
	
	
	
		if ($('#roteiros_form').length)
	{
		
		var dates = $( "#data_inicio, #data_fim" ).datepicker({
		dateFormat: 'dd/mm/yy',
		defaultDate: "+1w",
		changeMonth: true,
		onSelect: function( selectedDate ) {
			var option = this.id == "data_inicio" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});
	
	
		$("#data_inicio").datepicker({showButtonPanel: true});
		$("#data_fim").datepicker({showButtonPanel: true});
		
		$("#roteiros_form").validate(
		{
						rules: {
				nome: 'required',

				
data_inicio: {
					required: true,
					dateBR: true,
					dateRange: true,
                bothEmpty: true
				},
				
				data_fim: {
					required: true,
					dateBR: true,
					dateRange: true,
                bothEmpty: true
				},
							

				imagem: 'required',
				titulo_completo: 'required',
				datas_completas: 'required',
				status_roteiro: 'required',
				descricao: 'required',
			
				
			},
			messages: {
				
				nome: 'obrigatório',
				
				data_inicio: {
					required: 'obrigatória',
					dateBR: 'data em formato inválido'
				},
				data_fim: {
					required: 'obrigatória',
					dateBR: 'data em formato inválido'
				},
				imagem: 'obrigatório',
				imagem: 'obrigatório',
				titulo_completo: 'obrigatório',
				datas_completas: 'obrigatório',
				status_roteiro: 'obrigatório',
				descricao: 'obrigatório'
				
			}
		});
	}
	
	
	
	
	
		if ($('#hoteis_form').length)
	{
		$("#hoteis_form").validate(
		{
						rules: {
				nome: 'required',
				nivel: 'required',
				imagem: 'required',
				descricao: 'required'
			},
			messages: {
				nome: 'obrigatório',
				nivel: 'obrigatório',
				imagem: 'obrigatório',
				descricao: 'obrigatório'
			}
		});
	}
	
		// Validação do formulário de Categorias 1
	if ($('#galeria_noticias_form').length)
	{
		$("#galeria_noticias_form").validate(
		{
			rules: {
				imagemnova1: 'required',
				imagemnova2: 'required',
				imagemnova3: 'required',
				imagemnova4: 'required',
				imagemnova5: 'required'
			},
			messages: {
				imagemnova1: 'obrigatório',
				imagemnova2: 'obrigatório',
				imagemnova3: 'obrigatório',
				imagemnova4: 'obrigatório',
				imagemnova5: 'obrigatório'
			}
		});
	}
	
	// Validação do formulário de Categorias 2
	if ($('#galeria_categorias_form').length)
	{
		$("#galeria_categorias_form").validate(
		{
			rules: {
				imagemnova1: 'required',
				imagemnova2: 'required',
				imagemnova3: 'required',
				imagemnova4: 'required',
				imagemnova5: 'required'
			},
			messages: {
				imagemnova1: 'obrigatório',
				imagemnova2: 'obrigatório',
				imagemnova3: 'obrigatório',
				imagemnova4: 'obrigatório',
				imagemnova5: 'obrigatório'
			}
		});
	}
	
	
		// Validação do formulário de Relações Roteiros
	if ($('#relacoes_form').length)
	{
		$("#relacoes_form").validate(
		{
			rules: {
				hotel1: 'required',
				hotel2: 'required'
			},
			messages: {
				hotel1: 'obrigatório',
				hotel2: 'obrigatório'
			}
		});
	}
	
	// Validação do formulário de Capas Roteiros
	if ($('#capas_form').length)
	{
		$("#capas_form").validate(
		{
			rules: {
				nome: 'required',
				imagem: 'required'
			},
			messages: {
				nome: 'obrigatório',
				imagem: 'obrigatório'
			}
		});
	}	
	
	// Validação do formulário de Banners
	if ($('#banners_form').length)
	{
		$("#banners_form").validate(
		{
			rules: {
				nome: 'required',
				imagem: 'required',
				categoria: 'required'
			},
			messages: {
				nome: 'obrigatório',
				imagem: 'obrigatório',
				categoria: 'obrigatório'
			}
		});
	}
	
		if ($('#cervejas_form').length)
	{
		$("#cervejas_form").validate(
		{
			rules: {
				nome: 'required',
				tipo: 'required',
				fabricas: 'required',
				pais: 'required',
				qtde: 'required',
				imagem: 'required'
			},
			messages: {
				nome: 'obrigatório',
				tipo: 'obrigatório',
				fabricas: 'obrigatório',
				pais: 'obrigatório',
				qtde: 'obrigatório',
				imagem: 'obrigatório'
			}
		});
	}

		// Validação do formulário de Apartamentos
	if ($('#aptos_form').length)
	{
		$("#aptos_form").validate(
		{
			rules: {
				nome: 'required'
			},
			messages: {
				nome: 'obrigatório',
			}
		});
	}

		// Validação do formulário de Usuário
	if ($('#tabelaprecos_form').length)
	{
		
		// Formatação para os valores
		$('#valor').priceFormat(
		{
			prefix: '',
			centsSeparator: ',',
			thousandsSeparator: ''
		});
		
		
		$("#usuarios_form").validate(
		{
			rules: {
				conta: 'required',
				senha: 'required'
			},
			messages: {
				conta: 'obrigatório',
				senha: 'obrigatório'
			}
		});
	}
	


	
		// Validação do formulário de Usuário
	if ($('#usuarios_form').length)
	{
			
		
		$("#usuarios_form").validate(
		{
			rules: {
				conta: 'required',
				senha: 'required'
			},
			messages: {
				conta: 'obrigatório',
				senha: 'obrigatório'
			}
		});
	}
	
	
		// Validação do formulário de News
	if ($('#news_form').length)
	{
		$("#news_form").validate(
		{
			rules: {
				videodestaque: 'required',
			},
			messages: {
				videodestaque: 'obrigatório',
			}
		});
	}





	// Validação do formulário de Produtos
	if ($('#produtos_form').length)
	{
		// Formatação para os valores
		$('#preco_original, #preco_promocional').priceFormat(
		{
			prefix: '',
			centsSeparator: ',',
			thousandsSeparator: ''
		});
		
		
		$("#produtos_form").validate(
		{
			rules: {
				cod_estados: 'required',
				cod_cidades: 'required',
				nome: 'required',
				preco_original: 'required'
			},
			messages: {
				cod_estados: 'obrigatória',
				cod_cidades: 'obrigatória',
				nome: 'obrigatório',
				preco_original: 'obrigatório'
			}
		});
	}

	// Validação do formulário de Clientes
	if ($('#clientes_form').length)
	{
		$("#clientes_form").validate(
		{
			rules: {
				nome: 'required',
				email: 'required',
				senha: {
					required: function(element) {return $(element).hasClass('required')},
                    minlength: 6
				},
				rg: {
					required: true,
                    minlength: 6
				},
				cpf: {
					required: true,
                    minlength: 11
				}
			},
			messages: {
				nome: 'obrigatório',
				email: 'obrigatório',
				senha: {
					required: 'obrigatória',
					minlength: 'A senha deve ter no mínimo 6 caracteres.'
				},
				rg: {
					required: 'obrigatório',
					minlength: 'O RG deve ter no mínimo 6 números.'
				},
				cpf: {
					required: 'obrigatória',
					minlength: 'O CPF deve ter os 11 números.'
				}
			}
		});
	}

	// Validação do formulário de Notícias
	if ($('#noticias_form').length)
	{
		$("#data").datepicker({showButtonPanel: true});
		$("#noticias_form").validate(
		{
			rules: {
				titulo: 'required',
				resumo: 'required',
				/*conteudo: 'required',*/
				data: {
					required: true,
					dateBR: true
				}
			},
			messages: {
				titulo: 'obrigatório',
				resumo: 'obrigatório',
				/*conteudo: 'obrigatório',*/
				data: {
					required: 'obrigatória',
					dateBR: 'data em formato inválido'
				}
			}
		});
	}

	// Validação do formulário de Mensagens
	if ($('#mensagens_form').length)
	{
		$("#mensagens_form").validate(
		{
			rules: {
				nome: 'required',
				email: {required: true, email: true},
				mensagem: 'required'
			},
			messages: {
				nome: 'obrigatório',
				email: {required: 'obrigatório', email: 'endereço inválido'},
				mensagem: 'obrigatória'
			}
		});
	}

	// Validação do formulário de Usuários
	if ($('#users_form').length)
	{
		$("#users_form").validate(
		{
			rules: {
				nome: 'required',
				username: 'required',
				password: {
					required: function(element) {return $(element).hasClass('required')},
                    minlength: 6
				}
			},
			messages: {
				nome: 'obrigatório',
				username: 'obrigatório',
				password: {
					required: 'obrigatória',
					minlength: 'A senha deve ter no mínimo 6 caracteres.'
				}
			}
		});
	}
});

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



