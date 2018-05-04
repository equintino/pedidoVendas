<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Consulta de Pedidos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/consulta.css"/>
        <script src="js/Chart.min.js"></script>

        <?php
            include '../dao/dao.php';
            include '../dao/CRUDPedido.php';
            include '../dao/PedidoSearchCriteria.php';
            include '../validacao/valida_cookies.php';
            include '../model/pedido.php';
            include '../mapping/pedidoMapper.php';
            
            $valida=new valida_cookies();
            $valida->setLogin($_COOKIE['login']);
            $valida->loginDb('confere');
            
            $pedido=new pedido();
            $dao = new CRUDPedido();
            $search = new PedidoSearchCriteria();
            $search->settabela('tb_pedido');
            $search->setdSemana(1);
            $seg=$dao->encontrePorPedido($search);
            $search->setdSemana(2);
            $ter=$dao->encontrePorPedido($search);
            $search->setdSemana(3);
            $qua=$dao->encontrePorPedido($search);
            $search->setdSemana(4);
            $qui=$dao->encontrePorPedido($search);
            $search->setdSemana(5);
            $sex=$dao->encontrePorPedido($search);
            $search->setdSemana(6);
            $sab=$dao->encontrePorPedido($search);
            
            date_default_timezone_set('America/Sao_Paulo');
            $vPedSegDin=$vPedSegDeb=$vPedSegCre=0;
            $vPedTerDin=$vPedTerDeb=$vPedTerCre=0;
            $vPedQuaDin=$vPedQuaDeb=$vPedQuaCre=0;
            $vPedQuiDin=$vPedQuiDeb=$vPedQuiCre=0;
            $vPedSexDin=$vPedSexDeb=$vPedSexCre=0;
            $vPedSabDin=$vPedSabDeb=$vPedSabCre=0;
            foreach($seg as $item){
                if($item->getfPagamento()=='dinheiro'){
                    $vPedSegDin=$vPedSegDin+$item->getvPedido();
                }elseif($item->getfPagamento()=='debito'){
                    $vPedSegDeb=$vPedSegDeb+$item->getvPedido();
                }else{
                    $vPedSegCre=$vPedSegCre+$item->getvPedido();
                }
            }
            foreach($ter as $item){
                if($item->getfPagamento()=='dinheiro'){
                    $vPedTerDin=$vPedTerDin+$item->getvPedido();
                }elseif($item->getfPagamento()=='debito'){
                    $vPedTerDeb=$vPedTerDeb+$item->getvPedido();
                }else{
                    $vPedTerCre=$vPedTerCre+$item->getvPedido();
                }
            }
            foreach($qua as $item){
                if($item->getfPagamento()=='dinheiro'){
                    $vPedQuaDin=$vPedQuaDin+$item->getvPedido();
                }elseif($item->getfPagamento()=='debito'){
                    $vPedQuaDeb=$vPedQuaDeb+$item->getvPedido();
                }else{
                    $vPedQuaCre=$vPedQuaCre+$item->getvPedido();
                }
            }
            foreach($qui as $item){
                if($item->getfPagamento()=='dinheiro'){
                    $vPedQuiDin=$vPedQuiDin+$item->getvPedido();
                }elseif($item->getfPagamento()=='debito'){
                    $vPedQuiDeb=$vPedQuiDeb+$item->getvPedido();
                }else{
                    $vPedQuiCre=$vPedQuiCre+$item->getvPedido();
                }
            }
            foreach($sex as $item){
                if($item->getfPagamento()=='dinheiro'){
                    $vPedSexDin=$vPedSexDin+$item->getvPedido();
                }elseif($item->getfPagamento()=='debito'){
                    $vPedSexDeb=$vPedSexDeb+$item->getvPedido();
                }else{
                    $vPedSexCre=$vPedSexCre+$item->getvPedido();
                }
            }
            foreach($sab as $item){
                if($item->getfPagamento()=='dinheiro'){
                    $vPedSabDin=$vPedSabDin+$item->getvPedido();
                }elseif($item->getfPagamento()=='debito'){
                    $vPedSabDeb=$vPedSabDeb+$item->getvPedido();
                }else{
                    $vPedSabCre=$vPedSabCre+$item->getvPedido();
                }
            }
        ?>
        <script>
            var dinSeg=<?= $vPedSegDin ?>;
            var debSeg=<?= $vPedSegDeb ?>;
            var credSeg=<?= $vPedSegCre ?>;
            var dinTer=<?= $vPedTerDin ?>;
            var debTer=<?= $vPedTerDeb ?>;
            var credTer=<?= $vPedTerCre ?>;
            var dinQua=<?= $vPedQuaDin ?>;
            var debQua=<?= $vPedQuaDeb ?>;
            var credQua=<?= $vPedQuaCre ?>;
            var dinQui=<?= $vPedQuiDin ?>;
            var debQui=<?= $vPedQuiDeb ?>;
            var credQui=<?= $vPedQuiCre ?>;
            var dinSex=<?= $vPedSexDin ?>;
            var debSex=<?= $vPedSexDeb ?>;
            var credSex=<?= $vPedSexCre ?>;
            var dinSab=<?= $vPedSabDin ?>;
            var debSab=<?= $vPedSabDeb ?>;
            var credSab=<?= $vPedSabCre ?>;
        </script>
        
    </head>
    <body>
        
        <input type="checkbox" id="bt_menu"/>
        <label for="bt_menu">&#9776;</label>

        <nav class="menu">
            <ul>
                <li><a href="#">PEDIDOS HOJE</a></li>
                <li><a href="pedidos.html">PEDIDOS PENDENTES</a>
                </li>
                <li><a href="consulta.html">MOVIMENTAÇÃO SEMANAL</a>
                    <ul>
                        <li><a href="dinheiro.html">DINHEIRO</a></li>
                        <li><a href="debito.html">DÉBITO</a></li>
                        <li><a href="credito.html">CRÉDITO</a></li>
                     </ul>
                </li>
            </ul>
        </nav>
    <div id="canvas">
        <canvas class="line-chart"></canvas>
        <script src="js/relatorio.js"></script>

    </div>
    </body>
</html>
