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
    @$transpSelecionada=$_GET['transpSelecionada'];
    if(!@$transpSelecionada){
        $transpSelecionada=null;
    }
        
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
   
        
    $pvpListarRequest=array('pagina'=>'1','registros_por_pagina'=>'50');
    if(!isset($quant)){
        $quant=0;
    }
    if(@$_GET['gravado']){
        Flash::addFlash('Registro salvo com sucesso.');
    }
       
   ////// Classes //////
   if($contaAtualiza==1){
        $contas=new ContaCorrenteCadastroJsonClient();
        $contaListarRequest=array('pagina'=>'1','registros_por_pagina'=>'50');
        $conta=$contas->PesquisarContaCorrente($contaListarRequest)->conta_corrente_lista;
        
        //$handle=fopen('../config/conta.ini','a+');
        $variavelConta=array('bol_instr1','bol_sn','cobr_sn','codigo_agencia','codigo_banco','data_alt','data_inc','descricao','dias_rcomp','hora_alt','hora_inc','nCodCC','nao_fluxo','nao_resumo','numero_conta_corrente','pdv_categoria','pdv_cod_adm','pdv_dias_venc','pdv_enviar','pdv_limite_pacelas','pdv_num_parcelas','pdv_sincr_analitica','pdv_taxa_adm','pdv_taxa_loja','pdv_tipo_tef','per_juros','per_multa','saldo_inicial','tipo','tipo_conta_corrente','user_alt','user_inc','valor_limite');
        if(file_exists('../dao/CRUDConta.php')){
            include '../dao/CRUDConta.php';
            $dao3=new CRUDConta();
            $dao3->drop('tb_conta');
        }
        foreach($conta as $item){
            $conta_=new conta();
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
        
        }
        //fclose($handle);
        echo '<script>window.location.assign("index.php?pagina=pedido&act=cad")</script>';

   }else{
        if(!file_exists('../dao/CRUDConta.php')){
            echo '<script>window.location.assign("index.php?pagina=pedido&act=cad&contaAtualiza=1")</script>';
        }
        if(file_exists('../dao/CRUD.php')){
            $daoConta=new dao();
            $search=new ContaSearchCriteria();
            $search->settabela('tb_conta');
            $search->setOMIE_APP_KEY(OMIE_APP_KEY);
            if(OMIE_APP_KEY=='2769656370'){
                $db='db';
            }elseif(OMIE_APP_KEY=='461893204773'){
                $db='db2';
            }else{
                $db='db3';
            }
            if(!$daoConta->showTabela($search->gettabela(),$db)){
                echo '<script>window.location.assign("index.php?pagina=pedido&act=cad&contaAtualiza=1")</script>';
            }
            $conta=$daoConta->encontrePorConta($search);
            $contaTipo=array();
            foreach($conta as $item){
                $contaTipo[$item->getdescricao()]=array($item->getnCodCC(),$item->getpdv_categoria());
            }
        }
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
        if(file_exists('../dao/CRUD.php')){
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
    
    $file='../paginas/transp'.OMIE_APP_KEY.'.txt';
    if(file_exists($file)){
        $transpSelecionada=file($file)[0];
    }
    if(@!$transpSelecionada){
        $transpSelecionada=null;
    }elseif($funcao=='administrador' && array_key_exists('transpSelecionada',$_GET)){
        @$transpSelecionada=$_GET['transpSelecionada']; 
        $handle=fopen($file,'w+');
        fwrite($handle, $transpSelecionada);
        fclose($handle);
    }
    
    $dao = new Dao();
    $search = new ModelSearchCriteria();
    $search->settabela('tb_cliente');
    $tags=array('Transportadora');
    $search->settags($tags);
    
    if(OMIE_APP_KEY=='2769656370'){
        $db='db';
    }elseif(OMIE_APP_KEY=='461893204773'){
        $db='db2';
    }
    if($dao2->showTabela('tb_cliente',$db)){
        $cliente=$dao->encontrePorTag($search);
        $transpSelecao=array();
        $listaCliente=array();
        foreach($cliente as $item){
            $transpSelecao[$item->getcodigo_cliente_omie()]=array($item->getnome_fantasia(),$item->getcidade());
            if(stristr($item->getnome_fantasia(),'correios')){
                $correios_=$item;
            }
            if($transpSelecionada==$item->getcodigo_cliente_omie()){
                $correios=$item;
                if($funcao!='administrador'){
                    break;
                }
            }
        }
        if(@!$correios){
            $correios=$correios_;
        }
    }else{
        Flash::addFlash('É necessário atualizar a tabela de Cliente.');
    }
    
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
    if($tabelaPrecoAtualiza==1){
        $tabPreco=new TabelaPrecosJsonClient();
        $tprListarRequest=array("nPagina"=>1,"nRegPorPagina"=>20);
        $tabelaPreco=$tabPreco->ListarTabelasPreco($tprListarRequest)->listaTabelasPreco;
    }
   
    $form_pag=array('dinheiro'=>'Dinheiro','debito'=>'Cartão de Débito','credito'=>'Cartão de Crédito');
    
    if(OMIE_APP_KEY=='461893204773'){
        $loja='1000';/*CACHAMBI*/
    }elseif(OMIE_APP_KEY=='2769656370'){
        $loja='2000';/*BONSUCESSO*/
    }else{
        $loja='3000';/*OUTRA*/ 
    }
        
    $numero_pedido_atual = file_get_contents('../paginas/'.$loja.'numeroPedido.txt');
      
   //////// Variáveis //////// 
    $variaveis1=array('tItem'=>'Total de Ítens','mercadorias'=>'Mercadorias','vDesconto'=>'Desconto','vPedido'=>'Valor do Pedido');
    $variaveis2=array(
                        'Ítens de Venda'=>array(
                            'busca'=>'','nItem'=>'Nº','cProduto'=>'Código','descricao'=>'Descrição do Produto','quantidade'=>'Quantidade','vUnitario'=>'Preço Unitário de Venda','vTotal'=>'Valor Total do Ítem','pDesconto'=>'Desconto','obs_item'=>'Observação do Ítem','cfop'=>'CFOP','ncm'=>'NCM','ean'=>'EAN','unidade'=>'Unidade'
                        ),
                        'Frete e Outras Despesas'=>array(
                            'transportadora'=>'Transportadora','tfrete'=>'Tipo do Frete','qvolume'=>'Quantidade de Volumes'
                        ),
                        'Informações Adcionais'=>array(
                            'codigo_categoria'=>'Categoria','codigo_conta_corrente'=>'Conta','etapa'=>'Etapa','dados_adcionais_nf'=>'Dados Adicionais para a Nota Fiscal'
                        ),
                        'Parcelas'=>array(
                            'numero_parcela'=>'Parcela','data_vencimento'=>'Vencimento','valor'=>'Valor da Parcela','percentual'=>'Percentual da Parcela','quantidade_dias'=>'Quantidade dias'
                        ),
                        'E-mail para o Cliente'=>array(
                            'Utilizar os seguintes endereço de e-mail'
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