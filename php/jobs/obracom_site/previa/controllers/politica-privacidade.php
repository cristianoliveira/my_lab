<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_PoliticaPrivacidade extends Controller_Padrao
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
        		
        $view = new View('politica-privacidade.php');
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

		$view->set_variavel('body_class', 'politica-privacidade');
		$view->set_variavel('notificacao', new Notificacao);

        $view->set_variavel('pagina_title', 'Politica de Privacidade');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/* ***************************** MÉTODOS EXTRAS ***************************** */
	

} // end class