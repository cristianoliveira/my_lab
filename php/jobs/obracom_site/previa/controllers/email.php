<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe

- Classe exclusiva para montagem e envio de emails, para reunir tudo em um só lugar e poupar os outros Controllers

*/

class Controller_Email extends Controller_Padrao
{
	/**
	 * Chama o construtor da classe pai
	 */
	public function __construct()
	{
		parent::__construct();

        require_once 'biblioteca/SwiftMailer/swift_required.php';
	}
	
	
	/**
	 * Método inicial que faz a renderização básica da página
	 */
	public function index()
	{
		header('HTTP/1.1 403 Forbidden');
		exit;
	}

	/**
	 * Monta e envia a mensagem de contato da página Fale Conosco
	 * @param $parametros
	 * @return int
	 */
	public function central_relacionamento($parametros)
    {
		// Variáveis utilizadas no envio do email
		$assunto = 'Central de Relacionamento ao Cliente - Movel Clube';

		// Variáveis para montar o html da mensagem
		$titulo = 'Central de Relacionamento';
        $imagem = SITE_BASE.'/views/imagens/central-relacionamento.gif';
        $conteudo = '
			<p align="center"><font face="Arial" size="-1">====================================================================</font><br />
			<font face="Arial" size="-1">CENTRAL DE RELACIONAMENTO</font><br />
			<font face="Arial" size="-1">====================================================================</font><br />
			<br /></p>';
		$conteudo .= '
			<p><font face="Arial" color="black" size="-1">Uma pessoa entrou em contato com a Movel Clube através da Central de Relacionamento ao Cliente. Abaixo estão os dados dela e a mensagem enviada:</font>
			<br /><br /></p>
			<p><font face="Arial" size="-1"><b>Nome:</b> ' . trim($parametros->informacao_nome) . '</font></p>
			<p><font face="Arial" size="-1"><b>E-mail:</b> ' . trim($parametros->informacao_email) . '</font></p>
			<p><font face="Arial" size="-1"><b>Assunto:</b> ' . trim($parametros->assunto) . '</font></p>
			<p><font face="Arial" size="-1"><b>Telefone:</b> ('  . trim($parametros->informacao_ddd) . ') ' . trim($parametros->informacao_fone) . '</font></p>
			<p><font face="Arial" size="-1"><b>Cidade:</b> ' . trim($parametros->informacao_cidade) . '</font></p>
			<p><font face="Arial" size="-1"><b>Estado:</b> ' . trim($parametros->uf) . '</font></p>
			<p><font face="Arial" size="-1"><b>Mensagem:</b><br />' . trim($parametros->informacao_mensagem) . '</font></p>
		';
		
		// Incluimos o html, que concatena as variáveis acima
        include 'views/includes/email-boas-vindas.php';

		// Criamos o modo de envio do email
		$transport = $this->criar_transport();

		// Criamos a mensagem com assunto, mensagem, destinatário, reply-to
		$message = $this->criar_mensagem($assunto, $email_html, NULL, array('email'=>$parametros->informacao_email,'nome'=>$parametros->informacao_nome), NULL);

		// Enviamos o emails e retornamos boolean
		return $this->enviar($transport, $message);
    }

