<?php
$conexao = mysql_connect('mysql.andesturismo.com.br','andesturismo02','c1a5k0');
$db = mysql_select_db('andesturismo02');

$_COOKIE["empresa"] = "current";
$_COOKIE["empresa1"]  = "";
$_COOKIE["empresa2"]  = "current";
?>

<link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script>


<div id="mulitplefileuploader">Upload</div>

<div id="status"></div>
<script>

$(document).ready(function()
{

var settings = {
	url: "upload.php?id=999999",
	method: "POST",
	allowedTypes:"jpg,png", /* jpg,png,gif,doc,pdf,zip */
	fileName: "myfile",
	multiple: true,
		
	onSuccess:function(files,data,xhr)
	{
		$("#status").html("<font color='green'>Upload com sucesso</font>");
		
	},
	onError: function(files,status,errMsg)
	{		
		$("#status").html("<font color='red'>Upload Falhou</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>

<?php

$seleciona = mysql_query("SELECT * FROM imagens WHERE id_imovel = $pegaId");
$contar = mysql_num_rows($seleciona);
if($contar <= '0'){
 echo "<br>Nenhum imagem cadastrada. Caso tenha feito o upload e não tenha aparecido: <a href='javascript:window.location.reload(true)'>Clique Aqui</a>.";
}else{
 while($res_img = mysql_fetch_array($seleciona)){
 $imagen = $res_img['img'];
 $idimg = $res_img['id'];

?>
<div style="float:left; padding:20px;"> 
<img src="../../imagem.php?arquivo=cms/uploads/imagens/empresa/<?php echo $imagen;?>&largura=150&altura=100" class="thumbnail" style="text-align:center; margin-bottom:10px;"  /><br />

<center><a href="remover_foto.php?id=<?php echo $idimg; ?>" title="Excluir a imagem." class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir essa imagem?')) return false;"> Excluir </a> </center> </div>
<?php
 }
}
?>
