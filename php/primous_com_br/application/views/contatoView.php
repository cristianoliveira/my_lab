<div id="conteudoPagina">
    <h2>Contato e Localização</h2>
    <div class="contato">
        <div id="localizacao">
            <strong>Localização da Primous</strong> 
           <iframe width="425" height="310" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=R.+Adelino+%C3%82ngelo+Cegoni+-+Caxias+do+Sul+-+RS&amp;aq=0&amp;oq=Adelino&amp;sll=-29.068624,-51.036619&amp;sspn=0.769402,1.560059&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Adelino+%C3%82ngelo+Cegoni+-+Caxias+do+Sul+-+Rio+Grande+do+Sul,+95110-175&amp;ll=-29.183509,-51.217486&amp;spn=0.012008,0.024376&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=R.+Adelino+%C3%82ngelo+Cegoni+-+Caxias+do+Sul+-+RS&amp;aq=0&amp;oq=Adelino&amp;sll=-29.068624,-51.036619&amp;sspn=0.769402,1.560059&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Adelino+%C3%82ngelo+Cegoni+-+Caxias+do+Sul+-+Rio+Grande+do+Sul,+95110-175&amp;ll=-29.183509,-51.217486&amp;spn=0.012008,0.024376&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>
        </div>
        <p><strong>Entre em contato com a Primous.</strong><br/>
            Tire suas dúvidas e obtenha suporte.<p/>
        <?php if (isset($email_enviado)) { ?>
            <div id="mensagem_enviada"><?php echo $email_enviado ?></div>
        <?php } ?>
        <div id="form_contato">
            <form action="<?php echo $action ?>" method="post">
                <div>
                    <label for="nome">Nome: </label><input type="text" name="nome" id="nome" />
                </div>
                <div>
                    <label for="email">E-mail: </label><input type="text" name="email" id="email" />
                </div>
                <div>
                    <label for="telefone">Telefone: </label><input type="text" name="telefone" id="telefone" />
                </div>
                <div>
                    <label for="cidade">Cidade: </label><input type="text" name="cidade" id="cidade" />
                </div>
                <div>
                    <label for="assunto">Assunto: </label><input type="text" name="assunto" id="assunto" />
                </div>
                <div style="height: 160px;">
                    <label for="mensagem">Mensagem: </label><textarea name="mensagem" id="mensagem" rows="5" cols="45"></textarea>
                </div>
                <div>
                    <label>&nbsp;</label><button type="submit" id="enviar">Enviar</button>
                </div>
            </form>
        </div>
  </div>
</div>
