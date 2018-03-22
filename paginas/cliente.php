<meta charset="utf-8" >
<?php
    //include '../dao/UserDao.php';
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
        
        //echo '<pre>';print_r($dados->clientes_cadastro[0]);die;
        
        //$campos=array('bairro','cep','cidade','cidade_ibge','cnae','cnpj_cpf','codigo_cliente_integracao','codigo_cliente_omie','codigo_pais','complemento','email','endereco','endereco_numero','estado','exterior','inscricao_estadual','inscricao_municipal','nome_fantasia','pessoa_fisica','razao_social','telefone1_ddd','telefone1_numero','tipo_atividade');
        $result = array();
        foreach($dados->clientes_cadastro as $row){
            $model = new Model();
            foreach($row as $key => $item){
                if($key != 'info' && $key != 'tags'){
                    $classe='set'.$key;
                    //echo $classe.'()';die;
                    $model->$classe($item);
                }
            }
            echo '<pre>';print_r([$model,$row]);die;
            modelMapper::map($model, $row);
            echo '<pre>';print_r($model);die;
            $result[$model->getid()] = $model;
            print_r([$model,$result]);die;
        }
        foreach($_POST as $key => $item){
            $classe='set'.$key;
            $model->$classe($item);
        }
   }
?>