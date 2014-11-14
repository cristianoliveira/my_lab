<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_Carrinho extends Controller_Padrao
{
	/**
	 * Chama o construtor da classe pai
	 */
	public function __construct()
	{
		parent::__construct();
	}
	

	/**
	 * Método inicial que faz a renderização básica da página
	 * @param $parametros
	 * @return void
	 */
	public function index($parametros)
	{
        $view = new View('carrinho.php');
		$this->view_variaveis_obrigatorias($view);

		//-----

		$carrinho = array();

		if (isset($_SESSION['carrinho']) AND count($_SESSION['carrinho']) > 0)
		{
			foreach ($_SESSION['carrinho'] as $produto_identificador=>$propriedades)
			{
				list($produto_id, $cor_id) = explode('-', $produto_identificador);

				$produto = new Model_Produto($produto_id);
				if ($produto AND ! is_null($produto->get_id()))
				{
					$carrinho[$produto_identificador] = $produto;
					$carrinho[$produto_identificador]->quantidade = $propriedades['quantidade'];
					if (isset($propriedades['cor']))
					{
						$cor = new Model_ProdutoCor($propriedades['cor']);
						if ($cor AND ! is_null($cor->get_id()))
						{
							$carrinho[$produto_identificador]->cor_id = $cor->get_id();
							$carrinho[$produto_identificador]->cor_nome = $cor->get_nome();
						}
					}
				}
			}
		}

		$view->set_variavel('carrinho', $carrinho);

		$view->set_variavel('cliente_cidade', ! is_null($this->get_cliente()) ? $this->get_cliente()->get_entrega_cidade() : NULL );

		//-----

        //Array q guarda o frete unitario de cada produto
        $produtos_frete = array();
        $frete = new Controller_Frete();

        if (isset($_SESSION['cliente_id']) AND is_numeric($_SESSION['cliente_id']))
        {
            if (!isset($_SESSION['compra-endereco']) OR $_SESSION['compra-endereco'] == 'cliente')
            {
                $cliente = new Model_Cliente($_SESSION['cliente_id']);
                $cep_destino = $cliente->get_entrega_cep();
            }
            else
            {
                $endereco = new Model_ClienteEndereco($_SESSION['compra-endereco']);
                $cep_destino = $endereco->get_cep();
            }

            $forma_entrega = 'pac';
            if (isset($parametros->modo_entrega) AND !empty($parametros->modo_entrega))
            {
                $forma_entrega = Funcoes::mysqli_escape($parametros->modo_entrega);
            }
            else if (isset($_SESSION['forma_entrega']))
            {
                $forma_entrega = $_SESSION['forma_entrega'];
            }

            $_SESSION['forma_entrega'] = $forma_entrega;
        }
        else
        {
            $cep_destino = NULL;
            $produtos_frete = NULL;
        }

        //-----

		// Pegar o valor total do carrinho
		$valor_total = 0;
		if (count($carrinho) > 0)
		{
			foreach ($carrinho as $produto)
			{
				$valor_total += $produto->get_valor_original() * $produto->quantidade;

                if (!is_null($cep_destino))
                {
                    $produtos_frete[$produto->get_id()] = $frete->calcular($cep_destino, $produto->get_largura(), $produto->get_altura(), $produto->get_comprimento(), $produto->get_peso(), $forma_entrega);
                }
			}
		}


        $view->set_variavel('produtos_frete',$produtos_frete);

		$view->set_variavel('valor_total', $valor_total);

		//-----

        if (!isset($_SERVER['HTTP_REFERER'])) {
            if (!isset($_SESSION['anterior'])) {
                $anterior = SITE_URL;
            } else {
                $anterior = $_SESSION['anterior'];
            }
        } else {
            $anterior = $_SERVER['HTTP_REFERER'];
            $_SESSION['anterior'] = $anterior;
        }

		//-----

        $view->set_variavel('anterior', $anterior);

		$view->set_variavel('body_class', 'carrinho-compras');
		$view->set_variavel('notificacao', new Notificacao);

        $view->set_variavel('pagina_title', 'Carrinho de Compras');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/**
	 * Adicionamos um produto no carrinho, através do ID passado por parâmetro (quantidade pode vir também)
	 * @param $parametros
	 */
	public function adicionar($parametros)
	{
		if (isset($parametros->_0) AND is_numeric($parametros->_0))
		{
			$quantidade = (isset($parametros->quantidade) AND is_numeric($parametros->quantidade)) ? $parametros->quantidade : 1;

			if (isset($parametros->cor_id))
			{
				if ( ! empty($parametros->cor_id) AND is_numeric($parametros->cor_id))
				{
					$cor = $parametros->cor_id;
				}
				else
				{
					$n = new Notificacao('Você precisa especificar uma cor para o produto.', 'error', TRUE);
					header('Location: '.SITE_URL.'/carrinho');
					exit;
				}
			}
			else
			{
				// Verificamos se a cor é obrigatória para o produto em questão
				$cor_existe = new Model_ProdutoCor;
				$cor_existe = $cor_existe->select('SELECT id FROM {table_name} WHERE produto_id = "'.Funcoes::mysqli_escape($parametros->_0).'"', TRUE);
				if ($cor_existe AND count($cor_existe) > 0)
				{
					// Existem cores para o produto mas não veio nenhuma para o carrinho
					$n = new Notificacao('Você precisa especificar uma cor para o produto.', 'error', TRUE);
					header('Location: '.SITE_URL.'/carrinho');
					exit;
				}
				else
				{
					// Não é necessária cor
					$cor = NULL;
				}
			}

			//-----

			// Produto existe, está disponível e tem em estoque?
			$produto = new Model_Produto($parametros->_0);
			if ($produto AND ! is_null($produto->get_id()) AND $produto->get_disponivel() AND $produto->get_ativo() > 0)
			{
				// Verificamos se o "carrinho" existe
				if (isset($_SESSION['carrinho']) AND count($_SESSION['carrinho']) > 0)
				{
					// Percorremos o carrinho para ver se o produto está nele, se sim, adicionamos +1
					foreach ($_SESSION['carrinho'] as $produto_identificador=>$propriedades)
					{
						list($produto_id, $cor_id) = explode('-', $produto_identificador);

						if ($produto_id == $produto->get_id() AND $produto_identificador == $produto->get_id().'-'.$cor)
						{
							$_SESSION['carrinho'][$produto_identificador]['quantidade'] += $quantidade;
							// Sai do FOR se encontrar
							break;
						}
					}

					// Se não estiver no carrinho, adicionamos ele
					if ( ! isset($_SESSION['carrinho'][$produto->get_id().'-'.$cor]))
					{
						$_SESSION['carrinho'][$produto->get_id().'-'.$cor]['quantidade'] = $quantidade;
					}
				}
				else
				{
					$_SESSION['carrinho'][$produto->get_id().'-'.$cor]['quantidade'] = $quantidade;
				}

				// Para não deixar a quantidade passar de 9
				$_SESSION['carrinho'][$produto->get_id().'-'.$cor]['quantidade'] = min($_SESSION['carrinho'][$produto->get_id().'-'.$cor]['quantidade'], 9);

				// Vinculamos a cor se for o caso
				if ( ! is_null($cor))
				{
					$_SESSION['carrinho'][$produto->get_id().'-'.$cor]['cor'] = $cor;
				}

				header('Location: '.SITE_URL.'/carrinho');
				exit;
			}
			else
			{
				$n = new Notificacao('Produto não encontrado.', 'error', TRUE);
				header('Location: '.SITE_URL.'/carrinho');
				exit;
			}
		}
		else
		{
			$n = new Notificacao('Identificador de produto inválido.', 'error', TRUE);
			header('Location: '.SITE_URL.'/carrinho');
			exit;
		}
	}


	/**
	 * Atualizar a quantidade de um produto no carrinho
	 * @param $parametros
	 */
	public function atualizar($parametros)
	{
		if (isset($parametros->_0, $parametros->_1) AND is_numeric($parametros->_1))
		{
			$produto_identificador = $parametros->_0;
			$quantidade = $parametros->_1;
			if (isset($_SESSION['carrinho'][$produto_identificador]))
			{
				if ($quantidade > 0)
				{
					$_SESSION['carrinho'][$produto_identificador]['quantidade'] = $quantidade;
				}
				else
				{
					unset($_SESSION['carrinho'][$produto_identificador]);
				}
			}
		}

		header('Location: '.SITE_URL.'/carrinho');
		exit;
	}


	/**
	 * Remover um produto do carrinho
	 * @param $parametros
	 */
	public function remover($parametros)
	{
		if (isset($parametros->_0))
		{
			$produto_identificador = $parametros->_0;
			if (isset($_SESSION['carrinho'][$produto_identificador]))
			{
				unset($_SESSION['carrinho'][$produto_identificador]);
			}
		}

		header('Location: '.SITE_URL.'/carrinho');
		exit;
	}

    public function selecionar_endereco()
    {
        $this->verificar_cliente_logado();
        $view = new View('selecionar-endereco.php');
        $this->view_variaveis_obrigatorias($view);
        $anterior = SITE_URL.'/carrinho';
        $view->set_variavel('anterior', $anterior);
        $view->set_variavel('notificacao', new Notificacao());
        $view->set_variavel('body_class', 'cadastro');
        $enderecos = new Model_ClienteEndereco();
        $enderecos = $enderecos->select('SELECT * FROM {tabela_nome} WHERE cliente_id='.$_SESSION['cliente_id'], TRUE);
        if (!$enderecos)
        {
            $enderecos = array();
        }
        $view->set_variavel('enderecos', $enderecos);
        $view->set_variavel('anterior', $anterior);
        $view->exibir();
    }

    public function endereco_escolhido($parametros)
    {
        $this->verificar_cliente_logado();
        if (isset($parametros->endereco) and count($parametros->endereco) > 0)
        {
            $id = $parametros->endereco;
            if ($id == 'padrao')
            {
                $_SESSION['compra-endereco'] = 'cliente';
                $_SESSION['status-compra'] = TRUE;
                header('Location: '.SITE_URL.'/carrinho');
            }
            else if (is_numeric((int)$id))
            {
                $endereco = new Model_ClienteEndereco();
                $endereco = $endereco->select('SELECT * FROM {tabela_nome} WHERE id='.$id.' AND cliente_id='.$_SESSION['cliente_id']);
                if ($endereco)
                {
                    $_SESSION['status-compra'] = TRUE;
                    $_SESSION['compra-endereco'] = (int)$id;
                    header('Location: '.SITE_URL.'/carrinho');
                }
                else
                {
                    header('Location: '.SITE_URL);
                }
            }
            else
            {
                header('Location: '.SITE_URL);
            }
        }
        else
        {
            header('Location: '.SITE_URL);
        }
    }

    public function gerenciar_endereco($parametros)
    {
        $this->verificar_cliente_logado();
        if ($parametros)
        {
            $endereco1 = isset($parametros->endereco) and count($parametros->endereco)>0 ? $parametros->endereco : NULL;
            $numero = isset($parametros->numero) and count($parametros->numero)>0 ? $parametros->numero : NULL;
            $complemento = isset($parametros->complemento) and count($parametros->complemento)>0 ? $parametros->complemento : NULL;
            $cep1 = isset($parametros->cep1) and count($parametros->cep1)>0 ? $parametros->cep1 : NULL;
            $cep2 = isset($parametros->cep2) and count($parametros->cep2)>0 ? $parametros->cep2 : NULL;
            $cidade = isset($parametros->cidade) and count($parametros->cidade)>0 ? $parametros->cidade : NULL;
            $estado = isset($parametros->estado) and count($parametros->estado)>0 ? $parametros->estado : NULL;
            $bairro = isset($parametros->bairro) and count($parametros->bairro)>0 ? $parametros->bairro : NULL;
            $endereco_tipo = isset($parametros->tipo) and count($parametros->tipo)>0 ? $parametros->tipo : NULL;
            $referencia = isset($parametros->referencia) and count($parametros->referencia)>0 ? $parametros->referencia : NULL;

            if ($endereco1 AND !empty($endereco1) AND $numero AND !empty($numero) AND $cep1 AND !empty($cep1) AND $cep2 AND
                !empty($cep2) AND $cidade AND !empty($cidade) AND $estado AND !empty($estado) AND $bairro AND !empty($bairro)
                AND $endereco_tipo AND !empty($endereco_tipo))
            {

                if (is_numeric((int)$numero) AND is_numeric((int)$cep1) AND is_numeric((int)$cep2))
                {

                    if ($parametros->acao == 'inserir')
                    {
                        //É inserir
                        $endereco = new Model_ClienteEndereco();
                        $endereco->carregar($parametros);
                        $endereco->set_cliente_id($_SESSION['cliente_id']);
                        $endereco->set_cep($parametros->cep1.$parametros->cep2);
                        if ($endereco->insert())
                        {
                            $notificacao = new Notificacao('Endereço inserido com sucesso.', 'successo');
                        }
                    }
                    else
                    {
                        if ($parametros->id == 'padrao')
                        {
                            $endereco = new Model_Cliente($_SESSION['cliente_id']);
                            $endereco->set_entrega_endereco($parametros->endereco);
                            $endereco->set_entrega_numero($parametros->numero);
                            $endereco->set_entrega_complemento($parametros->complemento);
                            $endereco->set_entrega_bairro($parametros->bairro);
                            $endereco->set_entrega_cep($parametros->cep1.$parametros->cep2);
                            $endereco->set_entrega_cidade($parametros->cidade);
                            $endereco->set_entrega_estado($parametros->estado);
                            $endereco->set_entrega_endereco_tipo($parametros->tipo);
                            $endereco->set_entrega_referencia($parametros->referencia);
                        }
                        else
                        {
                            $endereco = new Model_ClienteEndereco();
                            $endereco->carregar($parametros);
                            $endereco->set_cliente_id($_SESSION['cliente_id']);
                            $endereco->set_cep($parametros->cep1.$parametros->cep2);
                        }
                        if ($endereco->update())
                        {
                            $notificacao = new Notificacao('Endereço atualizado com sucesso.', 'successo');
                        }
                    }
                }
            }
        }
        header('Location: '.SITE_URL.'/carrinho/selecionar_endereco');
    }

    public function carregar_endereco($parametros)
    {
        $this->verificar_cliente_logado();
        if (isset($parametros->id))
        {
            if ($parametros->id == 'padrao')
            {
                $cliente = new Model_Cliente($_SESSION['cliente_id']);
                echo json_encode(
                    array(
                        'endereco' => $cliente->get_entrega_endereco(),
                        'numero' => $cliente->get_entrega_numero(),
                        'complemento' => $cliente->get_entrega_complemento(),
                        'bairro' => $cliente->get_entrega_bairro(),
                        'cidade' => $cliente->get_entrega_cidade(),
                        'estado' => $cliente->get_entrega_estado(),
                        'cep' => $cliente->get_entrega_cep(),
                        'endereco_tipo' => $cliente->get_entrega_endereco_tipo(),
                        'referencia' => $cliente->get_entrega_referencia()
                    )
                );
            }
            else if(is_numeric((int)$parametros->id))
            {
                $endereco = new Model_ClienteEndereco();
                $endereco = $endereco->select('SELECT * FROM {tabela_nome} WHERE id='.$parametros->id.' AND cliente_id='.$_SESSION["cliente_id"]);
                if ($endereco AND $endereco->get_id() AND $endereco->get_id() > 0)
                {
                    echo json_encode(
                        array(
                            'endereco' => $endereco->get_endereco(),
                            'numero' => $endereco->get_numero(),
                            'complemento' => $endereco->get_complemento(),
                            'bairro' => $endereco->get_bairro(),
                            'cidade' => $endereco->get_cidade(),
                            'estado' => $endereco->get_estado(),
                            'cep' => $endereco->get_cep(),
                            'endereco_tipo' => $endereco->get_tipo(),
                            'referencia' => $endereco->get_referencia()
                        )
                    );
                }
            }

        }
    }

    public function remover_endereco($parametros)
    {
        $this->verificar_cliente_logado();
        if (isset($parametros->id))
        {
            $endereco = new Model_ClienteEndereco();
            $endereco = $endereco->select('SELECT * FROM {tabela_nome} WHERE id='.$parametros->id.' AND cliente_id='.$_SESSION["cliente_id"]);
            $endereco->delete();
        }
    }

	/* ***************************** MÉTODOS EXTRAS ***************************** */
	

} // end class