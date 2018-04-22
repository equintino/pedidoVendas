<meta charset="utf-8" />
<script type=text/javascript src="../web/js/jquery-3.2.1.min.js" ></script>
<script>
    $(document).ready(function(){
        $.post( "../pagimas/background-script.php?iniciarbackground=true", { name: "John", time: "2pm" } ); 
    })
</script>
<?php
    if ($_GET['iniciarbackground'] == 'true') { // chamada iniciada pelo ajax
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, '../paginas/background-script.php?iniciarbackground=');
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        // repassar ao cURL, tudo que recebeu como POST:
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);

        curl_exec($ch);
        curl_close($ch);
    } else { // chamada iniciada pelo cURL
        /// tarefas a executar no background ///
        
        include '../model/ClientesCadastroJsonClient.php';
        include '../dao/dao.php';
        include '../config/Config.php';
        include '../model/model.php';
        include '../dao/ModelSearchCriteria.php';
        
        $cliente=new ClientesCadastroJsonClient();
        $clientes_list_request=array('pagina'=>'1','registros_por_pagina'=>'1','apenas_importado_api'=>'N');
        $dados=$cliente->ListarClientes($clientes_list_request);
        $paginas=$dados->total_de_paginas;
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
                    echo $y*100/$paginas .'%'.'<br>';
                }
            }
        }
        echo '<div id=cont></div><br>';
        
        if($gravado){
            echo 'Atualização de Cleintes realizada com sucesso.';
            //echo '<script>window.location.assign(\'index.php?pagina=cliente&act=list&seleciona=1\')</script>';
        }

    }
?>