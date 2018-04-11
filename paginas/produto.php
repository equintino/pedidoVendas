<meta charset="utf-8" >
<style>
    .percentual{
        position: absolute;
        top: 50%;
        laft: 50%;
    }
</style>
<div id=contador></div>
<?php 
    @$excl=$_GET['excl'];
    @$tipoBusca=$_GET['tipoBusca'];
    @$buscaPor=$_GET['buscaPor'];
    @$funcao=$_COOKIE['funcao'];
    @$administrador=$_GET['administrador'];
    @$seleciona=$_GET['seleciona'];
    
    if(@$funcao){
        echo '<script>var funcao="'.$funcao.'"</script>';
    }
    
    if($excl==1){
        print_r($_GET);die;
    }
    if(array_key_exists('act', $_GET)){
        $act=$_GET['act'];
    }else{
       $act=null;
    }
    
    $produtos=new ProdutosCadastroJsonClient();
    if(!isset($quant))
        $quant=0;
    
    if(@$_GET['gravado']){
        Flash::addFlash('Registro salvo com sucesso.');
    }
    
////////// Produtos ////////////
    if($funcao=='administrador' && $administrador != 0){
        $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>100,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $prod=$produtos->ListarProdutos($produto_servico_list_request);
        $paginaTotal=$prod->total_de_paginas;
        $registroTotal=$prod->total_de_registros;
        
        $dao=new Dao();
        $search=new ProdutoSearchCriteria();
        $search->settabela('tb_produto');
        $prodLocal=$dao->encontre2($search);
        
        //echo '<pre>';print_r($prodLocal);die;
        //echo '<pre>';print_r([$_GET,$_POST,$funcao]);die;
    }elseif($act=='excl'){
        $produto_servico_cadastro_chave = array("codigo_produto" => $_GET['codigo'], "codigo_cliente_integracao" => "", "codigo" => "");
        $produtos->ExcluirProduto($produto_servico_cadastro_chave);
        header('Location:index.php?pagina=produto&act=list');
    }elseif($act=='cons'){
        @$codigo_produto=$_GET['codigo'];
        if(!$codigo_produto)$codigo_produto=0;
        $produto_servico_cadastro_chave=array("codigo_produto"=>$codigo_produto,"codigo_produto_integracao"=>"","codigo"=>"");
        $dados=$produtos->ConsultarProduto($produto_servico_cadastro_chave);
    }elseif($act=='alt'){
        @$codigo_produto=$_GET['codigo'];
        if(!$codigo_produto)$codigo_produto=0;
        $produto_servico_cadastro_chave=array("codigo_produto"=>$codigo_produto,"codigo_produto_integracao"=>"","codigo"=>"");
        $dados=$produtos->ConsultarProduto($produto_servico_cadastro_chave);
    }elseif($act=='list'){  
        //// Listar Produtos ////
        $tipoBusca='local';
        if($tipoBusca=='servidor'){
            $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>50,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
            $dados=$produtos->ListarProdutos($produto_servico_list_request);
            $paginas=$dados->total_de_paginas;
            $registrosTotal=$dados->total_de_registros;
        }else{
            $dao = new Dao();
            $search = new ProdutoSearchCriteria();
            $search->settabela('tb_produto');
            $search->setcodigo($buscaPor);
            $dados=$dao->encontre2($search);
            //echo '<pre>';print_r($dados_);die;
            if(@$buscaPor){
                //$dados_=$dao->encontre2($search);
            }/*else{
                $dados=null;
                if(@!$tagsArray[1]){
                    $search->settags($tagLista);
                }else{
                    $search->settags($tagsArray);
                }
                $dados_=$dao->encontrePorTag($search);
            }*/
        }
    }elseif($act=='atualiza'){
        $tabelaAtualizando='Produto';
        if($seleciona==0){
            echo '<script>pagina="produto";act="atualiza";</script>';
            include '../paginas/atualizando.php';
            die;
        }elseif($seleciona==2){
            echo '<script>var seleciona=2</script>';
            include '../paginas/atualizando.php';
        }
        $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>1,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produtos->ListarProdutos($produto_servico_list_request);
        
        if(!$dados){
            echo 'Não foi encontrado nenhum produto cadastrado.';
            echo '<button onclick=history.go(-1)>Voltar</button>';
            exit;
        }
        $paginas=$dados->total_de_paginas;
        $registroa=$dados->total_de_registros;
        $y=1;
        for($x=1;$x<=$paginas;$x++){
            $produto_servico_list_request=array("pagina"=>$x,"registros_por_pagina"=>1,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
            @$dados=$produtos->ListarProdutos($produto_servico_list_request)->produto_servico_cadastro;
            $campos=array();
            if($y==1){
                foreach($dados as $item){
                    foreach($item as $key => $item_){
                        if($key=='dadosIbpt'){
                            $campos[]='dadosIbpt';
                            foreach($item_ as $key2 => $item2){
                                $campos[]=$key2;
                            }
                        }elseif($key=='imagens'){
                            $campos[]='imagens';
                            foreach($item_ as $item2){
                                $campos[]='url_imagem';
                            }
                        }elseif($key=='recomendacoes_fiscais'){
                            $campos[]='recomendacoes_fiscais';
                            foreach($item_ as $key2 => $item2){
                                $campos[]=$key2;
                            }
                        }else{
                            $campos[]=$key;
                        }
                    }
                }
                if(!file_exists('../model/modelProduto.php') || !file_exists('../dao/ProdutoSearchCriteria.php') || !file_exists('../dao/CRUDProduto.php') || !file_exists('../mapping/ProdutoMapper.php')){
                    include 'criaClasses2.php';
                    $arquivo = new criaClsses2();
                    $arquivo->tabela='tb_produto';
                    $variaveis=$arquivo->novoArquivo($campos);
                }   
                    // apaga e cria nova tabela //
                include '../dao/CRUDProduto.php';
                $dao2=new CRUDProduto();
                $dao2->drop('tb_produto');
            
            }
            $modelProduto = new modelProduto();
            if(is_object($dados)){
                foreach($dados as $item){
                    foreach($item as $key => $item_){
                        if($key == 'dadosIbpt'){
                            foreach($item_ as $key2 => $item2){
                                $classe='set'.$key2;
                                $modelProduto->$classe($item2);
                            } 
                        }elseif($key == 'recomendacoes_fiscais'){
                            foreach($item_ as $key2 => $item2){
                                $classe='set'.$key2;
                                $modelProduto->$classe($item2);
                            }
                        }elseif($key == 'imagens'){
                            if(@$item_[0]->url_imagem){
                                @$modelProduto->seturl_imagem($item_[0]->url_imagem);
                            }
                        }else{
                            $classe='set'.$key;
                            $modelProduto->$classe($item_);
                        }
                    }
                }
            }
                
                    
            
            $caracteristica= new ProdutosCaracteristicasJsonClient();
            $prcListarCaractRequest=array("nPagina"=>1,"nRegPorPagina"=>50,"nCodProd"=>$modelProduto->getcodigo_produto());
            $conteudo=$caracteristica->ListarCaractProduto($prcListarCaractRequest);
            
            
            echo '<script> document.getElementById("cont").innerHTML="Percentual concluido '.number_format($y*100/$registroa,'0','.','').'%";</script>';
            if(is_object($conteudo)){
                foreach($conteudo->listaCaracteristicas as $item3){
                    if(strtoupper($item3->cNomeCaract)==strtoupper('loja')){
                        $modelProduto->setloja($item3->cConteudo);
                    }
                }
            }
            $gravado=$dao2->grava2($modelProduto);
            $y++;
        }
        echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad\')</script>';
        die;
    }elseif($act=='atualiza2'){
        //caract:
        $caracteristica= new ProdutosCaracteristicasJsonClient();
        foreach($cod_prod as $item){
            $prcListarCaractRequest=array("nPagina"=>1,"nRegPorPagina"=>50,"nCodProd"=>$item->codigo_produto);
            $conteudo=$caracteristica->ListarCaractProduto($prcListarCaractRequest);
            echo '<pre>';print_r(@$conteudo->listaCaracteristicas);
            foreach(@$conteudo->listaCaracteristicas as $item2){
                echo $item2->cNomeCaract.'<br>';
                if(strtoupper($item2->cNomeCaract)==strtoupper('loja')){
                    print_r($item2->cConteudo);die;
                }
            }
        
        }die;
    }elseif($act=='atualizaTabela'){
        $tabelaAtualizando='Preço';
        if($seleciona==0){
            echo '<script>pagina="produto";act="atualizaTabela";</script>';
            include '../paginas/atualizando.php';die;
        }elseif($seleciona==2){
            echo '<script>var seleciona=2</script>';
            include '../paginas/atualizando.php';
        }
        include '../dao/CRUDProduto.php';
        ///// Tabela de Preço //////
        $tabelaPreco=new TabelaPrecosJsonClient();
        $tprItensListarRequest=array("nPagina"=>1,"nRegPorPagina"=>50,"nCodTabPreco"=>742240473,"cCodIntTabPreco"=>"");
        @$tabPreco=$tabelaPreco->ListarTabelaItens($tprItensListarRequest);
        is_object($tabPreco)? $obj='sim': $obj=null;
        if($obj){
            $nTotPaginas=$tabPreco->nTotPaginas;
            $nTotRegistros=$tabPreco->nTotRegistros;
            $nomeTabela=$tabPreco->listaTabelaPreco->cNome;
            //echo '<br>Tabela de Preço ('.$tabPreco->listaTabelaPreco->cNome.')<br>';
            //echo 'Total de Páginas '.$nTotPaginas.'<br>';
            //echo '<span id=totalLido></span> / '.$nTotRegistros.'<br><br>';
        }
        $contProd=1;
        $CRUDProduto=new CRUDProduto();
        
        $CRUDProduto->drop('tb_preco');
        if($obj){
            foreach($tabPreco->listaTabelaPreco->itensTabela as $item){
                if(@$item->cCodigoProduto){
                    $modelProduto=new modelProduto();
                    $modelProduto->setnTabela($nomeTabela);
                    $modelProduto->setmodificado($item->itemInfo->dAltItem.' '.$item->itemInfo->hAltItem);
                    $modelProduto->setcodigo($item->cCodigoProduto);
                    $modelProduto->setpOriginal($item->nValorOriginal);
                    $modelProduto->setpTabela($item->nValorTabela);
                    
                    echo '<script> document.getElementById("cont").innerHTML="Percentual concluido '.number_format($contProd*100/$nTotRegistros,'0','.','').'%";</script>';
                    
                                        
                    $CRUDProduto->grava4($modelProduto);
                    $contProd++;
                }
            }
        
            for($x=2;$x<=$nTotPaginas;$x++){
                $tprItensListarRequest=array("nPagina"=>$x,"nRegPorPagina"=>50,"nCodTabPreco"=>742240473,"cCodIntTabPreco"=>"");
                $tabPreco=$tabelaPreco->ListarTabelaItens($tprItensListarRequest);
                foreach($tabPreco->listaTabelaPreco->itensTabela as $item){
                    if(@$item->cCodigoProduto){
                        $modelProduto=new modelProduto();
                        $modelProduto->setnTabela($nomeTabela);
                        $modelProduto->setmodificado($item->itemInfo->dAltItem.' '.$item->itemInfo->hAltItem);
                        $modelProduto->setcodigo($item->cCodigoProduto);
                        $modelProduto->setpOriginal($item->nValorOriginal);
                        $modelProduto->setpTabela($item->nValorTabela);
                        echo '<script> document.getElementById("cont").innerHTML="Percentual concluido '.number_format($contProd*100/$nTotRegistros,'0','.','').'%";</script>';
                       
                        $gravado=$CRUDProduto->grava4($modelProduto);
                        $contProd++;
                    }
                }
            }
                //echo 'Atualização de Produtos realizada com sucesso.';
                echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad&seleciona=1\')</script>';
                die;
        }else{
            echo '<h2>Tabela BoaDica não configurada</h2>';
            echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad\')</script>';
        }
        die;
            /// fim tabela de preço ///
    }
    function buscaTagLoja($codigo){
        $cod_prod=($dados->produto_servico_cadastro);
        echo '<pre>';print_r($cod_prod);die;
        //goto caract;
        //die;
        $caracteristica= new ProdutosCaracteristicasJsonClient();
        foreach($cod_prod as $item){
            $prcListarCaractRequest=array("nPagina"=>1,"nRegPorPagina"=>50,"nCodProd"=>$item->codigo_produto);
            $conteudo=$caracteristica->ListarCaractProduto($prcListarCaractRequest);
            foreach(@$conteudo->listaCaracteristicas as $item){
                if(strtoupper($item->cNomeCaract)==strtoupper('loja')){
                    $loja=$item->cConteudo;
                }
            }
        }
    }
?>
