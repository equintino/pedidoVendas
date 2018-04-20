<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php

    @$excl=$_GET['excl'];
    @$pagAtual=$_GET['pagAtual'];
    @$tipoBusca=$_GET['tipoBusca'];
    @$buscaPor=$_GET['buscaPor'];
    @$funcao=$_COOKIE['funcao'];
    
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
    echo '<script>var act="'.$act.'"</script>';
    
    if(array_key_exists('seleciona', $_GET)){
        $seleciona=$_GET['seleciona'];
        echo '<script>var seleciona='.$_GET['seleciona'].'</script>';
    }else{
        $seleciona=null;
    }
    
    $cliente=new ClientesCadastroJsonClient();
    $dao = new Dao();
    
    if(!isset($quant))
        $quant=0;
    
    if(@$_GET['gravado']){
        Flash::addFlash('Registro salvo com sucesso.');
    }
    
    if(@$_COOKIE['funcao']=='administrador'){
        $tagLista=array('Fornecedor','Cliente','Transportadora','Funcionário');
    }else{
        $tagLista=array('Cliente','Transportadora','Funcionário');
    }
    if(@$_GET['tags']=='undefined'){
        $tagsArray=null;
    }else{
        @$tagsArray=explode(',',$_GET['tags']);
    }
    
    //// função em segundo plano ////
    function execInBackground($cmd){
        if (substr(php_uname(), 0, 7) == "Windows"){
            pclose(popen("start /B ". $cmd, "r"));
        }else{
            exec($cmd);//. " > /dev/null &");
        }
    }
    
////////// Clientes ////////////
    if($funcao=='administrador' && $act=='adm'){
        
    }elseif($act=='list'){
        //// Listar Clientes ////
        if($tipoBusca=='servidor' || !$tipoBusca){
            if(!$pagAtual){
                $clientes_list_request=array('pagina'=>1,'registros_por_pagina'=>'50','apenas_importado_api'=>'N');
                $totalPagina=$cliente->ListarClientes($clientes_list_request)->total_de_paginas;
                $clientes_list_request=array('pagina'=>$totalPagina,'registros_por_pagina'=>'50','apenas_importado_api'=>'N');
            }else{
                $clientes_list_request=array('pagina'=>$pagAtual,'registros_por_pagina'=>'50','apenas_importado_api'=>'N');
            }
            $dados=$cliente->ListarClientes($clientes_list_request);
            $paginaAtual=$dados->pagina;
            $totalPagina=$dados->total_de_paginas;
            $totalRegistro=$dados->total_de_registros;
            
            $dados_=$dados->clientes_cadastro;
        }else{
            $search = new ModelSearchCriteria();
            $search->settabela('tb_cliente');
            $search->setnome_fantasia($buscaPor);
            if(@!$tagsArray[1]){
                $search->settags($tagLista);
            }else{
                $search->settags($tagsArray);
            }
            $dados_=$dao->encontrePorTag($search);
        }
    }elseif($act=='excl'){
        //// Excluir Cliente ////
        $clientes_cadastro_chave=array("codigo_cliente_omie"=>$_GET['codigo'],"codigo_cliente_integracao"=>"");
        $cliente->ExcluirCliente($clientes_cadastro_chave);
        header('Location:index.php?pagina=cliente&act=list');
    }elseif($act=='atualiza'){
        $tabelaAtualizando='Cliente';
        if($seleciona==0){
            echo '<script>pagina="cliente";act="atualiza";</script>';
            include '../paginas/atualizando.php';
            die;
        }elseif($seleciona==2){
            echo '<script>var seleciona=2</script>';
            include '../paginas/atualizando.php';
        }
        $clientes_list_request=array('pagina'=>'1','registros_por_pagina'=>'1','apenas_importado_api'=>'N');
        $dados=$cliente->ListarClientes($clientes_list_request);
        $paginas=$dados->total_de_paginas;
        $registroa=$dados->total_de_registros;
        if(@!$y){
            $y=1;
        }
        if(@!$x){
            $x=1;
        }
        for($x=1;$x<$paginas;$x++){
            $clientes_list_request=array('pagina'=>$x,'registros_por_pagina'=>'50','apenas_importado_api'=>'N');
            $dados=$cliente->ListarClientes($clientes_list_request);
            $result = array();
            $campos = array();
            if(is_object($dados)){
                foreach($dados->clientes_cadastro as $row){
                    if($y==1){
                        foreach($row as $key => $item){
                            if($key == 'info'){
                                foreach($item as $key_ => $item_){
                                    $campos[]=$key_;
                                }
                            }
                            $campos[]=$key;
                        }
                            // confere se exite as classes //
                        if(!file_exists('../model/model.php') || !file_exists('../dao/ModelSearchCriteria.php') || !file_exists('../dao/CRUD.php') || !file_exists('../mapping/modelMapper.php')){
                            include 'criaClasses.php';
                            $arquivo = new criaClsses();
                            $arquivo->tabela='tb_cliente';
                            array_push($campos,'cod_API','contato','optante_simples_nacional','telefone2_ddd','telefone2_numero','fax_ddd','fax_numero','homepage','observacao','contribuinte');
                            $variaveis=$arquivo->novoArquivo($campos);
                        }
                            // apaga e cria nova tabela //
                        include '../dao/CRUD.php';
                        $dao2 = new CRUD();
                        $dao2->drop('tb_cliente');
                    }
                    $model = new Model();
                    foreach($row as $key => $item){
                        if($key != 'info' && $key != 'tags'){
                            $classe='set'.$key;
                            $model->$classe($item);
                        }elseif($key == 'info'){
                            foreach($item as $key => $item){
                                $classe='set'.$key;
                                $model->$classe($item);
                            }
                        }elseif($key == 'tags'){
                            foreach($item as $item_){
                                $model->settags($item_->tag.',');
                            }
                        }
                    }
                    $gravado=$dao2->grava($model);
                    $y++;
                    echo '<script> document.getElementById("cont").innerHTML="Percentual concluido '.number_format($y*100/$registroa,'0','.','').'%";</script>';
                    if(number_format($y*100/$registroa,'0','.','')=='100'){
                        echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad\')</script>';
                    }
                }
            }
        }
    }
?>