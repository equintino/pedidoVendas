<meta charset='utf-8'>
<script>
    function removeVirgula(str){
        if(str.charAt(str.length-3)!='.'){
            str=str.replace('.','');
        }
        if(str.charAt(str.length-3)==','){
            str=str.replace(',','.');
        }
        return str.toFixed('2');
    }
</script>
<?php
    $act=$_GET['act'];
    @$pagina=$_GET['pagina'];
    
    if($act=='atualiza'){
        include 'criaClasses.php';
    
        /// Cria classes se não existir ///
        if(file_exists('../model/model.php')&&file_exists('../dao/ModelSearchCriteria.php')&&file_exists('../dao/CRUD.php')&&file_exists('../mapping/modelMapper.php')){
        
            include '../config/Config.php';
            include '../excecao/Excecao.php';
            include '../dao/ModelSearchCriteria.php';
            include '../model/model.php';
            include '../mapping/modelMapper.php';
            include '../dao/dao.php';
            include '../dao/CRUD.php';

            $model = new Model();
            $CRUD = new CRUD();


            foreach($_POST as $key => $item){
                $classe='set'.$key;
                $model->$classe($item);
            }


            $model->settabela('tb_cliente');

            echo '<pre>';print_r($model);die;

            //$x=1;
            //foreach($model as $item){
                //echo $model;
                //$x++;
            //}
                //echo $x;
            //die;
            $CRUD->grava($model);
            //Utils::redirect('cadastro',array('act'=>'cad','gravado'=>'ok')); 
        }else{
            $arquivo = new criaClsses();
            $arquivo->tabela='tb_cliente';
            $arquivo->novoArquivo($_POST);
        }
        echo '<pre>';
        $model = new Model();

        /*$result = array();
        foreach ($_POST as $row){
            $model = new Model();
            modelMapper::map($model, $row);
            $result[$model->getid()] = $model;
        }*/
        print_r($model);
        //print_r(count($_POST));
        //$CRUD->criaTabela();
        die;
    }
    if($pagina=='cliente'){
        include '../model/ClientesCadastroJsonClient.php';
        $cliente=new ClientesCadastroJsonClient();
        if($act=='alt'){         
            //Array ( [codigo_pais][tipo_atividade] => [cnae] => [produtor_rural] => [contribuinte] => [exterior][recomendacao_atraso] => [tags]  [logradouro] => [importado_api] => [bloqueado] => [cidade_ibge] => )
            $clientes_cadastro=array("codigo_cliente_omie"=>$_POST['codigo_cliente_omie'],"codigo_cliente_integracao"=>$_POST['codigo_cliente_integracao'],"email"=>$_POST['email'],"razao_social"=>$_POST['razao_social'],"nome_fantasia"=>$_POST['nome_fantasia'],"cnpj_cpf"=>$_POST['cnpj_cpf'],"telefone1_ddd"=>$_POST['telefone1_ddd'],"telefone1_numero"=>$_POST['telefone1_numero'],"contato"=>$_POST['contato'],"endereco"=>$_POST['endereco'],"endereco_numero"=>$_POST['endereco_numero'],"bairro"=>$_POST['bairro'],"complemento"=>$_POST['complemento'],"estado"=>$_POST['estado'],"cidade"=>$_POST['cidade'],"cep"=>$_POST['cep'],"telefone2_ddd"=>$_POST['telefone2_ddd'],"telefone2_numero"=>$_POST['telefone2_numero'],"fax_ddd"=>$_POST['fax_ddd'],"fax_numero"=>$_POST['fax_numero'],"homepage"=>$_POST['homepage'],"inscricao_estadual"=>$_POST['inscricao_estadual'],"inscricao_municipal"=>$_POST['inscricao_municipal'],"inscricao_suframa"=>$_POST['inscricao_suframa'],"optante_simples_nacional"=>$_POST['optante_simples_nacional'],"observacao"=>$_POST['observacao'],"pessoa_fisica"=>$_POST['pessoa_fisica']);

            $status=@$cliente->AlterarCliente($clientes_cadastro);
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
            //$produto_servico_cadastro=array("codigo_produto_integracao" => "15185297955","codigo_produto"=>"","descricao" => "Produto de teste","unidade" => "UN","ncm" => '9504.10.99',"valor_unitario"=>"100.99");
            if($status=$produto->IncluirProduto($produto_servico_cadastro)){
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
        include '../validacao/ModelValidador.php';
        // Obtêm o número do pedido Atual
        $numero_pedido_atual = file_get_contents('numeroPedido.txt');
        // Atualiza número do Pedido e salva no arquivo
        file_put_contents('numeroPedido.txt', ++$numero_pedido_atual);
        // Mostra o número de visitas
        $codigo_pedido_integracao=file_get_contents('numeroPedido.txt');
        
        include '../config/OmieAppAuth.php';
        include '../model/PedidoVendaProdutoJsonClient.php';
        $pedido=new PedidoVendaProdutoJsonClient();
        
        $parcela='000';
        
            /*
            [codigo_cliente_integracao] => 
            [codigo_empresa] => 740225718
            [codigo_empresa_integracao] => 
            [codigo_pedido] => 742241154
            [importado_api] => */
        
        ///// cabecalho /////
        $cabecalho=new cabecalho();
        $cabecalho->bloqueado='N';
        $cabecalho->codigo_cliente=$_POST['cCliente'];
        $cabecalho->codigo_parcela=$parcela;
        $cabecalho->codigo_pedido_integracao=$codigo_pedido_integracao;
        $cabecalho->data_previsao=$_POST['dPrevisao'];
        $cabecalho->etapa=$_POST['etapa'];
        $cabecalho->importado_api='S';
        $cabecalho->numero_pedido='';
        $cabecalho->qtde_parcelas=0;
        $cabecalho->quantidade_itens=$_POST['tItem'];
                
        $det=array();
        for($x=1;$x <= $_POST['tItem'];$x++){
            $ide=new ide();
            $observacao=new observacao();
            $produto=new produto();
            $inf_adic=new inf_adic();
        
            array_push($det,array('ide'=>$ide,'observacao'=>$observacao,'produto'=>$produto,'inf_adic'=>$inf_adic));
            $ide->codigo_item='';
            $ide->codigo_item_integracao=$_POST['codigo_produto'.$x.''];

            //$observacao->obs_item=$_POST['obs_item'.$x.''];//.','.$_POST['obs_item'.$x.''];
        
        
        /*
        [cfop] => 5.405
        [codigo] => 783
        [codigo_tabela_preco] => 742240473
        [ean] => 7898930919331
        [ncm] => 8528.52.20
        [unidade] => PC
        [valor_deducao] => 0
        
         */        
        
        
            ///// produto //////
            $produto->codigo_produto=$_POST['codigo_produto'.$x.''];
            $produto->descricao=$_POST['descricao'.$x.''];
            $produto->quantidade=$_POST['quantidade'.$x.''];
            $produto->tipo_desconto='P';
            $produto->valor_mercadoria=ModelValidador::removePonto($_POST['vTotalItem'.$x.'']);
            $produto->valor_unitario=ModelValidador::removePonto($_POST['vUnitarioItem'.$x.'']);
            $produto->codigo_produto_integracao=$_POST['codigo_produto'.$x.''];
            $produto->codigo='';
            $produto->cfop=$_POST['cfop'];
            $produto->ean=$_POST['ean'];
            $produto->ncm=$_POST['ncm'];
            $produto->unidade=$_POST['unidade'];
            $produto->percentual_desconto=$_POST['pDescontoItem'.$x.''];
            //$produto->codigo_tabela_preco=$_POST['cCodIntTabPreco'.$x.''];
            
            $inf_adic->dados_adicionais_item=$_POST['obs_item'.$x.''];
            
                
            /// calculando ///
            @$vDescontoItem=ModelValidador::removePonto($_POST['vTotalItem'.$x.''])*$_POST['pDescontoItem'.$x.'']/100;
            $vTotal=ModelValidador::removePonto($_POST['vTotalItem'.$x.''])-$vDescontoItem;
            $produto->valor_desconto=$vDescontoItem;
            $produto->valor_total=$vTotal;
        }
        
        //// Observação ////
        ///????? $observacao=new observacao();
        ///????? $observacao->obs_item=$_POST['observacao'];
        
        //// Imposto ////
        /*
        $imposto=new imposto();
        $imposto->icms_sn=$_POST['icmsSn'];
        $imposto->icms=$_POST['icms'];
        $imposto->icms_st=$_POST['icmsSt'];
        $imposto->icms_ie=$_POST['icmsIe'];
        $imposto->ipi=$_POST['ipi'];
        $imposto->pis_padrao=$_POST['pisPadrao'];
        $imposto->pis_st=$_POST['pisSt'];
        $imposto->cofins_padrao=$_POST['cofinsPadrao'];
        $imposto->cofins_st=$_POST['cofinsSt'];
        $imposto->inss=$_POST['inss'];
        $imposto->csll=$_POST['csll'];
        $imposto->irrf=$_POST['irrf'];
        $imposto->iss=$_POST['iss'];
        */
        
        /*
            [especie_volumes] => 
            [marca_volumes] => 
            [modalidade] => 9
            [numeracao_volumes] =>                                                        
            [numero_lacre] => 
            [outras_despesas] => 0
            [peso_bruto] => 0
            [peso_liquido] => 0
            [placa] => 
            [placa_estado] => 
            [registro_transportador] => 
            [valor_frete] => 0
            [valor_seguro] => 0
            [veiculo_proprio] => 
        */
        
        
        //// Frete ////
        $frete=new frete();
        $frete->codigo_transportadora=$_POST['codigo_transportadora'];
        $frete->codigo_transportadora_integracao;
        $frete->quantidade_volumes=$_POST['qvolume'];
        $frete->modalidade=substr($_POST['tfrete'],0,1);
        
        
        
        /*
        [codProj] => 0
            [codVend] => 742241153
            [consumidor_final] => N
            [contato] => 
            [dados_adicionais_nf] => 
            [enviar_email] => 
            [numero_contrato] => 
            [numero_pedido_cliente] => 
            [utilizar_emails] => 
         * 
         */
        
        
        //// Informacoes Adcionais //////
        //$_POST['codigo_categoria']="1.01.03";
        //$_POST['codigo_conta_corrente']=740899824;//1229930303;
        $informacoes_adicionais=new informacoes_adicionais();
        $informacoes_adicionais->codigo_categoria=$_POST['codigo_categoria'];
        $informacoes_adicionais->codigo_conta_corrente=$_POST['codigo_conta_corrente'];
        $informacoes_adicionais->consumidor_final='S';
        $informacoes_adicionais->enviar_email='N';
        $informacoes_adicionais->codVend=$_POST['cod_vend'];
        $informacoes_adicionais->dados_adicionais_nf=$_POST['dados_adcionais_nf'];
        $informacoes_adicionais->utilizar_emails=$_POST['e-mail'];
        
        //// Total Pedido ////
        $tPedido=new total_pedido();
        
               // echo '<pre>';
        //print_r([$cabecalho,$det,$produto,$observacao]);die;
        
        $pedido_venda_produto=new pedido_venda_produto();
        $pedido_venda_produto->cabecalho=$cabecalho;
        $pedido_venda_produto->det=$det;
        $pedido_venda_produto->frete=$frete;
        $pedido_venda_produto->informacoes_adicionais=$informacoes_adicionais;
        $pedido_venda_produto->observacoes=$observacao;
        
        //echo '<pre>';print_r([$_POST,$pedido_venda_produto]);die;
        include 'imprime.php';
        $pedido->IncluirPedido($pedido_venda_produto);
        //header('Location:../web/index.php?pagina=pedido&act=cad');
        die;
        /*
    
         * ***********************************
         * Dados do Produto                  *
         *                                   *
         *************************************
         
         Array
(
    [aliquota_cofins] => 0
    [aliquota_ibpt] => 0
    [aliquota_icms] => 0
    [aliquota_pis] => 0
    [bloqueado] => N
    [cest] => 
    [cfop] => 
    [codInt_familia] => 
    [codigo] => 1000
    [codigo_familia] => 0
    [codigo_produto] => 1229930876
    [codigo_produto_integracao] => 
    [csosn_icms] => 
    [cst_cofins] => 
    [cst_icms] => 
    [cst_pis] => 
    [dadosIbpt] => stdClass Object
        (
            [aliqEstadual] => 0
            [aliqFederal] => 0
            [aliqMunicipal] => 0
            [chave] => 
            [fonte] => 
            [valido_ate] => 
            [valido_de] => 
            [versao] => 
        )

    [descr_detalhada] => 
    [descricao] => Mouse sem fio Microsoft
    [descricao_familia] => 
    [ean] => 
    [estoque_minimo] => 10
    [importado_api] => N
    [inativo] => N
    [ncm] => 9504.10.99
    [obs_internas] => 
    [peso_bruto] => 0
    [peso_liq] => 0
    [quantidade_estoque] => 10
    [recomendacoes_fiscais] => stdClass Object
        (
            [cupom_fiscal] => N
            [id_cest] => 
            [id_preco_tabelado] => 0
            [origem_mercadoria] => 
        )

    [red_base_icms] => 0
    [tipoItem] => 00
    [unidade] => UN
    [valor_unitario] => 150
)        
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
         
        echo '<pre>';
 print_r(json_decode('{"cabecalho": {"bloqueado": "N","codigo_cliente": 3792227,"codigo_pedido_integracao": "1519060633","data_previsao": "19/02/2018","etapa": "50","numero_pedido": "66628","quantidade_itens": 1},"det": [{"ide": {"codigo_item_integracao": "4422421","simples_nacional": "S"},"imposto": {"cofins_padrao": {"aliq_cofins": 3,"base_cofins": 400,"cod_sit_trib_cofins": "01","tipo_calculo_cofins": "B","valor_cofins": 12},"icms_sn": {"aliq_icms_sn": 1.25,"cod_sit_trib_icms_sn": 101,"origem_icms_sn": 0,"valor_credito_icms_sn": 5},"ipi": {"cod_sit_trib_ipi": 51},"pis_padrao": {"aliq_pis": 0.65,"base_pis": 400,"cod_sit_trib_pis": "01","tipo_calculo_pis": "B","valor_pis": 2.6}},"inf_adic": {"peso_bruto": 150,"peso_liquido": 150},"produto": {"cfop": "5.102","codigo_produto": "4422421","descricao": "Telefone Celular X","ncm": "9403.30.00","quantidade": 1,"tipo_desconto": "V","unidade": "UN","valor_desconto": 0,"valor_mercadoria": 200,"valor_total": 200,"valor_unitario": 200}}],"frete": {"codigo_transportadora": 2239663,"modalidade": "1","placa": "ABC1234","placa_estado": "SP","valor_frete": 30},"informacoes_adicionais": {"codigo_categoria": "1.01.03","codigo_conta_corrente": 11850365,"consumidor_final": "S","enviar_email": "N"},"lista_parcelas": {"parcela": [{"data_vencimento": "20/02/2018","numero_parcela": 1,"percentual": 50,"valor": 100},{"data_vencimento": "18/05/2018","numero_parcela": 2,"percentual": 50,"valor": 100}]},"total_pedido": {"base_calculo_icms": 200,"valor_mercadorias": 200,"valor_total_pedido": 200}}'));
 */
         
        /*    stdClass Object ( 
        [cabecalho] => stdClass Object ( 
            [bloqueado] => N [codigo_cliente] => 3792227 [codigo_pedido_integracao] => 1518658537 [data_previsao] => 14/02/2018 [etapa] => 50 [numero_pedido] => 68319 [quantidade_itens] => 1 
                                        ) */
        //echo '<pre>';
        //print_r($_POST);
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