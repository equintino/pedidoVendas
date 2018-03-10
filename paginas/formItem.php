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
                    border: 'solid black'
                });
            }
        })
        
        $('button').focus(function(){
            pagAtual=$(this).text();
            //alert($('th').attr('class'));
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
            //alert(pagAtual);
            //$("a[rel=modal]").trigger("click")
            link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'';
            $('a[rel=modal]').attr('href',link);
            //alert($("a[rel=modal]").attr('href'));
            
            $('.tudo').hide();
            $('.tituloProd').text('Aguarde...');
            $("a[rel=modal]").trigger("click")
        })
        $('.tituloProd').text('Páginas ');
        $('.jTabela').scroll(function(){
            //alert($('.jTabela').scrollTop());
            var pos=$('.jTabela').scrollLeft();
            $('.cima').scrollLeft(pos)
                       
        })
        $('.jTabela table').clone().appendTo('.cima')
        $('.cima').scrollTop('20')
        /*$('button').focus(function){
            
            alert('$(this).text()');
        })*/
        //if(!codigo_produto){
        
            $('.jTabela tr').mouseover(function(){
                //alert($(this).attr('row'));
                $(this).css({
                    background:'#EDEDED',
                    cursor: 'pointer'
                })
                $(this).mouseleave(function(){
                    $(this).css('background','white')
                })
                $(this).click(function(){
                    //$(this).each(function(){
                            alert($(this).attr('descricao'));
                        //$(this).each(function(){
                            //alert($('td').attr('name'));
                            //alert('oi');
                        //})
                    //})
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
            })    
        /*var $table = $('.table');
var $fixedColumn = $table.clone().insertBefore($table).addClass('fixed-column');

$fixedColumn.find('th:not(:first-child),td:not(:first-child)').remove();

$fixedColumn.find('tr').each(function (i, elem) {
    $(this).height($table.find('tr:eq(' + i + ')').height());
});*/
    })
</script>
<style>
    .head th{
        background: green;
        color: white;
        padding: 8px;
        font-size: 16px;
        border: 1px solid white;
        //margin-top: 20px;
        //display: fixed;
    }
    table thead{ 
        //position: 
    }
    .head{
        //position: absolute;        
        //border: solid red;
    }
    table-responsive>.fixed-column {
        /*position: absolute;
        display: inline-block;
        width: auto;
        border-right: 1px solid #ddd;*/
    }
    .head td{
        //background: #EDEDED;
        
        color: black;
        padding: 5px;
        font-size: 15px;
    }
    .jItem{
        //border: 1px solid red;
        //border-left: 1px solid gray;
    }
    .jItem, .head, .head1{
        //margin: 10px auto;
        width: 1290px;
        //border: solid red;
    }
    .head1 th{
        background: green;
        color: white;
        padding: 8px;
        font-size: 16px;
        //margin-top: 20px;
        //display: fixed;
    }
    .cima {
        overflow: hidden;
        //scroll: hidden;
        width: 1020px;
        top: 42px;
        //padding-bottom: 10px;
        position: absolute;
        z-indez: 3;
        height: 40px;
        //border: solid red;
    }
    .col1{
        width: 135px;
    }
    .col2{
        //border: solid red;
        width: 200px;
    }
    .col3{
        width: 270px;
        //border: solid red;
        //padding: 0 20px;
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
        //border: solid red;
    }
    .head1 .col6, .head1 .col7, .head1 .col8{
        width: 10px;
    }
    .head .col6, .head .col7, .head .col8{
        width: 10px;
        //border: solid red;
    }
    .col8{
        //width: 60px;
        //border: solid red;
    }
    .jTabela{
        height: 598px;
        overflow-x: scroll;
        margin-top: 6px;
        //display: block;
        //border: solid red;     
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
</style>
<div id="dadosItem"></div>
<!--<div id='aguarde'>Aguarde...</div>-->
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
        echo '<span class=tituloProd>Páginas </span>';
        for($g=1;$g <= $dados->total_de_paginas;$g++){
            echo '<button class=paginacao>'.$g.'</button>&nbsp&nbsp';
        }
        ?>
<div class='tudo'>
<div class='cima'>         
        <table class="head1" border=1 cellspacing=0 ><thead>
                <tr><th>
        <?php
        /*$col=1;
        foreach($detalhes as $prod){
                foreach($prod as $key => $item){
                    if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca') && !stristr($key,'cfop') && !stristr($key,'produto') && !stristr($key,'minimo') && !stristr($key,'internas') && !stristr($key,'tipo')){
                        if($key=='descricao'){
                            echo '<th class="descricao col'.$col.'">DESCRIÇÃO DO PRODUTO</th>';
                        }elseif($key=='quantidade_estoque'){
                            echo '<th class="col'.$col.'">ESTOQUE</th>';
                        }elseif($key=='valor_unitario'){
                            echo '<th class="col'.$col.'">VL.UNITÁRIO</th>';
                        }else{
                            echo '<th class=col'.$col.'>'.mb_strtoupper(str_replace('_',' ',$key),'utf-8').'</th>';
                        }
                    $col++;
                    }
                }
                echo '</tr>';
                break;
            }*/
        ?>
                    </th></tr>
        </thead></table>
</div>
        <div class='jTabela'>
        <table class="head" border=1 cellspacing=0 >
            <thead>
            <tr>
        <?php
        $w=$row=0;
        $col=1;
        foreach($detalhes as $prod){
            if($w==0){
                foreach($prod as $key => $item){
                    if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca') && !stristr($key,'cfop') && !stristr($key,'produto') && !stristr($key,'minimo') && !stristr($key,'internas') && !stristr($key,'tipo')){
                        if($key=='descricao'){
                            echo '<th class="descricao col'.$col.'">DESCRIÇÃO DO PRODUTO</th>';
                        }elseif($key=='quantidade_estoque'){
                            echo '<th class="col'.$col.'">ESTOQUE</th>';
                        }elseif($key=='valor_unitario'){
                            echo '<th class="col'.$col.'">VL.UNITÁRIO</th>';
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
            //echo '</table>';
            //echo '<table class=jItem border=1 cellspacing=0 >';
            $col=1;
            $z=0;
            //echo '<pre>';print_r($prod);//die;
            echo '</thead>';
            echo '<tr row="'.$row.'" ';
            foreach($prod as $key => $item){
                if($key!='dadosIbpt' && $key!='imagens' && $key!='recomendacoes_fiscais'){
                    echo $key.'="'.$item.'"';
                }//goto pula;
                //echo '<br>';
            }//die;
            //pula:
            echo '>';
            foreach($prod as $key => $item){
                if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca') && !stristr($key,'cfop') && !stristr($key,'produto') && !stristr($key,'minimo') && !stristr($key,'internas') && !stristr($key,'tipo')){
                    if(stristr($key,'detalhada') || stristr($key,'obs_interna')){
                        echo '<td class="col'.$col.'" name="'.$item.'" align=center>'.substr(mb_strtoupper(str_replace('_',' ',$item),'utf-8'),0,40).'...</td>';
                    }elseif(stristr($key,'valor')){
                        echo '<td class="col'.$col.'" name="'.$item.'"  align=right>'.number_format($item,'2',',','.').'</td>';
                    }else{
                        echo '<td class="col'.$col.'" name="'.$item.'"  align=center>'.mb_strtoupper(str_replace('_',' ',$item),'utf-8').'</td>';
                    }
                $col++;
                $z=1;
                }
            }
            echo '</tr>';
            $row++;
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
</div>
</div>
<!--div id="aqui">atencao</div>-->
<?php //echo '<pre>';print_r($dados_produto); ?>