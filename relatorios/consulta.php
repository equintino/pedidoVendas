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
            $fPag=array('dinheiro','debito','credito');
            $dSem=array($seg,$ter,$qua,$qui,$sex,$sab);
            $dSem_=array('seg','ter','qua','qui','sex','sab');
            foreach($fPag as $item){
                foreach($dSem_ as $item_){
                    $vPed[$item][$item_][]=array();
                }
            }
            $y=0;
            foreach($dSem as $item_){
                foreach($item_ as $item){
                    for($x=0;$x<count($fPag);$x++){
                        if($item->getfPagamento()==$fPag[$x]){
                            $ultimaSem[$dSem_[$y]]=substr($item->getdPrevisao(),0,2);
                            $venda[$fPag[$x]][$dSem_[$y]][]=$item;
                            $vPed[$fPag[$x]][$dSem_[$y]][]=$item->getvPedido();
                        }
                    }
                }
                $y++;
            }
            //echo '<pre>';print_r($ultimaSem);die;
        ?>
        <script>
            var dinSeg=<?= array_sum($vPed['dinheiro']['seg']) ?>;
            var debSeg=<?= array_sum($vPed['debito']['seg']) ?>;
            var credSeg=<?= array_sum($vPed['credito']['seg']) ?>;
            var dinTer=<?= array_sum($vPed['dinheiro']['ter']) ?>;
            var debTer=<?= array_sum($vPed['debito']['ter']) ?>;
            var credTer=<?= array_sum($vPed['credito']['ter']) ?>;
            var dinQua=<?= array_sum($vPed['dinheiro']['qua']) ?>;
            var debQua=<?= array_sum($vPed['debito']['qua']) ?>;
            var credQua=<?= array_sum($vPed['credito']['qua']) ?>;
            var dinQui=<?= array_sum($vPed['dinheiro']['qui']) ?>;
            var debQui=<?= array_sum($vPed['debito']['qui']) ?>;
            var credQui=<?= array_sum($vPed['credito']['qui']) ?>;
            var dinSex=<?= array_sum($vPed['dinheiro']['sex']) ?>;
            var debSex=<?= array_sum($vPed['debito']['sex']) ?>;
            var credSex=<?= array_sum($vPed['credito']['sex']) ?>;
            var dinSab=<?= array_sum($vPed['dinheiro']['sab']) ?>;
            var debSab=<?= array_sum($vPed['debito']['sab']) ?>;
            var credSab=<?= array_sum($vPed['credito']['sab']) ?>;
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
