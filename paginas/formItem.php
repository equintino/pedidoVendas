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
        $('button').each(function(){
            if($(this).text()==pagAtual){
                $(this).css({
                    bacground: 'black',
                    border: 'solid black'
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
                        border: 'solid black'
                    });
                }
            })
            link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'';
            $('a[rel=modal]').attr('href',link);
            
            $('.listaProduto').hide();
            $('.tituloProd').text('Aguarde...');
            $("a[rel=modal]").trigger("click")
        })
        $('.tituloProd').text('Páginas ');
        $('.jTabela').scroll(function(){
            var pos=$('.jTabela').scrollLeft();
            $('.cima').scrollLeft(pos)
                       
        })
        $('.jTabela table').clone().appendTo('.cima')
        $('.cima').scrollTop('3')
        
            $('.listaProduto').mouseover(function(){
                $(this).css({
                    background:'#EDEDED',
                    cursor: 'pointer'
                })
                $(this).mouseleave(function(){
                    $(this).css('background','white')
                })
                $(this).click(function(){
                    descricao=$(this).attr('descricao');
                    cProduto=$(this).attr('codigo');
                    cOmie=$(this).attr('codigo_produto');
                    vUnitario=$(this).attr('valor_unitario');
                    qEstoque=$(this).attr('quantidade_estoque');
                    cfop=$(this).attr('cfop');
                    ncm=$(this).attr('ncm');
                    ean=$(this).attr('ean');
                    unidade=$(this).attr('unidade');
                    //alert([cProduto,cOmie]);
                    $('#pnl1 table input[name]').each(function(){
                        var name=$(this).attr('name');
                        if(name.substr(0,name.length-1)=='codigo_produto'){
                            if($(this).val()==cProduto){
                                alert('Este Produto já foi inserido');
                                die;
                            }
                        }
                    })
                    linha=linha.substring(4,5);
                    $('#pnl1 table #item'+linha+' input').each(function(){
                        //alert($(this).attr('name'));
                        var z=$(this).attr('name');
                        switch(z.substr(0,z.length-1)){
                            case 'codigo_produto':
                               $(this).val(cProduto);
                               break;
                            case 'descricao':
                               $(this).val(descricao);
                               break;
                            case 'vUnitarioItem':
                               $(this).val(numeroParaMoeda(vUnitario));
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
                               $(this).val(cfop);
                               break;
                            case 'ncm':
                               $(this).val(ncm);
                               break;
                            case 'ean':
                               $(this).val(ean);
                               break;
                            case 'unidade':
                               $(this).val(unidade);
                               break;
                            case 'cOmie':
                               $(this).val(cOmie);
                               break;
                        }
                    })
                    $(".window").hide();
                    $('#mascara').hide();
                    $('.listaProduto').hide();
                    $('.tituloProd').text('Aguarde...');
                    $('.botao :hidden').val(dadosProduto);
                })
            })
        $(".procura input").on("keyup", function(){
            var value = $(this).val().toLowerCase();
            $(".listaProduto").filter(function(){
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }).focus()
    })
</script>
<style>
    .head th{
        background: green;
        color: white;
        padding: 8px;
        font-size: 16px;
        border: 1px solid white;
    }
    .head td{
        color: black;
        padding: 5px;
        font-size: 15px;
    }
    .jItem, .head, .head1{
        width: 1000px;
    }
    .head1 th{
        background: green;
        color: white;
        padding: 8px;
        font-size: 16px;
    }
    .cima {
        width: 1003px;
        overflow: hidden;
        top: 42px;
        position: absolute;
        z-indez: 3;
        height: 40px;
        display: none;
    }
    .jTabela{
        position: relative;
        width: 1020px;
        height: 598px;
        overflow-x: scroll;
        top: -15px;
        z-index: 1;
    }
    .col1{
        width: 125px;
    }
    .col2{
        //width: 200px;
    }
    .col3{
        width: 70px;
    }
    .head1 .col4{
        width: 90px;
    }
    .head .col4{
        width: 90px;
    }
    .head1 .col5{
        width: 80px;
    }
    .head .col5{
        width: 80px;
    }
    .head1 .col6, .head1 .col7, .head1 .col8{
        width: 10px;
    }
    .head .col6, .head .col7, .head .col8{
        width: 10px;
    }
    button{
        box-shadow: 2px 2px 2px gray;
        background-color: #cbcbcb;
        padding: 1px 3px;
        border-radius: 5px;
    }
    #aguarde{
        position: absolute;
        z-index: -3;
        left: 800px;
        top: 12px;
        font-size: 20px;
    }
    .tituloProd{
        font-size: 20px;
    }
    .procura{
        position: relative;
        top: -12px;
    }
    button:hover{
        cursor: pointer;
    }
