<!DOCTYPE html>
<html>
    <head>
        <title>Consulta de Pedidos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/consulta.css"/>
        <script src="js/Chart.min.js"></script>
        <?php include 'relatorio.php'; ?>
    </head>
    <body>
        <input type="checkbox" id="bt_menu"/>
        <label for="bt_menu">&#9776;</label>
        <nav class="menu">
            <ul>
                <li><a href="#">PEDIDOS HOJE</a></li>
                <li><a href="pedidos.html">PEDIDOS PENDENTES</a>
                </li>
                <li><a href="consulta.php">MOVIMENTAÇÃO SEMANAL</a>
                    <ul>
                        <li><a href="dinheiro.php">DINHEIRO</a></li>
                        <li><a href="debito.php">DÉBITO</a></li>
                        <li><a href="credito.php">CRÉDITO</a></li>
                     </ul>
                </li>
            </ul>
        </nav>
    </body>
</html>
