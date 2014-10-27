$(document).ready(function()
{
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
				categoria_id: 'required',
				nome: 'required',
				preco_original: 'required'
			},
			messages: {
				categoria_id: 'obrigatória',
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
                    minlength: 11,
                    verificaCPF: true
				},
				telefone_principal:
				{
					required: true
				}
				,
				email_cliente: {
					required: true,
                    verificaEmail: true
				},

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
					minlength: 'O CPF deve ter os 11 números.',
				    verificaCPF: "CPF inválido"
		        },
		        email_cliente: {
		        	required: 'obrigatório',
		        	verificaEmail: 'Email inválido.'
		        },
				
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

jQuery.validator.addMethod("verificaCPF", function(value, element) {
    value = value.replace('.','');
    value = value.replace('.','');
    cpf = value.replace('-','');
    while(cpf.length < 11) cpf = "0"+ cpf;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = 11;
    for (i=0; i<11; i++){
        a[i] = cpf.charAt(i);
        if (i < 9) b += (a[i] * --c);
    }
    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
    b = 0;
    c = 11;
    for (y=0; y<10; y++) b += (a[y] * c--);
    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;
    return true;
}, "Informe um CPF válido.");

jQuery.validator.addMethod("verificaEmail", function(value, element) {
    
	var hasArroba, hasPonto;

	hasArroba   = (value.indexOf("@")>0);
	hasPonto    = (value.indexOf(".")>0);
 
    return hasArroba && hasPonto;

}, "Informe um email válido.");

/*
 *
 * NOVO METODO PARA O JQUERY VALIDATE
 * VALIDA CNPJ COM 14 OU 15 DIGITOS
 * A VALIDAÇÃO É FEITA COM OU SEM OS CARACTERES SEPARADORES, PONTO, HIFEN, BARRA
 *
 * ESTE MÉTODO FOI ADAPTADO POR:
 * 
 * Shiguenori Suguiura Junior <junior@dothcom.net>
 * 
 * http://blog.shiguenori.com
 * http://www.dothcom.net
 * 
 */
jQuery.validator.addMethod("cnpj", function(cnpj, element) {
   cnpj = jQuery.trim(cnpj);// retira espaços em branco
   // DEIXA APENAS OS NÚMEROS
   cnpj = cnpj.replace('/','');
   cnpj = cnpj.replace('.','');
   cnpj = cnpj.replace('.','');
   cnpj = cnpj.replace('-','');
 
   var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
   digitos_iguais = 1;
 
   if (cnpj.length < 14 && cnpj.length < 15){
      return false;
   }
   for (i = 0; i < cnpj.length - 1; i++){
      if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
         digitos_iguais = 0;
         break;
      }
   }
 
   if (!digitos_iguais){
      tamanho = cnpj.length - 2
      numeros = cnpj.substring(0,tamanho);
      digitos = cnpj.substring(tamanho);
      soma = 0;
      pos = tamanho - 7;
 
      for (i = tamanho; i >= 1; i--){
         soma += numeros.charAt(tamanho - i) * pos--;
         if (pos < 2){
            pos = 9;
         }
      }
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(0)){
         return false;
      }
      tamanho = tamanho + 1;
      numeros = cnpj.substring(0,tamanho);
      soma = 0;
      pos = tamanho - 7;
      for (i = tamanho; i >= 1; i--){
         soma += numeros.charAt(tamanho - i) * pos--;
         if (pos < 2){
            pos = 9;
         }
      }
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(1)){
         return false;
      }
      return true;
   }else{
      return false;
   }
}, "Informe um CNPJ válido."); // Mensagem padrão 

