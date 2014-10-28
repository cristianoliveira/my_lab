<?php //defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/**
 * Classe DB
 *
 * Realiza a conexão com o banco de dados conforme dados definidos no config.php
 */

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe

*/

// Para evitar o erro "Trying to clone an uncloneable object of class mysqli"
ini_set('zend.ze1_compatibility_mode', 'off');


class BD extends Sistema
{
	protected $conexao;

	public function get_conexao() {return $this->conexao;}
	public function set_conexao($object) {$this->conexao = $object;}
	
	/**
	 * Construtor
	 *
	 * Inicializa as classes que serão utilizadas nas classes estendida
	 */    
    public function __construct()
    {
		global $bd_config;
		
		parent::__construct();

		// Tenta a conexão com o banco de dados
	    $this->conexao = new mysqli($bd_config[SITE_LOCAL]['url'], $bd_config[SITE_LOCAL]['usuario'], $bd_config[SITE_LOCAL]['senha'], $bd_config[SITE_LOCAL]['banco']);

	    $this->conexao->set_charset('utf8');
		
		if ( ! $this->conexao)
		{
			// Se a conexão não foi bem sucedida, mostra mensagem
			$log = new Log('Não foi possível conectar ao banco de dados.');
		}
	}


} // end class

// Para criar somente uma conexão com o banco por vez
$bd = new BD;