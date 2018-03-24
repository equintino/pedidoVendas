<meta charset="utf-8" >
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
        if($tipoBusca=='servidor'){
            $clientes_list_request=array('pagina'=>$pagAtual,'registros_por_pagina'=>'100','apenas_importado_api'=>'N');
            $dados=$cliente->ListarClientes($clientes_list_request);
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
        $clientes_list_request=array('pagina'=>'1','registros_por_pagina'=>'100','apenas_importado_api'=>'N');
        $dados=$cliente->ListarClientes($clientes_list_request);
        $paginas=$dados->total_de_paginas;
        
        $y=1;
        for($x=0;$x<$paginas;$x++){
            $clientes_list_request=array('pagina'=>$x,'registros_por_pagina'=>'100','apenas_importado_api'=>'N');
            $dados=$cliente->ListarClientes($clientes_list_request);
            $result = array();
            $campos = array();
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
                $gravado=$dao->grava($model);
                $y++;
            }
        }
        if($gravado){
            echo 'Atualização de Cleintes realizada com sucesso.';
        }
        die;
    }
?>