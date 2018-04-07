<meta charset="UTF-8">
<?php
    include '../validacao/valida_cookies.php';
    $criptografia = new valida_cookies(); 
    $dao = new UserDao();
    $user = new User();
    foreach($_POST as $key => $item){
        if($key!='senha2'&&$key!='senha'){
            $classe='set'.$key;
            $user->$classe($item);
        }elseif($key=='senha'){
            $classe='set'.$key;
            $user->$classe($criptografia->criptografia($item));            
        }
    }
    include '../model/EmpresasCadastroJsonClient.php';
    $empresa=new EmpresasCadastroJsonClient();
    $empresas_list_request=array("pagina"=>1,"registros_por_pagina"=>100,"apenas_importado_api"=>"N");
    define('OMIE_APP_KEY',$_POST['OMIE_APP_KEY']);
    define('OMIE_APP_SECRET',$_POST['OMIE_APP_SECRET']);
    $emp=$empresa->ListarEmpresas($empresas_list_request);
    if(is_object($emp)){
        $nomeEmpresa=$emp->empresas_cadastro[0]->razao_social;
        $cnpj=$emp->empresas_cadastro[0]->cnpj;
    }
    $user->setempresa($nomeEmpresa);
    $user->setcnpj($cnpj);
    $dao->save($user);
?>
<script>window.location.assign("../index.html")</script>