<!DOCTYPE html>
<head>
<style>
    body{
        margin: 0;
        padding: 0;
        font-size: 30px;
        text-shadow: 2px 2px 2px white;
    }
    div.msg{
        width: 400px;
        height: 400px;
        margin: 100px auto;
        text-align: center;
    }
    .contato{
        font-size: 20px;        
    }
</style>
</head>
<body>
<?php
 include '../validacao/valida_cookies.php';$cookies=new valida_cookies();$cookies->limpaCookies();?>
    <div class="msg"><img src="img/logo.png" />
        <h2>EMQDesenv</h2>
        <h4>Desenvolvimento de Sistemas</h4>
    <p>Obrigado  por ter usado nosso Sistema de Pedido de Vendas.</p>
    <p class="contato">edmquintino@gmail.com</p>
    </div>
</body>
</html>