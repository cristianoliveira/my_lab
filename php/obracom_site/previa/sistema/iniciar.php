<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/**
 * Classe Iniciar
 *
 * Esta classe gerencia as requisições feitas no site, através de $_GETs e $_POSTs, e em seguida iniciando as
 * classes necessárias, chamando os métodos e passando os parâmetros
 */
 
/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe

TODO: transformar os parâmetros que vem por $_GET ou REQUEST_URI em parametros mesmo (?campo1=qwe&campo2=asd&escondido1=Rodrigo&escondido2=Saling)
TODO: pode acontecer dos parâmetros acima entrarem como metodo, cuidar isso de alguma maneira (rotas)

2011-08-17 : adicionado a opção de definir "rotas" e agora é possível utilizar nomes complexos de controllers

*/

class Iniciar extends Sistema
{
	protected $diretorio;
	protected $controller;
	protected $metodo;
	protected $parametros;
	protected $parametro_i;

	public function get_diretorio() {return $this->diretorio;}
	public function set_diretorio($nome) {$this->diretorio = trim($nome);}

	public function get_controller() {return $this->controller;}
	public function set_controller($nome) {$this->controller = strtolower(trim($nome));}
	
	public function get_metodo() {return $this->metodo;}	
	public function set_metodo($nome) {$this->metodo = strtolower(trim($nome));}
	
	public function get_parametros() {return $this->parametros;}
	public function set_parametros($parametros)
	{
		if (is_object($parametros))
		{
			$parametros = get_object_vars($parametros);
		}

		if (is_array($parametros))
		{
			foreach ($parametros as $nome=>$valor)
			{
				$this->parametros->$nome = is_string($valor) ? urldecode(trim($valor)) : urldecode($valor);
			}
		}

	}

	public function get_parametro($nome) {return $this->parametros->$nome;}
	public function set_parametro($nome = NULL, $valor)
	{
		if (empty($nome))
		{
			$nome = '_'.$this->get_parametro_i();
			// Incrementa o contador de parâmetros para o próximo uso
			$this->set_parametro_i($this->get_parametro_i()+1);
		}

		// Adiciona a propriedade no objeto, junto com o valor
		$this->parametros->$nome = is_string($valor) ? urldecode(trim($valor)) : urldecode($valor);

		//$parametro = array(trim($nome) => trim($valor));
		//$this->parametros = (object) $parametro;
	}

	public function get_parametro_i() {return $this->parametro_i;}
	public function set_parametro_i($integer) {$this->parametro_i = (int) $integer;}


	/**
	 * Por enquanto só chama o contrutor da classe pai
	 */
    public function __construct()
    {
		parent::__construct();

	    // Inicializa o objeto parametros para receber n propriedades
	    $this->parametros = new stdClass;
	    $this->set_parametro_i(0);
	}


