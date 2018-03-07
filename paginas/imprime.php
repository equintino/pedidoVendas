<html>
    <head>
        <meta charset="utf-8" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        
        <script>
            $(document).ready(function(){
                window.print();
                window.location='../web/index.php?pagina=pedido&act=cad';
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
                color: #454545; 
                font: 12pt serif;
                font-weight: 600;
                //border: solid red;
                width: 105mm;
                margin: auto;
            }
            #texto{
                width: 100%; 
                margin: auto;
            }
            .conteudo{
                //margin-top: 10px;
                width: 95mm;
                height: 297mm;
                //border: solid red;
                background: #f3f6ac;
                padding: 20px;
            }
            h3{
                text-align: center;
                margin: 10px 0 10px 0;
            }
            .endereco{
                text-align: center;
            }
            .cnpj{
                margin-top: 10px;
                font-weight: 900;
                color: black;
            }
            hr{
                margin-top: 8px;
            }
            h2{
                text-align: center;
                margin-top: 8px;
            }
            .coo{
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
                //float: right;
            }
            .total, .vTotal{
                //font-weight: 900;
                color: black
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
            
            @media print{
                .conteudo {
                    -webkit-column-count: 1; /* Chrome, Safari, Opera */
                    -moz-column-count: 1; /* Firefox */
                    column-count: 1;
                }
            }
        </style>
<?php
    //echo '<pre>';print_r($pedido_venda_produto);
    $tItens=$pedido_venda_produto->cabecalho->quantidade_itens;
    
    //print_r($codigo);die;
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
            <h3>Nome do Estabelecimento</h3>
            <div class="endereco">Endereço, Número - Bairro<br>Rio de Janeiro - RJ CEP 00000-000</div>
            <div class="cnpj">CNPJ: 00.000.000/0000-00<br></div>
            <div class="ie">IE: 000.000.000.000<br></div>
            <div class="IM">IM:0.000.000-0</div>
            <hr>
            <span class="data"><?= date('d/m/Y h:m:s') ?></span>
            <!--O CCF significa Contador de Cupom Fiscal, que serve como um contador da impressora fiscal que conta os cupons fiscais emitidos pela impressora fiscal.

            O COO, Contador de Ordem de Operação, é o número mais destacado em negrito. Este número é o número do Cupom Fiscal. Os números do CCO registram o primeiro e o último documento emitidos no dia-->
            <span class="ccf">CCF: 000000</span>
            <span class="coo">COO: 000000</span>
            <h2>CUPOM FISCAL</h2>
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
                $vUnitario=number_format($pedido_venda_produto->det[$i-1]['produto']->valor_unitario,'2',',','.');
                $vTotalItem=number_format($pedido_venda_produto->det[$i-1]['produto']->valor_mercadoria,'2',',','.');
            ?>
                <span><?= '00'.$i.'</span><span class=cod>'.$codigo.'</span><span class=desc>'.$descricao ?><br></span>
                <span class="quant">&nbsp&nbsp<?= $quantidade.'</span> &nbsp&nbsp&nbsp&nbsp&nbsp X <span class=vlUnit2>'.$vUnitario.'</span><span class=vTotalItem2>'.$vTotalItem ?></span>
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