<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_Produtos extends Controller_Padrao
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
        $view = new View('produtos.php');
		$this->view_variaveis_obrigatorias($view);

		//-----

		$titulo = 'Todos os nossos produtos';

		// Buscamos os Produtos conforme o caso

		$clausula_where = '';

		//-----

		if (isset($parametros->buscar))
		{
			if ( ! empty($parametros->buscar))
			{
				$clausula_where .= ' AND (produto.nome LIKE "%'.Funcoes::mysqli_escape(utf8_encode($parametros->buscar)).'%" OR produto.resumo LIKE "%'.Funcoes::mysqli_escape(utf8_encode($parametros->buscar)).'%" OR
										produto.descricao LIKE "%'.Funcoes::mysqli_escape(utf8_encode($parametros->buscar)).'%") ';
				$view->set_variavel('busca_texto', $parametros->buscar);
			}
			else
			{
				header('Location: '.SITE_URL.'/produtos');
			}
		}

		//-----

		if (isset($parametros->categoria_seo) AND ! empty($parametros->categoria_seo))
		{
			switch ($parametros->categoria_seo)
			{
				case 'cadeiras' :
					$clausula_where .= ' AND categoria.nome_seo = "cadeiras" ';
					$titulo = 'Cadeiras para escritório';
					break;

				case 'mobiliario' :
					$clausula_where .= ' AND categoria.nome_seo = "mobiliario" ';
					$titulo = 'Móveis para escritório';
					break;

				case 'acessorios' :
					$clausula_where .= ' AND categoria.nome_seo = "acessorios" ';
					$titulo = 'Acessórios para escritório';
					break;
			}

			$view->set_variavel('categoria_seo', $parametros->categoria_seo);
		}

		//-----

		$clausula_order_by = ' produto.nome '; // Padrão

		if (isset($parametros->ordenar_por))
		{
			switch ($parametros->ordenar_por)
			{
				case 'mais-novos' :
					$clausula_order_by = ' produto.data_cadastro DESC ';
					break;

				case 'menor-preco' :
					$clausula_order_by = ' LEAST(IFNULL(produto.valor_promocional,produto.valor_original), produto.valor_original) ASC ';
					break;

				case 'maior-preco' :
					$clausula_order_by = ' LEAST(IFNULL(produto.valor_promocional,produto.valor_original), produto.valor_original) DESC ';
					break;

				case 'alfabetica' :
				default :
					$clausula_order_by = ' produto.nome ';
					break;
			}
		}
		$view->set_variavel('ordenar_por', isset($parametros->ordenar_por) ? $parametros->ordenar_por : NULL);

		//-----

		$produto = new Model_Produto;
		$produto->set_clausula('
			SELECT produto.*
			FROM {tabela_nome} AS produto
				LEFT JOIN {tabela_prefixo}categorias AS categoria ON produto.categoria_id = categoria.id
			WHERE ativo = 1 '.$clausula_where.'
			ORDER BY produto.disponivel DESC, '.$clausula_order_by
		);

		$paginacao = new Paginacao($produto, $parametros, 8);
		$produtos = $produto->select(NULL, TRUE); // NULL para não alterar a clásula já definida e TRUE para forçar retorno em array

		$view->set_variavel('produtos', $produtos);
		$view->set_variavel('paginacao', $paginacao);

		//-----

		$view->set_variavel('tamanho_imagem', isset($parametros->tamanho_imagem) ? $parametros->tamanho_imagem : 'media');

		//-----

		$view->set_variavel('titulo', $titulo);

		$view->set_variavel('body_class', 'produtos');
		$view->set_variavel('notificacao', new Notificacao);

        $view->set_variavel('pagina_title', 'Produtos');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/* ***************************** MÉTODOS EXTRAS ***************************** */
	

} // end class