	/**
	 * Busca as requisições e salva as informações necessárias para dar continuidade na criação dos objetos necessários  	
	 */
	public function iniciar()
	{
		$url_completa = urldecode($_SERVER['REQUEST_URI']);
		// Limpa da URL retirando parte desnecessária inicial
		$url_parametros = str_replace(explode('/',$_SERVER['PHP_SELF']), '', $url_completa);

		//-----
		
		// Verifica se há algo vindo via GET, por exemplo "?busca=abc", e adiciona nos parametros do objeto
		$this->get_parametros_adicionar($url_completa, $url_parametros);

		//-----

		// Separa todos os elementos da URL com base na utilizaçao de pretty/clean URL
        $parametros = explode ('/', str_replace('//', '/', $url_parametros));
		// Limpa os itens em branco do array
		$parametros_cont = count($parametros);
		for ($i=0; $i<$parametros_cont; $i++)
		{
			if (isset($parametros[$i]) AND strlen(trim($parametros[$i])) == 0)
			{
				unset($parametros[$i]);
			}
		}
		$parametros = array_values($parametros); // Reorganiza os índices do array

		// ! Aqui temos um array começando no índice zero contendo todos os elementes que antes estavam entre as "/" da URL

		// Nesta função, é feita a conferência entre o que tem de parâmetros da URL contra as regras estabelecidas para o funcionamento do site
		if (count($parametros) > 0)
		{
			$this->fazer_a_magica($parametros); // bringing some fun to the code!
		}

		//echo 'diretorio:'.$this->get_diretorio().'<br>';
		//echo 'controller:'.$this->get_controller().'<br>';
		//echo 'metodo:'.$this->get_metodo().'<br>';

		//-----

		// Caso a variável do controller ainda estaja vazia, define o valor padrão
        if (empty($this->controller))
        {
            $this->set_controller(CONTROLLER_PADRAO);
        }
		// Coloca a primeira letra em maiúculo. NÃO MAIS pelas diferenças entre SOs
		//$this->set_controller(ucfirst($this->get_controller()));
		
		// Caso a variável do metodo do controller ainda estaja vazia, define o valor padrão
        if (empty($this->metodo))
        {
            $this->set_metodo(METODO_PADRAO);
        }

		// Se houver algo enviado via POST, adiciona nos parâmetros
		if (isset($_POST) AND count($_POST) > 0)
		{
			$this->set_parametros($_POST);
		}
		// Se houver algo enviado via GET, adiciona nos parâmetros
		if (isset($_GET) AND count($_POST) > 0)
		{
			$this->set_parametros($_GET);
		}
    }

	private function fazer_a_magica($url_parametros)
	{
		global $regras, $regras_especiais;

		// Prepara as regras para serem usadas na verificação contra os parâmetros da URL
		$regras_parametros = array();
		$i = 0;
		foreach ($regras as $regra)
		{
			// Ex.: aqui separa '=@controller/=@metodo' em dois itens
			$regras_parametros[$i++] = explode('/', $regra);
			// Ex.: fica assim: array([0]=>'=@controller', [1]=>'=@metodo')
		}

		//-----

		// Percorre as regras especiais e salva os parâmetros
		if (count($regras_especiais) > 0)
		{
			// Regra especial, ex.: 'pagina/=$pagina'
			foreach ($regras_especiais as $regra_especial)
			{
				$regra_especial_parametros = explode('/', $regra_especial);
				// Pega a a próxima regra e a atribuição que vem logo depois
				$regra_parametro_proximo = $regra_especial_parametros[0]; // 'pagina'
				list($nome, $atribuicao) = explode('=', $regra_especial_parametros[1]); // '=$pagina' vira '' e '$pagina'

				// Procura nos parâmetros por ela
				//$url_parametros_aux = $url_parametros;
				$url_parametro_cont = 0;
				foreach ($url_parametros as $url_parametro)
				{
					// Se existir, pula para o próximo parâmetro e chama a função de transformação
					if ($url_parametro == $regra_parametro_proximo)
					{
						$this->set_parametro(str_replace('$','',$atribuicao), $url_parametros[$url_parametro_cont+1]);
						// Retira os parâmetros para que não sejam mais utilizados
						unset($url_parametros[$url_parametro_cont]); // Subtrai (depois de usado) devido ao incremento lá de baixo
						unset($url_parametros[$url_parametro_cont+1]); // Subtrai (depois de usado) devido ao incremento lá de baixo
						$url_parametros = array_values($url_parametros); // Reorganiza os índices do array

						break; // vai para a próxima regra especial
					}
					$url_parametro_cont++;
				}
			}
		}

		//-----

		// Percorre cada uma das regras (inteiras) estabelecidas anteriormente
		// Ex.: $regras_parametros: [0]=>'fatorcms=@diretorio',[1]=>'usuario=@controller',[2]=>'=@metodo'
		for ($regra_parametro_cont=0; $regra_parametro_cont<count($regras_parametros); $regra_parametro_cont++)
		{
			// Pega a primeira regra e em seguida o $nome dela
			$regra_primeira = $regras_parametros[$regra_parametro_cont][0];
			// Ex.: "=@controller", $nome fica "" e $atribuicao fica com "@controller"
			list($nome, $atribuicao) = explode('=', $regra_primeira);

			//-----

			$executar_regra = TRUE;
			// ... verifica se todos os parâmetros da regra estão na URL. Se sim, a regra será executada por inteiro
			for ($i=0; $i<count($regras_parametros[$regra_parametro_cont]); $i++)
			{
				$regra = $regras_parametros[$regra_parametro_cont][$i];
				// Ex.: "=@controller", $nome fica "" e $atribuicao fica com "@controller"
				list($nome, $atribuicao) = explode('=', $regra);

				//if ( ! empty($nome) AND isset($url_parametros[$i]) AND $url_parametros[$i] != $nome)
				if ( ! empty($nome))
				{
					if ( ! isset($url_parametros[$i]) OR (isset($url_parametros[$i]) AND $url_parametros[$i] != $nome))
					{
						$executar_regra = FALSE;
						break;
					}
				}
			}

			// ... e percorre toda a regra
			if ($executar_regra)
			{
				for ($i=0; $i<count($regras_parametros[$regra_parametro_cont]); $i++)
				{
					$regra = $regras_parametros[$regra_parametro_cont][$i];
					list($nome, $atribuicao) = explode('=', $regra);

					$this->transformar_parametro((isset($url_parametros[$i]) ? $url_parametros[$i] : NULL), $nome, $atribuicao);
				}

				// Se ainda existem parâmetros na URL e na regra não, adiciona o resto dos parâmetros como parâmetros mesmo
				for ($j=$i; $j<count($url_parametros); $j++)
				{
					$this->set_parametro(NULL, $url_parametros[$j]);
				}

				break; // Sai do FOR que percorre as regras
			}
		}
	}


