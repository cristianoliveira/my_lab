<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/**
 * Classe Notificacao
 */

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Notificacao
{
	protected $mensagem;
	protected $tipo;

	public function get_mensagem() {return $this->mensagem;}
	public function set_mensagem($string) {$this->mensagem = trim($string);}

	public function get_tipo() {return $this->tipo;}
	public function set_tipo($string) {$this->tipo = trim($string);}


	/**
	 * Construtor
	 * @param string $mensagem
	 * @param string $tipo
	 * @param bool $salvar_na_session
	 */
	public function __construct($mensagem = NULL, $tipo = 'error', $salvar_na_session = FALSE)
	{
		$this->set_mensagem($mensagem);
		$this->set_tipo($tipo);

		// Salva as informações na sessão para um possível redirecionamento
		if ($salvar_na_session)
		{
			$_SESSION['notificacao_texto'] = $this->get_mensagem();
			$_SESSION['notificacao_tipo'] = $this->get_tipo();
		}
		else
		{
			// Se houver uma mensagem na Session, salva para um provável render a seguir
			if (isset($_SESSION['notificacao_texto']))
			{
				$this->set_mensagem($_SESSION['notificacao_texto']);
				unset($_SESSION['notificacao_texto']);
			}
			if (isset($_SESSION['notificacao_tipo']))
			{
				$this->set_tipo($_SESSION['notificacao_tipo']);
				unset($_SESSION['notificacao_tipo']);
			}
		}
	}


	/**
	 * Exibe a mensagem gerada nas "entranhas" do site
	 * @return void
	 */
	public function sistema_exibir()
	{
		echo 'Ocorreu um erro no sistema:<br />';
		echo $this->mensagem;
		exit;
	}


	/**
	 * Exibe a mensagem no formato para o FatorCMS
	 * @return void
	 */
	public function fatorcms_exibir()
	{
		if ( ! is_null($this->get_mensagem()) AND strlen($this->get_mensagem()) > 0)
		{
			echo '<div class="notification '.(is_null($this->get_tipo()) ? 'error' : $this->get_tipo()).' png_bg">';
				echo '<a href="#" class="close"><img src="'.SITE_BASE.'/fatorcms/views/imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a>';
				echo '<div>';
					echo $this->get_mensagem();
				echo '</div>';
			echo '</div>';
		}
	}


	/**
	 * Exibe a mensagem no formato para o FatorCMS
	 * @return void
	 */
	public function site_exibir()
	{
		if ( ! is_null($this->get_mensagem()) AND strlen($this->get_mensagem()) > 0)
		{
			echo '<div class="notificacao '.(is_null($this->get_tipo()) ? 'erro' : $this->get_tipo()).'">';
				echo $this->get_mensagem();
			echo '</div>';
		}
	}

	
} // end class