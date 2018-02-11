<meta charset='utf-8'>
<?php
    $act=$_GET['act'];
    if($act=='alt'){ 
        include '../model/ClientesCadastroJsonClient.php';
        $cliente=new ClientesCadastroJsonClient();
        
        //Array ( [codigo_pais][tipo_atividade] => [cnae] => [produtor_rural] => [contribuinte] => [exterior][recomendacao_atraso] => [tags]  [logradouro] => [importado_api] => [bloqueado] => [cidade_ibge] => )
        $clientes_cadastro=array("codigo_cliente_omie"=>$_POST['codigo_cliente_omie'],"codigo_cliente_integracao"=>$_POST['codigo_cliente_integracao'],"email"=>$_POST['email'],"razao_social"=>$_POST['razao_social'],"nome_fantasia"=>$_POST['nome_fantasia'],"cnpj_cpf"=>$_POST['cnpj_cpf'],"telefone1_ddd"=>$_POST['telefone1_ddd'],"telefone1_numero"=>$_POST['telefone1_numero'],"contato"=>$_POST['contato'],"endereco"=>$_POST['endereco'],"endereco_numero"=>$_POST['endereco_numero'],"bairro"=>$_POST['bairro'],"complemento"=>$_POST['complemento'],"estado"=>$_POST['estado'],"cidade"=>$_POST['cidade'],"cep"=>$_POST['cep'],"telefone2_ddd"=>$_POST['telefone2_ddd'],"telefone2_numero"=>$_POST['telefone2_numero'],"fax_ddd"=>$_POST['fax_ddd'],"fax_numero"=>$_POST['fax_numero'],"homepage"=>$_POST['homepage'],"inscricao_estadual"=>$_POST['inscricao_estadual'],"inscricao_municipal"=>$_POST['inscricao_municipal'],"inscricao_suframa"=>$_POST['inscricao_suframa'],"optante_simples_nacional"=>$_POST['optante_simples_nacional'],"observacao"=>$_POST['observacao'],"pessoa_fisica"=>$_POST['pessoa_fisica']);
        
        $status=$cliente->AlterarCliente($clientes_cadastro);
        if($status->descricao_status!='Cliente alterado com sucesso!')die;
        header('Location:../web/index.php?pagina=cliente&act=list');
        die;
    }
    include '../dao/dao.php';
    include '../flash/Flash.php';
    include '../util/Utils.php';
    include 'criaClasses.php';
    $estrututa = array('../model/model.php');
    
    if(file_exists('../model/model.php')&&file_exists('../dao/ModelSearchCriteria.php')&&file_exists('../dao/CRUD.php')){
        include '../model/model.php';
        include '../dao/ModelSearchCriteria.php';
        include '../config/Config.php';
        include '../excecao/Excecao.php';
        include '../dao/CRUD.php';
        $model = new Model();
        $CRUD = new CRUD();
        foreach($_POST as $key => $item){
            $classe='set'.$key;
            $model->$classe($item);
        }
        $model->settabela('tb_estoque');
        $CRUD->grava($model);
        Utils::redirect('cadastro',array('act'=>'cad','gravado'=>'ok'));        
    }else{
        $arquivo = new criaClsses();
        $arquivo->novoArquivo($_POST);
    }
    //$flash=new Flash();
        //Flash::addFlash('RNC salvo com sucesso.');
    //print_r((Flash::addFlash("Estou aqui")));
?>