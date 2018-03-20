<meta charset="utf-8" >
<?php
    include '../paginas/janela.php';

    @$excl=$_GET['excl'];
    @$contaAtualiza=$_GET['contaAtualiza'];
    @$vendedorAtualiza=$_GET['vendedorAtualiza'];
    @$correiosAtualiza=$_GET['$correiosAtualiza'];
    @$etapaAtualiza=$_GET['$etapaAtualiza'];
    
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
    
    //$caracteristica->ListarCaractProduto($prcListarCaractRequest);
    //echo '<pre>';print_r($caracteristica);die;
    
    $pvpListarRequest=array('pagina'=>'1','registros_por_pagina'=>'50');
    //echo '<pre>';print_r($pedido->ListarPedidos($pvpListarRequest)->pedido_venda_produto);die;
    if(!isset($quant))
        $quant=0;
    
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
   if($contaAtualiza==1){
        $contas=new ContaCorrenteCadastroJsonClient();
        $contaListarRequest=array('pagina'=>'1','registros_por_pagina'=>'50');
        $conta=$contas->PesquisarContaCorrente($contaListarRequest)->conta_corrente_lista;
        $nCodCC=$conta[0]->nCodCC;
        $descricao=$conta[0]->descricao;
   }else{
       $nCodCC='740899824';
       $descricao='Santander';
   }
   //$vendedorAtualiza=1;
   if($vendedorAtualiza==1){
        $vendedor=new VendedoresCadastroJsonClient();
        $vendListarRequest=array("pagina"=>"1","registros_por_pagina"=>"50","apenas_importado_api"=>"N");
        $vend=$vendedor->ListarVendedores($vendListarRequest)->cadastro;
   }else{
        $vendedorLista=array('740394323'=>'Jadeylson','740395328'=>'Angela','740395810'=>'Moises','742241153'=>'Sergio','756282022'=>'Adriano');
        $vend=array();
        foreach($vendedorLista as $key => $item){
            $vendedores=new vendedores();
            $vendedores->codigo=$key;
            $vendedores->nome=$item;
            array_push($vend, $vendedores);
        }
   }
   
    $dadosParcelas=array(array('cCodigo'=>'000','cDescricao'=>'A Vista','nQtdeParc'=>'1'),array('cCodigo'=>'001','cDescricao'=>'1 Parcela','nQtdeParc'=>'1'),array('cCodigo'=>'002','cDescricao'=>'2 Parcelas','nQtdeParc'=>'2'),array('cCodigo'=>'003','cDescricao'=>'3 Parcelas','nQtdeParc'=>'3'),array('cCodigo'=>'004','cDescricao'=>'4 Parcelas','nQtdeParc'=>'4'),array('cCodigo'=>'005','cDescricao'=>'5 Parcelas','nQtdeParc'=>'5'),array('cCodigo'=>'006','cDescricao'=>'6 Parcelas','nQtdeParc'=>'6'),array('cCodigo'=>'007','cDescricao'=>'7 Parcelas','nQtdeParc'=>'7'),array('cCodigo'=>'008','cDescricao'=>'8 Parcelas','nQtdeParc'=>'8'),array('cCodigo'=>'009','cDescricao'=>'9 Parcelas','nQtdeParc'=>'9'),array('cCodigo'=>'010','cDescricao'=>'10 Parcelas','nQtdeParc'=>'10'));
    $parcela=array();
    foreach($dadosParcelas as $item){
        $detalheParc=new parcela();
        $detalheParc->cCodigo=$item['cCodigo'];
        $detalheParc->cDescricao=$item['cDescricao'];
        $detalheParc->nQtdeParc=$item['nQtdeParc'];
        array_push($parcela, $detalheParc);
    }
    //$correiosAtualiza=1;
    if($correiosAtualiza==1){
        $clientes_list_request=array("pagina"=>1,"registros_por_pagina"=>100);
        $clientes=new ClientesCadastroJsonClient();
        $cliente=$clientes->ListarClientes($clientes_list_request)->clientes_cadastro;
        foreach($cliente as $item){
           if($item->tags[0]='Transportadora'){
               if($item->nome_fantasia=='Correios'){
                   $correios=$item;
                   break;
               }
           }
        }
    }else{
        $correios=array('bairro'=>'CIDADE NOVA','cep'=>'20210900','cidade'=>'RIO DE JANEIRO (RJ)','cidade_ibge'=>'3304557','cnae'=>'5310501','cnpj_cpf'=>'34.028.316/0002-94','codigo_cliente_integracao'=>'','codigo_cliente_omie'=>'743699622','codigo_pais'=>'1058','complemento'=>'','endereco'=>'AV PRESIDENTE VARGAS','endereco_numero'=>'3077','estado'=>'RJ','exterior'=>'N','info'=>array('cImpAPI'=>'N','dAlt'=>'18/01/2018','dInc'=>'18/01/2018','hAlt'=>'16:57:03','hInc'=>'16:42:18','uAlt'=>'P000065360'),'uInc'=>'P000065360','inscricao_estadual'=>'','inscricao_municipal'=>'','nome_fantasia'=>'Correios','pessoa_fisica'=>'N','razao_social'=>'EMPRESA BRASILEIRA DE CORREIOS E TELEGRAFOS','tags'=>array('Transportadora',array('tag'=>'Transportadora')),'telefone1_ddd'=>'21','telefone1_numero'=>'2503-8152');
    }
    
    //$etapaAtualiza=1;
    if($etapaAtualiza==1){
        $etapas=new EtapasFaturamentoJsonClient();
        $etaproListarRequest=array("pagina"=>1,"registros_por_pagina"=>100);
        $etapa=$etapas->ListarEtapasFaturamento($etaproListarRequest)->cadastros;
        $selEtapa=($etapa[2]->etapas);
    }else{
        $selEtapa=array(array('cCodigo'=>'00','cDescrPadrao'=>'Proposta','cDescricao'=>'Pedido de Venda'),array('cCodigo'=>'10','cDescrPadrao'=>'Pedido de Venda','cDescricao'=>'Pedido de Venda'),array('cCodigo'=>'20','cDescrPadrao'=>'Separar Estoque','cDescricao'=>'Separar Estoque'),array('cCodigo'=>'50','cDescrPadrao'=>'Faturar','cDescricao'=>'Faturar'),array('cCodigo'=>'60','cDescrPadrao'=>'Faturado','cDescricao'=>'Faturado'),array('cCodigo'=>'70','cDescrPadrao'=>'Entrega','cDescricao'=>'Entrega'),array('cCodigo'=>'80','cDescrPadrao'=>'','cDescricao'=>''));
    }
    echo '<pre>';print_r($selEtapa);die;

    $tabPreco=new TabelaPrecosJsonClient();
    $tprListarRequest=array("nPagina"=>1,"nRegPorPagina"=>20);
    $tabelaPreco=$tabPreco->ListarTabelasPreco($tprListarRequest)->listaTabelasPreco;
            //foreach($tabelaPreco as $key => $item): ?>
            <?php //die;//endforeach;
   //echo '<pre>';print_r($tabelaPreco);//die;//cCodIntTabPreco cNome
   
   $form_pag=array('dinheiro'=>'Dinheiro','credito'=>'Cartão de Crédito','debito'=>'Cartão de Débito');
   
   //echo '<pre>';
   //print_r($form_pag);die;
   
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
                            'codigo_categoria'=>'Categoria','codigo_conta_corrente'=>'Banco','etapa'=>'Etapa'/*,'Nº do Pedido do Cliente','Nº do Contrato de Venda','Contato','Projeto'*/,'dados_adcionais_nf'=>'Dados Adicionais para a Nota Fiscal'/*,'Nota Fiscal para Consumo Final'*/
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
    //{"aliquota_cofins":0,"aliquota_ibpt":0,"aliquota_icms":0,"aliquota_pis":0,"bloqueado":"N","cest":"","cfop":"","codInt_familia":"","codigo":"1000","codigo_familia":0,"codigo_produto":1229930876,"codigo_produto_integracao":"","csosn_icms":"","cst_cofins":"","cst_icms":"","cst_pis":"","dadosIbpt":{"aliqEstadual":0,"aliqFederal":0,"aliqMunicipal":0,"chave":"","fonte":"","valido_ate":"","valido_de":"","versao":""},"descr_detalhada":"","descricao":"Mouse sem fio Microsoft","descricao_familia":"","ean":"","estoque_minimo":10,"importado_api":"N","inativo":"N","ncm":"9504.10.99","obs_internas":"","peso_bruto":0,"peso_liq":0,"quantidade_estoque":10,"recomendacoes_fiscais":{"cupom_fiscal":"N","id_cest":"","id_preco_tabelado":0,"origem_mercadoria":""},"red_base_icms":0,"tipoItem":"00","unidade":"UN","valor_unitario":150}            
?>