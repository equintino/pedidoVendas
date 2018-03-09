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
        //var pagAtual;
        //alert(pagAtual);
        /*if(!pagAtual){
           pagAtual=1;
        }*/
        
        $('button').each(function(){
            //alert($(this).text());
            if($(this).text()==pagAtual){
                $(this).css({
                    bacground: 'black',
                    border: 'solid red'
                });
            }
        })
        
        $('button').focus(function(){
            pagAtual=$(this).text();
            $('button').each(function(){
                $(this).css({
                    border: 'none'
                })
                if($(this).text()==pagAtual){
                    $(this).css({
                        bacground: 'black',
                        border: 'solid red'
                    });
                }
            })
            //alert(pagAtual);
            //$("a[rel=modal]").trigger("click")
            link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'';
            $('a[rel=modal]').attr('href',link);
            //alert($("a[rel=modal]").attr('href'));
            
            $('.jItem').hide();
            $("a[rel=modal]").trigger("click")
        })
        /*$('button').focus(function){
            
            alert('$(this).text()');
        })*/
        //if(!codigo_produto){
        /*
            $('.jItem tr').mouseover(function(){
                $(this).css({
                    background:'#ccc',
                    cursor: 'pointer'
                })
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
                            case 'cfop':
                               $(this).val();
                               break;
                            case 'ncm':
                               $(this).val();
                               break;
                            case 'ean':
                               $(this).val();
                               break;
                            case 'unidade':
                               $(this).val();
                               break;
                        }
                    })
                    $(".window").hide();
                    $('#mascara').hide();
                    //$('.fechar').trigger('click')
                    $('.botao :hidden').val(dadosProduto);
                })
            })    */
    })
</script>
<style>
    .jItem th{
        background: green;
        color: white;
        padding: 5px 10px;
    }
    .jItem td{
        //border: 1px solid gray;
    }
    .jItem{
        margin: auto;
        //border: solid red;
        width: 1800px;
    }
    #aguarde{
        position: absolute;
        z-index: -3;
        left: 200px;
        top: 50px;
    }
</style>
<div id="dadosItem"></div>
<div id='aguarde'><h1>Por Favor, Aguarde...</h1></div>
<table class="jItem" border=1 cellspacing=0 >
    <!--<tr><th>Descrição</th><th>Quant. Estoque</th><th>Preço Unitário</th></tr>-->
    <tr>
<?php
    include '../model/ProdutosCadastroJsonClient.php';
    //include 'aguarde.php';
    $produto=new ProdutosCadastroJsonClient();
    //$cProduto=$_GET['cProduto'];
    //echo '<pre>';print_r($produto->ListarProdutos($produto_servico_list_request));die;
    if(key_exists('pagAtual', $_GET)){
        $pagAtual=$_GET['pagAtual'];
    }else{
        $pagAtual=1;
    }
    
    if(!@$codigo_produto){
        $produto_servico_list_request=array("pagina"=>$pagAtual,"registros_por_pagina"=>100,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produto->ListarProdutos($produto_servico_list_request);
        $detalhes=$dados->produto_servico_cadastro;
        
        //echo '<pre>';print_r($dados->total_de_paginas);
        echo 'Páginas ';
        for($g=1;$g <= $dados->total_de_paginas;$g++){
            echo '<button class=paginacao>'.$g.'</button>&nbsp&nbsp';
        }
        
        $w=0;
        foreach($detalhes as $prod){
            if($w==0){
                foreach($prod as $key => $item){
                    if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca')){
                        if($key=='descricao'){
                            echo '<th class=descricao>DESCRIÇÃO DO PRODUTO</th>';
                        }else{
                            echo '<th>'.mb_strtoupper(str_replace('_',' ',$key),'utf-8').'</th>';
                        }
                    }
                }
                echo '</tr>';
                $w=1;
            }
            echo '<tr>';
            foreach($prod as $key => $item){
                if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca')){
                    if(stristr($key,'detalhada') || stristr($key,'obs_interna')){
                        echo '<td align=center>'.substr(mb_strtoupper(str_replace('_',' ',$item),'utf-8'),0,40).'...</td>';
                    }else{
                        echo '<td align=center>'.mb_strtoupper(str_replace('_',' ',$item),'utf-8').'</td>';
                    }
                }
            }
            echo '</tr>';
        /*    die;
        $dados_produto=array();
        foreach($prod as $key => $item){
            echo '<th>'.$item.'</th>';
            $dados_produto[$key]=$item;
        }
        $dados_produto=json_encode($dados_produto);
        echo '<script>dadosProduto='.$dados_produto.';</script>';
        $vUnitario=number_format($prod->valor_unitario,'2',',','.');
        
         */
?>
    
    
    
    <!--<tr cProduto="<?= $prod->codigo_produto ?>" vUnitario="<?= $vUnitario ?>" qEstoque="<?= $prod->quantidade_estoque ?>" descricao="<?= $prod->descricao ?>" cfop='<?= $prod->cfop ?>' ean='<?= $prod->ean ?>' ncm='<?= $prod->ncm ?>' unidade='<?= $prod->unidade ?>' dados_produto=dados_produto><td align="center" ><?= $prod->descricao ?></td><td align="center"><?= $prod->quantidade_estoque ?></td><td align='right'><?= $vUnitario ?></td></tr>-->
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