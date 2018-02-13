<meta charset='utf-8'>
<?php
    $act=$_GET['act'];
    @$pagina=$_GET['pagina'];
    
    if($pagina=='cliente'){
        include '../model/ClientesCadastroJsonClient.php';
        $cliente=new ClientesCadastroJsonClient();
        if($act=='alt'){         
            //Array ( [codigo_pais][tipo_atividade] => [cnae] => [produtor_rural] => [contribuinte] => [exterior][recomendacao_atraso] => [tags]  [logradouro] => [importado_api] => [bloqueado] => [cidade_ibge] => )
            $clientes_cadastro=array("codigo_cliente_omie"=>$_POST['codigo_cliente_omie'],"codigo_cliente_integracao"=>$_POST['codigo_cliente_integracao'],"email"=>$_POST['email'],"razao_social"=>$_POST['razao_social'],"nome_fantasia"=>$_POST['nome_fantasia'],"cnpj_cpf"=>$_POST['cnpj_cpf'],"telefone1_ddd"=>$_POST['telefone1_ddd'],"telefone1_numero"=>$_POST['telefone1_numero'],"contato"=>$_POST['contato'],"endereco"=>$_POST['endereco'],"endereco_numero"=>$_POST['endereco_numero'],"bairro"=>$_POST['bairro'],"complemento"=>$_POST['complemento'],"estado"=>$_POST['estado'],"cidade"=>$_POST['cidade'],"cep"=>$_POST['cep'],"telefone2_ddd"=>$_POST['telefone2_ddd'],"telefone2_numero"=>$_POST['telefone2_numero'],"fax_ddd"=>$_POST['fax_ddd'],"fax_numero"=>$_POST['fax_numero'],"homepage"=>$_POST['homepage'],"inscricao_estadual"=>$_POST['inscricao_estadual'],"inscricao_municipal"=>$_POST['inscricao_municipal'],"inscricao_suframa"=>$_POST['inscricao_suframa'],"optante_simples_nacional"=>$_POST['optante_simples_nacional'],"observacao"=>$_POST['observacao'],"pessoa_fisica"=>$_POST['pessoa_fisica']);

            $status=@$cliente->AlterarCliente($clientes_cadastro);
            //print_r($status);die;
            if(@$status->descricao_status!='Cliente alterado com sucesso!'){
                echo "Não foi possível fazer a última alteração.";
                echo '<br>';
                echo '<button onclick=history.go(-1)>Voltar</button>';
                die;
            }
            header('Location:../web/index.php?pagina=cliente&act=list');
            die;
        }elseif($act=='cad'){
            $clientes_cadastro=$_POST;
            $status=@$cliente->IncluirCliente($clientes_cadastro);
            if(@$status->descricao_status!='Cliente cadastrado com sucesso!'){
                echo "Não foi possível incluir cadastro.";
                echo '<br>';
                echo '<button onclick=history.go(-1)>Voltar</button>';
                die;
            }
            header('Location:../web/index.php?pagina=cliente&act=cad');
            die;
        }
    }elseif($pagina=='produto'){
        include '../model/ProdutosCadastroJsonClient.php';
        $produto=new ProdutosCadastroJsonClient();
        if($act=='alt'){
            foreach($_POST as $key => $item){
                $produto_servico_cadastro=$_POST;
            }
            $status=$produto->AlterarProduto($produto_servico_cadastro);
            if(@$status->descricao_status!='Dados do produto alterados com sucesso!'){
                    echo "Não foi possível efetuar a alteração.";
                    echo '<br>';
                    echo '<button onclick=history.go(-1)>Voltar</button>';
                    die;
                }
                header('Location:../web/index.php?pagina=produto&act=list');
                die;
        }elseif($act=='cad'){
            $produto_servico_cadastro=$_POST;
            //[{%22codigo_produto_integracao%22:%22123456%22,%22codigo_produto%22:%22%22,%22descricao%22:%22Produto%20de%20teste%22,%22unidade%22:%22UN%22,%22ncm%22:%229504.10.99%22,%22valor_unitario%22:%22100.99%22}],%22app_key%22:%223303943460%22,%22app_secret%22:%228edb08391b6af27936d3daf0ca8aa07d%22}
            //[descricao_status] => Produto cadastrado com sucesso! )
            //print_r($_POST);echo '<br>';
            //$produto_servico_cadastro=array("codigo_produto_integracao" => "15185297955","codigo_produto"=>"","descricao" => "Produto de teste","unidade" => "UN","ncm" => '9504.10.99',"valor_unitario"=>"100.99");
            if($status=$produto->IncluirProduto($produto_servico_cadastro)){
            //print_r($status);die;
            //if($status==null)$status->descricao_status=0;
            if($status->descricao_status!='Produto cadastrado com sucesso!'){
                echo "Não foi possível efetuar o cadastro.";
                echo '<br>';
                echo '<button onclick=history.go(-1)>Voltar</button>';
                die;
            }
                header('Location:../web/index.php?pagina=produto&act=cad');
                die;
            }else{
                echo "Não foi possível efetuar o cadastro.";
                echo '<br>';
                echo '<button onclick=history.go(-1)>Voltar</button>';
                die;
            }
        }
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