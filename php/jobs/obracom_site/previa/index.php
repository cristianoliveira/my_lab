<?php

// Include das condigurações de banco, email e diretórios
require_once 'config.php';

// Início da lógica do sistema
// Monta a URL do sistema
$diretorios = explode('/', $_SERVER['PHP_SELF']);

// Retira o 'index.php'
if ($diretorios[count($diretorios)-1] == 'index.php')
{
	unset($diretorios[count($diretorios)-1]);
}

// ATENÇÃO: Não colocar o '/' final nos endereços abaixo
// Utilizado para imagens, css, javascript e outros includes
define('SITE_BASE', 'http://'.$_SERVER['HTTP_HOST'].implode('/', $diretorios));
// Utilizado para requisições pelo sistema, como formulários e links
define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].implode('/', $diretorios).( IS_IIS ? '/index.php' : ''));

// Salva onde o sistema está sendo executado para buscar as configurações
if (strpos($_SERVER['HTTP_HOST'], 'fdserver') !== FALSE OR strpos($_SERVER['HTTP_HOST'], 'localhost') !== FALSE)
{
	$site_local = 'fdserver';
}
else
{
	$site_local = 'cliente';
}
define ('SITE_LOCAL', $site_local);

file_put_contents('indexlog.txt','INICIO'."\n");
file_put_contents('indexlog.txt',print_r($diretorios,true)."\n");


// Carrega a função de Autoload para que seja possível instanciar uma classe sem fazer o include na mão
require_once 'sistema/autoloader.php';
// Classe que cuida das requisições e redirecionada para os lugares certos
require_once 'sistema/iniciar.php';