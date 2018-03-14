<meta charset="utf-8" >
<?php
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
        echo $dados->total_de_paginas;
        
        $campos=array('bairro','cep','cidade','cidade_ibge','cnae','cnpj_cpf','codigo_cliente_integracao','codigo_cliente_omie','codigo_pais','complemento','email','endereco','endereco_numero','estado','exterior','inscricao_estadual','inscricao_municipal','nome_fantasia','pessoa_fisica','razao_social','telefone1_ddd','telefone1_numero','tipo_atividade');
        $result = array();
        foreach($dados->clientes_cadastro as $row){
            $model = new Model();
            echo '<pre>';print_r($row);die;
            //modelMapper::map($model, $row);
            $result[$model->getid()] = $model;
        }
        foreach($_POST as $key => $item){
            $classe='set'.$key;
            $model->$classe($item);
        }
   }
?>