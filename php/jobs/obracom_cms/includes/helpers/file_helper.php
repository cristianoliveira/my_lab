<?php

class FileHelper{

    static function upload($nome, $novo_nome, $pastaServidor, $tiposPermitido = null){

        if(isset($_FILES[$nome]))
        {
            log_file("FILE existe");
                
            $extensao = explode('.',$_FILES[$nome]['name']);
            
            if($tiposPermitido!=null)
            {
                log_file("Extensao aaa $extensao[1]");

                if(array_search($extensao[1], $tiposPermitido) == false)
                {
                    log_file("Nao Extensao ");
                    return false;
                }
            }

            log_file("Tenta mover para $pastaServidor");
                
            return move_uploaded_file($_FILES[$nome]['tmp_name'], $pastaServidor . $novo_nome. ".$extensao[1]");
        }
        else
        {
            return false;
        }
    }

    static function base64ToJpg($base64_string, $output_file) {

        try {
        
            $ifp = fopen($output_file, "wb"); 

            $data = explode(',', $base64_string);

            fwrite($ifp, base64_decode($data[1])); 
            fclose($ifp); 
        
        } catch (Exception $e) {
            return false;
        }
        
        return true;
    }
}


?>