<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_Empresa extends Model_Padrao
{
	protected $tabela_nome = 'empresas';
	protected $colunas = array('id','slogan','descricao');
	protected $colunas_not_null = array('id','slogan','descricao');

	/* 3 propriedades */
	protected $id; // int primary key not null
	protected $slogan; // varchar(100) not null
	protected $descricao; // varchar(100) not null

	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}
	
	public function get_slogan() {return $this->slogan;}
	public function set_slogan($string) {$this->slogan = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_descricao() {return $this->descricao;}
	public function set_descricao($string) {$this->descricao = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}
	

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

} // end class