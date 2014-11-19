<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe

 2011-06-08 - 0.2 - Rodrigo Saling
			Alterado o load() e o update() para permitir atualizar campos no BD que venham em branco ("") do formulário. Alteração em todos os Models
			foi necessário para criar uma nova variável/array que contém as colunas que não podem ser atualizadas para null. Não tenho certeza se foi
			a melhor opção, mas vamos como vai se comportar nos próximos dias.

*/

class Model_Padrao
{
	protected $conexao;
	protected $clausula;
	protected $tabela_prefixo;
	protected $update_colunas_para_null = array();


	public function get_conexao() {return $this->conexao;}
	public function set_conexao($object) {$this->conexao = $object;}

	public function get_clausula() {return $this->clausula;}
	public function set_clausula($string) {$this->clausula = trim($string);}

	public function get_tabela_prefixo() {return $this->tabela_prefixo;}
	public function set_tabela_prefixo($string) {$this->tabela_prefixo = trim($string);}

	public function get_update_colunas_para_null() {return $this->update_colunas_para_null;}
	public function set_update_colunas_para_null($string) {$this->update_colunas_para_null[] = trim($string);}

	// As variáveis estão nas classes herdeiras
	public function get_tabela_nome() {return $this->tabela_nome;}
	public function get_colunas() {return $this->colunas;}
	public function get_colunas_not_null() {return $this->colunas_not_null;}


	/**
	 * Faz a conexão com o banco e salva a conexao na variável
	 */
	protected function __construct()
	{
		global $bd, $bd_config;

		$this->set_conexao($bd->get_conexao());
		$this->set_tabela_prefixo($bd_config[SITE_LOCAL]['tabela_prefixo']);
	}
	
	
	/**
	 * Recebe um conjunto de dados e o nome da classe e carrega os valores nas variáveis do objeto
	 * @param $dados
	 * @return void
	 */
	public function carregar($dados)
	{
		// Se for um objeto ...
		if (is_object($dados))
		{
			// ... transforma em array para pegar o nome de cada variável dentro
			$dados = get_object_vars($dados);
		}

		foreach ($dados as $nome=>$valor)
		{
			// Monta o nome do método 'setter'
			$metodo = 'set_'.$nome;
			// Testa a existência dele dentro desta classe
			if (in_array($nome, $this->get_colunas()) AND method_exists($this, $metodo))
			{
				if (is_string($valor) AND strlen($valor) == 0)
				{
					//if (is_null($valor) OR strlen($valor) == 0)
					{
						$valor = NULL;
						// Se for possível, atualizar para NULL, adicionando no array para atualizar para NULL
						if ( ! in_array($nome, $this->get_colunas_not_null()))
						{
							$this->set_update_colunas_para_null($nome);
						}
					}
				}
				// Chama o método passando o valor como parâmetro
				$this->$metodo($valor);
			}
		}
	}


