<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe



*/

class Model_Produto extends Model_Padrao
{
	protected $tabela_nome = 'produtos';
	protected $colunas = array('id','categoria_id','nome','nome_seo','imagem','codigo','resumo','descricao','valor_original','valor_promocional','disponivel','ativo','lancamento_capa','data_cadastro','altura','largura','comprimento','peso');
	protected $colunas_not_null = array('id','categoria_id','nome','nome_seo','disponivel','ativo','lancamento_capa','data_cadastro');

	/* 14 propriedades */
	protected $id; // int unsigned not null
	protected $categoria_id; // int unsigned not null
	protected $nome; // varchar(100) not null
	protected $nome_seo; // varchar(100) not null
	protected $imagem; // varchar(36)
	protected $codigo; // varchar(20)
	protected $resumo;
	protected $descricao; // varchar(1200)
	protected $valor_original; // decimal(10,2)
	protected $valor_promocional; // decimal(10,2)
	protected $disponivel; // boolean not null
	protected $ativo; // boolean not null
	protected $lancamento_capa; // boolean not null
	protected $data_cadastro;
    protected $largura; //float
    protected $altura; //float
    protected $comprimento; //float
    protected $peso; //float

	public function get_id() {return $this->id;}
	public function set_id($integer) {$this->id = ! is_null($integer) ? (int) $integer : NULL;}

	public function get_categoria_id() {return $this->categoria_id;}
	public function set_categoria_id($integer) {$this->categoria_id = ! is_null($integer) ? (int) $integer : NULL;}
	
	public function get_nome() {return utf8_decode($this->nome);}
	public function set_nome($string) {$this->nome = ! is_null($string) ? mb_substr(trim($string), 0, 200) : NULL;}
	
	public function get_nome_seo() {return $this->nome_seo;}
	public function set_nome_seo($string) {$this->nome_seo = ! is_null($string) ? mb_substr(trim($string), 0, 200) : NULL;}

	public function get_imagem() {return $this->imagem;}
	public function set_imagem($string) {$this->imagem = ! is_null($string) ? mb_substr(trim($string), 0, 36) : NULL;}

	public function get_codigo() {return $this->codigo;}
	public function set_codigo($string) {$this->codigo = ! is_null($string) ? mb_substr(trim($string), 0, 20) : NULL;}

	public function get_resumo() {return utf8_decode($this->resumo);}
	public function set_resumo($string) {$this->resumo = ! is_null($string) ? mb_substr(trim($string), 0, 150) : NULL;}

    public function get_descricao() {return utf8_decode($this->descricao);}
	public function set_descricao($string) {$this->descricao = ! is_null($string) ? trim($string) : NULL;}

	public function get_valor_original() {return $this->valor_original;}
	public function set_valor_original($float)
	{
		if ( ! is_null($float))
		{
			if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
			{
				$float = str_replace(array('R$','.'), '', $float); // Retira o prefixo e os separadores de milhar
				$float = str_replace(',', '.', $float); // Troca vírgula por ponto
			}
			$this->valor_original = number_format(trim($float), 2, '.', '');
		}
		else
		{
			$this->valor_original = NULL;
		}
	}

	public function get_valor_promocional() {return $this->valor_promocional;}
	public function set_valor_promocional($float)
	{
		if ( ! is_null($float))
		{
			if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
			{
				$float = str_replace(array('R$','.'), '', $float); // Retira o prefixo e os separadores de milhar
				$float = str_replace(',', '.', $float); // Troca vírgula por ponto
			}
			$this->valor_promocional = number_format(trim($float), 2, '.', '');
		}
		else
		{
			$this->valor_promocional = NULL;
		}
	}

	public function get_disponivel() {return $this->disponivel;}
	public function set_disponivel($boolean) {$this->disponivel = ! is_null($boolean) ? ($boolean ? 1 : 0) : NULL;}

	public function get_ativo() {return $this->ativo;}
	public function set_ativo($boolean) {$this->ativo = ! is_null($boolean) ? ($boolean ? 1 : 0) : NULL;}

	public function get_lancamento_capa() {return $this->lancamento_capa;}
	public function set_lancamento_capa($boolean) {$this->lancamento_capa = ! is_null($boolean) ? ($boolean ? 1 : 0) : NULL;}

	public function get_data_cadastro() {return $this->data_cadastro;}
	public function set_data_cadastro($string) {$this->data_cadastro = ! is_null($string) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $string))) : NULL;}

    public function get_altura() {return $this->altura;}
    public function set_altura($float)
    {
        if ( ! is_null($float))
        {
            if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
            {
                $float = str_replace(array('.'), '', $float); // Retira o prefixo e os separadores de milhar
                $float = str_replace(',', '.', $float); // Troca vírgula por ponto
            }
            $this->altura = number_format(trim($float), 2, '.', '');
        }
        else
        {
            $this->altura = NULL;
        }
    }

    public function get_largura() {return $this->largura;}
    public function set_largura($float)
    {
        if ( ! is_null($float))
        {
            if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
            {
                $float = str_replace(array('.'), '', $float); // Retira o prefixo e os separadores de milhar
                $float = str_replace(',', '.', $float); // Troca vírgula por ponto
            }
            $this->largura = number_format(trim($float), 2, '.', '');
        }
        else
        {
            $this->largura = NULL;
        }
    }

    public function get_comprimento() {return $this->comprimento;}
    public function set_comprimento($float)
    {
        if ( ! is_null($float))
        {
            if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
            {
                $float = str_replace(array('.'), '', $float); // Retira o prefixo e os separadores de milhar
                $float = str_replace(',', '.', $float); // Troca vírgula por ponto
            }
            $this->comprimento = number_format(trim($float), 2, '.', '');
        }
        else
        {
            $this->comprimento = NULL;
        }
    }

    public function get_peso() {return $this->peso;}
    public function set_peso($float)
    {
        if ( ! is_null($float))
        {
            if (strpos($float, ',') !== FALSE) // Provavelmente veio do formulário
            {
                $float = str_replace(array('.'), '', $float); // Retira o prefixo e os separadores de milhar
                $float = str_replace(',', '.', $float); // Troca vírgula por ponto
            }
            $this->peso = number_format(trim($float), 2, '.', '');
        }
        else
        {
            $this->peso = NULL;
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

		if (empty($this->nome) OR empty($this->nome_seo) OR empty($this->categoria_id) OR is_null($this->valor_original))
		{
			$retorno = FALSE;
		}

		return $retorno;
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