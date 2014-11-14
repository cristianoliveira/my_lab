<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_Contato extends Controller_Padrao
{
	/**
	 * Chama o construtor da classe pai
	 */
	public function __construct()
	{
		parent::__construct();
	}
	

	/**
	 * Método inicial que faz a renderização básica da página
	 * @param $parametros
	 * @return void
	 */
	public function index($parametros)
	{
        $view = new View('contato.php');
		$this->view_variaveis_obrigatorias($view);

        if (!isset($_SERVER['HTTP_REFERER'])) {
            if (!isset($_SESSION['anterior'])) {
                $anterior = SITE_URL;
            } else {
                $anterior = $_SESSION['anterior'];
            }
        } else {
            $anterior = $_SERVER['HTTP_REFERER'];
            $_SESSION['anterior'] = $anterior;
        }

        $view->set_variavel('anterior', $anterior);

		$view->set_variavel('body_class', 'contato');
		$view->set_variavel('notificacao', new Notificacao);

        $view->set_variavel('pagina_title', 'Contato');
        $view->set_variavel('pagina_description', '');
        $view->set_variavel('pagina_keywords', '');

		$view->exibir();
	}

	/* ***************************** MÉTODOS EXTRAS ***************************** */

    /**
     * Passa as informações para a montagem e envio do email a partir do formulário "Contato"
     * @param $parametros
     * @return void
     */
    public function enviar($parametros)
    {
        $nome = isset($parametros->contato_nome) ? trim($parametros->contato_nome) : NULL;
        $email = isset($parametros->contato_email) ? trim($parametros->contato_email) : NULL;
        $ddd = isset($parametros->contato_ddd) ? trim($parametros->contato_ddd) : NULL;
        $fone = isset($parametros->contato_fone) ? trim($parametros->contato_fone) : NULL;
        $uf = isset($parametros->contato_uf) ? trim($parametros->contato_uf) : NULL;
        $cidade = isset($parametros->contato_cidade) ? trim($parametros->contato_cidade) : NULL;
        $assunto = isset($parametros->contato_assunto) ? trim($parametros->contato_assunto) : NULL;
        $produto = isset($parametros->contato_produto) ? trim($parametros->contato_produto) : NULL;
		$mensagem = isset($parametros->contato_mensagem) ? trim($parametros->contato_mensagem) : NULL;

        if ( ! empty($nome) AND ! empty($email) AND ! empty($mensagem) AND ! empty($ddd) AND ! empty($fone) AND ! empty($assunto) AND ! empty($cidade) AND ! empty($uf))
        {
            $mail = new Controller_Email;

            if ($mail->contato($parametros))
            {
                echo json_encode(array('tipo'=>'sucesso', 'mensagem'=>'Sua mensagem foi enviada com sucesso!'));
            }
            else
            {
                echo json_encode(array('tipo'=>'erro', 'mensagem'=>'Ocorreu um erro ao enviar sua mensagem.'));
            }
        }
        else
        {
            echo json_encode(array('tipo'=>'erro', 'mensagem'=>'Ocorreu um erro ao receber suas informações.'));
        }
    }
	

} // end class