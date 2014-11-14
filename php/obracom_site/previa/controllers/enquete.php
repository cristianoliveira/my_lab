<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_Enquete extends Controller_Padrao
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
        //echo $uri;
        //exit;
        $view = new View('enquete.php');

		//-----

		if ( ! isset($parametros->pergunta_seo))
		{
			$n = new Notificacao('Identificador de enquete inválido.', 'error', TRUE);
			header('Location: '.SITE_URL);
			exit;
		}

		//-----

		$enquete = new Model_Enquete;
		$enquete = $enquete->select('
			SELECT enquete.*, SUM(opcao.votos) AS total_votos
			FROM {tabela_nome} AS enquete
				LEFT JOIN {tabela_prefixo}enquetes_opcoes AS opcao ON opcao.enquete_id = enquete.id
			WHERE enquete.pergunta_seo = "'.Funcoes::mysqli_escape($parametros->pergunta_seo).'"
			AND ativa=1
		');
		$view->set_variavel('enquete', $enquete);

		if ($enquete AND $enquete->get_id())
		{
            $_SESSION['enquete_atual'] = serialize($enquete);
			$opcao = new Model_EnqueteOpcao;
			$opcoes = $opcao->select('SELECT * FROM {tabela_nome} WHERE enquete_id = "'.$enquete->get_id().'" ORDER BY opcao', TRUE);
			$view->set_variavel('opcoes', $opcoes);

		}

		//-----

        $this->view_variaveis_obrigatorias($view);

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

		//-----

		$view->set_variavel('body_class', 'enquete');
		$view->set_variavel('notificacao', new Notificacao);
        if ($enquete AND $enquete->get_id())
        {
            $view->set_variavel('pagina_title', $enquete->get_pergunta().' - Enquete');
        }
        else
        {
            $notificacao = new Notificacao('Enquete não encontrada.', 'ERROR');
            $view->set_variavel('pagina_title', $notificacao->get_mensagem());
            $view->set_variavel('notificacao', $notificacao);
            $view->set_variavel('opcoes', new Model_EnqueteOpcao());
        }

        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}

	/**
	 * Verifica se o visitante pode votar, e se sim, contabiliza o voto
	 * @param $parametros
	 */
	public function votar($parametros)
	{
		if (isset($parametros->id, $parametros->opcao) AND is_numeric($parametros->id) AND is_numeric($parametros->opcao))
		{
			$enquete = new Model_Enquete($parametros->id);

			if ( ! isset($_COOKIE['enquete_'.$parametros->id]))
			{
				$opcao = new Model_EnqueteOpcao;
				$opcao = $opcao->select('SELECT * FROM {tabela_nome} WHERE id = "'.Funcoes::mysqli_escape($parametros->opcao).'" AND enquete_id = "'.Funcoes::mysqli_escape($parametros->id).'"');
				if ($opcao AND $opcao->get_id())
				{
					$opcao->set_votos($opcao->get_votos() + 1);
					$opcao->update();

					setcookie('enquete_'.$parametros->id, 1, time()+31536000);

					header('Location: '.SITE_URL.'/enquete/'.$enquete->get_pergunta_seo());
					exit;
				}
			}
			else
			{
				$n = new Notificacao('Você já votou nesta enquete.', 'error', TRUE);
				header('Location: '.SITE_URL.'/enquete/'.$enquete->get_pergunta_seo());
				exit;
			}
		}
		else
		{
			$n = new Notificacao('Identificador de enquete inválido.', 'error', TRUE);
			header('Location: '.SITE_URL);
			exit;
		}
	}


	/* ***************************** MÉTODOS EXTRAS ***************************** */
	

} // end class