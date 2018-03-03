<head>
  <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<meta charset="utf-8" />
<?php
    //$codigo_produto=$_GET['codigo_produto'];
    //echo $codigo_produto;
?>
</head>
<script>
    $(document).ready(function(){
        //if(!codigo_produto){
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
                    //alert(vUnitario);

                    linha=linha.substring(4,5);
                    $('#pnl1 table #item'+linha+' input').each(function(){
                        var z=$(this).attr('name');
                        switch(z.substr(0,z.length-1)){
                            case 'codigo_produto':
                               $(this).val(cProduto);
                               break;
                            case 'descricao':
                               $(this).val(descricao);
                               break;
                            case 'vUnitarioItem':
                               $(this).val(vUnitario);
                               break;
                            case 'quantidade':
                               $(this).val(null);
                               $(this).attr('qestoque',qEstoque);
                               $(this).focus();
                               break;
                            case 'vTotalItem':
                               $(this).val(0,00);
                               break;
                            case 'pDescontoItem':
                               $(this).val();
                               break;
                        }
                    })
                    $(".window").hide();
                    $('#mascara').hide();
                    //$('.fechar').trigger('click')
                    $('.botao :hidden').val(dadosProduto);
                })
            })
        //}
        /*else{
            descricao=$(this).attr('descricao');
            cProduto=$(this).attr('cProduto');
            vUnitario=$(this).attr('vUnitario');
            qEstoque=$(this).attr('qEstoque');
            $('.jItem tr').each(function(){
                if($(this).text()=='Descrição'){
                    alert($(this));
                }
            })

            linha=linha.substring(4,5);
            $('#pnl1 table #item'+linha+' input').each(function(){
                var z=$(this).attr('name');
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
            $(".window").hide();
            $('#mascara').hide();
        }*/
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
    .jItem{
        margin: auto;
        //border: solid red;
    }
</style>
<div id="dadosItem"></div>
<table class="jItem">
    <tr><th>Descrição</th><th>Quant. Estoque</th><th>Preço Unitário</th></tr>
<?php
    include '../model/ProdutosCadastroJsonClient.php';
    $produto=new ProdutosCadastroJsonClient();
    //$cProduto=$_GET['cProduto'];
    
    
    if(!@$codigo_produto){
        $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>50,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produto->ListarProdutos($produto_servico_list_request);
        $detalhes=$dados->produto_servico_cadastro;
        foreach($detalhes as $prod){
        $dados_produto=array();
        foreach($prod as $key => $item){
            $dados_produto[$key]=$item;
        }
        $dados_produto=json_encode($dados_produto);
        echo '<script>dadosProduto='.$dados_produto.';</script>';
        $vUnitario=number_format($prod->valor_unitario,'2',',','.');
?>
    <tr cProduto="<?= $prod->codigo_produto ?>" vUnitario="<?= $vUnitario ?>" qEstoque="<?= $prod->quantidade_estoque ?>" descricao="<?= $prod->descricao ?>" dados_produto=dados_produto><td align="center" ><?= $prod->descricao ?></td><td align="center"><?= $prod->quantidade_estoque ?></td><td align='right'><?= $vUnitario ?></td></tr>
<?php 
        }
    }else{
        $produto_servico_cadastro_chave=array("codigo_produto"=> $codigo_produto,"codigo_produto_integracao"=> "","codigo"=> "");
        $prod=$produto->ConsultarProduto($produto_servico_cadastro_chave);
        $vUnitario=number_format($prod->valor_unitario,'2',',','.');
        //echo '<pre>';
        //print_r($prod);
?>
    <tr cProduto="<?= $prod->codigo_produto ?>" vUnitario="<?= $vUnitario ?>" qEstoque="<?= $prod->quantidade_estoque ?>" descricao="<?= $prod->descricao ?>" dados_produto=dados_produto><td align="center" ><?= $prod->descricao ?></td><td align="center"><?= $prod->quantidade_estoque ?></td><td align='right'><?= $vUnitario ?></td></tr>
<?php } ?>
</table> 
<!--div id="aqui">atencao</div>-->
<?php //echo '<pre>';print_r($dados_produto); ?>