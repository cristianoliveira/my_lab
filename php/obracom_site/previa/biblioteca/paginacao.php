<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/**
 * Classe Paginação
 *
 * Fornece o LIMIT para consultas ao banco e exibe os links para paginação no site e no FatorCMS
 */

class Paginacao
{
	private $clausula_limit;
	private $linhas_total;
	private $pagina_atual;
	private $pagina_linhas_max;
	private $pagina_links_max;
	private $parametros;
	private $sendo_usada;

	private $paginas_total;
	private $caminho;

	public function get_clausula_limit() {return $this->clausula_limit;}
	public function set_clausula_limit($string) {$this->clausula_limit = $string;}

	public function get_linhas_total() {return $this->linhas_total;}

	public function get_pagina_atual() {return $this->pagina_atual;}

	public function get_pagina_linhas_max() {return $this->pagina_linhas_max;}

	public function get_pagina_links_max() {return $this->pagina_links_max;}

	public function get_sendo_usada() {return $this->sendo_usada;}

	public function get_paginas_total() {return $this->paginas_total;}

	public function get_caminho() {return $this->caminho;}


	/**
	 * O Construtor da classe. Recebe um objeto, a página atual e o número de registros por página
	 * @param object $model
	 * @param stdClass $parametros
	 * @param int $pagina_linhas_max
	 * @param int $pagina_links_max
	 */
	public function __construct(&$model, $parametros, $pagina_linhas_max = 50, $pagina_links_max = 10)
	{
		// Se existir o parâmetro pagina. Se não, define página 1
		$this->pagina_atual = (isset($parametros->pagina) AND ! empty($parametros->pagina)) ? (int) trim($parametros->pagina) : 1;

		// Adiciona algum possivel parâmetro no objeto
		$this->parametros = $parametros;

		// Salva a cláusula original para recuperar lá no final
		$clausula_original = $model->get_clausula();

		// Essa consulta vai retornar um objeto contendo o linhas_total
		$query = $model->select('SELECT COUNT(*) AS linhas_total FROM ( '.$model->get_clausula().' ) AS linhas_total');

		if ($query AND isset($query->linhas_total))
		{
			$this->linhas_total = $query->linhas_total ? (int) $query->linhas_total : 0;

			$this->pagina_linhas_max = (int) $pagina_linhas_max;
			$this->pagina_links_max = (int) $pagina_links_max;

			// Calcula o número de páginas que serão necessárias para exibir todos os registros
			$this->paginas_total = ceil($this->linhas_total / $this->pagina_linhas_max);

			// Verifica se a página atual não é maior que o total de páginas
			$this->pagina_atual = min($this->pagina_atual, $this->paginas_total);

			// Monta a string que será passada para a consulta da página com o LIMIT
			if ($this->sendo_usada = $this->linhas_total > $this->pagina_linhas_max)
			{
				$this->set_clausula_limit(' LIMIT '.(($this->pagina_atual*$this->pagina_linhas_max)-$this->pagina_linhas_max).', '.$this->pagina_linhas_max);
			}
			else
			{
				$this->clausula_limit = NULL;
			}
		}

		$model->set_clausula($clausula_original.( ! is_null($this->get_clausula_limit()) ? $this->get_clausula_limit() : ''));

		// Pega a URL, limpa ela e prepara para uso nos links
		$this->preparar_o_caminho();
	}


	/**
	 * Pega a URL, trabalha com os parâmetros e salva o caminho que deve ser usado para montar os links para as páginas
	 * @return void
	 */
	protected function preparar_o_caminho()
	{
		// Só exibe os links se o número total de registros for maior do que a página suporta
		if ($this->linhas_total > $this->pagina_linhas_max)
		{
			// Monta o caminho para os links das páginas
			$caminho = $_SERVER['REQUEST_URI'];
			// Limpa da URL retirando parte desnecessária inicial
			$caminho = str_replace(explode('/',$_SERVER['PHP_SELF']), '', $caminho);
			// Retira sa barras sobrando
			$caminho = str_replace('//', '', $caminho);

			// Retira parâmetros vindos por GET
			if (strpos($caminho, '?') !== FALSE)
			{
				$caminho = substr($caminho, 0, strpos($caminho, '?'));
			}

			// Caso seja uma busca, adiciona a busca na URL
			// TODO melhorar esta parte para aceitar qualquer tipo de parâmetro e não só de busca
			if ( ! empty($this->parametros))
			{
				if (isset($this->parametros->buscar) AND strlen($this->parametros->buscar) > 0)
				{
					// Limpa a URL de "buscas anteriores"
					$caminho = preg_replace('%/buscar/[A-Za-z0-9\s\+\&\@\#\/\%\?\=\~\_\|\!\:\,\.\;\w]*%i', '', $caminho);
					$caminho .= '/buscar/'.$this->parametros->buscar;
				}
			}

			// Retira outros parâmetros da paginação
			$caminho = preg_replace('%/pagina/[0-9]*%i', '', $caminho);
			$this->caminho = utf8_encode(SITE_URL.'/'.$caminho);
		}
	}

	
	//----------


