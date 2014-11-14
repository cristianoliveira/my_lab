<?php
/**
 * Configurações básicas do sistema
 *
 * Todas as requisições passam por esta página. Aqui são definidas algumas configurações iniciais
 * e em seguida a classe Iniciar é iniciada e a partir dela a mágica acontece.
 */

// Informações de conexão com o Banco de Dados
$bd_config = array(

// Configuração para acesso ao nosso banco local
'fdserver' => array(
	'url'            => 'mysql06-farm13.kinghost.net', /* mysql.movelclube.com.br */
	'usuario'        => 'movelclube',
	'senha'          => '23593nsj',
	'banco'          => 'movelclube',
	'tabela_prefixo' => 'fd_'
	),

//-----
// Configuração para acesso ao banco da prévia ou banco final do cliente
'cliente' => array(
	'url'            => 'mysql06-farm13.kinghost.net', /* mysql.movelclube.com.br */
	'usuario'        => 'movelclube',
	'senha'          => '23593nsj',
	'banco'          => 'movelclube',
	'tabela_prefixo' => 'fd_'
	),
);

//-----

// Configurações para o envio dos emails
$email_config = array(

'fdserver' => array(
    'para'          => 'junior@obrcom.com.br',
	'para_nome'     => 'Movel Clube - Desenvolvimento',
    'cc'            => 'junior@obrcom.com.br',
    'cc_nome'       => 'Movel Clube - Desenvolvimento',
    'de'            => 'junior@obrcom.com.br',
	'de_nome'       => 'Movel Clube - Desenvolvimento',
    'reply_to'      => 'junior@obrcom.com.br',
	'reply_to_nome' => 'Movel Clube - Desenvolvimento',
    'return_path'   => 'junior@obrcom.com.br',
	'smtp_enviar'   => FALSE,
	'smtp_servidor' => '',
	'smtp_porta'    => '',
	'smtp_cripto'   => '',
	'smtp_usuario'  => '',
	'smtp_senha'    => ''
	),

'cliente' => array(
	'para'          => 'movelclube@movelclube.com.br',
	'para_nome'     => 'Movel Clube',
    'cc'            => 'junior@obraprima.ppg.br',
    'cc_nome'       => 'Junior',
	'de'            => 'movelclube@movelclube.com.br',
	'de_nome'       => 'Movel Clube',
	'reply_to'      => 'movelclube@movelclube.com.br',
	'reply_to_nome' => 'Movel Clube',
	'return_path'   => 'movelclube@movelclube.com.br',
	'smtp_enviar'   => FALSE,
	'smtp_servidor' => 'smtp.kinghost.com.br',
	'smtp_porta'    => 587,
	'smtp_cripto'   => 'ssl',
	'smtp_usuario'  => 'movelclube@movelclube.com.br',
	'smtp_senha'    => 'm4m7m4u3'
	)
);

//-----

// Configurações do PagSeguro

$pagseguro_config = array(

'fdserver' => array(
	'email' => 'fatordigital@fatordigital.com.br',
	'token' => 'B032F04641B04BA884B5D42C4C8ADC07'
	),

'cliente' => array(
	'email' => 'viniciusbudde@gmail.com',
	'token' => '5BD4C4542A274C2BA1613D36CCEC2084'
	)
);


// Nome do controller que deve ser usado quando nenhum for passado
define('CONTROLLER_PADRAO', 'Index');

// Nome do método que será executada no controller caso uma não seja definida
define('METODO_PADRAO', 'index');

// O sistema está rodando no Apache ou no IIS 6?
define('IS_IIS', preg_match('/IIS/', $_SERVER['SERVER_SOFTWARE']));

// Configura a codificação para as funções multi_byte
mb_internal_encoding('UTF-8');


//----------

// Abaixo estão definidas as regras de como o sistema deve usar a URL que recebe
$regras_especiais = array(
	'pagina/=$pagina',
	'ordenar-por/=$ordenar_por',
	'ordem/=$ordem',
	'aba/=$aba',
	'imagem/=$tamanho_imagem',
	'buscar/=$buscar',
);

$regras = array(
	'fatorcms=@diretorio/=@controller/=@metodo',
	'produtos=@controller/cadeiras=$categoria_seo',
	'produtos=@controller/mobiliario=$categoria_seo',
	'produtos=@controller/acessorios=$categoria_seo',
	'produto=@controller/=$nome_seo',
	'enquete=@controller/votar=@metodo',
	'enquete=@controller/=$pergunta_seo',
	'erro=@controller/=$numero',
    '=@controller/=@metodo'
);