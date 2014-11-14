<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_AreaCliente extends Controller_Padrao
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
        $this->verificar_cliente_logado();

		//-----

		if (isset($_SESSION['redirecionar']))
		{
			unset($_SESSION['redirecionar']);
		}

        $view = new View('area-cliente.php');
		$this->view_variaveis_obrigatorias($view);

		$view->set_variavel('cliente', $this->get_cliente());

		$view->set_variavel('body_class', 'area-cliente');
		$view->set_variavel('notificacao', new Notificacao);

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

        $view->set_variavel('anterior', $anterior);

        $view->set_variavel('pagina_title', 'Área do Cliente');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/**
	 * Método que cuida da apresentação do formulário e e do cadastro do cliente no banco de dados
	 * @param $parametros
	 * @return void
	 */
	public function cadastro($parametros)
	{
        $view = new View('cadastro.php');
		$this->view_variaveis_obrigatorias($view);



		if (isset($parametros->email) AND ! empty($parametros->email))
		{
			$cliente = new Model_Cliente;
			$cliente->carregar($parametros);

			//-----

			// Ajeitamos os parâmetros "especiais"

			$cliente->set_telefone_principal(Funcoes::mysqli_escape($parametros->ddd_principal.$parametros->tel_principal));
			if ( ! empty($parametros->tel_celular))
			{
				$cliente->set_telefone_celular(Funcoes::mysqli_escape($parametros->ddd_celular.$parametros->tel_celular));
			}
			if ( ! empty($parametros->tel_comercial))
			{
				$cliente->set_telefone_comercial(Funcoes::mysqli_escape($parametros->ddd_comercial.$parametros->tel_comercial));
			}

			//-----

			// Validações

			if (empty($parametros->senha) OR is_null($cliente->get_senha()) OR sha1($cliente->get_senha()) != sha1($parametros->confirma_senha))
			{
				$notificacao = new Notificacao('Senhas digitadas não conferem.');
			}

			list($dia, $mes, $ano) = explode('/', $parametros->nascimento);
			if ( ! is_numeric($dia) OR ! is_numeric($mes) OR ! is_numeric($ano) OR ! checkdate($mes, $dia, $ano))
			{
				$notificacao = new Notificacao('Data de nascimento inválida.');
				$cliente->set_nascimento(NULL);
			}

			if ( ! filter_var($cliente->get_email(), FILTER_VALIDATE_EMAIL))
			{
				$notificacao = new Notificacao('Endereço de e-mail inválido.');
			}

			if ($parametros->pessoa_tipo == 'juridica')
			{
				if ( ! Funcoes::cpf_validar($cliente->get_responsavel_cpf()))
				{
					$notificacao = new Notificacao('CPF do responsável inválido.');
				}

				if ( ! Funcoes::cnpj_validar($cliente->get_cnpj()))
				{
					$notificacao = new Notificacao('CNPJ inválido.');
				}
			}
			else
			{
				if ( ! Funcoes::cpf_validar($cliente->get_cpf()))
				{
					$notificacao = new Notificacao('CPF inválido.');
				}
			}

			if (strlen(trim($parametros->senha)) < 6)
			{
				$notificacao = new Notificacao('A senha deve ter no mínimo 6 caracteres.');
			}

			if ((empty($parametros->ddd_principal) OR ! is_numeric($parametros->ddd_principal)) OR (empty($parametros->tel_principal) OR ! is_numeric($parametros->tel_principal)))
			{
				$notificacao = new Notificacao('Telefone principal inválido.');
			}

			if (( ! empty($parametros->ddd_celular) AND ! is_numeric($parametros->ddd_celular)) OR ( ! empty($parametros->tel_celular) AND ! is_numeric($parametros->tel_celular)))
			{
				$notificacao = new Notificacao('Telefone celular inválido.');
			}

			if (( ! empty($parametros->ddd_comcercial) AND ! is_numeric($parametros->ddd_comcercial)) OR ( ! empty($parametros->tel_comercial) AND ! is_numeric($parametros->tel_comercial)))
			{
				$notificacao = new Notificacao('Telefone celular inválido.');
			}

			$cliente_existe = new Model_Cliente;
			$cliente_existe = $cliente_existe->select('
				SELECT id, email, cpf, cnpj, responsavel_cpf FROM {tabela_nome}
				WHERE email = "'.Funcoes::mysqli_escape($cliente->get_email()).'" OR cpf = "'.Funcoes::mysqli_escape($cliente->get_cpf()).'" OR
						cnpj = "'.Funcoes::mysqli_escape($cliente->get_cnpj()).'" OR responsavel_cpf = "'.Funcoes::mysqli_escape($cliente->get_responsavel_cpf()).'"');

			if ($cliente_existe AND ! is_null($cliente_existe->get_id()))
			{
				if ($cliente->get_email() == $cliente_existe->get_email())
				{
					$notificacao = new Notificacao('O endereço de e-mail informado já está cadastrado. Por favor utilize outro.');
				}
				if (str_pad($cliente->get_cnpj(), 14, 0, STR_PAD_LEFT) == $cliente_existe->get_cnpj())
				{
					$notificacao = new Notificacao('O CNPJ informado já está cadastrado. Por favor utilize outro.');
				}
				if (str_pad($cliente->get_cpf(), 11, 0, STR_PAD_LEFT) == $cliente_existe->get_cpf())
				{
					$notificacao = new Notificacao('O CPF informado já está cadastrado. Por favor informe outro.');
				}
				if (str_pad($cliente->get_responsavel_cpf(), 11, 0, STR_PAD_LEFT) == $cliente_existe->get_responsavel_cpf())
				{
					$notificacao = new Notificacao('O CPF do responsável informado já está cadastrado. Por favor informe outro.');
				}
			}

			// Fim das validações

			//-----

			if ( ! isset($notificacao))
			{
				// salva os dados e vai para a próxima página
				$_SESSION['cliente'] = $cliente;
				header('Location: '.SITE_URL.'/area-cliente/cadastro-endereco');
				exit;
			}
		}
		else
		{
			// Podemos estar voltando do formulário de endereço
			if (isset($_SESSION['cliente']) AND ! is_null($_SESSION['cliente']->get_email()))
			{
				$cliente = $_SESSION['cliente'];
			}
		}

		//-----
		$view->set_variavel('body_class', 'cadastro');

		$view->set_variavel('notificacao', isset($notificacao) ? $notificacao : new Notificacao);

		$view->set_variavel('cliente', isset($cliente) ? $cliente : NULL);
		$view->set_variavel('pessoa_tipo', (isset($cliente) AND ! empty($parametros->pessoa_tipo)) ? $parametros->pessoa_tipo : 'fisica');

        $view->set_variavel('pagina_title', 'Dados Cadastrais - Cadastro - Área do Cliente');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

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

        $view->set_variavel('anterior', $anterior);
		$view->exibir();
	}


	/**
	 * Método que cuida da apresentação do formulário e e do cadastro do cliente no banco de dados
	 * @param $parametros
	 * @return void
	 */
	public function cadastro_endereco($parametros)
	{
		// Só é possível entrar aqui se a session estiver definida
		if (isset($_SESSION['cliente']) AND ! is_null($_SESSION['cliente']->get_email()))
		{
			$view = new View('cadastro-endereco.php');
			$this->view_variaveis_obrigatorias($view);

			//-----

			if (isset($parametros->entrega_endereco) AND ! empty($parametros->entrega_endereco))
			{
				$cliente = new Model_Cliente;
				$cliente->carregar($parametros);

				//-----

				// Ajeitamos os parâmetros "especiais"

				if (is_numeric($parametros->entrega_cep_1) AND is_numeric($parametros->entrega_cep_2))
				{
					$cliente->set_entrega_cep(Funcoes::mysqli_escape(substr($parametros->entrega_cep_1.$parametros->entrega_cep_2, 0, 8)));
				}

				//-----

				// Validações

				if ( ! is_numeric($parametros->entrega_numero))
				{
					$notificacao = new Notificacao('Número do endereço é inválido.');
				}

				// Fim das validações

				if ( ! isset($notificacao))
				{
					// Salvamos o objeto atual caso a página seja recarregada em outro momento
					$_SESSION['cliente_endereco'] = $cliente;

					// Aqui juntamos a SESSION com este formulário
					$cliente->set_nome($_SESSION['cliente']->get_nome());
					$cliente->set_email($_SESSION['cliente']->get_email());
					$cliente->set_senha(sha1($_SESSION['cliente']->get_senha()));
					$cliente->set_cpf($_SESSION['cliente']->get_cpf());
					$cliente->set_razao_social($_SESSION['cliente']->get_razao_social());
					$cliente->set_cnpj($_SESSION['cliente']->get_cnpj());
					$cliente->set_responsavel_nome($_SESSION['cliente']->get_responsavel_nome());
					$cliente->set_responsavel_cpf($_SESSION['cliente']->get_responsavel_cpf());
					$cliente->set_telefone_principal($_SESSION['cliente']->get_telefone_principal());
					$cliente->set_telefone_celular($_SESSION['cliente']->get_telefone_celular());
					$cliente->set_telefone_comercial($_SESSION['cliente']->get_telefone_comercial());
					$cliente->set_apelido($_SESSION['cliente']->get_apelido());
					$cliente->set_genero($_SESSION['cliente']->get_genero());
					$cliente->set_nascimento($_SESSION['cliente']->get_nascimento());
					$cliente->set_cadastro_data(date('Y-m-d'));
					$cliente->set_ativo(TRUE);

					// Última validação

					if ( ! is_null($cliente->get_nome()) AND ! is_null($cliente->get_email()) AND ! is_null($cliente->get_senha()) AND
							(
								( ! is_null($cliente->get_cpf()) AND ! is_null($cliente->get_nome())) OR
								( ! is_null($cliente->get_razao_social()) AND ! is_null($cliente->get_cnpj()) AND ! is_null($cliente->get_responsavel_nome()) AND ! is_null($cliente->get_responsavel_cpf()))
							)
					)
					{
						if ( ! is_null($cliente->get_entrega_cep()) AND ! is_null($cliente->get_entrega_endereco_tipo()) AND ! is_null($cliente->get_entrega_endereco()) AND
								! is_null($cliente->get_entrega_numero()) AND ! is_null($cliente->get_entrega_bairro()) AND ! is_null($cliente->get_entrega_cidade()) AND
								! is_null($cliente->get_entrega_estado()) )
						{
							// Inserimos no banco de dados
							if ($cliente->insert())
							{
								unset($_SESSION['cliente']);
								unset($_SESSION['cliente_endereco']);

								$_SESSION['cliente_id'] = $cliente->get_id();
								
								$mail = new Controller_Email;

								if ($mail->boas_vindas($cliente))
								{
									//echo json_encode(array('tipo'=>'sucesso', 'mensagem'=>'Sua mensagem foi enviada com sucesso!'));
									$notificacao = new Notificacao('Cadastro efetuado com sucesso.');
								}

								if (isset($_SESSION['redirecionar']))
								{
									header('Location: '.$_SESSION['redirecionar']);
									unset($_SESSION['redirecionar']);
								}
								else
								{
									header('Location: '.SITE_URL.'/area-cliente');
								}
								exit;
							}
							else
							{
								$notificacao = new Notificacao('Ocorreu um erro ao cadastrar seus dados.');
							}
						}
						else
						{
							$notificacao = new Notificacao('Todos os campos marcados são obrigatórios.');
						}
					}
					else
					{
						$n = new Notificacao('Todos os campos marcados são obrigatórios.', 'error', TRUE);
						header('Location: '.SITE_URL.'/area-cliente/cadastro/#form_cadastro_notification');
						exit();
					}
				}
			}

			//-----

			$view->set_variavel('body_class', 'cadastro');
			$view->set_variavel('notificacao', isset($notificacao) ? $notificacao : new Notificacao);

			// Se houver dados no $cliente, retorna automaticamente
			$view->set_variavel('cliente', isset($cliente) ? $cliente : NULL);

	        $view->set_variavel('pagina_title', 'Endereço - Cadastro');
	        $view->set_variavel('pagina_description', '');
	        $view->set_variavel('pagina_keywords', '');

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

            $view->set_variavel('anterior', $anterior);
						
			$view->exibir();
		}
		else
		{
			$n = new Notificacao('Não é possível acessar esta página.', 'error', TRUE);
			header('Location: '.SITE_URL.'/area-cliente/cadastro');
			exit();
		}
	}


	/**
	 * Login do cliente
	 * @param $parametros
	 * @return void
	 */
	public function login($parametros)
	{
		// Retorno sempre '0' ou '1', sem a necessidade de json_encode

		if (isset($parametros->email) AND isset($parametros->senha))
		{
			$cliente = new Model_Cliente;
			$cliente = $cliente->select('SELECT id FROM {tabela_nome} WHERE email = "'.Funcoes::mysqli_escape(trim($parametros->email)).'" AND senha = "'.Funcoes::mysqli_escape(sha1($parametros->senha)).'" AND ativo = 1');
			if ($cliente AND ! is_null($cliente->get_id()))
			{
                $_SESSION['cliente_id'] = $cliente->get_id();

                if (isset($_SESSION['compra-login']))
                {
                    unset($_SESSION['compra-login']);
                   echo '2';
                }
                else
                {
                    echo '1';
                }
				exit;
			}
		}

		echo '0';
		exit;
	}


	/**
	 *
	 * @param $parametros
	 */
	public function alterar_email($parametros)
	{
		$this->verificar_cliente_logado();

		//-----

		$view = new View('alterar-email.php');
		$this->view_variaveis_obrigatorias($view);

		$email = $novo_email = '';

		if (isset($parametros->email, $parametros->novo_email, $parametros->senha))
		{
			$email = trim($parametros->email);
			$novo_email = trim($parametros->novo_email);

			if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				if (filter_var($novo_email, FILTER_VALIDATE_EMAIL))
				{
					$cliente = new Model_Cliente;
					$cliente = $cliente->select('
						SELECT id
						FROM {tabela_nome}
						WHERE email = "'.Funcoes::mysqli_escape($email).'" AND
								senha = "'.sha1($parametros->senha).'" AND
								id = "'.$this->get_cliente()->get_id().'"
					');
					if ($cliente AND ! is_null($cliente->get_id()))
					{
						$cliente->set_email(Funcoes::mysqli_escape(strtolower($novo_email)));

						if ($cliente->update())
						{
							$notificacao = new Notificacao('E-mail alterado com sucesso.', 'sucesso');
							$email = $novo_email = '';
						}
						else
						{
							$notificacao = new Notificacao('Ocorreu um erro ao atualizar seu endereço de e-mail.', 'erro');
						}
					}
					else
					{
						$notificacao = new Notificacao('E-mail atual ou senha inválidos.', 'erro');
					}
				}
				else
				{
					$notificacao = new Notificacao('Novo e-mail inválido.', 'erro');
				}
			}
			else
			{
				$notificacao = new Notificacao('E-mail atual inválido.', 'erro');
			}
		}

		$view->set_variavel('body_class', 'alterar-email');
		$view->set_variavel('notificacao', isset($notificacao) ? $notificacao : new Notificacao);

		$view->set_variavel('email', $email);
		$view->set_variavel('novo_email', $novo_email);

        $view->set_variavel('pagina_title', 'Alterar E-mail - Área do Cliente');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/**
	 * Método que cuida da apresentação do formulário e e do cadastro do cliente no banco de dados
	 * @param $parametros
	 * @return void
	 */
	public function alterar_meus_dados($parametros)
	{
		$this->verificar_cliente_logado();

		//-----

        $view = new View('alterar-meus-dados.php');
		$this->view_variaveis_obrigatorias($view);

		if (isset($parametros->email) AND ! empty($parametros->email))
		{
			$cliente = new Model_Cliente;
			$cliente->carregar($parametros);

			//-----

			// Ajeitamos os parâmetros "especiais"

			$cliente->set_telefone_principal(Funcoes::mysqli_escape($parametros->ddd_principal.$parametros->tel_principal));
			if ( ! empty($parametros->tel_celular))
			{
				$cliente->set_telefone_celular(Funcoes::mysqli_escape($parametros->ddd_celular.$parametros->tel_celular));
			}
			if ( ! empty($parametros->tel_comercial))
			{
				$cliente->set_telefone_comercial(Funcoes::mysqli_escape($parametros->ddd_comercial.$parametros->tel_comercial));
			}

			//-----

			// Validações

			/*if (empty($parametros->senha) OR is_null($cliente->get_senha()) OR sha1($cliente->get_senha()) != sha1($parametros->confirma_senha))
			{
				$notificacao = new Notificacao('Senhas digitadas não conferem.');
			}*/

			list($dia, $mes, $ano) = explode('/', $parametros->nascimento);
			if ( ! is_numeric($dia) OR ! is_numeric($mes) OR ! is_numeric($ano) OR ! checkdate($mes, $dia, $ano))
			{
				$notificacao = new Notificacao('Data de nascimento inválida.');
				$cliente->set_nascimento(NULL);
			}

			if ( ! filter_var($cliente->get_email(), FILTER_VALIDATE_EMAIL))
			{
				$notificacao = new Notificacao('Endereço de e-mail inválido.');
			}

			if ($parametros->pessoa_tipo == 'juridica')
			{
				if ( ! Funcoes::cpf_validar($cliente->get_responsavel_cpf()))
				{
					$notificacao = new Notificacao('CPF do responsável inválido.');
				}

				if ( ! Funcoes::cnpj_validar($cliente->get_cnpj()))
				{
					$notificacao = new Notificacao('CNPJ inválido.');
				}
			}
			else
			{
				if ( ! Funcoes::cpf_validar($cliente->get_cpf()))
				{
					$notificacao = new Notificacao('CPF inválido.');
				}
			}

			if ((empty($parametros->ddd_principal) OR ! is_numeric($parametros->ddd_principal)) OR (empty($parametros->tel_principal) OR ! is_numeric($parametros->tel_principal)))
			{
				$notificacao = new Notificacao('Telefone principal inválido.');
			}

			if (( ! empty($parametros->ddd_celular) AND ! is_numeric($parametros->ddd_celular)) OR ( ! empty($parametros->tel_celular) AND ! is_numeric($parametros->tel_celular)))
			{
				$notificacao = new Notificacao('Telefone celular inválido.');
			}

			if (( ! empty($parametros->ddd_comcercial) AND ! is_numeric($parametros->ddd_comcercial)) OR ( ! empty($parametros->tel_comercial) AND ! is_numeric($parametros->tel_comercial)))
			{
				$notificacao = new Notificacao('Telefone celular inválido.');
			}

			$cliente_existe = new Model_Cliente;
			$cliente_existe = $cliente_existe->select('
				SELECT id, email, cpf, cnpj, responsavel_cpf FROM {tabela_nome}
				WHERE (email = "'.Funcoes::mysqli_escape($cliente->get_email()).'" OR cpf = "'.Funcoes::mysqli_escape($cliente->get_cpf()).'" OR
						cnpj = "'.Funcoes::mysqli_escape($cliente->get_cnpj()).'" OR responsavel_cpf = "'.Funcoes::mysqli_escape($cliente->get_responsavel_cpf()).'") AND
						id != "'.$this->get_cliente()->get_id().'"');

			if ($cliente_existe AND ! is_null($cliente_existe->get_id()))
			{
				if ($cliente->get_email() == $cliente_existe->get_email())
				{
					$notificacao = new Notificacao('O endereço de e-mail informado já está cadastrado. Por favor utilize outro.');
				}
				if (str_pad($cliente->get_cnpj(), 14, 0, STR_PAD_LEFT) == $cliente_existe->get_cnpj())
				{
					$notificacao = new Notificacao('O CNPJ informado já está cadastrado. Por favor utilize outro.');
				}
				if (str_pad($cliente->get_cpf(), 11, 0, STR_PAD_LEFT) == $cliente_existe->get_cpf())
				{
					$notificacao = new Notificacao('O CPF informado já está cadastrado. Por favor informe outro.');
				}
				if (str_pad($cliente->get_responsavel_cpf(), 11, 0, STR_PAD_LEFT) == $cliente_existe->get_responsavel_cpf())
				{
					$notificacao = new Notificacao('O CPF do responsável informado já está cadastrado. Por favor informe outro.');
				}
			}

			// Fim das validações

			//-----

			if ( ! isset($notificacao))
			{
				// salva os dados e vai para a próxima página
				$_SESSION['cliente'] = $cliente;
				header('Location: '.SITE_URL.'/area-cliente/alterar-endereco');
				exit;
			}
		}
		else
		{
			// Podemos estar voltando do formulário de endereço
			if (isset($_SESSION['cliente']) AND ! is_null($_SESSION['cliente']->get_email()))
			{
				$cliente = $_SESSION['cliente'];
			}
			else
			{
				$cliente = $this->get_cliente();
			}
		}

		//-----

		$view->set_variavel('body_class', 'cadastro');

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

        $view->set_variavel('anterior', $anterior);

		$view->set_variavel('notificacao', isset($notificacao) ? $notificacao : new Notificacao);

		$view->set_variavel('cliente', isset($cliente) ? $cliente : NULL);
		$view->set_variavel('pessoa_tipo', (isset($cliente) AND ! empty($parametros->pessoa_tipo)) ? $parametros->pessoa_tipo : 'fisica');

        $view->set_variavel('pagina_title', 'Alterar Meus Dados Cadastrais - Área do Cliente');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/**
	 * Método que cuida da apresentação do formulário e e do cadastro do cliente no banco de dados
	 * @param $parametros
	 * @return void
	 */
	public function alterar_endereco($parametros)
	{
		$this->verificar_cliente_logado();

		//-----

		// Só é possível entrar aqui se a session estiver definida
		if (isset($_SESSION['cliente']) AND ! is_null($_SESSION['cliente']->get_email()))
		{
			$view = new View('alterar-endereco.php');
			$this->view_variaveis_obrigatorias($view);

			//-----

			if (isset($parametros->entrega_endereco) AND ! empty($parametros->entrega_endereco))
			{
				$cliente = new Model_Cliente;
				$cliente->carregar($parametros);

				//-----

				// Ajeitamos os parâmetros "especiais"

				if (is_numeric($parametros->entrega_cep_1) AND is_numeric($parametros->entrega_cep_2))
				{
					$cliente->set_entrega_cep(Funcoes::mysqli_escape(substr($parametros->entrega_cep_1.$parametros->entrega_cep_2, 0, 8)));
				}

				//-----

				// Validações

				if ( ! is_numeric($parametros->entrega_numero))
				{
					$notificacao = new Notificacao('Número do endereço é inválido.');
				}

				// Fim das validações

				if ( ! isset($notificacao))
				{
					// Salvamos o objeto atual caso a página seja recarregada em outro momento
					$_SESSION['cliente_endereco'] = $cliente;

					// Aqui juntamos a SESSION com este formulário
					$cliente->set_id($this->get_cliente()->get_id());
					$cliente->set_nome($_SESSION['cliente']->get_nome());
					$cliente->set_email($_SESSION['cliente']->get_email());
					$cliente->set_cpf($_SESSION['cliente']->get_cpf());
					$cliente->set_razao_social($_SESSION['cliente']->get_razao_social());
					$cliente->set_cnpj($_SESSION['cliente']->get_cnpj());
					$cliente->set_responsavel_nome($_SESSION['cliente']->get_responsavel_nome());
					$cliente->set_responsavel_cpf($_SESSION['cliente']->get_responsavel_cpf());
					$cliente->set_telefone_principal($_SESSION['cliente']->get_telefone_principal());
					$cliente->set_telefone_celular($_SESSION['cliente']->get_telefone_celular());
					$cliente->set_telefone_comercial($_SESSION['cliente']->get_telefone_comercial());
					$cliente->set_apelido($_SESSION['cliente']->get_apelido());
					$cliente->set_genero($_SESSION['cliente']->get_genero());
					$cliente->set_nascimento($_SESSION['cliente']->get_nascimento());

					// Última validação

					if ( ! is_null($cliente->get_nome()) AND ! is_null($cliente->get_email()) AND
							(
								( ! is_null($cliente->get_cpf()) AND ! is_null($cliente->get_nome())) OR
								( ! is_null($cliente->get_razao_social()) AND ! is_null($cliente->get_cnpj()) AND ! is_null($cliente->get_responsavel_nome()) AND ! is_null($cliente->get_responsavel_cpf()))
							)
					)
					{
						if ( ! is_null($cliente->get_entrega_cep()) AND ! is_null($cliente->get_entrega_endereco_tipo()) AND ! is_null($cliente->get_entrega_endereco()) AND
								! is_null($cliente->get_entrega_numero()) AND ! is_null($cliente->get_entrega_bairro()) AND ! is_null($cliente->get_entrega_cidade()) AND
								! is_null($cliente->get_entrega_estado()) )
						{
							// Inserimos no banco de dados
							if ($cliente->update())
							{
								unset($_SESSION['cliente']);
								unset($_SESSION['cliente_endereco']);

								$n = new Notificacao('Seus dados foram alterados com sucesso.', 'sucesso', TRUE);
								header('Location: '.SITE_URL.'/area-cliente');
								exit;
							}
							else
							{
								$notificacao = new Notificacao('Ocorreu um erro ao cadastrar seus dados.');
							}
						}
						else
						{
							$notificacao = new Notificacao('Todos os campos marcados são obrigatórios.');
						}
					}
					else
					{
						$n = new Notificacao('Todos os campos marcados são obrigatórios.', 'error', TRUE);
						header('Location: '.SITE_URL.'/area-cliente/alterar-meus-dados/#form_cadastro_notification');
						exit();
					}
				}
			}
			else
			{
				$cliente = $this->get_cliente();
			}

			//-----

			$view->set_variavel('body_class', 'cadastro');
			$view->set_variavel('notificacao', isset($notificacao) ? $notificacao : new Notificacao);

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


            $view->set_variavel('anterior', $anterior);

			// Se houver dados no $cliente, retorna automaticamente
			$view->set_variavel('cliente', isset($cliente) ? $cliente : NULL);

	        $view->set_variavel('pagina_title', 'Alterar Meus Dados Cadastrais - Área do Cliente');
	        $view->set_variavel('pagina_description', '');
	        $view->set_variavel('pagina_keywords', '');

			$view->exibir();
		}
		else
		{
			$n = new Notificacao('Não foi possível acessar esta página.', 'error', TRUE);
			header('Location: '.SITE_URL.'/area-cliente/alterar-meus-dados');
			exit();
		}
	}


	public function alterar_senha($parametros)
	{
		$this->verificar_cliente_logado();

		//-----

		$view = new View('alterar-senha.php');
		$this->view_variaveis_obrigatorias($view);

		$senha = $nova_senha = $email = '';

		if (isset($parametros->senha, $parametros->nova_senha, $parametros->email))
		{
			$email = trim($parametros->email);
			$senha = sha1($parametros->senha);
			$nova_senha = sha1($parametros->nova_senha);

			if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				if ($senha != $nova_senha)
				{
					if (strlen(trim($parametros->nova_senha)) >= 6)
					{
						$cliente = new Model_Cliente;
						$cliente = $cliente->select('
							SELECT id
							FROM {tabela_nome}
							WHERE email = "'.Funcoes::mysqli_escape($email).'" AND
									senha = "'.$senha.'" AND
									id = "'.$this->get_cliente()->get_id().'"
						');
						if ($cliente AND ! is_null($cliente->get_id()))
						{
							$cliente->set_senha($nova_senha);

							if ($cliente->update())
							{
								$notificacao = new Notificacao('Senha alterada com sucesso.', 'sucesso');
								$senha = $nova_senha = $email = '';
							}
							else
							{
								$notificacao = new Notificacao('Ocorreu um erro ao atualizar sua senha.', 'erro');
							}
						}
						else
						{
							$notificacao = new Notificacao('E-mail ou senha inválidos.', 'erro');
						}
					}
					else
					{
						$notificacao = new Notificacao('A nova senha deve ter no mínimo 6 caracteres.', 'erro');
					}
				}
				else
				{
					$notificacao = new Notificacao('A nova senha não pode ser igual à atual.', 'erro');
				}
			}
			else
			{
				$notificacao = new Notificacao('E-mail inválido.', 'erro');
			}
		}

		$view->set_variavel('body_class', 'alterar-senha');
		$view->set_variavel('notificacao', isset($notificacao) ? $notificacao : new Notificacao);

		$view->set_variavel('email', $email);

        $view->set_variavel('pagina_title', 'Alterar a Senha - Área do Cliente');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/**
	 * Método que exibe a lista de pedidos/compras do cliente
	 * @param $parametros
	 */
	public function consultar_pedidos($parametros)
	{
		$this->verificar_cliente_logado();

		//-----

		$view = new View('consultar-pedidos.php');
		$this->view_variaveis_obrigatorias($view);

		//-----

		$clausula_where = '';
		if (isset($parametros->filtro) AND ! empty($parametros->filtro))
		{
			switch (trim($parametros->filtro))
			{
				case 'abertos' :
					$clausula_where = ' AND (transacao_status.status = 1 OR transacao_status.status = 2) ';
					break;

				case 'numero' :
					$clausula_where = ' AND ( CONVERT(compra.codigo, CHAR) LIKE "%'.Funcoes::mysqli_escape($parametros->numero_pedido).'%" OR pagseguro.identificador LIKE "%'.Funcoes::mysqli_escape($parametros->numero_pedido).'%" )';
					$view->set_variavel('numero_pedido', $parametros->numero_pedido);
					break;

				case 'data' :
					$mes_inicial = ! empty($parametros->mes_inicial) ? Funcoes::mysqli_escape(trim($parametros->mes_inicial)) : 1;
					$ano_inicial = ! empty($parametros->ano_inicial) ? Funcoes::mysqli_escape(trim($parametros->ano_inicial)) : 2012;
					$mes_final = ! empty($parametros->mes_final) ? Funcoes::mysqli_escape(trim($parametros->mes_final)) : 12;
					$ano_final = ! empty($parametros->ano_final) ? Funcoes::mysqli_escape(trim($parametros->ano_final)) : date('Y');

					$time_inicial = mktime(0,0,0,$mes_inicial,1,$ano_inicial);
					$time_final = strtotime('-1 second', strtotime('+1 month', mktime(0,0,0,$mes_final,1,$ano_final)));

					if ($time_inicial)
					{
						$clausula_where .= ' AND compra.data >= "'.date('Y-m-d H:i:s', $time_inicial).'" ';
					}
					if ($time_final)
					{
						$clausula_where .= ' AND compra.data <= "'.date('Y-m-d H:i:s', $time_final).'" ';
					}

					$view->set_variavel('mes_inicial', $mes_inicial);
					$view->set_variavel('ano_inicial', $ano_inicial);
					$view->set_variavel('mes_final', $mes_final);
					$view->set_variavel('ano_final', $ano_final);
					break;

				case 'todos' :
				default :
					$clausula_where = '';
					break;
			}
			$view->set_variavel('filtro', trim($parametros->filtro));
		}

		//-----

		// Busca as compras do Cliente (a mesma função que está no controller do cliente no FatorCMS)
		$compra = new Model_Compra;
		// A subquery na tabela do PagSeguro é para trazer as transações na ordem que queremos, assim conseguimos pegar o último status da transação,
		// através do GROUP BY. Se não utilizamos a subquery, o GROUP BY usa a primeira ocorrência da transação, que é o primeiro registro inserido
		// na tabela
		$compras = $compra->select('
			SELECT compra.*, pagseguro.identificador, transacao_status.status, pagamento_tipo.tipo, pagamento_codigo.nome
			FROM {tabela_nome} AS compra
				LEFT JOIN (SELECT * FROM
						(SELECT * FROM fd_pagseguro ORDER BY DATA DESC) AS pagseguro_aux GROUP BY identificador
					) AS pagseguro ON pagseguro.compra_id = compra.id
				LEFT JOIN {tabela_prefixo}pagseguro_transacao_status AS transacao_status ON pagseguro.transacao_status_id = transacao_status.id
				LEFT JOIN {tabela_prefixo}pagseguro_pagamento_tipos AS pagamento_tipo ON pagseguro.pagamento_tipo_id = pagamento_tipo.id
				LEFT JOIN {tabela_prefixo}pagseguro_pagamento_codigos AS pagamento_codigo ON pagseguro.pagamento_codigo_id = pagamento_codigo.id
			WHERE compra.cliente_id = "'.Funcoes::mysqli_escape($this->get_cliente()->get_id()).'" AND pagseguro.identificador IS NOT NULL
				'.$clausula_where.'
			GROUP BY compra.id
			ORDER BY compra.quando DESC
		', TRUE);

		$view->set_variavel('compras', $compras);

		//-----

		$view->set_variavel('body_class', 'consultar-pedidos');
		$view->set_variavel('notificacao', new Notificacao);

        $view->set_variavel('pagina_title', 'Consultar Pedidos');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/**
	 * Método que exibe as informações de um pedido específico.
	 * @param $parametros
	 */
	public function pedido($parametros)
	{
		$this->verificar_cliente_logado();

		//-----

		$view = new View('pedido.php');
		$this->view_variaveis_obrigatorias($view);

		//-----

		if (isset($parametros->_0) AND is_numeric($parametros->_0))
		{
			$compra_id = Funcoes::mysqli_escape(trim($parametros->_0));

			// Carrega as informações da compra
			$compra = new Model_Compra();
			$compra = $compra->select('
				SELECT compra.*, cliente.nome AS cliente_nome, pagseguro.identificador, transacao_status.status,
					pagamento_tipo.tipo AS tipo_pagamento, pagamento_codigo.nome AS meio_pagamento
				FROM {tabela_nome} AS compra
					LEFT JOIN (SELECT * FROM
						(SELECT * FROM fd_pagseguro ORDER BY DATA DESC) AS pagseguro_aux GROUP BY identificador
					) AS pagseguro ON pagseguro.compra_id = compra.id
					LEFT JOIN {tabela_prefixo}clientes AS cliente ON compra.cliente_id = cliente.id
					LEFT JOIN {tabela_prefixo}pagseguro_transacao_status AS transacao_status ON pagseguro.transacao_status_id = transacao_status.id
					LEFT JOIN {tabela_prefixo}pagseguro_pagamento_tipos AS pagamento_tipo ON pagseguro.pagamento_tipo_id = pagamento_tipo.id
					LEFT JOIN {tabela_prefixo}pagseguro_pagamento_codigos AS pagamento_codigo ON pagseguro.pagamento_codigo_id = pagamento_codigo.id
				WHERE compra.id = '.$compra_id.'
				GROUP BY compra.id
			');

			$view->set_variavel('compra', $compra);

			if ($compra AND ! is_null($compra->get_id()))
			{
				// Busca os produtos da compra
				$produto = new Model_CompraProduto;
				$produtos = $produto->select('
					SELECT produto.id, produto.nome, compra_produto.quantidade, compra_produto.valor_unitario,
						categoria.nome AS categoria_nome, cor.nome AS cor_nome
					FROM {tabela_nome} AS compra_produto
						LEFT JOIN {tabela_prefixo}produtos AS produto ON compra_produto.produto_id = produto.id
						LEFT JOIN {tabela_prefixo}categorias AS categoria ON produto.categoria_id = categoria.id
						LEFT JOIN {tabela_prefixo}produtos_cores AS cor ON compra_produto.cor_id = cor.id
					WHERE compra_produto.compra_id = '.$compra->get_id().'
					ORDER BY produto.nome
				', TRUE);
				$view->set_variavel('produtos', $produtos);

                $compra_endereco = new Model_CompraEndereco();
                $compra_endereco = $compra_endereco->select('SELECT * FROM {tabela_nome} WHERE compra_id='.$compra->get_id());
                if (!$compra_endereco)
                {
                    $compra_endereco = new Model_CompraEndereco();
                    $compra_endereco->set_endereco($this->cliente->get_entrega_endereco());
                    $compra_endereco->set_numero($this->cliente->get_entrega_numero());
                    $compra_endereco->set_complemento($this->cliente->get_entrega_complemento());
                    $compra_endereco->set_referencia($this->cliente->get_entrega_referencia());
                    $compra_endereco->set_bairro($this->cliente->get_entrega_bairro());
                    $compra_endereco->set_cidade($this->cliente->get_entrega_cidade());
                    $compra_endereco->set_estado($this->cliente->get_entrega_estado());
                    $compra_endereco->set_cep($this->cliente->get_entrega_cep());
                    $compra_endereco->set_tipo($this->cliente->get_entrega_endereco_tipo());
                }
                $view->set_variavel('endereco', $compra_endereco);
			}
			else
			{
				$n = new Notificacao('Compra não encontrada.', 'error', TRUE);
				header('Location: '.SITE_URL.'/area-cliente/consultar-pedidos');
				exit;
			}
		}
		else
		{
			$n = new Notificacao('Identificador de compra inválido.', 'error', TRUE);
			header('Location: '.SITE_URL.'/area-cliente/consultar-pedidos');
			exit;
		}

		//-----

		$view->set_variavel('body_class', 'pedido');
		$view->set_variavel('notificacao', new Notificacao);

        $view->set_variavel('pagina_title', 'Consultar Pedidos');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/**
	 * Página onde o cliente faz login ou inicia seu cadastro
	 * @param $parametros
	 */
	public function identificacao($parametros)
	{
        $_SESSION['compra-login'] = true;

		$view = new View('identificacao.php');
		$this->view_variaveis_obrigatorias($view);

		$view->set_variavel('body_class', 'identificacao');
		$view->set_variavel('notificacao', new Notificacao);

	    $view->set_variavel('pagina_title', 'Identificação');
	    $view->set_variavel('pagina_description', '');
	    $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/**
	 * Envia o email com a nova senha para o cliente
	 * @param $parametros
	 */
	public function esqueci_senha($parametros)
	{
        $view = new View('esqueci-senha.php');
        $this->view_variaveis_obrigatorias($view);
        $view->set_variavel('body_class', '');
        if (isset($parametros->acao) AND $parametros->acao == 'esqueci-senha')
        {
            if (isset($parametros->email) AND filter_var($parametros->email, FILTER_VALIDATE_EMAIL))
            {
                $cliente = new Model_Cliente;
                $cliente = $cliente->select('SELECT id FROM {tabela_nome} WHERE email = "'.Funcoes::mysqli_escape($parametros->email).'"');

                if ($cliente AND ! is_null($cliente->get_id()))
                {
                    $nova_senha = rand(10000000,99999999);
                    $cliente->set_senha(sha1($nova_senha));
                    $cliente->update();

                    //-----

                    $parametros_email = new stdClass;
                    $parametros_email->email = $parametros->email;
                    $parametros_email->nome = '';
                    $parametros_email->nova_senha = $nova_senha;

                    $email = new Controller_Email;
                    if ($email->esqueci_senha($parametros_email))
                    {
                        $notificacao = new Notificacao('Uma nova senha foi gerada e enviada para o seu e-email.', 'successo');
                    }
                    else
                    {
                        $notificacao = new Notificacao('Erro ao realizar a operação.', 'erro');
                    }
                }
                else
                {
                    $notificacao = new Notificacao('Email não cadastrado.', 'erro');
                }
            }
            else
            {
                $notificacao = new Notificacao('Email inválido', 'erro');
            }
        }
        else
        {
            $notificacao = new Notificacao;
        }
        $view->set_variavel('body_class', 'cadastro');
        $view->set_variavel('notificacao', $notificacao);
        $view->exibir();
	}


	/**
	 * Método que faz logout do cliente
	 * @return void
	 */
	public function logout($parametros)
	{
		$_SESSION['cliente_id'] = sha1(time());
		unset($_SESSION['cliente_id']);
		session_destroy();
		header('Location: '.SITE_URL);
		exit;
	}

	/* ***************************** MÉTODOS EXTRAS ***************************** */



} // end class