	private function transformar_parametro($parametro, $nome, $atribuicao)
	{
		if ($atribuicao == '@diretorio' AND is_null($this->get_diretorio()))
		{
			$this->set_diretorio(empty($nome) ? $parametro : $nome);
		}
		elseif ($atribuicao == '@controller' AND is_null($this->get_controller()))
		{
			// Se não houver parâmetro na URL e nem um nome na regra, coloca o PADRAO
			if (empty($parametro) AND empty($nome))
			{
				$this->set_controller(CONTROLLER_PADRAO);
			}
			else
			{
				$this->set_controller(empty($nome) ? $parametro : $nome);
			}
		}
		elseif ($atribuicao == '@metodo' AND is_null($this->get_metodo()))
		{
			// Se não houver parâmetro na URL e nem um nome na regra, coloca o PADRAO
			if (empty($parametro) AND empty($nome))
			{
				$this->set_metodo(METODO_PADRAO);
			}
			else
			{
				$this->set_metodo(empty($nome) ? $parametro : $nome);
			}
			/*
			 * comentado para testes no dia 14/09/2011 17:47
			 // Se ainda não existe um Controller, adiciona o padrão
			 if (is_null($this->get_controller()))
             {
				$this->set_controller(CONTROLLER_PADRAO);
			 }
			*/
		}
		elseif (strpos($atribuicao, '$') !== FALSE)
		{
			$this->set_parametro(str_replace('$', '', $atribuicao), empty($nome) ? $parametro : $nome);

            /*
			 * comentado para testes no dia 14/09/2011 17:47
			// Se ainda não existe um Controller, adiciona o padrão
			if (is_null($this->get_controller()))
			{
				$this->set_controller(CONTROLLER_PADRAO);
			}
			// Se ainda não existe um método para chamar no Controller, adiciona o padrão
			if (is_null($this->get_metodo()))
			{
				$this->set_metodo(METODO_PADRAO);
			}
            */
		}
	}



