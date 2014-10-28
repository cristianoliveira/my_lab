<?php

function if_exist(&$variable, $return_if_null='')
{
	$variable = str_replace('"', '\'', $variable);
	return isset($variable)? $variable : $return_if_null;
}

function if_null(&$variable, $return_if_null='')
{
	$variable = str_replace('"', '\'', $variable);
	return (!empty($variable))? $variable : $return_if_null;
}

function par_get($var){
	return isset($_GET[$var])? $_GET[$var] : NULL;
}

function par_post($var){
	return isset($_POST[$var])? $_POST[$var] : NULL;
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
}