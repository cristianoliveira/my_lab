<form id="form-endereco_cliente" class="form-default" method="post" action="<?= $form_action ?>"  >
        
    <?php if(isset($endereco_cliente['id'])) { ?>
    <input type="hidden"  
            name="id" 
            value="<?= $endereco_cliente['id'] ?>"
    />
    <?php } ?>
        
        <div>
             <input type="hidden"  
                    name="cliente_id" 
                    value="<?= if_exist($endereco_cliente['cliente_id']) ?>"/>
            
            <div class="cep">
                <label>CEP</label>
                <input type="text" 
                       class="text-input small-input required" 
                       id="form_nome" 
                       name="cep[prefix]" 
                       maxlength="5" 
                       value="<?= substr(if_exist($endereco_cliente['cep']),0,5) ?>" 
                />
                <input type="text" 
                       class="text-input required" 
                       id="form_nome" 
                       name="cep[sufix]" 
                       maxlength="3" 
                       value="<?= substr(if_exist($endereco_cliente['cep']),-3) ?>" 
                       style="width:100px;" 
                />
            </div>
            <div class="radio-input">            
                <input type="radio" 
                       id="tipo_residencial"  
                       name="tipo" 
                       value="residencial" 
                       <?= (if_exist($endereco_cliente['tipo'])!="residencial")? 'checked="checked"' : '' ?>
                >
                     Residencial
                </input>
                <input type="radio" 
                       id="tipo_comercial" 
                       name="tipo" 
                       value="comercial"
                       <?= (if_exist($endereco_cliente['tipo'])!="comercial")? 'checked="checked"' : '' ?>
                >
                     Comercial
                </input>
                <input type="radio" 
                       id="tipo_outro" 
                       name="tipo" 
                       value="outro"
                       <?= (if_exist($endereco_cliente['tipo'])!="outro")? 'checked="checked"' : '' ?>
                >
                     Outro
                </input>
            </div>
            <div class="endereco">
                <label>Endereço</label>
                <input type="text" 
                       class="text-input large-input required" 
                       id="endereco" 
                       name="endereco"
                       value="<?= if_exist($endereco_cliente['endereco']) ?>" 
                />
                <br />
            </div>

            <div class="numero">
                <label>Número</label>
                <input type="text" 
                       class="text-input small-input  required" 
                       id="numero" 
                       name="numero" 
                       maxlength="10" 
                       value="<?= if_exist($endereco_cliente['numero']) ?>" 
                />
            </div>

            <div class="complemento">
                <label>Complemento</label>
                <input type="text" 
                       class="text-input large-input required" 
                       id="complemento" 
                       name="complemento" 
                       maxlength="14" 
                       value="<?= if_exist($endereco_cliente['complemento']) ?>" 
                />
                <br />
            </div>
            <div class="bairro">
                <label>Bairro</label>
                <input type="text" 
                       class="text-input large-input required" 
                       id="bairro" 
                       name="bairro" 
                       maxlength="100" 
                       value="<?= if_exist($endereco_cliente['bairro']) ?>" />
            </div>
            <div class="cidade">
                <label>Cidade</label>
                <input type="text" 
                       class="text-input medium-input required" 
                       id="cidade" 
                       name="cidade" 
                       maxlength="11" 
                       value="<?= if_exist($endereco_cliente['cidade']) ?>" 
                />
                <br />
            </div>
            <div>
                <label>Estado</label>
                <select name="estado" id="form_genero" class="text-input required">
                  <option value="">Selecione</option>
                  <?php 
                      $estados = array( 'AC'
                                        ,'AL'
                                        ,'AP'
                                        ,'AM'
                                        ,'BA'
                                        ,'CE'
                                        ,'DF'
                                        ,'ES'
                                        ,'GO'
                                        ,'MA'
                                        ,'MT'
                                        ,'MS'
                                        ,'PA'
                                        ,'PB'
                                        ,'PR'
                                        ,'PE'
                                        ,'PI'
                                        ,'RJ'
                                        ,'RN'
                                        ,'RS'
                                        ,'RO'
                                        ,'RR'
                                        ,'SC'
                                        ,'SP'
                                        ,'SE'
                                        ,'TO');
      
                       foreach ($estados as $estado) { ?>

                  <option value="<?= $estado ?>"  <?= (if_exist($endereco_cliente['estado']) == $estado)? "selected" : ""; ?> >
                        <?= $estado ?>
                  </option>

                  <?php
                       }; 
                  ?>    
                </select>
            </div>
            <div class="salvar">
                <button type="submit"  class="button" id="btn_send" >Finalizar</button>
            </div>
        </div>            
            
    <div id="form_cadastro_notification"></div>
</form>