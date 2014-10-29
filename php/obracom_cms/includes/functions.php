<?php
function atualizaCerveja($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `cervejas` SET  imagem = '$campo' WHERE idcervejas = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function atualizaSubCategoria($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `subcategorias` SET  imagem_subcategoria = '$campo' WHERE idsubcategorias = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function atualizaNovidade($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `novidades` SET  imagem = '$campo' WHERE id = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function cadastroNovidade($nomeTabela, $camposForm) {
$camposForm = $camposForm;

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `novidades` VALUES ($camposForm)"; 

    if (mysql_query($sql)) {
        $id_grupo = mysql_insert_id();
        $_SESSION['uidc'] = $id_grupo;
        return true;
    } else {
        return false;
    }
}

function cadastraCerveja($nomeTabela, $camposForm) {
$camposForm = $camposForm;

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `cervejas` VALUES ($camposForm)"; 

    if (mysql_query($sql)) {
        $id_grupo = mysql_insert_id();
        $_SESSION['uidc'] = $id_grupo;
        return true;
    } else {
        return false;
    }
}


function resume( $var, $limite )
{
        // Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
        if (strlen($var) > $limite)
        {
                $var = substr($var, 0, $limite);
                $var = trim($var) . "...";
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

function query_url($total_rows) {
    $query_string = "";
    if (!empty($_SERVER['QUERY_STRING'])) {
      $params = explode("&", $_SERVER['QUERY_STRING']);
      $newParams = array();
      foreach ($params as $param) {
        if (stristr($param, "page") == false && 
            stristr($param, "total_rows") == false && 
            stristr($param, "order") == false){             
          array_push($newParams, $param);
        }
      }
      if (count($newParams) != 0) {
        $query_string = "&". htmlentities(implode("&", $newParams));
      }
    }
    $query_string = sprintf("&total_rows=%d%s", $total_rows, $query_string);
    return $query_string;
}

function atualizaCategoria($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `categorias` SET  imagem = '$campo' WHERE idcategorias = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}



function cadastroBanco2($clausula) {

// Monta a query para inserir o log no sistema
$sql = $clausula; 

    if (mysql_query($sql)) {
        $id_grupo = mysql_insert_id();
        $_SESSION['uidc'] = $id_grupo;
        return true;
    } else {
        return false;
    }
}


function cadastroBanco($nomeTabela, $camposForm) {
$camposForm = $camposForm;

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

function cadastroProduto($nomeTabela, $camposForm) {
$camposForm = $camposForm;

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `$nomeTabela` (categoria_id, nome_produto, tamanho_produto, peso_produto, descricao) VALUES ($camposForm)"; 
// INSERT INTO produtos (categoria_id, nome_produto, tamanho_produto, peso_produto, descricao) VALUES('15', 'a', 'b', 'c', 'd' );

    if (mysql_query($sql)) {
        $id_grupo = mysql_insert_id();
        $_SESSION['uidc'] = $id_grupo;
        return true;
    } else {
        return false;
    }
}


function cadastroGaleria($nomeTabela, $camposForm) {
$camposForm = $camposForm;

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `$nomeTabela` VALUES ($camposForm)"; 
// INSERT INTO produtos (categoria_id, nome_produto, tamanho_produto, peso_produto, descricao) VALUES('15', 'a', 'b', 'c', 'd' );

    if (mysql_query($sql)) {
        $id_grupo = mysql_insert_id();
        $_SESSION['uidc'] = $id_grupo;
        return true;
    } else {
        return false;
    }
}





function atualizaBanner($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `banners` SET  imagem = '$campo' WHERE codigo = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

// *** FAZ O UPLOAD ***
function subirImagem($pasta, $arquivo){
        
    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = '../uploads/'.$pasta;
    
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
    
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('jpg', 'png', 'gif');
    
    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = true;
    
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
    
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($arquivo['error'] != 0) {
        $_SESSION['erro'] = "Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$arquivo['error']];
        return false;
    //exit; // Para a execução do script
    }
    
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar    
    // Faz a verificação da extensão do arquivo
    $extensao1 = explode('.', $arquivo['name']);
    $extensao = strtolower(end($extensao1));
    if (array_search($extensao, $_UP['extensoes']) === false) {
        $_SESSION['erro'] = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
        return false;
    }
    
    // Faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $arquivo['size']) {
        $_SESSION['erro'] = "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
        return false;
    }
    
    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    else {
    // Primeiro verifica se deve trocar o nome do arquivo
    if ($_UP['renomeia'] == true) {
    // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
    $nome_final = 'arquivo_'.time().'.jpg';
    
    } else {
    // Mantém o nome original do arquivo
    $nome_final = $arquivo['name'];
    }
    
    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($arquivo['tmp_name'], $_UP['pasta'] . $nome_final)) {
    // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
    $_SESSION['nomefinal'] = $nome_final;
    return true;
        
    } else {
    // Não foi possível fazer o upload, provavelmente a pasta está incorreta
    return false;
    //echo "Não foi possível enviar o arquivo, tente novamente";
    }
    }
    
}

// *** FAZ O UPLOAD ***
function subirImagem2($pasta, $arquivo){
        
    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = '../uploads/'.$pasta;
    
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
    
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('jpg','png');
    
    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = true;
    
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
    
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($arquivo['error'] != 0) {
        $_SESSION['erro'] = "Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$arquivo['error']];
        return false;
    //exit; // Para a execução do script
    }
    
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar    
    // Faz a verificação da extensão do arquivo
    $extensao1 = explode('.', $arquivo['name']);
    $extensao = strtolower(end($extensao1));
    if (array_search($extensao, $_UP['extensoes']) === false) {
        $_SESSION['erro'] = "Por favor, envie arquivos somente em JPG, JPEG, PNG.";
        return false;
    }
    
    // Faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $arquivo['size']) {
        $_SESSION['erro'] = "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
        return false;
    }
    
    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    else {
    // Primeiro verifica se deve trocar o nome do arquivo
    if ($_UP['renomeia'] == true) {
    // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
    $nome_final = 'arquivo_'.time().'.jpg';
    
    } else {
    // Mantém o nome original do arquivo
    $nome_final = $arquivo['name'];
    }
    
    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($arquivo['tmp_name'], $_UP['pasta'] . $nome_final)) {
    // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
    $_SESSION['nomefinal'] = $nome_final;
    return true;
        
    } else {
    // Não foi possível fazer o upload, provavelmente a pasta está incorreta
    return false;
    //echo "Não foi possível enviar o arquivo, tente novamente";
    }
    }
    
}

// *** FAZ O UPLOAD ***
function subirImagem3($pasta, $arquivo){
        
    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = '../uploads/'.$pasta;
    
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 3072 * 3072 * 3; // 18Mb
    
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('pdf', 'jpg', 'doc', 'xlsx', 'xls', 'docx', 'xls', 'ppt', 'pps','zip');
    
    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = true;
    
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
    
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($arquivo['error'] != 0) {
        $_SESSION['erro'] = "Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$arquivo['error']];
        return false;
    //exit; // Para a execução do script
    }
    
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar    
    // Faz a verificação da extensão do arquivo
    $extensao1 = explode('.', $arquivo['name']);
    $extensao = strtolower(end($extensao1));
    if (array_search($extensao, $_UP['extensoes']) === false) {
        $_SESSION['erro'] = "Por favor, envie arquivos somente em PDF, JPG, DOC ou XLX.";
        return false;
    }
    
    // Faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $arquivo['size']) {
        $_SESSION['erro'] = "O arquivo enviado é muito grande, envie arquivos de até 19Mb.";
        return false;
    }
    
    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    else {
    // Primeiro verifica se deve trocar o nome do arquivo
    //if ($_UP['renomeia'] == true) {
    // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
    $nome_final = 'arquivo_'.time();
    
    //} else {
    // Mantém o nome original do arquivo
    $nome_final = $arquivo['name'];
    //}
    
    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($arquivo['tmp_name'], $_UP['pasta'] . $nome_final)) {
    // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
    $_SESSION['nomefinal'] = $nome_final;
    return true;
        
    } else {
    // Não foi possível fazer o upload, provavelmente a pasta está incorreta
    return false;
    //echo "Não foi possível enviar o arquivo, tente novamente";
    }
    }
    
}

function listarConteudo($sql,$falha = 1)
{
    if(empty($sql))
    {
        return 0; //Erro com a conexão e ou consulta SQL
    }
if (!($res = @mysql_query($sql)))
{
    if($falha)
        echo "Erro na SQL.";
        exit;
    }
return $res;
}



function deletaRegistro($codigo, $nometabela) {

// Monta a query para inserir o log no sistema
$sql = "DELETE FROM `$nometabela` WHERE codigo = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}


function upload_image($file, $file_name, $file_dir){
   $errors = '';
   $var_file = isset($_FILES[$file]) ? $_FILES[$file] : false; 
   if ($var_file) {   
      if (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $var_file["type"]))  
         $errors = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo";  
      else { 
         preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $var_file["name"], $ext); 
      $file_name = $file_name ."." .$ext[1];
         $file_dir .= $file_name;          
         move_uploaded_file($var_file["tmp_name"], $file_dir); 
      } 
   } 
   return $file_name;
}



