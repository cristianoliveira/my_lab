<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_CompraProduto extends Model_Padrao
{
	protected $tabela_nome = 'compras_produtos';
	protected $colunas = array('id','compra_id','produto_id','quantidade','cor_id','valor_unitario','frete_unitario');
	protected $colunas_not_null = array('id','compra_id','produto_id','quantidade','valor_unitario','frete_unitario');

	/* 6 propriedades */
	protected $id; // int primary key not null
	protected $compra_id; // int unsigned not null
	protected $produto_id; // int unsigned not null
	protected $quantidade; // tinyint unsigned not null
	protected $cor_id;
    protected $valor_unitario; // decimal 10,2 not null
    protected $frete_unitario; // decimal 10,2 not null

	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}
	
	public function get_compra_id() {return $this->compra_id;}
	public function set_compra_id($integer) {$this->compra_id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_produto_id() {return $this->produto_id;}
	public function set_produto_id($integer) {$this->produto_id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_quantidade() {return $this->quantidade;}
	public function set_quantidade($integer) {$this->quantidade = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_cor_id() {return $this->cor_id;}
	public function set_cor_id($integer) {$this->cor_id= ! is_null($integer) ? (int) $integer : NULL;}

	public function get_valor_unitario() {return $this->valor_unitario;}
	public function set_valor_unitario($float)
	{
		if ( ! is_null($float))
		{
			if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
			{
				$float = str_replace(array('R$','.'), '', $float); // Retira o prefixo e os separadores de milhar
				$float = str_replace(',', '.', $float); // Troca vírgula por ponto
			}
			$this->valor_unitario = number_format(trim($float), 2, '.', '');
		}
		else
		{
			$this->valor_unitario = NULL;
		}
	}

    public function get_frete_unitario() {return $this->frete_unitario;}
    public function set_frete_unitario($float)
    {
        if ( ! is_null($float))
        {
            if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
            {
                $float = str_replace(array('R$','.'), '', $float); // Retira o prefixo e os separadores de milhar
                $float = str_replace(',', '.', $float); // Troca vírgula por ponto
            }
            $this->frete_unitario = number_format(trim($float), 2, '.', '');
        }
        else
        {
            $this->frete_unitario = NULL;
        }
    }


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

		if (empty($this->compra_id) OR empty($this->produto_id) OR empty($this->quantidade) OR empty($this->valor_unitario))
		{
			$retorno = FALSE;
		}

		return $retorno;
	}
	
} // end class