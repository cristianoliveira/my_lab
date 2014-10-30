<?php 

include("../includes/cabecalho.php"); 
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
  
  $acao          = Parameter::GET('a');
  $dados         = Parameter::POST();
  $cores         = $dados['cor'];
  unset($dados['cor']);
  
  
    switch ($acao) {
        case 1: // INSERT
            
            if($produtos->insert($dados))
            {                
                $newprodutoId = $produtos->getLastId();
                
                log_file("newprodutoId = $newprodutoId");
                
                if($coresProdutos->insertInProduto($newprodutoId, $cores))
                   MensagemHelper::insertSucesso();
                else
                   MensagemHelper::erro('Erro ao inserir cores no produto.');
            }
            else
                MensagemHelper::erro();
            
            break;

        case 2: // UPDATE
            log_file("Update produto ".print_r($dados));
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
                                          , $_SERVER[DOCUMENT_ROOT].'/uploads/produtos/'.$nomeArquivoServidor.".jpg"))
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
            break;
        
        case 5: // DELETE GALERIA

            $imagemId = Parameter::GET('imagem');
            $imagem   = $imagensProdutos->getById($imagemId);
            if ($imagensProdutos->deleteById($imagemId)) {
                unlink($_SERVER[DOCUMENT_ROOT].'/uploads/produtos/'.$imagem['imagem']);
                MensagemHelper::deleteSucesso();
            }else
                MensagemHelper::erro("Erro ao deletar imagem.");

            break;           
        }
    
    if($acao != 4 && $acao != 5)
        header('Location:listar.php'); 
    else
        header('Location:cadastro.php?galeria=1&produto='.Parameter::POST('produto', 0));

?>