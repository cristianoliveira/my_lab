<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.'); ?>

<?php include 'includes/cabecalho.php'; ?>

<div class="conteudo">
	<div class="container">
    	        
        <div class="slideshow slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
	            <?php
				foreach ($destaques as $destaque)
				{
					echo '<a href="'.$destaque->get_link().'">';
					echo '<img src="'.SITE_BASE.'/admin/uploads/destaques/'.$destaque->get_imagem().'" alt="'.$destaque->get_titulo().'" />';
					echo '</a>';
				}?>
            </div>
        </div>
        
        <h2>PRODUTOS</h2>
        <div class="produto-categoria">
        	<div class="box">
                <ul>
                    <li>
                        <a href="<?php echo SITE_URL ?>/produtos/cadeiras">
                            <img src="<?php echo SITE_BASE ?>/views/imagens/categoria-cadeiras.jpg" alt="Categoria - Cadeiras" />
                            <p>CADEIRAS</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL ?>/produtos/mobiliario">
                            <img src="<?php echo SITE_BASE ?>/views/imagens/categoria-mobiliario.jpg" alt="Categoria - Mobiliário" />
                            <p>MOBILIÁRIO</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL ?>/produtos/acessorios">
                            <img src="<?php echo SITE_BASE ?>/views/imagens/categoria-acessorios.jpg" alt="Categoria - Acessórios" />
                            <p>ACESSÓRIOS</p>
                        </a>
                    </li>
                </ul>
                <div class="banner">
                	<img src="<?php echo SITE_BASE ?>/views/imagens/banner-produtos.jpg" alt="Conheça a linha Forma, da Artesano, na Cia do Escritório" />
                </div>
        	</div>
        </div>
        
        <div class="clear"></div>


        <?php
        if ($outras_ofertas AND count($outras_ofertas) > 0)
        {
            echo '<h2>LANÇAMENTOS IMPERDÍVEIS</h2>';
	        echo '<div class="box lancamentos">';

            $produto_destaque = $outras_ofertas[0];
            unset($outras_ofertas[0]);

            $asdfasdf = array();

            $outras_ofertas = array_values($outras_ofertas);

            echo '<div class="destaque">';
                echo '<a href="'.SITE_URL.'/produto/'.$produto_destaque->get_nome_seo().'">
                <div id="img-destaque"><img class="imagem-destaque" src="'.SITE_BASE.'/admin/uploads/produtos/'.$produto_destaque->get_imagem().'" alt="'.$produto_destaque->get_nome().'" /></div>
                </a>';
                echo '<p class="nome-produto">'.$produto_destaque->get_nome().'</p>';
                echo '<p class="valor">R$ '.number_format(( is_null($produto_destaque->get_valor_promocional()) ? $produto_destaque->get_valor_original() : $produto_destaque->get_valor_promocional()), 2, ',', '.').'</p>';
                echo '<a href="'.SITE_URL.'/produto/'.$produto_destaque->get_nome_seo().'"><img src="'.SITE_BASE.'/views/imagens/comprar.png" alt="Comprar Produto" /></a>';
            echo '</div>';

            $i = 1;
            // Se após o unset acima ainda houver produtos, exibimos
            if (count($outras_ofertas) > 0)
            {
                echo '<ul>';
                foreach ($outras_ofertas as $oferta)
                {
                    if($i <= 6){
                    echo '<li>';
                        echo '<a href="'.SITE_URL.'/produto/'.$oferta->get_nome_seo().'">
                        <div class="content_img_thumb"><img src="'.SITE_BASE.'/admin/uploads/produtos/'.$oferta->get_imagem().'" alt="'.$oferta->get_nome().'" class="img_thumb_destaque" /></div></a>';
                        echo '<p class="nome-produto">'.$oferta->get_nome().'</p>';
                        echo '<p class="valor">R$ '.number_format(( is_null($oferta->get_valor_promocional()) ? $oferta->get_valor_original() : $oferta->get_valor_promocional()), 2, ',', '.').'</p>';
                        echo '<a href="'.SITE_URL.'/produto/'.$oferta->get_nome_seo().'"><img src="'.SITE_BASE.'/views/imagens/comprar.png" alt="Comprar Produto" /></a>';
                    echo '</li>';
                    $i++;
                    }
                }
                echo '</ul>';
            }

	        echo '</div>';
        }
        else
        {
           //echo '<p>Nenhum produto cadastrado até o momento.</p>';
        }
        ?>

        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>
<?php
    if (isset($_SESSION['passou-aqui']))
        unset($_SESSION['passou-aqui']);
?>