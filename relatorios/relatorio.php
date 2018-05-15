<?php
    include '../dao/dao.php';
    include '../dao/CRUDPedido.php';
    include '../dao/PedidoSearchCriteria.php';
    include '../validacao/valida_cookies.php';
    include '../model/pedido.php';
    include '../mapping/pedidoMapper.php';
    include '../excecao/Excecao.php';

    $valida=new valida_cookies();
    $valida->setLogin($_COOKIE['login']);
    $valida->loginDb('confere');

    $pedido=new pedido();
    $dao = new CRUDPedido();

    if(OMIE_APP_KEY=='2769656370'){
        $db='db';
    }elseif(OMIE_APP_KEY=='461893204773'){
        $db='db2';
    }else{
        $db='db3';
    }
    if(!$dao->showTabela('tb_pedido',$db)){
        echo '<div class=centro><h1>Tabela de pedido não foi criada.</h1>';
        echo '<button class=voltar onclick=history.go(-1)>Voltar</button></div>';
        exit;
    }

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
    $ultSem=array();
    foreach($dSem as $item_){
        if(@is_object($item_[count($item_)-1])){
            $diaDaSemena=substr($item_[count($item_)-1]->getdPrevisao(),0,2);
            if($y == 0){
                $ultSeg=$diaDaSemena;
                $ultSem[]=$diaDaSemena;
            }
            if($diaDaSemena > $ultSeg || $diaDaSemena < ($ultSeg-10)){
                $ultSem[]=$diaDaSemena;
            }
        }
        foreach($item_ as $item){
            for($x=0;$x<count($fPag);$x++){
                if($item->getfPagamento()==$fPag[$x]){
                    if(in_array(substr($item->getdPrevisao(),0,2),$ultSem)){
                        $venda[$fPag[$x]][$dSem_[$y]][]=$item;
                        $vPed[$fPag[$x]][$dSem_[$y]][]=$item->getvPedido();
                    }
                }
            }
        }
        $y++;
    }
    foreach($fPag as $item_){
        $$item_=0;
        foreach($dSem_ as $item){
            $$item_ +=array_sum($vPed[$item_][$item]);
        }
    }
    $dinheiro=number_format($dinheiro,'2',',','.');
    $debito=number_format($debito,'2',',','.');
    $credito=number_format($credito,'2',',','.');
    
    if(!isset($ultSem[5])){
        $ultSem[5]=date('d');
    }
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
    
    
    
    var dSeg=<?= $ultSem[0] ?>; var dSab="<?= $ultSem[5].'/'.date('m') ?>";
    var tDinheiro="<?="R$ ". $dinheiro ?>";var tDebito="<?= 'R$ '.$debito ?>";var tCredito="<?= 'R$ '.$credito ?>";
</script>