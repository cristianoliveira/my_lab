<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Carrinho de Compras</h1>
        
        <div class="voltar"><a href="<?php $anterior ?>">&#171; VOLTAR</a></div>
        
        <div class="itens">
	        <?php if ($carrinho AND count($carrinho) > 0) { ?>
        	    <p>Você tem <span><?php echo count($carrinho).' produto(s)' ?></span> no carrinho.</p>
	       <?php } else { ?>
	            <p>Você não possui produtos no carrinho.</p>
	       <?php } ?>
        </div>

        <?php
        if ($carrinho AND count($carrinho) > 0)
        {
            if (isset($_SESSION['status-compra']))
            {
                echo '<p>Clique em continuar para finalizar a compra.</p>';
            }
            else
            {
                echo '<p>Clique em continuar para selecionar o endereço de entrega.</p>';
            }
        }
        ?>
        <?php

        ?>

        <table width="100%" height="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#3E4977">
            <tr class="titulo">
                <th><font face="Arial">Descrição</font></th>
                <th><font face="Arial">Quantidade</font></th>
                <th><font face="Arial">Preço Unit.</font></th>
                <th><font face="Arial">Frete Unit.</font></th>
                <th><font face="Arial">Total</font></th>
                <th><font face="Arial">Remover</font></th>
            </tr>
	        <?php
	        if ($carrinho AND count($carrinho) > 0)
	        {
		        foreach ($carrinho as $produto)
		        {
			        echo '<tr class="linha">';
                        echo '<td>';
			                echo '<a href="'.SITE_URL.'/produto/'.$produto->get_nome_seo().'">
                            <div class="content_img_thumb car"><img src="'.SITE_BASE.'/admin/uploads/produtos/'.$produto->get_imagem().'" alt="'.$produto->get_nome().'" class="img_thumb_destaque" />';
                            echo $produto->get_nome();
                            echo isset($produto->cor_nome) ? ' - Cor: '.$produto->cor_nome : '';
                            echo '</div></a>';
			            echo '</td>';
				        echo '<td align="center"><input type="text" name="quantidade" maxlength="1" value="'.$produto->quantidade.'" /><a href="#" class="atualizar_quantidade" id="'.$produto->get_id().'-'.(isset($produto->cor_id)?$produto->cor_id:'').'" title="Atualizar valores"><img src="'.SITE_BASE.'/views/imagens/atualizar-quantidade.png" /></a></td>';
                        echo '<td align="center"><font face="Arial" size="+2"><b>R$ '.number_format(is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional(), 2, ',', '.').'</b></font></td>';
                        echo '<td align="center"><font face="Arial" size="+2"><b>'.(isset($produtos_frete) ? 'R$ '.number_format($produtos_frete[$produto->get_id()], 2, ',', '.') : '--' ).'</b></font></td>';
                        echo '<td align="center"><font face="Arial" size="+2"><b>R$ '.number_format((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())*$produto->quantidade + ((isset($produtos_frete) ? $produtos_frete[$produto->get_id()] * $produto->quantidade : 0 )), 2, ',', '.').'</b></font></td>';
                        echo '<td>';
			                echo '<a href="'.SITE_URL.'/carrinho/remover/'.$produto->get_id().'-'.(isset($produto->cor_id)?$produto->cor_id:'').'" class="remover"><img src="'.SITE_BASE.'/views/imagens/carrinho-excluir.png" alt="Remover produto do carrinho" /></a>';
                        echo '</td>';
			        echo '</tr>';
		        }
	        }
	        else
	        {
		        echo '<tr class="linha"><td colspan="6" align="center">Nenhum produto no carrinho.</td></tr>';
	        }
			?>
        </table>

        <div class="botao">
	        <a href="<?php echo SITE_URL ?>/produtos"><img src="<?php echo SITE_BASE ?>/views/imagens/continuar-comprando.gif" alt="Continuar comprando" /></a>

			<?php
                if ($carrinho AND count($carrinho) > 0)
                {
                    if (isset($_SESSION['status-compra'])) { ?>
	                    <a href="<?php echo SITE_URL ?>/pagseguro"><img src="<?php echo SITE_BASE ?>/views/imagens/finalizar-compra.gif" alt="Continuar compra" /></a>
	                <?php }
                    else
                    { ?>
                        <a href="<?php echo SITE_URL ?>/carrinho/selecionar_endereco"><img src="<?php echo SITE_BASE ?>/views/imagens/carrinho-continuar.gif" alt="Continuar compra" /></a>
                    <?php }
                }

            ?>
	        </div>

		<?php
	     if (isset($_SESSION['cliente_id']) AND is_numeric($_SESSION['cliente_id']))
         { ?>
             <form id="form_forma_entrega" method="post" action="<?php echo SITE_URL ?>/carrinho">
                 <p style="font-size:14px">
                    <label for="modo_entrega">Escolha o modo de entrega: </label>
                    <select name="modo_entrega" id="modo_entrega">
                        <option value="pac"<?php echo (isset($_SESSION['forma_entrega']) AND $_SESSION['forma_entrega'] == 'pac') ? ' selected="selected"' : '' ?>>PAC</option>
                        <option value="sedex"<?php echo (isset($_SESSION['forma_entrega']) AND $_SESSION['forma_entrega'] == 'sedex') ? ' selected="selected"' : '' ?>>Sedex</option>
                    </select>
                 </p>
             </form>
         <?php } else {
             echo '<p style="font-size:14px">As opções de entrega aparecerão após você efetuar o login.</p>';
         } ?>
		

		<?php if ( ! is_null($notificacao) AND strlen($notificacao->get_mensagem()) > 0) { ?>
            <div id="notification" class="erro" style="padding: 5px; margin-top: 66px"><?php echo $notificacao->get_mensagem() ?></div>
        <?php } else { ?>
            <div id="notification" style="padding: 5px; margin-top: 66px"></div>
        <?php } ?>

        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>
<?php
    if (isset($_SESSION['status-compra']))
        unset($_SESSION['status-compra']);
?>