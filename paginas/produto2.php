<script>
    $(document).ready(function(){
        if(act=='atualiza'){
            link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'&tipoBusca=local';
            $('a[rel=modal]').attr('href',link);
            
            $('.listaProduto').hide();
            $('.tituloProd').text('Aguarde...');
            $("a[rel=modal]").trigger("click")
        }
    })
</script>
<?php
    //include '../dao/dao.php';
    //include '../dao/ProdutoSearchCriteria.php';
    //include '../config/Config.php';
    //include '../config/OmieAppAuth.php';
    //include '../model/ProdutosCadastroJsonClient.php';
    //include '../model/modelProduto.php';
    //include '../mapping/ProdutoMapper.php';
    //include '../excecao/Excecao.php';
    include '../dao/ModelSearchCriteria.php';
    if($act=='atualiza'){
        $produtos=new ProdutosCadastroJsonClient();

        $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>1,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produtos->ListarProdutos($produto_servico_list_request);
        //echo '<pre>';print_r($dados);die;
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
    //echo '<pre>';print_r($modelProduto);die;
            //echo 'Atualização de número '.$y;
            $gravado=$dao2->grava2($modelProduto);
            $y++;
        }
        if($gravado){
            echo 'Atualização de Produtos realizada com sucesso.';
            //echo '<script>window.location.assign(\'index.php?pagina=produto&act=list&seleciona=1\')</script>';
        }
    }
?>

