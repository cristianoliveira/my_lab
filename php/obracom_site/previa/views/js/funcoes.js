$(document).ready(function()
{
	// Colorbox para visualizar o formulário da central de atendimento
	$('.colorbox-atendimento').colorbox({transition:'elastic', fixed:true, inline:true, href:"#central-atendimento",
		onComplete:function(){
				$('#cboxTitle').css({'display': 'none'});
			}
	});
	
	// Colorbox para visualizar as imagens dos produtos
	$('.colorbox-produto').colorbox({rel:'colorbox-produto'});
	
	// Nice Forms
	// $('.niceform').NiceJFormer();

	/******************************/

	// Login por ajax
	if ($('#form-login').length)
	{
		$('#form-login').submit(function(e)
		{
			e.preventDefault();

			$('#form-login-notificacao').html('<span class="mensagem-aguarde">Aguarde...</span>');

			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(retorno)
				{
					if (retorno == '1')
					{
						window.location.href = redirecionar;
					}
					else
					{
						$('#form-login-notificacao').html('<span class="mensagem-erro">E-mail ou senha inválidos.</span>');
					}
				}
			);
		});
	}
	// Login página de identificação
	if ($('#form-cliente').length)
	{
		$('#form-cliente').submit(function(e)
		{
			e.preventDefault();

			$('#form-identificacao-notificacao').html('<span class="mensagem-aguarde">Aguarde...</span>');

			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(retorno)
				{
					if (retorno == '1')
					{
						window.location.href = redirecionar;
					}
					else if (retorno == '2')
                    {
                        window.location.href = SITE_URL+'/carrinho';
                    }
                    else
					{
						$('#form-identificacao-notificacao').html('<span class="mensagem-erro">E-mail ou senha inválidos.</span>');
					}
				}
			);
		});
	}
	if ($('#botao_esqueci_senha').length)
	{
		$('#botao_esqueci_senha').click(function(e)
		{
			e.preventDefault();

			$('#form-senha-notificacao').html('<span class="mensagem-aguarde">Aguarde...</span>');

			$.post(
				SITE_URL+'/area-cliente/esqueci-senha',
				{email : $('#identificacao_email').val()},
				function(retorno)
				{
					if (retorno == '1')
					{
						$('#form-senha-notificacao').html('<span class="mensagem-sucesso">Uma nova senha foi gerada e enviada para o seu e-email.</span>');
					}
					else
					{
						$('#form-senha-notificacao').html('<span class="mensagem-erro">E-mail inválido.</span>');
					}
				}
			);
		})
	}
	
	// Validação do formulário de cadastro (DADOS CADASTRAIS)
	if ($('#form-dados-cadastrais').length)
	{
		$('#form_cnpj').mask('99999999999999');
		$('#form_cpf, #form_responsavel_cpf').mask('99999999999');
		$('#form_nascimento').mask('99/99/9999');
		$('#form_ddd_principal, #form_ddd_celular, #form_ddd_comercial').mask('99');
		$('#form_tel_principal, #form_tel_celular, #form_tel_comercial').mask('99999999');

		// Escondemos os campos se for o caso, no carregamento da página
		if ($('input[name=pessoa_tipo]:checked').val() == 'juridica')
		{
			$('li.pessoa_juridica').show();
			$('li.pessoa_fisica').hide();
		}
		else
		{
			$('li.pessoa_juridica').hide();
		}
		// Troca de campos
		$('input[name=pessoa_tipo]').click(function()
		{
			if ($(this).val() == 'fisica')
			{
				$('li.pessoa_fisica').show();
				$('li.pessoa_juridica').hide();
				$('#form_razao_social, #form_cnpj, #form_responsavel_nome, #form_responsavel_cpf').val('');
			}
			else
			{
				$('li.pessoa_fisica').hide();
				$('li.pessoa_juridica').show();
				$('#form_nome, #form_cpf').val('');
			}
		});

		$('#form-dados-cadastrais').submit(function(e)
		{
			var pessoa_tipo = $('input[name=pessoa_tipo]').val();

			var razao_social = $('#form_razao_social').val();
			var cnpj = $('#form_cnpj').val();
			var responsavel_nome = $('#form_responsavel_nome').val();
			var responsavel_cpf = $('#form_responsavel_cpf').val();

			var nome = $('#form_nome').val();
			var cpf = $('#form_cpf').val();
			var sexo = $('#form_genero').val();
			var nascimento = $('#form_nascimento').val();
			var ddd_principal = $('#form_ddd_principal').val();
			var tel_principal = $('#form_tel_principal').val();
			var apelido = $('#form_apelido').val();
			var email = $('#form_email').val();
			var senha = $('#form_senha').val();
			var confirma_senha = $('#form_confirma_senha').val();

			$('#form-dados-cadastrais input, #form-dados-cadastrais select').removeClass('input-notificacao-erro');
			$('#form_cadastro_notification').removeClass('erro').html('');

			if (
				(pessoa_tipo == 'fisica' && nome != '' && cpf != '' && sexo != '' && nascimento != '' && ddd_principal != '' && tel_principal != '' && apelido != '' &&  email != '' &&  senha != '' &&  confirma_senha != '') ||
				(pessoa_tipo == 'juridica' && razao_social != '' && cnpj != '' && responsavel_nome != '' && responsavel_cpf != '' && sexo != '' && nascimento != '' && ddd_principal != '' && tel_principal != '' && apelido != '' &&  email != '' &&  senha != '' &&  confirma_senha != '')
			)
			{
				if (senha.length >= 6)
				{
					if (senha == confirma_senha)
					{
						if (validar_data(nascimento))
						{
							if(validar_email(email))
							{
								if (pessoa_tipo == 'juridica')
								{
									if (validar_cnpj(cnpj))
									{
										if (validar_cpf(responsavel_cpf))
										{
											return true; // envia o formulário
										}
										else
										{
											$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('CPF do responsável inválido.');
											$('#form_responsavel_cpf').addClass('input-notificacao-erro');
										}
									}
									else
									{
										$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('CNPJ inválido.');
										$('#form_cnpj').addClass('input-notificacao-erro');
									}
								}
								else
								{
									if (validar_cpf(cpf))
									{
										return true; // envia o formulário
									}
									else
									{
										$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('CPF inválido.');
										$('#form_cpf').addClass('input-notificacao-erro');
									}
								}
							}
							else
							{
								$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Email inválido.');
								$('#form_email').addClass('input-notificacao-erro');
							}
						}
						else
						{
							$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Data de nascimento inválida.');
							$('#form_nascimento').addClass('input-notificacao-erro');
						}
					}
					else
					{
						$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Senhas não conferem.');
						$('#form_senha, #form_confirma_senha').addClass('input-notificacao-erro');
					}
				}
				else
				{
					$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Sua senha deve ter no mínimo 6 caracteres.');
					$('#form_senha, #form_confirma_senha').addClass('input-notificacao-erro');
				}
			}
			else
			{
				$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Todos os campos marcados são obrigatórios.');
				// Marcamos os campos inválidos
				$('#form-dados-cadastrais input.required, #form-dados-cadastrais select.required').each(function()
				{
					// Testamos se o value do input está vazio
					if( ! $(this).val())
					{
						$(this).addClass('input-notificacao-erro');
					}
				});
			}

			// Para não fazer o submit de verdade || Sempre melhor usar o preventDefault.
			return false;
		});
	}

	// Validação do formulário de cadastro (ENDEREÇO)
	if ($('#form-endereco').length)
	{
		$('#form_cep_1').mask('99999');
		$('#form_cep_2').mask('999');
		$('#form_numero').mask('9?99999',{placeholder:''});
		$('#form_uf').mask('aa');

		$('#form-endereco').submit(function(e)
		{
			var cep_1 = $('#form_cep_1').val();
			var cep_2 = $('#form_cep_2').val();
			var endereco_tipo = $('#form-endereco input[name=entrega_endereco_tipo]').val();
			var endereco = $('#form_endereco').val();
			var numero = $('#form_numero').val();
			var bairro = $('#form_bairro').val();
			var cidade = $('#form_cidade').val();
			var estado = $('#form_estado').val();

			$('#form-endereco .required').removeClass('input-notificacao-erro');
			$('#form_cadastro_notification').removeClass('erro').html('');

			if (cep_1 != '' && cep_2 != '' && endereco_tipo != '' && endereco != '' && numero != '' && bairro != '' && cidade != '' && estado != '')
			{
				return true;
			}
			else
			{
				$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Todos os campos marcados são obrigatórios.');
				// Marcamos os campos inválidos
				$('#form-endereco .required').each(function()
				{
					// Testamos se o value do input está vazio
					if( ! $(this).val())
					{
						$(this).addClass('input-notificacao-erro');
					}
				});
			}

			// Para não fazer o submit de verdade || Sempre melhor usar o preventDefault.
			return false;
		});
	}

	// Validação do formulário de alteração do email
	if ($('#form-alterar-email').length)
	{
		$('#form-alterar-email').submit(function()
		{
			var email = $('#form_email').val();
			var novo_email = $('#form_novo_email').val();
			var senha = $('#form_senha').val();

			if (email != '' && novo_email != '' && senha != '')
			{
				if (validar_email(email))
				{
					if (validar_email(novo_email))
					{
						return true;
					}
					else
					{
						$('#form-alterar-email #form_notification').removeClass('sucesso erro informacao').addClass('erro').html('Novo E-mail inválido.');
					}
				}
				else
				{
					$('#form-alterar-email #form_notification').removeClass('sucesso erro informacao').addClass('erro').html('E-mail atual inválido.');
				}
			}
			else
			{
				$('#form-alterar-email #form_notification').removeClass('sucesso erro informacao').addClass('erro').html('Todos os campos são obrigatórios.');
			}

			return false;
		});
	}


	if ($('#form-dados-cadastrais.form-alterar-dados-cadastrais').length)
	{
		$('#form_cnpj').mask('99999999999999');
		$('#form_cpf, #form_responsavel_cpf').mask('99999999999');
		$('#form_nascimento').mask('99/99/9999');
		$('#form_ddd_principal, #form_ddd_celular, #form_ddd_comercial').mask('99');
		$('#form_tel_principal, #form_tel_celular, #form_tel_comercial').mask('99999999');

		// Escondemos os campos se for o caso, no carregamento da página
		if ($('input[name=pessoa_tipo]:checked').val() == 'juridica')
		{
			$('li.pessoa_juridica').show();
			$('li.pessoa_fisica').hide();
		}
		else
		{
			$('li.pessoa_juridica').hide();
		}
		// Troca de campos
		$('input[name=pessoa_tipo]').click(function()
		{
			if ($(this).val() == 'fisica')
			{
				$('li.pessoa_fisica').show();
				$('li.pessoa_juridica').hide();
				$('#form_razao_social, #form_cnpj, #form_responsavel_nome, #form_responsavel_cpf').val('');
			}
			else
			{
				$('li.pessoa_fisica').hide();
				$('li.pessoa_juridica').show();
				$('#form_nome, #form_cpf').val('');
			}
		});

		$('#form-dados-cadastrais').submit(function(e)
		{
			var pessoa_tipo = $('input[name=pessoa_tipo]').val();

			var razao_social = $('#form_razao_social').val();
			var cnpj = $('#form_cnpj').val();
			var responsavel_nome = $('#form_responsavel_nome').val();
			var responsavel_cpf = $('#form_responsavel_cpf').val();

			var nome = $('#form_nome').val();
			var cpf = $('#form_cpf').val();
			var sexo = $('#form_genero').val();
			var nascimento = $('#form_nascimento').val();
			var ddd_principal = $('#form_ddd_principal').val();
			var tel_principal = $('#form_tel_principal').val();
			var apelido = $('#form_apelido').val();
			var email = $('#form_email').val();

			$('#form-dados-cadastrais input, #form-dados-cadastrais select').removeClass('input-notificacao-erro');
			$('#form_cadastro_notification').removeClass('erro').html('');

			if (
				(pessoa_tipo == 'fisica' && nome != '' && cpf != '' && sexo != '' && nascimento != '' && ddd_principal != '' && tel_principal != '' && apelido != '' &&  email != '') ||
				(pessoa_tipo == 'juridica' && razao_social != '' && cnpj != '' && responsavel_nome != '' && responsavel_cpf != '' && sexo != '' && nascimento != '' && ddd_principal != '' && tel_principal != '' && apelido != '' &&  email != '')
			)
			{
				if (validar_data(nascimento))
				{
					if(validar_email(email))
					{
						if (pessoa_tipo == 'juridica')
						{
							if (validar_cnpj(cnpj))
							{
								if (validar_cpf(responsavel_cpf))
								{
									return true; // envia o formulário
								}
								else
								{
									$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('CPF do responsável inválido.');
									$('#form_responsavel_cpf').addClass('input-notificacao-erro');
								}
							}
							else
							{
								$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('CNPJ inválido.');
								$('#form_cnpj').addClass('input-notificacao-erro');
							}
						}
						else
						{
							if (validar_cpf(cpf))
							{
								return true; // envia o formulário
							}
							else
							{
								$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('CPF inválido.');
								$('#form_cpf').addClass('input-notificacao-erro');
							}
						}
					}
					else
					{
						$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Email inválido.');
						$('#form_email').addClass('input-notificacao-erro');
					}
				}
				else
				{
					$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Data de nascimento inválida.');
					$('#form_nascimento').addClass('input-notificacao-erro');
				}
			}
			else
			{
				$('#form_cadastro_notification').removeClass('sucesso erro informacao').addClass('erro').html('Todos os campos marcados são obrigatórios.');
				// Marcamos os campos inválidos
				$('#form-dados-cadastrais input.required, #form-dados-cadastrais select.required').each(function()
				{
					// Testamos se o value do input está vazio
					if( ! $(this).val())
					{
						$(this).addClass('input-notificacao-erro');
					}
				});
			}

			// Para não fazer o submit de verdade || Sempre melhor usar o preventDefault.
			return false;
		});
	}

	// Validação do formulário de alteração da senha
	if ($('#form-alterar-senha').length)
	{
		$('#form-alterar-senha').submit(function()
		{
			var senha = $('#form_senha').val();
			var nova_senha = $('#form_nova_senha').val();
			var email = $('#form_email').val();

			if (email != '' && nova_senha != '' && senha != '')
			{
				if (validar_email(email))
				{
					if (senha != nova_senha)
					{
						if (nova_senha.length >= 6)
						{
							return true;
						}
						else
						{
							$('#form-alterar-senha #form_notification').removeClass('sucesso erro informacao').addClass('erro').html('A nova senha deve ter no mínimo 6 caracteres.');
						}
					}
					else
					{
						$('#form-alterar-senha #form_notification').removeClass('sucesso erro informacao').addClass('erro').html('A nova senha não pode ser igual à senha atual.');
					}
				}
				else
				{
					$('#form-alterar-senha #form_notification').removeClass('sucesso erro informacao').addClass('erro').html('E-mail inválido.');
				}
			}
			else
			{
				$('#form-alterar-senha #form_notification').removeClass('sucesso erro informacao').addClass('erro').html('Todos os campos são obrigatórios.');
			}

			return false;
		});
	}


    // Validação do Formulário da Central de Relacionamento
    if ($('#form-atendimento').length)
    {
        $('#form-atendimento').submit(function(e)
        {
            e.preventDefault();

            var nome = $('#informacao_nome').val();
            var email = $('#informacao_email').val();
            var assunto = $('#assunto').val();
            var ddd = $('#informacao_ddd').val();
            var fone = $('#informacao_fone').val();
            var cidade = $('#informacao_cidade').val();
            var estado = $('#uf').val();
            var mensagem = $('#informacao_mensagem').val();

            $('#form-atendimento input, #form-atendimento textarea').removeClass('input-notificacao-erro');

            if (nome != '' &&  email !='' && assunto != '' && ddd !='' && fone !='' && cidade !='' && estado !='' && mensagem !='')
            {
                if(validar_email(email))
                {
                    // Limpa as mensagens
                    $('#form_notification').addClass('informacao').html('Aguarde...');

                    $.post(
                        $('#form-atendimento').attr('action'),
                        $('#form-atendimento').serialize(), // Transforma os campos do form em parâmetros,
                        function(json)
                        {
                            var mensagem = json.mensagem;
                            var tipo = json.tipo;

                            $('#form_notification').removeClass('sucesso erro informacao').addClass(tipo).html(mensagem);

                            if (tipo == 'sucesso')
                            {
                                $('#form-atendimento').html('');
                                $('.box').append('<img src="/previa/views/imagens/resposta-contato.png">');
                                $('#informacao_nome, #informacao_email, #assunto, #informacao_ddd, #informacao_fone, #informacao_cidade, #uf, #informacao_mensagem').val('');
                            }
                        },
                        'json'
                    );
                }
                else
                {
                    //$('#form_notification').html('<div class="erro">E-mail inválido.</div>');
                    $('#form_notification').removeClass('sucesso erro informacao').addClass('erro').html('Email inválido.');
                    $('#informacao_email').addClass('input-notificacao-erro');
                }
            }
            else
            {
                //$('#form_notification').html('<div class="erro">Todos os campos marcados são obrigatórios.</div>');
                $('#form_notification').removeClass('sucesso erro informacao').addClass('erro').html('Todos os campos são obrigatórios.');
                // Marcamos os campos inválidos
                $('#form-atendimento input, #form-atendimento textarea').each(function()
                {
                    // Testamos se o value do input está vazio
                    if( ! $(this).val())
                    {
                        $(this).addClass('input-notificacao-erro');
                    }
                });
            }

            // Para não fazer o submit de verdade || Sempre melhor usar o preventDefault.
            return false;
        });
    }

    // Validação do Formulário de CONTATO
    if ($('#form-contato').length)    {

        $('#form-contato').submit(function(e)
        {
            e.preventDefault();

            var nome = $('#contato_nome').val();
            var email = $('#contato_email').val();
            var assunto = $('#contato_assunto').val();
            var ddd = $('#contato_ddd').val();
            var fone = $('#contato_fone').val();
            var cidade = $('#contato_cidade').val();
            var estado = $('#contato_uf').val();
            var mensagem = $('#contato_mensagem').val();

            $('#form-contato input, #form-contato textarea').removeClass('input-notificacao-erro');

            if (nome != '' &&  email !='' && assunto != '' && ddd !='' && fone !='' && cidade !='' && estado !='' && mensagem !='')
            {
                if(validar_email(email))
                {
                    // Limpa as mensagens
                    $('#form_contato_notification').addClass('informacao').html('Aguarde...');

                    $.post(
                        $('#form-contato').attr('action'),
                        $('#form-contato').serialize(), // Transforma os campos do form em parâmetros,
                        function(json)
                        {
                            var mensagem = json.mensagem;
                            var tipo = json.tipo;

                            $('#form_contato_notification').removeClass('sucesso erro informacao').addClass(tipo).html(mensagem);

                            if (tipo == 'sucesso')
                            {
                                $('#form-contato').html('');
                                $('#form-contato').append('<img src="/previa/views/imagens/resposta-contato.png">');
                                $('#contato_nome, #contato_email, #contato_assunto, #contato_ddd, #contato_fone, #contato_cidade, #contato_uf, #contato_mensagem').val('');
                            }
                        },
                        'json'
                    );
                }
                else
                {
                    //$('#form_notification').html('<div class="erro">E-mail inválido.</div>');
                    $('#form_contato_notification').removeClass('sucesso erro informacao').addClass('erro').html('Email inválido.');
                    $('#contato_email').addClass('input-notificacao-erro');
                }
            }
            else
            {
                //$('#form_notification').html('<div class="erro">Todos os campos marcados são obrigatórios.</div>');
                $('#form_contato_notification').removeClass('sucesso erro informacao').addClass('erro').html('Todos os campos são obrigatórios.');
                // Marcamos os campos inválidos
                $('#form-contato input, #form-contato textarea').each(function()
                {
                    // Testamos se o value do input está vazio
                    if( ! $(this).val())
                    {
                        $(this).addClass('input-notificacao-erro');
                    }
                });
            }

            // Para não fazer o submit de verdade || Sempre melhor usar o preventDefault.
            return false;
        });
    }



	if ($('#form-ordenar').length)
	{
		$('#ordenar_por').change(function()
		{
			var caminho = decodeURI(window.location.href);
			caminho = caminho.replace('/ordenar-por','');
			caminho = caminho.replace('/alfabetica','');
			caminho = caminho.replace('/mais-novos','');
			caminho = caminho.replace('/menor-preco','');
			caminho = caminho.replace('/maior-preco','');
			if (caminho[caminho.length-1] != '/') { caminho += '/';}
			window.location.href = caminho+'ordenar-por/'+$(this).val();
		});
	}

	if ($('#form-buscar').length)
	{
		$('#form-buscar').submit(function(e)
		{
			e.preventDefault();
			var categoria_seo = $('#buscar_categoria').val().length ? '/'+$('#buscar_categoria').val() : '';
			if ($.trim($('#buscar_produto').val()) != '') // Não pesquisa se estiver vazio
			{
				window.location.href = SITE_URL+'/produtos'+categoria_seo+'/buscar/'+decodeURI($.trim($('#buscar_produto').val()));
			}
			else
			{
				$('#busca-em-branco').show();
			}
		});
	}

	if ($('.carrinho-compras').length)
	{
		$('input[name=quantidade]').mask('9',{placeholder:''});
		$('.atualizar_quantidade').click(function(e)
		{
			e.preventDefault();
			window.location.href = SITE_URL+'/carrinho/atualizar/'+$(this).attr('id')+'/'+$(this).siblings('input').val();
		})
	}

	if ($('#form-enquete').length)
	{
		$('#form-enquete').submit(function(e)
		{
			if ($(this).find('input[name=opcao]:checked').val())
			{
				return true;
			}
			else
			{
				alert('Selecione uma opção para poder votar.');
				return false;
			}
		});
	}

	if ($('#cor_id').length)
	{
		$(".cores a").tipTip({delay: 0});

		$('.cores a').click(function(e)
		{
			e.preventDefault();

			var id = $(this).attr('id').replace('cor-', '');
			$('#cor_id').val(id);
			$('.cores li').removeClass('selecionado');
			$(this).parent().addClass('selecionado');

			$('#produto_escolher_cor').fadeOut(100);
		});

		$('#comprar-produto button').bind('hover click', function()
		{
			if (isNaN(parseInt($('#cor_id').val())))
			{
				$('#produto_escolher_cor').fadeIn(100);
				setTimeout(function() {$('#produto_escolher_cor').fadeOut(100);}, 3000)
				return false;
			}
		});
	}

    if ($('#form_forma_entrega').length > 0)
    {
        $('#modo_entrega').change(function(e){
            $(this).parent().parent().submit();
        });
    }
});

