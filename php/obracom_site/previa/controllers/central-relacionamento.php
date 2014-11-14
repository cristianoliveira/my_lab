<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Controller_CentralRelacionamento extends Controller_Padrao
{
	public function __construct()
	{
		parent::__construct();
	}

    public function index($parametros)
	{
		parent::iniciar($parametros);
    }
	
	/**
	 * Passa as informações para a montagem e envio do email a partir do formulário "Central de Relacionamento" da página inicial do site
	 * @param $parametros
	 * @return void
	 */
	public function enviar($parametros)
	{
		$nome = isset($parametros->informacao_nome) ? trim($parametros->informacao_nome) : NULL;
        $email = isset($parametros->informacao_email) ? trim($parametros->informacao_email) : NULL;
        $ddd = isset($parametros->informacao_ddd) ? trim($parametros->informacao_ddd) : NULL;
        $fone = isset($parametros->informacao_fone) ? trim($parametros->informacao_fone) : NULL;
        $uf = isset($parametros->uf) ? trim($parametros->uf) : NULL;
        $cidade = isset($parametros->informacao_cidade) ? trim($parametros->informacao_cidade) : NULL;
        $assunto = isset($parametros->assunto) ? trim($parametros->assunto) : NULL;
        $mensagem = isset($parametros->informacao_mensagem) ? trim($parametros->informacao_mensagem) : NULL;

		if ( ! empty($nome) AND ! empty($email) AND ! empty($mensagem) AND ! empty($ddd) AND ! empty($fone) AND ! empty($assunto) AND ! empty($cidade) AND ! empty($uf))
		{
			$mail = new Controller_Email;

			if ($mail->central_relacionamento($parametros))
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

    public function cidade_disponivel($parametros)
    {
        $nome = isset($parametros->nome) ? trim($parametros->nome) : NULL;
        $email = isset($parametros->email) ? trim($parametros->email) : NULL;
        $ddd = isset($parametros->ddd) ? trim($parametros->ddd) : NULL;
        $fone = isset($parametros->fone) ? trim($parametros->fone) : NULL;
        $uf = isset($parametros->uf2) ? trim($parametros->uf2) : NULL;
        $cidade = isset($parametros->cidade) ? trim($parametros->cidade) : NULL;
        $mensagem = isset($parametros->mensagem) ? trim($parametros->mensagem) : NULL;

        //echo '<br>Nome: '.$nome;
        //echo '<br>Email: '.$email;
        //echo '<br>Telefone: ('.$ddd.') '.$fone;
       // echo '<br>uf: '.$uf;
        //echo '<br>Cidade: '.$cidade;
        //echo '<br>Mensagem: '.$mensagem.'<br>';

        if ( ! empty($nome) AND ! empty($email) AND ! empty($mensagem) AND ! empty($ddd) AND ! empty($fone) AND ! empty($cidade) AND ! empty($uf))
        {
            $mail = new Controller_Email;

            if ($mail->cidade_disponivel($parametros))
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