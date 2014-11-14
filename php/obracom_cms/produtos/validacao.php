<?php 


include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/file_helper.php");
include("../includes/helpers/url_helper.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/models/produtos_model.php");

  $produtos      = new ProdutosModel();

  $campo           = Parameter::GET('campo');
  $valor           = Parameter::GET('valor');
  $id              = Parameter::GET('id');
  
  $exist           = $produtos->getWhere("$campo = '$valor'");
  if($exist)
    echo "1";
  else
    echo "0";

?>