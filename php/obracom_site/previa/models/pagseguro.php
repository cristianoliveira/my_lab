<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_Pagseguro extends Model_Padrao
{
	protected $tabela_nome = 'pagseguro';
	protected $colunas = array('id','compra_id','data','identificador','referencia','transacao_status_id','pagamento_tipo_id','pagamento_codigo_id');
	protected $colunas_not_null = array('id','compra_id','data','identificador');

	/* 8 propriedades */
	protected $id; // int unsigned not null
	protected $compra_id; // int unsigned not null
	protected $data; // datetime not null
	protected $identificador; // varchar(36) not null
	protected $referencia; // varchar(100)
	protected $transacao_status_id; // tinyint unsigned
	protected $pagamento_tipo_id; // tinyint unsigned
	protected $pagamento_codigo_id; // smallint unsigned


	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}
	
	public function get_compra_id() {return $this->compra_id;}
	public function set_compra_id($integer) {$this->compra_id = ! is_null($integer) ? (int) $integer : NULL;}
	
	public function get_data() {return $this->data;}
	public function set_data($string) {$this->data = ! is_null($string) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $string))) : NULL;}
	
    public function get_identificador() {return $this->identificador;}
	public function set_identificador($string) {$this->identificador = ! is_null($string) ? mb_substr(trim($string), 0, 36) : NULL;}

	public function get_referencia() {return $this->referencia;}
	public function set_referencia($string) {$this->referencia = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_transacao_status_id() {return $this->transacao_status_id;}
	public function set_transacao_status_id($integer) {$this->transacao_status_id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_pagamento_tipo_id() {return $this->pagamento_tipo_id;}
	public function set_pagamento_tipo_id($integer) {$this->pagamento_tipo_id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_pagamento_codigo_id() {return $this->pagamento_codigo_id;}
	public function set_pagamento_codigo_id($integer) {$this->pagamento_codigo_id = ! is_null($integer) ? (int) $integer : NULL;}


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

		if (empty($this->compra_id) OR empty($this->data) OR empty($this->identificador) OR empty($this->referencia) OR empty($this->transacao_status_id)
			OR empty($this->pagamento_tipo_id) OR empty($this->pagamento_codigo_id))
		{
			$retorno = FALSE;
		}

		return $retorno;
	}
	
} // end class