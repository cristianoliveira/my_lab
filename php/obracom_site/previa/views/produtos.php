<?php include 'includes/cabecalho.php'; ?>

<div class="conteudo">
	<div class="container">
    	
        <h1><?php echo $titulo ?></h1>

		<?php if ( ! is_null($notificacao) AND strlen($notificacao->get_mensagem()) > 0) { ?>
            <div id="notification" class="erro" style="padding: 5px; margin: -48px auto 38px; width: 888px"><?php echo $notificacao->get_mensagem() ?></div>
        <?php } else { ?>
            <div id="notification" style="padding: 5px; margin:-48px auto 38px; width: 888px"></div>
        <?php } ?>
        
        <div class="box-topo">
        	<div class="tamanho">
            	<p>Mudar Tamanho de Imagem</p>
                <a href="<?php echo SITE_URL.(str_replace(array('index.php/','/imagem','/media','/grande'), '', utf8_encode($_SERVER["REQUEST_URI"])).'/imagem/media') ?>" class="<?php echo ($tamanho_imagem AND $tamanho_imagem == 'media') ? 'atual' : '' ?>">Média</a>
                <a href="<?php echo SITE_URL.(str_replace(array('index.php/','/imagem','/media','/grande'), '', utf8_encode($_SERVER["REQUEST_URI"])).'/imagem/grande') ?>" class="<?php echo ($tamanho_imagem AND $tamanho_imagem == 'grande') ? 'atual' : '' ?>">Grande</a>
            </div>
            <div class="ordenar">
            	<form method="get" action="" id="form-ordenar" >
                	<label>Ordenar os produtos por</label>
            		<select name="ordenar_por" id="ordenar_por">
                      <option value="alfabetica" <?php echo ( ! $ordenar_por OR $ordenar_por == 'alfabetica') ? 'selected="selected"' : '' ?>>Alfabética</option>
                      <option value="mais-novos" <?php echo ($ordenar_por AND $ordenar_por == 'mais-novos') ? 'selected="selected"' : '' ?>>Mais novos no site</option>
                      <option value="menor-preco" <?php echo ($ordenar_por AND $ordenar_por == 'menor-preco') ? 'selected="selected"' : '' ?>>Menor preço</option>
                      <option value="maior-preco" <?php echo ($ordenar_por AND $ordenar_por == 'maior-preco') ? 'selected="selected"' : '' ?>>Maior preço</option>
                    </select>
                </form>
            </div>
        </div>
        
        <div class="box">
            <p class="resultados"><?php echo $paginacao->site_exibir_quantidades() ?></p>

	        <?php

	        if ($produtos AND count($produtos) > 0)
	        {
		        echo '<ul>';
		        for ($i=0; $i<min(count($produtos), 4); $i++)
		        {
			        $produto = $produtos[$i];

			        echo '<li>';
			        echo '<a href="'.SITE_URL.'/produto/'.$produto->get_nome_seo().'" class="imagem-produto '.($tamanho_imagem=='grande'?'grande':'media').'">
                    <div class="content-foto"><img src="'.SITE_BASE.'/admin/uploads/produtos/'.$produto->get_imagem().'" alt="'.$produto->get_nome().'" /></div></a>';
                    echo '<a href="'.SITE_URL.'/produto/'.$produto->get_nome_seo().'"><img src="'.SITE_BASE.'/views/imagens/produtos-comprar.gif" alt="Comprar Produto" /></a>';
			        echo '<p class="descricao">'.( ! is_null($produto->get_resumo()) ? $produto->get_resumo() : $produto->get_nome()).'</p>';

			        if ($produto->get_disponivel())
			        {
				        if ( ! is_null($produto->get_valor_promocional())) { echo '<p>De: R$ '.number_format($produto->get_valor_original(),2,',','.').'</p>'; }

				        echo '<p class="valor">Por: R$ '.number_format((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional() ),2,',','.').'</p>';
	                    echo '<p class="condicoes"><b>ou 12x de R$ '.number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/12,2),2,',','.').'</b><br />';
			            echo 'sem juros';
	                    echo '</p>';
			        }
			        else
			        {
				        echo '<p class="indisponivel">item indisponível no momento</p>';
			        }

			        echo '</li>';
		        }
		        echo '</ul>';
	        }
			?>
            <!--<ul>
            	<li>
                	<a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-1.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <a href="<?php /*echo SITE_URL */?>/produto"><img src="<?php /*echo SITE_BASE */?>/views/imagens/produtos-comprar.gif" alt="Comprar Produto" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>                    
                    <p class="valor">Por: R$230,00</p>
                    <p class="condicoes"><b>ou 12x de R$ 24,92</b><br />
                    sem juros
                    </p>                    
                </li>
                <li>
                	<a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-2.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <a href="<?php /*echo SITE_URL */?>/produto"><img src="<?php /*echo SITE_BASE */?>/views/imagens/produtos-comprar.gif" alt="Comprar Produto" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p>De: R$ 399,90</p>
                    <p class="valor">Por: R$339,90</p>
                    <p class="condicoes"><b>ou 12x de R$ 28,25</b><br />
                    sem juros
                    </p>                    
                </li>
                <li>
                	<a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-3.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p class="indisponivel">ítem indisponível no momento</p>                    
                </li>
                <li>
                	<a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-4.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p class="indisponivel">ítem indisponível no momento</p>                   
                </li>
                <li>
                	<a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-1.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <a href="<?php /*echo SITE_URL */?>/produto"><img src="<?php /*echo SITE_BASE */?>/views/imagens/produtos-comprar.gif" alt="Comprar Produto" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>                    
                    <p class="valor">Por: R$230,00</p>
                    <p class="condicoes"><b>ou 12x de R$ 24,92</b><br />
                    sem juros
                    </p>                    
                </li>
                <li>
                	<a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-2.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <a href="<?php /*echo SITE_URL */?>/produto"><img src="<?php /*echo SITE_BASE */?>/views/imagens/produtos-comprar.gif" alt="Comprar Produto" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p>De: R$ 399,90</p>
                    <p class="valor">Por: R$339,90</p>
                    <p class="condicoes"><b>ou 12x de R$ 28,25</b><br />
                    sem juros
                    </p>                    
                </li>
                <li>
                	<a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-3.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p class="indisponivel">ítem indisponível no momento</p>                    
                </li>
            </ul>-->
            <div class="clear"></div>
		</div>
        
        <div class="relacionados">
	        <?php
            if ($produtos AND count($produtos) > 4)
            {
                echo '<ul>';
                //foreach ($produtos as $produto)
	            for ($i=4; $i<min(count($produtos), 8); $i++)
                {
                    $produto = $produtos[$i];

                    echo '<li>';
                    echo '<a href="'.SITE_URL.'/produto/'.$produto->get_nome_seo().'" class="imagem-produto '.($tamanho_imagem=='grande'?'grande':'media').'"><img src="'.SITE_BASE.'/admin/uploads/produtos/'.$produto->get_imagem().'" alt="'.$produto->get_nome().'" /></a>';
                    echo '<a href="'.SITE_URL.'/produto/'.$produto->get_nome_seo().'"><img src="'.SITE_BASE.'/views/imagens/produtos-comprar.gif" alt="Comprar Produto" /></a>';
                    echo '<p class="descricao">'.( ! is_null($produto->get_resumo()) ? $produto->get_resumo() : $produto->get_nome()).'</p>';

                    if ($produto->get_disponivel())
                    {
                        if ( ! is_null($produto->get_valor_promocional())) { echo '<p>De: R$ '.number_format($produto->get_valor_original(),2,',','.').'</p>'; }

                        echo '<p class="valor">Por: R$ '.number_format((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional() ),2,',','.').'</p>';
                        echo '<p class="condicoes"><b>ou 12x de R$ '.number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/12,2),2,',','.').'</b><br />';
                        echo 'sem juros';
                        echo '</p>';
                    }
                    else
                    {
                        echo '<p class="indisponivel">item indisponível no momento</p>';
                    }

                    echo '</li>';
                }
                echo '</ul>';
            }
	        else
	        {
		        echo '<br /><br /><br /><br /><br />';
	        }
            ?>
            <!--<ul>
                <li>
                    <a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-3.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p class="indisponivel">ítem indisponível no momento</p>                    
                </li>
                <li>
                    <a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-3.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p class="indisponivel">ítem indisponível no momento</p>                    
                </li>
                <li>
                    <a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-3.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p class="indisponivel">ítem indisponível no momento</p>                    
                </li>
                <li>
                    <a href="<?php /*echo SITE_URL */?>/produto" class="imagem-produto"><img src="<?php /*echo SITE_BASE */?>/arquivos/produtos/cadeira-3.jpg" alt="Poltrona Diretor - Executiva Emporium" /></a>
                    <p class="descricao">Cadeira de escritório em P.U. (couro sintético) c/ função relax (reclinável), giratória, regulagem de altura a gás, rodízio - H - 8235L - Preta - Importado</p>
                    <p class="indisponivel">ítem indisponível no momento</p>                    
                </li>
            </ul>   -->

	        <div class="paginacao">
	            <?php if ($paginacao) { $paginacao->site_exibir_links(); } ?>
	        </div>
        </div>
        
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>