<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/**
 * Classe Funcoes
 *
 * Coleção de funções utilizadas pelo site. Preferencialmente elas devem ser declaradas
 * como STATIC, permitindo que sejam chamadas sem a necessidade de se instanciar um objeto.
 */
 
/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe


*/

class Funcoes
{
	/**
	 * Faz o tratamento de dados inseridos pelo usuário antes de acessar o banco de dados
	 * @static
	 * @param $valor
	 * @return string|void
	 */
	public static function mysqli_escape($valor)
	{
		global $bd;

		if ( ! is_null($valor))
		{
			$valor = function_exists('mysqli_real_escape_string') ? mysqli_real_escape_string($bd->get_conexao(), $valor) : addcslashes($valor, '%_\\\n\r\"\'');
		}

		return $valor;
	}


	/**
	 * Retorna o nome do mês por extenso, com a opção de ser abreviado
	 * @static
	 * @param  $mes
	 * @param bool $abreviatura
	 * @return string
	 */
	public static function mes_nome($mes, $abreviatura = FALSE)
	{
		switch ( (int) $mes)
		{
			case 1: return $abreviatura ? 'Jan' : 'Janeiro';
			case 2: return $abreviatura ? 'Fev' : 'Fevereiro';
			case 3: return $abreviatura ? 'Mar' : 'Março';
			case 4: return $abreviatura ? 'Abr' : 'Abril';
			case 5: return $abreviatura ? 'Mai' : 'Maio';
			case 6: return $abreviatura ? 'Jun' : 'Junho';
			case 7: return $abreviatura ? 'Jul' : 'Julho';
			case 8: return $abreviatura ? 'Ago' : 'Agosto';
			case 9: return $abreviatura ? 'Set' : 'Setembro';
			case 10: return $abreviatura ? 'Out' : 'Outubro';
			case 11: return $abreviatura ? 'Nov' : 'Novembro';
			case 12: return $abreviatura ? 'Dez' : 'Dezembro';
		}
	}


	/**
	 * Retorna o nome do dia da semana por extenso, com a opção de ser abreviado
	 * @static
	 * @param  $mes
	 * @param bool $abreviatura
	 * @return string
	 */
	public static function dia_da_semana_nome($dia_da_semana, $abreviatura = FALSE)
	{
		switch ( (int) $dia_da_semana)
		{
			case 0: return $abreviatura ? 'Dom' : 'Domingo';
			case 1: return $abreviatura ? 'Seg' : 'Segunda-feira';
			case 2: return $abreviatura ? 'Ter' : 'Terça-feira';
			case 3: return $abreviatura ? 'Qua' : 'Quarta-feira';
			case 4: return $abreviatura ? 'Qui' : 'Quinta-feira';
			case 5: return $abreviatura ? 'Sex' : 'Sexta-feira';
			case 6: return $abreviatura ? 'Sáb' : 'Sábado';
		}
	}


	/**
	 * Recebe um texto e transforma (http://cubiq.org/the-perfect-php-clean-url-generator
	 * @param $str
	 * @param array $replace
	 * @param string $delimiter
	 * @return mixed|string
	 */
	public static function texto_para_seo($str, $replace=array(), $delimiter='-')
	{
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}


	/**
	 * Monta a tag TH que é utilizada nas tabelas com opção de ordenação da listagem
	 * @static
	 * @param $controller
	 * @param $metodo
	 * @param $paginacao
	 * @param $buscar
	 * @param $item
	 * @param $ordenar_por
	 * @param $ordem
	 * @return string
	 */
	public static function montar_th_ordenacao_listagem($controller, $metodo, $paginacao, $buscar, $item, $ordenar_por, $ordem)
	{
		// Trata o item antes para as comparações a seguir
		$item_seo = Funcoes::texto_para_seo($item);

		// Cria o TH e se for o caso, adiciona a classe de atual item sendo ordenado
		$html = '<th class="'.($ordenar_por == $item_seo ? 'current' : '').'">';
			// Cria o A e o HREF, e adiciona o início da URL com os elementos necessários
			$html .= '<a href="'.SITE_URL.'/fatorcms/'.$controller.( ! is_null($metodo) ? '/'.$metodo : '');
				// Parâmetros para a ordenação
				$html .= '/ordenar-por/'.$item_seo.'/ordem/'.(($ordenar_por == $item_seo AND $ordem == 'asc') ? 'desc' : 'asc');

				// Se está sendo feita uma busca, a ordenação tem que respeitá-la
				if (strlen($buscar) > 0)
				{
					$html .= '/buscar/'.$buscar;
				}

				// Se está percorrendo as páginas de resultados, a ordenação tem que respeitar isso também
				if ($paginacao->get_sendo_usada())
				{
					$html .= '/pagina/'.$paginacao->get_pagina_atual();
				}

				$html .= '" '; // fechou o href

				$html .= 'class="'.(($ordenar_por == $item_seo AND $ordem == 'desc') ? 'up' : 'down').'">';
				$html .= $item;
			$html .= '</a>';
		$html .= '</th>';

		return $html;
	}


