<!DOCTYPE html>
<html>
    <head>
        <title>Consulta de Pedidos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/consulta.css"/>
        <script src="js/Chart.min.js"></script>
        <style>
            .empresa{
                float: left;
                margin-left: 30px;
                text-shadow: 1px 1px 1px gray;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <div class="back"></div>
        <div class="cabecalho">
        <input type="checkbox" id="bt_menu"/>
        <label for="bt_menu">&#9776;</label>
        <nav class="menu">
            <ul>
                <!--<li class="menu1"><a href="#" title="Em construção" onclick="alert('Em construção.')">PEDIDOS PENDENTES</a></li>-->
                <li class="menu1"><a href="statusPedido.php" >PEDIDOS VENDAS</a>
                <ul>
                    <!--<li><a href="dinheiro.php">HOJE</a></li>
                    <li><a href="debito.php">SEMANA</a></li>
                    <li><a href="credito.php">MÊS</a></li>-->
                </ul>
                </li>
                <li class="menu1"><a href="consulta.php">GRÁFICOS</a>
                    <!--<ul>
                        <li><a href="dinheiro.php">DINHEIRO</a></li>
                        <li><a href="debito.php">DÉBITO</a></li>
                        <li><a href="credito.php">CRÉDITO</a></li>
                     </ul>-->
                </li>
                <li class="menu1"><a href="relgel.php">RELATÓRIO GERAL</a></li>
                <li class="menu1"><a href="../web/index.php?pagina=pedido&act=cad">SISTEMA DE VENDAS</a></li>
            </ul>
        </nav>
        <div class="empresa">
            <?= $_COOKIE['nomeEmpresa'].' - CNPJ: '.$_COOKIE['cnpj']  ?>
        </div>
        </div>
    </body>
</html>