	/**
	 * Realiza uma consulta no banco de dados, devolvendo um objeto ou um array deles
	 * @param null $clausula
	 * @param bool $is_array
	 * @return array|bool
	 */
	public function select($clausula = NULL, $is_array = FALSE)
	{
		// Caso seja passado uma cláusula diretamente para a função, executa ela
		if ( ! is_null($clausula))
		{
			$this->set_clausula($clausula);
		}

		// Troca uma possível variável pelo nome da tabela do Model
		$this->set_clausula(str_replace('{tabela_nome}', $this->get_tabela_nome(), $this->get_clausula()));

		// Troca uma possível variável pelo prefixo das tabelas no banco de dados. Utilizado muito em JOINs
		$this->set_clausula(str_replace('{tabela_prefixo}', $this->get_tabela_prefixo(), $this->get_clausula()));
        
		// Executa o SELECT no banco de dados
		$query = $this->conexao->query($this->get_clausula());

		if ($query AND $query->num_rows > 0)
		{
			if ($query->num_rows == 1 AND ! $is_array)
			{
				return $query->fetch_object(get_class($this));
			}
			else
			{
				$objetos = array();
				while ($linha = $query->fetch_object(get_class($this)))
				{
					$objetos[] = $linha;
				}
				return (count($objetos) > 0) ? $objetos : FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}


	/**
	 * Realizar uma inserção no banco, salvando o ID (auto increment) automaticamente no objeto
	 * @return bool
	 */
	public function insert()
	{
		$colunas = array();
		$valores = array();

		// Percorre as variáveis desta classe e pega os campos e valores
		foreach ($this as $nome=>$valor)
		{
			// Monta o nome do método declarado lá em cima, partindo do pressuposto que o nome da
			// variável é igual ao nome do método get_
			$metodo = 'get_'.$nome;
			// Verifica se a o método existe, para que no insert vá somente as colunas da tabela no BD
			if (in_array($nome, $this->get_colunas()) AND method_exists($this, $metodo))
			{
				// Recebe o valor do método
				$valor = $this->$metodo();
				// Se não for NULL, coloca nos arrays
				if ( ! is_null($valor))
				{
					$colunas[] = $nome;
					// Todos os valores vão entre aspas, e aparentemente funciona (com exceção do NULL)
					$valores[] = "'".$valor."'";
				}
			}
		}

		$sql = 'INSERT INTO '.$this->get_tabela_nome().' ('.implode(',',$colunas).') VALUES ('.implode(',',$valores).')';

		$query = $this->get_conexao()->query($sql);

		if ($query)
		{
			$this->set_id($this->get_conexao()->insert_id);
		}

		return $query;
	}


	/**
	 * Realiza o update no banco, retornando boolean para o sucesso ou não da operação
	 * @param array $update_colunas_para_null
	 * @return bool
	 */
	public function update($update_colunas_para_null = array())
	{
		// Se recebeu colunas por parâmetro, atualiza o array local
		if (count($update_colunas_para_null) > 0)
		{
			foreach ($update_colunas_para_null as $coluna)
			{
				$this->set_update_colunas_para_null($coluna);
			}
		}

		// Uma só variável que acomoda a coluna e valor
		$colunas_valores = array();

		// Percorre as variáveis desta classe e pega os campos e valores
		foreach ($this as $nome=>$valor)
		{
			// Monta o nome do método declarado lá em cima, partindo do pressuposto que o nome da
			// variável é igual ao nome do método get_
			$metodo = 'get_'.$nome;

			// Verifica se a o método existe, para que no insert vá somente as colunas da tabela no BD
			if (in_array($nome, $this->get_colunas()) AND method_exists($this, $metodo))
			{
				// Recebe o valor do método
				$valor = $this->$metodo();
				// Se tiver algum valor, coloca nos arrays
				if ( ! is_null($valor))
				{
					// Não queremos atualizar a primary key da tabela
					if ($nome != 'id')
					{
						$colunas_valores[] = $nome."='".$valor."'";
					}
				}
				elseif (in_array($nome, $this->get_update_colunas_para_null()))
				{
					// Caso a variável esteja no array de atualizar para NULL, adiciona essa instrução
					$colunas_valores[] = $nome.'=NULL';
				}
			}
		}

		$sql = 'UPDATE '.$this->get_tabela_nome().' SET '.implode(',',$colunas_valores).' WHERE id = '.$this->get_id();

		return $this->get_conexao()->query($sql);
	}


	/**
	 * Executa o delete no banco, conforme o ID salvo no próprio objeto
	 * @return bool
	 */
	public function delete()
	{
		// Monta a query
		$sql = 'DELETE FROM '.$this->get_tabela_nome().' WHERE id = '.$this->get_id();
		// Executa ela e retorna TRUE ou FALSE
		return $this->get_conexao()->query($sql);
	}
	

	/*********************************** MÉTODOS EXTRAS ***********************************/


	/**
	 * Executa a função para tratamento dos dados antes de fazer as consultas no banco
	 */
	public function colunas_mysqli_escape()
	{
		foreach ($this->get_colunas() as $coluna)
		{
			$valor = Funcoes::mysqli_escape($this->$coluna, $this->conexao);
			// O TinyMCE está adicionando "\r\n" no final de cada parágrafo, e aqui retiramos eles
			$valor = ! is_null($valor) ? str_replace('\r\n', '', $valor) : $valor;
			$this->$coluna = $valor;
		}
	}


} // end class