//----------

$(window).load(function()
{
	// Slideshow Área Conceitual
	if ($('#slider').length)
	{
		$('#slider').nivoSlider();
	}
});

//----------

// função de validação de email
function validar_email(email)
{
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(email);
}

function validar_cpf(cpf)
{
	if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
		return false;
	add = 0;
	for (i=0; i < 9; i ++)
		add += parseInt(cpf.charAt(i)) * (10 - i);
	rev = 11 - (add % 11);
	if (rev == 10 || rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(9)))
		return false;
	add = 0;
	for (i = 0; i < 10; i ++)
		add += parseInt(cpf.charAt(i)) * (11 - i);
	rev = 11 - (add % 11);
	if (rev == 10 || rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(10)))
		return false;
	return true;
}

function validar_cnpj(cnpj)
{
	var i;
	s = limpa_string(s);
	var c = s.substr(0,12);
	var dv = s.substr(12,2);
	var d1 = 0;
	for (i = 0; i < 12; i++)
	{
		d1 += c.charAt(11-i)*(2+(i % 8));
	}
	if (d1 == 0) return false;
	d1 = 11 - (d1 % 11);
	if (d1 > 9) d1 = 0;
	if (dv.charAt(0) != d1)
	{
		return false;
	}

	d1 *= 2;
	for (i = 0; i < 12; i++)
	{
		d1 += c.charAt(11-i)*(2+((i+1) % 8));
	}
	d1 = 11 - (d1 % 11);
	if (d1 > 9) d1 = 0;
	if (dv.charAt(1) != d1)
	{
		return false;
	}
	return true;
}

function validar_data(data)
{
    var dia = data.substr(0,2);
    var mes = data.substr(3,2)-1;
    var ano = data.substr(6,4);

	var nova_data = new Date();
	nova_data.setFullYear(ano, mes, dia);

	return nova_data.getMonth() == mes;

	/*if((mes==04 && dia > 30) || (mes==06 && dia > 30) || (mes==09 && dia > 30) || (mes==11 && dia > 30)){
        return false;
    } else {
        if(ano%4!=0 && mes==2 && dia>28){
            return false;
        } else {
            if(ano%4==0 && mes==2 && dia>29){
                return false;
            } else {
                    return true;
            }
        }
    }*/
}
