<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/
class Controller_Padrao
{
	protected $cliente;


	public function get_cliente() {return $this->cliente;}
	public function set_cliente($object) {$this->cliente = $object;}


	/**
	 * Construtor
	 *
	 * Inicializa as classes que serão utilizadas nas classes estendidas
	 */  
	public function __construct()
	{
		if ( ! isset($_SESSION))
		{
			@session_start();
		}

		if (isset($_SESSION['cliente_id']) AND is_numeric($_SESSION['cliente_id']))
		{
			$cliente = new Model_Cliente($_SESSION['cliente_id']);
			if ($cliente AND ! is_null($cliente->get_id()))
			{
				$this->set_cliente($cliente);
			}
		}
		else
		{
			unset($_SESSION['cliente_id']);
		}
	}


	/**
	 * Esta função é chamada em alguns lugares para verificar se o cliente está logado, permitindo o acesso à áreas restritas
	 * com o resto do próprio método
	 * @return void
	 */
	protected function verificar_cliente_logado()
	{
		if ( ! isset($_SESSION['cliente_id']) OR is_null($this->get_cliente()))
		{
			$n = new Notificacao('Você precisa estar logado para acessar esta página.', 'erro', TRUE);
			header('Location: '.SITE_URL.'/area-cliente/identificacao');
			exit();
		}
	}


	/**
	 * Jogamos para a view algumas variáveis que são utilizadas em todas as páginas
	 * @param $view
	 * @return void
	 */
	protected function view_variaveis_obrigatorias(&$view)
	{
		$view->set_variavel('cliente', $this->get_cliente());

		//-----

		$view->set_variavel('redirecionar', isset($_SESSION['redirecionar']) ? $_SESSION['redirecionar'] : SITE_URL.'/area-cliente');

		//-----

		$view->set_variavel('carrinho', isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : NULL);

		//-----

		// Variáveis de SEO para o caso de esquecermos nos controllers
		$view->set_variavel('pagina_title', '');
		$view->set_variavel('pagina_description', '');
		$view->set_variavel('pagina_keywords', '');

		//-----

		// Buscamos uma enquete para mostrar no rodapé do site (enquetes que tenham pelo menos 1 opção)
        if (!isset($_SESSION['enquete_atual']))
        {
            $id = 0;
        }
        else
        {
            $enquete_atual = unserialize($_SESSION['enquete_atual']);
            if (isset($enquete_atual))
            {
                $id = $enquete_atual->get_id();
                $_SESSION['enquete_atual'] = null;
            }
        }
       // echo 'ID da enquete atual: '.$id;
        //exit;
		$enquete = new Model_Enquete();
		$enquete = $enquete->select('
			SELECT enquete.*, COUNT(enquete_opcao.id) AS num_opcoes
			FROM fd_enquetes AS enquete
			  LEFT JOIN fd_enquetes_opcoes AS enquete_opcao ON enquete.id = enquete_opcao.enquete_id
			GROUP BY enquete.id
			HAVING num_opcoes >= 1 AND enquete.ativa=1 AND enquete.id != '.$id.'
			ORDER BY RAND()
			LIMIT 1
		');
		$view->set_variavel('rodape_enquete', $enquete);

		if ($enquete AND ! is_null($enquete->get_id()))
		{
			$enquete_opcao = new Model_EnqueteOpcao;
			$enquete_opcoes = $enquete_opcao->select('SELECT id, opcao FROM {tabela_nome} WHERE enquete_id = '.$enquete->get_id().' ORDER BY opcao');
			$view->set_variavel('rodape_enquete_opcoes', $enquete_opcoes);
		}
		else
		{
			$view->set_variavel('rodape_enquete_opcoes', NULL);
		}

		//-----

		// Outras ofertas
		$oferta = new Model_Produto;
		$ofertas = $oferta->select('
			SELECT nome, nome_seo, imagem, valor_original, valor_promocional
			FROM {tabela_nome}
			WHERE disponivel = 1 AND ativo = 1 AND imagem IS NOT NULL
			ORDER BY RAND()
		',TRUE);
		$view->set_variavel('outras_ofertas', $ofertas);

		//-----

		/*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		header("Content-Type: text/html; charset=UTF-8");*/
		
	}
	
} // end class