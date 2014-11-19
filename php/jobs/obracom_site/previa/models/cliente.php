<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_Cliente extends Model_Padrao
{
	protected $tabela_nome = 'clientes';
	protected $colunas = array('id','nome','email','senha','cpf','razao_social','cnpj','responsavel_nome','responsavel_cpf','telefone_principal',
							'telefone_comercial','telefone_celular','apelido','genero','nascimento','entrega_endereco','entrega_numero','entrega_complemento','entrega_referencia',
							'entrega_bairro','entrega_cidade','entrega_estado','entrega_cep','entrega_endereco_tipo','cadastro_data','ativo');
	protected $colunas_not_null = array('id','email','senha');

	/* 26 propriedades */
	protected $id; // int primary key not null
	protected $nome; // varchar(100) not null
	protected $email; // varchar(255) not null
	protected $senha; //varchar(40) not null
	protected $cpf; // bigint(11) unsigned not null zerofill
	protected $razao_social;
	protected $cnpj;
	protected $responsavel_nome;
	protected $responsavel_cpf;
	protected $telefone_principal; // bigint unsigned
	protected $telefone_comercial; // bigint unsigned
	protected $telefone_celular; // bigint unsigned
	protected $apelido;
	protected $genero;
	protected $nascimento;
	protected $entrega_endereco; // varchar(100)
	protected $entrega_numero; // int unsigned
	protected $entrega_complemento; // varchar(100)
	protected $entrega_referencia; // text
	protected $entrega_bairro; // varchar(50)
	protected $entrega_cidade; // varchar(100)
	protected $entrega_estado; // varchar(2)
	protected $entrega_cep; // int unsigned
	protected $entrega_endereco_tipo; // enum
	protected $cadastro_data; // datetime not null
	protected $ativo; // boolean not null default 1

	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_nome() {return $this->nome;}
	public function set_nome($string) {$this->nome = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_email() {return $this->email;}
	public function set_email($string) {$this->email = ! is_null($string) ? mb_substr(mb_strtolower(trim($string)), 0, 255) : NULL;}

    public function get_senha() {return $this->senha;}
	public function set_senha($string) {$this->senha = ! is_null($string) ? $string : NULL;}

	public function get_cpf() {return $this->cpf;}
	public function set_cpf($integer) {$this->cpf = ! is_null($integer) ? str_replace(array('-','.'), '', $integer) : NULL;} // Sem conversão para aproveitar o ZEROFILL do banco

	public function get_razao_social() {return $this->razao_social;}
	public function set_razao_social($string) {$this->razao_social = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_cnpj() {return $this->cnpj;}
	public function set_cnpj($integer) {$this->cnpj = ! is_null($integer) ? str_replace(array('-','.','/'), '', $integer) : NULL;} // Sem conversão para aproveitar o ZEROFILL do banco

	public function get_responsavel_nome() {return $this->responsavel_nome;}
	public function set_responsavel_nome($string) {$this->responsavel_nome = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_responsavel_cpf() {return $this->responsavel_cpf;}
	public function set_responsavel_cpf($integer) {$this->responsavel_cpf = ! is_null($integer) ? str_replace(array('-','.'), '', $integer) : NULL;} // Sem conversão para aproveitar o ZEROFILL do banco

	public function get_telefone_principal() {return $this->telefone_principal;}
	public function set_telefone_principal($string) {$this->telefone_principal = ! is_null($string) ? (float) str_replace(array('(',')',' ','-'), '', $string) : NULL;}

	public function get_telefone_comercial() {return $this->telefone_comercial;}
	public function set_telefone_comercial($string) {$this->telefone_comercial = ! is_null($string) ? (float) str_replace(array('(',')',' ','-'), '', $string) : NULL;}

	public function get_telefone_celular() {return $this->telefone_celular;}
	public function set_telefone_celular($string) {$this->telefone_celular = ! is_null($string) ? (float) str_replace(array('(',')',' ','-'), '', $string) : NULL;}

	public function get_apelido() {return $this->apelido;}
	public function set_apelido($string) {$this->apelido = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_genero() {return $this->genero;}
	public function set_genero($string) {$this->genero = ! is_null($string) ? mb_strtolower(trim($string)) : NULL;}

	public function get_nascimento() {return $this->nascimento;}
	public function set_nascimento($string) {$this->nascimento = ! is_null($string) ? date('Y-m-d', strtotime(str_replace('/', '-', $string))) : NULL;}

	public function get_entrega_endereco() {return $this->entrega_endereco;}
	public function set_entrega_endereco($string) {$this->entrega_endereco = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_entrega_numero() {return $this->entrega_numero;}
	public function set_entrega_numero($integer) {$this->entrega_numero = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_entrega_complemento() {return $this->entrega_complemento;}
	public function set_entrega_complemento($string) {$this->entrega_complemento = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_entrega_referencia() {return $this->entrega_referencia;}
	public function set_entrega_referencia($string) {$this->entrega_referencia = ! is_null($string) ? trim($string) : NULL;}

	public function get_entrega_bairro() {return $this->entrega_bairro;}
	public function set_entrega_bairro($string) {$this->entrega_bairro = ! is_null($string) ? mb_substr(trim($string), 0, 50) : NULL;}

	public function get_entrega_cidade() {return $this->entrega_cidade;}
	public function set_entrega_cidade($string) {$this->entrega_cidade = ! is_null($string) ? mb_substr(trim($string), 0, 100) : NULL;}

	public function get_entrega_estado() {return $this->entrega_estado;}
	public function set_entrega_estado($string) {$this->entrega_estado = ! is_null($string) ? mb_substr(trim($string), 0, 2) : NULL;}

	public function get_entrega_cep() {return $this->entrega_cep;}
	public function set_entrega_cep($string) {$this->entrega_cep = ! is_null($string) ? (int) str_replace('-', '', $string) : NULL;}

	public function get_entrega_endereco_tipo() {return $this->entrega_endereco_tipo;}
	public function set_entrega_endereco_tipo($string) {$this->entrega_endereco_tipo =  ! is_null($string) ? mb_strtolower(trim($string)) : NULL;}

	public function get_cadastro_data() {return $this->cadastro_data;}
	public function set_cadastro_data($string) {$this->cadastro_data = ! is_null($string) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $string))) : NULL;}

	public function get_ativo() {return $this->ativo;}
	public function set_ativo($boolean) {$this->ativo =  $boolean ? 1 : 0;}

	
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

		if (empty($this->email) OR ( ! $is_update AND empty($this->senha)))
		{
			$retorno = FALSE;
		}

		return $retorno;
	}
	
} // end class