function atualizaServicos($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `servicos` SET  imagem_servico = '$campo' WHERE idservicos = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function atualizaFornecedor($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `fornecedores` SET  imagem_fornecedor = '$campo' WHERE idfornecedores = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function atualizaCase($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `cases` SET  imagem_case = '$campo' WHERE idcases = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function atualizaProduto($campo, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `produtos` SET  image_name1 = '$campo' WHERE idprodutos = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}


function atualizaCategoriaProdutos($campo1, $campo2, $campo3, $campo4, $campo5, $codigo) {

// Monta a query para inserir o log no sistema
$sql = "UPDATE `galeria_produtos` SET  imagem1 = '$campo1', imagem2 = '$campo2', imagem3 = '$campo3', imagem4 = '$campo4', imagem5 = '$campo5'  WHERE idgaleriap = $codigo"; 

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}


function showSessionMessage()
{
    if(@$_SESSION['erro']!= "") { 
            echo "<div id='errado' 
                       class='notification error png_bg'>
                       <a href='#' 
                          class='close'>
                           <img src='../imagens/icones/cross_grey_small.png' 
                                title='Fechar esta notificação' 
                                alt='fechar' />
                       </a>
                   <div> ".$_SESSION['erro']." </div> </div>";    
            $_SESSION['erro']=""; 
    } 
            
    if(@$_SESSION['ok']  != "") { 
            echo "<div class='notification success png_bg'>
                     <a class='close' 
                        href='#'>
                        <img alt='fechar' 
                             title='Fechar esta notificação' 
                             src='../imagens/icones/cross_grey_small.png'/>
                     </a>
                     <div> 
                        <strong> ".$_SESSION['ok']."</strong>
                     </div>
                </div>";
            $_SESSION['ok']=""; 
    } 
}

//alias
function show_session_message()
{
    showSessionMessage();
}

function site_url($url=''){
    
    $url_site = $_SERVER[SERVER_NAME];

    if(empty($url))
    {
        return "http://$url_site";
    }
    else
    {
        return "http://$url_site/$url";
    }
}

function paginacao($numerosPorPagina)
{
      $numerosPorPagina = 10; 
      if (!isset($_GET['pg'])) {
           $_GET['pg'] = 0;
      }
      $inicial = $_GET['pg'] * $numerosPorPagina;
      return  $inicial; 
}


?>