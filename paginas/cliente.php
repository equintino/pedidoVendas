<!DOCUMENT html>
<head>
<meta charset="utf-8" >
<script>
    /*$(document).ready(function(){
        $(location).attr('href','../web/index.php?pagina=cliente&act=list&seleciona=1')
    })*/        
</script>
</head>
<body>
<?php
    @$excl=$_GET['excl'];
    @$pagAtual=$_GET['pagAtual'];
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
    echo '<script>var act="'.$act.'"</script>';
    
    if(array_key_exists('seleciona', $_GET)){
        $seleciona=$_GET['seleciona'];
        echo '<script>var seleciona='.$_GET['seleciona'].'</script>';
    }else{
        $seleciona=null;
    }
    
    $cliente=new ClientesCadastroJsonClient();
    
    if(!isset($quant))
        $quant=0;
    
    if(@$_GET['gravado']){
        Flash::addFlash('Registro salvo com sucesso.');
    }
    
    $tagLista=array('Fornecedor','Cliente','Transportadora','Funcionário');
    if(@$_GET['tags']=='undefined'){
        $tagsArray=null;
    }else{
        @$tagsArray=explode(',',$_GET['tags']);
    }
////////// Clientes ////////////
    if($act=='list'){
    //print_r([$_GET,$tipoBusca,$pagAtual]);die;
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
            $dao = new Dao();
            $search = new ModelSearchCriteria();
            $search->settabela('tb_cliente');
            $search->setrazao_social($buscaPor);
            if(@$buscaPor){
                $dados_=$dao->encontre($search);
            }else{
                $dados=null;
                if(@!$tagsArray[1]){
                    $search->settags($tagLista);
                }else{
                    $search->settags($tagsArray);
                }
                $dados_=$dao->encontrePorTag($search);
            }
        }
    }elseif($act=='excl'){
        //// Excluir Cliente ////
        $clientes_cadastro_chave=array("codigo_cliente_omie"=>$_GET['codigo'],"codigo_cliente_integracao"=>"");
        $cliente->ExcluirCliente($clientes_cadastro_chave);
        header('Location:index.php?pagina=cliente&act=list');
    }elseif($act=='atualiza'){
        if($seleciona==0){
            include '../paginas/atualizando.php';
            die;
        }elseif($seleciona==2){
            echo '<script>var seleciona=2</script>';
            include '../paginas/atualizando.php';
        }
        //die;
        $clientes_list_request=array('pagina'=>'1','registros_por_pagina'=>'1','apenas_importado_api'=>'N');
        $dados=$cliente->ListarClientes($clientes_list_request);
        $paginas=$dados->total_de_paginas;
        //echo '<pre>';print_r($dados);die;
        if(@!$y){
            $y=1;
        }
        if(@!$x){
            $x=1;
        }
        //$x=2;
        //$y=1;
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
                            array_push($campos,'cod_API','contato','optante_simples_nacional','telefone2_ddd','telefone2_numero','fax_ddd','fax_numero','homepage','observacao');
                            $variaveis=$arquivo->novoArquivo($campos);
                        }
                            // apaga e cria nova tabela //
                        include '../dao/CRUD.php';
                        $dao = new CRUD();
                        $dao->drop('tb_cliente');
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
                    //echo 'Atualização de número '.$y;
                    $gravado=$dao->grava($model);
                    $y++;
                }
            }
        }
        /*$resposta="<script> var prompt('A primeira página foi concluída com sucesso. Deseja continuar?')</script>";
        
        if($resposta){
            echo 'voce respondeu sim.';
        }else{
            echo 'voce respondeu não.';
        }*/
        echo '<div id=cont></div><br>';
        
        if($gravado){
            echo 'Atualização de Cleintes realizada com sucesso.';
            echo '<script>window.location.assign(\'index.php?pagina=cliente&act=list&seleciona=1\')</script>';
        }
        //die;
    }
?>
</body>
</html>