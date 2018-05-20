<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php 
            include '../model/NFConsultarJsonClient.php';
            include 'relatorio.php';
            include '../model/modelNota.php';
            include '../dao/NotaSearchCriteria.php';
            
            array_key_exists('act',$_GET)? $act=$_GET['act']: $act=null;
            if(array_key_exists('acertaTabela', $_GET)){
                $acertaTabela=$_GET['acertaTabela'];
            }
            array_key_exists('seleciona', $_GET)? $seleciona=$_GET['seleciona']: $seleciona=null;
        ?>
    </head>
    <body>
        <?php
            include '../model/PedidoVendaProdutoJsonClient.php';
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
            }
            if(file_exists('../dao/CRUDNota.php')){
                include '../dao/CRUDNota.php';
            }
            if($act=='atualiza' || !confereRabela('tb_nf')){
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
                $regPagina=20;
                $nfListarRequest=array("pagina"=>1,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
                $dados=$notaOmie->ListarNF($nfListarRequest);
                $tPaginas=$dados->total_de_paginas;
                $registros=$dados->total_de_registros;
                $y=gravaDados($dados,0,1,$registros);
                for($x=2;$x<=$tPaginas;$x++){
                    $nfListarRequest=array("pagina"=>$x,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
                    $dados=$notaOmie->ListarNF($nfListarRequest);
                    $y=gravaDados($dados,1,$y,$registros);
                }
                echo '<script>window.location.assign("../relatorios/relgel.php");</script>';
            }elseif($act=='buscaNF'){
                echo 'estou aqui';
            }
            function gravaDados($dados,$cont=null,$y,$registros){
                foreach($dados->nfCadastro as $item_){
                    $nota=new nota();
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
                        }
                        include '../mapping/notaMapper.php';
                        $dao2=new CRUDNota();
                    }
                    $cont++;
                    foreach($item_ as $key => $item){
                        if($key=='compl' || $key=='ide'){
                            foreach($item as $key2 => $item2){
                                $classe='set'.$key2;
                                $nota->$classe($item2);
                            }
                        }
                    }
                    $dao2=new CRUDNota();
                    $search=new NotaSearchCriteria();
                    $search->settabela('tb_nf');
                    $search->setnNF($nota->getnNF());
                    //echo "<pre>".print_r([$y,$nota]);
                    $dao2->grava7($nota);
                    echo '<script>document.getElementById("cont").innerHTML="Percentual concluido '.number_format($y*100/$registros,'0','.','').'%";</script>';
                    $y++;
                }
                return $y;
            }
            function confereRabela($tabela){
                $dao2=new CRUDNota();
                $search=new NotaSearchCriteria();
                $search->settabela($tabela);
                if(OMIE_APP_KEY=='2769656370'){
                    $db='db';
                }elseif(OMIE_APP_KEY=='461893204773'){
                    $db='db2';
                }else{
                    $db='db3';
                }
                return $dao2->showTabela('tb_nf',$db);
            }
        ?>
    </body>
</html>