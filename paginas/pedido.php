<meta charset="utf-8" >
<?php
    include '../paginas/janela.php';
    if(file_exists('../dao/CRUD.php')){
        include '../dao/CRUD.php';
    }
    
    @$login=$_COOKIE['login'];
    @$excl=$_GET['excl'];
    @$enviado=$_GET['enviado'];
    @$contaAtualiza=$_GET['contaAtualiza'];
    @$vendedorAtualiza=$_GET['vendedorAtualiza'];
    @$correiosAtualiza=$_GET['$correiosAtualiza'];
    @$etapaAtualiza=$_GET['$etapaAtualiza'];
    @$tabelaPrecoAtualiza=$_GET['$tabelaPrecoAtualiza'];
    @$origem=$_GET['origem'];
    @$funcao=$_COOKIE['funcao'];
    if(@$funcao){
        echo '<script>var funcao="'.$funcao.'"</script>';
    }
    
    if(array_key_exists('razao', $_GET)){
        $razao=$_GET['razao'];
    }else{
        $razao=null;
    }
    if(array_key_exists('codigo_cliente', $_GET)){
        $cCliente=$_GET['codigo_cliente'];
    }else{
        $cCliente=null;
    }
    if(array_key_exists('cnpj_cpf', $_GET)){
        $cnpj_cpf=$_GET['cnpj_cpf'];
    }else{
        $cnpj_cpf=null;
    }
    if(array_key_exists('contato', $_GET)){
        $contato=$_GET['contato'];
    }else{
        $contato=null;
    }
    if(array_key_exists('email', $_GET)){
        $email=$_GET['email'];
    }else{
        $email=null;
    }
    if(array_key_exists('enviado', $_GET)){
        echo '<script>var enviado=1</script>';
    }else{
        echo '<script>var enviado=null</script>';
    }
    if($excl==1){
        print_r($_GET);die;
    }
    if(array_key_exists('act', $_GET)){
        $act=$_GET['act'];
    }else{
       $act=null;
    }
    
    $pedido=new PedidoVendaProdutoJsonClient();
    $cliente=new ClientesCadastroJsonClient();
    
    /*if(@$origem=='cliente'){
        $dao = new CRUD();
        $search=new ModelSearchCriteria();
        $search->settabela('tb_cliente');
        $search->setnome_fantasia($_GET['cnpj_cpf']);
        $dadosLocal=$dao->encontre($search);
        
        $codigo=null;
        $clientes_cadastro_chave=array("codigo_cliente_omie"=>$cCliente,
"codigo_cliente_integracao"=>$codigo);
        $dados=$cliente->ConsultarCliente($clientes_cadastro_chave);

        $model = new Model();
        foreach($dados as $key => $item){
            if($key != 'info' && $key != 'tags'){
                $classe='set'.$key;
                $model->$classe($item);
                //$resultado[]=$model->$classe($item);
            }elseif($key == 'info'){
                foreach($item as $key2 => $item2){
                    $classe='set'.$key2;
                    $model->$classe($item2);
                }
            }elseif($key == 'tags'){
                foreach($item as $item_){
                    $model->settags($item_->tag.',');
                }
            }
        }
        $model->settabela('tb_cliente');
        if($dadosLocal){
            foreach($dadosLocal as $item){
                $alteracao=$item->getdAlt();
                $model->setid($item->getid());
            }
            if($model->getdAlt() > $alteracao){
                $gravado=$dao->grava($model);
            }
        }else{
            $gravado=$dao->grava($model);
        }
    }*/
        
    $pvpListarRequest=array('pagina'=>'1','registros_por_pagina'=>'50');
    if(!isset($quant)){
        $quant=0;
    }
    if(@$_GET['gravado']){
        Flash::addFlash('Registro salvo com sucesso.');
    }
    