</style>
<div id="dadosItem"></div>
<?php
    include '../model/ProdutosCadastroJsonClient.php';
    include '../model/ProdutosCaracteristicasJsonClient.php';
    
    $produto=new ProdutosCadastroJsonClient();
    $caracteristica=new ProdutosCaracteristicasJsonClient();
    
    if(key_exists('pagAtual', $_GET)){
        $pagAtual=$_GET['pagAtual'];
    }else{
        $pagAtual=1;
    }
    $produto_servico_list_request=array("pagina"=>$pagAtual,"registros_por_pagina"=>40,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produto->ListarProdutos($produto_servico_list_request);
        $detalhes=$dados->produto_servico_cadastro;
        
        echo '<span class=tituloProd>Páginas </span>';
        for($g=1;$g <= $dados->total_de_paginas;$g++){
            echo '<button class=paginacao>'.$g.'</button>&nbsp&nbsp';
        }
        ?>
    <div class="procura"><input autofocus type="text" name="procura" title="Pesquisar por clientes" /> <img height="18px" src="../web/img/lupa.png" title="Pesquisar por clientes" /></div>
    <div class='tudo'>
        <div class='cima'></div>
        <div class='jTabela'>
            <table class="head" border=1 cellspacing=0 >
                <thead><tr>
                <?php
                    $w=$row=0;
                    $col=1;
                    foreach($detalhes as $prod){ 
    
                    $prcListarCaractRequest=array('nPagina'=>'1','nRegPorPagina'=>'50','nCodProd'=>$prod->codigo_produto);
                    //@$caract=$caracteristica->ListarCaractProduto($prcListarCaractRequest)->listaCaracteristicas;
                    if(count(@$caract)!= 0){
                        foreach($caract as $itemCaract){
                            if(strtoupper($itemCaract->cNomeCaract)=='LOJA'){
                                //echo $itemCaract->cNomeCaract;
                                $loja=$itemCaract->cConteudo;
                            }else{
                                $loja=null;
                            }
                        }
                    }else{
                        $loja=null;
                    }
                        if($w==0){
                            foreach($prod as $key => $item){
                                if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca') && !stristr($key,'cfop') && !stristr($key,'produto') && !stristr($key,'minimo') && !stristr($key,'internas') && !stristr($key,'tipo') && !stristr($key,'quantidade_estoque') && !stristr($key,'ean') && !stristr($key,'ncm') && !stristr($key,'unidade') && !stristr($key,'detalhada')){
                                    if($key=='descricao'){
                                        echo '<th class="descricao col'.$col.'">DESCRIÇÃO DO PRODUTO</th>';
                                    }elseif($key=='valor_unitario'){
                                        echo '<th class="col'.$col.'">VL.UNITÁRIO</th>';
                                    }elseif($key=='codigo'){
                                        echo '<th  width="10%" class="col'.$col.'">CÓDIGO</th>';
                                    }else{
                                        echo '<th class="col'.$col.'">'.mb_strtoupper(str_replace('_',' ',$key),'utf-8').'</th>';
                                    }
                                    $col++;
                                }
                            }
                            echo '</tr>';
                            $w=1;
                            goto s;
                        }
                        s:
                        $col=1;
                        $z=0;
                ?>
                </thead>
            <?php
                echo '<tr class="listaProduto" row="'.$row.'" ';
                foreach($prod as $key => $item){
                    if($key!='dadosIbpt' && $key!='imagens' && $key!='recomendacoes_fiscais'){
                        echo $key.'="'.$item.'"';
                    }
                }
                echo '>';
                foreach($prod as $key => $item){
                    if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca') && !stristr($key,'cfop') && !stristr($key,'produto') && !stristr($key,'minimo') && !stristr($key,'internas') && !stristr($key,'tipo') && !stristr($key,'quantidade_estoque') && !stristr($key,'ean') && !stristr($key,'ncm') && !stristr($key,'unidade') && !stristr($key,'detalhada')){
                        if(/*stristr($key,'detalhada') || */stristr($key,'obs_interna')){
                            echo '<td class="col'.$col.'" align=center>'.$item.'</td>';/*substr(mb_strtoupper(str_replace('_',' ',$item),'utf-8'),0,40)* $item'</td>';*/
                        }elseif(stristr($key,'valor')){
                            echo '<td class="col'.$col.'" align=right>'.number_format($item,'2',',','.').'</td>';
                        }elseif(stristr($key,'codigo')){
                            echo '<td class="col'.$col.'" loja="'.$loja.'" align=center><div width=10px>'.$item;
                            if($loja){ echo '('.$loja.')';}else{echo '</div></td>';}
                        }else{
                            echo '<td class="col'.$col.'" align=center>'.mb_strtoupper(str_replace('_',' ',$item),'utf-8').'</td>';
                        }
                    $col++;
                    $z=1;
                    }
                }
                echo '</tr>';
                $row++;
    ?>



        <!--<tr cProduto="<?= $prod->codigo_produto ?>" vUnitario="<?= $vUnitario ?>" qEstoque="<?= $prod->quantidade_estoque ?>" descricao="<?= $prod->descricao ?>" cfop='<?= $prod->cfop ?>' ean='<?= $prod->ean ?>' ncm='<?= $prod->ncm ?>' unidade='<?= $prod->unidade ?>' dados_produto=dados_produto><td align="center" ><?= $prod->descricao ?></td><td align="center"><?= $prod->quantidade_estoque ?></td><td align='right'><?= $vUnitario ?></td></tr>-->
    <?php } ?>
    <?php /*       }
        }else{
            $produto_servico_cadastro_chave=array("codigo_produto"=> $codigo_produto,"codigo_produto_integracao"=> "","codigo"=> "");
            $prod=$produto->ConsultarProduto($produto_servico_cadastro_chave);
            $vUnitario=number_format($prod->valor_unitario,'2',',','.');
            //echo '<pre>';
            //print_r($prod);
    ?>
        <tr cProduto="<?= $prod->codigo_produto ?>" vUnitario="<?= $vUnitario ?>" qEstoque="<?= $prod->quantidade_estoque ?>" descricao="<?= $prod->descricao ?>" dados_produto=dados_produto><td align="center" ><?= $prod->descricao ?></td><td align="center"><?= $prod->quantidade_estoque ?></td><td align='right'><?= $vUnitario ?></td></tr>
    <?php } */
    ?>
    </table>
</div>
</div>
<!--div id="aqui">atencao</div>-->
<?php //echo '<pre>';print_r($dados_produto); ?>