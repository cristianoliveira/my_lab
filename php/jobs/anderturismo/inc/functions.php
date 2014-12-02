<?php 
function insereCarrinho($camposForm) {
$camposForm = $camposForm;

	$conn = mysql_connect("mysql.andesturismo.com.br","andesturismo02","c1a5k0"); // editar host, usuario, senha
	mysql_select_db("andesturismo02",$conn); // editar para o seu banco de dados 

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `roteiros_selecionados` VALUES ($camposForm)"; 

	if (mysql_query($sql)) {
		$id_grupo = mysql_insert_id();
    	$_SESSION['uidc'] = $id_grupo;
		return true;
	} else {
		return false;
	}
}

function insereNews($camposForm) {
$camposForm = $camposForm;

	$conn = mysql_connect("mysql.andesturismo.com.br","andesturismo02","c1a5k0"); // editar host, usuario, senha
	mysql_select_db("andesturismo02",$conn); // editar para o seu banco de dados 

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `news` VALUES ($camposForm)"; 

	if (mysql_query($sql)) {
		return true;
	} else {
		return false;
	}
}

//função para reverter as datas do banco de dados
function formatarData($date) {
 $date = implode("/", array_reverse(explode("-", $date)));
 return $date;
}

function cadastroBanco($nomeTabela, $camposForm) {
$camposForm = $camposForm;

	$conn = mysql_connect("mysql.andesturismo.com.br","andesturismo02","c1a5k0"); // editar host, usuario, senha
	mysql_select_db("andesturismo02",$conn); // editar para o seu banco de dados 

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `$nomeTabela` VALUES ($camposForm)"; 

	if (mysql_query($sql)) {
		$id_grupo = mysql_insert_id();
    	$_SESSION['uidc'] = $id_grupo;
		return true;
	} else {
		return false;
	}
}
	
function select($tabela,$campo,$where,$order){
	
	$conn = mysql_connect("mysql.andesturismo.com.br","andesturismo02","c1a5k0"); // editar host, usuario, senha
	mysql_select_db("andesturismo02",$conn); // editar para o seu banco de dados 
	
	$sql = "SELECT {$campo} FROM {$tabela} {$where} {$order}";
	$query = mysql_query($sql);
	
	$sql_rows = "SELECT {$campo} FROM {$tabela} {$where}";//echo
	$query_rows = mysql_query($sql_rows);
	$num = mysql_num_fields($query_rows);
	for($y = 0; $y < $num; $y++){ 
		$names[$y] = mysql_field_name($query_rows,$y);
	}
	for($k=0;$resultado = mysql_fetch_array($query);$k++){
		for($i = 0; $i < $num; $i++){ 
			$resultados[$k][$names[$i]] = $resultado[$names[$i]];
		}
	}
	mysql_close($conn);
	return @$resultados; // retorna um array com os resultados da consulta
}

function resume( $var, $limite )
{
        // Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
        if (strlen($var) > $limite)
        {
                $var = substr($var, 0, $limite);
                $var = trim($var);
				//$var = trim($var) . " [...]";
        }

return $var;
}

function anti_sql_injection($str) {
if (!is_numeric($str)) {
$str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
$str = function_exists('mysql_real_escape_string') ? mysql_real_escape_string($str) : mysql_escape_string($str);
}
return $str;
}

function jf_anti_injection($sql) {
    $sql = mysql_real_escape_string($sql);
    return $sql;
}


?>