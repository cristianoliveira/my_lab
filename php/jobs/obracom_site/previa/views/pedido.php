<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Pedidos</h1>
        
        <div class="voltar"><a href="<?php echo SITE_URL ?>/area-cliente/consultar-pedidos">&#171; VOLTAR</a></div>
        
        <p class="titulo-interna">Pedido #<?php echo $compra->get_codigo() ?></p>
        
		<p>
			<strong>Data</strong><br />
			<?php echo date('d/m/Y \à\s H:i:s', strtotime($compra->get_quando())) ?><br /><br />
		</p>

		<p>
			<strong>Código da compra</strong><br />
			<?php echo $compra->get_codigo() ?>
		</p>

		<p>
			<strong>Situação atual</strong><br />
			<?php echo $compra->status ?>
		</p>

		<p>
			<strong>Valor</strong><br />
			R$ <?php echo number_format($compra->get_valor(), 2, ',', '.') ?>
		</p>

		<p>
			<strong>Frete</strong><br />
			R$ <?php echo number_format($compra->get_frete(), 2, ',', '.') ?>
		</p>

		<p>
			<strong>ID no PagSeguro</strong><br />
			<?php echo ! is_null($compra->identificador) ? $compra->identificador : '<em>Sem retorno do PagSeguro até o momento</em>' ?>
		</p>

		<p>
			<strong>Tipo de pagamento</strong><br />
			<?php echo ! is_null($compra->tipo_pagamento) ? $compra->tipo_pagamento : '<em>Sem retorno do PagSeguro até o momento</em>' ?>
		</p>

		<p>
			<strong>Meio de pagamento</strong><br />
			<?php echo ! is_null($compra->meio_pagamento) ? $compra->meio_pagamento : '<em>Sem retorno do PagSeguro até o momento</em>' ?>
		</p>


		<p>&nbsp;</p>

        <h2>Endereço da Entrega</h2>

        <p>
            <strong>Endereco</strong><br />
            <?php echo ! is_null($endereco->get_endereco()) ? $endereco->get_endereco() : '<em>Não informado</em>' ?>
        </p>

        <p>
            <strong>Nº</strong><br />
            <?php echo ! is_null($endereco->get_numero()) ? $endereco->get_numero() : '<em>Não informado</em>' ?>
        </p>

        <p>
            <strong>Complemento</strong><br />
            <?php echo ! is_null($endereco->get_complemento()) ? $endereco->get_complemento() : '<em>Não informado</em>' ?>
        </p>

        <p>
            <strong>Tipo de Endereço</strong><br />
            <?php echo ! is_null($endereco->get_tipo()) ? $endereco->get_tipo() : '<em>Não informado</em>' ?>
        </p>

        <p>
            <strong>CEP</strong><br />
            <?php echo ! is_null($endereco->get_cep()) ? $endereco->get_cep() : '<em>Não informado</em>' ?>
        </p>

        <p>
            <strong>Bairro</strong><br />
            <?php echo ! is_null($endereco->get_bairro()) ? $endereco->get_bairro() : '<em>Não informado</em>' ?>
        </p>

        <p>
            <strong>Cidade</strong><br />
            <?php echo ! is_null($endereco->get_cidade()) ? $endereco->get_cidade() : '<em>Não informado</em>' ?>
        </p>

        <p>
            <strong>Estado</strong><br />
            <?php echo ! is_null($endereco->get_estado()) ? $endereco->get_estado() : '<em>Não informado</em>' ?>
        </p>

        <p>
            <strong>Referência</strong><br />
            <?php echo ! is_null($endereco->get_referencia()) ? $endereco->get_referencia() : '<em>Não informado</em>' ?>
        </p>

        <p>&nbsp;</p>

		<h2>Produtos</h2>

		<?php
		if ($produtos AND count($produtos) > 0)
		{
			echo '<table width="100%">';
			echo '<tr>';
				echo '<th align="left">Nome</th>';
				echo '<th align="left">Categoria</th>';
				echo '<th align="left">Quantidade</th>';
				echo '<th align="left">Valor Unitário</th>';
				echo '<th align="left">Valor Total</th>';
			echo '</tr>';
			foreach ($produtos as $produto)
			{
			?>
				<tr>
					<td><?php echo ! is_null($produto->nome) ? $produto->nome.( ! is_null($produto->cor_nome) ? ' - Cor: '.$produto->cor_nome: '') : '<em>não disponível</em>' ?></td>
					<td><?php echo ! is_null($produto->categoria_nome) ? $produto->categoria_nome : '<em>não disponível</em>' ?></td>
					<td><?php echo $produto->get_quantidade() ?></td>
					<td>R$ <?php echo number_format($produto->get_valor_unitario(), 2, ',', '.') ?></td>
					<td>R$ <?php echo number_format($produto->get_valor_unitario()*$produto->get_quantidade(), 2, ',', '.') ?></td>
				</tr>
			<?php
			}
			echo '</table>';
		}
		else
		{
			echo '<tr><td colspan="4">Nenhum produto nesta compra.</td></tr>';
		}
		?>

        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>