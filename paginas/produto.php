<meta charset="utf-8" >
<?php
    @$excl=$_GET['excl'];
    @$tipoBusca=$_GET['tipoBusca'];
    @$buscaPor=$_GET['buscaPor'];
    
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
    if($act=='excl'){
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
        $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>1,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produtos->ListarProdutos($produto_servico_list_request);
        
        $paginas=$dados->total_de_paginas;
        $registroa=$dados->total_de_registros;
        $y=1;
        for($x=1;$x<$paginas;$x++){
            $produto_servico_list_request=array("pagina"=>$x,"registros_por_pagina"=>1,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
            $dados=$produtos->ListarProdutos($produto_servico_list_request)->produto_servico_cadastro;
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
            
            $caracteristica= new ProdutosCaracteristicasJsonClient();
            $prcListarCaractRequest=array("nPagina"=>1,"nRegPorPagina"=>50,"nCodProd"=>$modelProduto->getcodigo_produto());
            $conteudo=$caracteristica->ListarCaractProduto($prcListarCaractRequest);
            
            echo ($y*100/$registroa).'%';
            
            foreach($conteudo->listaCaracteristicas as $item3){
                if(strtoupper($item3->cNomeCaract)==strtoupper('loja')){
                    $modelProduto->setloja($item3->cConteudo);
                }
            }
            echo ($y*100/$registroa).'%';
            //echo 'Atualização de número '.$y;
            $gravado=$dao2->grava2($modelProduto);
            $y++;
        }
        if($gravado){
            echo 'Atualização de Produtos realizada com sucesso.';
            //echo '<script>window.location.assign(\'index.php?pagina=produto&act=list&seleciona=1\')</script>';
        }die;
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
