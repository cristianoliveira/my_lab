<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/**
 * Classe System
 *
 * Outras classes do sistema farão o extend desta aqui para obter funcionalidades básicas e gerais
 */

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

// Seta o include path para adicionar a biblioteca Zend, permitindo conexão à API do Google para envio dos vídeos
$caminho = 'biblioteca';
set_include_path(get_include_path() . PATH_SEPARATOR . $caminho);

class Sistema
{
	protected $notificacao;
	
	/**
	 * Construtor
	 *
	 * Inicializa as classes que serão utilizadas nas classes estendida
	 */    
    public function __construct()
    {
		// Habilita o uso da classe Notificacao
		$this->notificacao = new Notificacao;
	}
} // end class