    /**
     * Monta e envia a mensagem de contato da página Cidade Disponivel
     * @param $parametros
     * @return int
     */
    public function cidade_disponivel($parametros)
    {
        // Variáveis utilizadas no envio do email
        $assunto = 'Disponibilidade de Cidade - Movel Clube';

        // Variáveis para montar o html da mensagem
        $titulo = 'Disponibilidade de Cidade';
        $imagem = SITE_BASE.'/views/imagens/central-relacionamento.gif';
        $conteudo = '
			<p align="center"><font face="Arial" size="-1">====================================================================</font><br />
			<font face="Arial" size="-1">CIDADE DISPONÍVEL</font><br />
			<font face="Arial" size="-1">====================================================================</font><br />
			<br /></p>';
        $conteudo .= '
			<p><font face="Arial" size="-1">Uma pessoa entrou em contato com a Movel Clube através do formulário de disponibilidade de cidades. Abaixo estão os dados dela e a mensagem enviada:</font>
			<br /><br /></p>
			<p><font face="Arial" size="-1"><b>Nome:</b> ' . trim($parametros->nome) . '</font></p>
			<p><font face="Arial" size="-1"><b>E-mail:</b> ' . trim($parametros->email) . '</font></p>
			<p><font face="Arial" size="-1"><b>Telefone:</b> ('  . trim($parametros->ddd) . ') ' . trim($parametros->fone) . '</font></p>
			<p><font face="Arial" size="-1"><b>Cidade:</b> ' . trim($parametros->cidade) . '</font></p>
			<p><font face="Arial" size="-1"><b>Estado:</b> ' . trim($parametros->uf2) . '</font></p>
			<p><font face="Arial" size="-1"><b>Mensagem:</b><br />' . trim($parametros->mensagem) . '</font></p>
		';

        // Incluimos o html, que concatena as variáveis acima
        include 'views/includes/email-boas-vindas.php';

        // Criamos o modo de envio do email
        $transport = $this->criar_transport();

        // Criamos a mensagem com assunto, mensagem, destinatário, reply-to e cc
        $message = $this->criar_mensagem($assunto, $email_html, NULL, array('email' => $parametros->email, 'nome' => $parametros->nome), NULL);

        // Enviamos o emails e retornamos boolean
        return $this->enviar($transport, $message);
    }
	
	
	/**
     * Monta e envia a mensagem de contato da página BOAS VINDAS
     * @param $parametros
     * @return int
     */
    public function boas_vindas($cliente)
    {
        // Variáveis utilizadas no envio do email
        $assunto = 'Boas Vindas - Movel Clube';

        // Variáveis para montar o html da mensagem
        $titulo = 'Boas Vindas';
		$imagem = SITE_BASE.'/views/imagens/boas-vindas.gif';
        $conteudo = '
			<p align="center"><font face="Arial" size="-1">====================================================================</font><br />
			<font face="Arial" size="-1">BEM-VINDO AO CLUBE!</font><br />
			<font face="Arial" size="-1">====================================================================</font><br />
			<br /></p>
			<p><font face="Arial" size="-1"><b>Caro(a)</b> ' . trim($cliente->get_nome()) . '</font></p>
			
			<p><font face="Arial" size="-1">Porto Alegre, '. date("d"). ' de '.Funcoes::mes_nome(date('m')). ' de '.date('Y').'</font></p>
			
			<p><font face="Arial" size="-1">Atenciosamente,</font></p>
			
			<p><font face="Arial" size="-1">MovelClube.</font>
			<br />
			<font face="Arial" size="-1">www.movelclube.com</font></p>
		';

        // Incluimos o html, que concatena as variáveis acima
        include 'views/includes/email-boas-vindas.php';

        // Criamos o modo de envio do email
        $transport = $this->criar_transport();

        // Criamos a mensagem com assunto, mensagem, destinatário, reply-to e cc

        //print_r(array('email'=>$cliente->get_email(),'nome'=>$cliente->get_nome())); exit;

		 $message = $this->criar_mensagem($assunto, $email_html, array('email' => $cliente->get_email(), 'nome' => $cliente->get_nome()), NULL, array($cliente->get_email() => $cliente->get_nome()));
		//$message = $this->criar_mensagem($assunto, $email_html, NULL, NULL);

        // Enviamos o emails e retornamos boolean
        return $this->enviar($transport, $message);
    }


