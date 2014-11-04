<?php

/*
 ************************************************************************
 PagSeguro Config File
 ************************************************************************
 */

$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = "production"; // production, sandbox

$PagSeguroConfig['credentials'] = array();
$PagSeguroConfig['credentials']['email'] = "cia@ciadoescritorio.com.br";
$PagSeguroConfig['credentials']['token']['production'] = "E928D9D5FCE4417699ED0FFE1C1983A1";
$PagSeguroConfig['credentials']['token']['sandbox'] = "364E6F91BFC24772BBBF561106FFD892";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = true;
$PagSeguroConfig['log']['fileLocation'] = "../log_pag.txt";
