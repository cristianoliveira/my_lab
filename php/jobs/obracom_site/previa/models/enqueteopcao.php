<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_EnqueteOpcao extends Model_Padrao
{
	protected $tabela_nome = 'enquetes_opcoes';
	protected $colunas = array('id','enquete_id','opcao','votos');
	protected $colunas_not_null = array('id','enquete_id','opcao','votos');

	/* 4 propriedades */
	protected $id; // int primary key not null
	protected $enquete_id; // int not null
	protected $opcao; // varchar(400) not null
	protected $votos; // int not null

	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_enquete_id() {return $this->enquete_id;}
	public function set_enquete_id($integer) {$this->enquete_id = ! is_null($integer) ? (int) $integer : NULL;}
	
	public function get_opcao() {return utf8_decode($this->opcao);}
	public function set_opcao($string) {$this->opcao = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_votos() {return $this->votos;}
	public function set_votos($integer) {$this->votos = ! is_null($integer) ? (int) $integer : NULL;}
	

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

		if (empty($this->enquete_id) OR empty($this->opcao))
		{
			$retorno = FALSE;
		}

		return $retorno;
	}


	/****************************** NOVOS MÉTODOS ******************************/


	/**
	 * Executa o delete no banco, conforme o os parâmetros salvos no objeto
	 * @return bool
	 */
	public function delete()
	{
		// "Limpa" os valores
		$this->colunas_mysqli_escape();

		if ( ! is_null($this->get_id()))
		{
			// Exclusão de um registro específico
			$sql = 'DELETE FROM '.$this->get_tabela_nome().' WHERE id = '.$this->get_id();
			return $this->get_conexao()->query($sql);
		}
		elseif ( ! is_null($this->get_enquete_id()))
		{
			// Exclusão de todos os registro de determinado produto
			$sql = 'DELETE FROM '.$this->get_tabela_nome().' WHERE enquete_id = '.$this->get_enquete_id();
			return $this->get_conexao()->query($sql);
		}

		// Se chegou aqui, é porque não excluiu nada
		return FALSE;
	}
	
} // end class