    /**
     * Monta e envia a mensagem de contato da página CONTATO
     * @param $parametros
     * @return int
     */
    public function contato($parametros)
    {
        // Variáveis utilizadas no envio do email
        $assunto = 'Contato - Movel Clube';

        // Variáveis para montar o html da mensagem
        $titulo = 'Contato';
        $imagem = SITE_BASE.'/views/imagens/central-relacionamento.gif';

        $conteudo = '
			<p align="center"><font face="Arial" size="-1">====================================================================</font><br />
			<font face="Arial" size="-1">CONTATO</font><br />
			<font face="Arial" size="-1">====================================================================</font><br />
			<br /></p>';
		if($parametros->contato_produto != ""){
		
        $conteudo .= '
			<p><font face="Arial" size="-1">Uma pessoa entrou em contato com a Movel Clube através da página de Contato. Abaixo estão os dados dela e a mensagem enviada:</font>
			<br /><br /></p>
			<p><font face="Arial" size="-1"><b>Nome:</b> ' . trim($parametros->contato_nome) . '</font></p>
			<p><font face="Arial" size="-1"><b>E-mail:</b> ' . trim($parametros->contato_email) . '</font></p>
			<p><font face="Arial" size="-1"><b>Assunto:</b> ' . trim($parametros->contato_assunto) . '</font></p>
    		<p><font face="Arial" size="-1"><b>Produto:</b> ' . trim($parametros->contato_produto) . '</font></p>
			<p><font face="Arial" size="-1"><b>Telefone:</b> ('  . trim($parametros->contato_ddd) . ') ' . trim($parametros->contato_fone) . '</font></p>
			<p><font face="Arial" size="-1"><b>Cidade:</b> ' . trim($parametros->contato_cidade) . '</font></p>
			<p><font face="Arial" size="-1"><b>Estado:</b> ' . trim($parametros->contato_uf) . '</font></p>
			<p><font face="Arial" size="-1"><b>Mensagem:</b><br />' . trim($parametros->contato_mensagem) . '</font></p>
		'; } 
		else {
		
		$conteudo .= '
			<p><font face="Arial" size="-1">Uma pessoa entrou em contato com a Movel Clube através da página de Contato. Abaixo estão os dados dela e a mensagem enviada:</font>
			<br /><br /></p>
			<p><font face="Arial" size="-1"><b>Nome:</b> ' . trim($parametros->contato_nome) . '</font></p>
			<p><font face="Arial" size="-1"><b>E-mail:</b> ' . trim($parametros->contato_email) . '</font></p>
			<p><font face="Arial" size="-1"><b>Assunto:</b> ' . trim($parametros->contato_assunto) . '</font></p>
			<p><font face="Arial" size="-1"><b>Telefone:</b> ('  . trim($parametros->contato_ddd) . ') ' . trim($parametros->contato_fone) . '</font></p>
			<p><font face="Arial" size="-1"><b>Cidade:</b> ' . trim($parametros->contato_cidade) . '</font></p>
			<p><font face="Arial" size="-1"><b>Estado:</b> ' . trim($parametros->contato_uf) . '</font></p>
			<p><font face="Arial" size="-1"><b>Mensagem:</b><br />' . trim($parametros->contato_mensagem) . '</font></p>
		'; }

        // Incluimos o html, que concatena as variáveis acima
        include 'views/includes/email-boas-vindas.php';

        // Criamos o modo de envio do email
        $transport = $this->criar_transport();

        // Criamos a mensagem com assunto, mensagem, destinatário, reply-to
        $message = $this->criar_mensagem($assunto, $email_html, NULL, array('email'=>$parametros->contato_email,'nome'=>$parametros->contato_nome), NULL);

        // Enviamos o emails e retornamos boolean
        return $this->enviar($transport, $message);
    }


	/**
     * Monta e envia a mensagem com a nova senha do cliente
     * @param $parametros
     * @return int
     */
    public function esqueci_senha($parametros)
    {
        // Variáveis utilizadas no envio do email
        $assunto = 'Sua nova senha - Movel Clube';

        // Variáveis para montar o html da mensagem
        $titulo = 'Esqueci minha senha';
        $imagem = SITE_BASE.'/views/imagens/central-relacionamento.gif';
        $conteudo = '<p align="center"><font face="Arial" size="-1">==================================================================</font><br />
			<font face="Arial" size="-1">Sua Nova Senha</font><br />
			<font face="Arial" size="-1">==================================================================</font><br />
			<br /></p>';
        $conteudo .= '
			<p><font face="Arial" size="-1">Uma nova senha foi gerada para seu acesso ao Movel Clube:</font>
			<br /><br /></p>
			<p><font face="Arial" size="-1"><b>Nova senha:</b> '.($parametros->nova_senha).'</font></p>
		';

        // Incluimos o html, que concatena as variáveis acima
        include 'views/includes/email-boas-vindas.php';

        // Criamos o modo de envio do email
        $transport = $this->criar_transport();

        // Criamos a mensagem com assunto, mensagem, destinatário, reply-to
        $message = $this->criar_mensagem($assunto, $email_html, array('email'=>$parametros->email,'nome'=>$parametros->nome), NULL, array($parametros->email => $parametros->nome));

        // Enviamos o emails e retornamos boolean
        return $this->enviar($transport, $message);
    }


    /**
     * Monta e envia a mensagem apos a compra
     * @param $parametros
     * @return int
     */
    public function compra_efetuada($parametros)
    {
        // Variáveis utilizadas no envio do email
        $assunto = 'Compra Efetuada - Movel Clube';

        // Variáveis para montar o html da mensagem
        $titulo = 'Compra Efetuada';
        $imagem = SITE_BASE.'/views/imagens/compra-efetuada.gif';

        $conteudo = '<p align="center"><font face="Arial" size="-1">==================================================================</font><br />
			<font face="Arial" size="-1">OBRIGADO POR COMPRAR NO MOVELCLUBE.COM</font><br />
			<font face="Arial" size="-1">==================================================================</font><br />
			<br /></p>
			<p><font face="Arial" size="-1"><b>Prezado(a) Cliente.</b></font></p>
			<br />
			<p>Esta é a confirmação de que seu pedido Nº '.$parametros["compra"]->get_codigo().' foi finalizado com sucesso.
			 Leia essa mensagem com muita ATENÇÃO.</p>
			 <p align="center"><font face="Arial" size="-1">==================================================================</font><br />
			<font face="Arial" size="-1">SEU PEDIDO</font><br />
			<font face="Arial" size="-1">==================================================================</font><br />
			<br /></p>
			<p><b>Os itens escolhidos no pedido '.$parametros["compra"]->  get_codigo().' no dia '.date('d/m/Y H:i',strtotime($parametros["compra"]->get_quando())).'
			 são os seguintes:</b></p>';
        foreach ($parametros["produtos"] as $produto)
        {
            $conteudo .= '<p>'.$produto->produto_nome;
            $conteudo .= (isset($produto->cor_nome)) ? ' Cor: '.$produto->cor_nome.'<br />' : ''.'<br />';
            $conteudo .= 'Quantidade: '.$produto->get_quantidade().'<br />';
            $conteudo .= 'Valor/Unidade: R$ '.number_format($produto->get_valor_unitario(), 2, ',', '.').'<br />';
            $conteudo .= 'Frete/Unidade: R$ '.number_format($produto->get_frete_unitario(), 2, ',', '.').'<br />';
            $conteudo .= 'SubTotal: R$ '.number_format($produto->get_quantidade()*$produto->get_valor_unitario() + $produto->get_frete_unitario() * $produto->get_quantidade(), 2, ',', '.').'
            </p>';
        }
        $conteudo .= '<p align="center"><font face="Arial" size="-1">==================================================================</font><br />
			<font face="Arial" size="-1">ENDEREÇO DE ENTREGA</font><br />
			<font face="Arial" size="-1">==================================================================</font><br />
			<br /></p>';
        $conteudo .= '<p><b>Nome do Destinatario:</b> '.$parametros["cliente"]->get_nome().'<br />
            <b>Endereço:</b> '.$parametros["endereco"]->get_endereco().', '.$parametros["endereco"]->get_numero();
        if ($parametros['endereco']->get_complemento() != NULL)
        {
            $conteudo .= $parametros['endereco']->get_complemento().'<br />';
        }
        else
        {
            $conteudo .= '<br />';
        }
        $conteudo .= $parametros["endereco"]->get_bairro(). ' - '.$parametros["endereco"]->get_cidade().' - '.$parametros["endereco"]->get_estado().' - ';
        $conteudo .= 'Código Postal: '.$parametros["endereco"]->get_cep().' - Brasil</p>';
        $conteudo .= '<p><b>Total em Produtos:</b> R$ '.number_format($parametros["compra"]->get_valor(), 2, ',', '.').'<br />';
        $conteudo .= '<b>Serviço de Entrega:</b> R$ '.number_format($parametros["compra"]->get_frete(), 2, ',', '.').'<br />';
        $conteudo .= '<b>Total do Pedido:</b> R$ '.number_format($parametros["compra"]->get_valor()+$parametros["compra"]->get_frete(), 2, ',', '.').'</p>';

        $conteudo .= '<p align="center"><font face="Arial" size="-1">==================================================================</font><br />
			<font face="Arial" size="-1">ENTREGA</font><br />
			<font face="Arial" size="-1">==================================================================</font><br />
			<br /></p>';
        $conteudo .= '<p></p><b>IMPORTANTE: </b> O prazo de entrega informado acima é válido para compras efetuadas até 20:00 horas com cartão de crédito aprovado
        na 1ª tentativa.</p>';
        $conteudo .= '<p>Caso a data prevista para entrega cossresponder a algum feriado na região de entrega, pedimos gentilmente que acrescente 1 dia útil ao prazo 
        mencionado acima.</p>';
        $conteudo .= '<p>Seu pedido somente será deixado no endereço solicitado mediante a assinatura de quem for recebê-lo. Informamos que para contagem do prazo de
        entrega dos produtos, consideramos como dias úteis de 2ª a 6ª das 8h00 às 21h00, exceto feriados.</p>';
        $conteudo .= 'ATENÇÃO: Tenha sempre com você a nota fiscal e a embalagem original dos produtos. Somente com estes itens serão possíveis operações como troca ou
        devolução de produtos.';

        $conteudo .= '<p align="center"><font face="Arial" size="-1">==================================================================</font><br />
			<font face="Arial" size="-1">PAGAMENTO</font><br />
			<font face="Arial" size="-1">==================================================================</font><br />
			<br /></p>';
        $conteudo .= '<p>ATENÇÃO: Pedidos concluídos não são passíveis de alteração quanto à forma de pagamento e a inclusão ou exclusão de produtos.</p>';

        // Incluimos o html, que concatena as variáveis acima
        include 'views/includes/email-boas-vindas.php';

        // Criamos o modo de envio do email
        $transport = $this->criar_transport();

        // Criamos a mensagem com assunto, mensagem, destinatário, reply-to

        // $message = $this->criar_mensagem($assunto, $email_html, NULL, array('email'=>$parametros->email,'nome'=>$parametros->nome));
        $message = $this->criar_mensagem($assunto, $email_html, array('email' => $parametros["cliente"]->get_email(), 'nome' => $parametros["cliente"]->get_nome()), NULL, array($parametros["cliente"]->get_email() => $parametros["cliente"]->get_nome()));

        // Enviamos o emails e retornamos boolean
        return $this->enviar($transport, $message);
    }


	/**
     * Monta e envia a mensagem de contato da página CONTATO
     * @param $cliente
     * @param $compra
     * @param $identificador
     * @return int
     */
    public function pagseguro_retorno_cliente($cliente, $compra, $identificador)
    {
        // Variáveis utilizadas no envio do email
        $assunto = 'Pagamento aprovado - Movel Clube';

        // Variáveis para montar o html da mensagem
        $titulo = 'Pagamento aprovado';
        $imagem = SITE_BASE.'/views/imagens/compra-efetuada.gif';

        $conteudo = '<p align="center"><font face="Arial" size="-1">==================================================================</font><br />
			<font face="Arial" size="-1">PAGAMENTO APROVADO</font><br />
			<font face="Arial" size="-1">==================================================================</font><br />
			<br /></p>';
        $conteudo .= '
			<p><font face="Arial" size="-1">O PagSeguro notificou a Movel Clube que seu pagamento foi aprovado.</font>
			<br /><br /></p>
			<p><font face="Arial" size="-1"><b>Código da compra:</b> '.trim($compra->get_codigo()).'</font></p>
			<p><font face="Arial" size="-1"><b>Código do PagSeguro:</b> '.$identificador.'</font><br /><br /></p>
			<p><font face="Arial" size="-1">Para mais informações sobre sua compra, acesse sua área restrita no site do Movel Clube.</font></p>
		';

        // Incluimos o html, que concatena as variáveis acima
        include 'views/includes/email-template.php';

        // Criamos o modo de envio do email
        $transport = $this->criar_transport();

        // Criamos a mensagem com assunto, mensagem, destinatário, reply-to e cc
        $message = $this->criar_mensagem($assunto, $email_html, array('email'=>$cliente->get_email(),'nome'=>(is_null($cliente->get_responsavel_nome()) ? $cliente->get_nome() : $cliente->get_responsavel_nome())), NULL, array($cliente->get_email => is_null($cliente->get_responsavel_nome()) ? $cliente->get_nome() : $cliente->get_responsavel_nome()));

        // Enviamos o emails e retornamos boolean
        return $this->enviar($transport, $message);
    }


	/******************************* MÉTODOS PRIVADOS DA CLASSE *******************************/
	

	/**
	 * Instancia o objeto que fará o transporte da mensagem. Poder ser mail() ou SMTP
	 * @return object
	 */
	private function criar_transport()
	{
		global $email_config;

		if ($email_config[SITE_LOCAL]['smtp_enviar'])
		{
			// Se for SMTP, pega todas as configurações
			if ( ! is_null($email_config[SITE_LOCAL]['smtp_usuario']))
			{
				return Swift_SmtpTransport::newInstance($email_config[SITE_LOCAL]['smtp_servidor'], $email_config[SITE_LOCAL]['smtp_porta'], $email_config[SITE_LOCAL]['smtp_cripto'])
					->setUsername($email_config[SITE_LOCAL]['smtp_usuario'])
					->setPassword($email_config[SITE_LOCAL]['smtp_senha']);
			}
			else
			{
				return Swift_SmtpTransport::newInstance($email_config[SITE_LOCAL]['smtp_servidor'], $email_config[SITE_LOCAL]['smtp_porta']);
			}
		}
		else
		{
			// Caso seja mail()
            return Swift_MailTransport::newInstance();
		}

	}


	/**
	 * Instancia o objeto com a mensagem a ser enviada, fazendo algum tratamento quando os parâmetros vierem NULL
	 * @param $assunto
	 * @param $mensagem
	 * @param null $destinatario
	 * @param null $reply_to
	 * @return object
	 */
	private function criar_mensagem($assunto, $mensagem, $destinatario = NULL, $reply_to = NULL, $cc = NULL)
	{
		global $email_config;
		// Se o remetente vier NULL, usamos os dados do config.php
		if (is_null($reply_to))
		{
			$reply_to = array('email' => $email_config[SITE_LOCAL]['reply_to'], 'nome' => $email_config[SITE_LOCAL]['reply_to_nome']);
		}

		// Se o destinatario vier NULL, usamos os dados do config.php
		if (is_null($destinatario))
		{
			$destinatario = array($email_config[SITE_LOCAL]['para'] => $email_config[SITE_LOCAL]['para_nome']);
		}
		elseif (isset($destinatario['email'])) // Entra aqui caso tenha sido passado um array com um só destinatário, mas no formato antigo
		{
			$destinatario = array($destinatario['email'] => $destinatario['nome']);
		}

        if (is_null($cc))
        {
            $cc = array($email_config[SITE_LOCAL]['cc'] => $email_config[SITE_LOCAL]['cc_nome']);
        }
		//-----

		$log = new Log($assunto);
		$log = new Log($mensagem);
		$log = new Log(var_export($destinatario, TRUE));

		return Swift_Message::newInstance()
			->setFrom(array($email_config[SITE_LOCAL]['de'] => $email_config[SITE_LOCAL]['de_nome']))
			->setReturnPath($email_config[SITE_LOCAL]['return_path'])
			//->setTo(array($destinatario['email'] => $destinatario['nome']))
			->setTo($destinatario)
			->setReplyTo(array($reply_to['email'] => $reply_to['nome']))
            ->setCc($cc)
			->setSubject($assunto)
			->setBody($mensagem, 'text/html');
	}


	/**
	 * Cria o objeto Mailer com o Transport e a Message e faz o envio do email, retornando o sucesso ou não
	 * @param $transport
	 * @param $message
	 * @return int
	 */
    private function enviar($transport, $message)
    {
        // Inicializa o objeto que gerencia tudo
        $mailer = Swift_Mailer::newInstance($transport);

        return $mailer->send($message);
    }


} // end class