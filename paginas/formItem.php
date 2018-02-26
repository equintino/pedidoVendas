<head>
  <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<meta charset="utf-8" />
</head>
<script>
    $(document).ready(function(){
        $('.jItem tr').mouseover(function(){
            $(this).css('background','#ccc')
            $(this).mouseleave(function(){
                $(this).css('background','white')
            })
            $(this).click(function(){
                
                descricao=$(this).attr('descricao');
                cProduto=$(this).attr('cProduto');
                vUnitario=$(this).attr('vUnitario');
                qEstoque=$(this).attr('qEstoque');
                
                //nomeString .charAt(nomeString .length()-1)
                //alert(linha.length);
                linha=linha.substring(4,5);
                //$('#pnl1 table #item1').trigger('click');
                $('#pnl1 table #item'+linha+' input').each(function(){
                    //alert($(this).val());
                    //$(this).each(function(){
                        //alert($(this).val());
                    //})
                    var z=$(this).attr('name');
                    //alert(z);
                    //alert($(this).attr('linha'));
                    switch(z){
                        case 'codigo_produto':
                           $(this).val(cProduto);
                           break;
                        case 'descricao':
                           $(this).val(descricao);
                           break;
                        case 'vUnitario':
                           $(this).val(vUnitario);
                           break;
                        case 'quantidade':
                           $(this).val(null);
                           $(this).focus();
                           break;
                        case 'vTotalItem':
                           $(this).val(null);
                           break;
                        case 'pDescontoItem':
                           $(this).val(null);
                           break;
                    }
                })
                /*
                $('#pnl1 table input').each(function(evento){
                    //alert($('#pnl1 table input').val());
                    //var data=evento.data;
                    //if($('#pnl1 table .item').text()==j){
                    $('#pnl1 table .item').each(function(){
                        
                       // alert($(this).text());
                        if($(this).text()==j){
                        //})
                        //alert($('#pnl1 table .item').text());
                    //}
                    var z=$(this).attr('name');
                    //alert(evento);
                    //alert($(this).attr('linha'));
                    switch(z){
                        case 'codigo_produto':
                           $(this).val(cProduto);
                           break;
                        case 'descricao':
                           $(this).val(descricao);
                           break;
                        case 'vUnitario':
                           $(this).val(vUnitario);
                           break;
                        case 'quantidade':
                           $(this).val(null);
                           $(this).focus();
                           break;
                        case 'vTotalItem':
                           $(this).val(null);
                           break;
                        case 'pDescontoItem':
                           $(this).val(null);
                           break;
                    }
                    }
                    })
                })*/
                $(".window").hide();
                $('#mascara').hide();
                //$('.fechar').trigger('click')
                $('.botao :hidden').val(dadosProduto);
            })
        })
    })
</script>
<style>
    .jItem th{
        background: black;
        color: white;
    }
    .jItem td{
        border-bottom: 1px solid gray;
    }
</style>
<?php
    include '../model/ProdutosCadastroJsonClient.php';
    //include '../model/ItensVenda.php';
    $produto=new ProdutosCadastroJsonClient();
    //$item=new ItensVenda();
    
    $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>50,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
    $dados=$produto->ListarProdutos($produto_servico_list_request);
?>
<div id="dadosItem"></div>
<table class="jItem">
    <tr><th>Descrição</th><th>Quant. Estoque</th><th>Preço Unitário</th></tr>        
<?php
    foreach($dados->produto_servico_cadastro as $prod){ ?>
    <?php 
        $dados_produto=array();
        foreach($prod as $key => $item){
            $dados_produto[$key]=$item;
        }
        //echo '<pre>';print_r($dados_produto);die;
        $dados_produto=json_encode($dados_produto);
        echo '<script>dadosProduto='.$dados_produto.';</script>';
    ?>
    <?php $vUnitario=number_format($prod->valor_unitario,'2',',','.');?>
    <tr cProduto="<?= $prod->codigo_produto ?>" vUnitario="<?= $vUnitario ?>" qEstoque="<?= $prod->quantidade_estoque ?>" descricao="<?= $prod->descricao ?>" dados_produto=dados_produto><td align="center" ><?= $prod->descricao ?></td><td align="center"><?= $prod->quantidade_estoque ?></td><td align='right'><?= $vUnitario ?></td></tr>
    <?php 
        } 
    ?>
</table> 
<!--div id="aqui">atencao</div>-->
<?php //echo '<pre>';print_r($dados_produto); ?>