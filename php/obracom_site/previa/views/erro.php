<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Página de Erro</h1>
        
        <div class="voltar"><a href="<?php echo SITE_URL ?>">&#171; VOLTAR</a></div>

		<p class="titulo-interna">&nbsp;</p>
        

		<img src="<?php echo SITE_BASE ?>/views/imagens/pagina-nao-encontrada.png" alt="Página de erro" style="margin:70px 0 150px 150px" />


		<h2>LANÇAMENTOS IMPERDÍVEIS</h2>
        
        <div class="lancamentos">
	        <?php
            if ($outras_ofertas AND count($outras_ofertas) > 0)
            {
                $produto_destaque = $outras_ofertas[0];
                unset($outras_ofertas[0]);

                $asdfasdf = array();

                $outras_ofertas = array_values($outras_ofertas);

                echo '<div class="destaque">';
                    echo '<a href="'.SITE_URL.'/produto/'.$produto_destaque->get_nome_seo().'"><img class="imagem-destaque" src="'.SITE_BASE.'/arquivos/produtos/thumb1/'.$produto_destaque->get_imagem().'" alt="'.$produto_destaque->get_nome().'" /></a>';
                    echo '<p>'.$produto_destaque->get_nome().'</p>';
                    echo '<p class="valor">R$ '.number_format(( is_null($produto_destaque->get_valor_promocional()) ? $produto_destaque->get_valor_original() : $produto_destaque->get_valor_promocional()), 2, ',', '.').'</p>';
                    echo '<a href="'.SITE_URL.'/produto/'.$produto_destaque->get_nome_seo().'"><img src="'.SITE_BASE.'/views/imagens/comprar.png" alt="Comprar Produto" /></a>';
                echo '</div>';

                // Se após o unset acima ainda houver produtos, exibimos
                if (count($outras_ofertas) > 0)
                {
                    echo '<ul>';
                    foreach ($outras_ofertas as $oferta)
                    {
                        echo '<li>';
                            echo '<a href="'.SITE_URL.'/produto/'.$oferta->get_nome_seo().'"><img src="'.SITE_BASE.'/arquivos/produtos/thumb2/'.$oferta->get_imagem().'" alt="'.$oferta->get_nome().'" /></a>';
                            echo '<p>'.$oferta->get_nome().'</p>';
                            echo '<p class="valor">R$ '.number_format(( is_null($oferta->get_valor_promocional()) ? $oferta->get_valor_original() : $oferta->get_valor_promocional()), 2, ',', '.').'</p>';
                            echo '<a href="'.SITE_URL.'/produto/'.$oferta->get_nome_seo().'"><img src="'.SITE_BASE.'/views/imagens/comprar.png" alt="Comprar Produto" /></a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                }
            }
            else
            {
                echo '<p>Nenhum produto cadastrado até o momento.</p>';
            }
            ?>
		</div>
            
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>