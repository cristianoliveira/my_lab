<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Área de Clientes - Andes Turismo</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
	<div class="content">
		<h1 class="bdam">ÁREA DE CLIENTES</h1>

	<div class="esq"><br/>	
		<h1>Qual dos formulários deseja preencher?</h1><br/><br/>
		<nav class="menu">
			<a href="contrato.php">Contrato de Prestação de Serviços de Turismo</a><br/>
			<a href="ficha.php">Ficha de Reserva e Inscrição</a><br/>
			<a href="#">Formulário de Autorização de Débito</a>
		</nav>
	</div>

	<div id="downloads">
		<h1>Downloads</h1>
		<ul>
			<a href="download.php?arquivo=contrato"><li>Contrato de Prestação de Serviços de Turismo</li></a>
			<a href="download.php?arquivo=ficha"><li>Ficha de Reserva e Inscrição</li></a>
			<a href="#"><li>Formulário de Autorização de Débito</li></a>
		</ul>
	</div>
	<div class="clear"></div>
	<img src="imagens/logo.png" title="Andes Turismo" alt="Andes Turismo" />
	</div><!-- .content -->
	</header>

	<section id="ficha-reserva" class="content">
		<h2>FICHA DE CONFIRMAÇÃO DE RESERVAS DE PACOTES TURÍSTICOS</h2><br/>
		<form method="post" action="envia-ficha.php">
			<table class="tabela bloco1" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="titulo">Agente de viagem / Agência de viagem</td>
				</tr>
				<tr>
					<td><label>Nome/Empresa:</label></td>
					<td><input type="text" name="nome" /></td>
					<td><label>Endereço:</label></td>
					<td><input type="text" name="endereco" /></td>
				</tr>
				<tr>
					<td><label>CPF / RG / CNPJ:</label></td>
					<td><input type="text" name="documento" /></td>
					<td><label>Bairro:</label></td>
					<td><input type="text" name="bairro" /></td>
				</tr>
				<tr>
					<td><label>Cidade:</label></td>
					<td><input type="text" name="cidade" /></td>
					<td><label>CEP:</label></td>
					<td><input type="text" name="cep" /></td>
				</tr>
				<tr>
					<td><label>Contato:</label></td>
					<td><input type="text" name="contato" /></td>
					<td><label>Fone coml:</label></td>
					<td><input type="text" name="fonecoml" /></td>
				</tr>
				<tr>
					<td><label>E-mail:</label></td>
					<td><input type="email" name="email" /></td>
					<td><label>Fone Celular:</label></td>
					<td><input type="text" name="fonecelular" /></td>
				</tr>
				<tr>
					<td><label><strong>Data da Reserva:</strong></label></td>
					<td><input type="text" name="datareserva" /></td>
					<td><label><strong>Validade da Reserva:</strong></label></td>
					<td><input type="text" name="validadereserva" /></td>
				</tr>
			</table><br/>
			<table class="tabela bloco2" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="titulo">Programa de viagem - pacote turístico</td>
				</tr>
				<tr>
					<td><label>Nome do pacote:</label></td>
					<td colspan="3"><input type="text" name="nomepacote" /></td>
				</tr>
				<tr>
					<td><label>Saída:</label></td>
					<td colspan="3"><input type="text" name="saida" /></td>
				</tr>
				<tr>
					<td><label>Regresso:</label></td>
					<td colspan="3"><input type="text" name="regresso" /></td>
				</tr>
			</table><br/>
			<table class="tabela bloco3" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="titulo">Hotéis previstos</td>
				</tr>
				<tr>
					<td><label>Indique o hotel:</label></td>
					<td colspan="3"><input type="text" name="hotel" placeholder="Conforme hotéis previstos no roteiro (a confirmar no voucher)" /></td>
				</tr>
				<tr>
					<td><label>Tipo de acomodação:</label></td>
					<td colspan="3"><input type="text" name="tipoacomodacao" /></td>
				</tr>
				<tr>
					<td><label>Apto a compartir com Sr/Sra.:</label></td>
					<td colspan="3"><input type="text" name="compartircom" /></td>
				</tr>
			</table><br/>
			<table class="tabela bloco4" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="titulo">Local de embarque</td>
				</tr>
				<tr>
					<td><label>Cidade de embarque:</label></td>
					<td colspan="3"><input type="text" name="cidadeembarque" /></td>
				</tr>
				<tr>
					<td><label>Endereço de embarque:</label></td>
					<td colspan="3"><input type="text" name="enderecoembarque" /></td>
				</tr>
				<tr>
					<td><label>Observações:</label></td>
					<td colspan="3"><input type="text" name="observacoes" /></td>
				</tr>
			</table><br/>
			<table class="tabela bloco5" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="titulo">Responsável pelo pagamento</td>
				</tr>
				<tr>
					<td width="100"><label>Nome:</label></td>
					<td colspan="3"><input type="text" name="nomeresp" /></td>
				</tr>
				<tr>
					<td><label>Data de nascimento:</label></td>
					<td><input type="text" name="dataresp" /></td>
					<td class="tammenor"><label>Passaporte N°:</label></td>
					<td><input type="text" name="passresp" /></td>
				</tr>
				<tr>
					<td><label>RG / Passaporte:</label></td>
					<td><input type="text" name="documentoresp" /></td>
					<td class="tammenor"><label>Emissão Passaporte:</label></td>
					<td><input type="text" name="emissaopassresp" /></td>
				</tr>
				<tr>
					<td><label>Cadastro Pessoa Física (CPF):</label></td>
					<td><input type="text" name="cpfresp" /></td>
					<td class="tammenor"><label>Validade Passaporte:</label></td>
					<td><input type="text" name="valpassresp" /></td>
				</tr>
				<tr>
					<td><label>Estado Civil:</label></td>
					<td><input type="email" name="estcivresp" /></td>
					<td class="tammenor"><label>Profissão:</label></td>
					<td><input type="text" name="profissaoresp" /></td>
				</tr>
				<tr>
					<td><label>Fone residencial:</label></td>
					<td><input type="text" name="foneresresp" /></td>
					<td class="tammenor"><label>Fone celular:</label></td>
					<td><input type="text" name="fonecelresp" /></td>
				</tr>
				<tr>
					<td><label>Mora na Cidade de:</label></td>
					<td><input type="email" name="cidaderesp" /></td>
					<td class="tammenor"><label>Estado:</label></td>
					<td><input type="text" name="estadoresp" /></td>
				</tr>
				<tr>
					<td><label>Bairro:</label></td>
					<td><input type="text" name="bairroresp" /></td>
					<td class="tammenor"><label>CEP:</label></td>
					<td><input type="text" name="cepresp" /></td>
				</tr>
				<tr>
					<td><label>Endereço residencial:</label></td>
					<td colspan="3"><input type="text" name="endresresp" /></td>
				</tr>
				<tr>
					<td><label>Endereço eletrônico / E-mail:</label></td>
					<td colspan="3"><input type="email" name="emailresp" /></td>
				</tr>
			</table><br/>
			<table class="tabela" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="5" class="titulo">Dados dos passageiros</td>
				</tr>
				<tr>
					<td width="400"><label>Nome completo:</label></td>
					<td width="20"><label>Sexo</label></td>
					<td><label>Data Nasc.</label></td>
					<td><label>RG / Passaporte:</label></td>
					<td><label>CPF:</label></td>
				</tr>
				<tr>
					<td><input type="text" name="nome1" /></td>
					<td><input type="text" name="sexo1" /></td>
					<td><input type="text" name="datanasc1" /></td>
					<td><input type="text" name="documento1" /></td>
					<td><input type="text" name="cpf1" /></td>
				</tr>
				<tr>
					<td><input type="text" name="nome2" /></td>
					<td><input type="text" name="sexo2" /></td>
					<td><input type="text" name="datanasc2" /></td>
					<td><input type="text" name="documento2" /></td>
					<td><input type="text" name="cpf2" /></td>
				</tr>
			</table><br/>
			<p class="center">Para as viagens internacionais, é obrigatória a entrega de uma cópia da Carteira de Identidade expedida pela Secretaria de segurança Pública com menos de 10 anos ou Passaporte dentro da validade emitido pela Policia Federal. Não são válidas para viagens internacionais as carteiras profissionais (OAB, CRM, etc.). Consulte com o seu agente de viagem a política para viagens de menores de idade e sobre a necessidade de vacinas e visto de entrada no país escolhido.</p><br/>
			<table class="tabela" cellpadding="0" cellspacing="0">
				<tr>
					<td width="300"><label>Valor por pessoa em U$D:</label></td>
					<td width="50"><label>Câmbio</label></td>
					<td><label>Parcelado / a Vista</label></td>
					<td><label>Desconto</label></td>
					<td><label>Valor Taxas R$</label></td>
					<td><label>Valor final R$</label></td>
				</tr>
				<tr>
					<td><input type="text" name="valorpessoa" /></td>
					<td><input type="text" name="cambio" /></td>
					<td><input type="text" name="tipopagamento" /></td>
					<td><input type="text" name="desconto" /></td>
					<td><input type="text" name="valortaxas" /></td>
					<td><input type="text" name="valorfinal" /></td>
				</tr>
			</table><br/>
			<table class="tabela" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="5"><strong>RECIBO N°</strong><input type="text" name="numerorecibo" /></td>
				</tr>
				<tr>
					<td class="sbb"><label>Banco para Depósito</label></td>
					<td class="sbb" width="163"><label>Tipo de operação</label></td>
					<td class="sbb" width="270"><label>Detalhes da venda (dinheiro/cheque/cartão)</label></td>
					<td class="sbb" width="150"><label>Para:</label></td>
					<td class="sbb" width="150"><label>Valor R$</label></td>
				</tr>
				<tr>
					<td>(fazer depósito identificado)<br/>
					<strong>Banco ITAU Nº 0341</strong><br/>
					Agência 8241 / C/C 16573-0<br/><br/>
					<strong>Banco do BRASIL Nº 001</strong><br/>
					Agência 2813-4 / C/C 23643-8<br/><br/>
					ANDES TRAVEL TURISMO LTDA<br/>
					<strong>CNPJ 11.192.653/0001-36</strong><br/>
					 Porto Alegre – RS - Brasil
					</td>
					<td colspan="4" class="des">
						<table class="tabela" cellpadding="0" cellspacing="0">
							<tr>
								<td width="163" class="sbe"><input type="text" name="pagtipo1" /></td>
								<td width="270"><input type="text" name="pagdetalhes1" /></td>
								<td width="150"><input type="text" name="pagpara1" /></td>
								<td width="150"><input type="text" name="pagvalor1" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo2" /></td>
								<td><input type="text" name="pagdetalhes2" /></td>
								<td><input type="text" name="pagpara2" /></td>
								<td><input type="text" name="pagvalor2" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo3" /></td>
								<td><input type="text" name="pagdetalhes3" /></td>
								<td><input type="text" name="pagpara3" /></td>
								<td><input type="text" name="pagvalor3" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo4" /></td>
								<td><input type="text" name="pagdetalhes4" /></td>
								<td><input type="text" name="pagpara4" /></td>
								<td><input type="text" name="pagvalor4" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo5" /></td>
								<td><input type="text" name="pagdetalhes5" /></td>
								<td><input type="text" name="pagpara5" /></td>
								<td><input type="text" name="pagvalor5" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo6" /></td>
								<td><input type="text" name="pagdetalhes6" /></td>
								<td><input type="text" name="pagpara6" /></td>
								<td><input type="text" name="pagvalor6" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo7" /></td>
								<td><input type="text" name="pagdetalhes7" /></td>
								<td><input type="text" name="pagpara7" /></td>
								<td><input type="text" name="pagvalor7" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo8" /></td>
								<td><input type="text" name="pagdetalhes8" /></td>
								<td><input type="text" name="pagpara8" /></td>
								<td><input type="text" name="pagvalor8" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo8" /></td>
								<td><input type="text" name="pagdetalhes8" /></td>
								<td><input type="text" name="pagpara8" /></td>
								<td><input type="text" name="pagvalor8" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo9" /></td>
								<td><input type="text" name="pagdetalhes9" /></td>
								<td><input type="text" name="pagpara9" /></td>
								<td><input type="text" name="pagvalor9" /></td>
							</tr>
							<tr>
								<td class="sbe"><input type="text" name="pagtipo10" /></td>
								<td><input type="text" name="pagdetalhes10" /></td>
								<td><input type="text" name="pagpara10" /></td>
								<td><input type="text" name="pagvalor10" /></td>
							</tr>
						</table>
					</td>
				</tr>
			</table><br/>
			<table class="tabela" cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align:center"><br/><br/>De acordo: Passageiro Responsável</td>
					<td style="text-align:center"><br/><br/>De acordo: Agente/Agência de Viagem</td>
				</tr>
			</table><br/><br/>
			<input type="submit" value="ENVIAR" /><br/><br/>
		</form>
	</section><!-- #ficha-reserva / .content-->

</body>
</html>