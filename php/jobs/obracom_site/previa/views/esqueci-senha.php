<?php include 'includes/cabecalho-interna.php'; ?>

<div class="conteudo interna">
    <div class="container">

        <h1>Esqueci minha senha</h1>

        <div class="voltar"><a href="<?php echo SITE_URL ?>">&#171; VOLTAR</a></div>

        <p class="subtitulo-interna">Informe seu email.</p>

        <p>Digite o email cadastrado para a senha ser resetada. Depois clique em "Continuar".</p>

        <form method="post" action="<?php echo SITE_URL ?>/area-cliente/esqueci_senha" id="form-esqueci-senha" >
            <input type="hidden" name="acao" id="acao" value="esqueci-senha" />
            <ul>
                <li>
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" maxlength="255" value="" />
                </li>                
                <li>
                    <button type="submit">Enviar</button>
                </li>
                <li>
                    <?php if ( ! is_null($notificacao) AND strlen($notificacao->get_mensagem()) > 0) { ?>
                    <div id="form_notification" style="padding:5px;" class="<?php echo $notificacao->get_tipo() ?>"><?php echo $notificacao->get_mensagem() ?></div>
                    <?php } else { ?>
                    <div id="form_notification" style="padding:5px;"></div>
                    <?php } ?>
                </li>

            </ul>

        </form>

        <div class="clear"></div>
    </div>
</div>

<?php include 'includes/rodape.php'; ?>