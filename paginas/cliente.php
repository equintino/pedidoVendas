<meta charset="utf-8" >
<?php
    include '../dao/CRUD.php';
    //include '../validacao/valida_cookies.php';

    @$excl=$_GET['excl'];
    @$pagAtual=$_GET['pagAtual'];
    if($excl==1){
        print_r($_GET);die;
    }
    if(array_key_exists('act', $_GET)){
        $act=$_GET['act'];
    }else{
       $act=null;
    }
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
        //// Listar Clientes ////
        $clientes_list_request=array('pagina'=>$pagAtual,'registros_por_pagina'=>'100','apenas_importado_api'=>'N');
        $dados=$cliente->ListarClientes($clientes_list_request);
   }elseif($act=='excl'){
        //// Excluir Cliente ////
        $clientes_cadastro_chave=array("codigo_cliente_omie"=>$_GET['codigo'],"codigo_cliente_integracao"=>"");
        $cliente->ExcluirCliente($clientes_cadastro_chave);
        header('Location:index.php?pagina=cliente&act=list');
   }elseif($act=='atualiza'){
        $clientes_list_request=array('pagina'=>'1','registros_por_pagina'=>'100','apenas_importado_api'=>'N');
        $dados=$cliente->ListarClientes($clientes_list_request);
        $paginas=$dados->total_de_paginas;
        
        if(file_exists('../model/model.php') && file_exists('../dao/ModelSearchCriteria.php') && file_exists('../dao/CRUD.php') && file_exists('../mapping/modelMapper.php')){
            $dao = new CRUD();
            $dao->drop('tb_cliente');
            for($x=0;$x<$paginas;$x++){
                $clientes_list_request=array('pagina'=>$x,'registros_por_pagina'=>'100','apenas_importado_api'=>'N');
                $dados=$cliente->ListarClientes($clientes_list_request);
                $result = array();
                foreach($dados->clientes_cadastro as $row){
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
                            //$tags=array();
                            foreach($item as $item_){
                                //array_push($tags, $item_);
                                $model->settag($item_->tag.',');
                            }
                        }
                    }
                    //$model->settag($tags);
                    //echo '<pre>';print_r($model);die;
                    $gravado=$dao->grava($model);
                    array_push($result, $model);
                }
            }
            if($gravado){
                echo 'Atualização feita com sucesso.';
            }
        }
   }
?>