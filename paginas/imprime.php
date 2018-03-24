<html>
    <head>
        <meta charset="utf-8" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        
        <script>
            $(document).ready(function(){
                window.print();
                //window.location='../web/index.php?pagina=pedido&act=cad';
            })
            
            /* estudar
            // Imprime a página
        window.print();
                
        (function () {
            var beforePrint = function () {
                
                // Remove o loading
                $(".se-pre-con").hide();

                // Remove Menu topo
                $(".header").hide();
                $('.content').css({
                    top: ("0px")
                }).show();
            };
            var afterPrint = function () {
                // Redireciona página
                window.location = 'Logado.php?pagina=<?php //$pagina_crypt ?>';
            };

            if (window.matchMedia) {
                var mediaQueryList = window.matchMedia('print');
                mediaQueryList.addListener(function (mql) {
                    if (mql.matches) {
                        beforePrint();
                    } else {
                        afterPrint();
                    }
                });
            }

            window.onbeforeprint = beforePrint;
            window.onafterprint = afterPrint;
        }()); */
        </script>
        <style>
            *{
                padding: 0;
                margin: 0;
            }
            body{
                background: #000;
                font: 12pt serif;
                font-weight: 600;
                width: 105mm;
            }
            #texto{
                width: 100%; 
                margin: auto;
            }
            .conteudo{
                width: 85mm;
                background: white;
                padding: 20px;
            }
            h3{
                text-align: center;
            }
            .endereco{
                text-align: center;
                font-size: 10px;
            }
            .cnpj{
                margin-top: 10px;
            }
            .cnpj,.ie{
                font-weight: 900;
                color: black;
                font-size: 13px;
            }
            hr{
                margin-top: 8px;
            }
            h2{
                text-align: center;
                margin-top: 8px;
            }
            .pedido{
                float: right;
            }
            .titulo1{
                margin-top: 10px;
            }
            .titulo2{
                margin-top: 5px;
            }
            .descricao{
                margin-left: 50px;
            }
            .qtd, .quant{
                margin-left: 20px;
            }
            .vlUnit{
                margin-left: 60px;
            }
            .vlItem, .vTotalItem2{
                float: right;
            }
            .cod{
                margin-left: 35px;
            }
            .desc{
                margin-left: 65px;
            }
            .quant{
                margin-right: 20px;
            }
            .vlUnit2{
                margin-left: 60px;
            }
            .vTotal{
                float: right;
            }
            .desconto{
                float: right;
            }
            .hrTotal{
                width: 40%;
                float: right;
            }
            .final{
                clear: both;
                margin-top: 20px;
            }
            .dCliente{
                font-style: italic;
            }
            .campos, .dCliente{
                font-size: 12px;
            }
            
            @media print{
                .conteudo {
                    //-webkit-column-count: 1; /* Chrome, Safari, Opera */
                    //-moz-column-count: 1; /* Firefox */
                    //column-count: 1;
                }
            }
            @page{
                size: auto;
                margin: 0mm;
            }
        </style>
<?php
    include '../model/EmpresasCadastroJsonClient.php';
    include '../model/empresa.php';
    
    @$pedido=$_GET['pedido'];
    @$vendedor=$_POST['vendedor'];
    @$empresaAtualiza=$_GET['empresaAtualiza'];
    
    //$empresaAtualiza=1;
    if($empresaAtualiza==1){
        $emp=new EmpresasCadastroJsonClient();
        $empresas_list_request=array("pagina"=>1,"registros_por_pagina"=>100,"apenas_importado_api"=>"N");
        $empresa=$emp->ListarEmpresas($empresas_list_request)->empresas_cadastro;

        foreach($empresa as $item){
            $bairro=$item->bairro;
            $cep=$item->cep;
            $cidade=$item->cidade;
            $cnpj=$item->cnpj;
            $codigo_empresa=$item->codigo_empresa;
            $complemento=$item->complemento;
            $email=$item->email;
            $endereco=$item->endereco;
            $endereco_numero=$item->endereco_numero;
            $estado=$item->estado;
            $inscricao_estadual=$item->inscricao_estadual;
            $nome_fantasia=$item->nome_fantasia;
            $razao_social=$item->razao_social;
            $telefone1_ddd=$item->telefone1_ddd;
            $telefone1_numero=$item->telefone1_numero;
            $website=$item->website;
        }
    }else{
        $empresa=new empresa();
        $bairro=$empresa->bairro;
        $cep=$empresa->cep;
        $cidade=$empresa->cidade;
        $cnpj=$empresa->cnpj;
        $codigo_empresa=$empresa->codigo_empresa;
        $complemento=$empresa->complemento;
        $email=$empresa->email;
        $endereco=$empresa->endereco;
        $endereco_numero=$empresa->endereco_numero;
        $estado=$empresa->estado;
        $inscricao_estadual=$empresa->inscricao_estadual;
        $nome_fantasia=$empresa->nome_fantasia;
        $razao_social=$empresa->razao_social;
        $telefone1_ddd=$empresa->telefone1_ddd;
        $telefone1_numero=$empresa->telefone1_numero;
        $website=$empresa->website;
    }
    //echo $website;
    //die;
    
    //echo '<pre>';print_r($pedido_venda_produto);
    @$tItens=$pedido_venda_produto->cabecalho->quantidade_itens;
    
    //echo '<pre>';print_r($pedido_venda_produto->det);
    //print_r($_POST);die;
    //@$item=$_POST['item'];
    //@$codigo=$_POST['codigo'];
    //@$descricao=$_POST['descricao'];
    //@$quantidade=$_POST['quantidade'];
    //@$vUnitario=$_POST['vUnitario'];
    //@$vTotalItem=$_POST['vTotalItem'];
    @$vPedido=$_POST['vPedido'];
    @$vDesconto=$_POST['vDesconto'];
    
    date_default_timezone_set('America/Sao_Paulo');
