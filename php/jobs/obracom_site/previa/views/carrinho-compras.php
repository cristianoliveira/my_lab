<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Carrinho de Compras</h1>
        
        <div class="voltar"><a href="<?php echo SITE_URL ?>">&#171; VOLTAR</a></div>
        
        <div class="itens">
        	<p>Você tem <span>3 compras</span> no carrinho.</p>
        </div>        
            
        <table width="100%" height="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#3E4977">
            <tr class="titulo">
                <th><font face="Arial">Descrição</font></th>
                <th><font face="Arial">Quantidade</font></th>
                <th><font face="Arial">Preço Unitário</font></th>
                <th><font face="Arial">Total</font></th>
                <th><font face="Arial">Remover</font></th>
            </tr>
            <tr class="linha">
                <td>
                	<a href="<?php echo SITE_URL ?>/produto"><img src="<?php echo SITE_BASE ?>/arquivos/produtos/cadeira-1.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    Poltrona Diretor Executiva Emporium
                </td>
                <td align="center"><input type="text" name="qtd" id="qtd" maxlength="3" /></td>
                <td align="center"><font face="Arial" size="+2"><b>R$ 230,00</b></font></td>
                <td align="center"><font face="Arial" size="+2"><b>R$ 230,00</b></font></td>
                <td>
                	<a href="#" class="remover"><img src="<?php echo SITE_BASE ?>/views/imagens/carrinho-excluir.png" alt="Remover produto do carrinho" /></a>
                </td>
            </tr>
            <tr class="linha">
                <td>
                	<a href="<?php echo SITE_URL ?>/produto"><img src="<?php echo SITE_BASE ?>/arquivos/produtos/cadeira-1.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    Poltrona Diretor Executiva Emporium
                </td>
                <td align="center"><input type="text" name="qtd" id="qtd" maxlength="3" /></td>
                <td align="center"><font face="Arial" size="+2"><b>R$ 230,00</b></font></td>
                <td align="center"><font face="Arial" size="+2"><b>R$ 230,00</b></font></td>
                <td>
                	<a href="#" class="remover"><img src="<?php echo SITE_BASE ?>/views/imagens/carrinho-excluir.png" alt="Remover produto do carrinho" /></a>
                </td>
            </tr>                           
        </table>
        
        <div class="botao">
        	<a href="#"><img src="<?php echo SITE_BASE ?>/views/imagens/carrinho-continuar.gif" alt="Continuar compra" /></a>
        </div>           
            
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>