<div class="navegacao" >
    <div class="menuItemNavegacao">
        <h2>Soluções</h2>
        <a href="#gestao">  
            <image src="imagens/menus/gestao.png"/>
            <h2>Gestão</h2>
        </a>
        <a href="#web">
            <image src="imagens/menus/web.png"/>
            <h2>Web</h2>
        </a>
        <a href="#integradas">
            <image src="imagens/menus/integradas.png"/>
            <h2>Soluções integradas</h2>
        </a>  
    </div>
</div>
<div id="gestao" class="conteudoPaginaFixo">
    <h2>Soluções</h2>
    <p>
        A Primous dispõe de uma gama de soluções para seu negócio.
    </p>
    <div  class="conteudoProduto">
        <div class="imagemEsquerda">
            <img class="imagemEsquerda" src="imagens/software/um_box_300_300.png" width="300px" style="float: left;" /> 
        </div>
        <div class="textoDireita">
            <p>
            <h3>Gestão com EstetiSys</h3>    
            EstetSys é a solução criada pela Primous em parceria com empresários da Serra Gaúcha, para atender a necessidade de empresas do ramo 
            de estética e serviços. Esta ferramenta foi desenvolvida com base nas melhores práticas de gestão e anos de experiência em administração 
            de negócios.
            </br>
            Com ele é possível realizar o controle de todos as comandas de serviços prestados e cálculos para pagamento de comissões. 
            Sua interface foi especialmente desenhada para facilidade no uso e manutenção.

            <h4>A quem se destina?</h4>
            <li>Salões de Beleza</li>
            <li>Centros de Estética</li>
            <li>Salas de Massagem e Pilates</li>
            </p>
            <?php echo anchor("estetisys", "Veja como iniciar.") ?>
        </div>
    </div>
    <div id="web" class="conteudoProduto">
        <img class="imagemDireita" src="imagens/software/site_300_259.png" />
        <p>
        <h3>Web Sites e Marketing Digital</h3>    
        A Primous tem a solução completa para sua empresa, tanto na gestão do negócio, como de sua imagem na internet.
        Criação de sites especializados e integrados a ferramenta EstetiSys para oferecer a melhor experiência de interação com seus clientes.
        </br>
        Dentre os serviços para web estão desenvolvimento de sites, SEO, gestão de redes sociais e consultoria em marketing digital.

        <h4>A quem se destina?</h4>
        <li>Empresas que buscam seu público na web.</li>
        <li>Organizações que desejam incrementar seu marketing digital</li>
        </p>
        <?php echo anchor("contato", "Solicite um orçamento.") ?>

    </div>

    <div id="integradas"></div>
    <div class="conteudoProduto">
        <img class="imagemDireita" src="imagens/software/integrado_400_250.png" />
        <div class="textoDireita" >
            <p>
            <h3>Serviços Integrados</h3>    
            A Primous possui serviços na web integrados a seus softwares. Oferecendo, dessa maneira, um diferencial ao seu negócio.
            Entre em contato com um de nossos consultores para saber mais sobre como integrar o EstetiSys a diversas ferramentas da internet
            </br>
            <strong>Você mais conectado ao seus clientes.</strong>
            <h4>A quem se destina?</h4>
            <li>Empresas de médio porte com necessidades específicas de integração.</li>
            </p>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[href^="#"]').click(function(event) {
                var id = $(this).attr("href");
                var offset = 150;
                var target = $(id).offset().top - offset;
                $('html, body').animate({scrollTop:target}, 500);
                event.preventDefault();
            });
        });
    </script>
</div>