?>
    </head>
    <body>
        <div class="conteudo">
            <h3><?= $razao_social ?></h3>
            <div class="endereco">Tel. (<?= $telefone1_ddd ?>) <?= $telefone1_numero ?> / <?= $website ?></div>
            <div class="cnpj">CNPJ: <?= $cnpj ?><br></div>
            <div class="ie">IE: <?= $inscricao_estadual ?><br></div>
            <!--<div class="IM">IM:0.000.000-0</div>-->
            <hr>
            <span class="data"><?= date('d/m/Y h:m:s') ?></span>
            <!--O CCF significa Contador de Cupom Fiscal, que serve como um contador da impressora fiscal que conta os cupons fiscais emitidos pela impressora fiscal.

            O COO, Contador de Ordem de Operação, é o número mais destacado em negrito. Este número é o número do Cupom Fiscal. Os números do CCO registram o primeiro e o último documento emitidos no dia-->
            <span class="pedido">Pedido: <?= preg_replace('/^0+/','',@$numero_pedido) ?></span><br>
            <span>Vendedor: <?= @$vendedor ?></span><br>
            <hr>
            <span class="campos">Cliente: </span><span class="dCliente"><?= $_POST['cliente'] ?></span><br>
            <span class="campos">Endereço: </span><span class="dCliente"><?= $_POST['endereco'] ?></span><br>
            <span class="campos">Bairro: </span><span class="dCliente"><?= $_POST['bairro'] ?></span>&nbsp&nbsp&nbsp <span class="campos">Cep: </span><span class="dCliente"><?= substr($_POST['cep'],0,4).'-'.substr($_POST['cep'],5,3) ?></span><br>
            <span class="campos">Cidade: </span><span class="dCliente"><?= $_POST['cidade'] ?></span><br>
            <span class="campos">CPF/CNPJ: </span><span class="dCliente"><?= $_POST['cnpj_cpf'] ?></span><br>
            <hr>
            <!--<h2>CUPOM FISCAL</h2>-->
            <div class="titulo1">
                <span>ÍTEM &nbsp&nbsp&nbspCODIGO</span><span class="descricao">DESCRIÇÃO<br></span>
                <span class='qtd'>QTD.</span><span class=vlUnit>VL. UNIT(R$)</span><span class='vlItem'>VL. ÍTEM(R$)</span>
            </div>
            <hr>
            <div class="titulo2">
            <?php for($i=1;$i<=$tItens;$i++): 
                $codigo=$pedido_venda_produto->det[$i-1]['produto']->codigo_produto;
                $descricao=$pedido_venda_produto->det[$i-1]['produto']->descricao;
                $quantidade=$pedido_venda_produto->det[$i-1]['produto']->quantidade;
                $dados_adcionais_item=$pedido_venda_produto->det[$i-1]['inf_adic']->dados_adicionais_item;
                $vUnitario=number_format($pedido_venda_produto->det[$i-1]['produto']->valor_unitario,'2',',','.');
                $vTotalItem=number_format($pedido_venda_produto->det[$i-1]['produto']->valor_mercadoria,'2',',','.');
                //print_r($dados_adcionais_item));die;
            ?>
                <span><?= '00'.$i.'</span><span class=cod>'.$codigo.'</span><span class=desc>'.$descricao ?><br></span>
                <span class="quant">&nbsp&nbsp<?= $quantidade.'</span> &nbsp&nbsp&nbsp&nbsp&nbsp X <span class=vlUnit2>'.$vUnitario.'</span><span class=vTotalItem2>'.$vTotalItem ?></span><br>
                <div class="seriais"><?= nl2br($dados_adcionais_item) ?></div>
            <?php endfor; ?>
            </div><br>
            <span class=desconto>(Desconto) -<?= $vDesconto ?></span><br>
            <hr class='hrTotal'>
            <div class='final'>
                <span class="total">TOTAL</span>
                <span class="vTotal">R$ <?= $vPedido ?></span>
            </div>
        </div>
        <!--<button onclick='window.print()'>Imprimir</button>-->
    </body>
</html>