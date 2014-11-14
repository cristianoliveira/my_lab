<?php
$email_html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Movel Clube</title>
</head>
<body bgcolor="#BC2A27">
<table width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#BC2A27"><tr><td align="center" valign="top">
	<table width="550" cellspacing="0" cellpadding="5" border="0" align="center" bgcolor="#FFFFFF"><tr><td>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td colspan="2" align="left"><img src="'.SITE_BASE.'/views/imagens/topo-email.gif" width="550" height="46" alt="Movel Clube"></td>
			</tr>
			<tr>
				<td align="center" width="228"><font face="Arial" size="+3"><img src="'.SITE_BASE.'/views/imagens/logo-email.png" width="236" height="72" alt="Movel Clube"></font></td>
				<td align="center" width="228"><font face="Arial" size="+3"><img src="'.$imagem.'" width="272" height="76" alt="Boas Vindas Movel Clube"></font></td>
			</tr>
			<tr>
				<td colspan="2" align="left">
					'.$conteudo.'
				</td>
			</tr>
			<tr>
				<td colspan="2" align="left"><img src="'.SITE_BASE.'/views/imagens/rodape-email.gif" width="550" height="115" alt="Movel Clube"></td>
			</tr>
		</table>
	</td></tr></table>
</td></tr></table>
</body>
</html>
';