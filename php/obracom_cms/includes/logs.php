<?php
/**
* Função para salvar mensagens de LOG no MySQL
*
* @param string $mensagem - A mensagem a ser salva
*
* @return bool - Se a mensagem foi salva ou não (true/false)
*/
function salvaLog($mensagem) {
$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
$hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)

// Usamos o mysql_escape_string() para poder inserir a mensagem no banco
//   sem ter problemas com aspas e outros caracteres
$mensagem = mysql_escape_string($mensagem);

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `logs` VALUES (NULL, '".$hora."', '".$ip."', '".$mensagem."')";

if (mysql_query($sql)) {
return true;
} else {
return false;
}
}

function log_file($text){
    
    // $data = date('Ymd'); // Salva a data e hora atual (formato MySQL)
    // $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
    // $myfile = "../$data.log";
    
    // $buffer = '';
    
    // if (file_exists($myfile)) {
    //     $buffer = file_get_contents($myfile) . "\n" . "$hora - $text";
    // }

    // $success = file_put_contents($myfile, $buffer );
}

?>
