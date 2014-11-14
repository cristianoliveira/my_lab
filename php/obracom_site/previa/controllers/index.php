<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_Index extends Controller_Padrao
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
        $view = new View('index.php');
		$this->view_variaveis_obrigatorias($view);

		//-----

		// Banners/destaque
		$destaque = new Model_Destaque;
		$destaques = $destaque->select('SELECT * FROM {tabela_nome} ORDER BY RAND()', TRUE);
		$view->set_variavel('destaques', $destaques);

		//-----

		// Sobreescrevemos a função padrão de exibição dos lançamentos
		$oferta = new Model_Produto;
		$ofertas = $oferta->select('
			SELECT nome, nome_seo, imagem, valor_original, valor_promocional
			FROM {tabela_nome}
			WHERE lancamento_capa = 1 AND disponivel = 1 AND ativo = 1 AND imagem IS NOT NULL
			ORDER BY RAND()
		',TRUE);
		$view->set_variavel('outras_ofertas', $ofertas);

		//-----

		$view->set_variavel('body_class', 'index');
		$view->set_variavel('notificacao', new Notificacao);

		$view->exibir();
	}


	/* ***************************** MÉTODOS EXTRAS ***************************** */
	

} // end class