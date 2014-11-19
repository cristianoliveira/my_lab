<div class="rodape">
	<div class="container">        
        <div class="enquete">
        	<h2>ENQUETE</h2>
	        <?php
	        if ($rodape_enquete AND ! is_null($rodape_enquete->get_id()))
	        {
		        echo '<p>'.$rodape_enquete->get_pergunta().'</p>';
		        echo '<form method="post" action="'.SITE_URL.'/enquete/votar" id="form-enquete">';
					echo '<input type="hidden" name="id" value="'.$rodape_enquete->get_id().'" />';

		            foreach ($rodape_enquete_opcoes as $opcao)
		            {
			            echo '<input type="radio" name="opcao" value="'.$opcao->get_id().'" />'.$opcao->get_opcao();
		            }

		            echo '<br />';
		            echo '<button type="submit">Votar</button>';
		            echo '<a href="'.SITE_URL.'/enquete/'.$rodape_enquete->get_pergunta_seo().'">Ver resultados parciais</a>';
				echo '</form>';
	        } else {
                echo '<p>No momento não há outras enquetes cadastradas.</p>';
            }
			?>
            <!--<p>Queremos saber de você que outros tipos de produtos o escritorioclub.com poderia oferecer?</p>
            <form method="post" action="" id="form-enquete" >
                
                <input type="radio" name="" value="" />Mesas de Reunião
                <input type="radio" name="" value="" />Relógios
                <input type="radio" name="" value="" />Mais tipos de acessórios
                <input type="radio" name="" value="" />Adesivos Customizados
                <input type="radio" name="" value="" />Gaveteiros e Caixas Organizadoras
                
                <button type="submit">Votar</button>
                <a href="<?php /*echo SITE_URL */?>/enquete">Ver resultados parciais</a>
            </form>-->
        </div>
        <div class="menu">
        	<ul>
            	<li><a href="<?php echo SITE_URL ?>/empresa">A Empresa</a></li>
                <li><a href="<?php echo SITE_URL ?>/politica-privacidade">Política de Privacidade</a></li>
                <li><a href="<?php echo SITE_URL ?>/trocas-devolucoes">Trocas e Devoluções</a></li>
                <li><a href="<?php echo SITE_URL ?>/contato">Contato</a></li>
                <li class="sem-borda"><a href="<?php echo SITE_URL ?>/seguranca-compra">Segurança na Compra</a></li>                                    
            </ul>
        </div>            
    </div>
    <div class="clear"></div>
</div>

</body>
</html>