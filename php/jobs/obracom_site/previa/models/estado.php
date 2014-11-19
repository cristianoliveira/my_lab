<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_Estado extends Model_Padrao
{
	protected $tabela_nome = 'estados';
	protected $colunas = array('id','sigla','nome');
	protected $colunas_not_null = array('id','sigla','nome');

	/* 3 propriedades */
	protected $id; // int primary key not null
	protected $sigla; // char(2) not null
	protected $nome; // varchar(50) not null

	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}
	
	public function get_sigla() {return $this->sigla;}
	public function set_sigla($string) {$this->sigla = ! is_null($string) ? mb_substr(mb_strtoupper(trim($string)), 0, 2) : NULL;}

	public function get_nome() {return $this->nome;}
	public function set_nome($string) {$this->nome = ! is_null($string) ? mb_substr(trim($string), 0, 50) : NULL;}
	

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

		if (empty($this->nome) OR empty($this->sigla))
		{
			$retorno = FALSE;
		}

		return $retorno;
	}
	
} // end class