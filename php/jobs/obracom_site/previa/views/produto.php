<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.'); ?>

<?php include 'includes/cabecalho.php'; ?>

<div class="conteudo">
	<div class="container">
    	
        <div class="detalhes">
            
            <div class="imagem">
                <a class="colorbox-produto" title=" <?php echo $produto->get_codigo().' '.$produto->get_nome() ?>" href="<?php echo SITE_BASE.'/admin/uploads/produtos/'.$produto->get_imagem() ?>">
                   <img src="<?php echo SITE_BASE.'/admin/uploads/produtos/'.$produto->get_imagem() ?>" alt="<?php echo $produto->get_codigo().' '.$produto->get_nome() ?>" class="img_produto_principal" /> 
                </a> 
                <div id="duvidas" align="center"> Dúvidas? <a href="<?php echo SITE_URL ?>/contato?pid=<?php echo $produto->get_codigo() ?>&pname=<?php echo $produto->get_nome() ?>" class="linkDuvidas">Clique aqui. </a></div>                   
	            <?php
	            if ($produto_imagens AND count($produto_imagens) > 0){ ?>
                    <p>Mais fotos deste produto</p>
                    <ul id="maisfotos">
                <?php foreach ($produto_imagens as $imagem){ ?>
    			        <li>
                            <a class="colorbox-produto" title="<?= $imagem->get_titulo() ?>" href="<?= SITE_BASE.'/admin/uploads/produtos/'.$imagem->get_imagem() ?>">
                               <img src="<?= SITE_BASE.'/admin/uploads/produtos/'.$imagem->get_imagem() ?>" alt="<?= $imagem->get_titulo() ?>" />
                            </a>
                        </li>';
                <?php
                    }
	            }
				?>

	            <?php
                if ($produto_cores AND count($produto_cores) > 0)
                {
                    echo '<div class="cores">';
                    echo '<p>Escolha uma das cores disponíveis:</p>';
                    echo '<ul>';
                    foreach ($produto_cores as $produto_cor)
                    {
                        if($produto_cor->get_imagem() != ''){
                            echo '<li><a class="cor-produto" title="'.$produto_cor->get_nome().'" href="#" id="cor-'.$produto_cor->get_id().'"><img src="'.SITE_BASE.'/arquivos/produtos/cores/thumb/'.$produto_cor->get_imagem().'" alt="'.$produto_cor->get_nome().'" /></a></li>';
                        }else{
                            echo '<li><a class="cor-produto" title="'.$produto_cor->get_nome().'" href="#" id="cor-'.$produto_cor->get_id().'"><div style="height:25px; width:25px; border:1px solid #777; background-color:#'.$produto_cor->get_cor().'""></div></a></li>';
                        }
                    }
                    echo '</ul>';
                    echo '</div>';
                }
                ?>
            </div>


            <div class="descricao">
                <h1><?php echo $produto->get_codigo().' '.$produto->get_nome() ?></h1>
        
                <p><?php echo $produto->get_descricao() ?></p>
	            <table class="produto-detalhes">
                    <thead>
                        <td colspan="4">Detalhes</td>
                    </thead>
                    <thead>
                        <td>Altura (m)</td>
                        <td>Comprimento (m)</td>
                        <td>Largura (m)</td>
                        <td>Peso (kg)</td>
                    </thead>
                    <tr>
                        <td><?= $produto->get_altura(); ?></td>
                        <td><?= $produto->get_comprimento(); ?></td>
                        <td><?= $produto->get_largura(); ?></td>
                        <td><?= $produto->get_peso(); ?></td>
                    </tr>
                </table>

	            <?php if ($produto->get_disponivel()) { ?>
                
	                <p class="valor">R$ <span><?php echo number_format(is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional(), 2, ',', '.') ?></span></p>
	                
	                <div class="quantidade">
	                    <span>Quantidade</span>
	                    <form action="<?php echo SITE_URL.'/carrinho/adicionar/'.$produto->get_id() ?>" method="post" id="comprar-produto" class="niceform">
	                        <select size="1" id="qtd" name="quantidade">
								<option value="1">01</option>
								<option value="2">02</option>
								<option value="3">03</option>
								<option value="4">04</option>
								<option value="5">05</option>
								<option value="6">06</option>
								<option value="7">07</option>
								<option value="8">08</option>
								<option value="9">09</option>
	                        </select>

		                    <?php if ($produto_cores AND count($produto_cores) > 0) { ?>
								<input type="hidden" name="cor_id" id="cor_id" value="" />
		                        <img src="<?php echo SITE_BASE.'/views/imagens/produto-escolher-cor.png' ?>" id="produto_escolher_cor" />
							<?php } ?>
	                        
                            <button type="submit">Comprar Produto</button>
	                    </form>
	                </div>
		                
		         <?php } else { ?>
		
		            <p>Produto não disponível para compra no momento.</p>
		
		         <?php } ?>
                
                <div class="clear"></div>                
            </div>
            
            <div class="disponibilidade <?php echo ( ! $produto_imagens OR count($produto_imagens) == 0) ? 'sem-fotos' : '' ?>">
                <p class="situacao">Disponibilidade: <span><?php echo $produto->get_disponivel() ? 'Imediata' : 'não disponível' ?></span></p>
                <p><a href="#">saiba mais</a> sobre a entrega</p>
            </div>
            
            <div class="cartao-credito">
                <p>CARTÃO DE CRÉDITO</p>
            <table width="100%" height="100%" cellpadding="5" cellspacing="0" border="0" bgcolor="#000">
            	<tr>
                	<td class="margem">                       
                        <table class="sem-borda" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#3E4977" style="top:0">
                            <tr>
                                <td align="center"><font face="Arial">2x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/2, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial">7x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/7, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial">12x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/12, 2), 2, ',', '.') ?> *</font></td>
                            </tr>
                            <tr>
                                <td align="center"><font face="Arial">3x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/3, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial">8x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/8, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial"></font><br /></td>
                            </tr>
                            <tr class="cor">
                                <td align="center"><font face="Arial">4x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/4, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial">9x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/9, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial"><span>* Verificar juros existentes.</span></font></td>
                            </tr> 
                            <tr>
                                <td align="center"><font face="Arial">5x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/5, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial">10x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/10, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial"></font><br /></td>
                            </tr>
                            <tr>
                                <td align="center"><font face="Arial">6x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/6, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial">11x de R$ <?php echo number_format(round((is_null($produto->get_valor_promocional()) ? $produto->get_valor_original() : $produto->get_valor_promocional())/11, 2), 2, ',', '.') ?> *</font></td>
                                <td align="center"><font face="Arial"></font></td>
                            </tr>                            
                        </table>
            		</td>
            	</tr>
            </table>                
            </div>            
            
            <div class="clear"></div>
            
        </div>
        
        <h2>OUTRAS OFERTAS QUE VOCÊ PODE SE INTERESSAR</h2>
        
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
		</div>
        
        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>