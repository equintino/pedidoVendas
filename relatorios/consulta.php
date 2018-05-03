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
            $dados=$dao->encontrePorPedido($search);
            
            echo '<pre>';print_r($dados);
            
            die;
        ?>
        
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
        
        <script>
        //variáveis dinheiro
        var dinSeg;
        var dinTer;
        var dinQua;
        var dinQui;
        var dinSex;
        var dinSab;

        //variáveis débito
        var debSeg;
        var debTer;
        var debQua;
        var debQui;
        var debSex;
        var debSab;

        //variáveis crédito
        var credSeg;
        var credTer;
        var credQua;
        var credQui;
        var credSex;
        var credSab;

        </script>
        <script src="js/relatorio.js"></script>

    </div>
    </body>
</html>
