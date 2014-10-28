<?php
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );

	//$con = mysql_connect( 'localhost', 'ofikitca_obracms', '23593nsj') ;
	//mysql_select_db( 'ofikitca_kitlub', $con );
	
	$con = mysql_connect( 'robb0188.publiccloud.com.br:3306', 'obrac_obracms123', '23593nsj') ;
	mysql_select_db( 'obracom_exemplocms', $con );

	$cod_estados = mysql_real_escape_string( $_REQUEST['cod_estados'] );

	$cidades = array();

	$sql = "SELECT *
			FROM subcategorias
			WHERE id_categoria=$cod_estados
			ORDER BY nome_subcategoria";
	$res = mysql_query( $sql );
	while ( $row = mysql_fetch_assoc( $res ) ) {
		$cidades[] = array(
			'cod_cidades'	=> $row['idsubcategorias'],
			'nome'			=> $row['nome_subcategoria'],
		);
	}

	echo( json_encode( $cidades ) );

?>