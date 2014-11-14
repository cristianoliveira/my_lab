<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_CarrinhoCompras extends Controller_Padrao
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
        		
        $view = new View('carrinho-compras.php');
		$this->view_variaveis_obrigatorias($view);

		$view->set_variavel('body_class', 'carrinho-compras');
		$view->set_variavel('notificacao', new Notificacao);

		$view->exibir();
	}


	/* ***************************** MÉTODOS EXTRAS ***************************** */
	

} // end class