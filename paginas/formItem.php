<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<script>
    $(document).ready(function(){
        var tipoBusca=$('.procura .tipoBusca input:checked').val();
        if(tipoBusca=='servidor'){
            $('.loja').hide();
        }else{
            $('.loja').show();
        }
        $('.procura input[name=tipoBusca]:radio').click(function(){
            if($(this).val()=='local'){
                $('.listaProduto, .paginacao').hide();
                $('.loja').show();
                tipoBusca='local';
            }else if($(this).val()=='servidor'){
                $('.listaProduto, .paginacao').show();
                $('.loja').hide();
                tipoBusca='servidor';
                $('.recarrega').trigger('click');
            }
        });
        $('.procura img').mouseover(function(){
            if(tipoBusca=='local'){
                $(this).css('cursor','pointer');
            }
        });
        $('.procura img').click(function(){
            var loja=$('.loja :selected').val();
            if(tipoBusca=='local'){
                buscaProduto=encodeURIComponent($('.procura input[name=procura]').val());
                link='../paginas/formItem.php?tipoBusca='+tipoBusca+'&buscaProduto='+buscaProduto+'&loja='+loja+'';
                $('.listaProduto').hide();
                $('.tituloProd').text('Aguarde...');
                $('a[rel=modal]').attr('href',link);
                $("a[rel=modal]").trigger("click");
            }else{
                $('.recarrega').trigger('click');            
            }
        });
        $('button').each(function(){
            if($(this).text()==pagAtual){
                $(this).css({
                    bacground: 'black',
                    border: 'solid black'
                });
            }
        });
        $('button').focus(function(){
            pagAtual=$(this).text();
            $('button').each(function(){
                $(this).css({
                    border: 'none'
                });
                if($(this).text()==pagAtual){
                    $(this).css({
                        bacground: 'black',
                        border: 'solid black'
                    });
                }
            });
            link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'&tipoBusca='+tipoBusca+'';
            $('a[rel=modal]').attr('href',link);
            
            $('.listaProduto').hide();
            $('.tituloProd').text('Aguarde...');
            $("a[rel=modal]").trigger("click");
        });
        $('.tituloProd').text('Páginas ');
        $('.listaProduto').mouseover(function(){
            $(this).css({
                background:'#EDEDED',
                cursor: 'pointer'
            });
            $(this).mouseleave(function(){
                $(this).css('background','white');
            });
            $(this).click(function(){
                descricao=$(this).attr('descricao');
                cProduto=$(this).attr('codigo');
                cOmie=$(this).attr('codigo_produto');
                vUnitario=$(this).attr('valor_unitario');
                pTabela=$(this).attr('pTabela');
                qEstoque=$(this).attr('quantidade_estoque');
                cfop=$(this).attr('cfop');
                ncm=$(this).attr('ncm');
                ean=$(this).attr('ean');
                unidade=$(this).attr('unidade');
                $('#pnl1 table input[name]').each(function(){
                    var name=$(this).attr('name');
                    if(name.substr(0,name.length-1)=='codigo_produto'){
                        if($(this).val()==cProduto){
                            /*alert('Este Produto já foi inserido');*/
                            die;
                        }
                    }
                });
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
                           $(this).val(numeroParaMoeda(vUnitario));
                           break;
                        case 'pTabela':
                           $(this).val(pTabela);
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
                });
                $(".window").hide();
                $('#mascara').hide();
                $('.listaProduto').hide();
                $('.tituloProd').text('Aguarde...');
            });
        });
        $(".procura input").on("keyup", function(){
            var value = $(this).val().toLowerCase();
            $(".listaProduto").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }).focus();
        $('.recarrega').css('cursor','pointer');
        $('.recarrega').click(function(){
            if(tipoBusca=='local'){
                $('.procura img').trigger('click');
            }else{
                if (typeof pagAtual == "undefined"){
                    pagAtual=1;
                }
                link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'&tipoBusca='+tipoBusca+'';
                $('a[rel=modal]').attr('href',link);
                $('.listaProduto').hide();
                $('.tituloProd').text('Aguarde...');
                $("a[rel=modal]").trigger("click");
            }
        });
        $('.procura input[name=procura]').focus();
        if(tipoBusca=='local'){
            $('.cont').text(cont);
        }
        $('.procura select[name=loja]').change(function(){
            loja=$(this).val();
            if(loja != ''){
                link='../paginas/formItem.php?tipoBusca=local&loja='+loja+'';
                $('a[rel=modal]').attr('href',link);
                $('.listaProduto').hide();
                $("a[rel=modal]").trigger("click");
            }
        });
        $('span.loja select[name=loja] option').each(function(){
            if($(this).attr('value')==loja){
                $(this).attr('selected','selected');
            }
        });
    });
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
    }
    .col1{
        width: 125px;
    }
    .col2{
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
        padding: 5px;
    }
    .procura{
        position: relative;
        float: right;
        top: -10px;
    }
    button:hover{
        cursor: pointer;
    }
    .recarrega{
        float: left;
        padding: 5px;
    }
    .procura .tipoBusca{
        margin-top: 5px;
        padding: 0 20px;
        float: right;
    }
    .loja{
        padding-right: 40px;
    }
    .paginas{
        position: absolute;
        margin-top: 10px;
    }
