<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php 
            include '../model/NFConsultarJsonClient.php';
            include '../model/PedidoVendaProdutoJsonClient.php';
            include 'relatorio.php';
            
            array_key_exists('act',$_GET)? $act=$_GET['act']: $act=null;
            if(array_key_exists('acertaTabela', $_GET)){
                $acertaTabela=$_GET['acertaTabela'];
            }
            array_key_exists('seleciona', $_GET)? $seleciona=$_GET['seleciona']: $seleciona=null;
            if(file_exists('../dao/CRUDNota.php')){
                include '../model/modelNota.php';
                include '../dao/NotaSearchCriteria.php';
                include '../mapping/notaMapper.php';
                include '../dao/CRUDNota.php';
            }else{
                $act='atualiza';
            }
        ?>
    </head>
    <body>
        <?php
            $dao=new CRUDPedido();
            $search=new PedidoSearchCriteria();
            $search->settabela('tb_pedido');
            foreach($dao->encontrePorPedido($search) as $item){
                if($item->getcodigo_pedido()){
                    $acertaTabela=null;
                    break;
                }else{
                    $acertaTabela=1;
                }
            }
            if(isset($acertaTabela)){
                $tabelaAtualizando='Pedidos, Campo Código Pedido';
                if(!isset($seleciona)){
                    $seleciona=0;
                    echo '<script>pagina="notafiscal";codTabela="acertaTabela";</script>';
                    include '../paginas/atualizando.php';
                    exit;
                }else{
                    echo '<script>var seleciona=2</script>';
                    include '../paginas/atualizando.php';
                }
                $regPagina=20;
                $pedidoOmie=new PedidoVendaProdutoJsonClient();
                $pvpListarRequest=array("pagina"=>1,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"S");
                $pedidoLista=$pedidoOmie->ListarPedidos($pvpListarRequest);
                
                $total_de_paginas=$pedidoLista->total_de_paginas;
                for($x=0;$x<count($pedidoLista->pedido_venda_produto);$x++){
                    $codigo_pedido=$pedidoLista->pedido_venda_produto[$x]->cabecalho->codigo_pedido;
                    $pedido=$pedidoLista->pedido_venda_produto[$x]->cabecalho->numero_pedido;
                    $search->setpedido($pedido);
                    $pedOmie=$dao->encontrePorPedido($search);
                    if($pedOmie){
                        $pedOmie[0]->setcodigo_pedido($codigo_pedido);
                        $dao->gravaNumeroPedido($pedOmie[0]);
                    }
                }
                for($y=$total_de_paginas;$y!=1;$y--){
                    $pvpListarRequest=array("pagina"=>$y,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"S");
                    $pedidoLista=$pedidoOmie->ListarPedidos($pvpListarRequest);
                    for($x=0;$x<count($pedidoLista->pedido_venda_produto);$x++){
                        $codigo_pedido=$pedidoLista->pedido_venda_produto[$x]->cabecalho->codigo_pedido;
                        $pedido=$pedidoLista->pedido_venda_produto[$x]->cabecalho->numero_pedido;
                        $search->setpedido($pedido);
                        $pedOmie=$dao->encontrePorPedido($search);
                        if($pedOmie && !$pedOmie[0]->getcodigo_pedido()){
                            $pedOmie[0]->setcodigo_pedido($codigo_pedido);
                            $dao->gravaNumeroPedido($pedOmie[0]);
                        }
                    }
                }
                echo '<script>window.location.assign("../relatorios/relgel.php");</script>';
            }
            if($act=='atualiza' || !confereTabela('tb_nf')){
                $tabelaAtualizando='Notas Fiscais';
                if(!isset($seleciona)){
                    $seleciona=0;
                    echo '<script>pagina="notafiscal";act="atualiza";codTabela="nenhum";</script>';
                    include '../paginas/atualizando.php';
                    exit;
                }else{
                    echo '<script>var seleciona=2</script>';
                    include '../paginas/atualizando.php';
                }
                $notaOmie=new NFConsultarJsonClient();
                $regPagina=1;
                $nfListarRequest=array("pagina"=>1,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
                $dados=$notaOmie->ListarNF($nfListarRequest);
                $tPaginas=$dados->total_de_paginas;
                $registros=$dados->total_de_registros;
                
                $dao->drop('tb_nf');
                $y=gravaDados($dados,0,1,$registros);
                for($x=2;$x<=$tPaginas;$x++){
                    $nfListarRequest=array("pagina"=>$x,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
                    $dados=$notaOmie->ListarNF($nfListarRequest);
                    $y=gravaDados($dados,1,$y,$registros);
                }
                echo '<script>window.location.assign("../relatorios/relgel.php");</script>';
            }elseif($act=='buscaNF'){
                $tabelaAtualizando='Notas Fiscais';
                if(!isset($seleciona)){
                    $seleciona=0;
                    echo '<script>pagina="notafiscal";act="buscaNF";codTabela="nenhum";</script>';
                    include '../paginas/atualizando.php';
                    exit;
                }else{
                    echo '<script>var seleciona=2</script>';
                    include '../paginas/atualizando.php';
                }
                $notaOmie=new NFConsultarJsonClient();
                $regPagina=1;
                $nfListarRequest=array("pagina"=>1,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
                $dados=$notaOmie->ListarNF($nfListarRequest);
                $tPaginas=$dados->total_de_paginas;
                $registros=$dados->total_de_registros;
                
                //if(file_exists('../dao/CRUDNota.php')){
                    //include '../mapping/notaMapper.php';
                    $daoNota=new CRUDNota();
                    $search=new NotaSearchCriteria();
                    $search->settabela('tb_nf');
                //}
                for($y=$tPaginas;$y>=1;$y--){
                    $nfListarRequest=array("pagina"=>$y,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
                    $dados=$notaOmie->ListarNF($nfListarRequest);
                    //if(file_exists('../dao/CRUDNota.php')){
                        $search->setnIdNF($dados->nfCadastro[0]->compl->nIdNF);
                        $notaAchada=$daoNota->encontrePorNota($search);
                    //}
                    if(!$notaAchada){
                        gravaDados($dados,1,1,1);
                    }else{
                        goto s;
                    }
                }
                s:
                echo '<script>window.location.assign("relgel.php");</script>';
            }
            function gravaDados($dados,$cont=null,$y,$registros){
                foreach($dados->nfCadastro as $item_){
                    if($cont==0){
                        foreach($item_ as $key => $item){
                             if($key=='compl'){
                                 $campos[]=$key;
                                 foreach($item as $key2 => $item2){
                                     $campos[]=$key2;
                                 }
                             }elseif($key=='ide'){
                                 $campos[]=$key;
                                 foreach($item as $key2 => $item2){
                                     $campos[]=$key2;
                                 }
                             }
                        }
                        if(!file_exists('../dao/CRUDNota.php')){
                            include '../paginas/criaClasses5.php';
                            $arquivos=new criaClsses5();
                            $campos=array_unique($campos);
                            $arquivos->novoArquivo($campos);
                            sleep(5);
                            include '../dao/CRUDNota.php';
                            $criou=1;
                        }
                        if(isset($criou)){
                            include '../mapping/notaMapper.php';
                            include '../dao/NotaSearchCriteria.php';
                            include '../model/modelNota.php';
                            //$dao2=new CRUDNota();
                        }
                    }
                    $cont++;
                    $dao2=new CRUDNota();
                    $search=new NotaSearchCriteria();
                    $nota=new nota();


                    foreach($item_ as $key => $item){
                        if($key=='compl' || $key=='ide'){
                            foreach($item as $key2 => $item2){
                                $classe='set'.$key2;
                                $nota->$classe($item2);
                            }
                        }
                    }

                    $nota->settabela('tb_nf');
                    $nota->setnNF($nota->getnNF());
                    $dao2->grava7($nota);
                    echo '<script>document.getElementById("cont").innerHTML="Percentual concluido '.number_format($y*100/$registros,'0','.','').'%";</script>';
                    $y++;
                }
                return $y;
            }
            function confereTabela($tabela){
                $dao=new dao();
                //$search=new NotaSearchCriteria();
                //$search->settabela($tabela);
                if(OMIE_APP_KEY=='2769656370'){
                    $db='db';
                }elseif(OMIE_APP_KEY=='461893204773'){
                    $db='db2';
                }else{
                    $db='db3';
                }
                return $dao->showTabela($tabela,$db);
            }
        ?>
    </body>
</html>