	/**
	 * Exibe o HTML contendo os links da paginação no FatorCMS
	 */
	public function fatorcms_exibir_links()
	{
		// Só exibe os links se o número total de registros for maior do que a página suporta
		if ($this->linhas_total > $this->pagina_linhas_max)
		{
			echo '<div class="pagination">';

			if ($this->paginas_total > 2 AND $this->pagina_atual != 1)
			{
				echo '<a href="'.$this->caminho.'/pagina/1" title="Primeira página">&laquo; Primeira</a>';
			}

			if ($this->pagina_atual != 1)
			{
				echo '<a href="'.$this->caminho.'/pagina/'.($this->pagina_atual-1).'" title="Página anterior">&laquo; Anterior</a>';
			}

			// Cálculos para ver quantos e quais links devem aparecer
			$pagina_links_inicio = $pagina_links_fim = $this->pagina_atual;
			$comecar_pelo_inicio = TRUE; // Isso faz com que a contagem dos links comece pelo início, e não pelo fim
			for ($i=1 ; $i < $this->pagina_links_max; $i++)
			{
				// Se for a vez do "inicio", testa se não fica menor que 1
				if ($comecar_pelo_inicio AND $pagina_links_inicio - 1 >= 1)
				{
					$pagina_links_inicio--;
					$comecar_pelo_inicio = FALSE; // Na próxima, vai pular
				}
				elseif ($pagina_links_fim + 1 <= $this->paginas_total)
				{
					$pagina_links_fim++;
					$comecar_pelo_inicio = TRUE;
				}
				elseif ($pagina_links_inicio - 1 >= 1)
				{
					// Entra aqui caso o contador já tenha chegado no fim, então tenta subtrair do início novamente
					$pagina_links_inicio--;
					$comecar_pelo_inicio = FALSE;
				}
			}

			for ($i=$pagina_links_inicio ; $i<=$pagina_links_fim ; $i++)
			{
				echo '<a href="'.$this->caminho.'/pagina/'.$i.'" class="number '.(($i==$this->pagina_atual)?'current':'').'" title="'.$i.'">'.$i.'</a>';
			}

			if ($this->pagina_atual != $this->paginas_total)
			{
				echo '<a href="'.$this->caminho.'/pagina/'.($this->pagina_atual+1).'" title="Próxima página">Próxima &raquo;</a>';
			}

			if ($this->paginas_total > 2 AND $this->pagina_atual != $this->paginas_total)
			{
				echo '<a href="'.$this->caminho.'/pagina/'.($this->paginas_total).'" title="Última página">Última &raquo;</a>';
			}

			echo '</div> <!-- End .pagination -->';
		}
	}


	/**
	 * Exibe a quantidade de registros da listagem no FatorCMS
	 * @return void
	 */
	public function fatorcms_exibir_quantidades()
	{
		if ( ! is_null($this->get_linhas_total()) AND $this->get_linhas_total() > 0)
		{
			$inicio = ($this->get_pagina_atual() * $this->get_pagina_linhas_max()) - $this->get_pagina_linhas_max() + 1;
			$fim = $this->get_pagina_atual() * $this->get_pagina_linhas_max();
			$total = $this->get_linhas_total();

			$fim = min($fim, $total);

			echo '<div class="align-left">';
				echo '<p class="pagination-showing">Exibindo <strong>',$inicio,' - ',$fim,'</strong> de <strong>',$total,'</strong>.</p>';
			echo '</div>';
		}
	}


	//----------


