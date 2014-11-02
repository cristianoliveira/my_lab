<?php

/*
 ************************************************************************
 PagSeguro Config File
 ************************************************************************
 */

$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = "sandbox"; // production, sandbox

$PagSeguroConfig['credentials'] = array();
$PagSeguroConfig['credentials']['email'] = "cia@ciadoescritorio.com.br";
$PagSeguroConfig['credentials']['token']['production'] = "46C41E27DACA4522AA8182FB798182F2";
$PagSeguroConfig['credentials']['token']['sandbox'] = "364E6F91BFC24772BBBF561106FFD892";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = true;
$PagSeguroConfig['log']['fileLocation'] = "../log_pag.txt";
