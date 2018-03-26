<meta charset="utf-8" >
<?php
    @$excl=$_GET['excl'];
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
        $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>50,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produtos->ListarProdutos($produto_servico_list_request);
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
                            foreach($item_ as $key2 => $item2){
                                $campos[]=$key2;
                            }
                        }elseif($key=='imagens'){
                            foreach($item_ as $item2){
                                $campos[]='url_imagem';
                            }
                        }elseif($key=='recomendacoes_fiscais'){
                            foreach($item_ as $key2 => $item2){
                                $campos[]=$key2;
                            }
                        }else{
                            $campos[]=$key;
                        }
                    }
                }
            }
            if(!file_exists('../model/modelProduto.php') || !file_exists('../dao/ProdutoSearchCriteria.php') || !file_exists('../dao/CRUDProduto.php') || !file_exists('../mapping/ProdutoMapper.php')){
                echo 'não tem';
                die;
            }
            $y++;
            echo '<pre>';print_r($campos);die;
        }die;
    }
?>