	/**
	 * Links que aparecem após a listagem, com links de anterior e próxima página
	 * @return void
	 */
	public function site_exibir_links()
	{
		// Só exibe os links se o número total de registros for maior do que a página suporta
		if ($this->linhas_total > $this->pagina_linhas_max)
		{
			// Calcula o número de páginas que serão necessárias para exibir todos os registros
			$this->paginas_total = ceil($this->linhas_total / $this->pagina_linhas_max);

			//echo '<div class="paginacao">';


			if ($this->pagina_atual != 0 AND $this->pagina_atual != 1)
			{
				echo '<a href="'.$this->caminho.'/pagina/'.($this->pagina_atual-1).'" class="semBorda" title="Página anterior">« anterior</a>';
			}
			else
			{
				echo '<span class="semBorda">« anterior</span>';
			}

			// Cálculos para ver quantos e quais links devem aparecer
			$pagina_links_inicio = $pagina_links_fim = $this->pagina_atual;
			$comecar_pelo_inicio = TRUE; // Isso faz com que a contagem dos links comece pelo início, e não pelo fim
			for ($i=1 ; $i < $this->pagina_links_max; $i++)
			{
				// Se for a vez do "inicio", testa se não fica menor que 1
				if ($comecar_pelo_inicio AND $pagina_links_inicio - 1 >= 1)
				{
					$pagina_links_inicio--;
					$comecar_pelo_inicio = FALSE; // Na próxima, vai pular
				}
				elseif ($pagina_links_fim + 1 <= $this->paginas_total)
				{
					$pagina_links_fim++;
					$comecar_pelo_inicio = TRUE;
				}
				elseif ($pagina_links_inicio - 1 >= 1)
				{
					// Entra aqui caso o contador já tenha chegado no fim, então tenta subtrair do início novamente
					$pagina_links_inicio--;
					$comecar_pelo_inicio = FALSE;
				}
			}

			for ($i=$pagina_links_inicio ; $i<=$pagina_links_fim ; $i++)
			{
				if ($i != $this->pagina_atual)
				{
					echo '<a href="'.$this->caminho.'/pagina/'.$i.'" title="Ir para a página '.$i.'" class="'.($i==$pagina_links_fim ? 'semBorda' : '').'">'.$i.'</a>';
				}
				else
				{
					echo '<span class="'.($i==$pagina_links_fim ? 'semBorda' : '').'">'.$i.'</span>';
				}
			}

			if ($this->pagina_atual != $this->paginas_total)
			{
				echo '<a href="'.$this->caminho.'/pagina/'.($this->pagina_atual+1).'" class="semBorda" title="Próxima página">próxima »</a>';
			}
			else
			{
				echo '<span class="semBorda">próxima »</span>';
			}

			//echo '</div>';
		}
	}
	

	/**
	 * Exibe o número de registros encontrados e a página na qual o cliente está
	 * @param string $o_que_singular
	 * @param string $o_que_plural
	 * @param bool $feminino
	 * @return void
	 */
	public function site_exibir_quantidades($o_que_singular = 'item', $o_que_plural = 'itens', $feminino = TRUE)
	{
		// Calcula o número de páginas que serão necessárias para exibir todos os registros
		//$this->paginas_total = ceil($this->linhas_total / $this->pagina_linhas_max);

		$inicio = ($this->get_pagina_atual() * $this->get_pagina_linhas_max()) - $this->get_pagina_linhas_max() + 1;
		$fim = $this->get_pagina_atual() * $this->get_pagina_linhas_max();
		$total = $this->get_linhas_total();

		$fim = min($fim, $total);

		if ($fim > 0)
		{
			echo 'Mostrando <strong>'.$inicio.' - '.$fim.'</strong> produto(s) do total de '.$total.' distribuído(s) em <strong>'.$this->get_paginas_total().' página(s)</strong>';
		}
		else
		{
			echo 'Nenhum produto encontrado.';
		}

		/*if ($this->linhas_total == 1)
			echo '<div class="total-novidades">1 '.$o_que_singular.' encontrad'.($feminino ? 'a' : 'o').'</div>';
		else
			echo '<div class="total-novidades">'.$this->linhas_total.' '.$o_que_plural.' encontrad'.($feminino ? 'as' : 'os').'</div>';*/
	}
	
} // end class