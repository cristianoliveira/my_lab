<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/**
 * Classe View
 *
 * Faz o gerenciamento da view que é carregada no controller e exibe a página
 */

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe

- 2011-07-05 - Alterado a classe para aceitar diretórios antes do "views/"

*/

class View
{
	protected $arquivo;
	protected $diretorios;
	protected $variaveis;

	
	/**
	 * Recebe o nome do arquivo da view que deverá ser carregado e inicializa o array de variáveis
	 * @param mixed $parametros
	 */
	public function __construct($parametros)
	{
		// Se for array, pega os parâmetros que vem no formato associativo
		if (is_array($parametros))
		{
			if (count($parametros) == 2)
			{
				$this->diretorios = $parametros['diretorios'];
				$this->arquivo = $parametros['arquivo'];
			}
			else
			{
				// Isso funciona? Array associativo pode ser numérico?
				$this->arquivo = $parametros[0];
				$this->diretorios = NULL;
			}
		}
		else
		{
			// Se for string, é porque veio o nome do arquivo diretamente
			$this->arquivo = $parametros;
			$this->diretorios = NULL;
		}

		// Inicializa a variável para ser um array
		$this->variaveis = array();
	}
	
	
	/**
	 * Recebe o nome da variável e o valor dela e salva em um array
	 * @param  $nome
	 * @param  $valor
	 * @return void
	 */
	public function set_variavel($nome, $valor)
	{
		$this->variaveis[$nome] = $valor;
	}
	

	/**
	 * Transforma o array em variáveis normais e faz o include do arquivo da view = mágica
	 */
	public function exibir()
	{
		//ob_start();

		extract($this->variaveis, EXTR_SKIP);

		// Monta o caminho de include do arquivo
		$path = '';
		if ( ! empty($this->diretorios))
		{
			$path .= $this->diretorios.'/';
		}
		$path .= 'views/'.$this->arquivo;

		include $path;

		//ob_end_flush();
	}


} // end class