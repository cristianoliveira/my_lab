<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_Erro extends Controller_Padrao
{
	public $numero;


	public function __construct($numero = NULL)
	{
		parent::__construct();

		$this->numero = $numero;
	}


    public function index($parametros = NULL)
	{
		$this->numero = isset($parametros->numero) ? (int) $parametros->numero : $this->numero;

		$view = new View('erro.php');

		$this->view_variaveis_obrigatorias($view);

		//-----

		$view->set_variavel('body_class', 'interna http-erro '.$this->numero);

		switch ($this->numero)
		{
			case 404 :
				header('HTTP/1.0 404 Not Found');
				$view->set_variavel('pagina_title', 'Página de erro');
				break;
			default :
				$view->set_variavel('pagina_title', 'Página de erro');
				break;
		}
		
		$view->set_variavel('body_class', 'pagina-erro');
		$view->set_variavel('notificacao', new Notificacao);

        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

        $view->exibir();
    }
	
} // end class