<?php //header("Content-type: $fileType"); 
   $foto = $_GET['image'];
   $x = $_GET['x']; // Largura máxima
   $y = $_GET['y']; // Altura máxima

   $foto_nao_disp = "../imagens/missing.jpg";
   $img_final = imagecreatefromjpeg($foto_nao_disp);
   // SALVA O THUMBNAIL	
   //$out = imagepng($im_nao_disp);
	
	//print($out);
   $extensao_img = explode(".", $foto);	
   $foto = "uploads/".$foto;
	if($extensao_img[1] == "jpg") {
    	$im = imagecreatefromjpeg($foto);
	} else if($extensao_img[1] == "gif") {
    	$im = imagecreatefromgif($foto);
	} else if($extensao_img[1] == "png") {
    	$im = imagecreatefrompng($foto);
	} else {
		$im = imagecreatefromjpeg($foto);
	}
	
	$origem_x = imagesx($im); // Extrai Largura
	$origem_y = imagesy($im); // Extrai Altura
	$scale  = min(($x/$origem_x), ($y/$origem_y));
	
	if ($scale < 1) {
    	$newWidth  = floor($scale * $origem_x);
    	$newHeight = floor($scale * $origem_y);
	}
	else{
		$newWidth  = $origem_x;
    	$newHeight = $origem_y;
	}

	// CRIA A IMAGEM FINAL PARA O THUMBNAIL
	$img_final = imagecreatetruecolor($newWidth, $newHeight);

	// COPIA A IMAGEM ORIGINAL PARA DENTRO DO THUMBNAIL
	imagecopyresampled($img_final, $im, 0, 0, 0, 0, $newWidth, $newHeight, $origem_x, $origem_y);
	imagedestroy($im);
	
	// SALVA O THUMBNAIL	
    $out = imagepng($img_final);
	
	print($out);
	
	// LIBERA A MEMÓRIA
    imagedestroy($im);
    imagedestroy($img_final);
?>
