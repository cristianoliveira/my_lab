<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/**
 * Classe Log
 *
 * Classe que permite salvar fazer logs pelo sistema, primeiramente salvando em um arquivo texto,
 * mas permitindo a possibilidade de enviar por email ou outros meios.
 */

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Log
{
	/**
	 * Construtor que decebe a mensagem e o local onde "salvar" ela
	 * @param  $mensagem
	 * @param string $onde
	 */
	public function __construct($mensagem, $onde = 'txt')
	{
		$pagina_atual = $_SERVER['URL'];

		$mensagem = '['.date('d/m/y H:i:s').'] '.$pagina_atual.' | '.$mensagem.PHP_EOL;

		if ($onde == 'txt')
		{
			$arquivo_nome = 'fator_log.txt';
			$arquivo = fopen($arquivo_nome, 'a');
			if ($arquivo)
			{
				fwrite($arquivo, $mensagem);
				fclose($arquivo);
			}
		}
	}

} // end class