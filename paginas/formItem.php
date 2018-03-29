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
                tipoBusca='local';
                $('.recarrega').trigger('click')
            }else if($(this).val()=='servidor'){
                //$('.listaProduto').hide()
                $('.paginacao, .listaProduto').show()
                $('.loja').hide()
                tipoBusca='servidor';
                $('.recarrega').trigger('click')
            }
            $('.procura input[name=procura]').focus()
            tipoBusca=$(this).val();
            if(tipoBusca=='local'){

            }
        })
        /*$('.procura img').click(function(){
            if(tipoBusca=='local'){
                buscaProduto=encodeURIComponent($('.procura input[name=procura]').val());
                link='../paginas/formItem.php?tipoBusca='+tipoBusca+'&buscaProduto='+buscaProduto+'';
                $('.listaProduto').hide()
                $('.tituloProd').text('Aguarde...');
                $('a[rel=modal]').attr('href',link);
                $("a[rel=modal]").trigger("click")
            }
        })
        $('.procura input[name=procura').focus(function(){
            $(document).keydown(function(e){
                if(e.keyCode=='13'){
                    if(tipoBusca=='local'){
                        buscaProduto=encodeURIComponent($('.procura input[name=procura]').val());
                        link='../paginas/formItem.php?tipoBusca='+tipoBusca+'&buscaProduto='+buscaProduto+'';
                        $('.listaProduto').hide()
                        $('.tituloProd').text('Aguarde...');
                        $('a[rel=modal]').attr('href',link);
                        $("a[rel=modal]").trigger("click")
                    }
                }
            })
        })*/
        
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
                //alert(cont);
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
        /*$('.atualizaProduto span').click(function(){
            var pergAtualiza=confirm('O processo não poderá ser interrompido, pode demorar uns 5 minutos, Deseja continuar?');
            if(pergAtualiza){
                link='../paginas/formItem.php?act=atualiza&codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'&tipoBusca='+tipoBusca+'';
                $('a[rel=modal]').attr('href',link);
                $('.listaProduto').hide();
                $("a[rel=modal]").trigger("click")

                $('#boxes .window2').css('display','block')
            }
            //alert('clicou');
        })*/
        if(act=='atualiza'){
            $('#boxes .window2').css('display','block')
        }
        if(tipoBusca=='local'){
            $('.cont').text(cont);
        }
        $('.procura select[name=loja]').change(function(){
            loja=$(this).val();
            if(loja != ''){
                link='../paginas/formItem.php?tipoBusca=local&loja='+loja+'';
                $('a[rel=modal]').attr('href',link);
                $('.listaProduto').hide();
                $("a[rel=modal]").trigger("click")
            }
        })
        $('span.loja select[name=loja] option').each(function(){
            if($(this).attr('value')==loja){
                $(this).attr('selected','selected')
            }
        })
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
    .atualizaProduto{
        /*margin-left: 150px;
        color: red;
        text-align: center;
        font-style: italic;*/
    }
    .atualizaProduto span:hover{
        /*cursor: pointer;
        background: #8de572;
        text-shadow: 2px -2px 2px white;*/
    }
