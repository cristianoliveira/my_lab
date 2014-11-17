<?php include 'includes/cabecalho-interna.php'; ?>



<div class="conteudo interna">
	<div class="container">
    	
        <h1>A Empresa</h1>
        
        <div class="voltar"><a href="<?php echo $anterior ?>">&#171; VOLTAR</a></div>
        
        <p class="titulo-interna">
            <?php echo utf8_decode($slogan) ?>
        <!-- Mais do que uma empresa, o melhor da indústria moveleira nacional agora no varejo on-line. --></p>
        <p>
            <?php echo utf8_decode($descricao) ?>
        </p>

		<h2>LANÇAMENTOS IMPERDÍVEIS</h2>
        
        <div class="box lancamentos">
            <?php
            if ($outras_ofertas AND count($outras_ofertas) > 0)
            {
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
            }
            else
            {
                echo '<p style="margin:30px 0 50px">Nenhum produto cadastrado até o momento.</p>';
            }
            ?>

            <!--<div class="destaque">
                <a href="#"><img class="imagem-destaque" src="<?php /*echo SITE_BASE */?>/arquivos/produtos/lancamento-destaque.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                <p>Poltrona Diretor Executiva Emporium</p>
				<p class="valor">R$230,00</p>
                <a href="#"><img src="<?php /*echo SITE_BASE */?>/views/imagens/comprar.png" alt="Comprar Produto" /></a>
            </div>
            <ul>
            	<li>
                	<a href="#"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-1.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p>Poltrona Diretor Executiva Emporium</p>
                    <p class="valor">R$230,00</p>
                    <a href="#"><img src="<?php /*echo SITE_BASE */?>/views/imagens/comprar.png" alt="Comprar Produto" /></a>
                </li>
                <li>
                	<a href="#"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-2.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p>Poltrona Diretor Executiva Emporium</p>
                    <p class="valor">R$230,00</p>
                    <a href="#"><img src="<?php /*echo SITE_BASE */?>/views/imagens/comprar.png" alt="Comprar Produto" /></a>
                </li>
                <li>
                	<a href="#"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-3.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p>Poltrona Diretor Executiva Emporium</p>
                    <p class="valor">R$230,00</p>
                    <a href="#"><img src="<?php /*echo SITE_BASE */?>/views/imagens/comprar.png" alt="Comprar Produto" /></a>
                </li>
                <li>
                	<a href="#"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-4.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p>Poltrona Diretor Executiva Emporium</p>
                    <p class="valor">R$230,00</p>
                    <a href="#"><img src="<?php /*echo SITE_BASE */?>/views/imagens/comprar.png" alt="Comprar Produto" /></a>
                </li>
                <li>
                	<a href="#"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-1.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p>Poltrona Diretor Executiva Emporium</p>
                    <p class="valor">R$230,00</p>
                    <a href="#"><img src="<?php /*echo SITE_BASE */?>/views/imagens/comprar.png" alt="Comprar Produto" /></a>
                </li>
                <li>
                	<a href="#"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-2.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p>Poltrona Diretor Executiva Emporium</p>
                    <p class="valor">R$230,00</p>
                    <a href="#"><img src="<?php /*echo SITE_BASE */?>/views/imagens/comprar.png" alt="Comprar Produto" /></a>
                </li>
            </ul>-->
		</div>
            
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>