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
        $produto_cliente=null;
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
   
   //////// Variáveis ////////  
    $variaveis1=array('mercadorias'=>'Mercadorias','vDesconto'=>'Desconto','ipi'=>'IPI','icms'=>'ICMS ST','vPedido'=>'Valor do Pedido');//valores preenchidos automaticamente
    $variaveis2=array(
                        'Ítens de Venda'=>array(
                            'cProduto'=>'Código','descricao'=>'Descrição do Produto','quantidade'=>'Quantidade','vUnitario'=>'Preço Unitário de Venda','vTotal'=>'Valor Total do Ítem','pDesconto'=>'Desconto','icms'=>'ICMS','icmsSt'=>'ICMS ST','ipi'=>'IPI','pis'=>'PIS','cofins'=>'COFINS','frete'=>'Frete','seguro'=>'Seguros','oDespesa'=>'Outras Despesas','icmsDesonerado'=>'ICMS Desonerado','gCReceber'=>'Gera Conta a Receber','pLiquido'=>'Peso Líquido(Kg)','pBruto'=>'Peso Bruto(Kg)','cfop'=>'CFOP'
                        ),
                        'Frete e Outras Despesas'=>array(
                            'Transportadora','Tipo do Frete','Placa do Veícula','UF','RNTRC (ANTT)','Quantidade de Volumes','Espécie dos Volumes','Marca dos Volumes','Numeração dos Volumes','Peso Líquido (Kg)','Peso Bruto (Kg)','Valor do Frete','Valor do Seguro','Número do Lacre','Outras Despesas Acessórias','O transporte será realizado com veículo próprio'
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
?>
