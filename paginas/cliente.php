<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
    include '../flash/Flash.php';
    if(array_key_exists('pagAtual',$_GET)){
        $pagAtual=$_GET['pagAtual'];
    }else{
        $pagAtual=null;
    }
    if(array_key_exists('tipoBusca',$_GET)){
        $tipoBusca=$_GET['tipoBusca'];
    }else{
        $tipoBusca=null;
    }
    if(array_key_exists('buscaPor',$_GET)){
        $buscaPor=$_GET['buscaPor'];
    }
    if(array_key_exists('funcao', $_GET)){
        $funcao=$_COOKIE['funcao'];
    }else{
        $funcao=null;
    }
    echo '<script>var funcao="'.$funcao.'"</script>';
    if(array_key_exists('codTabela',$_GET)){
        $codTabela=$_GET['codTabela'];
    }else{
        $codTabela='undefined';
    }
    echo '<script>var codTabela='.$codTabela.'</script>';
    if(array_key_exists('act', $_GET)){
        $act=$_GET['act'];
    }else{
       $act=null;
    }
    echo '<script>var act="'.$act.'"</script>';
    
    if(array_key_exists('seleciona', $_GET)){
        $seleciona=$_GET['seleciona'];
    }else{
        $seleciona=null;
    }
    echo '<script>var seleciona='.$_GET['seleciona'].'</script>';
    
    $cliente=new ClientesCadastroJsonClient();
    $dao = new Dao();
    
    if(!isset($quant))$quant=0;
    
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
    
    /////// funções ///////
    function extraiCampos($dados){
        $campos=array();
        foreach($dados->clientes_cadastro[0] as $key => $item){
            if($key=='info' || $key=='tags'){
                foreach($item as $key_ => $item_){
                    if($key_!='tags'){
                        $campos[]=$key_;
                    }
                }
            }
            $campos[]=$key;
        }
        return $campos;
    }
    function gravaDados($dados,$y,$registros){
        $dao2 = new CRUD();
        foreach($dados as $item_){
            if(is_object($item_)){
                $model = new Model();
                foreach($item_ as $key => $item){
                    if($key != 'info' && $key != 'tags'){
                        $classe='set'.$key;
                        $model->$classe($item);
                    }elseif($key == 'info'){
                        foreach($item as $key => $item){
                            $classe='set'.$key;
                            $model->$classe($item);
                        }
                    }elseif($key == 'tags'){
                        foreach($item as $item2){
                            $model->settags($item2->tag.',');
                        }
                    }
                }
                $gravado=$dao2->grava($model);
                $y++;
                
                echo '<script>document.getElementById("cont").innerHTML="Percentual concluido '.number_format($y*100/$registros,'0','.','').'%";</script>';
            }
        }
        return $y;
    }
    
////////// Clientes ////////////
    if($act=='list'){
        //// Listar Clientes ////
        if($tipoBusca=='servidor' || !$tipoBusca){
            if(!$pagAtual){
                $clientes_list_request=array('pagina'=>1,'registros_por_pagina'=>'50','apenas_importado_api'=>'N');
                $totalPagina_=$cliente->ListarClientes($clientes_list_request);
                if(is_object($totalPagina_) || $totalPagina_){
                    $totalPagina=$totalPagina_->total_de_paginas;
                }else{
                    Flash::addFlash('Favor recarregar a página.');
                }
                $clientes_list_request=array('pagina'=>@$totalPagina,'registros_por_pagina'=>'50','apenas_importado_api'=>'N');
            }else{
                $clientes_list_request=array('pagina'=>$pagAtual,'registros_por_pagina'=>'50','apenas_importado_api'=>'N');
            }
            $dados=$cliente->ListarClientes($clientes_list_request);
            if(is_object($dados)){
                $paginaAtual=$dados->pagina;
                $totalPagina=$dados->total_de_paginas;
                $totalRegistro=$dados->total_de_registros;

                $dados_=$dados->clientes_cadastro;
            }else{
                Flash::addFlash('Favor recarregar a página.');
            }
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
    }elseif($act=='atualiza'){
        $tabelaAtualizando='Cliente';
        if($seleciona==0){
            echo '<script>pagina="cliente";act="atualiza";</script>';
            include '../paginas/atualizando.php';
            exit;
        }elseif($seleciona==2){
            echo '<script>var seleciona=2</script>';
            include '../paginas/atualizando.php';
        }
        
        $regPorPagina=5;
        $clientes_list_request=array('pagina'=>'1','registros_por_pagina'=>$regPorPagina,'apenas_importado_api'=>'N');
        $dados=$cliente->ListarClientes($clientes_list_request);
        if(is_object($dados)){
            $paginas=$dados->total_de_paginas;
            $registros=$dados->total_de_registros;
        }else{
            Flash::addFlash('Favor recarregar a página.');
        }
        $campos=extraiCampos($dados);
        if(!file_exists('../model/model.php') || !file_exists('../dao/ModelSearchCriteria.php') || !file_exists('../dao/CRUD.php') || !file_exists('../mapping/modelMapper.php')){
            include 'criaClasses.php';
            $arquivo = new criaClsses();
            $arquivo->tabela='tb_cliente';
            array_push($campos,'cod_API','contato','optante_simples_nacional','telefone1_ddd','telefone1_numero','telefone2_ddd','telefone2_numero','fax_ddd','fax_numero','homepage','tipo_atividade','email','cnae');
            $variaveis=$arquivo->novoArquivo($campos);
        }
            // apaga e cria nova tabela //
        include '../dao/CRUD.php';
        $dao2 = new CRUD();
        $dao2->drop('tb_cliente');
                
        $y=gravaDados($dados->clientes_cadastro,1,$registros);
        
        if($paginas > 1){
            for($x=2;$x<=$paginas;$x++){
                $clientes_list_request=array('pagina'=>$x,'registros_por_pagina'=>$regPorPagina,'apenas_importado_api'=>'N');
                $dados=$cliente->ListarClientes($clientes_list_request);
                if(is_object($dados)){
                    $y=gravaDados($dados->clientes_cadastro, $y, $registros);
                    if(number_format($y*100/$registros,'0','.','')=='100'){
                        echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad\')</script>';
                    }
                }else{
                    Flash::addFlash('Favor, recarregar a página...');
                }
            }
        }else{
            echo '<script>window.location.assign(\'index.php?pagina=pedido&act=cad\')</script>';
        }
        exit;
    }
?>