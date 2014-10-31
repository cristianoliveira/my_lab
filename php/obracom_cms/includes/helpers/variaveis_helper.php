<?php

function if_exist(&$variable, $returnIfNull='')
{
	$variable = str_replace('"', '\'', $variable);
	return isset($variable)? $variable : $returnIfNull;
}

function if_null(&$variable, $returnIfNull='')
{
	$variable = str_replace('"', '\'', $variable);
	return (!empty($variable))? $variable : $returnIfNull;
}

function if_not_null(&$variable, $return='', $returnIfNull='')
{
	$variable = str_replace('"', '\'', $variable);
	return (isset($variable) && !empty($variable))? $return : $returnIfNull;
}

function par_get($var){
	return isset($_GET[$var])? $_GET[$var] : NULL;
}

function par_post($var){
	return isset($_POST[$var])? $_POST[$var] : NULL;
}

function trata_valores($valor)
{
	return (empty($valor)) ? "0.00": str_replace(",", ".", $valor['valor_original']);
}

class Parameter{
	
	public static function GET($var=null, $returnIfNull=null)
	{
		if(empty($var))
			return isset($_GET)? $_GET : $returnIfNull;
		else
			return isset($_GET[$var])? $_GET[$var] : $returnIfNull;
	}
	
	public static function POST($var=null, $returnIfNull = null)
	{
		if(empty($var))
			return isset($_POST)? $_POST : $returnIfNull;
		else
			return isset($_POST[$var])? $_POST[$var] : $returnIfNull;
	}

	public static function FILE($var=null, $returnIfNull = null)
	{
		if(empty($var))
			return isset($_FILES)? $_FILES : $returnIfNull;
		else
			return isset($_FILES[$var])? $_FILES[$var] : $returnIfNull;
	}
}