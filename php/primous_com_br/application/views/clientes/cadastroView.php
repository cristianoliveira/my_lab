<div id="conteudoPagina">
    <h2>Para baixar é necessario cadastro</h2>
    <div class="contato">
        <p>Para que nós possamos lhe fornecer o melhor suporte, necessitamos que você cadastre-se antes de realizar o download.<p/>
        <div>
            <form action="<?php echo site_url('clientes'); ?>" >
                <label for="nome">Nome</label><?php echo form_input(array('name'=>'nome'), $cliente->nome); ?>
                <label for="profissao">Profissão</label><?php echo form_input(array('name'=>'profissão'), $cliente->profissao); ?>
                <label for="estado">Estado</label><?php echo form_dropdown('estado', $estados, $cliente->estado_id); ?>
                <label for="cidade">Cidade</label><?php echo form_dropdown('cidade', $cidades, $cliente->cidade_id); ?>
            </form>    
       </div>
  </div>
</div>
