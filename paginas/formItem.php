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
                
                //alert([cProduto,vUnitario,qEstoque]);
                //alert($('.novo td').attr('ref'));
                $('.novo input').each(function(){
                    var z=$(this).attr('name');
                    switch(z){
                        case 'cProduto':
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
                           break;
                        case 'vTotal':
                           $(this).val(null);
                           break;
                    }
                })
                //if($('.novo input').attr('name')=='Código'){
                    //$('.novo input').attr('ref','1').val(codigo)
                    //$('.novo input').attr('ref','2').val(descricao)
                    $(".window").hide();
                    $('#mascara').hide();
                    $('.fechar').trigger('click')
                //}
            })
        })
        /*$('#botoes .bnt').click(function(){
            if($(this).text()=='Novo Ítem'){
                $.each(arr,function(){
                    //alert(arr[cont]);
                    cont++;
                })
                $('.novo').show()
                //$('.divVendas').append(text('aqui'))
            }else if($(this).text()=='Editar Ítem'){
                
            }else if($(this).text()=='Excluir Ítem'){
                
            }
        })*/
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
    <tr><th>Descrição</th><th>Quant. Estoque</th><th>Preço Unitário</th></tr>        
<?php
    foreach($dados->produto_servico_cadastro as $prod){ ?>
    <?php echo'<pre>';print_r($prod); ?>
    <?php $vUnitario=number_format($prod->valor_unitario,'2',',','.');?>
    <tr cProduto="<?= $prod->codigo_produto ?>" vUnitario="<?= $vUnitario ?>" qEstoque="<?= $prod->quantidade_estoque ?>" descricao="<?= $prod->descricao ?>"><td align="center" ><?= $prod->descricao ?></td><td align="center"><?= $prod->quantidade_estoque ?></td><td align='right'><?= $vUnitario ?></td></tr>
    <?php } ?>
</table> 
<!--div id="aqui">atencao</div>-->