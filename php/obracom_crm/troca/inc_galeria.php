<?php
//$conexao = mysql_connect('localhost','ofikitca_obracms','23593nsj');
//$db = mysql_select_db('ofikitca_kitlub');

$conexao = mysql_connect('localhost','root','');
$db = mysql_select_db('kitlub');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subir</title>
<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../js/jquery.MultiFile.js" /></script>
</head>

<body>
<?php 
 @$pegaId = $_GET["id"];
 if(isset($_POST['upload'])){
 $pasta = '../uploads/imoveis/';
 foreach($_FILES["img"]["error"] as $key => $error){

 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod = date('dmy') . $_FILES["img"]["name"][$key];
 $nome = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);

 if(move_uploaded_file($tmp_name, $uploadfile)){
 echo "<p> O Arquivo " . $nome . " foi enviado com sucesso!</p>";
 $inserir = mysql_query("INSERT INTO imagens (img, id_imovel) VALUES ('$cod','$pegaId')");
 }else{
 echo "Erro ao enviar o arquivo " . $nome . "! Por favor tente outra vez!";
 } } } } ?>

<form name="upload_files" action="" enctype="multipart/form-data" method="post">
 <input type="file" name="img[]" class="multi" maxlength="20" accept="jpeg|jpg|png|gif" />
 <input type="submit" name="upload" value="Upload" />
</form>

<?php
$seleciona = mysql_query("SELECT * FROM imagens WHERE id_imovel = $pegaId");
$contar = mysql_num_rows($seleciona);
if($contar <= '0'){
 echo "<br>Nenhum imagem cadastrada na galeria deste imóvel! Favor selecionar e fazer o upload.";
}else{
 while($res_img = mysql_fetch_array($seleciona)){
 $imagen = $res_img['img'];
 $idimg = $res_img['id'];

?>
<div style="float:left; padding:20px;"> <img src="../uploads/imoveis/<?php echo $imagen;?>" alt="" width="50" /><br /> 
<a href="remover_foto.php?id=<?php echo $idimg; ?>" title="Excluir a notícia." class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir essa imagem?')) return false;"> Excluir </a> </div>
<?php
 }
}
?>
</body>
</html>
