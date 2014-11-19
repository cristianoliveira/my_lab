<?php
/**
 * Faz o carregamento automático das Classes do sistema, procurando nos diretórios necessários
 */
function loader($classe_nome)
{
	// Separa o nome da classe
	$caminho = explode('_', strtolower($classe_nome));

	// Se tiver mais que um, é dentro de diretórios específicos como Controllers ou Models, ou é
	// dentro do FatorCMS
	if (count($caminho) > 1)
	{
		// Contador para nos ajudar a navegar pelo nome da classe sendo carregada
		$posicao = 0;

		// Variável que tem o caminho para incluir o arquivo
		$arquivo = '';

		// Se o primeiro item for "fatorcms", direciona tudo para o diretório /fatorcms
		if ($caminho[$posicao] == 'fatorcms')
		{
			$arquivo .= 'fatorcms/';
			$posicao++;
		}

		// Adicionar um 's' no Controller e Model
		$caminho[$posicao] .= ($caminho[$posicao] == 'controller' OR $caminho[$posicao] == 'model') ? 's' : '';

		for ($i=$posicao; $i<(count($caminho)-1); $i++)
		{
			// Tudo minúsculo porque os diretórios estão todos em minúsculo
			$arquivo .= $caminho[$i].'/';
		}

		// O nome do arquivo só é incluído aqui
		$arquivo .= end($caminho).'.php';

		if (file_exists($arquivo))
		{
			// Se a classe existe, require_once nela
			require_once $arquivo;
		}
	}
	else
	{
		// Se for direto o nome da classe, procura nos diretórios do sistema
		$diretorios = array('biblioteca', 'sistema');

		foreach ($diretorios as $diretorio)
		{
			// Monta o caminho para o arquivo da classe
			$arquivo = strtolower($diretorio.'/'.$classe_nome.'.php');

			if (file_exists($arquivo))
			{
				// Se a classe existe, require_once nela
				require_once $arquivo;
				// E cai fora do loop
				break;
			}
		}
	}
}

spl_autoload_register('loader');