</style>
<div id="dadosItem"></div>
<?php
    include '../excecao/Excecao.php';
    include '../dao/dao.php';
    include '../dao/ProdutoSearchCriteria.php';
    include '../config/Config.php';
    include '../model/ProdutosCadastroJsonClient.php';
    include '../model/modelProduto.php';
    include '../mapping/ProdutoMapper.php';
    $loja=null;
    $produto=new ProdutosCadastroJsonClient();
    
    //print_r($_GET);die;
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
    echo '<script>var loja="'.$loja.'"</script>';
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
    if($tipoBusca=='servidor' && $act != 'atualiza'){
        if(@$pagAtual=='undefined' || @!$pagAtual){
            $produto_servico_list_request=array("pagina"=>1,"registros_por_pagina"=>40,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
            $dados=$produto->ListarProdutos($produto_servico_list_request);
            $pagAtual=$dados->total_de_paginas;
            echo '<script>pagAtual='.$pagAtual.'</script>';
        }
        
        $produto_servico_list_request=array("pagina"=>$pagAtual,"registros_por_pagina"=>40,"apenas_importado_api"=>"N","filtrar_apenas_omiepdv"=>"N");
        $dados=$produto->ListarProdutos($produto_servico_list_request);
        $registros=$dados->registros;
        $totalRegistros=$dados->total_de_registros;
        $detalhes=$dados->produto_servico_cadastro;
    }elseif($act != 'atualiza' && !$loja){
        $dao = new Dao();
        $search = new ProdutoSearchCriteria();
        $search->settabela('tb_produto');
        $search->setcodigo($buscaProduto);
        $detalhes=$dao->encontre2($search);
        //echo '<pre>';print_r($detalhes);die;
        $totalRegistros=$dao->totalLinhas2($search)['id']+1;
        $registros=null;
    }elseif($loja){
        $dao = new Dao();
        $search = new ProdutoSearchCriteria();
        $search->settabela('tb_produto');
        $search->setloja(strtoupper($loja));
        @$detalhes=$dao->encontrePorLoja($search);
        /*switch($loja){
            case 'cachambi':
                $cachambi='selected';
                //$bonsucesso='';
                break;
            case 'bonsucesso':
                $bonsucesso='selected';
                //$cachambi='';
                break;
        }*/
    }
    echo '<span class=tituloProd>Páginas </span>';
    if($tipoBusca=='servidor'){
        for($g=1;$g <= $dados->total_de_paginas;$g++){
            echo '<button class=paginacao>'.$g.'</button>&nbsp&nbsp';
        }
    }
    ?>
<from>
    <div class="procura">
        <span class="loja">
            <label><b>LOJA:</b> </label>
            <select name="loja">
                <option value="" ></option>
                <option value="cachambi" >Cachambi</option>
                <option value="bonsucesso" >Bonsucesso</option>
            </select>
        </span>
        <input autofocus type="text" name="procura" title="Pesquisar por produtos" /> <img height="18px" src="../web/img/lupa.png" title="Pesquisar por produtos" /><br>
        <div class="tipoBusca"><input title="Tipo de busca" type="radio" name="tipoBusca" value="local" <?= $local ?>/><b> Local</b> &nbsp&nbsp&nbsp<input title="Tipo de busca" type="radio" name="tipoBusca" value="servidor" <?= $servidor ?>/> <b>Servidor</b></div>
    </div>
    <?php if($act != 'atualiza'): ?>
    <div class="paginas">Registros <span class="cont"><?= $registros ?></span> de <?= $totalRegistros ?>
        <?php if($tipoBusca=='local'): ?>
            <!--<span class="atualizaProduto">para atualizar a tabela de produtos na busca LOCAL <span>clique aqui.</span></span>-->
        <?php endif; endif;?>
    </div>
</form>
    <div class='tudo'>
        <div class='cima'></div>
        <div class='jTabela'>
            <table class="head" border=1 cellspacing=0 >
                <thead><tr>
                <?php
                    $w=$row=0;
                    $col=1;
                    $cont=1;
                    if($tipoBusca=='local'){
                        echo '<th  width="10%" class="col1">CÓDIGO</th>';
                        echo '<th class="descricao col2">DESCRIÇÃO DO PRODUTO</th>';
                        echo '<th class="col3">VL.UNITÁRIO</th></tr></thead>';
                        if($act != 'atualiza'){
                            foreach($detalhes as  $item){
                                echo '<tr class=listaProduto row="'.$row.'" descricao="'.$item->getdescricao().'" codigo="'.$item->getcodigo().'" codigo_produto="'.$item->getcodigo_produto().'" valor_unitario="'.$item->getvalor_unitario().'" quantidade_estoque="'.$item->getquantidade_estoque().'" cfop="'.$item->getcfop().'" ncm="'.$item->getncm().'" ean="'.$item->getean().'" unidade="'.$item->getunidade().'" ><td class="col1" align=center><div width=10px>'.$item->getcodigo().'</td>';
                                echo '<td class="col2" align=center>'.$item->getdescricao().'</td>';
                                echo '<td class="col3" align=right>'.number_format($item->getvalor_unitario(),'2',',','.').'</td></tr>';
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
                                            echo '<th class="col'.$col.'">VL.UNITÁRIO</th>';
                                        }elseif($key=='codigo'){
                                            echo '<th  width="10%" class="col'.$col.'">CÓDIGO</th>';
                                        }else{
                                            echo '<th class="col'.$col.'">'.mb_strtoupper(str_replace('_',' ',$key),'utf-8').'</th>';
                                        }
                                        $col++;
                                    }
                                }
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
                        if(stristr($key,'obs_interna')){
                            echo '<td class="col'.$col.'" align=center>'.$item.'</td>';
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
        }
    }
    ?>
            </table>
        </div>
    </div>

    <div id="boxes">
            <!-- Janela Modal2 -->
	<div id="dialog2" class="window2">
            <div align="right">
                <!--<input type="button" value="Fechar" class="close2"/>-->
            </div>
                <!--<img src="mensagem.jpg" width="650" height="655" /><br />-->
                <?php //include '../paginas/aguarde.php' ?>
	</div>
            <!-- Fim Janela Modal-->
    </div>