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
$PagSeguroConfig['credentials']['token']['production'] = "B5CF32EB6D8B469894AB942574ECC447";
$PagSeguroConfig['credentials']['token']['sandbox'] = "27E422A70393487895BA9AB8D2AD2441";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = true;
$PagSeguroConfig['log']['fileLocation'] = "../log_pag.txt";
