<meta charset="utf-8" >
<?php
    include '../paginas/janela.php';

    @$excl=$_GET['excl'];
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
   }
   ////// Classes //////
   $contas=new ContaCorrenteCadastroJsonClient();
   $contaListarRequest=array('pagina'=>'1','registros_por_pagina'=>'50');
   //$consulta=array("cCodInt"=>"");
   $conta=$contas->PesquisarContaCorrente($contaListarRequest)->conta_corrente_lista;
   //echo '<pre>';
   //print_r($conta);die;
   
   $vendedor=new VendedoresCadastroJsonClient();
   $vendListarRequest=array("pagina"=>"1","registros_por_pagina"=>"100","apenas_importado_api"=>"N");
   $vend=$vendedor->ListarVendedores($vendListarRequest);
   
   $parc=new ParcelasJsonClient();
   $parcelaListarRequest=array("pagina"=>1,"registros_por_pagina"=>100);
   $parcela=$parc->ListarParcelas($parcelaListarRequest);
   //echo '<pre>';print_r($parcela->cadastros);die;
   
   $clientes_list_request=array("pagina"=>1,"registros_por_pagina"=>100);
   $clientes=new ClientesCadastroJsonClient();
   $cliente=$clientes->ListarClientes($clientes_list_request)->clientes_cadastro;
   foreach($cliente as $item){
       if($item->tags[0]='Transportadora'){
           if($item->nome_fantasia=='Correios'){
               $correios=$item;
           }
       }
   }
   
   $etapas=new EtapasFaturamentoJsonClient();
   $etaproListarRequest=array("pagina"=>1,"registros_por_pagina"=>100);
   $etapa=$etapas->ListarEtapasFaturamento($etaproListarRequest)->cadastros;
   //foreach($etapa as $item){
       //print_r($item);die;
   //}
   $selEtapa=($etapa[2]->etapas);
   
   
   $form_pag=array('dinheiro'=>'Dinheiro','credito'=>'Cartão de Crédito','debito'=>'Cartão de Débito');
   
   //echo '<pre>';
   //print_r($form_pag);die;
   
   //////// Variáveis ////////  
    $variaveis1=array('tItem'=>'Total de Ítens','mercadorias'=>'Mercadorias','vDesconto'=>'Desconto',/*'ipi'=>'IPI','icmsSt'=>'ICMS ST',*/'vPedido'=>'Valor do Pedido');//valores preenchidos automaticamente
    $variaveis2=array(
                        'Ítens de Venda'=>array(
                            'busca'=>'','nItem'=>'Nº','cProduto'=>'Código','descricao'=>'Descrição do Produto','quantidade'=>'Quantidade','vUnitario'=>'Preço Unitário de Venda','vTotal'=>'Valor Total do Ítem','pDesconto'=>'Desconto',/*'icms'=>'ICMS','icmsSt'=>'ICMS ST','ipi'=>'IPI','pis'=>'PIS','cofins'=>'COFINS','frete'=>'Frete','seguro'=>'Seguros','oDespesa'=>'Outras Despesas','icmsDesonerado'=>'ICMS Desonerado','gCReceber'=>'Gera Conta a Receber','pLiquido'=>'Peso Líquido(Kg)','pBruto'=>'Peso Bruto(Kg)','cfop'=>'CFOP'*/
                        ),
                        'Frete e Outras Despesas'=>array(
                            'transportadora'=>'Transportadora','tfrete'=>'Tipo do Frete',/*'Placa do Veícula','UF','RNTRC (ANTT)',*/'qvolume'=>'Quantidade de Volumes','evolume'=>'Espécie dos Volumes','mvolume'=>'Marca dos Volumes','nvolume'=>'Numeração dos Volumes','pliquido'=>'Peso Líquido (Kg)','pbruto'=>'Peso Bruto (Kg)','vfrete'=>'Valor do Frete','vseguro'=>'Valor do Seguro','nlacre'=>'Número do Lacre','odespesas'=>'Outras Despesas Acessórias'/*,'O transporte será realizado com veículo próprio'*/
                        ),
                        'Informações Adcionais'=>array(
                            'Categoria','Conta Corrente','Etapa','Nº do Pedido do Cliente','Nº do Contrato de Venda','Contato','Projeto','Dados Adicionais para a Nota Fiscal','Nota Fiscal para Consumo Final'
                        ),
                        'Parcelas'=>array(
                            'Valor Total a Receber','Vencimento da Parcela','Valor da Parcela','Percentual da Parcela','Não gerar boleto desta parcela'
                        ),
                        'E-mail para o Cliente'=>array(
                            'Utilizar os seguintes endereço de e-mail','Enviar o e-mail com o boleto de cobrança gerado pelo faturamento (juntamente com o DANFE e o XML da NFe)'
                        ),
                        'Observações'=>array(
                          'Preencha aqui as observações desta venda (elas não serão exibidas na Nota Fiscal)'  
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