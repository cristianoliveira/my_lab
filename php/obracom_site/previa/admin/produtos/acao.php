<?php 

include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/models/produtos_model.php");
include("../includes/models/produtos_imagens_model.php");
include("../includes/models/produtos_cores_model.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/file_helper.php");
include("../includes/helpers/url_helper.php");

  $produtos      = new ProdutosModel();
  $coresProdutos = new ProdutosCoresModel();

  $acao           = Parameter::GET('a');
  $editar_galeria = Parameter::POST('editar_galeria',0) == 1 
                  || $acao == 5 
                  || $acao == 4;
                  
  $dados         = Parameter::POST();
  $cores         = $dados['cor'];
  
  $dados['oferta_imperdivel_home']   = Parameter::POST('oferta_imperdivel_home',0); 
  $dados['disponivel']               = Parameter::POST('disponivel',0); 
  $dados['ativo']                    = Parameter::POST('ativo',0); 
  $dados['descricao']                = trim(Parameter::POST('descricao','')); 
  
  $dados['valor_original']    = trata_valores($dados['valor_original']);
  $dados['valor_promocional'] = trata_valores($dados['valor_promocional']);
  $dados['altura']            = trata_valores($dados['altura']);
  $dados['largura']           = trata_valores($dados['largura']);
  $dados['peso']              = trata_valores($dados['peso']);
  $dados['comprimento']       = trata_valores($dados['comprimento']);


  unset($dados['cor']);
  unset($dados['editar_galeria']);  
  
    switch ($acao) {
        case 1: // INSERT
                $imagensProdutos = new ProdutosImagensModel();
                $nomeArquivoServidor = uniqid("produto-");

                log_file('Fazendo upload...'.$_FILES['imagem_produto']["name"]);
                
                if(FileHelper::upload('imagem_produto', $nomeArquivoServidor, site_path('uploads/produtos/')))
                {
                    log_file('Upload feito.');
                }

            $dados['imagem'] = $nomeArquivoServidor.".jpg";

            if($produtos->insert($dados))
            {   
                $newprodutoId = $produtos->getLastId();
                log_file("newprodutoId = $newprodutoId");
                
                if($coresProdutos->insertInProduto($newprodutoId, $cores))
                {
                   MensagemHelper::insertSucesso();
                   if($editar_galeria)
                   {
                      header('Location:editar.php?galeria=1&id='.$newprodutoId );
                      return;
                   }
                } 
                else
                   MensagemHelper::erro('Erro ao inserir cores no produto.');
            }
            else
                MensagemHelper::erro();
            
            break;

        case 2: // UPDATE
            if($produtos->updateById($dados['id'], $dados))
            {
                if($coresProdutos->updateCoresDoProduto($dados['id'], $cores))
                    MensagemHelper::updateSucesso();
                else
                    MensagemHelper::erro('Erro ao atualizar cores.');
            }
            else
                MensagemHelper::erro();

            break;

        case 3: // DELETE
            
            $id = Parameter::GET('id');
            
            if($produtos->deleteById($id))
            {
                MensagemHelper::deleteSucesso();
            }
            else
                MensagemHelper::erro();
                            
            break;
    
        case 4: // UPLOAD GALERIA
            
            $imagensProdutos = new ProdutosImagensModel();
            $produtoId       = Parameter::POST('produto', false);
            $titulo          = Parameter::POST('titulo');

            if(!$produtoId)
            {
                MensagemHelper::erro("Selecione um produto.");
            }
            else
            {
               
               $nomeArquivoServidor = uniqid("produto-$produtoId-");

               log_file('Fazendo upload...'.$dados['imagem_produto']);
                
                if(FileHelper::base64ToJpg( $dados['imagem_produto']
                                          , site_path('uploads/produtos/'.$nomeArquivoServidor.".jpg")))
                {
                    log_file('Upload feito.');
                    
                    if($imagensProdutos->insert(array( 'produto_id'=> $produtoId
                                                     , 'imagem'    => $nomeArquivoServidor.".jpg"
                                                     , 'titulo'    => $titulo))){

                        MensagemHelper::sucesso("Upload realizado com sucesso.");
                    }else
                        MensagemHelper::erro("Erro ao salvar imagem no banco.");
                        

                }   
                
            }

            header('Location:editar.php?galeria=1&id='.$produtoId);
            return;

            break;
        
        case 5: // DELETE GALERIA

            $imagensProdutos = new ProdutosImagensModel();
            $imagemId   = Parameter::GET('id',0);
            $produtoId  = Parameter::GET('produto',0);
            $imagem     = $imagensProdutos->getById($imagemId);
            if ($imagensProdutos->deleteById($imagemId)) {
                unlink(site_path('uploads/produtos/'.$imagem['imagem']));
                MensagemHelper::deleteSucesso();
            }else
                MensagemHelper::erro("Erro ao deletar imagem.");
            
            header('Location:editar.php?galeria=1&id='.$produtoId);
            return;
            
            break;           
        }
    
        header('Location:listar.php'); 
?>