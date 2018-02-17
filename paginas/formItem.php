<meta charset="utf-8" />
<script>
    $(document).ready(function(){
        $('.jItem tr').mouseover(function(){
            $(this).css('background','#ccc')
            $(this).mouseleave(function(){
                $(this).css('background','white')
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
    $produto=new ProdutosCadastroJsonClient();
    $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>50,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
    $dados=$produto->ListarProdutos($produto_servico_list_request);
?>
<table class="jItem">
    <tr><th>Descrição</th><th>Quant. Estoque</th></tr>        
<?php
    foreach($dados->produto_servico_cadastro as $prod){ ?>
    <tr><td align="center"><?= $prod->descricao ?></td><td align="center"><?= $prod->quantidade_estoque ?></td></tr>
    <?php } ?>
</table> 