</style>
</head>
<body>
<div id="dadosItem"></div>
<?php
    include '../excecao/Excecao.php';
    include '../dao/dao.php';
    include '../dao/ProdutoSearchCriteria.php';
    include '../config/Config.php';
    include '../model/ProdutosCadastroJsonClient.php';
    include '../model/modelProduto.php';
    include '../mapping/ProdutoMapper.php';
    include '../model/TabelaPrecosJsonClient.php';
    
    $loja=null;
    $produto=new ProdutosCadastroJsonClient();
        
    if(key_exists('act', $_GET)){
        $act=$_GET['act'];
    }else{
        $act=null;
    }
    echo '<script>var act="'.$act.'"</script>';
    if(key_exists('loja', $_GET)){
        $loja=$_GET['loja'];
    }else{
        $loja=null;
    }
    $funcao=$_COOKIE['funcao'];
    $dadosUser=$user->find($search);
    foreach($dadosUser as $item){
        if($funcao != 'administrador'){
            $loja=$item->getloja();
        }
    }
    
    echo '<script>var loja="'.$loja.'"</script>';
    if(key_exists('pagAtual', $_GET)){
        $pagAtual=$_GET['pagAtual'];
        if($pagAtual=='undefined'){
           echo '<script>pagAtual=1;</script>'; 
        }
    }else{
        $pagAtual=1;
        echo '<script>pagAtual=1;</script>';
    }
    @$buscaProduto=$_GET['buscaProduto'];
    
    if(key_exists('tipoBusca', $_GET)){
        $tipoBusca=$_GET['tipoBusca'];
    }else{
        $tipoBusca='local';
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
            $local='checked';
            $servidor=null;
            break;
    }
    echo '<div class=recarrega><img src="../web/img/atualiza.png" height="18px" title="Recarregar esta página."/></div>';
    if($tipoBusca=='servidor' && $act != 'atualiza'){
        if(@$pagAtual=='undefined' || @!$pagAtual){
            $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>40,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
            $dados=$produto->ListarProdutos($produto_servico_list_request);
            if(!$dados){
                echo 'Não foi encontrado nenhum produto cadastrado.';
                exit;
            }
            $pagAtual=$dados->total_de_paginas;
            echo '<script>pagAtual='.$pagAtual.'</script>';
        }else{        
            $produto_servico_list_request=array("pagina"=>$pagAtual,"registros_por_pagina"=>40,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
            $dados=$produto->ListarProdutos($produto_servico_list_request);
        }
        $registros=$dados->registros;
        $totalRegistros=$dados->total_de_registros;
        $detalhes=$dados->produto_servico_cadastro;
    }elseif($tipoBusca=='local' && $act != 'atualiza'){
        $dao = new Dao();
        $search = new ProdutoSearchCriteria();
        $search->settabela('tb_produto');
        if($buscaProduto || @$pagAtual != 'undefined'){
            $search->setcodigo($buscaProduto);
            $search->setloja($loja);
            $detalhes=$dao->encontre2($search);
        }else{
            $detalhes=null;
        }
        $totalRegistros=$dao->totalLinhas2($search);
        $registros=null;
    }elseif($loja && $funcao='administrador'){
        $dao = new Dao();
        $search = new ProdutoSearchCriteria();
        $search->settabela('tb_produto');
        $search->setloja(strtoupper($loja));
        @$detalhes=$dao->encontrePorLoja($search);
        $totalRegistros=$dao->totalLinhas2($search);
    }elseif($loja && $funcao=='vendedor'){
        $dao = new Dao();
        $search = new ProdutoSearchCriteria();
        $search->settabela('tb_produto');
        $search->setloja(strtoupper($loja));
        $search->setcodigo($buscaProduto);
        @$detalhes=$dao->encontrePorLoja($search);
        $totalRegistros=$dao->totalLinhas2($search);
    }
    echo '<span class=tituloProd>Páginas </span>';
    if($tipoBusca=='servidor'){
        for($g=1;$g <= $dados->total_de_paginas;$g++){
            echo '<button class=paginacao>'.$g.'</button>&nbsp&nbsp';
        }
    }
    ?>
    <div class="procura">
        <span class="loja">
            <label><b>LOJA:</b> </label>
            <select name="loja">
                <?php if($funcao == 'administrador'): ?>
                <option value="" ></option>
                <option value="cachambi" >Cachambi</option>
                <option value="bonsucesso" >Bonsucesso</option>
                <?php else: ?>
                <option value="<?= $loja ?>"><?= $loja ?></option>
                <?php endif; ?>
            </select>
        </span>
        <input autofocus type="text" name="procura" title="Pesquisar por produtos" /> <img height="18" src="../web/img/lupa.png" title="Pesquisar por produtos" /> (F8)<br>
        <div class="tipoBusca"><input title="Tipo de busca" type="radio" name="tipoBusca" value="local" <?= $local ?>/><b> Local</b> &nbsp&nbsp&nbsp<input title="Tipo de busca" type="radio" name="tipoBusca" value="servidor" <?= $servidor ?>/> <b>Servidor</b></div>
    </div>
    <?php if($act != 'atualiza'): ?>
    <div class="paginas">Registros <span class="cont"><?= $registros ?></span> de <?= $totalRegistros ?>
        <?php if($tipoBusca=='local'): ?>
        <?php endif; endif;?>
    </div>
    <div class='tudo'>
        <div class='cima'></div>
        <div class='jTabela'>
            <table class="head" border=1 cellspacing=0 >
                <thead><tr>
                <?php
                    $w=$row=0;
                    $col=1;
                    $cont=0;
                    $dao = new Dao();
                    $search = new ProdutoSearchCriteria();
                    if($tipoBusca=='local'){
                        echo '<th  width="10%" class="col1">CÓDIGO</th>';
                        echo '<th class="descricao col2">DESCRIÇÃO DO PRODUTO</th>';
                        echo '<th class="col3">VALOR UNITÁRIO</th>';
                        echo '<th class="col4">PREÇO BOADICA</th></tr></thead>';
                        if($act != 'atualiza' && $detalhes){
                            foreach($detalhes as $item){
                                $search->settabela('tb_preco');
                                $search->setcodigo($item->getcodigo());
                                if($cont==0){
                                    if(OMIE_APP_KEY=='2769656370'){
                                        $db='db';
                                    }elseif(OMIE_APP_KEY=='461893204773'){
                                        $db='db2';
                                    }else{
                                        $db='db3';
                                    }
                                    $tabelaExiste=$dao->showTabela($search->gettabela(),$db);
                                    if(!$tabelaExiste){
                                        include '../dao/CRUDProduto.php';
                                        include '../dao/ModelSearchCriteria.php';
                                        $dao2=new CRUDProduto();
                                        $modelProduto=new modelProduto();
                                        $modelProduto->settabela('tb_preco');
                                        $dao2->grava4($modelProduto);
                                    }
                                    if($tabelaExiste){
                                        $boadica=$dao->encontre2($search);
                                        if($boadica){
                                            foreach($boadica as $preco){
                                                $pTabela=number_format($preco->getpTabela(),'2',',','.');
                                            }
                                        }else{
                                            $pTabela='Não Definido';
                                        }
                                    }
                                }else{
                                    $boadica=$dao->encontre2($search);
                                    if($boadica){
                                        foreach($boadica as $preco){
                                            $pTabela=number_format($preco->getpTabela(),'2',',','.');
                                        }
                                    }else{
                                        $pTabela='Não Definido';
                                    }
                                }
                                if(!$pTabela)$pTabela='Não Definido';
                                $item->setpTabela($pTabela);
                                echo '<tr class=listaProduto row="'.$row.'" descricao="'.$item->getdescricao().'" codigo="'.$item->getcodigo().'" codigo_produto="'.$item->getcodigo_produto().'" valor_unitario="'.$item->getvalor_unitario().'" pTabela="'.$item->getpTabela().'" quantidade_estoque="'.$item->getquantidade_estoque().'" cfop="'.$item->getcfop().'" ncm="'.$item->getncm().'" ean="'.$item->getean().'" unidade="'.$item->getunidade().'" ><td class="col1" align=center><div width=10px>'.$item->getcodigo().'</td>';
                                echo '<td class="col2" align=center>'.$item->getdescricao().'</td>';
                                echo '<td class="col3" align=right>'.number_format($item->getvalor_unitario(),'2',',','.').'</td>';
                                echo '<td class="col4" align=right>'.$pTabela.'</td></tr>';
                                $cont++;
                            }
                            echo '<script>var cont='.$cont.'</script>';
                        }
                    }elseif($tipoBusca=='servidor'){
                        foreach($detalhes as $prod){
                            if($w==0){
                                foreach($prod as $key => $item){
                                    if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca') && !stristr($key,'cfop') && !stristr($key,'produto') && !stristr($key,'minimo') && !stristr($key,'internas') && !stristr($key,'tipo') && !stristr($key,'quantidade_estoque') && !stristr($key,'ean') && !stristr($key,'ncm') && !stristr($key,'unidade') && !stristr($key,'detalhada')){
                                        if($key=='descricao'){
                                            echo '<th class="descricao col'.$col.'">DESCRIÇÃO DO PRODUTO</th>';
                                        }elseif($key=='valor_unitario'){
                                            echo '<th class="col'.$col.'">VALOR UNITÁRIO</th>';
                                        }elseif($key=='codigo'){
                                            echo '<th  width="10%" class="col'.$col.'">CÓDIGO</th>';
                                        }
                                        $col++;
                                    }
                                }
                                echo '<th class="col4">PREÇO BOADICA</th>';
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
                $serv=0;
                foreach($prod as $key => $item){
                    echo '<tr class="listaProduto" row="'.$row.'" ';
                    if($key!='dadosIbpt' && $key!='imagens' && $key!='recomendacoes_fiscais'){
                        if(stristr($key,'codigo')){
                            if($serv==0){
                                $search->settabela('tb_preco');
                                $search->setcodigo($item);
                                if(OMIE_APP_KEY=='2769656370'){
                                    $db='db';
                                }elseif(OMIE_APP_KEY=='461893204773'){
                                    $db='db2';
                                }else{
                                    $db='db3';
                                }
                                $tabelaExiste=$dao->showTabela($search->gettabela(),$db);
                                if($tabelaExiste){
                                    $boadica=$dao->encontre2($search);
                                    if($boadica){
                                        foreach($boadica as $preco){
                                            $pTabela=number_format($preco->getpTabela(),'2',',','.');
                                        }
                                    }else{
                                        $pTabela='Não Definido';
                                    }
                                }else{
                                    $pTabela=null;
                                }
                                if(!$pTabela){
                                    include '../dao/CRUDProduto.php';
                                    include '../dao/ModelSearchCriteria.php';
                                    $dao2=new CRUDProduto();
                                    $modelProduto=new modelProduto();
                                    $modelProduto->settabela('tb_preco');
                                    $dao2->grava4($modelProduto);
                                }
                            }
                            echo 'pTabela="'.$pTabela.'"';
                        }
                        echo $key.'="'.$item.'"';
                    }
                }
                echo ' pTabela="'.$pTabela.'">';
                foreach($prod as $key => $item){                    
                    if(!strstr($key,'aliquo') && !strstr($key,'altura') && !strstr($key,'bloqueado') && !strstr($key,'cest') && !strstr($key,'familia') && !strstr($key,'cst') && !strstr($key,'dias') && !stristr($key,'dadosib') && !stristr($key,'csosn') && !stristr($key,'importado') && !stristr($key,'inativo') && !stristr($key,'largura') && !stristr($key,'peso') && !stristr($key,'profundidade') && !stristr($key,'red') && !stristr($key,'recomendacoes') && !stristr($key,'imagens') && !stristr($key,'integracao') && !stristr($key,'marca') && !stristr($key,'cfop') && !stristr($key,'produto') && !stristr($key,'minimo') && !stristr($key,'internas') && !stristr($key,'tipo') && !stristr($key,'quantidade_estoque') && !stristr($key,'ean') && !stristr($key,'ncm') && !stristr($key,'unidade') && !stristr($key,'detalhada')){
                        if(stristr($key,'obs_interna')){
                            echo '<td class="col'.$col.'" align=center>'.$item.'</td>';
                        }elseif(stristr($key,'valor')){
                            echo '<td class="col'.$col.'" align=right>'.number_format($item,'2',',','.').'</td>';
                        }elseif(stristr($key,'codigo')){
                            $search->settabela('tb_preco');
                            $search->setcodigo($item);
                            $boadica=$dao->encontre2($search);
                            if($boadica){
                                foreach($boadica as $preco){
                                    $pTabela=number_format($preco->getpTabela(),'2',',','.');
                                }
                            }else{
                                $pTabela='Não Definido';
                            }
                            echo '<td class="col'.$col.'" loja="'.$loja.'" align=center><div width=10px>'.$item;
                            if($loja){ echo '('.$loja.')';}else{echo '</div></td>';}
                        }elseif(stristr($key,'descricao')){
                            echo '<td class="col'.$col.'" align=center>'.mb_strtoupper(str_replace('_',' ',$item),'utf-8').'</td>';
                        }
                        if($col==3){
                            echo '<td class="col'.$col.'" align=right>'.$pTabela.'</td>';
                        }
                    $col++;
                    $z=1;
                    }
                }
                echo '</tr>';
                $row++;
        }
    }
    ?>
            </table>
        </div>
    </div>
</body>
</html>