////////// Produtos ////////////
   if($act=='excl'){
    /*$produto_servico_cadastro_chave = array("codigo_produto" => $_GET['codigo'], "codigo_cliente_integracao" => "", "codigo" => "");
    $produtos->ExcluirProduto($produto_servico_cadastro_chave);
    header('Location:index.php?pagina=produto&act=list');*/
       die;
   }
   
   ////// Classes //////
   //$contaAtualiza=1;
   if($contaAtualiza==1){
        $contas=new ContaCorrenteCadastroJsonClient();
        $contaListarRequest=array('pagina'=>'1','registros_por_pagina'=>'50');
        $conta=$contas->PesquisarContaCorrente($contaListarRequest)->conta_corrente_lista;
        
        //echo '<pre>';print_r($conta);die;
        //$handle=fopen('../config/conta.ini','a+');
        $variavelConta=array('bol_instr1','bol_sn','cobr_sn','codigo_agencia','codigo_banco','data_alt','data_inc','descricao','dias_rcomp','hora_alt','hora_inc','nCodCC','nao_fluxo','nao_resumo','numero_conta_corrente','pdv_categoria','pdv_cod_adm','pdv_dias_venc','pdv_enviar','pdv_limite_pacelas','pdv_num_parcelas','pdv_sincr_analitica','pdv_taxa_adm','pdv_taxa_loja','pdv_tipo_tef','per_juros','per_multa','saldo_inicial','tipo','tipo_conta_corrente','user_alt','user_inc','valor_limite');
        if(file_exists('../dao/CRUDConta.php')){
            include '../dao/CRUDConta.php';
            $dao3=new CRUDConta();
            $dao3->drop('tb_conta');
        }
        foreach($conta as $item){
            $conta_=new conta();
            //print_r(file_exists('../dao/CRUDConta.php'));die;
            if(!file_exists('../dao/CRUDConta.php')){
                include '../paginas/criaClasses3.php';
                $arquivo=new criaClsses3();
                $arquivo->novoArquivo();
                echo '<script>window.location.assign("index.php?pagina=pedido&act=cad&contaAtualiza=1")</script>';
            }
            foreach($variavelConta as $item2){
                $$item2=$item->$item2;
                $classe='set'.$item2;
                $conta_->$classe($$item2);
            }
            $conta_->setOMIE_APP_KEY(OMIE_APP_KEY);
            $conta_->settabela('tb_conta');
            $dao3->grava5($conta_);
        
            //fwrite($handle,"\n[".OMIE_APP_KEY."]\n nCodCC=".$nCodCC." \n descricao=".$descricao."");
        }
        //fclose($handle);
        echo '<script>window.location.assign("index.php?pagina=pedido&act=cad")</script>';

   }else{
        if(!file_exists('../dao/CRUDConta.php')){
            echo '<script>window.location.assign("index.php?pagina=pedido&act=cad&contaAtualiza=1")</script>';
        }
        $daoConta=new dao();
        $search=new ContaSearchCriteria();
        $search->settabela('tb_conta');
        $search->setOMIE_APP_KEY(OMIE_APP_KEY);
        if(OMIE_APP_KEY=='2769656370'){
            $db='db';
        }elseif(OMIE_APP_KEY=='461893204773'){
            $db='db2';
        }
        if(!$daoConta->showTabela($search->gettabela(),$db)){
            echo '<script>window.location.assign("index.php?pagina=pedido&act=cad&contaAtualiza=1")</script>';
        }
        $conta=$daoConta->encontrePorConta($search);
        $contaTipo=array();
        foreach($conta as $item){
            $contaTipo[$item->getdescricao()]=array($item->getnCodCC(),$item->getpdv_categoria());
        }
        //echo '<pre>';print_r($contaTipo);die;
        
        /*$conta=Config::getConfig2(OMIE_APP_KEY);
        $nCodCC=$conta['nCodCC'];
        $descricao=$conta['descricao'];*/
   }
   if($vendedorAtualiza==1){
        $vendedor=new VendedoresCadastroJsonClient();
        $vendListarRequest=array("pagina"=>"1","registros_por_pagina"=>"50","apenas_importado_api"=>"N");
        $vend=$vendedor->ListarVendedores($vendListarRequest)->cadastro;
        
        $dao2=new CRUD();
        $dao2->drop('tb_vendedor');
        foreach($vend as $item){
            $model=new Model();
            $model->setcodInt($item->codInt);
            $model->setcodigo($item->codigo);
            $model->setcomissao($item->comissao);
            $model->setemail($item->email);
            $model->setfatura_pedido($item->fatura_pedido);
            $model->setinativo($item->inativo);
            $model->setnome($item->nome);
            $model->setvisualiza_pedido($item->visualiza_pedido);
            
            $dao2->grava3($model);
        }
   }else{
        $dao2=new CRUD();
        $search=new ModelSearchCriteria();
        $search->settabela('tb_vendedor');
        if(OMIE_APP_KEY=='2769656370'){
            $db='db';
        }elseif(OMIE_APP_KEY=='461893204773'){
            $db='db2';
        }
        if(!$dao2->showTabela('tb_vendedor',$db)){
           echo '<script>window.location.assign("index.php?index=sim&pagina=pedido&act=cad&vendedorAtualiza=1")</script>'; 
        }
        $vendedores=$dao2->encontrePorVendedor($search);
        $vend=array();
        foreach($vendedores as $item){
            $vendedores=new vendedores();
            $vendedores->codigo=$item->getcodigo();
            $vendedores->nome=$item->getnome();
            $vendedores->comissao=$item->getcomissao();

            if(@$funcao == 'administrador'){
                array_push($vend, $vendedores);
            }else{
                if(strtoupper($login) == strtoupper($item->getnome())){
                    array_push($vend, $vendedores);
                }
            }
        }
   }
   
    $dadosParcelas=array(array('cCodigo'=>'000','cDescricao'=>'A Vista','nQtdeParc'=>'0'),array('cCodigo'=>'001','cDescricao'=>'1 Parcela','nQtdeParc'=>'1'),array('cCodigo'=>'002','cDescricao'=>'2 Parcelas','nQtdeParc'=>'2'),array('cCodigo'=>'003','cDescricao'=>'3 Parcelas','nQtdeParc'=>'3'),array('cCodigo'=>'004','cDescricao'=>'4 Parcelas','nQtdeParc'=>'4'),array('cCodigo'=>'005','cDescricao'=>'5 Parcelas','nQtdeParc'=>'5'),array('cCodigo'=>'006','cDescricao'=>'6 Parcelas','nQtdeParc'=>'6'),array('cCodigo'=>'007','cDescricao'=>'7 Parcelas','nQtdeParc'=>'7'),array('cCodigo'=>'008','cDescricao'=>'8 Parcelas','nQtdeParc'=>'8'),array('cCodigo'=>'009','cDescricao'=>'9 Parcelas','nQtdeParc'=>'9'),array('cCodigo'=>'010','cDescricao'=>'10 Parcelas','nQtdeParc'=>'10'));
    $parcela=array();
    foreach($dadosParcelas as $item){
        $detalheParc=new parcela();
        $detalheParc->cCodigo=$item['cCodigo'];
        $detalheParc->cDescricao=$item['cDescricao'];
        $detalheParc->nQtdeParc=$item['nQtdeParc'];
        array_push($parcela, $detalheParc);
    }
    //$correiosAtualiza=1;
    //if($correiosAtualiza==1){
    $dao = new Dao();
    $search = new ModelSearchCriteria();
    $search->settabela('tb_cliente');
    $search->setrazao_social('correios');
    
    if(OMIE_APP_KEY=='2769656370'){
        $db='db';
    }elseif(OMIE_APP_KEY=='461893204773'){
        $db='db2';
    }
    if($dao2->showTabela('tb_cliente',$db)){
       //echo '<script>window.location.assign("index.php?index=sim&pagina=pedido&act=cad&vendedorAtualiza=1")</script>'; 
        $cliente=$dao->encontre($search);
        foreach($cliente as $item){
            if(stristr($item->getnome_fantasia(),'correios')){
                $correios=$item;
                break;
            }
        }
    }else{
        Flash::addFlash('É necessário atualizar a tabela de Cliente.');
    }
    
        /*$clientes_list_request=array("pagina"=>1,"registros_por_pagina"=>100);
        $clientes=new ClientesCadastroJsonClient();
        $cliente=$clientes->ListarClientes($clientes_list_request)->clientes_cadastro;*/
    /*}else{
        $transportadora_=array('bairro'=>'CIDADE NOVA','cep'=>'20210900','cidade'=>'RIO DE JANEIRO (RJ)','cidade_ibge'=>'3304557','cnae'=>'5310501','cnpj_cpf'=>'34.028.316/0002-94','codigo_cliente_integracao'=>'','codigo_cliente_omie'=>'743699622','codigo_pais'=>'1058','complemento'=>'','endereco'=>'AV PRESIDENTE VARGAS','endereco_numero'=>'3077','estado'=>'RJ','exterior'=>'N','info'=>array('cImpAPI'=>'N','dAlt'=>'18/01/2018','dInc'=>'18/01/2018','hAlt'=>'16:57:03','hInc'=>'16:42:18','uAlt'=>'P000065360'),'uInc'=>'P000065360','inscricao_estadual'=>'','inscricao_municipal'=>'','nome_fantasia'=>'Correios','pessoa_fisica'=>'N','razao_social'=>'EMPRESA BRASILEIRA DE CORREIOS E TELEGRAFOS','tags'=>array('Transportadora',array('tag'=>'Transportadora')),'telefone1_ddd'=>'21','telefone1_numero'=>'2503-8152');
        $correios=new cliente();
        foreach($transportadora_ as $key => $item){
            $correios->$key=$item;
        }
    }*/
    
    //$etapaAtualiza=1;
    if($etapaAtualiza==1){
        $etapas=new EtapasFaturamentoJsonClient();
        $etaproListarRequest=array("pagina"=>1,"registros_por_pagina"=>100);
        $etapa=$etapas->ListarEtapasFaturamento($etaproListarRequest)->cadastros;
        $selEtapa=($etapa[2]->etapas);
    }else{
        $selEtapa_=array(array('cCodigo'=>'00','cDescrPadrao'=>'Proposta','cDescricao'=>'Pedido de Venda'),array('cCodigo'=>'10','cDescrPadrao'=>'Pedido de Venda','cDescricao'=>'Pedido de Venda'),array('cCodigo'=>'20','cDescrPadrao'=>'Separar Estoque','cDescricao'=>'Separar Estoque'),array('cCodigo'=>'50','cDescrPadrao'=>'Faturar','cDescricao'=>'Faturar'),array('cCodigo'=>'60','cDescrPadrao'=>'Faturado','cDescricao'=>'Faturado'),array('cCodigo'=>'70','cDescrPadrao'=>'Entrega','cDescricao'=>'Entrega'),array('cCodigo'=>'80','cDescrPadrao'=>'','cDescricao'=>''));
        $selEtapa=array();
        foreach($selEtapa_ as $item){
                $selEtapa2=new etapas();
            foreach($item as $key => $item2){
                $selEtapa2->$key=$item2;
            }
            array_push($selEtapa, $selEtapa2);
        }
    }
    //$tabelaPrecoAtualiza=1;
    if($tabelaPrecoAtualiza==1){
        $tabPreco=new TabelaPrecosJsonClient();
        $tprListarRequest=array("nPagina"=>1,"nRegPorPagina"=>20);
        $tabelaPreco=$tabPreco->ListarTabelasPreco($tprListarRequest)->listaTabelasPreco;
    }
   
    $form_pag=array('dinheiro'=>'Dinheiro','debito'=>'Cartão de Débito','credito'=>'Cartão de Crédito');
      
   //////// Variáveis ////////  
    $variaveis1=array('tItem'=>'Total de Ítens','mercadorias'=>'Mercadorias','vDesconto'=>'Desconto',/*'ipi'=>'IPI','icmsSt'=>'ICMS ST',*/'vPedido'=>'Valor do Pedido');//valores preenchidos automaticamente
    $variaveis2=array(
                        'Ítens de Venda'=>array(
                            'busca'=>'','nItem'=>'Nº','cProduto'=>'Código','descricao'=>'Descrição do Produto','quantidade'=>'Quantidade','vUnitario'=>'Preço Unitário de Venda','vTotal'=>'Valor Total do Ítem','pDesconto'=>'Desconto',/*'tabelaPreco'=>'Tabela de Preço',*/'obs_item'=>'Observação do Ítem','cfop'=>'CFOP','ncm'=>'NCM','ean'=>'EAN','unidade'=>'Unidade'/*,'loja'=>'Loja de Origem','icms'=>'ICMS','icmsSt'=>'ICMS ST','ipi'=>'IPI','pis'=>'PIS','cofins'=>'COFINS','frete'=>'Frete','seguro'=>'Seguros','oDespesa'=>'Outras Despesas','icmsDesonerado'=>'ICMS Desonerado','gCReceber'=>'Gera Conta a Receber','pLiquido'=>'Peso Líquido(Kg)','pBruto'=>'Peso Bruto(Kg)'*/
                        ),
                        'Frete e Outras Despesas'=>array(
                            'transportadora'=>'Transportadora','tfrete'=>'Tipo do Frete',/*'Placa do Veícula','UF','RNTRC (ANTT)',*/'qvolume'=>'Quantidade de Volumes'/*,'evolume'=>'Espécie dos Volumes','mvolume'=>'Marca dos Volumes','nvolume'=>'Numeração dos Volumes','pliquido'=>'Peso Líquido (Kg)','pbruto'=>'Peso Bruto (Kg)','vfrete'=>'Valor do Frete','vseguro'=>'Valor do Seguro','nlacre'=>'Número do Lacre','odespesas'=>'Outras Despesas Acessórias','O transporte será realizado com veículo próprio'*/
                        ),
                        'Informações Adcionais'=>array(
                            'codigo_categoria'=>'Categoria','codigo_conta_corrente'=>'Conta','etapa'=>'Etapa'/*,'Nº do Pedido do Cliente','Nº do Contrato de Venda','Contato','Projeto'*/,'dados_adcionais_nf'=>'Dados Adicionais para a Nota Fiscal'/*,'Nota Fiscal para Consumo Final'*/
                        ),
                        'Parcelas'=>array(
                            /*'Valor Total a Receber'*/'numero_parcela'=>'Parcela','data_vencimento'=>'Vencimento','valor'=>'Valor da Parcela','percentual'=>'Percentual da Parcela','quantidade_dias'=>'Quantidade dias'/*,'Não gerar boleto desta parcela'*/
                        ),
                        'E-mail para o Cliente'=>array(
                            'Utilizar os seguintes endereço de e-mail'/*,'Enviar o e-mail com o boleto de cobrança gerado pelo faturamento (juntamente com o DANFE e o XML da NFe)'*/
                        ),
                        'Observações'=>array(
                          /*'Preencha aqui as observações desta venda (elas não serão exibidas na Nota Fiscal)'*/  
                        ),
                        'imposto' => array(
                            'cofins_padrao' => array(
                                    'aliq_cofins','base_cofins','cod_sit_trib_cofins','tipo_calculo_cofins','valor_cofins'
                                ),
                            'icms_sn' => array(
                                    'aliq_icms_sn','cod_sit_trib_icms_sn','origem_icms_sn','valor_credito_icms_sn'
                                ),
                            'ipi' => array(
                                    'cod_sit_trib_ipi'
                                ),
                            'pis_padrao' => array(
                                    'aliq_pis','base_pis','cod_sit_trib_pis','tipo_calculo_pis','valor_pis'
                                )
                        )
                    );      
?>