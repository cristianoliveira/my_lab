<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Área de Clientes - Andes Turismo</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../js/jquery.squirrel.min.js"></script>
<script>
    $(document).submit(function(){
    	window.print();
    });

    $('#formulario').squirrel('init',{
    	clear_on_submit: true
    });
</script>
</head>
<body>
	<header>
	<div class="content non-printable">
		<h1 class="bdam">ÁREA DE CLIENTES</h1>

	<div class="esq non-printable"><br/>	
		<h1>Qual dos formulários deseja preencher?</h1><br/><br/>
		<nav class="menu">
			<a href="contrato.php">Contrato de Prestação de Serviços de Turismo</a><br/>
			<a href="ficha.php">Ficha de Reserva e Inscrição</a><br/>
			<a href="autorizacao-debito.php">Formulário de Autorização de Débito</a>
		</nav>
	</div>

	<div id="downloads" class="non-printable">
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
		<h2>AUTORIZAÇÃO DE DÉBITO - SERVIÇOS DE VIAGENS</h2><br/>
		<form id="formulario" method="post" action="#" class="squirrel">
			<table class="tabela " cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="titulo">Detalhes</td>
				</tr>
				<tr>
					<td colspan="3">Autorizo e reconheço o débito em minha conta do cartão de crédito abaixo:</td>
				    <td>O.S.</td>
				</tr>
				<tr>
					<td colspan="4">
					   <div class="radio-buttons">
					       <label>Visa</label>
					       <input type="radio" name="cartao" value="visa"/>
					   </div>
					   <div class="radio-buttons">
					       <label>Mastercard</label>
					       <input type="radio" name="cartao" value="mastercard"></input>
					   </div>
					   <div class="radio-buttons">
					       <label>Hipercard</label>
					       <input type="radio" name="cartao" value="hipercard"></input>
					   </div>
					   <div class="radio-buttons">
					       <label>American Express</label>
					       <input type="radio" name="cartao" value="americanexpress"></input>
					   </div>
					   <div class="radio-buttons">
					       <label>Dinners Club</label>
					       <input type="radio" name="cartao" value="dinnerclub"></input>
					    </div>
					</td>
				</tr>
			</table><br/>
			
			<table class="tabela" cellpadding="0" cellspacing="0">
				<tr>
					<td><label>Nome</label></td>
					<td colspan="3"><input type="text" name="cliente[nome]" /></td>
					<td><label>CPF</label></td>
					<td colspan="1"><input type="text" name="cliente[cpf]" /></td>
				</tr>
				<tr>
					<td><label>Num. Cartão</label></td>
					<td colspan="1"><input type="text" name="cliente[cartao[num]]" /></td>
					<td><label>Validade</label></td>
					<td colspan="1"><input type="text" name="cliente[cartao[validade]]" /></td>
					<td><label>Cód. Seg.</label></td>
					<td colspan="1"><input type="text" name="cliente[cartao[cod_seguranca]]" /></td>
				</tr>
				<tr>
					<td><label>Endereço</label></td>
					<td colspan="1"><input type="text" name="cliente[endereco]" /></td>
					<td><label>Nº</label></td>
					<td colspan="1"><input type="text" name="cliente[numero]" /></td>
					<td><label>Complemento</label></td>
					<td colspan="1"><input type="text" name="cliente[complemento]" /></td>
				</tr>
				<tr>
					<td><label>Cidade</label></td>
					<td colspan="1"><input type="text" name="cliente[cidade]" /></td>
					<td><label>Estado</label></td>
					<td colspan="1"><input type="text" name="cliente[estado]" /></td>
					<td><label>CEP</label></td>
					<td colspan="1"><input type="text" name="cliente[cep]" /></td>
				</tr>
				<tr>
					<td><label>Telefone 1</label></td>
					<td colspan="2"><input type="text" name="cliente[telefone_um]" /></td>
					<td><label>Telefone 2</label></td>
					<td colspan="2"><input type="text" name="cliente[telefone_dois]" /></td>
				</tr>
			</table><br/>
            
            <table class="tabela" cellpadding="0" cellspacing="0">
				<tr>
					<td><label>Op. Turística / Cia Aérea</label></td>
					<td colspan="1"><input type="text" name="oper_turistica" /></td>
					<td><label>Cód. Aut.</label></td>
					<td colspan="1"><input type="text" name="cod_autorizacao" /></td>
					<td><label>Data</label></td>
					<td colspan="1"><input type="text" name="data" /></td>
				</tr>
				<tr>
					<td><label>Moeda</label></td>
					<td>
					    <div class="radio-buttons">
						    <input type="radio" name="moeda" value="real">Real</input>
						    <input type="radio" name="moeda" value="dolar">Dólar</input>
					    </div>
					</td>
					<td><label>Num. Parcelas</label></td>
					<td colspan="1"><input type="text" name="num_parcelas" /></td>
				</tr>
				<tr>
					<td><label>Entrada + TX. Embarque:</label></td>
					<td colspan="1"><input type="text" name="entrada_taxa_emb" /></td>
					<td><label>Valor da Parcela:</label></td>
					<td colspan="1"><input type="text" name="valor_parcela" /></td>
				</tr>
				<tr>
					<td><label>Total da Venda:</label></td>
					<td colspan="3"><input type="text" name="total_venda" /></td>
				</tr>
			</table><br/>

			<table class="tabela bloco3" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="titulo">Atenção</td>
				</tr>
				<tr>
					<td>
						<p>
							Qualquer transação realizada fora dos padrões contratuais das Administradoras implicará em sanções legais, tanto para o
							Estabelecimento e seus intermediários, quanto para o Associado.
							Ao autorizar o débito no cartão de crédito, Associado e Estabelecimento declaram estar cientes e concordar com as seguintes
							condições: 
						</p>
						<ul>
							1 - Questionamentos ou cancelamentos dos serviços adquiridos devem ser resolvidos entre as partes, de acordo com as Condições 
							Gerais do contrato entre Estabelecimento e Cliente.
						</ul>
						<ul>
							2 - O Estabelecimento e seus intermediários são responsáveis pela correta aceitação, conferindo na apresentação do cartão, sua
							validade, autenticidade e assinatura do Titular.
						</ul>
						<ul>
						    3 - Esta autorização é valida por 15 dias e sua transmissão por fax é permitida apenas para agilizar o processo de venda. Em caso de
							contestação por parte do Associado, o Estabelecimento é responsável pela apresentação deste original, cópia de documento oficial que
							comprove a assinatura do cliente e cópia dos bilhetes / vouchers emitidos. Estes documentos podem ser solicitados a qualquer
							momento pelas Administradoras / Andes Turismo.
						</ul>
						<uL>
							4 - Caso os serviços sejam prestados em nome de outras pessoas que não o Titular do Cartão, seus nomes deverão ser listados
							abaixo, para maior segurança do Associado.
						</uL>
					</td>
				</tr>
			</table><br/>

			<table class="tabela" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="titulo">TERMO DE RESPONSABILIDADE</td>
				</tr>
				<tr>
					<td><label>Agência</label></td>
					<td colspan="3"><input type="text" name="agencia" /></td>
				</tr>
				<tr>
					<td><label>CNPJ</label></td>
					<td colspan="3"><input type="text" name="cnpj" /></td>
				</tr>
				<tr>
					<td><label>Endereço</label></td>
					<td colspan="3"><input type="text" name="endereco" /></td>
				</tr>
				<tr>
					<td><label>Agente</label></td>
					<td colspan="3"><input type="text" name="agente" /></td>
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
			<table class="tabela" cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align:center">
					    <div style="margin:20px 10px; border-top:solid 1px;">
					        Local, data e assinatura do Titular do Cartão<br />
					        <strong>NÃO ASSINE EM BRANCO</strong>
					    </div>
					</td>
					<td style="text-align:center">
						<div>Rale o cartão neste campo:<div>
						<div style="height:100px;"><div>
					</td>
				</tr>
			</table><br/><br/>
			<table class="tabela bloco5">
				<tr>
					<td style="text-align:center"><br/>
					    <div style="margin:20px 10px; border-top:solid 1px;">
					        Carimbo e assinatura
					    </div>
					</td>
				</tr>
			</table><br/><br/>
			<input type="submit" value="ENVIAR" />
		</form>

	</section><!-- #ficha-reserva / .content-->

</body>
</html>	