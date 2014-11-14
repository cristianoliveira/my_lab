<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_Compra extends Model_Padrao
{
	protected $tabela_nome = 'compras';
    protected $colunas = array('id','cliente_id','quando','codigo','valor','frete','forma_entrega');
    protected $colunas_not_null = array('id','cliente_id','quando','forma_entrega');

	/* 6 propriedades */
	protected $id; // int primary key not null
	protected $cliente_id; // int unsigned not null
	protected $quando; // datetime not null
	protected $codigo; // int unsigned
	protected $valor; // decimal(10,2)
	protected $frete; // decimal(10,2)
    protected $forma_entrega;

	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_cliente_id() {return $this->cliente_id;}
	public function set_cliente_id($integer) {$this->cliente_id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_quando() {return $this->quando;}
	public function set_quando($string) {$this->quando = ! is_null($string) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $string))) : NULL;}

	public function get_codigo() {return $this->codigo;}
	public function set_codigo($integer) {$this->codigo = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_valor() {return $this->valor;}
	public function set_valor($float)
	{
		if ( ! is_null($float))
		{
			if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
			{
				$float = str_replace(array('R$','.'), '', $float); // Retira o prefixo e os separadores de milhar
				$float = str_replace(',', '.', $float); // Troca vírgula por ponto
			}
			$this->valor = number_format(trim($float), 2, '.', '');
		}
		else
		{
			$this->valor = NULL;
		}
	}

	public function get_frete() {return $this->frete;}
	public function set_frete($float)
	{
		if ( ! is_null($float))
		{
			if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
			{
				$float = str_replace(array('R$','.'), '', $float); // Retira o prefixo e os separadores de milhar
				$float = str_replace(',', '.', $float); // Troca vírgula por ponto
			}
			$this->frete = number_format(trim($float), 2, '.', '');
		}
		else
		{
			$this->frete = NULL;
		}
	}

    public function get_forma_entrega() {return $this->forma_entrega;}
    public function set_forma_entrega($string) {$this->forma_entrega = ! is_null($string) ? mb_substr(trim($string), 0, 20) : NULL;}

	/**
	 * O construtor chama o construtor pai e já carrega as propriedades do objeto, se for o caso
	 * @param null $id
	 */
	public function __construct($id = NULL)
	{
		parent::__construct();

		// Constrói o nome da tabela

		$this->tabela_nome = $this->get_tabela_prefixo().$this->tabela_nome;

		// Se passou um id por parâmetro, salva nas propriedades do objeto
		if ( ! is_null($id) AND is_numeric($id))
		{
			$this->set_id($id);
			$this->colunas_mysqli_escape();

			// E já carrega o objeto
			$this->carregar($this->select('SELECT * FROM {tabela_nome} WHERE id = '.$this->get_id()));
		}
	}


	/**
	 * Verifica se os campos obrigatórios contém algum valor ou não. Esta função poderia ser automática lá no Model_Padrao, mas fica complicado
	 * de saber quais campos são obrigatórios no insert e quais são no update
	 * @param bool $is_update
	 * @return bool
	 */
	public function verificar_obrigatorios($is_update = FALSE)
	{
		// Se for update, o id é obrigatório por padrão
		$retorno = ($is_update AND empty($this->id)) ? FALSE : TRUE;

		if (empty($this->cliente_id) OR empty($this->quando))
		{
			$retorno = FALSE;
		}

		return $retorno;
	}
	
} // end class