<head>
    <!--<script type="text/javascript" src="../web/js/jquery-3.2.1.min.js"></script>-->
<meta charset="utf-8" />
<?php
    //$codigo_produto=$_GET['codigo_produto'];
    //echo $codigo_produto;
?>
</head>
<script>
    $(document).ready(function(){
        var tipoBusca=$('.procura .tipoBusca input:checked').val();
        if(tipoBusca=='servidor'){
            $('.loja').hide()
            //$('.procura input').focus()
        }else if(tipoBusca=='local'){
            $('.loja').show()
            //$('.procura input').focus()
        }
        $('.procura input[name=tipoBusca]:radio').click(function(){
            if($(this).val()=='local'){
                $('.paginacao, .listaProduto').hide()
                $('.loja').show()
            }else if($(this).val()=='servidor'){
                $('.paginacao, .listaProduto').show()
                $('.loja').hide()
            }
            $('.procura input[name=procura]').focus()
            tipoBusca=$(this).val();
            if(tipoBusca=='local'){

            }
        })
        $('.procura img').click(function(){
            if(tipoBusca=='local'){
                buscaProduto=$('.procura input[name=procura]').val();
                link='../paginas/formItem.php?tipoBusca='+tipoBusca+'&buscaProduto+'+buscaProduto+'';
                $('.listaProduto').hide()
                $('.tituloProd').text('Aguarde...');
                $('a[rel=modal]').attr('href',link);
                $("a[rel=modal]").trigger("click")
            }
        })
        $(document).keydown(function(e){
            if(e.keyCode=='13'){
                alert($('.procura input:focus').val());
                if(tipoBusca=='local'){
                    buscaProduto=$('.procura input[name=procura]').val();
                    link='../paginas/formItem.php?tipoBusca='+tipoBusca+'&buscaProduto+'+buscaProduto+'';
                    $('.tituloProd').text('Aguarde...');
                    $('a[rel=modal]').attr('href',link);
                    $("a[rel=modal]").trigger("click")
                }else{
                    if(tipoBusca=='servidor'){
                        return false;
                    }
                }
            }else{
                return false;
            }
        })
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
            link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'&tipoBusca='+tipoBusca+'';
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
        $('.recarrega').css('cursor','pointer')
        $('.recarrega').click(function(){
            link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'&tipoBusca='+tipoBusca+'';
            $('a[rel=modal]').attr('href',link);
            
            $('.listaProduto').hide();
            $('.tituloProd').text('Aguarde...');
            $("a[rel=modal]").trigger("click")
        })
        $('.procura input[name=procura]').focus()
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
        height: 565px;
        overflow-y: scroll;
        overflow-x: hidden;
        top: -15px;
        z-index: 1;
        //border: solid red;
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
        //border: solid orange;
        padding: 5px;
    }
    .procura{
        position: relative;
        float: right;
        //clear: both;
        top: -10px;
        //border: solid yellow;
    }
    button:hover{
        cursor: pointer;
    }
    .recarrega{
        //clear: both;
        float: left;
        padding: 5px;
        //border: solid red;
    }
    .procura .tipoBusca{
        margin-top: 5px;
        padding: 0 20px;
        float: right;
        //border: solid green;
    }
    .loja{
        //clear: both;
        //float: right;
        padding-right: 40px;
        //border: solid red;
    }
</style>
<div id="dadosItem"></div>
<?php
    include '../dao/dao.php';
    include '../dao/ProdutoSearchCriteria.php';
    include '../config/Config.php';
    include '../model/ProdutosCadastroJsonClient.php';
    include '../model/modelProduto.php';
    include '../mapping/ProdutoMapper.php';
    $loja=null;
    $produto=new ProdutosCadastroJsonClient();
    
    if(key_exists('pagAtual', $_GET)){
        $pagAtual=$_GET['pagAtual'];
    }
    @$buscaProduto=$_GET['buscaProduto'];
    
    if(key_exists('tipoBusca', $_GET)){
        $tipoBusca=$_GET['tipoBusca'];
    }else{
        $tipoBusca='servidor';
    }
    
    switch(@$tipoBusca){
        case 'servidor':
            $servidor='checked';
            $local=null;
            break;
        case 'local':
            $local='checked';
            $servidor=null;
            break;
        default :
            $servidor='checked';
            $local=null;
            break;
    }
    echo '<div class=recarrega><img src="../web/img/atualiza.png" height="18px" title="Recarregar esta página."/></div>';
        //echo $pagAtual;die;
    
    if($tipoBusca=='servidor'){
        if(@$pagAtual=='undefined' || @!$pagAtual){
            $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>40,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
            $pagAtual=$produto->ListarProdutos($produto_servico_list_request)->total_de_paginas;
            echo '<script>pagAtual='.$pagAtual.'</script>';
        }
        
        $produto_servico_list_request=array("pagina"=>$pagAtual,"registros_por_pagina"=>40,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produto->ListarProdutos($produto_servico_list_request);
        $detalhes=$dados->produto_servico_cadastro;
    }else{
        //print_r($_GET);
        //print_r($buscaProduto);
        $dao = new Dao();
        $search = new ProdutoSearchCriteria();
        $search->settabela('tb_produto');
        $search->setcodigo($buscaProduto);
        $detalhes=$dao->encontre2($search);
        //echo '<pre>';print_r($detalhes[1]);die;
        
        /*if(@$buscaPor){
            $dados_=$dao->encontre($search);
        }else{
            $dados=null;
            if(@!$tagsArray[1]){
                $search->settags($tagLista);
            }else{
                $search->settags($tagsArray);
            }
            $dados_=$dao->encontrePorTag($search);
        }*/
        //die;
    }

    echo '<span class=tituloProd>Páginas </span>';
    if($tipoBusca=='servidor'){
        for($g=1;$g <= $dados->total_de_paginas;$g++){
            echo '<button class=paginacao>'.$g.'</button>&nbsp&nbsp';
        }
    }
    ?>
<!--<form method="post" action="../paginas/formItem.php?" >-->
    <div class="procura">
        <span class="loja">
            <label><b>LOJA:</b> </label>
            <?php //for($x=0;$x<count($variaveis);$x++): ?>
                    <select name="loja">
                        <option value=""></option>
                        <option value="cachambi">Cachambi</option>
                        <option value="bonsucesso">Bonsucesso</option>
                    </select>
            <?php //endfor ?>
        </span>
        <input autofocus type="text" name="procura" title="Pesquisar por produtos" /> <img height="18px" src="../web/img/lupa.png" title="Pesquisar por produtos" /><br>
        <div class="tipoBusca"><input title="Tipo de busca" type="radio" name="tipoBusca" value="local" <?= $local ?>/><b> Local</b> &nbsp&nbsp&nbsp<input title="Tipo de busca" type="radio" name="tipoBusca" value="servidor" <?= $servidor ?>/> <b>Servidor</b></div>
    </div>
    <div class='tudo'>
        <div class='cima'></div>
        <div class='jTabela'>
            <table class="head" border=1 cellspacing=0 >
                <thead><tr>
                <?php
                    $w=$row=0;
                    $col=1;
                    if($tipoBusca=='local'){
                        echo '<th  width="10%" class="col1">CÓDIGO</th>';
                        echo '<th class="descricao col2">DESCRIÇÃO DO PRODUTO</th>';
                        echo '<th class="col3">VL.UNITÁRIO</th></tr></thead>';
                        //echo '<pre>';print_r($detalhes[1]);//die;
                        //echo strstr($detalhes[1],'aliquo');die;
                        foreach($detalhes as  $item){
                            echo '<tr class=listaProduto><td class="col1" align=center><div width=10px>'.$item->getcodigo().'</td>';
                            echo '<td class="col2" align=center>'.$item->getdescricao().'</td>';
                            echo '<td class="col3" align=right>'.number_format($item->getvalor_unitario(),'2',',','.').'</td></tr>';
                        }
                    }elseif($tipoBusca=='servidor'){
                        foreach($detalhes as $prod){ 
                            //$prcListarCaractRequest=array('nPagina'=>'1','nRegPorPagina'=>'50','nCodProd'=>$prod->codigo_produto);
                            //@$caract=$caracteristica->ListarCaractProduto($prcListarCaractRequest)->listaCaracteristicas;
                            /*if(count(@$caract)!= 0){
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
                            }*/
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
                                //echo '</tr>';
                                $w=1;
                                goto s;
                            }
                            s:
                            $col=1;
                            $z=0;
                    ?>
                    </tr>
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
    <?php } ?>
            </table>
        </div>
    </div>
<!--</form>-->
<!--div id="aqui">atencao</div>-->
<?php //echo '<pre>';print_r($dados_produto); ?>