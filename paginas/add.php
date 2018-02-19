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
    }elseif($pagina=='pedido'){
        /*
       
   *****************************************************
         stdClass Object
(
    [cabecalho] => stdClass Object
        (
            [bloqueado] => N
            [codigo_cliente] => 3792227
            [codigo_pedido_integracao] => 1519060633
            [data_previsao] => 19/02/2018
            [etapa] => 50
            [numero_pedido] => 66628
            [quantidade_itens] => 1
        )

    [det] => Array
        (
            [0] => stdClass Object
                (
                    [ide] => stdClass Object
                        (
                            [codigo_item_integracao] => 4422421
                            [simples_nacional] => S
                        )

                    [imposto] => stdClass Object
                        (
                            [cofins_padrao] => stdClass Object
                                (
                                    [aliq_cofins] => 3
                                    [base_cofins] => 400
                                    [cod_sit_trib_cofins] => 01
                                    [tipo_calculo_cofins] => B
                                    [valor_cofins] => 12
                                )

                            [icms_sn] => stdClass Object
                                (
                                    [aliq_icms_sn] => 1.25
                                    [cod_sit_trib_icms_sn] => 101
                                    [origem_icms_sn] => 0
                                    [valor_credito_icms_sn] => 5
                                )

                            [ipi] => stdClass Object
                                (
                                    [cod_sit_trib_ipi] => 51
                                )

                            [pis_padrao] => stdClass Object
                                (
                                    [aliq_pis] => 0.65
                                    [base_pis] => 400
                                    [cod_sit_trib_pis] => 01
                                    [tipo_calculo_pis] => B
                                    [valor_pis] => 2.6
                                )

                        )

                    [inf_adic] => stdClass Object
                        (
                            [peso_bruto] => 150
                            [peso_liquido] => 150
                        )

                    [produto] => stdClass Object
                        (
                            [cfop] => 5.102
                            [codigo_produto] => 4422421
                            [descricao] => Telefone Celular X
                            [ncm] => 9403.30.00
                            [quantidade] => 1
                            [tipo_desconto] => V
                            [unidade] => UN
                            [valor_desconto] => 0
                            [valor_mercadoria] => 200
                            [valor_total] => 200
                            [valor_unitario] => 200
                        )

                )

        )

    [frete] => stdClass Object
        (
            [codigo_transportadora] => 2239663
            [modalidade] => 1
            [placa] => ABC1234
            [placa_estado] => SP
            [valor_frete] => 30
        )

    [informacoes_adicionais] => stdClass Object
        (
            [codigo_categoria] => 1.01.03
            [codigo_conta_corrente] => 11850365
            [consumidor_final] => S
            [enviar_email] => N
        )

    [lista_parcelas] => stdClass Object
        (
            [parcela] => Array
                (
                    [0] => stdClass Object
                        (
                            [data_vencimento] => 20/02/2018
                            [numero_parcela] => 1
                            [percentual] => 50
                            [valor] => 100
                        )

                    [1] => stdClass Object
                        (
                            [data_vencimento] => 18/05/2018
                            [numero_parcela] => 2
                            [percentual] => 50
                            [valor] => 100
                        )

                )

        )

    [total_pedido] => stdClass Object
        (
            [base_calculo_icms] => 200
            [valor_mercadorias] => 200
            [valor_total_pedido] => 200
        )

)
         ********************************************       
          
         
         * 
         * 
            $dados_pedido = array(
                        'cabecalho'=>array(
                            'bloqueado'=>'N',
                            'codigo_cliente'=>$_POST['codigo_cliente'],
                            'codigo_pedido_integracao'=>$_POST['codigo_pedido_integracao'],
                            'data_previsao'=>$_POST['previsao'],
                            'etapa'=>'10',
                            'numero_pedido'=>$_POST['numero_pedido'],
                            'quantidade_itens'=>$_POST['quantidade_itens']
                        ),
                        'det'=>array(
                            'ide'=>array(
                                'codigo_item_integracao'=>$_POST['codigo_item_integracao'],
                                'simples_nacional'=>$_POST['simples_nacional']
                            ),
                            'produto'=>array(
                                'cfop'=>'',
                                'codigo_produto'=>$_POST['codigo_produto'],
                                'descricao'=>$_POST['descricao'],
                                'ncm'=>$_POST['ncm'],
                                'quantidade'=>$_POST['quantidade'],
                                'tipo_desconto'=>'P',
                                'unidade'=>'UN',
                                'valor_desconto'=>$_POST['valor_desconto'],
                                'valor_mercadoria'=>$_POST['valor_mercadoria'],
                                'valor_total'=>$_POST['valor_total'],
                                'valor_unitario'=>$_POST['valor_unitario']
                            )
                        ),
                        'frete'=>array(
                            'codigo_transportadora'=>$_POST['codigo_transportadora'],
                            'modalidade'=>$_POST['modalidade'],
                            'placa'=>$_POST['placa'],
                            'placa_estado'=>$_POAT['placa_estado'],
                            'valor_frete'=>$_POST['valor_frete']
                        ),
                        'informacoes_adicionais'=>array(
                            
                        ),
                        'lista_parcelas'=>array(
                            'parcela'=>array(
                                array(
                                    'data_vencimento'=>$_POST['data_vencimento'],
                                    'numero_parcela'=>$_POST['numero_parcela'],
                                    'percentual'=>$_POST['percentual'],
                                    'valor'=>$_POST['valor']
                                ),
                                array(
                                    'data_vencimento'=>$_POST['data_vencimento'],
                                    'numero_parcela'=>$_POST['numero_parcela'],
                                    'percentual'=>$_POST['percentual'],
                                    'valor'=>$_POST['valor']
                                )
                            )
                        ),
                        'total_pedido'=>array(
                            'base_calculo_icms'=>$_POST['base_calculo_icms'],
                            'valor_mercadorias'=>$_POST['valor_mercadorias'],
                            'valor_total_pedido'=>$_POST['valor_total_pedido']
                        )
                    );
         */
        echo '<pre>';
 print_r(json_decode('{"cabecalho": {"bloqueado": "N","codigo_cliente": 3792227,"codigo_pedido_integracao": "1519060633","data_previsao": "19/02/2018","etapa": "50","numero_pedido": "66628","quantidade_itens": 1},"det": [{"ide": {"codigo_item_integracao": "4422421","simples_nacional": "S"},"imposto": {"cofins_padrao": {"aliq_cofins": 3,"base_cofins": 400,"cod_sit_trib_cofins": "01","tipo_calculo_cofins": "B","valor_cofins": 12},"icms_sn": {"aliq_icms_sn": 1.25,"cod_sit_trib_icms_sn": 101,"origem_icms_sn": 0,"valor_credito_icms_sn": 5},"ipi": {"cod_sit_trib_ipi": 51},"pis_padrao": {"aliq_pis": 0.65,"base_pis": 400,"cod_sit_trib_pis": "01","tipo_calculo_pis": "B","valor_pis": 2.6}},"inf_adic": {"peso_bruto": 150,"peso_liquido": 150},"produto": {"cfop": "5.102","codigo_produto": "4422421","descricao": "Telefone Celular X","ncm": "9403.30.00","quantidade": 1,"tipo_desconto": "V","unidade": "UN","valor_desconto": 0,"valor_mercadoria": 200,"valor_total": 200,"valor_unitario": 200}}],"frete": {"codigo_transportadora": 2239663,"modalidade": "1","placa": "ABC1234","placa_estado": "SP","valor_frete": 30},"informacoes_adicionais": {"codigo_categoria": "1.01.03","codigo_conta_corrente": 11850365,"consumidor_final": "S","enviar_email": "N"},"lista_parcelas": {"parcela": [{"data_vencimento": "20/02/2018","numero_parcela": 1,"percentual": 50,"valor": 100},{"data_vencimento": "18/05/2018","numero_parcela": 2,"percentual": 50,"valor": 100}]},"total_pedido": {"base_calculo_icms": 200,"valor_mercadorias": 200,"valor_total_pedido": 200}}'));
 
         
        /*    stdClass Object ( 
        [cabecalho] => stdClass Object ( 
            [bloqueado] => N [codigo_cliente] => 3792227 [codigo_pedido_integracao] => 1518658537 [data_previsao] => 14/02/2018 [etapa] => 50 [numero_pedido] => 68319 [quantidade_itens] => 1 
                                        ) */
        echo '<pre>';
        print_r($_POST);die;
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