	/**
	 * Verifica se um conjunto de dígitos é um CPF válido
	 * @static
	 * @param $cpf
	 * @return bool
	 */
	public static function cpf_validar($cpf)
	{
		// Verifiva se o número digitado contém todos os digitos
		$cpf = str_pad(preg_replace('/[^0-9_]/', '', $cpf), 11, '0', STR_PAD_LEFT);

		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 || ! is_numeric($cpf) || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
		{
			return false;
		}
		else
		{
			// Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++)
			{
				for ($d = 0, $c = 0; $c < $t; $c++)
				{
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d)
				{
					return false;
				}
			}
			return true;
		}
	}


	/**
	 * (cnpj_validar) isCnpjValid
	 *
	 * Esta função testa se um Cnpj é valido ou não.
	 *
	 * @author	Raoni Botelho Sporteman <raonibs@gmail.com>
	 * @version	1.0 Debugada em 27/09/2011 no PHP 5.3.8
	 * @param	string		$cnpj			Guarda o Cnpj como ele foi digitado pelo cliente
	 * @param	array		$num			Guarda apenas os números do Cnpj
	 * @param	boolean		$isCnpjValid	Guarda o retorno da função
	 * @param	int			$multiplica 	Auxilia no Calculo dos Dígitos verificadores
	 * @param	int			$soma			Auxilia no Calculo dos Dígitos verificadores
	 * @param	int			$resto			Auxilia no Calculo dos Dígitos verificadores
	 * @param	int			$dg				Dígito verificador
	 * @return	boolean						"true" se o Cnpj é válido ou "false" caso o contrário
	 *
	 */

	public static function cnpj_validar($cnpj)
	{
		//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cnpj em diferentes formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00" etc...
		$j=0;
		for($i=0; $i<(strlen($cnpj)); $i++)
		{
			if(is_numeric($cnpj[$i]))
			{
				$num[$j]=$cnpj[$i];
				$j++;
			}
		}
		//Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
		if(count($num)!=14)
		{
			$isCnpjValid=false;
		}
		//Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria um cnpj válido após o calculo dos dígitos verificares e por isso precisa ser filtradas nesta etapa.
		if ($num[0]==0 && $num[1]==0 && $num[2]==0 && $num[3]==0 && $num[4]==0 && $num[5]==0 && $num[6]==0 && $num[7]==0 && $num[8]==0 && $num[9]==0 && $num[10]==0 && $num[11]==0)
		{
			$isCnpjValid=false;
		}
		//Etapa 4: Calcula e compara o primeiro dígito verificador.
		else
		{
			$j=5;
			for($i=0; $i<4; $i++)
			{
				$multiplica[$i]=$num[$i]*$j;
				$j--;
			}
			$soma = array_sum($multiplica);
			$j=9;
			for($i=4; $i<12; $i++)
			{
				$multiplica[$i]=$num[$i]*$j;
				$j--;
			}
			$soma = array_sum($multiplica);
			$resto = $soma%11;
			if($resto<2)
			{
				$dg=0;
			}
			else
			{
				$dg=11-$resto;
			}
			if($dg!=$num[12])
			{
				$isCnpjValid=false;
			}
		}
		//Etapa 5: Calcula e compara o segundo dígito verificador.
		if(!isset($isCnpjValid))
		{
			$j=6;
			for($i=0; $i<5; $i++)
			{
				$multiplica[$i]=$num[$i]*$j;
				$j--;
			}
			$soma = array_sum($multiplica);
			$j=9;
			for($i=5; $i<13; $i++)
			{
				$multiplica[$i]=$num[$i]*$j;
				$j--;
			}
			$soma = array_sum($multiplica);
			$resto = $soma%11;
			if($resto<2)
			{
				$dg=0;
			}
			else
			{
				$dg=11-$resto;
			}
			if($dg!=$num[13])
			{
				$isCnpjValid=false;
			}
			else
			{
				$isCnpjValid=true;
			}
		}
		//Trecho usado para depurar erros.
		/*
		   if($isCnpjValid==true)
			   {
				   echo "<p><font color=\"GREEN\">Cnpj é Válido</font></p>";
			   }
		   if($isCnpjValid==false)
			   {
				   echo "<p><font color=\"RED\">Cnpj Inválido</font></p>";
			   }
		   */
		//Etapa 6: Retorna o Resultado em um valor booleano.
		return $isCnpjValid;
	}


    /**
	 * reduz o tamanho do texto
	 * @static
	 * @param $texto,$limite
	 * @return $texto
	 */
    public static function cortar_texto($texto, $limite, $sufixo = '...')
    {
       $texto = strip_tags($texto);
       if(strlen($texto) > $limite) {
               $espaco = substr($texto,$limite,1);
               while($espaco != " ") {
                       $espaco = substr($texto,$limite,1);
                       if ( ($espaco == " ") or ($espaco == ".") or ($limite >= strlen($texto)) )
                               break; // para o while se for um espaço
                       $limite++;
               }
               return substr($texto,0,$limite).$sufixo;
       }
       else
               return substr($texto,0,$limite);
    }
	
	public static function debugar($i)
    {
        echo '<pre>';
        var_dump($i);
        echo '</pre>';
        exit();
    }


} // end class

// Para a função de SEO
setlocale(LC_ALL, 'pt_BR.UTF8');