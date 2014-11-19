<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_Produto extends Controller_Padrao
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
		// Se não vier o parâmetro, voltamos para a página de listagem de produtos
		if ( ! isset($parametros->nome_seo) OR empty($parametros->nome_seo))
		{
			/*header('Location: '.SITE_URL.'/produtos');
			exit;*/
			$erro = new Controller_Erro(404);
			$erro->index();
			die;
		}
		else
		{
			$nome_seo = $parametros->nome_seo;
		}

		//-----

		$view = new View('produto.php');
		$this->view_variaveis_obrigatorias($view);

		//-----

		// Buscamos o produto
		$produto = new Model_Produto;
		$produto = $produto->select('SELECT * FROM {tabela_nome} WHERE nome_seo = "'.Funcoes::mysqli_escape($nome_seo).'" AND ativo = 1');
		$view->set_variavel('produto', $produto);

		if ( ! $produto OR is_null($produto->get_id()))
		{
			/*$n = new Notificacao('Produto não encontrado.', 'error', TRUE);
			header('Location: '.SITE_URL.'/produtos');
			exit;*/
			$erro = new Controller_Erro(404);
			$erro->index();
			die;
		}

		// As outras imagens do produto
		$imagem = new Model_ProdutoImagem;
		$imagens = $imagem->select('SELECT * FROM {tabela_nome} WHERE produto_id = "'.$produto->get_id().'"', TRUE);
		$view->set_variavel('produto_imagens', $imagens);

		// As cores do produto, na view verificamos se são necessárias
		$cor = new Model_ProdutoCor;
		//$cores = $cor->select('SELECT * FROM {tabela_nome} WHERE produto_id = "'.$produto->get_id().'" AND (nome != NULL OR nome != "")', TRUE);
		$cores = $cor->select('SELECT * FROM {tabela_nome} WHERE produto_id = "'.$produto->get_id().'"', TRUE);
		$view->set_variavel('produto_cores', $cores);

		//-----

		// Busca as tags do produto
		$tag = new Model_Tag;
		$tags = $tag->select('
			SELECT tag.nome
			FROM {tabela_nome} AS tag
				RIGHT JOIN {tabela_prefixo}produtos_tags AS produto_tag ON tag.id = produto_tag.tag_id
			WHERE produto_tag.produto_id = '.$produto->get_id()
			);
		// Vamos montar a string para a meta tag keywords
		$keywords = '';
		if ($tags AND count($tags) > 0)
		{
			foreach ($tags as $tag)
			{
				$keywords .= $tag->get_nome().',';
			}
			// Remove os últimos ", "
			$keywords = mb_substr($keywords, 0, -1);
		}
		$view->set_variavel('pagina_keywords', $keywords);

		//-----

		// "Sobrescrevemos" as "outras ofertas" aqui para levar em consideração o produto sendo exibido atualmente

		// Outras ofertas
		$oferta = new Model_Produto;
		$ofertas = $oferta->select('
			SELECT nome, nome_seo, imagem, valor_original, valor_promocional
			FROM {tabela_nome}
			WHERE disponivel = 1 AND ativo = 1 AND imagem IS NOT NULL AND id != '.$produto->get_id().'
			ORDER BY RAND()
		',TRUE);
		$view->set_variavel('outras_ofertas', $ofertas);

		//------

		$view->set_variavel('body_class', 'produto');
		$view->set_variavel('notificacao', new Notificacao);

        $view->set_variavel('pagina_title', $produto->get_nome());
        $view->set_variavel('pagina_description', $produto->get_resumo());
        //$view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}


	/* ***************************** MÉTODOS EXTRAS ***************************** */


} // end class