	/**
	 * Utilizando os dados da função redirecionar, esta aqui instancia a classe da requisição, chama o método correspondente
	 * e se houver, passa os parâmetros necessários
	 */
	public function redirecionar()
	{
		// Monta o caminho para o arquivo do controller que queremos dar require
		// Aqui o nome que vem da URL com hífen, ex.: "area-restrita", é igual ao nome do arquivo
		$arquivo = (empty($this->diretorio)?'':$this->get_diretorio().'/').'controllers/'.$this->get_controller().'.php';

		// É o mesmo teste que a função autoload faz, mas aqui permite que o erro seja tratado
		if (file_exists($arquivo))
		{
			// Se o controller existe, require nele
			require_once $arquivo;

			// Adicionamos possíveis diretórios antes do nome do Controller
			// Aqui retiramos o hífen do nome do controller para juntar as palavras e criar o nome correto da classe
			$classe = (empty($this->diretorio) ? '' : $this->get_diretorio().'_').'Controller_'.(str_replace('-', '', $this->get_controller()));

			if (class_exists($classe))
			{
				// Instancia o objeto
				$controller = new $classe;

				// Trocamos os hífens do nome do método que vem da URL por underscores, que é o correto dentro da classe
				$metodo = str_replace('-', '_', $this->get_metodo());

				if (method_exists($controller, $metodo))
				{
					// Se o método existe dentro da classe do controller, executa ele
					if (is_null($this->get_parametros()))
					{
						$controller->$metodo(); 
					}
					else
					{
						$controller->$metodo($this->get_parametros());
					}
				}
				else
				{
					/*$this->notificacao->set_mensagem('Conte&uacute;do n&atilde;o encontrado.');
					$this->notificacao->sistema_exibir();*/
					$erro = new Controller_Erro(404);
					$erro->index();
					die;
				}
			}
			else
			{
				/*$this->notificacao->set_mensagem('Conte&uacute;do n&atilde;o encontrado.');
				$this->notificacao->sistema_exibir();*/
				$erro = new Controller_Erro(404);
				$erro->index();
				die;
			}
		}
		else
		{
			/*$this->notificacao->set_mensagem('Conte&uacute;do n&atilde;o encontrado.');
			$this->notificacao->sistema_exibir();*/
			$erro = new Controller_Erro(404);
			$erro->index();
			die;
		}
	}

	
	/**
	 * Função que transforma o que for passado para ela em um array de parâmetros
	 * @param  $url_completa
	 * @param  $url_parametros
	 * @return void
	 */
	protected function get_parametros_adicionar($url_completa, &$url_parametros)
	{
		if (strpos($url_completa, '?') !== FALSE)
		{
			// Posição do ponto de interrogação
			$posicao = strpos($url_completa, '?');
			// Pega a string a partir do ponto de interrogação (+1 para deixar de ser 'inclusive')
			$url_completa_aux = substr($url_completa, $posicao+1);
			// Divide a string através da divisão entre parâmetros
			$parametros = explode('&', $url_completa_aux);
			if (count($parametros) > 0)
			{
				// Para cada parâmetro, adiciona no objeto
				foreach($parametros as $parametro)
				{
					// O nome do parâmetro é vai até o 'igual' e o valor é o que vier depois até o fim
					$this->set_parametro(substr($parametro, 0, strpos($parametro, '=')), substr($parametro, strpos($parametro, '=')+1));
				}
			}
			// Limpa a string que será usada nas clean urls (retiramos o '?' lá em cima)
			$url_parametros = str_replace('?'.$url_completa_aux, '', $url_parametros);
		}
	}

} // end class

//-----------------------------------------------------------------------

// Inclui o acesso ao banco
require_once 'sistema/bd.php'; // Por que tem que ter esse sistema/???? É relativo ao include ou ao diretório original do arquivo? sempre achei que fosse do diretório original!

// Cria a instância do objeto
$start = new Iniciar;
// Inicialização da classe e início do funcionomento do sistema
$start->iniciar();
// Faz o redirecionomento apropriadao para o controller e metodo especificados
$start->redirecionar();
