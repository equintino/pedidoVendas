<meta charset="utf-8" >
<script type="text/javascript" src="../web/js/jquery-3.2.1.min.js"></script>
<style>
    .percentual{
        position: absolute;
        top: 50%;
        left: 50%;
    }
    .selecao{
        position: absolute;
        top: 30%;
        left: 30%; 
    }
    .selecao .opcao{
        float: right;
    }
    .selecao button{
        margin-left: 3px;
    }
    .selecao button:hover{
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function(){
        var codTabela=$('.opcao :selected').val();
        $('.opcao select').change(function(){
            codTabela=$(this).val();
        });
        $('button#submit').click(function(){
            window.location.assign('../web/index.php?pagina=produto&act=atualizaTabela&seleciona=0&codTabela='+codTabela+'');
        });
        $('button#cancela').click(function(){
            window.location.assign('../web/index.php?pagina=pedido&act=cad');
        });
    });
    function cancela(){
        window.location.assign('../web/index.php?pagina=pedido&act=cad');
    }
    function submit(codTabela){
        window.location.assign('../web/index.php?pagina=produto&act=atualizaTabela&seleciona=0&codTabela='+codTabela+'');
    }
</script>
<div id=contador></div>
<?php 
    if(array_key_exists('tipoBusca',$_GET)){
        $tipoBusca=$_GET['tipoBusca'];
    }
    if(array_key_exists('buscaPor',$_GET)){
        $buscaPor=$_GET['buscaPor'];
    }
    if(array_key_exists('funcao',$_COOKIE)){ 
        $funcao=$_COOKIE['funcao'];
    }else{
        $funcao=null;
    }
    if(array_key_exists('administrador',$_GET)){
        $administrador=$_GET['administrador'];
    }
    if(array_key_exists('seleciona',$_GET)){
        $seleciona=$_GET['seleciona'];
    }
    if(array_key_exists('codTabela',$_GET)){
        $codTabela=$_GET['codTabela'];
    }else{
        $codTabela='undefined';
    }
    echo '<script>var codTabela='.$codTabela.';</script>';
    if($funcao){
        echo '<script>var funcao="'.$funcao.'"</script>';
    }
    
    if(array_key_exists('act', $_GET)){
        $act=$_GET['act'];
    }else{
       $act=null;
    }
    
    $produtos=new ProdutosCadastroJsonClient();
    if(!isset($quant))$quant=0;
    
    if($act=='atualiza'){
        $caracteristica= new ProdutosCaracteristicasJsonClient();
        
        $tabelaAtualizando='Produto';
        if($seleciona==0){
            echo '<script>pagina="produto";act="atualiza";</script>';
            include '../paginas/atualizando.php';
            exit;
        }else{
            echo '<script>var seleciona=2</script>';
            include '../paginas/atualizando.php';
        }
        $regPorPagina=100;
        $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>$regPorPagina,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produtos->ListarProdutos($produto_servico_list_request);
        
        if(!$dados){
            echo 'Não foi encontrado nenhum produto cadastrado.';
            echo '<button onclick=history.go(-1)>Voltar</button>';
            exit;
        }
        $paginas=$dados->total_de_paginas;
        $registros=$dados->total_de_registros;
        
        $y=1;
        $campos=extraiCampos($dados->produto_servico_cadastro[0]);
        if(!file_exists('../model/modelProduto.php') || !file_exists('../dao/ProdutoSearchCriteria.php') || !file_exists('../dao/CRUDProduto.php') || !file_exists('../mapping/ProdutoMapper.php')){
            include 'criaClasses2.php';
            $arquivo = new criaClsses2();
            $arquivo->tabela='tb_produto';
            $variaveis=$arquivo->novoArquivo($campos);
        }   
        include '../dao/CRUDProduto.php';
        $dao2=new CRUDProduto();
        $dao2->drop('tb_produto');
         
        if($dados){
            $y=gravaDados($dados,1,$registros,$regPorPagina);
        }   
        for($x=2;$x<=$paginas;$x++){
            $produto_servico_list_request=array("pagina"=>$x,"registros_por_pagina"=>$regPorPagina,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
            $dados=$produtos->ListarProdutos($produto_servico_list_request);
            
            if(is_object($dados)){
                $y=gravaDados($dados,$y,$registros,$regPorPagina);
            }
        }
        echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad\');</script>';        
        exit;
    }elseif($act=='atualizaTabela'){
        if(!$codTabela || $codTabela=='undefined'){
            /* Tabela de Preço */
            $tabelaPreco=new TabelaPrecosJsonClient();
            $tprListarRequest=array("nPagina"=>1,"nRegPorPagina"=>20);
            @$codTabela=$tabelaPreco->ListarTabelasPreco($tprListarRequest);
            echo '<div class=selecao><h2>SELECIONE A TABELA DE PREÇO: </h2>';
            echo '<div class=opcao><select name="codTabela">';
            foreach($codTabela->listaTabelasPreco as $item){
                    echo '<option value="'.$item->nCodTabPreco.'">'.$item->cNome.'</option>';
                /*if(strtoupper($item->cNome)=='BOADICA'){
                    $codTabela=$item->nCodTabPreco;
                }*/
            }
            echo '</select>';
            echo '<button id=submit>Confirma</button><button id=cancela>Cancela</button></div></div>';
            exit;
        }
        $tabelaAtualizando='Preço';
        if($seleciona==0){
            echo '<script>pagina="produto";act="atualizaTabela";</script>';
            include '../paginas/atualizando.php';exit;
        }elseif($seleciona==2){
            echo '<script>var seleciona=2</script>';
            include '../paginas/atualizando.php';
        }
        include '../dao/CRUDProduto.php';
        
        $tabelaPreco=new TabelaPrecosJsonClient();
        $tprItensListarRequest=array("nPagina"=>1,"nRegPorPagina"=>50,"nCodTabPreco"=>$codTabela,"cCodIntTabPreco"=>"");
        $tabPreco=$tabelaPreco->ListarTabelaItens($tprItensListarRequest);
        is_object($tabPreco)? $obj='sim': $obj=null;
        if($obj){
            $nTotPaginas=$tabPreco->nTotPaginas;
            $nTotRegistros=$tabPreco->nTotRegistros;
            $nomeTabela=$tabPreco->listaTabelaPreco->cNome;
        }
        $contProd=1;
        $CRUDProduto=new CRUDProduto();        
        $CRUDProduto->drop('tb_preco');
        if($obj){
            $contProd=gravaTabelaPreco($tabPreco->listaTabelaPreco->itensTabela,$contProd,$nTotRegistros,$nomeTabela);
            if($nTotPaginas > 1){
                for($x=2;$x<=$nTotPaginas;$x++){
                    $tprItensListarRequest=array("nPagina"=>$x,"nRegPorPagina"=>50,"nCodTabPreco"=>$codTabela,"cCodIntTabPreco"=>"");
                    $tabPreco=$tabelaPreco->ListarTabelaItens($tprItensListarRequest);
                    $contProd=gravaTabelaPreco($tabPreco->listaTabelaPreco->itensTabela,$contProd,$nTotRegistros,$nomeTabela);
                }
            }
            echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad&seleciona=1\')</script>';
            exit;
        }else{
            echo '<h2>Tabela BoaDica não configurada</h2>';
            echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad\')</script>';
        }
        die;
            /// fim tabela de preço ///
    }
    function buscaTagLoja($codigo){
        $cod_prod=($dados->produto_servico_cadastro);
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
    function extraiCampos($dados){
        $campos=array();
        foreach($dados as $key => $item){
            if($key=='dadosIbpt'){
                $campos[]='dadosIbpt';
                foreach($item as $key2 => $item2){
                    $campos[]=$key2;
                }
            }elseif($key=='imagens'){
                $campos[]='imagens';
                foreach($item as $item2){
                    $campos[]='url_imagem';
                }
            }elseif($key=='recomendacoes_fiscais'){
                $campos[]='recomendacoes_fiscais';
                foreach($item as $key2 => $item2){
                    $campos[]=$key2;
                }
            }else{
                $campos[]=$key;
            }
        }
        return $campos;
    }
    function gravaDados($dados,$y,$registros,$regPorPagina){
        $caracteristica= new ProdutosCaracteristicasJsonClient();
        $dao2=new CRUDProduto();
        if(is_object($dados)){
            foreach($dados->produto_servico_cadastro as $item){
                $modelProduto = new modelProduto();
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
                        if($item_){
                            $modelProduto->seturl_imagem($item_[0]->url_imagem);
                        }
                    }else{
                        $classe='set'.$key;
                        $modelProduto->$classe($item_);
                    }
                }

                $prcListarCaractRequest=array("nPagina"=>1,"nRegPorPagina"=>$regPorPagina,"nCodProd"=>$modelProduto->getcodigo_produto());
                $conteudo=$caracteristica->ListarCaractProduto($prcListarCaractRequest);
                if(is_object($conteudo)){
                    foreach($conteudo->listaCaracteristicas as $item3){
                        if(strtoupper($item3->cNomeCaract)==strtoupper('loja')){
                            $modelProduto->setloja($item3->cConteudo);
                        }
                    }
                }

                $gravado=$dao2->grava2($modelProduto);
                echo '<script>document.getElementById("cont").innerHTML="Percentual concluido '.number_format($y*100/$registros,'0','.','').'%";</script>';
                $y++;
            }
        }
        return $y;
    }
    function gravaTabelaPreco($tabPreco,$contProd,$nTotRegistros,$nomeTabela){
        $CRUDProduto=new CRUDProduto();
        foreach($tabPreco as $item){
            if(isset($item->cCodigoProduto)){
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
        return $contProd;
    }
?>