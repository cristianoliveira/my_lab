<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Enquete</h1>
        
        <div class="voltar"><a href="<?php echo $anterior?>" >&#171; VOLTAR</a></div>
        
        <p class="titulo-interna"></p>
        
        <p><?php echo $enquete->get_pergunta() ?></p>
            
        <table width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#3E4977">
	        <?php
	        if ($opcoes AND count($opcoes) > 0)
	        {

		        foreach ($opcoes as $opcao)
		        {
                    if ($enquete->total_votos == 0) {
                        $porcentagem = 0;
                    } else {
                        $porcentagem = number_format(round(($opcao->get_votos()/$enquete->total_votos)*100), 0);
                    }
			        echo '<tr>';
                        echo '<td width="150">'.$opcao->get_opcao().'</td>';
				        echo '<td align="center" width="75">'.$opcao->get_votos().'</td>';
                        echo '<td align="center" width="75">'.$porcentagem.'%</td>';
			            echo '<td align="left" width="600">';
			                echo '<div class="grafico">';
			                    echo '<div class="porcentagem" style="width:'.$porcentagem.'%"></div>';
			                echo '</div>';
			            echo '</td>';
			        echo '</tr>';
		        }
	        }
			?>
            <!--<tr>
                <td width="150">Mesas de Reunião</td>
                <td align="center" width="75">590</td>
                <td align="center" width="75">29%</td>
                <td align="center" width="600">
                	<div class="grafico">
                    	<div class="porcentagem" style="width:29%"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="150">Relógios</td>
                <td align="center" width="75">392</td>
                <td align="center" width="75">16%</td>
                <td align="center" width="600">
                	<div class="grafico">
                    	<div class="porcentagem" style="width:16%"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="150">Mais tipos de acessórios</td>
                <td align="center" width="75">241</td>
                <td align="center" width="75">12%</td>
                <td align="center" width="600">
                	<div class="grafico">
                    	<div class="porcentagem" style="width:12%"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="150">Adesivos Customizados</td>
                <td align="center" width="75">235</td>
                <td align="center" width="75">11%</td>
                <td align="center" width="600">
                	<div class="grafico">
                    	<div class="porcentagem" style="width:11%"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="150">Gaveteiros e Caias</td>
                <td align="center" width="75">156</td>
                <td align="center" width="75">7%</td>
                <td align="center" width="600">
                	<div class="grafico">
                    	<div class="porcentagem" style="width:7%"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="150">Organizadoras</td>
                <td align="center" width="75">155</td>
                <td align="center" width="75">5%</td>
                <td align="center" width="600">
                	<div class="grafico">
                    	<div class="porcentagem" style="width:5%"></div>
                    </div>
                </td>
            </tr>-->
        </table>

		<?php if ( ! is_null($notificacao) AND strlen($notificacao->get_mensagem()) > 0) { ?>
            <div id="notification" class="erro" style="padding: 5px; margin: -30px 0 50px"><?php echo $notificacao->get_mensagem() ?></div>
        <?php } else { ?>
            <div id="notification" style="padding: 5px; margin: -30px 0 50px"></div>
        <?php } ?>
            
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>