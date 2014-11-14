<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
	<div class="container">
    	
        <h1>Política de Privacidade</h1>
        
        <div class="voltar"><a href="<?php echo $anterior ?>">&#171; VOLTAR</a></div>
        
        <p class="titulo-interna">A Política de Privacidade da Movelclube.com tem por objetivo sempre melhorar para você.</p>
        
        <p>A Movelclube.com tem o compromisso com a privacidade e a segurança de seus clientes durante todo o processo de navegação e compra pelo site. Os dados cadastrais dos clientes não são vendidos, trocados ou divulgados para terceiros, exceto quando essas informações são necessárias para o processo de entrega, para cobrança, ou para participação em promoções solicitadas pelos clientes. Seus dados pessoais são peça fundamental para que seu pedido chegue em segurança, na sua casa, de acordo com nosso prazo de entrega.</p>
 
		<p>A Movelclube.com utiliza cookies e informações de sua navegação (sessão do browser) com o objetivo de traçar um perfil do público que visita o site e aperfeiçoar sempre nossos serviços, produtos, conteúdos e garantir as melhores ofertas e promoções para você. Durante todo este processo mantemos suas informações em sigilo absoluto. Vale lembrar que seus dados são registrados pela Movelclube.com de forma automatizada, dispensando manipulação humana.</p>
 
		<p>Para que estes dados permaneçam intactos, nós desaconselhamos expressamente a divulgação de sua senha a terceiros, mesmo a amigos e parentes.</p>
 
		<p>As alterações sobre nossa política de privacidade serão devidamente informadas neste espaço. Equipe Movelclube.com</p>
 
		<p>Equipe Movelclube.com</p>

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