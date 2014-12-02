<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Consultar Pedidos</h1>
        
        <div class="voltar"><a href="<?php echo SITE_URL ?>/area-cliente">&#171; VOLTAR</a></div>
        
        <p class="titulo-interna">Consultar Pedidos</p>
        
        <p>Confira detalhes sobre a entrega do seu pedido ou histórico de suas compras.</p>
        
        <div class="formulario">
            <p>Confira detalhes sobre a entrega do seu pedido ou históricos de suas compras.</p>
            
            <form method="get" action="<?php echo SITE_URL ?>/area-cliente/consultar-pedidos" id="form-consultar-pedidos" >

                <!-- <p><input type="radio" name="filtro" value="abertos" class="radio" <?php echo (isset($filtro) AND $filtro == 'abertos') ? 'checked="checked"' : '' ?>>Pedidos Abertos</p> -->
                <p><input type="radio" name="filtro" value="todos" class="radio" <?php echo ((isset($filtro) AND $filtro == 'todos') OR ! isset($filtro)) ? 'checked="checked"' : '' ?>>Todos Pedidos</p>
                <p><input type="radio" name="filtro" value="numero" class="radio" <?php echo (isset($filtro) AND $filtro == 'numero') ? 'checked="checked"' : '' ?>><span>Pesquisa por Número do Pedido: </span>
	                <input type="text" name="numero_pedido" id="numero_pedido" value="<?php echo isset($numero_pedido) ? $numero_pedido : '' ?>" />
	            </p>

                <div class="clear"></div>

                <p><input type="radio" name="filtro" value="data" class="radio"  <?php echo (isset($filtro) AND $filtro == 'data') ? 'checked="checked"' : '' ?>>
                    <span>Por Data (Mês/Ano) de: </span>
                        <select name="mes_inicial" id="mes_inicial">
							<option value="">---</option>
	                        <?php for($i = 1; $i <= 12; $i++) { echo '<option value="'.$i.'" '.((isset($mes_inicial) AND $mes_inicial == $i) ? 'selected="selected"' : '').'>'.Funcoes::mes_nome($i, TRUE).'</option>'; } ?>
                        </select>
                        <select name="ano_inicial" id="ano_inicial">
							<option value="">---</option>
							<?php for($i = 2012; $i<=date('Y'); $i++) { echo '<option value="'.$i.'" '.((isset($ano_inicial) AND $ano_inicial == $i) ? 'selected="selected"' : '').'>'.$i.'</option>'; } ?>
                        </select>
                        <span>a</span>
                        <select name="mes_final" id="mes_final">
							<option value="">---</option>
	                        <?php for($i = 1; $i <= 12; $i++) { echo '<option value="'.$i.'" '.((isset($mes_final) AND $mes_final == $i) ? 'selected="selected"' : '').'>'.Funcoes::mes_nome($i, TRUE).'</option>'; } ?>
                        </select>
                        <select name="ano_final" id="ano_final">
                            <option value="">---</option>
	                        <?php for($i = 2012; $i<=date('Y'); $i++) { echo '<option value="'.$i.'" '.((isset($ano_final) AND $ano_final == $i) ? 'selected="selected"' : '').'>'.$i.'</option>'; } ?>
                        </select>
                </p>

	            <div class="clear"></div>
                
                <p><button type="submit" name="enviar" style="background:#BC2A27;font-weight:bold;color:#fff;padding:3px 6px;border:0;font-size:10px;margin:5px 0 0 20px">Filtrar</button></p>
            </form>
            
            <div class="clear"></div>
        </div>
            
        <table width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#3E4977">
            <tr>
                <th><font face="Arial" size="+1">Número do Pedido</font><br /></th>
                <th><font face="Arial" size="+1">Data do Pedido</font><br /></th>
                <th><font face="Arial" size="+1">Total R$</font><br /></th>
                <th><font face="Arial" size="+1">Forma de Pagamento</font><br /></th>
                <th><font face="Arial" size="+1">Status</font><br /></th>
            </tr>
	        <?php
	        if ($compras AND count($compras) > 0)
	        {
		        $i = 1;
		        foreach ($compras as $compra)
		        {
			        echo '<tr '.($i++%2==0 ? 'class="cor"' : '').'>';
                        echo '<td align="center"><a href="'.SITE_URL.'/area-cliente/pedido/'.$compra->get_id().'"><font face="Arial" size="+1"><b>'.$compra->get_codigo().'</b></font></a><br /></td>';
			            echo '<td align="center"><font face="Arial" size="+1">'.date('d/m/Y', strtotime($compra->get_quando())).'</font><br /></td>';
                        echo '<td align="center"><font face="Arial" size="+1">R$ '.number_format($compra->get_valor()+$compra->get_frete(),2,',','.').'</font><br /></td>';
			            echo '<td align="center"><font face="Arial" size="+1">'.$compra->nome.'</font><br /></td>';
                        echo '<td align="center"><font face="Arial" size="+1">'.$compra->status.'</font><br /></td>';
			        echo '</tr>';
		        }
	        }
	        else
	        {
		      echo '<tr><td colspan="5">'.( ! isset($filtro) ? 'Nenhum pedido realizado até o momento.' : 'Nenhum pedido encontrado para esta busca.').'</td></tr>';
	        }
			?>
            <!--<tr>
                <td align="center"><a href="#"><font face="Arial" size="+1"><b>128398692</b></font></a><br /></td>
                <td align="center"><font face="Arial" size="+1">08/10/2009</font><br /></td>
                <td align="center"><font face="Arial" size="+1">R$ 164,00</font><br /></td>
                <td align="center"><font face="Arial" size="+1">MASTERCARD</font><br /></td>
                <td align="center"><font face="Arial" size="+1">Cancelado</font><br /></td>
            </tr>
            <tr class="cor">
                <td align="center"><a href="#"><font face="Arial" size="+1"><b>907408980</b></font></a><br /></td>
                <td align="center"><font face="Arial" size="+1">15/10/2010</font><br /></td>
                <td align="center"><font face="Arial" size="+1">R$ 34,00</font><br /></td>
                <td align="center"><font face="Arial" size="+1">MASTERCARD</font><br /></td>
                <td align="center"><font face="Arial" size="+1">Cancelado</font><br /></td>
            </tr> 
            <tr>
                <td align="center"><a href="#"><font face="Arial" size="+1"><b>003403188</b></font></a><br /></td>
                <td align="center"><font face="Arial" size="+1">08/10/2010</font><br /></td>
                <td align="center"><font face="Arial" size="+1">R$ 200,00</font><br /></td>
                <td align="center"><font face="Arial" size="+1">HIPERCARD</font><br /></td>
                <td align="center"><font face="Arial" size="+1">Entregue</font><br /></td>
            </tr>      -->
        </table>           
            
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>