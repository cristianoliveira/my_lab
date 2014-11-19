<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_Pagseguro extends Controller_Padrao
{
	/**
	 * Chama o construtor da classe pai
	 */
	public function __construct()
	{
		parent::__construct();
	}
	

	/**
	 * Método inicial que faz o envio da compra para o PagSeguro
	 */
	public function index()
	{
		// Para que as credenciais fiquem disponíveis
		global $pagseguro_config;

		// Caso o cliente não esteja logado ou não tenha cadastro, salvamos o link para onde ele deverá ser redirecionado após o login ou cadastro
		$_SESSION['redirecionar'] = SITE_URL.'/carrinho';

		$this->verificar_cliente_logado();

		// Passou limpamos a variável
		unset($_SESSION['redirecionar']);

		// Pegamos todos os parâmetros e salvamos a compra
		if (isset($_SESSION['carrinho']) AND ! is_null($_SESSION['carrinho']) AND count($_SESSION['carrinho']) > 0)
		{
			// Se vier só um produto, ele não vem dentro do array, vem sendo o próprio produto. Acho que tem algo a ver com o comportamento da SESSION, não sei.
			// Para resolver isso, criamos um array ;)
			//$session_produtos = (count($_SESSION['carrinho']) == 1) ? array($_SESSION['carrinho']) : $_SESSION['carrinho'];

			// Cria o objeto da Compra
			$compra = new Model_Compra;
			$compra->set_cliente_id($this->get_cliente()->get_id());
			$compra->set_quando(date('Y-m-d H:i:s'));
            $compra->set_forma_entrega($_SESSION['forma_entrega']);

			// Escape nos valores
			$compra->colunas_mysqli_escape();
			// Inserção no banco
			if ($compra->verificar_obrigatorios() AND $compra->insert())
			{
				// Com base no ID, criamos o código da compra (também no Compra_Sucesso
				//$compra->set_codigo(Funcoes::compra_gerar_codigo(intval($compra->get_id()) + 7)); // Não alterar esta soma após o site entrar no ar
				$compra->set_codigo((intval($compra->get_id()) + 1234)); // Não alterar esta soma após o site entrar no ar
				// Atualizamos o registro da compra
				if ($compra->update())
				{
                    $compra_endereco = new Model_CompraEndereco();
                    $compra_endereco->set_compra_id($compra->get_id());
                    if ($_SESSION['compra-endereco'] == 'cliente')
                    {
                        $cliente = new Model_Cliente($_SESSION['cliente_id']);
                        $compra_endereco->set_endereco($cliente->get_entrega_endereco());
                        $compra_endereco->set_numero($cliente->get_entrega_numero());
                        $compra_endereco->set_complemento($cliente->get_entrega_complemento());
                        $compra_endereco->set_bairro($cliente->get_entrega_bairro());
                        $compra_endereco->set_cep($cliente->get_entrega_cep());
                        $compra_endereco->set_cidade($cliente->get_entrega_cidade());
                        $compra_endereco->set_estado($cliente->get_entrega_estado());
                        $compra_endereco->set_referencia($cliente->get_entrega_referencia());
                        $compra_endereco->set_tipo($cliente->get_entrega_endereco_tipo());
                    }
                    else
                    {
                        $endereco = new Model_ClienteEndereco($_SESSION['compra-endereco']);
                        $compra_endereco->set_endereco($endereco->get_endereco());
                        $compra_endereco->set_numero($endereco->get_numero());
                        $compra_endereco->set_complemento($endereco->get_complemento());
                        $compra_endereco->set_bairro($endereco->get_bairro());
                        $compra_endereco->set_cep($endereco->get_cep());
                        $compra_endereco->set_cidade($endereco->get_cidade());
                        $compra_endereco->set_estado($endereco->get_estado());
                        $compra_endereco->set_referencia($endereco->get_referencia());
                        $compra_endereco->set_tipo($endereco->get_tipo());
                    }
                    if (!$compra_endereco->insert())
                    {
                        $n = new Notificacao('Ocorreu um erro inesperado, tente mais tarde.', 'erro', TRUE);
                        header('Location: '.SITE_URL.'/carrinho');
                        exit;
                    }

                    //Controller q faz a consulta do frete
                    $frete = new Controller_Frete();

                    //Agora inserimos na tabela de compra-endereco o endereco de entrega

					// Agora fazemos o vínculo de cada produto com a compra
					$produtos = array();
					$valor_total = 0;
					foreach ($_SESSION['carrinho'] as $produto_identificador=>$propriedades)
					{
						list($produto_id, $cor_id) = explode('-', $produto_identificador);

						// Carregamos o produto
						$produto = new Model_Produto($produto_id);

						$compra_produto = new Model_CompraProduto;
						$compra_produto->set_compra_id($compra->get_id());
						$compra_produto->set_produto_id($produto_id);
						$compra_produto->set_quantidade($propriedades['quantidade']);
						$compra_produto->set_valor_unitario(is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional());
						$compra_produto->set_cor_id( ! empty($cor_id) ? $cor_id : NULL);
						$valor_total += $compra_produto->get_valor_unitario() * $propriedades['quantidade'];
                        $compra_produto->set_frete_unitario($frete->calcular($compra_endereco->get_cep(),$produto->get_largura(), $produto->get_altura(), $produto->get_comprimento(), $produto->get_peso(), $_SESSION['forma_entrega']));
						$compra_produto->colunas_mysqli_escape();
						if ($compra_produto->verificar_obrigatorios() AND $compra_produto->insert())
						{
							$produtos[] = new Model_Produto($produto_id);
						}
						else
						{
							$n = new Notificacao('Ocorreu um erro ao salvar os produtos da sua compra. Por favor, tente novamente mais tarde.', 'erro', TRUE);
							header('Location: '.SITE_URL.'/carrinho');
							exit;
						}
					}

					//-----
                    //Definimos o frete
                    $total_frete = 0;
                    $frete = new Controller_Frete();

                    $compra_produto_aux = new Model_CompraProduto();
                    $compras_produto_aux = $compra_produto_aux->select("
                        SELECT {tabela_nome}.*, fd_produtos.altura AS 'altura', fd_produtos.largura AS 'largura', fd_produtos.comprimento AS 'comprimento', fd_produtos.peso AS 'peso'
                        FROM {tabela_nome}
                        JOIN fd_produtos ON {tabela_nome}.produto_id = fd_produtos.id
                        WHERE {tabela_nome}.compra_id = ".$compra->get_id()."
                    ", TRUE);

                    foreach ($compras_produto_aux as $compra_produto_aux)
                    {
                        $total_frete += $compra_produto_aux->get_quantidade() * $frete->calcular($compra_endereco->get_cep(),$compra_produto_aux->largura, $compra_produto_aux->altura, $compra_produto_aux->comprimento, $compra_produto_aux->peso, $_SESSION['forma_entrega']);
                    }
                    $compra->set_frete($total_frete);
					//-----

					// Definimos o valor da compra e atualizamos ela no BD
					$compra->set_valor($valor_total);
					$compra->update();

					//-----

					// Enviamos email para a Movel Clube informando a venda
					//$enviar_email = new Controller_Email;
					//$enviar_email->pagseguro_brubins($this->get_cliente(), $compra, $_SESSION['carrinho']);

					//--------------------

					// Fazemos toda a parte do PagSeguro após o trabalho no banco por conflito entre métodos Autoloaders

					require_once 'biblioteca/PagSeguroLibrary/PagSeguroLibrary.php';

					// Carregamos as credenciais de acesso ao PagSeguro

					$pg_credenciais = new AccountCredentials($pagseguro_config[SITE_LOCAL]['email'], $pagseguro_config[SITE_LOCAL]['token']);

					// Criamos o objeto que fará a requisição de pagamento ao PagSeguro
					$pg_pagamento_requisicao = new PaymentRequest();

					$compra_produto = new Model_CompraProduto;
					$compra_produtos = $compra_produto->select('
						SELECT compra_produto.*, produto.nome AS produto_nome, produto.valor_original, produto.valor_promocional, cor.nome AS cor_nome
						FROM {tabela_nome} AS compra_produto
							LEFT JOIN {tabela_prefixo}produtos AS produto ON compra_produto.produto_id = produto.id
							LEFT JOIN {tabela_prefixo}produtos_cores AS cor ON compra_produto.cor_id = cor.id
						WHERE compra_produto.compra_id = "'.$compra->get_id().'"
					', TRUE);

					// Agora fazemos o vínculo de cada produto com a compra
					foreach ($compra_produtos as $compra_produto)
					{
						// Adiciona o produto na requisição
						$pg_pagamento_requisicao->addItem(
							array(
								'id' => $compra_produto->get_produto_id().( ! is_null($compra_produto->get_cor_id()) ? '-'.$compra_produto->get_cor_id() : ''),
								'description' => utf8_decode($compra_produto->produto_nome.(isset($compra_produto->cor_nome) ? ' - Cor: '.$compra_produto->cor_nome : '')),
								'quantity' => $compra_produto->get_quantidade(),
								'amount' => number_format(is_null($compra_produto->valor_promocional) ? $compra_produto->valor_original : $compra_produto->valor_promocional , 2, '.', '')
							)
						);
					}

					// Não vai como frete no item porque o item multiplica o frete pela quantidade
					$pg_pagamento_requisicao->setExtraAmount(number_format($compra->get_frete(), 2, '.', ''));

					unset($_SESSION['carrinho']);

					//-----

					// Carregamos as informações do cliente na requisição
					$comprador = new Sender();
					$comprador->setName(is_null($this->get_cliente()->get_responsavel_nome()) ? $this->get_cliente()->get_nome() : $this->get_cliente()->get_responsavel_nome());
					$comprador->setEmail($this->get_cliente()->get_email());

					// Dependendo do telefone disponível, adiciona na requisição
					if ( ! is_null($this->get_cliente()->get_telefone_celular()))
					{
						$comprador->setPhone(substr($this->get_cliente()->get_telefone_celular(), 0, 2), substr($this->get_cliente()->get_telefone_celular(), 2));
					}
					elseif ( ! is_null($this->get_cliente()->get_telefone_comercial()))
					{
						$comprador->setPhone(substr($this->get_cliente()->get_telefone_comercial(), 0, 2), substr($this->get_cliente()->get_telefone_comercial(), 2));
					}
					else
					{
						$comprador->setPhone(substr($this->get_cliente()->get_telefone_principal(), 0, 2), substr($this->get_cliente()->get_telefone_principal(), 2));
					}

					$pg_pagamento_requisicao->setSender($comprador);

					//-----
					$pg_pagamento_requisicao->setShippingAddress(
						array(
							'postalCode' => $this->get_cliente()->get_entrega_cep(),
							'street' => $compra_endereco->get_endereco(),
							'number' => $compra_endereco->get_numero(),
							'complement' => $compra_endereco->get_complemento(),
							'district' => $compra_endereco->get_bairro(),
							'city' => $compra_endereco->get_cidade(),
							'state' => strtoupper($compra_endereco->get_estado()),
							'country' => 'BRA'
						)
					);

					//-----

                    //Enviamos o email para o cliente com os dados da compra
                    $email = new Controller_Email();
                    $email->compra_efetuada(
                        array(
                            'compra' => $compra,
                            'produtos' => $compra_produtos,
                            'cliente' => new Model_Cliente($_SESSION['cliente_id']),
                            'endereco' => $compra_endereco
                        )
                    );


                    //-----
                    try {
						// Nosso código de referência é o ID do cliente mais o ID da compra
						$pg_pagamento_requisicao->setReference($this->get_cliente()->get_id().'-'.$compra->get_id());

						// Para onde o cliente deve ser redirecionado após o pagamento
						$pg_pagamento_requisicao->setRedirectURL(SITE_URL.'/pagseguro/retorno');

						// Moeda utilizada na transação
						$pg_pagamento_requisicao->setCurrency("BRL");

						// Tipo de envio da compra
						$pg_pagamento_requisicao->setShippingType(3); // 1 = PAC, 2 = SEDEX, 3 = Não especificado

						// A URL do PagSeguro só pode ser usada uma vez
						$pg_pagamento_requisicao->setMaxUses(1);

						// Envia a requisição para o PagSeguro
						$pg_url = $pg_pagamento_requisicao->register($pg_credenciais);
						// Envia o cliente para o PagSeguro
						header('Location: '.$pg_url);
						exit;
                    	
                    } catch (Exception $e) {
                    	$n = new Notificacao('Por favor, verifique seus dados cadastrais e tente novamente mais tarde.', 'erro', TRUE);
						header('Location: '.SITE_URL.'/carrinho');
						exit;
                    }
				}
				else
				{
					$n = new Notificacao('Ocorreu um erro ao salvar sua compra. Por favor, tente novamente mais tarde.', 'erro', TRUE);
					header('Location: '.SITE_URL.'/carrinho');
					exit;
				}
			}
			else
			{
				$n = new Notificacao('Ocorreu um erro ao processar sua compra. Por favor, tente novamente mais tarde.', 'erro', TRUE);
				header('Location: '.SITE_URL.'/carrinho');
				exit;
			}
		}
		else
		{
			$n = new Notificacao('Não é possível realizar uma compra sem produtos.', 'erro', TRUE);
			header('Location: '.SITE_URL.'/carrinho');
			exit;
		}
	}


	/**
	 * Função que recebe o retorno do PagSeguro, salva a transação no banco e envia emails se necessário.
	 * @param $parametros
	 * @return void
	 */
	public function retorno($parametros)
	{
		// Para que as credenciais fiquem disponíveis
		global $pagseguro_config;
		
		// Carregamos primeiro os objetos que precisamos e só depois incluímos a biblioteca do PagSeguro
		require_once 'sistema/log.php';
		require_once 'biblioteca/funcoes.php';
		require_once 'models/pagseguro.php';
		require_once 'models/compra.php';
		require_once 'models/cliente.php';
		require_once 'models/compraproduto.php';

		$pagseguro = new Model_Pagseguro;

		//-----

		$enviar_email = new Controller_Email;

		require_once 'biblioteca/PagSeguroLibrary/PagSeguroLibrary.php';


		// Carregamos as credenciais de acesso ao PagSeguro
		$pg_credenciais = new AccountCredentials($pagseguro_config[SITE_LOCAL]['email'], $pagseguro_config[SITE_LOCAL]['token']);

		// Tipo de notificação recebida
		//$pg_notificacao_tipo = $parametros->transaction_id;
		$pg_notificacao_tipo = $parametros->notificationType;
		// Código da notificação recebida
		$pg_notificacao_codigo = $parametros->notificationCode;

		// Verificando tipo de notificação recebida
		if ($pg_notificacao_tipo == 'transaction')
		{
			// Obtendo o objeto Transaction a partir do código de notificação
			$pg_transacao = NotificationService::checkTransaction($pg_credenciais, $pg_notificacao_codigo);

			if ($pg_transacao)
			{
				list($cliente_id, $compra_id) = explode('-', $pg_transacao->getReference());

				$pagseguro->set_compra_id($compra_id);
				$pagseguro->set_data(date('Y-m-d H:i:s', strtotime($pg_transacao->getLastEventDate())));
				$pagseguro->set_identificador($pg_transacao->getCode());
				$pagseguro->set_referencia($pg_transacao->getReference());
				$pagseguro->set_transacao_status_id($pg_transacao->getStatus()->getValue());
				$pagseguro->set_pagamento_tipo_id($pg_transacao->getPaymentMethod()->getType()->getValue());
				$pagseguro->set_pagamento_codigo_id($pg_transacao->getPaymentMethod()->getCode()->getValue());

				if ($pagseguro->insert())
				{
					$cliente = new Model_Cliente($cliente_id);
					$compra = new Model_Compra($compra_id);

					// Aqui envia o email para o cliente quando a transação for aprovado
					if ($pagseguro->get_transacao_status_id() == 3 OR $cliente->get_nome() == 'Rodrigo Saling - Fator Digital') // 3 = Paga
					{
						$enviar_email->pagseguro_retorno_cliente($cliente, $compra, $pg_transacao->getCode());
					}
				}
				else
				{
					$log = new Log('Erro ao inserir o retorno do PagSeguro no banco. $referencia='.$pg_transacao->getReference().' $identificador='.$pg_transacao->getCode());
				}
			}
			else
			{
				$log = new Log('Erro ao trazer a transação do PagSeguro. $pg_transacao='.var_export($pg_transacao, TRUE));
			}
		}
        else
        {
            //$log = new Log('Erro ao receber a transação, sem parametros', TRUE);
        }

		//-----

		// Momento do redirecionamento do cliente, buscamos 

		if($_GET['id'])
        {
            $transaction_id = trim($_GET['id']);
            $transaction = TransactionSearchService::searchByCode($pg_credenciais, $transaction_id);

            if ( ! is_null($transaction->getCode()))
            {
                list($cliente_id, $compra_id) = explode('-', $transaction->getReference());

	            // Carregamos o cliente
	            $_SESSION['cliente_id'] = $cliente_id;
	            $this->set_cliente(new Model_Cliente($cliente_id));

	            // Carregamos a compra
	            $compra = new Model_Compra($compra_id);
	            // Salvamos em uma variável o id da transação do PagSeguro
				$pagseguro_identificador = $transaction->getCode();
            }
        }

		// Carrega algumas variáveis reutilizadas nos controllers
		$view = new View('compra-sucesso.php');
		$this->view_variaveis_obrigatorias($view);

		$compra = $compra->select('SELECT * FROM {tabela_nome} WHERE id='.$compra_id);
        $view->set_variavel('compra', $compra);
        $view->set_variavel('pagseguro_identificador',$pagseguro_identificador);

		$view->set_variavel('body_class', 'compra-sucesso');
		$view->set_variavel('notificacao', new Notificacao);

		$view->set_variavel('pagina_title', 'Status da sua compra');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}

} // end class