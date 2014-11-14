<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_ClienteEndereco extends Model_Padrao
{
	protected $tabela_nome = 'clientes_enderecos';
	protected $colunas = array('id','cliente_id','endereco','numero','complemento','referencia',
							'bairro','cidade','estado','cep','tipo');
	protected $colunas_not_null = array('id','cliente_id');

	/* 11 propriedades */
	protected $id; // int primary key not null
	protected $cliente_id; // int primary key not null
	protected $endereco; // varchar(100)
	protected $numero; // int unsigned
	protected $complemento; // varchar(100)
	protected $referencia; // text
	protected $bairro; // varchar(50)
	protected $cidade; // varchar(100)
	protected $estado; // varchar(2)
	protected $cep; // int unsigned
	protected $tipo; // enum


	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_cliente_id() {return $this->cliente_id;}
	public function set_cliente_id($integer) {$this->cliente_id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_endereco() {return $this->endereco;}
	public function set_endereco($string) {$this->endereco = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_numero() {return $this->numero;}
	public function set_numero($integer) {$this->numero = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_complemento() {return $this->complemento;}
	public function set_complemento($string) {$this->complemento = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_referencia() {return $this->referencia;}
	public function set_referencia($string) {$this->referencia = ! is_null($string) ? trim($string) : NULL;}

	public function get_bairro() {return $this->bairro;}
	public function set_bairro($string) {$this->bairro = ! is_null($string) ? mb_substr(trim($string), 0, 50) : NULL;}

	public function get_cidade() {return $this->cidade;}
	public function set_cidade($string) {$this->cidade = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_estado() {return $this->estado;}
	public function set_estado($string) {$this->estado = ! is_null($string) ? mb_substr(trim($string), 0, 2) : NULL;}

	public function get_cep() {return $this->cep;}
	public function set_cep($string) {$this->cep = ! is_null($string) ? (int) str_replace('-', '', $string) : NULL;}

	public function get_tipo() {return $this->tipo;}
	public function set_tipo($string) {$this->tipo =  ! is_null($string) ? mb_strtolower(trim($string)) : NULL;}

	
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

		if (empty($this->cliente_id))
		{
			$retorno = FALSE;
		}

		return $retorno;
	}
	
} // end class